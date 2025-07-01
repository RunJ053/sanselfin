<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoCliente;
use App\Models\Localidad;
use App\Models\DatoUsuario; // ¡Importa el modelo DatoUsuario!
use App\Models\Genero; // ¡Importa el modelo Genero!
use App\Models\TipoDocumento; // ¡Importa el modelo TipoDocumento!

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()) {
            return redirect()->route('user.dashboard');
        }
        
        $tipo_clientes = TipoCliente::all();
        return view("auth.login", compact('tipo_clientes'));
    }

    public function myProfile()
    {
        if (Auth::check()) {
            $usuario = DatoUsuario::with(['tipoDocumento', 'genero', 'localidad'])->find(Auth::id());

            // Si por alguna razón el usuario autenticado no se encuentra en la DB (situación rara pero posible)
            if (!$usuario) {
                return redirect()->route('login')->withErrors(['login_error' => 'Usuario no encontrado. Por favor, inicie sesión de nuevo.']);
            }

            return view('user.perfil', compact('usuario'));
        } else {
            // Si no hay usuario autenticado, redirigir a la página de inicio de sesión
            return redirect()->route('login')->withErrors(['login_error' => 'Debe iniciar sesión primero']);
        }
    }
}