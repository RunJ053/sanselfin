<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CarritoCompra;

class FormaPagoController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tu carrito.');
        }

        $userId = Auth::id();
        $itemsCarrito = CarritoCompra::with('producto')->where('usuario', $userId)->get();
        $total = $itemsCarrito->sum('total_item');
        $formasPago = FormaPago::all();

        return view('facturacion.forma_pago', compact('formasPago', 'itemsCarrito','total'));
    }

    public function pagarEfectivo()
    {
        // Aquí puedes registrar el pedido con estado "pendiente"
        return redirect()->route('carrito.index')->with('success', 'Tu pedido ha sido registrado. Paga en efectivo al recibir.');
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
