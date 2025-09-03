<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class UsuarioNavbar extends Component
{
    public $notificaciones;
    public $user;

    public function __construct($notificaciones = null)
    {
        $this->user = Auth::user();
        $this->notificaciones = $notificaciones;
    }

    public function render()
    {
        return view('components.usuario-navbar');
    }
}
