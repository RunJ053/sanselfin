<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoCliente; // Asume que tienes un modelo para esto

class IsEmpleado
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == TipoCliente::ROLE_EMPLEADO) {
            return $next($request);
        }

        return redirect('/inicio_sesion')->with('error', 'Acceso denegado. No eres un empleado.');
    }
}