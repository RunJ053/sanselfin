<?php


namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Producto;

class UsuarioCarousel extends Component
{
    public $productos;

    public function __construct($productos = null)
    {
        // Si no se pasan productos desde fuera, cargamos los 8 más recientes por defecto
        $this->productos = $productos ?? \App\Models\Producto::latest()->take(22)->get();
    }

    public function render()
    {
        return view('components.usuario-carousel');
    }
}
