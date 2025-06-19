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
        $categorias= Categoria::all();
        $impuestos= Impuesto::all();
        $promociones= Promocion::all();
        return view('inventario.index', compact('promociones', 'categorias', 'impuestos'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventario= new Producto;

        $inventario->nombre_producto = $request->nombre;
        $inventario->descripcion = $request->descripcion;
        $inventario->stock = $request->Stock;
        $inventario->precio_unitario->Valor_Unitario;

        $inventario->save();
        return redirect()->route('inventario.index');

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
