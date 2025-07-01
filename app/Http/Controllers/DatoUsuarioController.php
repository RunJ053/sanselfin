<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\DatoUsuario;
use App\Models\Genero;
use App\Models\TipoDocumento;
use App\Models\Localidad;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DatoUsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function changePasswordForm()
    {
        return view('user.cambiar_contrasena');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Verificar la contraseña actual
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        // Actualizar la contraseña
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('myProfile')->with('success', 'Contraseña actualizada exitosamente.');
    }

    public function edit($id)
    {
        $usuario = DatoUsuario::findOrFail($id);
        $genero = Genero::all();
        $tipoDocumento = TipoDocumento::all();
        $localidad = Localidad::all();
        return view('user.edicion_usuario', compact('usuario', 'genero', 'tipoDocumento', 'localidad'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'img_user' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'nom' => 'required|string|max:255|regex:/^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+$/',
            'ape' => 'required|string|max:255|regex:/^[A-Za-záéíóúÁÉÍÓÚüÜñÑ\s]+$/',
            'tipodocu' => 'required|exists:tipos_documentos,id',
            'num_doc' => 'required|string|max:255',
            'sexo' => 'required|exists:generos,id',
            'fecha_nac' => 'required|date|before_or_equal:today',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|email|max:255',
            'Localidad' => 'required|exists:localidades,id',
            'Direccion' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $datos = DatoUsuario::findOrFail($id);
            $datos->nombre = $request->nom;
            $datos->apellidos = $request->ape;
            $datos->direccion = $request->Direccion;
            $datos->tipo_docu = $request->tipodocu;
            $datos->documento = $request->num_doc;
            $datos->tipo_de_genero = $request->sexo;
            $datos->edad = $request->fecha_nac;
            $datos->telefono = $request->telefono;
            $datos->email = $request->correo;
            $datos->localidad = $request->Localidad;

            // Manejo del documento de identidad
            if ($request->hasFile('doc')) {
                // Eliminar archivo anterior si existe
                if ($datos->nom_imgs && file_exists(public_path('img/documents/' . $datos->nom_imgs))) {
                    unlink(public_path('img/documents/' . $datos->nom_imgs));
                }
                $archivo = $request->file('doc');
                $nombreArchivoDoc = Str::slug($request->nom . '-' . $request->num_doc) . "-doc-" . time() . "." . $archivo->guessExtension();
                $ruta = public_path('img/documents/');
                $archivo->move($ruta, $nombreArchivoDoc);
                $datos->nom_imgs = $nombreArchivoDoc; // Usar el campo correcto de tu modelo
            }

            // Manejo de la imagen de perfil del usuario
            if ($request->hasFile('img_user')) {
                // Eliminar archivo anterior si existe
                if ($datos->user_img && file_exists(public_path('img/usuario_img/' . $datos->user_img))) {
                    unlink(public_path('img/usuario_img/' . $datos->user_img));
                }
                $archivo = $request->file('img_user');
                $nombreArchivoUser = Str::slug($request->nom . '-' . $id) . "-avatar-" . time() . "." . $archivo->guessExtension();
                $ruta = public_path('img/usuario_img/');
                $archivo->move($ruta, $nombreArchivoUser);
                $datos->user_img = $nombreArchivoUser; // Usar el campo correcto de tu modelo
            }

            $datos->save();

            // Redirección corregida (sin pasar 'id' si la ruta myProfile no lo necesita)
            return redirect()->route('myProfile')->with('success', '¡Tus datos han sido actualizados exitosamente! 🎉');
        } catch (\Exception $e) {
            // Para depuración, puedes ver el mensaje de error real:
            // dd($e->getMessage()); 
            return redirect()->back()->with('error', 'Hubo un problema al actualizar tu información: ' . $e->getMessage() . '. Intenta de nuevo más tarde o contacta a soporte.');
        }
    }
}
