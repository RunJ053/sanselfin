<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Impuesto;
use Illuminate\Support\Str;
use App\Models\Promocion;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'Categoria' => 'required|integer',
            'descripcion' => 'required|string',
            'valor_unitario' => 'required|numeric',
            'Impuesto' => 'required|integer',
            'Promocion' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear y guardar el nuevo producto
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

        // Crear y guardar el nuevo inventario
        $inventario = new Inventario;
        $inventario->producto_id = $prod->id;
        $inventario->nombre_producto = $prod->nombre_producto;
        $inventario->descripcion = $prod->descripccion;
        $inventario->stock = $request->cantidad; // Asignar la cantidad del formulario

        $inventario->save();

        return redirect()->route('producto.index');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $producto = Producto::findOrFail($producto->id);
        $inventario = Inventario::where('producto_id', $producto->id)->first();
        $impuestos = Impuesto::all();
        $promociones = Promocion::all();
        return view('admin.edit_produc', compact('producto', 'categorias', 'inventario', 'impuestos', 'promociones'));
    }
    /**
     * Display a listing of the resource for users.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexUsuarioPro(Request $request)
    {
        $perPage = 12;

        $query = Producto::with(['categorias', 'promociones']);

        // --- Filtrar por categoría ---
        if ($request->has('categoria') && $request->categoria !== 'all') {
            $categoriaNombre = $request->categoria;
            $categoria = Categoria::where('nombre', $categoriaNombre)->first();
            \Log::info('Filtrando por categoría', ['categoria' => $categoriaNombre, 'categoria_id' => $categoria->id ?? null]);
            if ($categoria) {
                $query->where('categoria_id', $categoria->id);
            } else {
                \Log::warning('Categoría no encontrada', ['categoria' => $categoriaNombre]);
            }
        }

        // --- Buscar por nombre o descripción ---
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nombre_producto', 'like', '%' . $searchTerm . '%')
                    ->orWhere('descripccion', 'like', '%' . $searchTerm . '%');
            });
        }

        // --- APLICAR LA PAGINACIÓN AQUÍ ---
        $productosPaginados = $query->paginate($perPage);
        
        $productosMapeados = $productosPaginados->getCollection()->map(function ($producto) {
            $precioUnitario = $producto->precio_unitario;

            // VERIFICA SIEMPRE QUE LA RELACIÓN EXISTE ANTES DE ACCEDER A SUS PROPIEDADES
            if ($producto->promociones && $producto->promociones->porcentaje_descuento > 0) {
                $precioUnitario = $precioUnitario * (1 - ($producto->promociones->porcentaje_descuento / 100));
            }

            $imagenPath = 'img/product/' . $producto->imagen;
            $imagenUrl = asset($imagenPath);

            // Agrega una comprobación para la existencia del archivo de imagen
            if (empty($producto->imagen) || !file_exists(public_path($imagenPath))) {
                $imagenUrl = asset('img/es_de_frutas_y_verduas_1.webp');
            }

            return [
                'id' => $producto->id,
                'nombre' => $producto->nombre_producto,
                'descripcion' => $producto->descripccion,
                'valor' => number_format($precioUnitario, 0, ',', '.'),
                'precio_base' => $producto->precio_unitario,
                'imagen' => $imagenUrl,
                'rating' => rand(3, 5),
                'descuento' => $producto->promociones && $producto->promociones->porcentaje_descuento > 0,
                'descuento_porcentaje' => $producto->promociones ? $producto->promociones->porcentaje_descuento : 0,
            ];
        });

        // Reinsertar la colección mapeada en el paginador
        $productosPaginados->setCollection($productosMapeados);

        $categorias = Categoria::all(); // Asegúrate de cargar todas las categorías para el sidebar

        // Determinar si la solicitud es AJAX (para cargar solo los productos)
        if ($request->ajax()) {
            $htmlProductos = view('partials.productos_list', [
                'productos' => $productosPaginados->items(),
                'searchTerm' => $request->search,
                'currentFilter' => $request->categoria
            ])->render();

            return response()->json([
                'html' => $htmlProductos,
                'productCount' => $productosPaginados->total(),
                'pagination' => (string) $productosPaginados->links()
            ]);
        }

        return view('producto', ['productos' => $productosPaginados,'categoriaId' => $categorias,'currentCategory' => $request->categoria ?? 'all','searchTerm' => $request->search ?? '']);
    }

    public function showProductDetails($id)
    {
        $producto = Producto::with(['categorias', 'promociones'])->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Aplicar descuento si existe
        $precioUnitario = $producto->precio_unitario;
        if ($producto->descuento && $producto->descuento->porcentaje_descuento > 0) {
            $precioUnitario = $precioUnitario * (1 - ($producto->descuento->porcentaje_descuento / 100));
        }

        $imagenPath = 'img/product/' . $producto->imagen; // Ruta esperada en public
        $imagenUrl = asset($imagenPath); // URL completa

        // Verificar si el archivo realmente existe en el servidor
        if (!file_exists(public_path($imagenPath))) {
            $imagenUrl = asset('img/es_de_frutas_y_verduas_1.webp');
        }

        return [
            'id' => $producto->id,
            'nombre' => $producto->nombre_producto,
            'descripcion' => $producto->descripccion,
            'valor' => '$' . number_format($precioUnitario, 0, ',', '.'),
            'precio_base' => $producto->precio_unitario,
            'imagen' => $imagenUrl,
            'categoria' => $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría',
            'rating' => rand(3, 5),
            'descuento' => $producto->descuento_id !== null,
            'descuento_porcentaje' => $producto->descuento ? $producto->descuento->porcentaje_descuento : 0,
        ];
    }


    /**
     * Obtiene los detalles de un producto específico para el modal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Producto $producto, Inventario $inventario)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'Categoria' => 'required|integer',
            'descripcion' => 'required|string',
            'valor_unitario' => 'required|numeric',
            'Impuesto' => 'required|integer',
            'Promocion' => 'required|integer',
            'cantidad' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Actualizar los datos del producto
        $producto->nombre_producto = $request->nombre;
        $producto->descripccion = $request->descripcion;
        $producto->precio_unitario = $request->valor_unitario;
        $producto->categoria_id = $request->Categoria;
        $producto->impuesto_id = $request->Impuesto;
        $producto->descuento_id = $request->Promocion;

        // Subir imagen si existe
        if ($request->hasFile('imagen')) {
            // Eliminar archivo anterior si existe
            if ($producto->imagen && file_exists(public_path('img/product/' . $producto->imagen))) {
                unlink(public_path('img/product/' . $producto->imagen));
            }
            // Subir la nueva imagen
            $archivo = $request->file('imagen');
            $nombreArchivoDoc = Str::slug($request->nombre . '-' . $request->Categoria) . "-imagen-" . time() . "." . $archivo->guessExtension();
            $ruta = public_path('img/product/');
            $archivo->move($ruta, $nombreArchivoDoc);
            $producto->imagen = $nombreArchivoDoc;
        }

        // Guardar el producto
        $producto->save();

        // Verificar si el inventario ya existe para este producto
        $inventario = Inventario::where('producto_id', $producto->id)->first();

        if ($inventario) {
            // Si el inventario ya existe, solo actualizarlo
            $inventario->stock = $request->cantidad;
            $inventario->save();
        } else {
            // Si no existe, crear un nuevo inventario
            Inventario::create([
                'producto_id' => $producto->id,
                'stock' => $request->cantidad
            ]);
        }

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto eliminado correctamente.');
    }
}
