<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\DatoUsuario;
use App\Models\Genero;
use App\Models\TipoDocumento;
use App\Models\Seguridad;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DatoUsuarioController extends Controller
{
    public function index()
    {
        $genero = Genero::all();
        $tipoDocumento = TipoDocumento::all();
        $seguridad = Seguridad::all();
        return view("user.registro_usuario", compact('genero', 'tipoDocumento', 'seguridad'));
    }

    public function store(Request $request)
{
    // Validar la solicitud
    $validator = Validator::make($request->all(), [
        'doc' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'nom' => 'required|string|max:255|regex:/^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+$/',
        'ape' => 'required|string|max:255|regex:/^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+$/',
        'Direccion' => 'required|string|max:255',
        'Pregunta_seguridad' => 'required|string|max:255',
        'Respuesta_pregunta' => 'required|string|max:255|regex:/^[A-Za-z0-9áéíóúÁÉÍÓÚüÜñÑ\s]+$/',
        'tipodocu' => 'required|string|max:255',
        'num_doc' => 'required|string|max:255',
        'sexo' => 'required|string|max:255',
        'fecha_nac' => 'required|date',
        'telefono' => 'required|string|max:15',
        'correo' => 'required|email|max:255',
        'Localidad' => 'required|string|max:255',
    ]);
    if ($validator->fails()) {
        // Redirigir con errores de validación
        return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }
    try {
        $datos = new DatoUsuario;
        $datos->nombre = $request->nom;
        $datos->apellidos = $request->ape;
        $datos->direccion = $request->Direccion;
        $datos->pregunta_seguridad = $request->Pregunta_seguridad;
        $datos->respuesta_seguridad = $request->Respuesta_pregunta;
        $datos->tipo_docu = $request->tipodocu;
        $datos->documento = $request->num_doc; 
        $datos->tipo_de_genero = $request->sexo;
        $datos->edad = $request->fecha_nac;
        $datos->telefono = $request->telefono;
        $datos->email = $request->correo;
        $datos->localidad = $request->Localidad;
        $datos->tipo_client = 1;

        // Manejo de la carga del documento
        if ($request->hasFile('doc')) {
            $archivo = $request->file('doc');
            $nombreArchivo = Str::slug($request->nom) . "-" . time() . "." . $archivo->guessExtension(); // Generar un nombre único
            $ruta = public_path('img/documents'); 
            $archivo->move($ruta, $nombreArchivo); 
            $datos->nom_imgs = $nombreArchivo; // Asignar el nombre del archivo a la propiedad del modelo
        }
        $datos->save();
        return redirect()->route('crearUsuario', ['cliente_id'=>$datos->id])->with('success', 'Usuario creado exitosamente!');
    } catch (\Exception $e) {
    // Manejo de excepciones
        return redirect()->back()->with('error', 'Error al crear el usuario. Por favor, verifica que no exista un usuario con esos datos.');
    }

}
    
    public function show(DatoUsuario $datoUsuario)
    {
        
    }

    public function edit($id)
    {
        $pais = DatoUsuario::findOrFail($id);
        return view('paises.editas_pais', [
           'nombre' => $pais->nombre,
           'capital' => $pais->capital,
           'codigo' => $pais->codigo,
           'continente' => $pais->continente,
           'id' => $id
       ]);  
    }


    public function update(Request $request, $id)
    {
        $pais = DatoUsuario::findOrFail($id);
        $pais->nombre = $request->nombre;
        $pais->capital = $request->capital;
        $pais->codigo = $request->codigo;
        $pais->continente = $request->continente;
        $pais->save();
        return redirect()->route('pais.index');
    }

    public function destroy(DatoUsuario $datoUsuario)
    {
        //
    }
    
}
