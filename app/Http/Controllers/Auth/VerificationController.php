<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserVerificationCode;
use App\Models\DatoUsuario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserVerificationMail;
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
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function verifyUser(string $token)
    {
        $verificationEntry = UserVerificationCode::where('token', $token)->first();
        $error_message = '';
        $redirect_to = '/login';

        // Si el token es inválido o ha expirado
        if (!$verificationEntry || Carbon::now()->greaterThan($verificationEntry->expires_at)) {
            $error_message = 'El enlace de verificación es inválido o ha expirado. Por favor, solicita un nuevo enlace si es necesario.';

            // Retorna la vista de error
            return view('errors.verification-error', [
                'error_message' => $error_message,
                'redirect_to' => $redirect_to,
            ]);
        }

        $user = $verificationEntry->user;

        // Si el usuario ya está verificado
        if ($user->is_verified) {
            $verificationEntry->delete();
            $error_message = 'Tu cuenta ya está verificada. Por favor, inicia sesión para continuar.';

            // Retorna la vista de error
            return view('errors.verification-error', [
                'error_message' => $error_message,
                'redirect_to' => $redirect_to,
            ]);
        }

        // Si la verificación es exitosa
        $user->is_verified = true;
        $user->save();
        $verificationEntry->delete();
        Auth::login($user);

        // Redirige al dashboard del usuario con un mensaje de éxito
        return redirect()->route('user.dashboard')->with('success', '¡Tu correo ha sido verificado exitosamente! Bienvenido.');
    }
}
