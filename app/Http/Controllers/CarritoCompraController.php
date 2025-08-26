<?php

namespace App\Http\Controllers;

use App\Models\CarritoCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarritoCompraController extends Controller
{
    /**
     * Muestra los productos actualmente en el carrito del usuario autenticado.
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            // Si no está autenticado, puedes redirigirlo al login o devolver una respuesta de error.
            // Para el contexto de una API, es mejor devolver JSON.
            return response()->json(['message' => 'Usuario no autenticado.'], 401);
        }

        $userId = Auth::id();
        $itemsCarrito = CarritoCompra::with('producto')->where('usuario', $userId)->get();

        // Calcula el subtotal y el total
        $total = $itemsCarrito->sum('subtotal');

        // Retorna los datos como JSON para ser consumidos por tu vista del carrito
        return response()->json([
            'items' => $itemsCarrito,
            'total' => $total,
            'message' => 'Carrito cargado exitosamente.'
        ]);
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
            $producto = Producto::find($productoId);
            if (!$producto) {
                return response()->json(['message' => 'Producto no encontrado.'], 404);
            }

            $precioUnitario = $producto->precio_unitario;

            // VERIFICAR si el producto tiene una promoción y aplicar el descuento
            if ($producto->promociones && $producto->promociones->porcentaje_descuento > 0) {
                $precioUnitario = $precioUnitario * (1 - ($producto->promociones->porcentaje_descuento / 100));
            }

            $subtotal = $precioUnitario * $cantidad;

            $itemExistente = CarritoCompra::where('usuario', $userId)->where('producto_id', $productoId)->first();

            if ($itemExistente) {
                $itemExistente->cantidad += $cantidad;
                $itemExistente->subtotal = ($itemExistente->precio_unitario * $itemExistente->cantidad);
                $itemExistente->save();
            } else {
                CarritoCompra::create([
                    'usuario' => $userId,
                    'producto_id' => $productoId,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioUnitario,
                    'subtotal' => $subtotal,
                ]);
            }

            $cartCount = CarritoCompra::where('usuario', $userId)->sum('cantidad');

            return response()->json([
                'message' => 'Producto añadido al carrito exitosamente.',
                'cart_count' => $cartCount,
                'status' => 'success'
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al añadir el producto al carrito. Por favor, inténtelo de nuevo más tarde.'], 500);
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

    // Puedes añadir métodos para actualizar cantidad 
    
    public function update(Request $request, $itemId)
    {
        $request->validate(['cantidad' => 'required|integer|min:1']);

        $item = CarritoCompra::where('id', $itemId)->where('usuario', Auth::id())->first();

        if (!$item) {
            return response()->json(['message' => 'Producto en el carrito no encontrado.'], 404);
        }

        $producto = Producto::find($item->producto_id);
        if (!$producto) {
            return response()->json(['message' => 'Producto asociado no encontrado.'], 404);
        }

        $item->cantidad = $request->input('cantidad');
        $item->subtotal = $producto->valor * $item->cantidad;
        $item->save();

        return response()->json(['message' => 'Cantidad actualizada exitosamente.']);
    }
    
    //eliminar

/**
     * Elimina un producto del carrito.
     * @param  int  $itemId - El ID del ítem en la tabla carrito_compras.
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($itemId)
    {
        // Asegúrate de que el usuario esté autenticado y que el ítem pertenezca a él.
        if (!Auth::check()) {
            return response()->json(['message' => 'Usuario no autenticado.'], 401);
        }

        $item = CarritoCompra::where('id', $itemId)->where('usuario', Auth::id())->first();

        if (!$item) {
            // Si el ítem no existe o no pertenece al usuario actual, devuelve un 404.
            return response()->json(['message' => 'Producto en el carrito no encontrado o no autorizado.'], 404);
        }

        try {
            $item->delete();
            // Opcional: Actualizar el conteo del carrito después de eliminar
            $cartCount = CarritoCompra::where('usuario', Auth::id())->sum('cantidad');

            return response()->json([
                'message' => 'Producto eliminado del carrito.',
                'cart_count' => $cartCount // Envía el nuevo conteo del carrito
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el producto del carrito.'], 500);
        }
    }

}