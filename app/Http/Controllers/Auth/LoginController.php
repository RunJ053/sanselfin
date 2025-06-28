<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoCliente;

class LoginController extends Controller
{
    

    public function index(Request $request)
    {
        // Aquí puedes manejar la lógica para mostrar el formulario de inicio de sesión
        // o redirigir a la página principal si ya está autenticado.
        if ($request->user()) {
            return redirect()->route('user.dashboard');
        }
        
        $tipo_clientes = TipoCliente::all();
        return view("auth.login", compact('tipo_clientes'));
    }

    public function myProfile()
    {
        if(Auth::check()) {
            $usuarioId = Auth::id();
            $usuario = Auth::user();

            return view('user.perfil', compact('usuario'));
        } else {
            // Si no hay usuario autenticado, redirigir a la página de inicio de sesión
            return redirect()->route('login')->withErrors(['login_error' => 'Debe iniciar sesión primero']);

        }
    }
}
