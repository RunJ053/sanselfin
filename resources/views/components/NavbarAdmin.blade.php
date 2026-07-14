<<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NavbarAdmin extends Component
{
    public $notificaciones;
    public $carritoCount;
    public $user;

    public function __construct($carritoCount = 0)
    {
        $this->user = Auth::user();
        $this->carritoCount = $carritoCount;

        $this->notificaciones = collect();

        // Productos con stock bajo
        $productos = DB::table('productos')
            ->select('id', 'nombre_producto', 'stock')
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(5)
            ->get();

        foreach ($productos as $producto) {
            $this->notificaciones->push((object)[
                'tipo'    => 'stock',
                'icono'   => 'fa-box-open',
                'color'   => 'warning',
                'titulo'  => 'Stock bajo',
                'mensaje' => $producto->nombre_producto . ' tiene únicamente ' . $producto->stock . ' unidades.',
                'fecha'   => now(),
            ]);
        }

        // Pedidos recientes
        $pedidos = DB::table('facturas_cabeceras')
            ->latest()
            ->take(5)
            ->get();

        foreach ($pedidos as $pedido) {
            $this->notificaciones->push((object)[
                'tipo'    => 'pedido',
                'icono'   => 'fa-cart-shopping',
                'color'   => 'success',
                'titulo'  => 'Nuevo pedido',
                'mensaje' => 'Pedido #' . $pedido->id . ' registrado.',
                'fecha'   => $pedido->created_at,
            ]);
        }

        $this->notificaciones = $this->notificaciones
            ->sortByDesc('fecha')
            ->values();
    }

    public function render()
    {
        return view('components.NavbarAdmin');
    }
}