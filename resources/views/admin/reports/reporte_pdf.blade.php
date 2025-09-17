<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte Financiero</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte Financiero</h2>

    <p><b>Ingresos:</b> ${{ number_format($ingresos, 2) }}</p>
    <p><b>Gastos:</b> ${{ number_format($gastos, 2) }}</p>
    <p><b>Pérdidas:</b> ${{ number_format($perdidas, 2) }}</p>
    <p><b>Ganancia Neta:</b> ${{ number_format($gananciaNeta, 2) }}</p>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movimientos as $mov)
            <tr>
                <td>{{ $mov->fecha }}</td>
                <td>{{ ucfirst($mov->tipo) }}</td>
                <td>${{ number_format($mov->monto, 2) }}</td>
                <td>{{ $mov->descripcion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
