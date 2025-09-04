<?php

namespace App\Http\Controllers;

use App\Models\CarritoCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class CarritoCompraController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }

        $userId = Auth::id();

        // Traer carrito con producto, impuestos y promociones
        $itemsCarrito = CarritoCompra::with(['producto.impuestos', 'producto.promociones'])
            ->where('usuario', $userId)
            ->get();

        // Inicializar acumuladores
        $subtotal = 0;
        $impuestos = 0;
        $descuento = 0;
        $totalFinal = 0;
        $sub = 0;

        // Recorrer items del carrito y sumar lo que ya está calculado en la BD
        foreach ($itemsCarrito as $item) {
            $subtotal += $item->subtotal;                 // subtotal ya viene con precio_unitario * cantidad
            $impuestos += $item->impuesto_calculado;      // lo calculaste en add/update
            $descuento += $item->descuento;               // lo calculaste en add/update
            $totalFinal += $item->total_item;             // subtotal - descuento + impuesto
            $sub = $subtotal + $impuestos;

            // Calcular el precio con impuesto para este item
            $producto = $item->producto;
            $impuesto = $producto->impuestos ? $producto->impuestos->porcentaje : 0;
            $item->precioConImpuesto = $producto->precio_unitario + ($producto->precio_unitario * $impuesto / 100);
        }

        // Notificaciones
        $notificaciones = Notificacion::where('usuario_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $carritoCount = CarritoCompra::where('usuario', $userId)->count('cantidad'); 
        // Total con descuento ya aplicado
        $totalConDescuento = $totalFinal;

        return view('productos.carrito_de_comprar', compact(
            'itemsCarrito',
            'sub',
            'impuestos',
            'descuento',
            'totalFinal',
            'totalConDescuento',
            'notificaciones',
            'carritoCount'
        ));
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

        $userId     = Auth::id();
        $productoId = $request->input('producto_id');
        $cantidad   = $request->input('cantidad');

        try {
            $producto = Producto::with(['impuestos', 'promociones'])->find($productoId);
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

            // ---- Cálculos según tu orden ----
            $precioUnitario = $producto->precio_unitario;

            // 1) Subtotal base (sin impuesto)
            $subtotalBase = $precioUnitario * $cantidadFinal;

            // 2) Impuesto solo sobre el subtotal base
            $ivaPorcentaje = $producto->impuestos ? ($producto->impuestos->porcentaje ?? 0) : 0;
            $impuestoCalculado = round($subtotalBase * ($ivaPorcentaje / 100), 2);

            // 3) Subtotal + impuesto (para base del descuento)
            $subtotalMasImpuesto = $subtotalBase + $impuestoCalculado;

            // 4) Descuento (% viene de promociones; soporta 'porcentaje_descuento' o 'descuento')
            $porcPromo = 0;
            if ($producto->promociones) {
                $porcPromo = $producto->promociones->porcentaje_descuento
                    ?? $producto->promociones->descuento
                    ?? 0;
            }
            $descuentoAplicado = round($subtotalMasImpuesto * ($porcPromo / 100), 2);

            // 5) Total item = (subtotal + impuesto) - descuento
            $totalItem = round($subtotalMasImpuesto - $descuentoAplicado, 2);

            if ($itemExistente) {
                $itemExistente->cantidad            = $cantidadFinal;
                $itemExistente->precio_unitario     = $precioUnitario;         // base sin impuesto
                $itemExistente->subtotal            = round($precioUnitario * $cantidadFinal, 2);
                $itemExistente->impuesto_calculado  = $impuestoCalculado;
                $itemExistente->descuento           = $descuentoAplicado;      // descuento sobre (base+impuesto)
                $itemExistente->total_item          = $totalItem;              // (base+impuesto) - descuento
                $itemExistente->save();
            } else {
                // para nuevo ítem, cantidadFinal == cantidad
                CarritoCompra::create([
                    'usuario'            => $userId,
                    'producto_id'        => $productoId,
                    'cantidad'           => $cantidadFinal,
                    'precio_unitario'    => $precioUnitario,
                    'subtotal'           => round($precioUnitario * $cantidadFinal, 2),
                    'impuesto_calculado' => $impuestoCalculado,
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

        $producto = Producto::with(['impuestos', 'promociones'])->find($item->producto_id);
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

        // 1) Subtotal base (sin impuesto)
        $subtotalBase = $precioUnitario * $cantidadSolicitada;

        // 2) Impuesto solo sobre el subtotal base
        $ivaPorcentaje = $producto->impuestos ? ($producto->impuestos->porcentaje ?? 0) : 0;
        $impuestoCalculado = round($subtotalBase * ($ivaPorcentaje / 100), 2);

        // 3) Subtotal + impuesto
        $subtotalMasImpuesto = $subtotalBase + $impuestoCalculado;

        // 4) Descuento (sobre subtotal+impuesto)
        $porcPromo = 0;
        if ($producto->promociones) {
            $porcPromo = $producto->promociones->porcentaje_descuento
                ?? $producto->promociones->descuento
                ?? 0;
        }
        $descuentoAplicado = round($subtotalMasImpuesto * ($porcPromo / 100), 2);

        // 5) Total item
        $totalItem = round($subtotalMasImpuesto - $descuentoAplicado, 2);

        // Guardar
        $item->cantidad            = $cantidadSolicitada;
        $item->precio_unitario     = $precioUnitario;
        $item->subtotal            = round($subtotalBase, 2);
        $item->impuesto_calculado  = $impuestoCalculado;
        $item->descuento           = $descuentoAplicado;
        $item->total_item          = $totalItem;
        $item->save();

        return response()->json([
            'message'            => 'Cantidad actualizada exitosamente ✅',
            'cantidad'           => $item->cantidad,
            'precio_unitario'    => number_format($item->precio_unitario, 2, ',', '.'),
            'subtotal'           => number_format($item->subtotal, 2, ',', '.'),            // base
            'impuesto_calculado' => number_format($item->impuesto_calculado, 2, ',', '.'),
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
}
