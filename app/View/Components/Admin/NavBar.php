<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class NavBar extends Component
{
    public $notificaciones;

    public function __construct($notificaciones = [])
    {
        $this->notificaciones = $notificaciones;
    }

    public function render()
    {
        return view('components.admin.nav-bar');
    }
}
