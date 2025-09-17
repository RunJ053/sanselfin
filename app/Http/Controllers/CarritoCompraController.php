<?php

namespace App\Http\Controllers;

use App\Models\CarritoCompra;
use App\Models\Producto;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CarritoCompraController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }

        $userId = Auth::id();

        // Traer carrito con producto, impuestos y promociones
        $itemsCarrito = CarritoCompra::with(['producto.promociones'])
            ->where('usuario', $userId)
            ->get();

        // Inicializar acumuladores
        $subtotal = 0;
        $descuento = 0;
        $totalFinal = 0;
        $sub = 0;

        // Recorrer items del carrito y sumar lo que ya está calculado en la BD
        foreach ($itemsCarrito as $item) {
            $subtotal += $item->subtotal;
            $descuento += $item->descuento;
            $totalFinal += $item->total_item;

            // Calcular el precio con impuesto para este item
            $producto = $item->producto;
        }

        // Notificaciones
        $notificaciones = Notificacion::where('usuario_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $carritoCount = CarritoCompra::where('usuario', $userId)->count('cantidad');
        $totalConDescuento = $totalFinal;

        return view('productos.carrito_de_comprar', compact(
            'itemsCarrito',
            'subtotal',
            'descuento',
            'totalFinal',
            'totalConDescuento',
            'notificaciones',
            'carritoCount'
        ));
    }

    public function add(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        if (!Auth::check()) {
            return response()->json(['message' => 'Debe iniciar sesión para añadir productos al carrito.'], 401);
        }

        $userId     = Auth::id();
        $productoId = $request->input('producto_id');
        $cantidad   = $request->input('cantidad');

        try {
            $producto = Producto::with(['promociones'])->find($productoId);
            if (!$producto) {
                return response()->json(['message' => 'Producto no encontrado.'], 404);
            }

            // Ítem existente en carrito
            $itemExistente = CarritoCompra::where('usuario', $userId)
                ->where('producto_id', $productoId)
                ->first();

            $cantidadActualCarrito = $itemExistente ? $itemExistente->cantidad : 0;
            $cantidadFinal = $cantidadActualCarrito + $cantidad;

            // Stock
            if ($cantidadFinal > $producto->stock) {
                return response()->json([
                    'message' => "No puedes añadir más de {$producto->stock} unidades al carrito. Ya tienes {$cantidadActualCarrito} en el carrito.",
                    'status'  => 'error',
                ], 400);
            }

            // ---- Cálculos ----
            $precioUnitario = $producto->precio_unitario;

            // 1) Subtotal base (sin impuesto)
            $subtotalBase = $precioUnitario * $cantidadFinal;

            // 2) Descuento
            $porcPromo = 0;
            if ($producto->promociones) {
                $porcPromo = $producto->promociones->porcentaje_descuento
                    ?? $producto->promociones->descuento
                    ?? 0;
            }
            $descuentoAplicado = round($subtotalBase * ($porcPromo / 100), 2);

            // 3) Total item
            $totalItem = round($subtotalBase - $descuentoAplicado, 2);

            if ($itemExistente) {
                $itemExistente->cantidad            = $cantidadFinal;
                $itemExistente->precio_unitario     = $precioUnitario;
                $itemExistente->subtotal            = round($precioUnitario * $cantidadFinal, 2);
                $itemExistente->descuento           = $descuentoAplicado;
                $itemExistente->total_item          = $totalItem;
                $itemExistente->save();
            } else {
                CarritoCompra::create([
                    'usuario'            => $userId,
                    'producto_id'        => $productoId,
                    'cantidad'           => $cantidadFinal,
                    'precio_unitario'    => $precioUnitario,
                    'subtotal'           => round($precioUnitario * $cantidadFinal, 2),
                    'descuento'          => $descuentoAplicado,
                    'total_item'         => $totalItem,
                ]);
            }

            $cartCount = CarritoCompra::where('usuario', $userId)->sum('cantidad');

            return response()->json([
                'message'    => 'Producto añadido al carrito exitosamente.',
                'cart_count' => $cartCount,
                'status'     => 'success',
            ]);
        } catch (\Exception $e) {
            \Log::error("Error al añadir producto al carrito: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Error al añadir el producto al carrito.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function getCartCount()
    {
        if (!Auth::check()) {
            return response()->json(['cart_count' => 0]);
        }
        $userId = Auth::id();
        $cartCount = CarritoCompra::where('usuario', $userId)->sum('cantidad');
        return response()->json(['cart_count' => $cartCount]);
    }

    public function update(Request $request, $itemId)
    {
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

        $producto = Producto::with(['promociones'])->find($item->producto_id);
        if (!$producto) {
            return response()->json(['message' => 'Producto asociado no encontrado.'], 404);
        }

        $cantidadSolicitada = (int) $request->input('cantidad');
        if ($cantidadSolicitada > $producto->stock) {
            return response()->json([
                'message' => "No puedes actualizar. Solo hay {$producto->stock} unidades disponibles."
            ], 422);
        }

        // ---- Cálculos ----
        $precioUnitario = $producto->precio_unitario;

        $subtotalBase = $precioUnitario * $cantidadSolicitada;

        $porcPromo = 0;
        if ($producto->promociones) {
            $porcPromo = $producto->promociones->porcentaje_descuento
                ?? $producto->promociones->descuento
                ?? 0;
        }
        $descuentoAplicado = round($subtotalBase * ($porcPromo / 100), 2);

        $totalItem = round($subtotalBase - $descuentoAplicado, 2);

        $item->cantidad            = $cantidadSolicitada;
        $item->precio_unitario     = $precioUnitario;
        $item->subtotal            = round($subtotalBase, 2);
        $item->descuento           = $descuentoAplicado;
        $item->total_item          = $totalItem;
        $item->save();

        return response()->json([
            'message'            => 'Cantidad actualizada exitosamente ✅',
            'cantidad'           => $item->cantidad,
            'precio_unitario'    => number_format($item->precio_unitario, 2, ',', '.'),
            'subtotal'           => number_format($item->subtotal, 2, ',', '.'),
            'descuento'          => number_format($item->descuento, 2, ',', '.'),
            'total_item'         => number_format($item->total_item, 2, ',', '.'),
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

    public function vaciar(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para vaciar tu carrito.');
        }

        $usuarioId = Auth::id();

        try {
            CarritoCompra::where('usuario', $usuarioId)->delete();

            return redirect()->back()->with('success', '🛒 Carrito vaciado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Hubo un problema al vaciar el carrito, intenta de nuevo.');
        }
    }
}
