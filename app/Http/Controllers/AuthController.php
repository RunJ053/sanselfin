<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Mail\AdminVerificationMail;
use App\Mail\PasswordResetRequestMail; // NUEVO: Importa la clase de correo para restablecimiento

use App\Models\DatoUsuario;
use App\Models\TipoCliente;
use App\Models\AdminVerificationCode;

use Illuminate\Support\Facades\DB; // NUEVO: Para interactuar con la tabla password_resets
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Asegúrate de que esta línea esté presente

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\RegisterAdminRequest;

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

        if (($user->role == TipoCliente::ROLE_ADMINISTRADOR || $user->role == TipoCliente::ROLE_SUPER_ADMIN) && !$user->is_verified) {
            return redirect()->back()->withErrors(['email' => 'Tu cuenta de administrador aún no ha sido verificada.']);
        }

        // Inicia sesión al usuario
        Auth::login($user);

        $request->session()->regenerate();

        // Redirigir según el rol (role)
        if ($user->role == TipoCliente::ROLE_ADMINISTRADOR || $user->role == TipoCliente::ROLE_SUPER_ADMIN) {
            return redirect()->route('admin.dashboard'); // Ruta para administradores
        }
        session(['usuario_id' => $user->id, 'nombre_usuario' => $user->nombre]);
        return redirect()->route('user.dashboard'); // Ruta para usuarios normales
    }

    /**
     * Maneja el registro de usuarios y administradores.
     */
    public function register(Request $request)
    {
        $selectedTipoUsuarioId = $request->input('tipo_usuario');

        // Validación del tipo de usuario
        if ($selectedTipoUsuarioId == TipoCliente::ROLE_ADMINISTRADOR || $selectedTipoUsuarioId == TipoCliente::ROLE_SUPER_ADMIN) {
            $validatedData = app(RegisterAdminRequest::class)->validated();
            return $this->registerAdmin($validatedData);
        } else {
            $validatedData = app(RegisterUserRequest::class)->validated();
            return $this->registerUser($validatedData);
        }
    }

    /**
     * Lógica para registrar un usuario normal.
     */
    protected function registerUser($data)
    {
        try {
            $datoUsuario = DatoUsuario::create([
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellido'],
                'direccion' => $data['direccion'],
                'email' => $data['email'],
                'edad' => $data['fecha_nac'],
                'password' => Hash::make($data['password']),
                'localidad' => $data['direccion'],
                'role' => $data['role'],
                'is_verified' => $data['is_verified'],

                // ¡AÑADE ESTOS CAMPOS CON VALORES!
                'pregunta_seguridad' => null,
                'respuesta_seguridad' => null,
                'tipo_docu' => null,
                'tipo_de_genero' => null,
                'documento' => null,
                'telefono' => null,
                'nom_imgs' => null,
                'user_img' => null,
            ]);

            if ($datoUsuario) {
                Auth::login($datoUsuario);
                session(['usuario_id' => $datoUsuario->id, 'nombre_usuario' => $datoUsuario->nombre]);
                return redirect()->route('user.index2')->with('success', '¡Registro exitoso! Bienvenido.');
            } else {
                return back()->withInput()->withErrors(['database_error' => 'No se pudo crear el usuario.']);
            }
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar registrarte. Por favor, inténtalo de nuevo más tarde.']);
        } catch (\Exception $e) { // Captura cualquier otra excepción
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al registrarte.']);
        }
    }

    /**
     * Lógica para registrar un administrador (requiere verificación por correo).
     */
    protected function registerAdmin(array $data)
    {
        try {
            // Verifica si el correo ya está registrado
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
                'password' => null, // La contraseña se establecerá después de la verificación
                'localidad' => $data['direccion'],

                // ¡AÑADE ESTOS CAMPOS CON VALORES!
                'pregunta_seguridad' => null,
                'respuesta_seguridad' => null,
                'tipo_docu' => null, 
                'tipo_de_genero' => null, 
                'documento' => null,
                'telefono' => null,
                'nom_imgs' => null,
                'user_img' => null,
            ]);

            if (!$datoUsuario) {
                return back()->withInput()->withErrors(['database_error' => 'No se pudo crear el usuario administrador.']);
            }
            // Genera un código de verificación único
            $code = Str::random(6);
            $expiresAt = Carbon::now()->addMinutes(30);

            // Guarda el código en la tabla admin_verification_codes
            $verificationCodeEntry = AdminVerificationCode::create([
                'user_id' => $datoUsuario->id,
                'code' => $code,
                'expires_at' => $expiresAt,
            ]);

            if (!$verificationCodeEntry) {
                // Considera eliminar el DatoUsuario recién creado si falla la creación del código
                $datoUsuario->delete();
                return back()->withInput()->withErrors(['database_error' => 'No se pudo guardar el código de verificación.']);
            }
            // Envía el correo electrónico con el código al admin predefinido
            $adminEmailForVerification = 'josezapataaguirre@gmail.com';
            Mail::to($adminEmailForVerification)->send(new AdminVerificationMail($code, $datoUsuario->nombre));

            // Redirige de vuelta al formulario de registro y muestra el modal de verificación
            return redirect()->back()->with([
                'openAdminVerificationModal' => true,
                'admin_user_id' => $datoUsuario->id,
                'message' => 'Se ha enviado un código de verificación al correo del administrador. Por favor, introdúcelo para completar el registro.',
            ]);
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['database_error' => 'Hubo un error al intentar registrarte. Por favor, inténtalo de nuevo más tarde.']);
        } catch (\Exception $e) { // Captura cualquier otra excepción
            return back()->withInput()->withErrors(['general_error' => 'Hubo un error inesperado al registrarte.']);
        }
    }

    /**
     * Verifica el código de administrador.
     */
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

        // Si el código es válido, actualiza el usuario a verificado y establece la contraseña
        $adminUser = DatoUsuario::find($userId);

        if (!$adminUser) {
            return back()->withErrors(['admin_user_id' => 'El usuario a verificar no fue encontrado.'])->withInput($request->except('password'));
        }

        $adminUser->update([
            'is_verified' => true,
            'password' => Hash::make($password), // Guarda la contraseña
        ]);
        // Elimina el código de verificación de la base de datos
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