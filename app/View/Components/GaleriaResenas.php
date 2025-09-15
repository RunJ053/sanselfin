<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GaleriaResenas extends Component
{
    public $resenas;

    public function __construct($resenas)
    {
        $this->resenas = $resenas;
    }

    public function render()
    {
        return view('components.galeria-resenas');
    }
}
