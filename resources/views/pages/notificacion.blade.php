<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones y Compras</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/NOTIFICACIONES.css">
    <link rel="stylesheet" href="../css/NAV.css">
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
</head>
<body>
    <nav class="main-nav" aria-label="Navegación principal">
        <div class="nav-left">
            <a href="../index2.html" class="logo-link">
                <img src="../img/logo/icon.png" alt="Logo de La Finca al Día" width="150" height="50">
            </a>
        </div>
        <div class="nav-center">
            <ul class="nav-links" role="menubar">
                <li role="none"><a href="../index2.html" role="menuitem">Inicio</a></li>
                <li role="none"><a href="../PRODUCTO.html" role="menuitem">Productos</a></li>
                <li role="none"><a href="../SERVICIOS.html" role="menuitem">Servicios</a></li>
                <li role="none"><a href="../ACERCA_DE.html" role="menuitem">Acerca de</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <ul class="nav-actions" role="menubar">
                <li role="none">
                    <a href="../pages/NOTIFICACION.html" role="menuitem" aria-label="Notificaciones">
                        <i class="fas fa-bell"></i>
                        <span class="visually-hidden">Notificaciones</span>
                    </a>
                </li>
                <li role="none">
                    <a href="../productos/CARRITO_DE_COMPRAS.html" role="menuitem" aria-label="Carrito de Compras">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="visually-hidden">Carrito de Compras</span>
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
    <div class="container">
        <!-- Barra de búsqueda -->
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Buscar en mis compras...">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </div>

        <!-- Tabs de navegación -->
        <div class="tabs">
            <button class="tab active" data-tab="current">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                En Curso
            </button>
            <button class="tab" data-tab="recent">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                </svg>
                Recientes
            </button>
        </div>
        <!-- Compras en curso -->
        <div id="current" class="purchases-section active">
            <div class="purchase-card">
                <div class="purchase-header">
                    <img src="/api/placeholder/100/100" alt="Manzanas" class="product-image">
                    <div class="product-details">
                        <h3 class="product-title">Manzanas Orgánicas</h3>
                        <p class="product-meta">Cantidad: 2 | $24.99</p>
                        <div class="rating">⭐⭐⭐⭐⭐</div>
                        <span class="status-badge preparing">En preparación</span>
                    </div>
                </div>
                <div class="purchase-details">
                    <p>Entrega estimada: 6 de febrero, 2025</p>
                    <p>Tracking: SP123456789</p>
                </div>
            </div>
        </div>
        <!-- Compras recientes -->
        <div id="recent" class="purchases-section">
            <div class="purchase-card">
                <div class="purchase-header">
                    <img src="/api/placeholder/100/100" alt="Guisantes" class="product-image">
                    <div class="product-details">
                        <h3 class="product-title">Guisantes Frescos</h3>
                        <p class="product-meta">Cantidad: 1 | $15.99</p>
                        <span class="status-badge delivered">Entregado</span>
                    </div>
                </div>
                <div class="purchase-details">
                    <p>Entregado el: 1 de febrero, 2025</p>
                    <button class="refund-button"><a href="../facturacion/REEMBOLSO.html">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 2v6h6"></path>
                            <path d="M3 13a9 9 0 1 0 3-7.7L3 8"></path>
                        </svg>
                        Solicitar Reembolso
                    </a></button>
                </div>
            </div>

            <div class="purchase-card">
                <div class="purchase-header">
                    <img src="/api/placeholder/100/100" alt="Naranjas" class="product-image">
                    <div class="product-details">
                        <h3 class="product-title">Naranjas Valencia</h3>
                        <p class="product-meta">Cantidad: 3 | $18.99</p>
                        <span class="status-badge delivered">Entregado</span>
                    </div>
                </div>
                <div class="purchase-details">
                    <p>Entregado el: 30 de enero, 2025</p>
                    <button class="refund-button"><a href="../facturacion/REEMBOLSO.html">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 2v6h6"></path>
                            <path d="M3 13a9 9 0 1 0 3-7.7L3 8"></path>
                        </svg>
                        Solicitar Reembolso
                    </a></button>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/noti.js"></script>
    <script src="../js/hamburguesa.js"></script>
</body>
</html>