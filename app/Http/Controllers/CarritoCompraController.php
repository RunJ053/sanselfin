<?php

namespace App\Http\Controllers;

use App\Models\CarritoCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoCompraController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }
        $userId = Auth::id();
        $itemsCarrito = CarritoCompra::with('producto')->where('usuario', $userId)->get();
        // Calculamos subtotal en base a los ítems 
        $subtotal = $itemsCarrito->sum('subtotal');
        //calcular impuestos 
        $impuestoCalculado = $itemsCarrito->sum('impuesto_calculado');
        // Calcular el total
        $total = $subtotal + $impuestoCalculado;
        return view('productos.carrito_de_comprar', compact('itemsCarrito', 'subtotal', 'impuestoCalculado','total'));
    }



    /**
     * Añade un producto al carrito de compras.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        if (!Auth::check()) {
            return response()->json(['message' => 'Debe iniciar sesión para añadir productos al carrito.'], 401);
        }

        $userId = Auth::id();
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad');

        try {
            $producto = Producto::with('impuestos', 'promociones')->find($productoId);
            if (!$producto) {
                return response()->json(['message' => 'Producto no encontrado.'], 404);
            }

            // Precio con posible descuento
            $precioUnitario = $producto->precio_unitario;

            // Aplicar descuento si existe
            if ($producto->promociones && $producto->promociones->porcentaje_descuento > 0) {
                $precioUnitario = $precioUnitario * (1 - ($producto->promociones->porcentaje_descuento / 100));
            }

            $subtotal = $precioUnitario * $cantidad;
            // Obtener tods los ivas en la tabla de impuestos

            // Buscar IVA relacionado
            $ivaPorcentaje = $producto->impuestos ? $producto->impuestos->porcentaje : 0;
            $impuestoCalculado = ($subtotal * $ivaPorcentaje) / 100;
            $totalItem = $subtotal + $impuestoCalculado;

            $itemExistente = CarritoCompra::where('usuario', $userId)->where('producto_id', $productoId)->first();

            if ($itemExistente) {
                $itemExistente->cantidad += $cantidad;
                $itemExistente->subtotal = $itemExistente->precio_unitario * $itemExistente->cantidad;
                $itemExistente->impuesto_calculado = ($itemExistente->subtotal * $ivaPorcentaje) / 100;
                $itemExistente->total_item = $itemExistente->subtotal + $itemExistente->impuesto_calculado;
                $itemExistente->save();
            } else {
                CarritoCompra::create([
                    'usuario' => $userId,
                    'producto_id' => $productoId,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioUnitario,
                    'subtotal' => $subtotal,
                    'impuesto_calculado' => $impuestoCalculado,
                    'total_item' => $totalItem,
                ]);
            }

            $cartCount = CarritoCompra::where('usuario', $userId)->sum('cantidad');

            return response()->json([
                'message' => 'Producto añadido al carrito exitosamente.',
                'cart_count' => $cartCount,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al añadir el producto al carrito.'], 500);
        }
    }


    /**
     * Obtiene el conteo total de ítems en el carrito del usuario autenticado.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartCount()
    {
        if (!Auth::check()) {
            return response()->json(['cart_count' => 0]); // O podrías devolver 401 si prefieres
        }
        $userId = Auth::id();
        $cartCount = CarritoCompra::where('usuario', $userId)->sum('cantidad');
        return response()->json(['cart_count' => $cartCount]);
    }

    public function update(Request $request, $itemId)
    {
        // Validar que la cantidad sea al menos 1
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ], [
            'cantidad.min' => 'La cantidad debe ser al menos 1.'
        ]);

        $item = CarritoCompra::where('id', $itemId)
            ->where('usuario', Auth::id())
            ->first();

        if (!$item) {
            return response()->json(['message' => 'Producto en el carrito no encontrado.'], 404);
        }

        $producto = Producto::find($item->producto_id);
        if (!$producto) {
            return response()->json(['message' => 'Producto asociado no encontrado.'], 404);
        }

        // 🔹 Validar stock disponible
        $cantidadSolicitada = $request->input('cantidad');
        if ($cantidadSolicitada > $producto->stock) {
            return response()->json([
                'message' => "No puedes actualizar. Solo hay {$producto->stock} unidades disponibles."
            ], 422);
        }

        // ✅ Actualizar cantidad y subtotal
        $item->cantidad = $cantidadSolicitada;
        $item->subtotal = $producto->precio_unitario * $item->cantidad;
        // Recalcular impuesto_calculado y total_item
        $ivaPorcentaje = $producto->impuestos ? $producto->impuestos->porcentaje : 0;
        $item->impuesto_calculado = ($item->subtotal * $ivaPorcentaje) / 100;
        $item->total_item = $item->subtotal + $item->impuesto_calculado;
        $item->save();

        return response()->json([
            'message' => 'Cantidad actualizada exitosamente ✅',
            'cantidad' => $item->cantidad,
            'subtotal' => number_format($item->subtotal, 0, ',', '.'),
            'impuesto_calculado' => number_format($item->impuesto_calculado, 0, ',', '.'),
            'total_item' => number_format($item->total_item, 0, ',', '.')
        ]);
    }

    public function remove($itemId)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Usuario no autenticado.'], 401);
        }

        $item = CarritoCompra::where('id', $itemId)->where('usuario', Auth::id())->first();

        if (!$item) {
            return response()->json(['message' => 'Producto en el carrito no encontrado o no autorizado.'], 404);
        }

        try {
            $item->delete();
            $cartCount = CarritoCompra::where('usuario', Auth::id())->sum('cantidad');

            return response()->json([
                'message' => 'Producto eliminado del carrito 🗑️',
                'cart_count' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el producto del carrito.'], 500);
        }
    }
}
