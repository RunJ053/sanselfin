<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Verificación</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css">
    <link rel="shortcut icon" href={{ asset('img/logo/icon.png') }} type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</head>
<body style="background: linear-gradient(to bottom, #cfe8a9, #f8f4e3);">
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card" style="width: 30rem;">
            <div class="card-body text-center">
                <i class="fas fa-exclamation-triangle fa-5x text-danger"></i>
                <h2 class="text-danger">¡Vaya! Algo ha salido mal...</h2>
                <p class="card-text">{{ $error_message }}</p>
                <a href="{{ route('login') }}" class="btn btn-success">Ir a Iniciar Sesión</a>
            </div>
        </div>
    </div>
</body>
</html>