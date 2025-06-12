<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/PRODUCTO.CSS">
    <link rel="stylesheet" href="css/NAV.css">
</head>
<body>
    <header>
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
                            <span class="visually-hidden">Notificaciones</span>
                        </a>
                    </li>
                    <li role="none">
                        <a href="productos/CARRITO_DE_COMPRAS.html" role="menuitem" aria-label="Carrito de Compras">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="visually-hidden">Carrito de Compras</span>
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
    </header>
<main>
    <aside>
        <ul>
            <li class="filter" data-category="Frutas">Frutas</li>
            <li class="filter" data-category="Verduras">Verduras</li>
            <li class="filter" data-category="Hortaliza">Hortaliza</li>
            <li class="filter" data-category="Legumbres">Legumbres</li>
        </ul>
    </aside>
    <section class="products_co">
        <div class="product" data-name="Manzana" data-description="Calificación ⭐⭐⭐⭐."  data-valor="Precio sugerido: $4.000" data-image="img/product/mann.jfif">
            <img class="image" src="img/product/mann.jfif" alt="logo">
            <div class="info">
                <h3>Manzana</h3>
                <p>Calificación ⭐⭐⭐⭐</p>
                <p>Precio sugerido: $4.000</p>
            </div>
        </div>
        <div class="product" data-name="Zanahoria" data-description="Calificación ⭐⭐⭐⭐." data-valor="En descuento: $3.500" data-image="img/product/zha.jfif">
            <img class="image" src="img/product/zha.jfif" alt="logo">
            <div class="info">
                <h3>Zanahoria</h3>
                <p>Calificación ⭐⭐⭐⭐</p>
                <p class="discount">En descuento</p>
                <p>Precio sugerido: $3.500</p>
            </div>
        </div>
        <div class="product" data-name="Naranja" data-description="Calificación ⭐⭐⭐" data-valor="En descuento: $5.300" data-image="img/product/naj.jfif">
            <img class="image" src="img/product/naj.jfif" alt="logo">
            <div class="info">
                <h3>Naranja</h3>
                <p>Calificación ⭐⭐⭐</p>
                <p class="discount">En descuento</p>
                <p>Precio sugerido: $5.300</p>
            </div>
        </div>
        <div class="product" data-name="Arracacha" data-description="Calificación ⭐⭐⭐⭐." data-valor="En descuento: $3.500" data-image="img/product/arra.jpg">
            <img class="image" src="img/product/arra.jpg" alt="logo">
            <div class="info">
                <h3>Arracacha</h3>
                <p>Calificación ⭐⭐⭐⭐</p>
                <p>Precio sugerido: $2.800</p>
            </div>
        </div>
        <div class="product" data-name="Lechuga" data-description="Calificación ⭐⭐⭐⭐⭐." data-valor="Precio sugerido: $5.800" data-image="img/product/lechuga.webp">
            <img class="image" src="img/product/lechuga.webp" alt="logo">
            <div class="info">
                <h3>Lechugacha</h3>
                <p>Calificación ⭐⭐⭐⭐⭐</p>
                <p>Precio sugerido: $5.800</p>
            </div>
        </div>
    </section>
</main>

<div class="conteiner" id="productModal">
    <div class="modal-content">
        <button class="close-modal">&times;</button>
        <div class="modal-body">
            <!-- Imagen del producto -->
            <img id="modalImage" class="modal-image" src="" alt="Imagen del producto">
            <!-- Información del producto -->
            <div class="modal-info">
                <h2 id="modalTitle"></h2>
                <p id="modalDescription"></p>
                <h4 id="modalValor"></h4>
                <div class="modal-actions">
                    <input type="number" id="productQuantity" min="1" placeholder="Cantidad">
                    <button class="add-carrito" id="addToCart">Añadir al carrito</button>
                </div>
            </div>
        </div>
        <div class="buttons_ex" id="modalButtons">
            <button id="continueShopping">Seguir comprando</button>
            <button id="goToCart">Ir al carrito</button>
        </div>
    </div>
</div>

<script src="js/modal.js"></script>
<script src="js/hamburguesa.js"></script>

</body>
</html>