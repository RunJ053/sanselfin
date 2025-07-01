<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TipoCliente;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == TipoCliente::ROLE_ADMINISTRADOR && Auth::user()->is_verified) {
            return $next($request);
        }

        Auth::logout();
        return redirect('/incio_sesion')->withErrors('No tienes permisos de administrador o tu cuenta no ha sido verificada.');
    }
}
