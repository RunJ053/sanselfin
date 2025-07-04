<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function indexUsuarioPro(Request $request)
    {
        $query = Producto::with(['categoria', 'descuento']);

        // Filtrar por categoría
        if ($request->has('categoria') && $request->categoria !== 'all') {
            $categoriaNombre = $request->categoria;
            $categoria = Categoria::where('nombre', $categoriaNombre)->first();
            if ($categoria) {
                $query->where('categoria_id', $categoria->id);
            }
        }

        // Buscar por nombre o descripción
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nombre_producto', 'like', '%' . $searchTerm . '%')
                  ->orWhere('descripccion', 'like', '%' . $searchTerm . '%');
            });
        }

        $productos = $query->get()->map(function ($producto) {
            $precioUnitario = $producto->precio_unitario;
            if ($producto->descuento && $producto->descuento->porcentaje_descuento > 0) {
                $precioUnitario = $precioUnitario * (1 - ($producto->descuento->porcentaje_descuento / 100));
            }

            return [
                'id' => $producto->id,
                'nombre' => $producto->nombre_producto,
                'descripcion' => $producto->descripccion,
                'valor' => '$' . number_format($precioUnitario, 0, ',', '.'), // Precio con descuento
                'precio_base' => $producto->precio_unitario,
                'imagen' => 'https://via.placeholder.com/400x300?text=' . urlencode($producto->nombre_producto),
                'categoria' => $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría',
                'rating' => rand(3, 5), // Asumiendo que rating es dinámico o un campo en DB
                'descuento' => $producto->descuento_id !== null,
                'descuento_porcentaje' => $producto->descuento ? $producto->descuento->porcentaje_descuento : 0,
            ];
        });

        $categorias = Categoria::all(); // Asegúrate de cargar todas las categorías para el sidebar

        // Determinar si la solicitud es AJAX (para cargar solo los productos)
        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.productos_list', ['productos' => $productos, 'searchTerm' => $request->search, 'currentFilter' => $request->categoria])->render(),
                'productCount' => $productos->count()
            ]);
        }

        return view('producto', [
            'productos' => $productos,
            'categoriaId' => $categorias, // Renombrado a 'categorias' para mayor claridad
            'currentCategory' => $request->categoria ?? 'all',
            'searchTerm' => $request->search ?? ''
        ]);
    }

    /**
     * Obtiene los detalles de un producto específico para el modal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showProductDetails($id)
    {
        $producto = Producto::with(['categoria', 'descuento'])->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $precioUnitario = $producto->precio_unitario;
        if ($producto->descuento && $producto->descuento->porcentaje_descuento > 0) {
            $precioUnitario = $precioUnitario * (1 - ($producto->descuento->porcentaje_descuento / 100));
        }

        return response()->json([
            'id' => $producto->id,
            'nombre' => $producto->nombre_producto,
            'descripcion' => $producto->descripccion,
            'valor' => '$' . number_format($precioUnitario, 0, ',', '.'),
            'precio_base' => $producto->precio_unitario,
            'imagen' => 'https://via.placeholder.com/400x300?text=' . urlencode($producto->nombre_producto),
            'categoria' => $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría',
            'rating' => rand(3, 5),
            'descuento' => $producto->descuento_id !== null,
            'descuento_porcentaje' => $producto->descuento ? $producto->descuento->porcentaje_descuento : 0,
        ]);
    }

    // El método show ya no es necesario si no lo usas para API
    // public function show($id) { ... }
}