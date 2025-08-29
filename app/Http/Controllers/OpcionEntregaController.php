<?php

namespace App\Http\Controllers;

use App\Models\OpcionEntrega;
use App\Models\CarritoCompra;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

        // Calculamos subtotal en base a los ítems 
        $subtotal = $itemsCarrito->sum('subtotal');
        //calcular impuestos 
        $impuestoCalculado = $itemsCarrito->sum('impuesto_calculado');
        // Calcular el total
        $total = $subtotal + $impuestoCalculado;

        return view('facturacion.opcionEnvio', compact('itemsCarrito', 'destino', 'direccionUsuario', 'subtotal', 'impuestoCalculado', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destino_envio' => 'required|exists:opciones_entrega,id',
        ]);

        $destino = OpcionEntrega::find($request->destino_envio);

        // Total de productos calculado desde el carrito
        $totalProductos = CarritoCompra::where('usuario', auth()->id())->sum(DB::raw('cantidad * precio_unitario'));

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
