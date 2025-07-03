<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Impuesto;
use App\Models\Promocion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
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
        $inventarios = Producto::all();
        $categorias = Categoria::all();
        $impuestos = Impuesto::all();
        $promociones = Promocion::all();

        return view('admin.new_producto', compact('inventarios', 'categorias', 'impuestos', 'promociones'));
    }

    public function store(Request $request)
    {
        $prod = new Producto;
        $prod->nombre_producto = $request->nombre;
        $prod->categoria_id = $request->categoria;
        $prod->descripccion = $request->descripcion;
        $prod->precio_unitario = $request->valor_unitario;
        $prod->impuesto_id = $request->Impuesto;
        $prod->descuento_id = $request->Promocion;
        
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = Str::slug($prod->nombre_producto) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/product'), $filename);
            $prod->imagen = 'img/product/' . $filename;
        }

        $prod->save();

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');
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
        $producto->save();

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}