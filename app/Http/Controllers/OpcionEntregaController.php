<?php

namespace App\Http\Controllers;

use App\Models\OpcionEntrega;
use App\Models\CarritoCompra;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpcionEntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }
        $userId = Auth::id();
        $itemsCarrito = CarritoCompra::with('producto')->where('usuario', $userId)->get();

        //bucar las opciones de envio
        $destino= OpcionEntrega::all();
        //Estados
        $estado= Estado::where('nombre_estado')->first();
        return view('facturacion.opcionEnvio', compact('itemsCarrito','destino', 'estado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destino_envio' => 'required|exists:opciones_entrega,id',
        ]);

        $opcion = OpcionEntrega::findOrFail($request->destino_envio);

        // Guardar en sesión la opción seleccionada
        session([
            'opcion_entrega' => [
                'id' => $opcion->id,
                'ciudad' => $opcion->ciudad,
                'departamento' => $opcion->departamento,
                'tiempo' => $opcion->tiempo_entrega,
                'costo' => $opcion->costo ?? 0,
            ]
        ]);

        return redirect()->route('forma_de_pago')
            ->with('success', 'Opción de envío seleccionada correctamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OpcionEntrega  $opcionEntrega
     * @return \Illuminate\Http\Response
     */
    public function show(OpcionEntrega $opcionEntrega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OpcionEntrega  $opcionEntrega
     * @return \Illuminate\Http\Response
     */
    public function edit(OpcionEntrega $opcionEntrega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OpcionEntrega  $opcionEntrega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpcionEntrega $opcionEntrega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OpcionEntrega  $opcionEntrega
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpcionEntrega $opcionEntrega)
    {
        //
    }
}
