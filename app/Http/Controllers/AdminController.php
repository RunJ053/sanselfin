<?php

namespace App\Http\Controllers;

use App\Models\Usuario; 
use App\Models\TipoDocumento;
use App\Models\Genero;
use App\Models\Inventario;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminController extends Controller

{
// Mostrar todos los usuarios
public function index()
{
    $usuarios = Usuario::all();
    $inventarios = Inventario::all(); 
    $categorias = Categoria::all();   

    // Contar usuarios registrados
    $numeroUsuarios = $usuarios->count();

    return view('admin.usuarios', compact('usuarios', 'inventarios', 'categorias', 'numeroUsuarios'));
}



    // Formulario para crear usuario
        public function create()
        {
            $tiposDocumentos = TipoDocumento::all();
            $generos = Genero::all();

            return view('usuarios.create', compact('tiposDocumentos', 'generos'));
        }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'tipo_docu' => 'required|exists:tipos_documentos,id',
            'tipo_de_genero' => 'nullable|exists:generos,id',
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'nullable|numeric|digits_between:7,15|unique:usuarios_sist,telefono,' . $usuario->id,
            'email' => 'required|email|unique:usuarios_sist,email,' . $usuario->id,
            'documento' => 'required|numeric|unique:usuarios_sist,documento,' . $usuario->id,
            'direccion' => 'nullable|string|max:200',
            'edad' => 'nullable|date',
            'localidad' => 'nullable|exists:localidades,id',
        ]);

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->direccion = $request->direccion;
        $usuario->tipo_docu = $request->tipo_docu;
        $usuario->tipo_de_genero = $request->tipo_de_genero;
        $usuario->documento = $request->documento;
        $usuario->edad = $request->edad;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->localidad = $request->localidad;
        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuario creado correctamente');
    }

    // Mostrar formulario de edición
        public function edit(Request $request, $id)
        {
            $usuario = Usuario::findOrFail($id);
            $tiposDocumentos = TipoDocumento::all(); 
            $generos = Genero::all(); // 👈 aquí traes todos los géneros

            return view('admin.usuarios_edit', compact('usuario', 'tiposDocumentos', 'generos'));
        }
    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'tipo_docu' => 'required|exists:tipos_documentos,id',
            'tipo_de_genero' => 'nullable|exists:generos,id',
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'nullable|numeric|digits_between:7,15|unique:usuarios_sist,telefono,' . $usuario->id,
            'email' => 'required|email|unique:usuarios_sist,email,' . $usuario->id,
            'documento' => 'required|numeric|unique:usuarios_sist,documento,' . $usuario->id,
            'direccion' => 'nullable|string|max:200',
            'edad' => 'nullable|date',
            'localidad' => 'nullable|exists:localidades,id',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->direccion = $request->direccion;
        $usuario->tipo_docu = $request->tipo_docu;
        $usuario->tipo_de_genero = $request->tipo_de_genero;
        $usuario->documento = $request->documento;
        $usuario->edad = $request->edad;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->localidad = $request->localidad;

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente');
    }
}