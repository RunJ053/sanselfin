<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - La Finca al Día</title>
    <link rel="stylesheet" href="CSS/NAV.CSS">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">    
    <nav class="main-nav" aria-label="Navegación principal">
        <div class="nav-left">
            <a href="index2.html" class="logo-link">
                <img src="img/logo/icon.png" alt="Logo de La Finca al Día" width="150" height="50">
            </a>
        </div>
        <div class="nav-center">
            <ul class="nav-links" role="menubar">
                <li role="none"><a href="INDEX_ADMI.html" role="menuitem">Inicio</a></li>
                <li role="none"><a href="admin/PRODUCTOS_RECI.html" role="menuitem">Productos agregados</a></li>
                <li role="none"><a href="admin/Reporte.html" role="menuitem">Reporte</a></li>
                <li role="none"><a href="admin/ver_pedidos.html" role="menuitem">Pedidos</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <ul class="nav-actions" role="menubar">
                <li role="none">
                    <a href="pages/NOTIFICACIÓN_ADMIN.html" role="menuitem" aria-label="Notificaciones">
                        <i class="fas fa-bell"></i>
                        <span class="visually-hidden">Notificaciones</span>
                    </a>
                </li>
                <li role="none">
                    <a href="index.html" class="logout-button" role="menuitem">Cerrar Sesión</a>
                </li>
            </ul>
            <button class="menu-toggle" onclick="toggleMenu()" aria-expanded="false" aria-label="Menú">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    
    <main class="container mt-4">
        <section class="text-center">
            <h2>Bienvenido, Administrador</h2>
            <p>Desde aquí puedes gestionar todos los aspectos del negocio.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="../admin/PRODUCTOS_RECI.html" class="btn btn-primary">Administrar Productos</a>
                <a href="../admin/ver_pedidos.html" class="btn btn-secondary">Ver Pedidos</a>
                <a href="../admin/Reporte.html" class="btn btn-warning">Ver Reportes</a>
            </div>
        </section>
    </main>
    
    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; 2025 La Finca al Día - Panel de Administración</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
