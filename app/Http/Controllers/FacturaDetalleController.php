<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\FacturaCabecera;
use App\Models\Notificacion;
use App\Models\DatoUsuario;
use App\Models\CarritoCompra;
use App\Models\FacturaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaDetalleController extends Controller
{
    private function computeFacturaTotals($factura): array
    {
        $detalles = $factura->detalles; // colección de FacturaDetalle

        $sub = (float) $detalles->sum('subTotal');               // suma de subtotales sin impuestos
        $descuento = (float) $detalles->sum('descuento');        // suma de descuentos
        $totalProductos = (float) $detalles->sum('montoTotal');  // ya guardaste montoTotal por item al crear la factura
        $costoEnvio = (float) optional($detalles->first())->envio ?? 0;
        $total = $totalProductos + $costoEnvio;

        return compact('sub', 'descuento', 'totalProductos', 'costoEnvio', 'total');
    }

    public function verFactura($pedidoId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debe iniciar sesión primero']);
        }

        $usuarioId = Auth::id();
        $pedido = Pedido::with('detalles.producto.unidadMedida')->findOrFail($pedidoId);

        $factura = FacturaCabecera::where('pedido_id', $pedido->id)
            ->with('detalles.producto.unidadMedida', 'formaPago', 'usuario')
            ->firstOrFail();

        $totales = $this->computeFacturaTotals($factura);

        $notificaciones = Notificacion::where('usuario_id', $usuarioId)->orderBy('created_at', 'desc')->get();
        $carritoCount = CarritoCompra::where('usuario', $usuarioId)->count('cantidad');

        return view('facturacion.show', array_merge([
            'factura' => $factura,
            'pedido' => $pedido,
            'notificaciones' => $notificaciones,
            'carritoCount' => $carritoCount
        ], $totales));
    }

    /**
     * Ver/descargar factura en PDF
     */
    public function verFacturaPdf($pedidoId, Request $request)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($pedidoId);

        $factura = FacturaCabecera::where('pedido_id', $pedido->id)
            ->with('detalles.producto', 'formaPago', 'usuario')
            ->firstOrFail();

        $totales = $this->computeFacturaTotals($factura);

        $pdf = Pdf::loadView('facturacion.pdf', array_merge([
            'factura' => $factura,
            'pedido'  => $pedido
        ], $totales));

        // si usas ?download=1
        if ($request->query('download')) {
            return $pdf->download($factura->numero_factura . '.pdf');
        }

        return $pdf->stream($factura->numero_factura . '.pdf');
    }
}
