<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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

    public function show(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            // Autenticación exitosa
            session(['usuario_id' => $usuario->id, 'nombre_usuario' => $usuario->nombre_usuario]);
            
            return view('index2');
        }

        return back()->withErrors(['login_error' => 'Usuario o contraseña incorrectos']);
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

    public function logout()
    {
        session()->forget('usuario_id');
        return view('index');
    }

}
