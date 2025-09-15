<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\TipoDocumento;
use App\Models\Genero;
use App\Models\Localidad;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Mostrar listado de usuarios con paginación
     */
    public function index()
    {
        $usuarios = Usuario::with(['tipoDocumento', 'genero', 'localidad'])
                           ->paginate(10);

        $inventarios = Producto::all(); 
        $categorias = Categoria::all();

        return view('admin.usuarios', compact('usuarios', 'inventarios', 'categorias'));
    }

    /**
     * Mostrar formulario de crear usuario
     */
    public function create()
    {
        $tipos_doc   = TipoDocumento::all();
        $generos     = Genero::all();
        $localidades = Localidad::all();
        $inventarios = Producto::all();

        return view('admin.new_usuario', compact('tipos_doc', 'generos', 'localidades', 'inventarios'));
    }

    /**
     * Guardar usuario nuevo
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'         => 'required|string|max:255',
            'apellidos'      => 'required|string|max:255',
            'direccion'      => 'required|string|max:255',
            'tipo_docu'      => 'required|integer|exists:tipos_documentos,id',
            'tipo_de_genero' => 'required|integer|exists:generos,id',
            'documento'      => 'required|string|max:50|unique:datos_usuario,documento',
            'edad'           => 'required|date',
            'telefono'       => 'nullable|string|max:20',
            'email'          => 'required|email|unique:datos_usuario,email',
            'localidad'      => 'required|integer|exists:localidades,id',
            'user_img'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('user_img')) {
            $data['user_img'] = $request->file('user_img')->store('usuarios', 'public');
        }

        Usuario::create($data);

        return redirect()->route('usuario.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Mostrar formulario de editar usuario
     */
    public function edit($id)
    {
        $usuario       = Usuario::findOrFail($id);
        $tiposDocumentos = TipoDocumento::all();
        $generos       = Genero::all();
        $localidades   = Localidad::all();

        return view('admin.usuarios_edit', compact('usuario', 'tiposDocumentos', 'generos', 'localidades'));
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre'         => 'required|string|max:255',
            'apellidos'      => 'required|string|max:255',
            'direccion'      => 'required|string|max:255',
            'tipo_docu'      => 'required|integer|exists:tipos_documentos,id',
            'tipo_de_genero' => 'required|integer|exists:generos,id',
            'documento'      => 'required|string|max:50|unique:datos_usuario,documento,' . $usuario->id,
            'edad'           => 'required|date',
            'telefono'       => 'nullable|string|max:20',
            'email'          => 'required|email|unique:datos_usuario,email,' . $usuario->id,
            'localidad'      => 'required|integer|exists:localidades,id',
            'user_img'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('user_img')) {
            $data['user_img'] = $request->file('user_img')->store('usuarios', 'public');
        }

        $usuario->update($data);

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Eliminar usuario
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente');
    }
}
