<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios = Inventario::all();
        return view('admin.inventario', compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.new_producto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inventario= new Inventario;

        $inventario->nombre_producto = $request->nombre;
        $inventario->descripcion = $request->descripcion;
        $inventario->stock = $request->Stock;
        $inventario->precio_unitario->Valor_Unitario;

        $inventario->save();
        return redirect()->route('inventario.index');

    }

    /**
     * Display the specified resource.
     */
    public function index2(Producto $productos_reci)
    {
        return view('admin.productos_reci', compact('productos_reci'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        return view('admin.edit_produc', compact('inventario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $inventario->update($request->all());

        return redirect()->route('inventario.index')
                        ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {

    }
}
