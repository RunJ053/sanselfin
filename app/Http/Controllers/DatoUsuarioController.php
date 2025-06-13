<?php

namespace App\Http\Controllers;

use App\Models\DatoUsuario;
use App\Models\Genero;
use App\Models\TipoDocumento;
use App\Models\Seguridad;
use Illuminate\Http\Request;
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
        $datos->ducument = $request->document;
        $datos->save();
        return redirect()->route('crearUsuario')->with('success', 'Usuario registrado exitosamente.');

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
