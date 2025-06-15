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

    public function create($cliente_id)
    {
        return view('user.create_use', compact('cliente_id'));
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'nom_usuario' => 'required|string|min:6|max:15',
            'contra' => 'required|string|min:8|max:20',
            'confi_contra' => 'required|string|min:8|max:20|same:contra', // Verifica que coincidan
        ]);

        // Verificar si el nombre de usuario ya existe
        if (Usuario::where('nombre_usuario', $request->nom_usuario)->exists()) {
            return redirect()->back()->with('error', 'El nombre de usuario ya existe.')->withInput();
        }

        $usuario = new Usuario();
        $usuario->nombre_usuario = $request->nom_usuario;
        $usuario->cliente = $request->cliente_id;
        $usuario->password = bcrypt($request->contra);

        $usuario->save();
            
        return redirect()->route('login')->with('success', 'Usuario creado exitosamente!');
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
