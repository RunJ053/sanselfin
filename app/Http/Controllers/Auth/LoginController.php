<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DatoUsuario;
use App\Models\Notificacion;
use App\Models\CarritoCompra;
use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\DatoUsuario;
use App\Models\Notificacion;
use App\Models\CarritoCompra;
use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\DetallePedido;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()) {
            return redirect()->route('user.dashboard');
        }


        return view("auth.login");
    }

    public function myProfile()
    public function myProfile()
    {
        if (!Auth::check()) {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debe iniciar sesión primero']);
        }

        $usuarioId = Auth::id();
        $usuario = DatoUsuario::with(['tipoDocumento', 'genero', 'datoslocalidad'])->find($usuarioId);

        if (!$usuario) {
            return redirect()->route('login')->withErrors(['login_error' => 'Usuario no encontrado. Por favor, inicie sesión de nuevo.']);
        }

        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        $pedidosMensuales = Pedido::where('usuario', $usuarioId)
            ->whereMonth('fecha', $mesActual)
            ->whereYear('fecha', $anioActual)
            ->count();

        $gastoMensual = Pedido::where('usuario', $usuarioId)
            ->whereMonth('fecha', $mesActual)
            ->whereYear('fecha', $anioActual)
            ->sum('total');

        $promedioGasto = Pedido::where('usuario', $usuarioId)
            ->whereMonth('fecha', $mesActual)
            ->whereYear('fecha', $anioActual)
            ->avg('total');

        $pedidosUsuario = Pedido::with('detalles.producto', 'estado')
            ->where('usuario', $usuarioId)
            ->orderBy('created_at', 'desc')
            ->get();

        $notificaciones = Notificacion::where('usuario_id', $usuarioId)
            ->orderBy('created_at', 'desc')
            ->get();

        $carritoCount = CarritoCompra::where('usuario', $usuarioId)->count('cantidad');

        $detallePedidos = DetallePedido::whereIn('pedidos', $pedidosUsuario->pluck('id'))->get();

        $ultimosPedidos = Pedido::with(['detalles.producto', 'estado'])
            ->where('usuario', $usuarioId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('user.perfil', compact(
            'usuario',
            'notificaciones',
            'pedidosMensuales',
            'gastoMensual',
            'promedioGasto',
            'pedidosUsuario',
            'carritoCount',
            'ultimosPedidos',
        ));
    }
}
