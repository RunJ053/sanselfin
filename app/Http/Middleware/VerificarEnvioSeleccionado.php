<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarEnvioSeleccionado
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Si no existe la opción de envío en sesión, redirigir
        if (!session()->has('opcion_entrega')) {
            return redirect()
                ->route('seleccionar_destino')
                ->with('error', 'Debes seleccionar una opción de envío antes de continuar al pago.');
        }

        return $next($request);
    }
}

