<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $notificaciones = Notificacion::where('usuario_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('notificacion.indexNotificacion', compact('notificaciones'));
    }

    public function marcarLeida($id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->update(['leida' => true]);

        return redirect()->back()->with('success', 'Notificación marcada como leída.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        Notificacion::create([
            'usuario_id' => Auth::id(),
            'titulo' => $request->titulo,
            'mensaje' => $request->mensaje,
        ]);

        return redirect()->back()->with('success', 'Notificación creada.');
    }
}
