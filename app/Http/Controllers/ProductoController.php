<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Impuesto;

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
        $prod= new Producto;

        $prod->nombre_producto = $request->nombre;
        $prod->categoria_id = $request-> Categoria;
        $prod->descripccion = $request->descripcion;
        //$prod->stock = $request->Stock;
        $prod->precio_unitario= $request->valor_unitario;
        $prod->impuesto_id= $request->Impuesto;
        $prod->descuento_id= $request->Promocion;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
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
