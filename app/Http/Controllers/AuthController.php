<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Mail\AdminVerificationMail;
use App\Mail\PasswordResetRequestMail;
use App\Mail\UserVerificationMail; // NUEVO: Importa la clase de correo para restablecimiento

use App\Models\DatoUsuario;
use App\Models\TipoCliente;
use App\Models\AdminVerificationCode;
use App\Models\UserVerificationCode; // Importamos el nuevo modelo


use Illuminate\Support\Facades\DB; //Para interactuar con la tabla password_resets
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Asegúrate de que esta línea esté presente

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

        // Verifica si el usuario existe y si la contraseña es correcta
        if (!$user || !Hash::check($credentials['password'], $user->password ?? '')) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        if ($user->role == TipoCliente::ROLE_ADMINISTRADOR) {
            if (!$user->is_verified) {
                Auth::logout();
                return redirect('/incio_sesion')->withErrors([
                    'email' => 'Tu cuenta de administrador aún no ha sido verificada. Por favor, revisa tu correo electrónico.',
                ]);
            }

            Auth::login($user);
            $request->session()->regenerate();
            session(['usuario_id' => $user->id, 'nombre_usuario' => $user->nombre, 'nombre_img' => $user->user_img]);
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == TipoCliente::ROLE_EMPLEADO) {
            if (!$user->is_verified) {
                Auth::logout();
                return redirect('/incio_sesion')->withErrors([
                    'email' => 'Tu cuenta de empleado aún no ha sido verificada. Por favor, revisa tu correo electrónico.',
                ]);
            }
            Auth::login($user);
            $request->session()->regenerate();
            session(['usuario_id' => $user->id, 'nombre_usuario' => $user->nombre, 'nombre_img' => $user->user_img]);
            return redirect()->route('admin.dashboard');
        } else {
            if (!$user->is_verified) {
                Auth::logout();
                return redirect('/incio_sesion')->withErrors([
                    'email' => 'Tu cuenta aún no ha sido verificada. Por favor, revisa tu correo electrónico.',
                ]);
            }
            Auth::login($user);
            $request->session()->regenerate();
            session(['usuario_id' => $user->id, 'nombre_usuario' => $user->nombre, 'nombre_img' => $user->user_img]);
            return redirect()->route('user.dashboard');
        }
    }

    protected function registerUser(RegisterUserRequest $request)
    {
        Log::info('Inicio del proceso de registro de usuario normal.');

        $data = $request->validated();
        Log::info('Datos de registro validados para el usuario: ' . $data['email']);

        try {
            // Verificamos si el email ya existe para evitar duplicados
            if (DatoUsuario::where('email', $data['email'])->exists()) {
                Log::warning('Intento de registro con email duplicado: ' . $data['email']);
                return back()->withErrors(['email' => 'El correo electrónico ya está registrado.']);
            }

            // Creamos el usuario con is_verified en false
            $datoUsuario = DatoUsuario::create([
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellido'],
                'direccion' => $data['direccion'],
                'email' => $data['email'],
                'edad' => $data['fecha_nac'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'is_verified' => false, // IMPORTANTE: El usuario no está verificado al inicio
                'localidad' => 15,
                'tipo_docu' => 1,
                'tipo_de_genero' => 4,
                'documento' => null,
                'telefono' => null,
                'nom_imgs' => null,
                'user_img' => null,
            ]);

            if (!$datoUsuario) {
                Log::error('Fallo al crear el registro del usuario en la base de datos.');
                return back()->withInput()->withErrors(['database_error' => 'No se pudo crear el usuario.']);
            }

            Log::info('Usuario registrado exitosamente con ID: ' . $datoUsuario->id . '. Generando token de verificación.');
            
            // Generamos un token único de 60 caracteres
            $token = Str::random(60); 
            $expiresAt = Carbon::now()->addMinutes(30); // El token expira en 30 minutos

            // Guardamos el token en la base de datos
            $verificationCodeEntry = UserVerificationCode::create([
                'user_id' => $datoUsuario->id,
                'token' => $token,
                'expires_at' => $expiresAt,
            ]);

            if (!$verificationCodeEntry) {
                Log::error('Fallo al guardar el token de verificación para el usuario ID: ' . $datoUsuario->id);
                // Si falla, eliminamos el usuario para evitar cuentas "zombies"
                $datoUsuario->delete();
                return back()->withInput()->withErrors(['database_error' => 'No se pudo guardar el token de verificación.']);
            }
            
            Log::info('Token de verificación guardado. Enviando correo al usuario: ' . $datoUsuario->email);
            
            // Enviamos el correo de verificación al email del usuario
            Mail::to($datoUsuario->email)->send(new UserVerificationMail($token, $datoUsuario->nombre));
            
            Log::info('Correo de verificación enviado exitosamente.');

            // Redirigimos al usuario a una página de confirmación
            return redirect()->route('user.checkEmail')->with([
                'message' => '¡Registro exitoso! Por favor, revisa tu correo para verificar tu cuenta.',
            ]);

        } catch (QueryException $e) {
            Log::error('Error de Query al registrar usuario: ' . $e->getMessage());
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar registrarte. Por favor, inténtalo de nuevo más tarde.']);
        } catch (\Exception $e) {
            Log::error('Error inesperado al registrar usuario: ' . $e->getMessage());
            // Si el error ocurre después de crear el usuario pero antes de enviar el correo, lo eliminamos.
            if (isset($datoUsuario) && $datoUsuario->exists) {
                $datoUsuario->delete();
            }
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al registrarte.']);
        }
    }

    protected function registerEmpleado(RegisterEmpleadoRequest $request)
    {
        $data = $request->validated();
        try {
            if (DatoUsuario::where('email', $data['email'])->exists()) {
                return back()->withErrors(['email' => 'El correo electrónico ya está registrado.']);
            }

            $datoUsuario = DatoUsuario::create([
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellido'],
                'direccion' => $data['direccion'],
                'email' => $data['email'],
                'edad' => $data['fecha_nac'],
                'role' => $data['role'],
                'is_verified' => $data['is_verified'],
                'password' => null,
                'localidad' => 15,
                'tipo_docu' => 1,
                'tipo_de_genero' => 4,
                'documento' => null,
                'telefono' => null,
                'nom_imgs' => null,
                'user_img' => null,
            ]);

            if (!$datoUsuario) {
                return back()->withInput()->withErrors(['database_error' => 'No se pudo crear el empleado.']);
            }

            $code = Str::random(6);
            $expiresAt = Carbon::now()->addMinutes(10);

            $verificationCodeEntry = AdminVerificationCode::create([
                'user_id' => $datoUsuario->id,
                'code' => $code,
                'expires_at' => $expiresAt,
            ]);

            if (!$verificationCodeEntry) {
                $datoUsuario->delete();
                return back()->withInput()->withErrors(['database_error' => 'No se pudo guardar el código de verificación.']);
            }

            $adminEmailForVerification = 'josezapataaguirre@gmail.com';
            Mail::to($adminEmailForVerification)->send(new AdminVerificationMail($code, $datoUsuario->nombre));

            return redirect()->back()->with([
                'openAdminVerificationModal' => true,
                'admin_user_id' => $datoUsuario->id,
                'message' => 'Se ha enviado un código de verificación al correo del administrador. Por favor, introdúcelo para completar el registro.',
            ]);
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar registrarte. Por favor, inténtalo de nuevo más tarde.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al registrarte.']);
        }
    }

    public function verifyAdminCode(Request $request)
    {
        $request->validate([
            'admin_user_id' => ['required', 'exists:datos_usuario,id'],
            'verification_code' => ['required', 'string', 'min:6', 'max:6'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userId = $request->input('admin_user_id');
        $code = $request->input('verification_code');
        $password = $request->input('password');

        $verificationEntry = AdminVerificationCode::where('user_id', $userId)
            ->where('code', $code)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verificationEntry) {
            return back()->withErrors(['verification_code' => 'El código de verificación es inválido o ha expirado.'])->withInput($request->except('password'));
        }

        $adminUser = DatoUsuario::find($userId);

        if (!$adminUser) {
            return back()->withErrors(['admin_user_id' => 'El usuario a verificar no fue encontrado.'])->withInput($request->except('password'));
        }

        $adminUser->update([
            'is_verified' => true,
            'password' => Hash::make($password),
        ]);
        $verificationEntry->delete();

        Auth::login($adminUser);

        return redirect()->route('admin.dashboard')->with('success', '¡Cuenta de administrador verificada y creada exitosamente!');
    }

    /**
     * Muestra el formulario para solicitar el restablecimiento de contraseña (paso 1).
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Envía el token de restablecimiento de contraseña al correo del usuario (paso 1).
     */
    public function sendResetToken(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'exists:datos_usuario,email']]);

        $user = DatoUsuario::where('email', $request->email)->first();

        if (!$user) {
            // Esto no debería ejecutarse gracias a la validación 'exists', pero es una capa extra.
            return back()->withErrors(['email' => 'No se encontró un usuario con ese correo electrónico.']);
        }

        // Generar un token único
        $token = Str::random(10); // Token más largo para mayor seguridad
        $expiresAt = Carbon::now()->addMinutes(20); // El token expira en 60 minutos

        try {
            // Eliminar cualquier token anterior para este email
            DB::table('password_resets')->where('email', $user->email)->delete();

            // Guardar el nuevo token en la tabla password_resets
            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => Hash::make($token), // Hashear el token para guardarlo, se compara sin hashear en el mail
                'created_at' => Carbon::now()
            ]);

            // Enviar el correo electrónico con el token
            Mail::to($user->email)->send(new PasswordResetRequestMail($token, $user->nombre));

            return redirect()->route('password.reset.form')->with([
                'status' => 'Se ha enviado un código de restablecimiento a tu correo electrónico. Por favor, revísalo para continuar.',
                'email' => $user->email // Pasamos el email para el siguiente formulario
            ]);
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar enviar el token. Por favor, inténtalo de nuevo más tarde.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al enviar el correo de restablecimiento.']);
        }
    }

    /**
     * Muestra el formulario para restablecer la contraseña (paso 2).
     */
    public function showResetPasswordForm(Request $request)
    {
        // El email se flashea desde sendResetToken, o se usa old() si hay errores
        $email = session('email') ?? old('email');

        // Opcional: Validar si viene con un token en la URL, pero no es estrictamente necesario si se maneja por sesión/entrada de usuario
        return view('auth.reset-password', compact('email')); // Crearemos esta vista
    }

    /**
     * Restablece la contraseña del usuario (paso 2).
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:datos_usuario,email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DatoUsuario::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'El correo electrónico no es válido.'])->withInput($request->except('password', 'password_confirmation', 'old_password'));
        }

        // Verificar el token
        $passwordReset = DB::table('password_resets')->where('email', $request->email)->first();

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['token' => 'El código de verificación es inválido o ya ha sido utilizado.'])->withInput($request->except('password', 'password_confirmation', 'old_password'));
        }

        // Verificar si el token ha expirado (usando created_at y el tiempo de expiración)
        $expiresAt = Carbon::parse($passwordReset->created_at)->addMinutes(60);
        if (Carbon::now()->greaterThan($expiresAt)) {
            DB::table('password_resets')->where('email', $request->email)->delete(); // Eliminar token expirado
            return back()->withErrors(['token' => 'El código de verificación ha expirado. Por favor, solicita uno nuevo.'])->withInput($request->except('password', 'password_confirmation', 'old_password'));
        }

        // 3. Si todo es válido, actualizar la contraseña
        try {
            $user->password = Hash::make($request->password);
            $user->save();

            // Eliminar el token de la tabla password_resets
            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('login')->with('success', '¡Tu contraseña ha sido restablecida exitosamente! Inicia sesión con tu nueva contraseña.');
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar restablecer tu contraseña. Por favor, inténtalo de nuevo más tarde.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al restablecer tu contraseña.']);
        }
    }


    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Has cerrado sesión correctamente.');
    }
}
