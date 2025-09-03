<?php

namespace App\Http\Controllers;

use App\Models\ResenaProducto;
use App\Models\Producto;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResenaProductoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Productos reseñados
        $resenas = ResenaProducto::with('producto')
            ->where('usuario_id', $userId)
            ->latest()
            ->get();

        // Productos comprados pero aún no reseñados
        $productosResenados = ResenaProducto::where('usuario_id', $userId)
            ->pluck('producto_id');

        $productosComprados = DB::table('facturas_detalles')
            ->join('facturas_cabeceras', 'facturas_detalles.factura_cabecera_id', '=', 'facturas_cabeceras.id')
            ->where('facturas_cabeceras.cliente_id', $userId) // 👈 el campo correcto del cliente
            ->pluck('facturas_detalles.producto_id');


        $productosPendientes = Producto::whereIn('id', $productosComprados)
            ->whereNotIn('id', $productosResenados)
            ->get();

        $notificaciones = Notificacion::where('usuario_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('review.index', compact('resenas', 'productosPendientes', 'notificaciones'));
    }

    public function store(Request $request, Producto $producto)
    {
        $userId = Auth::id();

        // ✅ Verificar que el usuario compró el producto
        $comprado = DB::table('facturas_detalles')
            ->join('facturas_cabeceras', 'facturas_detalles.factura_cabecera_id', '=', 'facturas_cabeceras.id')
            ->where('facturas_cabeceras.cliente_id', $userId)
            ->pluck('facturas_detalles.producto_id');

        if (!$comprado) {
            return redirect()->back()->with('error', 'Solo puedes reseñar productos que compraste.');
        }

        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string'
        ]);

        ResenaProducto::updateOrCreate(
            [
                'usuario_id' => $userId,
                'producto_id' => $producto->id,
            ],
            [
                'calificacion' => $request->calificacion,
                'comentario' => $request->comentario,
            ]
        );

        return redirect()->route('resenas.index')->with('success', 'Reseña guardada correctamente.');
    }

    public function edit(ResenaProducto $resena)
    {
        $this->authorize('update', $resena);

        $userId = Auth::id();

        $notificaciones = Notificacion::where('usuario_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('review.edit', compact('resena', 'notificaciones'));
    }

    public function update(Request $request, ResenaProducto $resena)
    {
        $this->authorize('update', $resena);

        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string'
        ]);

        $resena->update($request->only(['calificacion', 'comentario']));

        return redirect()->route('resenas.index')->with('success', 'Reseña actualizada.');
    }

    public function destroy(ResenaProducto $resena)
    {
        $this->authorize('delete', $resena);

        $resena->delete();

        return redirect()->route('resenas.index')->with('success', 'Reseña eliminada.');
    }
}
