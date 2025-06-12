<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu carrito</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/CARRITO.css">
    <link rel="stylesheet" href="../css/NAV.css">
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
    <section data-aos="zoom-in-down" class="hero">
        <div class="container">
            <div class="hero-text">
                <h2>La Finca al Día te Da La Bienvenida a</h2>
                <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">Tu Carrito Unico y Exclusivo</h1>
            </div>
        </div>
    </section>
    <div class="carrito-contenedor">
        <h1>🌿 Tu Mercado Verde de le Finca 🥕</h1>
        <div class="productos" id="lista-productos"></div>

        <div class="resumen-carrito">
            <h2>Resumen de Compra</h2>
            <div class="lista-items" id="items-carrito"></div>
            
            <div class="descuentos">
                <input type="text" id="codigo-descuento" placeholder="Código de descuento">
                <button class="boton-descuento" onclick="aplicarDescuento()">Aplicar Cupón</button>
            </div>

            <div class="total-seccion">
                <span>Total:</span>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <span id="total-compra" class="input-group-text">0.00</span>
                  </div>
            </div>
            <div class="total-seccion">
                <span>¡Ya está tu carrito Listo!</span>
                <button class="boton-descuento"><a style="text-decoration: none; color: beige;" href="../facturacion/FORMA_PAGO.html">Ir al pago</a></button>
            </div>
        </div>
    </div>
    <script src="../js/carrito.js"></script>
    <script src="../js/hamburguesa.js"></script>
</body>
</html>