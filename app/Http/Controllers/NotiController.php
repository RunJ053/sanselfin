<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class NotiController extends Controller
{
    public function obtenerNotificaciones()
    {
       
       return view('admin.dashboard');
    }
}