<?php

namespace App\Http\Controllers;

use App\Models\DatoUsuario;
use App\Models\Genero;
use Illuminate\Http\Request;
class DatoUsuarioController extends Controller
{

    public function index(Genero $generos)
    {
        $genero = $generos::all();
        return view("user.registro_usuario", compact("$genero"));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    
    public function show(DatoUsuario $datoUsuario)
    {
        //
    }

    public function edit(DatoUsuario $datoUsuario)
    {
        //
    }


    public function update(Request $request, DatoUsuario $datoUsuario)
    {
        //
    }

    public function destroy(DatoUsuario $datoUsuario)
    {
        //
    }
}
