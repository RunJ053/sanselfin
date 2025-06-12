<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones del Administrador</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/NOTIFICACIONES.css">
    <link rel="stylesheet" href="../css/NAV.css">
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
</head>
<body>
    <nav class="main-nav" aria-label="Navegación principal">
        <div class="nav-left">
            <a href="../INDEX_ADMI.html" class="logo-link">
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
                    <a href="index.html" class="logout-button" role="menuitem">Cerrar Sesión</a>
                </li>
            </ul>
            <button class="menu-toggle" onclick="toggleMenu()" aria-expanded="false" aria-label="Menú">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <div class="container">
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Buscar notificación...">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </div>

        <div class="tabs">
            <button class="tab active" data-tab="nuevas">
                <i class="fas fa-bell"></i> Nuevas
            </button>
            <button class="tab" data-tab="historial">
                <i class="fas fa-history"></i> Historial
            </button>
        </div>

        <!-- Notificaciones nuevas -->
        <div id="nuevas" class="purchases-section active">
            <div class="purchase-card">
                <div class="purchase-header">
                    <img src="../img/notificaciones/alerta.png" alt="Alerta de sistema" class="product-image">
                    <div class="product-details">
                        <h3 class="product-title">Error en la base de datos</h3>
                        <p class="product-meta">Fecha: 8 de abril, 2025</p>
                        <span class="status-badge preparing">Urgente</span>
                    </div>
                </div>
                <div class="purchase-details">
                    <p>Se detectó un fallo de conexión con el servidor SQL a las 10:45 a.m.</p>
                    <p>Revise el panel de control para más detalles.</p>
                </div>
            </div>
        </div>

        <!-- Notificaciones anteriores -->
        <div id="historial" class="purchases-section">
            <div class="purchase-card">
                <div class="purchase-header">
                    <img src="../img/notificaciones/usuario.png" alt="Nuevo usuario" class="product-image">
                    <div class="product-details">
                        <h3 class="product-title">Nuevo Usuario Registrado</h3>
                        <p class="product-meta">Fecha: 6 de abril, 2025</p>
                        <span class="status-badge delivered">Registrado</span>
                    </div>
                </div>
                <div class="purchase-details">
                    <p>Usuario: Juan Pérez (correo: juanp@example.com)</p>
                    <p>Rol asignado: Cliente</p>
                </div>
            </div>

            <div class="purchase-card">
                <div class="purchase-header">
                    <img src="../img/notificaciones/informe.png" alt="Informe generado" class="product-image">
                    <div class="product-details">
                        <h3 class="product-title">Informe Semanal Generado</h3>
                        <p class="product-meta">Fecha: 5 de abril, 2025</p>
                        <span class="status-badge delivered">Completado</span>
                    </div>
                </div>
                <div class="purchase-details">
                    <p>El informe de ventas del 31 de marzo al 5 de abril está disponible.</p>
                    <p><a href="../reportes/INFORME_SEMANAL.pdf" target="_blank">Descargar informe</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/noti.js"></script>
    <script src="../js/hamburguesa.js"></script>
</body>
</html>
