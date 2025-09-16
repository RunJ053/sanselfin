<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

class NotiController extends Controller
{
    public function index()
    {
        
        // Productos con stock bajo (ej: <= 5 unidades) desde inventarios
        $productosStockBajo = DB::table('productos')
            ->select('id', 'nombre_producto', 'stock')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Últimos 5 pedidos recientes (verifica si tienes tabla pedidos o facturas)
        $pedidosRecientes = DB::table('facturas_cabeceras')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.noti_admin', compact(
            'productosStockBajo',
            'pedidosRecientes'
        ));
    }
}
