<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;

class ContactoController extends Controller
{
    // Mostrar el formulario
    public function index()
    {
        return view('contacto.form');
    }

    // Procesar y enviar el correo
    public function enviar(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'correo'   => 'required|email',
            'asunto'   => 'required|string|max:255',
            'mensaje'  => 'required|string',
        ]);

        try {
            $detalles = [
                'nombre'  => $request->nombre,
                'correo'  => $request->correo,
                'asunto'  => $request->asunto,
                'mensaje' => $request->mensaje,
            ];

            Mail::to('fincaaldia25@gmail.com')->send(new ContactoMail($detalles));

            return back()->with('success', '¡Tu mensaje ha sido enviado con éxito!');
        } catch (\Exception $e) {
            return back()->with('error', 'Hubo un problema al enviar tu mensaje. Intenta de nuevo.');
        }
    }
}
