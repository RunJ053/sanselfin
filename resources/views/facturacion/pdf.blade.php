
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura {{ $factura->numero_factura }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border: 2px solid #2c3e50;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 10px 0;
            letter-spacing: 1px;
        }

        .header h2 {
            color: #34495e;
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }

        .company-info {
            text-align: center;
            color: #2c3e50;
            font-size: 10px;
            margin: 5px 0;
            font-weight: 600;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            padding: 15px;
            background-color: #ecf0f1;
            border-left: 4px solid #3498db;
        }

        .customer-info {
            flex: 1;
        }

        .invoice-meta {
            text-align: right;
            flex: 1;
        }

        .info-label {
            font-weight: bold;
            color: #2c3e50;
        }

        .info-value {
            color: #34495e;
            margin-bottom: 8px;
        }

        .details-section {
            margin: 25px 0;
        }

        .details-title {
            background-color: #34495e;
            color: white;
            padding: 10px;
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 0 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            padding: 12px 8px;
            text-align: center;
            font-size: 11px;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #bdc3c7;
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e8f4f8;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .totals-section {
            margin-top: 30px;
            border: 1px solid #bdc3c7;
            background-color: #f8f9fa;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 15px;
            border-bottom: 1px solid #ecf0f1;
        }

        .totals-row:last-child {
            border-bottom: none;
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .totals-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .totals-value {
            font-weight: bold;
            color: #27ae60;
        }

        .totals-row:last-child .totals-label,
        .totals-row:last-child .totals-value {
            color: white;
        }

        .payment-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f6f3;
            border-left: 4px solid #27ae60;
        }

        .payment-info .info-label {
            color: #27ae60;
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, #3498db, #2c3e50);
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #7f8c8d;
            border-top: 1px solid #bdc3c7;
            padding-top: 10px;
        }

        /* Ajustes para PDF */
        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
            
            .invoice-details {
                display: block;
            }
            
            .customer-info, .invoice-meta {
                display: block;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>FACTURA ELECTRÓNICA DE VENTA</h1>
        <h2>NÚMERO {{ $factura->numero_factura }}</h2>
        <div class="company-info">TIENDAS FINCA AL DÍA S.A NIT 1010102030</div>
        <div class="company-info">RESPONSABLE DE IVA - GRAN CONTRIBUYENTE</div>
        <div class="company-info">RETENEDOR IMPUESTO IVA</div>
        <div class="company-info">AUTORRETENEDOR RES 8825 DE 16/NOV/2016</div>
    </div>

    <div class="divider"></div>

    <div class="invoice-details">
        <div class="customer-info">
            <div class="info-value">
                <span class="info-label">CONSUMIDOR FINAL:</span><br>
                {{ strtoupper($factura->usuario->nombre ?? 'N/A') }}
            </div>
            <div class="info-value">
                <span class="info-label">IDENTIFICACIÓN:</span><br>
                000000222222
            </div>
        </div>
        
        <div class="invoice-meta">
            <div class="info-value">
                <span class="info-label">FECHA DE EMISIÓN:</span><br>
                {{ $factura->fecha }}
            </div>
        </div>
    </div>

    <div class="details-section">
        <h3 class="details-title">DETALLES DE LA FACTURA</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 50%">DETALLE</th>
                    <th style="width: 20%" class="text-center">CANTIDAD</th>
                    <th style="width: 30%" class="text-right">PRECIO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factura->detalles as $detalle)
                <tr>
                    <td>{{ strtoupper($detalle->producto->nombre_producto ?? 'Producto eliminado') }}</td>
                    <td class="text-center">{{ $detalle->cantidad }}</td>
                    <td class="text-right">${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="totals-section">
        <div class="totals-row">
            <span class="totals-label">SUBTOTAL</span>
            <span class="totals-value">${{ number_format($sub, 0, ',', '.') }}</span>
        </div>
        <div class="totals-row">
            <span class="totals-label">DESCUENTO</span>
            <span class="totals-value">-${{ number_format($descuento, 0, ',', '.') }}</span>
        </div>
        <div class="totals-row">
            <span class="totals-label">COSTO DE ENVÍO</span>
            <span class="totals-value">${{ number_format($costoEnvio, 0, ',', '.') }}</span>
        </div>
        <div class="totals-row">
            <span class="totals-label">TOTAL A PAGAR</span>
            <span class="totals-value">${{ number_format($total, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="payment-info">
        <span class="info-label">FORMA DE PAGO:</span>
        <span class="info-value">{{ $factura->formaPago->nombre_forma_pago ?? 'No se pudo cargar la información' }}</span>
    </div>

    <div class="footer">
        <p>Gracias por su compra - Tiendas Finca al Día S.A</p>
        <p>Este documento es una representación impresa de la factura electrónica</p>
    </div>
</body>
</html>