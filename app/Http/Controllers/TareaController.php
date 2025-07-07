<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Producto;
use Carbon\Carbon;

class TareaController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'tarea_titulo' => 'required|max:100',
            'tarea_tipo' => 'required|in:pendiente,hecha',
        ]);

        Tarea::create([
            'titulo' => $request->tarea_titulo,
            'descripcion' => $request->tarea_descripcion,
            'tipo' => $request->tarea_tipo,
            'fecha_creacion' => now(), // Asegura guardar la fecha
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function marcarHecha($id)
    {
        Tarea::where('id', $id)->update(['tipo' => 'hecha']);
        return redirect()->route('admin.dashboard');
    }

    public function eliminar($id)
    {
        Tarea::destroy($id);
        return redirect()->route('admin.dashboard');
    }
}
