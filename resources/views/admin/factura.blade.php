<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
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
        img{
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
        th, td {
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
                <img src="../img/logo/icon.png" alt="">
            </div>
            <div class="info-tienda">
                <h2>Verduras Frescas S.A.</h2>
                <p>Calle Principal #123</p>
                <p>Tel: (123) 456-7890</p>
                <p>RFC: VERF123456ABC</p>
            </div>
        </div>

        <div class="detalles-factura">
            <p><strong>Factura #:</strong> 00001</p>
            <p><strong>Fecha:</strong> 24/10/2024</p>
        </div>

        <div class="detalles-cliente">
            <h3>Cliente</h3>
            <p><strong>Nombre:</strong> Juan Pérez</p>
            <p><strong>Dirección:</strong> Av. Cliente #456</p>
            <p><strong>RFC:</strong> PECJ891223XY9</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2 kg</td>
                    <td>Tomates</td>
                    <td>$25.00</td>
                    <td>$50.00</td>
                </tr>
                <tr>
                    <td>1 kg</td>
                    <td>Cebollas</td>
                    <td>$18.00</td>
                    <td>$18.00</td>
                </tr>
                <tr>
                    <td>3 kg</td>
                    <td>Papas</td>
                    <td>$22.00</td>
                    <td>$66.00</td>
                </tr>
            </tbody>
        </table>

        <div class="totales">
            <p><strong>Subtotal:</strong> $134.00</p>
            <p><strong>IVA (16%):</strong> $21.44</p>
            <p><strong>Total:</strong> $155.44</p>
        </div>

        <footer>
            <p>Gracias por su compra</p>
            <p>Este documento es una representación impresa de un CFDI</p>
        </footer>
    </div>
</body>
</html>