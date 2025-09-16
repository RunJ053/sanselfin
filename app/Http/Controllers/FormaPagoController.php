<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CarritoCompra;
use App\Models\Notificacion;
use App\Models\FacturaCabecera;
use App\Models\FacturaDetalle;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\FacturaMail;
use App\Models\Tarea;
use Illuminate\Support\Facades\Log;

class FormaPagoController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }

        $userId = Auth::id();
        $itemsCarrito = CarritoCompra::with('producto')->where('usuario', $userId)->get();

        $subtotal = $itemsCarrito->sum(function ($item) {
            return $item->cantidad * $item->precio_unitario;
        });

        // Recuperar costo de envío guardado en sesión
        $opcionEntrega = session('opcion_entrega');
        $costoEnvio = $opcionEntrega['costo'] ?? 0;

        // Inicializar acumuladores
        $subtotal = 0;
        $descuento = 0;
        $total = 0;
        $sub = 0;

        // Recorrer items del carrito y sumar lo que ya está calculado en la BD
        foreach ($itemsCarrito as $item) {
            $subtotal += $item->subtotal;                 // subtotal ya viene con precio_unitario * cantidad
            $descuento += $item->descuento;               // lo calculaste en add/update
            $total += $item->total_item;             // subtotal - descuento + impuesto
        }
        $totalEnvio = $total + $costoEnvio;

        // * Mostar notificaciones pendientes
        $notificaciones = Notificacion::where('usuario_id', auth()->id())->orderBy('created_at', 'desc')->get();
        $carritoCount = CarritoCompra::where('usuario', $userId)->count('cantidad');

        return view(
            'facturacion.forma_pago',
            compact(
                'total',

                'subtotal',
                'costoEnvio',
                'totalEnvio',
                'notificaciones',
                'descuento',
                'carritoCount'
            )
        );
    }


    public function pagarEfectivo()
    {
        $usuario = Auth::id();
        $user = Auth::user();

        $carrito = CarritoCompra::where('usuario', $usuario)->with('producto')->get();
        $notificaciones = Notificacion::where('usuario_id', $usuario)->orderBy('created_at', 'desc')->get();
        $carritoCount = CarritoCompra::where('usuario', $usuario)->count('cantidad');

        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        // Recuperar datos de envío desde sesión
        $opcionEntrega = session('opcion_entrega');

        if (!$opcionEntrega) {
            return redirect()->route('forma_de_pago')->with('error', 'Debes seleccionar una opción de envío antes de pagar.');
        }

        $direccionEnvio = $user->direccion;
        $costoEnvio = $opcionEntrega['costo'];
        $envioId = $opcionEntrega['id'];

        // Inicializar acumuladores
        $subtotal = 0;
        $descuento = 0;
        $total = 0;

        foreach ($carrito as $item) {
            $subtotal += $item->subtotal;
            $descuento += $item->descuento;
            $total += $item->total_item;
        }

        $totalProductos = CarritoCompra::where('usuario', auth()->id())
            ->sum('total_item');

        $total = $totalProductos + $costoEnvio;

        DB::beginTransaction();
        try {
            // 1. Crear pedido
            $pedido = Pedido::create([
                'fecha' => now(),
                'total' => $total,
                'direccion_envio' => $direccionEnvio,
                'usuario' => $usuario,
                'pagos' => 1101,
                'envios' => $envioId,
                'estado_id' => 3,
            ]);

            // 2. Crear detalles de pedido
            foreach ($carrito as $item) {
                $subtotalProducto = $item->precio_unitario * $item->cantidad;
                $descuentoProducto = $item->descuento;
                $totalProducto = $subtotalProducto - $descuentoProducto;

                DetallePedido::create([
                    'cantidad' => $item->cantidad,
                    'precio' => $subtotalProducto,
                    'descuento_aplicado' => $item->descuento,
                    'pedidos' => $pedido->id,
                    'productos' => $item->producto_id,
                    'usuario' => $usuario,
                ]);

                $item->producto->decrement('stock', $item->cantidad);
            }

            // 3. Crear factura cabecera
            $facturaCabecera = FacturaCabecera::create([
                'estado_id' => 12,
                'cliente_id' => $usuario,
                'forma_pago_id' => 1101,
                'envio_id' => $envioId,
                'pedido_id' => $pedido->id,
                'numero_factura' => 'FAC-' . time(),
                'fecha' => now(),
            ]);

            // 4. Crear detalles de la factura
            foreach ($carrito as $item) {
                $subtotalProducto = $item->precio_unitario * $item->cantidad;
                $descuentoProducto = $item->descuento;
                $totalProducto = $subtotalProducto - $descuentoProducto;

                FacturaDetalle::create([
                    'factura_cabecera_id' => $facturaCabecera->id,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    'precio_unitario' => $item->precio_unitario,
                    'subTotal' => $subtotalProducto,
                    'descuento' => $descuentoProducto,
                    'envio' => $costoEnvio,
                    'montoTotal' => $totalProducto,
                ]);
            }

            // 5. Generar PDF
            $pdf = Pdf::loadView('facturacion.pdf', [
                'factura' => $facturaCabecera->load('usuario', 'estado', 'formaPago', 'detalles.producto'),
                'precio' => $precio_unitario ?? 0,
                'sub' => $subtotalProducto,
                'costoEnvio' => $costoEnvio,
                'descuento' => $descuento,
                'total' => $total,
            ]);

            $pdfPath = public_path('facturas/' . $facturaCabecera->numero_factura . '.pdf');
            $pdf->save($pdfPath);

            // 6. Enviar correo
            Mail::to($user->email)->send(new FacturaMail($facturaCabecera, $pdfPath));

            // 7. Notificación en BD
            Notificacion::create([
                'usuario_id' => $usuario,
                'titulo' => 'Nuevo Pedido',
                'mensaje' => 'Tu pedido ha sido registrado con exito. Se adjuntó la factura en tu correo.',
                'leido' => false,
            ]);

            // 8. Tarea para el admin
            Tarea::create([
                'titulo' => 'Nuevo pedido recibido',
                'descripcion' => 'Se ha recibido un nuevo pedido. Por favor, revisa los detalles y procede con el procesamiento.',
                'tipo' => 'pendiente',
                'fecha_creacion' => now(),
            ]);

            // 9. Vaciar carrito
            CarritoCompra::where('usuario', $usuario)->delete();
            session()->forget(['opcion_entrega', 'total_final']);

            DB::commit();

            return view('facturacion.respuestaEfectivo')->with([
                'pedido' => $pedido,
                'subtotal' => $subtotal,
                'costoEnvio' => $costoEnvio,
                'descuento' => $descuento,
                'total' => $total,
                'direccionEnvio' => $direccionEnvio,
                'notificaciones' => $notificaciones,
                'carritoCount' => $carritoCount,
                'success' => 'Tu pedido ha sido registrado exitosamente. La factura fue enviada a tu correo.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Notificacion::create([
                'usuario_id' => $usuario,
                'titulo' => 'Error al procesar pedido',
                'mensaje' => 'Hubo un error al generar tu pedido/factura. Inténtalo nuevamente.',
                'leido' => false,
            ]);

            return redirect()->route('carrito.index')->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormaPago  $formaPago
     * @return \Illuminate\Http\Response
     */
    public function edit(FormaPago $formaPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormaPago  $formaPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormaPago $formaPago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormaPago  $formaPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormaPago $formaPago)
    {
        //
    }
}
