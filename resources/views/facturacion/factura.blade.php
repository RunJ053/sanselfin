<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura {{ $factura->numero_factura }}</title>
    <link rel="shortcut icon" href="{{ asset('img/icon.png')}}" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .factura {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .encabezado {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid green;
        }

        .logo {
            width: 250px;
            height: 150px;
            background-color: #73ee5b;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        img {
            width: 100%;
            height: 105%;
        }

        .info-tienda {
            text-align: right;
        }

        .detalles-cliente {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }

        .totales {
            text-align: right;
            margin-top: 20px;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="factura">
        <div class="encabezado">
            <div class="logo">
                <img src="{{ asset('img/logo/icon.png')}}" alt="Logo Tienda">
            </div>
            <div class="info-tienda">
                <h2>Finca Al Día</h2>
                <p> Tv. 94 L #88-08, Bogotá #123</p>
                <p>Tel: (123) 456-7890</p>
            </div>
        </div>

        <div class="detalles-factura">
            <p><strong>Factura Nro:</strong> {{ $factura->numero_factura }}</p>
            <p><strong>Fecha:</strong> {{ $factura->fecha->format('d/m/Y H:i') }}</p>
        </div>

        <div class="detalles-cliente">
            <h3>Cliente</h3>
            <p><strong>Nombre:</strong> {{ $factura->cliente->name ?? '---' }}</p>
            <p><strong>Dirección:</strong> {{ $factura->cliente->direccion ?? '---' }}</p>
            <p><strong>RFC:</strong> {{ $factura->cliente->rfc ?? '---' }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factura->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->producto->nombre ?? 'Producto' }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>${{ number_format($detalle->impuesto_monto, 2) }}</td>
                    <td>${{ number_format($detalle->subtotal + $detalle->impuesto_monto, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totales">
            <p><strong>Subtotal:</strong> ${{ number_format($factura->detalles->sum('subtotal'), 2) }}</p>
            <p><strong>IVA:</strong> ${{ number_format($factura->detalles->sum('impuesto_monto'), 2) }}</p>
            <p><strong>Total:</strong> ${{ number_format($factura->detalles->sum(fn($d) => $d->subtotal + $d->impuesto_monto), 2) }}</p>
        </div>

        <footer>
            <p>Gracias por su compra</p>
            <p>Este documento es una representación impresa de un CFDI</p>
        </footer>
    </div>
</body>

</html>