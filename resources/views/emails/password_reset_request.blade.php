<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecimiento de Contraseña</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; }
        .header { background-color: #bcea76; padding: 10px 0; text-align: center; border-radius: 8px 8px 0 0; }
        .header h1 { color: #fff; margin: 0; }
        .content { padding: 20px; }
        .token-box { background-color: #e0ffe0; border: 1px solid #aaddaa; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0; border-radius: 5px; }
        .footer { text-align: center; font-size: 0.9em; color: #777; margin-top: 20px; }
        a { color: #3490dc; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Restablecimiento de Contraseña</h1>
        </div>
        <div class="content">
            <p>Hola <strong>{{ $name }}</strong>,</p>
            <p>Has solicitado un restablecimiento de contraseña para tu cuenta en Finca Al Día.</p>
            <p>Por favor, usa el siguiente código de verificación para continuar con el proceso:</p>
            <div class="token-box">
                {{ $token }}
            </div>
            <p>Este código es válido por 60 minutos.</p>
            <p>Si no solicitaste este restablecimiento, por favor ignora este correo electrónico.</p>
            <p>Gracias,<br>El equipo de Finca Al Día.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Finca Al Día. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>