<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CarritoCompra;
use DB;

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
        //calcular impuestos 
        $impuestoCalculado = $itemsCarrito->sum('impuesto_calculado');
        // Calcular el total
        $total = $subtotal + $impuestoCalculado;
        $totalEnvio = $total + $costoEnvio;

        return view('facturacion.forma_pago', compact('total', 'subtotal', 'costoEnvio', 'totalEnvio'));
    }

    public function pagarEfectivo()
    {
        $usuario = Auth::id();
        $carrito = CarritoCompra::where('usuario', $usuario)->with('producto')->get();

        if ($carrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        // Recuperar datos de envío desde sesión
        $opcionEntrega = session('opcion_entrega');
        if (!$opcionEntrega) {
            return redirect()->route('forma_de_pago')->with('error', 'Debes seleccionar una opción de envío antes de pagar.');
        }

        $direccionEnvio = Auth::user()->direccion;
        $costoEnvio = $opcionEntrega['costo'];
        $envioId = $opcionEntrega['id'];

        // Calcular total
        $subtotal = $carrito->sum('subtotal');
        $impuestoCalculado = $carrito->sum('impuesto_calculado');
        $total = $subtotal + $impuestoCalculado + $costoEnvio;

        DB::beginTransaction();
        try {
            // 1 Crear pedido
            $pedido = \App\Models\Pedido::create([
                'fecha'           => now(),
                'total'           => $total,
                'direccion_envio' => $direccionEnvio,
                'usuario'         => $usuario,
                'pagos'           => 1101,
                'envios'          => $envioId,
            ]);

            // 2 Crear detalles de pedido
            foreach ($carrito as $item) {
                \App\Models\DetallePedido::create([
                    'cantidad'           => $item->cantidad,
                    'precio'             => $item->precio_unitario,
                    'descuento_aplicado' => 0,
                    'pedidos'            => $pedido->id,
                    'productos'          => $item->producto_id,
                    'usuario'            => $usuario,
                    'estados'            => 3,
                ]);
            }

            // 3 Crear una notificacion para el usuario
            $notificacion = new \App\Models\Notificacion([
                'usuario_id' => $usuario,
                'titulo' => 'Nuevo Pedido',
                'mensaje' => 'Tu pedido Nro.' . $pedido->id . ' ha sido registrado. Paga en efectivo al recibir.',
                'leido' => false
            ]);
            $notificacion->save();

            // 4 Vaciar carrito
            CarritoCompra::where('usuario', $usuario)->delete();

            // 5 Limpiar sesión
            session()->forget(['opcion_entrega', 'total_final']);

            DB::commit();

            return redirect()->route('notificaciones.index')->with('success', 'Tu pedido ha sido registrado. Paga en efectivo al recibir.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('carrito.index')->with('error', 'Hubo un error al procesar tu pedido. Inténtalo nuevamente.');
        }
    }


    public function pagarPayU(Request $request)
    {
        // Aquí generas la firma y envías datos a PayU
        // (ejemplo simplificado)
        $apiKey = env('PAYU_API_KEY');
        $merchantId = env('PAYU_MERCHANT_ID');
        $accountId = env('PAYU_ACCOUNT_ID');
        $amount = $request->input('amount', 10000);
        $currency = "COP";
        $referenceCode = "REF" . time();
        $signature = md5("$apiKey~$merchantId~$referenceCode~$amount~$currency");

        return view('facturacion.redirigirPayu', compact(
            'merchantId',
            'accountId',
            'referenceCode',
            'amount',
            'currency',
            'signature'
        ));
    }
}
