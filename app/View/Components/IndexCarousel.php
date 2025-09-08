<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Producto;

class IndexCarousel extends Component
{
    public $productos;

    public function __construct()
    {
        // Consultamos los productos desde la base de datos
        $this->productos = Producto::latest()->take(25)->get();
    }

    public function render()
    {
        return view('components.index-carousel');
    }
}
