<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Usuario
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function index()
    {
        return view("user.login");
    }

    public function show(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Autenticación exitosa
            session(['usuario_id' => $usuario->id, 'nombre_usuario' => $usuario->nombre_usuario]);
            return redirect()->route('inicioAdmin');
        }

        return redirect()->back()->with('error', 'Credenciales incorrectas.')->withInput();
    }
}
