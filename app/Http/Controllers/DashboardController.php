<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Productos recientes con relación a categoría
        $productosRecientes = Producto::with('categorias')
            ->orderBy('created_at', 'desc')
            ->simplePaginate(3); 
           

        // Datos para gráfico: productos por categoría
        $dataCat = DB::table('productos')
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->select('categorias.nombre', DB::raw('COUNT(*) as total'))
            ->groupBy('categorias.nombre')
            ->pluck('total', 'nombre');

        return view('admin.dashboard', compact('productosRecientes', 'dataCat'));
    }
}
