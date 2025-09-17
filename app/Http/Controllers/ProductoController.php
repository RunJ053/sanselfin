<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Estado;
use App\Models\UnidadMedida;
use App\Models\CarritoCompra;
use App\Models\Notificacion;
use Illuminate\Support\Str;
use App\Models\Promocion;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $inventarios = Producto::with(['categorias', 'promociones', 'unidadMedida'])->get();
        $categorias = Categoria::all();
        $promociones = Promocion::all();
        $unidadMedida = UnidadMedida::all();
        return view('admin.inventario', compact('inventarios', 'categorias', 'promociones','unidadMedida'));
    }

    public function create()
    {
        $inventarios = Producto::all();
        $categorias = Categoria::all();
        $promociones = Promocion::all();
        $unidadMedida = UnidadMedida::all();
        return view('admin.new_producto', compact('inventarios', 'categorias', 'promociones', 'unidadMedida'));
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
            'cantidad' => 'required|integer|min:1',
            'unidadMedida' => 'required|integer',
            'Promocion' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear y guardar el nuevo producto
        $prod = new Producto;

        $prod->nombre_producto = $request->nombre;
        $prod->categoria_id = $request->Categoria;
        $prod->descripccion = $request->descripcion;
        $prod->stock = $request->cantidad;
        $prod->precio_unitario = $request->valor_unitario;
        $prod->unidad_medida_id = $request->unidadMedida;
        $prod->descuento_id = $request->Promocion;
        $prod->estado_id = 1;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = Str::slug($prod->nombre_producto) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/product'), $filename);
            $prod->imagen = $filename;
        }

        $prod->save();

        return redirect()->route('producto.index');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $producto = Producto::findOrFail($producto->id);
        $estado = Estado::where('id', $producto->estado_id)->first();
        $promociones = Promocion::all();
        $unidadMedida = UnidadMedida::all();
        return view('admin.edit_produc', compact('producto', 'categorias', 'promociones', 'estado', 'unidadMedida'));
    }
    /**
     * Display a listing of the resource for users.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexUsuarioPro(Request $request)
    {
        $userId = auth()->id();
        $notificaciones = Notificacion::where('usuario_id', $userId)->orderBy('created_at', 'desc')->get();
        $carritoCount = CarritoCompra::where('usuario', $userId)->count('cantidad');
        try {
            $perPage = 12;

            $query = Producto::with(['categorias', 'promociones'])
                ->whereHas('estados', function ($q) {
                    $q->where('desc_estado', 'Activo');
                })->where('stock', '>', 5); // Solo productos con más de 5 disponibles

            // --- Filtrar por categoría ---
            if ($request->has('categoria') && $request->categoria !== 'all') {
                $categoriaNombre = $request->categoria;
                $categoria = Categoria::where('nombre', $categoriaNombre)->first();
                if ($categoria) {
                    $query->where('categoria_id', $categoria->id);
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

            // --- APLICAR LA PAGINACIÓN ---
            $productosPaginados = $query->paginate($perPage);

            $productosMapeados = $productosPaginados->getCollection()->map(function ($producto) {
                $precioUnitario = $producto->precio_unitario;

                if ($producto->promociones && $producto->promociones->descuento > 0) {
                    $precioUnitario = $precioUnitario * (1 - ($producto->promociones->descuento / 100));
                }

                $imagenPath = 'img/product/' . $producto->imagen;
                $imagenUrl = asset($imagenPath);

                if (empty($producto->imagen) || !file_exists(public_path($imagenPath))) {
                    $imagenUrl = asset('img/es_de_frutas_y_verduas_1.webp');
                }

                // Calificación real: promedio de reseñas
                $promedioResenas = round($producto->resenas()->avg('calificacion')) ?? 0;

                return [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre_producto,
                    'descripcion' => $producto->descripccion,
                    'valor' => number_format($precioUnitario, 0, ',', '.'),
                    'precio_base' => $producto->precio_unitario,
                    'imagen' => $imagenUrl,
                    'rating' => $promedioResenas,
                    'unidad_medida' => $producto->unidadMedida ? $producto->unidadMedida->nombre : 'Sin unidad',
                    'descuento' => $producto->promociones && $producto->promociones->descuento > 1,
                    'descuento_porcentaje' => $producto->promociones ? $producto->promociones->descuento : 0,
                ];
            });

            $productosPaginados->setCollection($productosMapeados);

            $categorias = Categoria::all();

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

            return view('producto', [
                'productos' => $productosPaginados,
                'categoriaId' => $categorias,
                'currentCategory' => $request->categoria ?? 'all',
                'searchTerm' => $request->search ?? '',
                'notificaciones' => $notificaciones,
                'carritoCount' => $carritoCount
            ]);
        } catch (\Exception $e) {
            // Si algo falla, retornamos la vista vacía con mensaje
            return back()->with('error', 'Error al cargar los productos: ' . $e->getMessage());
        }
    }


    public function showProductDetails($id)
    {
        $producto = Producto::with(['categorias', 'promociones'])->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Aplicar descuento si existe
        $precioUnitario = $producto->precio_unitario;
        if ($producto->promociones && $producto->promociones->descuento > 0) {
            $precioUnitario = $precioUnitario * (1 - ($producto->promociones->descuento / 100));
        }

        $imagenPath = 'img/product/' . $producto->imagen; // Ruta esperada en public
        $imagenUrl = asset($imagenPath); // URL completa

        // Verificar si el archivo realmente existe en el servidor
        if (!file_exists(public_path($imagenPath))) {
            $imagenUrl = asset('img/es_de_frutas_y_verduas_1.webp');
        }

        // Calificación real: promedio de reseñas
        $promedioResenas = round($producto->resenas()->avg('calificacion')) ?? 0;

        return [
            'id' => $producto->id,
            'nombre' => $producto->nombre_producto,
            'descripcion' => $producto->descripccion,
            'valor' => '$' . number_format($precioUnitario, 0, ',', '.'),
            'precio_base' => $producto->precio_unitario,
            'imagen' => $imagenUrl,
            'stock' => $producto->stock,
            'categoria' => $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría',
            'unidad_medida' => $producto->unidadMedida ? $producto->unidadMedida->nombre : 'Sin unidad',
            'rating' => $promedioResenas,
            'descuento' => $producto->promociones && $producto->promociones->descuento > 1,
            'descuento_porcentaje' => $producto->promociones ? $producto->promociones->descuento : 0,
        ];
    }


    /**
     * Obtiene los detalles de un producto específico para el modal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Producto $producto)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'Categoria' => 'required|integer',
            'descripcion' => 'required|string',
            'valor_unitario' => 'required|numeric',
            'Promocion' => 'required|integer',
            'unidadMedida'=> 'required|integer',
            'cantidad' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Actualizar los datos del producto
        $producto->nombre_producto = $request->nombre;
        $producto->descripccion = $request->descripcion;
        $producto->precio_unitario = $request->valor_unitario;
        $producto->categoria_id = $request->Categoria;
        $producto->stock = $request->cantidad;
        $producto->unidad_medida_id = $request->unidadMedida;
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

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}
