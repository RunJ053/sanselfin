<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['usuarios', 'detalles.producto', 'estado'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pedidos', compact('pedidos'));
    }
    public function cambiarEstado(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado_id' => 'required|exists:estados,id'
        ]);

        $pedido->estado_id = $request->estado_id;
        $pedido->save();

        return redirect()->back()->with('success', 'Estado del pedido actualizado correctamente.');
    }

}
