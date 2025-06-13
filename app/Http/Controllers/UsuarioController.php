<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function index()
    {
        return view("user.login");
    }

    public function create()
    {
        return view('user.create_use');
    }

    public function store(Request $request)
    {
        $usuario = new Usuario();

        $usuario->nombre_usuario = $request->nom_usuario;
        $usuario->cliente=1; // Asignar cliente por defecto
        $usuario->password = bcrypt($request->confi_contra);

        $usuario->save();
            
        return redirect()->route('login')->with('success');
    }

    public function show(Usuario $usuario)
    {
        
    }

    public function edit(Usuario $usuario)
    {
        //
    }

    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    public function destroy(Usuario $usuario)
    {
        //
    }
}
