<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotiController extends Controller
{
    public function index()
    {
        // Últimos 5 usuarios registrados
        $nuevosUsuarios = DB::table('datos_usuario')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Productos con stock bajo (ej: <= 5 unidades)
        $productosStockBajo = DB::table('inventarios')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->get();

        // Últimos 5 pedidos recientes
        $pedidosRecientes = DB::table('pedidos')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.notificaciones', compact(
            'nuevosUsuarios',
            'productosStockBajo',
            'pedidosRecientes'
        ));
    }
}

