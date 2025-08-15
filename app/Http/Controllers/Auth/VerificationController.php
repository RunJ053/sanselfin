<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserVerificationCode;
use App\Models\DatoUsuario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /**
     * Muestra la vista para informar al usuario que revise su correo.
     *
     * @return \Illuminate\View\View
     */
    public function checkEmail()
    {
        return view('auth.check-email');
    }

    /**
     * Verifica al usuario usando el token del correo.
     *
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyUser(string $token)
    {
        // Busca el token en la base de datos
        $verificationEntry = UserVerificationCode::where('token', $token)->first();

        // Si no se encuentra el token o ha expirado...
        if (!$verificationEntry || Carbon::now()->greaterThan($verificationEntry->expires_at)) {
            return redirect('/login')->with('error', 'El enlace de verificación es inválido o ha expirado. Por favor, regístrate de nuevo.');
        }

        // Busca al usuario asociado
        $user = $verificationEntry->user;

        // Si el usuario ya está verificado, redirige
        if ($user->is_verified) {
            // Elimina la entrada del token para evitar reusos
            $verificationEntry->delete();
            return redirect('/login')->with('info', 'Tu cuenta ya está verificada. Por favor, inicia sesión.');
        }

        // Actualiza el estado de verificación del usuario
        $user->is_verified = true;
        $user->save();

        // Elimina la entrada del token para evitar reusos
        $verificationEntry->delete();

        // Inicia sesión con el usuario y redirige al dashboard
        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', '¡Tu correo ha sido verificado exitosamente! Bienvenido.');
    }
}
