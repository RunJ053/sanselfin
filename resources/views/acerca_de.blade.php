<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Finca al Día - Acerca de</title>
    <link rel="shortcut icon" href="img/logo/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/NAV.css">
    <link rel="stylesheet" href="css/ACERCA_DE.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="main-nav" aria-label="Navegación principal">
        <div class="nav-left">
            <a href="index2.html" class="logo-link">
                <img src="img/logo/icon.png" alt="Logo de La Finca al Día" width="150" height="50">
            </a>
        </div>
        <div class="nav-center">
            <ul class="nav-links" role="menubar">
                <li role="none"><a href="index2.html" role="menuitem">Inicio</a></li>
                <li role="none"><a href="PRODUCTO.html" role="menuitem">Productos</a></li>
                <li role="none"><a href="SERVICIOS.html" role="menuitem">Servicios</a></li>
                <li role="none"><a href="ACERCA_DE.html" role="menuitem">Acerca de</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <ul class="nav-actions" role="menubar">
                <li role="none">
                    <a href="pages/NOTIFICACION.html" role="menuitem" aria-label="Notificaciones">
                        <i class="fas fa-bell"></i>
                    </a>
                </li>
                <li role="none">
                    <a href="productos/CARRITO_DE_COMPRAS.html" role="menuitem" aria-label="Carrito de Compras">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                <li role="none">
                    <a href="index.html" class="logout-button" role="menuitem">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container text-center mt-4">
        <h1>Bienvenido usuario a Acerca de</h1>
    </div>

    <br>


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Historia de nuestra empresa</h2>
                <p>Texto sobre la historia de la empresa...</p>
                <h2>Filosofía de la empresa</h2>
                <p>Nuestra filosofía se basa en...</p>
            </div>
            <div class="col-md-6">
                <h3>Contáctanos</h3>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" placeholder="Tu nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" placeholder="email@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensaje</label>
                        <textarea class="form-control" rows="3" placeholder="Escribe tu mensaje..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p>&copy; 2024 Finca al Día. Todos los derechos reservados.</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

