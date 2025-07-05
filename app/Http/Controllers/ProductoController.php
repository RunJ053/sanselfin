<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Impuesto;
use Illuminate\Support\Str;
use App\Models\Promocion;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $inventarios = Producto::with(['categorias', 'impuestos', 'promociones'])->get();
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();
        $promociones = Promocion::all();

        return view('admin.inventario', compact('inventarios', 'categorias', 'impuestos', 'promociones'));
    }


    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
    $inventarios = Producto::all(); // O el modelo que corresponda
    $categorias = Categoria::all();
    $impuestos = Impuesto::all();
    $promociones = Promocion::all();


    return view('admin.new_producto', compact('inventarios', 'categorias', 'impuestos', 'promociones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $prod = new Producto;

        $prod->nombre_producto = $request->nombre;
        $prod->categoria_id = $request->Categoria;
        $prod->descripccion = $request->descripcion;
        $prod->precio_unitario = $request->valor_unitario;
        $prod->impuesto_id = $request->Impuesto;
        $prod->descuento_id = $request->Promocion;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = Str::slug($prod->nombre_producto) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/product'), $filename);
            $prod->imagen = $filename;
        }

        $prod->save();

        return redirect()->route('producto.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

      public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();
        $promociones = Promocion::all();

        return view('admin.edit_produc', compact('producto', 'categorias', 'impuestos', 'promociones'));
    }

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
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
    public function update(Request $request, Producto $producto)
    {
        $producto->nombre_producto = $request->nombre;
        $producto->descripccion = $request->descripcion;
        $producto->precio_unitario = $request->valor_unitario;
        $producto->categoria_id = $request->Categoria;
        $producto->impuesto_id = $request->Impuesto;
        $producto->descuento_id = $request->Promocion;

        if ($request->hasFile('imagen')) {
                // Eliminar archivo anterior si existe
                if ($producto->imagen && file_exists(public_path('img/product/' . $producto->imagen))) {
                    unlink(public_path('img/product/' . $producto->imagen));
                }
                $archivo = $request->file('imagen');
                $nombreArchivoDoc = Str::slug($request->nombre . '-' . $request->Categoria) . "-imagen-" . time() . "." . $archivo->guessExtension();
                $ruta = public_path('img/product/');
                $archivo->move($ruta, $nombreArchivoDoc);
                $producto->imagen = $nombreArchivoDoc; // Usar el campo correcto de tu modelo
            }
        $producto->save();

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('inventario.index')
                        ->with('success', 'Producto eliminado correctamente.');
    }
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