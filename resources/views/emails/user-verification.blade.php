<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Correo Electrónico</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; background: linear-gradient(to bottom, #cfe8a9, #f8f4e3); margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #f7f7f7; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
        <h2 style="color: #35a539;">Hola, {{ $userName }}!</h2>
        <p>Gracias por registrarte. Para completar tu registro, por favor haz clic en el siguiente botón para verificar tu dirección de correo electrónico.</p>

        <a href="{{ url('/verify/' . $verificationToken) }}" style="display: inline-block; background-color: #064e08; color: #ffffff; text-decoration: none; padding: 10px 20px; margin: 15px 0; border-radius: 5px;">
            Verificar Correo Electrónico
        </a>

        <p>Si tienes problemas con el botón, copia y pega el siguiente enlace en tu navegador:</p>
        <p><a href="{{ url('/verify/' . $verificationToken) }}" style="color: #064e08; text-decoration: none;">{{ url('/verify/' . $verificationToken) }}</a></p>

        <p>Si no te registraste, puedes ignorar este correo.</p>
        <p>Saludos cordiales,<br>El equipo de tu aplicación</p>
    </div>
</body>
</html>