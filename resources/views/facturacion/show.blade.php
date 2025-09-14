@extends('layouts.facturacion.showLayout')

@section('content')
<x-usuario-navbar :notificaciones="$notificaciones" :carritoCount="$carritoCount" />
<div class="max-w-4xl mx-auto bg-white p-6 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Factura {{ $factura->numero_factura }}</h2>
    <div class="mt-6 flex justify-between items-start">
        <!-- Columna izquierda (información) -->
        <div class="space-y-2">
            <p><strong>Cliente:</strong> {{ strtoupper($factura->usuario->nombre) }}</p>
            <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
            <p><strong>Forma de pago:</strong> {{ strtoupper($factura->formaPago->nombre_forma_pago) ?? 'Desconocido' }}</p>
        </div>
        <!-- Columna derecha (imagen) -->
        <div class="w-40 h-40 flex justify-end">
            <img src="{{ asset('img/logo/icon.png')}}" alt="Logo Tienda" class="object-contain w-full h-full">
        </div>
    </div>
    <h3 class="text-lg font-semibold mt-6 mb-2">Productos</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Producto</th>
                <th class="border p-2">Cantidad</th>
                <th class="border p-2">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factura->detalles as $detalle)
            <tr>
                <td class="border p-2">{{ strtoupper($detalle->producto->nombre_producto ?? 'Producto eliminado') }}</td>
                <td class="border p-2">{{ $detalle->cantidad }}</td>
                <td class="border p-2">${{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6 flex justify-between space-x-6">
        <div>
            <p><strong>Subtotal:</strong> ${{ number_format($sub ?? 0, 0, ',', '.') }}</p>
            <p><strong>Descuento:</strong> ${{ number_format($descuento ?? 0, 0, ',', '.') }}</p>
            <p><strong>Envío:</strong> ${{ number_format($costoEnvio ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
            <p class="text-lg font-bold"><strong>Total:</strong> ${{ number_format($total ?? $pedido->total ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <a href="{{ route('facturacion.verFacturaPdf', $pedido->id) }}"
            class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">Ver en PDF</a>

        <a href="{{ route('facturacion.verFacturaPdf', $pedido->id) }}?download=1"
            class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition">Descargar PDF</a>
    </div>
</div>
@endsection
@extends('layouts.facturacion.showLayout')

@section('content')
<x-navbar :notificaciones="$notificaciones" :carritoCount="$carritoCount" />
<div class="max-w-4xl mx-auto bg-white p-6 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Factura {{ $factura->numero_factura }}</h2>
    <div class="mt-6 flex justify-between items-start">
        <!-- Columna izquierda (información) -->
        <div class="space-y-2">
            <p><strong>Cliente:</strong> {{ strtoupper($factura->usuario->nombre) }}</p>
            <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
            <p><strong>Forma de pago:</strong> {{ strtoupper($factura->formaPago->nombre_forma_pago) ?? 'Desconocido' }}</p>
        </div>
        <!-- Columna derecha (imagen) -->
        <div class="w-40 h-40 flex justify-end">
            <img src="{{ asset('img/logo/icon.png')}}" alt="Logo Tienda" class="object-contain w-full h-full">
        </div>
    </div>
    <h3 class="text-lg font-semibold mt-6 mb-2">Productos</h3>
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Producto</th>
                <th class="border p-2">Cantidad</th>
                <th class="border p-2">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factura->detalles as $detalle)
            <tr>
                <td class="border p-2">{{ strtoupper($detalle->producto->nombre_producto ?? 'Producto eliminado') }}</td>
                <td class="border p-2">{{ $detalle->cantidad }}</td>
                <td class="border p-2">${{ number_format($detalle->precio_unitario, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6 flex justify-between space-x-6">
        <div>
            <p><strong>Subtotal:</strong> ${{ number_format($sub ?? 0, 0, ',', '.') }}</p>
            <p><strong>Descuento:</strong> ${{ number_format($descuento ?? 0, 0, ',', '.') }}</p>
            <p><strong>Impuestos:</strong> ${{ number_format($impuestos ?? 0, 0, ',', '.') }}</p>
            <p><strong>Envío:</strong> ${{ number_format($costoEnvio ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
            <p class="text-lg font-bold"><strong>Total:</strong> ${{ number_format($total ?? $pedido->total ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <a href="{{ route('facturacion.verFacturaPdf', $pedido->id) }}"
            class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">Ver en PDF</a>

        <a href="{{ route('facturacion.verFacturaPdf', $pedido->id) }}?download=1"
            class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition">Descargar PDF</a>
    </div>
</div>
@endsection