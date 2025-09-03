<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    /**
     * Mostrar todas las notificaciones del usuario
     */
    public function index()
    {
        $userId = Auth::id();
        $notificaciones = Notificacion::where('usuario_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notificacion.indexNotificacion', compact('notificaciones'));
    }

    /**
     * Marcar una notificación como leída
     */
    public function marcarLeida($id)
    {
        $notificacion = Notificacion::where('id', $id)
            ->where('usuario_id', Auth::id())
            ->firstOrFail();
            
        $notificacion->update(['leida' => true]);

        return redirect()->back()->with('success', 'Notificación marcada como leída.');
    }

    /**
     * Marcar todas las notificaciones como leídas
     */
    public function marcarTodasLeidas()
    {
        $updated = Notificacion::where('usuario_id', Auth::id())
            ->where('leida', false)
            ->update(['leida' => true]);

        if ($updated > 0) {
            return redirect()->back()->with('success', "Se marcaron {$updated} notificaciones como leídas.");
        }
        
        return redirect()->back()->with('info', 'No hay notificaciones pendientes por marcar.');
    }

    /**
     * Crear nueva notificación
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string|max:1000',
        ]);

        Notificacion::create([
            'usuario_id' => Auth::id(),
            'titulo' => $request->titulo,
            'mensaje' => $request->mensaje,
            'leida' => false
        ]);

        return redirect()->back()->with('success', 'Notificación creada exitosamente.');
    }

    /**
     * Eliminar una notificación específica
     */
    public function destroy($id)
    {
        $notificacion = Notificacion::where('id', $id)
            ->where('usuario_id', Auth::id())
            ->firstOrFail();
            
        $notificacion->delete();

        return redirect()->back()->with('success', 'Notificación eliminada.');
    }

    /**
     * Eliminar todas las notificaciones del usuario
     */
    public function eliminarTodas()
    {
        $deleted = Notificacion::where('usuario_id', Auth::id())->delete();

        if ($deleted > 0) {
            return view('index2')->with('success', "Se eliminaron {$deleted} notificaciones.");
        }
        
        return redirect()->back()->with('info', 'No hay notificaciones para eliminar.');
    }

    /**
     * Eliminar notificaciones seleccionadas
     */
    public function eliminarSeleccionadas(Request $request)
    {
        $request->validate([
            'notificaciones' => 'required|array',
            'notificaciones.*' => 'exists:notificaciones,id'
        ]);

        $notificacionIds = $request->notificaciones;
        
        $deleted = Notificacion::whereIn('id', $notificacionIds)
            ->where('usuario_id', Auth::id())
            ->delete();

        if ($deleted > 0) {
            return redirect()->back()->with('success', "Se eliminaron {$deleted} notificaciones seleccionadas.");
        }
        
        return redirect()->back()->with('error', 'No se pudieron eliminar las notificaciones seleccionadas.');
    }
}