<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Correo</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-image: linear-gradient(#cfe8a9, #f8f4e3);
        }
        .card-custom {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
        }
        .icon-container {
            width: 6rem;
            height: 6rem;
            background-color: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .icon-container svg {
            color: white;
        }
    </style>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center vh-100 p-4">
        <div class="card card-custom p-5 text-center col-lg-6 col-md-8 col-sm-10">
            <div class="icon-container">
                <!-- Icono de correo usando SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.304l5.803-3.619L0 4.697Zm6.761 4.596 8.571-5.358A2 2 0 0 0 15.999 6c0 .341-.01.67-.033 1.002L6.761 9.293ZM1.096 11.493l5.04-3.141L1.102 4.143A2 2 0 0 0 1 4v7.304l.096.189Zm8.33-6.52L16 4.697v7.304l-5.803-3.619L9.427 4.974Z"/>
                </svg>
            </div>
            <h1 class="card-title fw-bold text-dark mb-3">¡Casi listo!</h1>
            <p class="card-text text-secondary mb-4">
                Hemos enviado un correo de verificación a tu bandeja de entrada. Por favor, revísalo y haz clic en el enlace para activar tu cuenta.
            </p>
            <div class="mt-4">
                <p class="text-muted small fw-bold">
                    ¿No lo ves? Revisa tu carpeta de spam o
                </p>
            </div>
        </div>
    </div>
    <!-- JS de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
