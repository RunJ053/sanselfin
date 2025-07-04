<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Impuesto;
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
}
