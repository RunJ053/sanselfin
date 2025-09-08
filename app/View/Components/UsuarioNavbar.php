<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class UsuarioNavbar extends Component
{
    public $notificaciones;
    public $carritoCount;
    public $user;

    public function __construct($notificaciones = null, $carritoCount = 0)
    {
        $this->user = Auth::user();
        $this->notificaciones = $notificaciones;
        $this->carritoCount = $carritoCount;
    }

    public function render()
    {
        return view('components.usuario-navbar');
    }
}
