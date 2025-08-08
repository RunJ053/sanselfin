<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminOrEmpleado
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado y si tiene el rol de administrador O empleado.
        if (Auth::check() && (Auth::user()->role === 2 || Auth::user()->role === 3) && Auth::user()->is_verified) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Acceso denegado. No tienes los permisos requeridos.');
    }
}