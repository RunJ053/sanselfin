<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Mail\PasswordResetRequestMail;
use App\Mail\UserVerificationMail;
use App\Models\DatoUsuario;
use App\Models\TipoCliente;
use App\Models\UserVerificationCode;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\RegisterEmpleadoRequest;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = DatoUsuario::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password ?? '')) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        if (!$user->is_verified) {
            Auth::logout();
            return redirect('/incio_sesion')->withErrors([
                'email' => 'Tu cuenta aún no ha sido verificada. Por favor, revisa tu correo electrónico.',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();
        session([
            'usuario_id' => $user->id,
            'nombre_usuario' => $user->nombre,
            'nombre_img' => $user->user_img
        ]);

        if (in_array($user->role, [TipoCliente::ROLE_ADMINISTRADOR, TipoCliente::ROLE_EMPLEADO])) {
            return redirect()->route('admin.dashboard');
        }

        $productos = Producto::latest()->take(22)->get();
        return view('index2', compact('productos'));
    }

    protected function registerUser(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|min:3|max:50',
            'apellido'   => 'required|string|min:3|max:50',
            'direccion'  => 'required|string|min:7|max:255',
            'email'      => 'required|email|max:100|unique:datos_usuario,email',
            'fecha_nac'  => 'required|date|before:today',
            'password'   => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&.]/'
            ],
        ], [
            'password.regex' => 'La contraseña debe incluir al menos:
            <ul style="text-align:left; margin:0; padding-left:18px;">
                <li>Una mayúscula</li>
                <li>Una minúscula</li>
                <li>Un número</li>
                <li>Un carácter especial (@ $ ! % * # ? & .)</li>
            </ul>',
        ]);

        try {
            $datoUsuario = DatoUsuario::create([
                'nombre'     => $request->nombre,
                'apellidos'  => $request->apellido,
                'direccion'  => $request->direccion,
                'email'      => $request->email,
                'edad'       => $request->fecha_nac,
                'password'   => Hash::make($request->password),
                'role'       => 1,
                'is_verified'=> false,
                'localidad'  => 15,
                'tipo_docu'  => 1,
                'tipo_de_genero' => 4,
            ]);

            $token = Str::random(60);
            $expiresAt = Carbon::now()->addMinutes(10);

            UserVerificationCode::create([
                'user_id'    => $datoUsuario->id,
                'token'      => $token,
                'expires_at' => $expiresAt,
            ]);

            Mail::to($datoUsuario->email)->send(new UserVerificationMail($token, $datoUsuario->nombre));

            return redirect()->route('user.checkEmail')->with([
                'message' => '¡Registro exitoso! Por favor, revisa tu correo para verificar tu cuenta.',
            ]);
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar registrarte.']);
        } catch (\Exception $e) {
            if (isset($datoUsuario) && $datoUsuario->exists) {
                $datoUsuario->delete();
            }
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al registrarte.']);
        }
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetToken(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'exists:datos_usuario,email']]);

        $user = DatoUsuario::where('email', $request->email)->first();

        $token = Str::random(35);
        $expiresAt = Carbon::now()->addMinutes(60);

        try {
            DB::table('password_resets')->where('email', $user->email)->delete();

            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]);

            Mail::to($user->email)->send(new PasswordResetRequestMail($token, $user->nombre));

            return redirect()->route('password.reset.form')->with([
                'status' => 'Se ha enviado un código de restablecimiento a tu correo electrónico.',
                'email' => $user->email
            ]);
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar enviar el token.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al enviar el correo de restablecimiento.']);
        }
    }

    public function showResetPasswordForm(Request $request)
    {
        $email = session('email') ?? old('email');
        return view('auth.reset-password', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:datos_usuario,email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DatoUsuario::where('email', $request->email)->first();
        $passwordReset = DB::table('password_resets')->where('email', $request->email)->first();

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['token' => 'El código de verificación es inválido o ya ha sido utilizado.'])
                ->withInput($request->except('password', 'password_confirmation', 'old_password'));
        }

        $expiresAt = Carbon::parse($passwordReset->created_at)->addMinutes(60);
        if (Carbon::now()->greaterThan($expiresAt)) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => 'El código de verificación ha expirado.'])
                ->withInput($request->except('password', 'password_confirmation', 'old_password'));
        }

        try {
            $user->password = Hash::make($request->password);
            $user->save();
            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('login')->with('success', '¡Tu contraseña ha sido restablecida exitosamente!');
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar restablecer tu contraseña.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al restablecer tu contraseña.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Has cerrado sesión correctamente.');
    }
}