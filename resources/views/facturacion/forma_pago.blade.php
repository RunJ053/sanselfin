<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/NAV.css">
    <link rel="stylesheet" href="../css/FORMA_PAGO.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <main class="container my-5">
        <div class="payment-container">
            <!-- Resumen de compra -->
            <div class="total-amount mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-1">Total a pagar</h5>
                        <p class="text-muted mb-0">Resumen de tu compra</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <h3 class="mb-0 text-primary">$120.000 COP</h3>
                    </div>
                </div>
            </div>
            
            <!-- Encabezado -->
            <div class="payment-header text-center">
                <h2 class="fw-bold">Selecciona tu método de pago</h2>
                <p class="text-muted">Elige entre nuestras opciones de pago seguro</p>
            </div>
            
            <!-- Opciones de pago -->
            <div class="row g-4">
                <!-- Efectivo -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="../pages/NOTIFICACION.html" class="text-decoration-none">
                        <div class="card payment-option position-relative">
                            <div class="payment-badge">Popular</div>
                            <div class="payment-logo-container">
                                <img src="../img/logo/money.jpg" alt="Efectivo" class="payment-logo">
                            </div>
                            <div class="card-body p-0">
                                <p class="payment-name">Pago en Efectivo</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Visa -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="https://www.visa.com.co/" class="text-decoration-none">
                        <div class="card payment-option">
                            <div class="payment-logo-container">
                                <img src="../img/logo/visa.png" alt="Visa" class="payment-logo">
                            </div>
                            <div class="card-body p-0">
                                <p class="payment-name">Tarjeta Visa</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Mastercard -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="https://www.mastercard.com.co/es-co.html" class="text-decoration-none">
                        <div class="card payment-option">
                            <div class="payment-logo-container">
                                <img src="../img/logo/logo-Mastercard.png" alt="Mastercard" class="payment-logo">
                            </div>
                            <div class="card-body p-0">
                                <p class="payment-name">Tarjeta Mastercard</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Efecty -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="https://www.efecty.com.co/web/" class="text-decoration-none">
                        <div class="card payment-option">
                            <div class="payment-logo-container">
                                <img src="../img/logo/efecty.png" alt="Efecty" class="payment-logo">
                            </div>
                            <div class="card-body p-0">
                                <p class="payment-name">Efecty</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Bancolombia -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="https://www.bancolombia.com/pagos" class="text-decoration-none">
                        <div class="card payment-option">
                            <div class="payment-logo-container">
                                <img src="../img/logo/bancolo.jpg" alt="Bancolombia" class="payment-logo">
                            </div>
                            <div class="card-body p-0">
                                <p class="payment-name">Bancolombia</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Nequi -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="https://www.nequi.com.co/personas/paga-con-nequi" class="text-decoration-none">
                        <div class="card payment-option position-relative">
                            <div class="payment-badge">Rápido</div>
                            <div class="payment-logo-container">
                                <img src="../img/logo/nequi.png" alt="Nequi" class="payment-logo">
                            </div>
                            <div class="card-body p-0">
                                <p class="payment-name">Nequi</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Daviplata -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="https://www.daviplata.com/" class="text-decoration-none">
                        <div class="card payment-option">
                            <div class="payment-logo-container">
                                <img src="../img/logo/davi.png" alt="Daviplata" class="payment-logo">
                            </div>
                            <div class="card-body p-0">
                                <p class="payment-name">Daviplata</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- PSE -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card payment-option">
                            <div class="payment-logo-container">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0a/PSE_logo.svg/1280px-PSE_logo.svg.png" alt="PSE" class="payment-logo">
                            </div>
                            <div class="card-body p-0">
                                <p class="payment-name">PSE</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">
                    <!-- Sección de información de la empresa -->
                    <div class="footer-section">
                        <img src="../img/logo/icon.png" alt="Logo Finca al Día" class="footer-logo">
                        <p class="company-description">Llevamos los productos más frescos del campo a tu mesa, garantizando calidad y frescura en cada entrega.</p>
                        <div class="social-links">
                            <a href="" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                            <a href="" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <!-- Sección de enlaces rápidos -->
                    <div class="footer-section">
                        <h3>Enlaces Rápidos</h3>
                        <ul class="footer-links">
                            <li><a href="../PRODUCTO.html">Nuestros Productos</a></li>
                            <li><a href="../index2.html">Recetas</a></li>
                            <li><a href="../index2.html">Blog</a></li>
                            <li><a href="../ACERCA_DE.html">Sobre Nosotros</a></li>
                            <li><a href="../SERVICIOS.html">FAQ</a></li>
                        </ul>
                    </div>
                    <!-- Sección de contacto -->
                    <div class="footer-section">
                        <h3>Contacto</h3>
                        <div class="contact-info">
                            <p><i class="fas fa-clock"></i> Lunes a Sábados, 8:00 a.m a 6:00 p.m</p>
                            <p><i class="fas fa-map-marker-alt"></i> [Tu dirección aquí]</p>
                            <p><i class="fas fa-envelope"></i> informacion@gmail.com</p>
                            <p><i class="fas fa-phone"></i> 300 123 4567</p>
                        </div>
                    </div>
                    <!-- Sección de newsletter -->
                    <div class="footer-section">
                        <h3>Boletín Informativo</h3>
                        <p>Suscríbete para recibir ofertas especiales y noticias sobre productos frescos.</p>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Tu correo electrónico" required>
                            <button type="submit">Suscribirse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; 2024 Finca al Día. Todos los derechos reservados.</p>
                <div class="payment-methods">
                    <img src="../img/logo/visa.png" alt="Visa">
                    <img src="../img/logo/logo-Mastercard.png" alt="Mastercard">
                    <img src="../img/logo/nequi.png" alt="Nequi">
                </div>
            </div>
        </div>
    </footer>
    <script src="../js/hamburguesa.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>