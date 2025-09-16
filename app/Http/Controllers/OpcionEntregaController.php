<?php

namespace App\Http\Controllers;

use App\Models\OpcionEntrega;
use App\Models\CarritoCompra;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class OpcionEntregaController extends Controller
{


    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }

        $userId = Auth::id();

        // Carrito del usuario
        $itemsCarrito = CarritoCompra::with('producto')->where('usuario', $userId)->get();

        // Opciones de envío con su estado
        $destino = OpcionEntrega::where('estado_id', 1)->with('estado')->get();

        // Dirección del usuario logueado
        $direccionUsuario = Auth::user()->direccion;

        // Inicializar acumuladores
        $subtotal = 0;
        $descuento = 0;
        $total = 0;
        $sub = 0;

        // Recorrer items del carrito y sumar lo que ya está calculado en la BD
        foreach ($itemsCarrito as $item) {
            $subtotal += $item->subtotal;                 // subtotal ya viene con precio_unitario * cantidad
            $descuento += $item->descuento;               // lo calculaste en add/update
            $total += $item->total_item;             // subtotal - descuento
        }
        // * Mostar notificaciones pendientes
        $notificaciones = Notificacion::where('usuario_id', auth()->id())->orderBy('created_at', 'desc')->get();

        $carritoCount = CarritoCompra::where('usuario', $userId)->count('cantidad'); 

        return view(
            'facturacion.opcionEnvio',
            compact(
                'itemsCarrito',
                'destino',
                'direccionUsuario',
                'subtotal',
                'total',
                'notificaciones',
                'carritoCount'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'destino_envio' => 'required|exists:opciones_entrega,id',
        ]);

        $destino = OpcionEntrega::find($request->destino_envio);

        // Total de productos calculado desde el carrito
        $totalProductos = CarritoCompra::where('usuario', auth()->id())
            ->sum('total_item');

        $total = $totalProductos + $destino->costo;

        // Guardar en sesión
        session([
            'opcion_entrega' => [
                'id' => $destino->id,
                'nombre' => $destino->nombre_opcion,
                'costo' => $destino->costo,
                'descripcion' => $destino->descripcion,
            ],
            'total_final' => $total
        ]);

        return redirect()->route('forma_de_pago')->with('success', 'Opción de envío seleccionada correctamente.');
        $request->validate([
            'destino_envio' => 'required|exists:opciones_entrega,id',
        ]);

        $destino = OpcionEntrega::find($request->destino_envio);

        // Total de productos calculado desde el carrito
        $totalProductos = CarritoCompra::where('usuario', auth()->id())
            ->sum(DB::raw('(subtotal - COALESCE(descuento,0)) + impuesto_calculado'));

        $total = $totalProductos + $destino->costo;

        // Guardar en sesión
        session([
            'opcion_entrega' => [
                'id' => $destino->id,
                'nombre' => $destino->nombre_opcion,
                'costo' => $destino->costo,
                'descripcion' => $destino->descripcion,
            ],
            'total_final' => $total
        ]);

        return redirect()->route('forma_de_pago')->with('success', 'Opción de envío seleccionada correctamente.');
    }
}
