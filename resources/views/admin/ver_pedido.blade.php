<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pedidos</title>
    <link rel="stylesheet" href="../css/NAV.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="main-nav" aria-label="Navegación principal">
            <div class="nav-left">
                <a href="INDEX_ADMI.html" class="logo-link">
                    <img src="../img/logo/icon.png" alt="Logo de La Finca al Día" width="150" height="50">
                </a>
            </div>
            <div class="nav-center">
                <ul class="nav-links" role="menubar">
                    <li role="none"><a href="../INDEX_ADMI.html" role="menuitem">Inicio</a></li>
                    <li role="none"><a href="../admin/PRODUCTOS_RECI.html" role="menuitem">Productos agregados</a></li>
                    <li role="none"><a href="../admin/Reporte.html" role="menuitem">Reporte</a></li>
                    <li role="none"><a href="../admin/ver_pedidos.html" role="menuitem">Pedidos</a></li>
                </ul>
            </div>
            <div class="nav-right">
                <ul class="nav-actions" role="menubar">
                    <li role="none">
                        <a href="../pages/NOTIFICACIÓN_ADMIN.html" role="menuitem" aria-label="Notificaciones">
                            <i class="fas fa-bell"></i>
                            <span class="visually-hidden">Notificaciones</span>
                        </a>
                    </li>
                    <li role="none">
                        <a href="../index.html" class="logout-button" role="menuitem">Cerrar Sesión</a>
                    </li>
                </ul>
                <button class="menu-toggle" onclick="toggleMenu()" aria-expanded="false" aria-label="Menú">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>
    </header>
    
    <div class="container mt-4">
        <h2 class="mb-4">Ver Pedidos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Juan Pérez</td>
                    <td><span class="badge bg-success">Completado</span></td>
                    <td>$150.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Ver</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>María López</td>
                    <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                    <td>$200.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Ver</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
