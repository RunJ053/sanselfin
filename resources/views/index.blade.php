<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>La Finca al Día - Frutas y Verduras Frescas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/logo/icon.png" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset("css/style.css") }}">
        <link rel="stylesheet" href="{{ asset("css/NAV.css") }}">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    </head>
<body>
    <nav class="main-nav" aria-label="Navegación principal">
        <div class="nav-left">
            <a href="index.html" class="logo-link">
                <img src="img/logo/icon.png" alt="Logo de La Finca al Día" width="150" height="50">
            </a>
        </div>
        <div class="nav-center">
        </div>
        <div class="nav-right">
            <ul class="nav-actions" role="menubar">
                <li role="none">
                    <a href="{{ route("login") }}" class="logout-button" role="menuitem">Iniciar Sesión</a>
                </li>
                <li role="none">
                    <a href="{{ route("registro") }}" class="logout-button" role="menuitem">Registrarse</a>
                </li>
            </ul>
            <button class="menu-toggle" onclick="toggleMenu()" aria-expanded="false" aria-label="Menú">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </nav>

    <main>
        <!-- Sección Hero -->
        <section data-aos="zoom-in-down" class="hero" aria-labelledby="hero-title">
            <div data-aos="fade-down" data-aos-delay="800" class="container">
                <div class="hero-text">
                    <h1 data-aos="fade-down" data-aos-delay="900" id="hero-title">La Finca al Día</h1>
                    <p class="welcome-text" style="font-weight: bold; font-size: 30px; font-family:'Courier New', Courier, monospace">Bienvenido, Descubre la forma más fácil y conveniente de comprar vegetales frescos directamente de la finca. Nuestro software de venta en línea te ofrece una experiencia única y de calidad.</p>
                </div>
                <div data-aos="fade-left" data-aos-delay="1000" class="hero-info">
                    <p>Descubre más productos</p>
                    <a href="user/LOGIN.html" class="button">Explorar Productos</a>
                </div>
            </div>
        </section>

        <section data-aos="fade-up"
        data-aos-duration="2800" 
        class="mas_para_ti" aria-labelledby="features-title">
            <div class="container">
                <h4 id="features-title">Lo Mejor para Ti</h4>
                <h2>Productos Seleccionados</h2>
                <p>Conoce los productos que hemos seleccionado especialmente para ti, combinando estilo y frescura.</p>
                <div class="box">
                    <div class="item">
                        <h4><i class="fa-solid fa-star" aria-hidden="true"></i> Calidad Garantizada</h4>
                        <p>Tus productos son seleccionados con los más altos estándares de calidad.</p>
                    </div>
                    <div class="item">
                        <h4><i class="fa-solid fa-truck-pickup" aria-hidden="true"></i> Entrega Rápida</h4>
                        <p>Disfruta de un servicio de entrega eficiente para que tus productos lleguen a tiempo.</p>
                    </div>
                    <div class="item">
                        <h4><i class="fa-solid fa-check-to-slot" aria-hidden="true"></i> Productos Destacados</h4>
                        <p>Puedes descubrir nuestra selección especial de productos que están marcando la diferencia este mes.</p>
                    </div>
                    <div class="item">
                        <h4><i class="fa-solid fa-people-carry-box" aria-hidden="true"></i> Atención Personalizada</h4>
                        <p>Nuestro equipo está siempre disponible para ofrecerte una atención personalizada.</p>
                    </div>
                </div>
            </div>
        </section>

        <section data-aos="fade-up"
        data-aos-duration="2000" 
        class="products" aria-labelledby="products-title">
            <div class="container">
                <h2 id="products-title">Nuestra Galería de Productos</h2>
                <p>Descubre nuestra selección de frutas y verduras frescas.</p>
                <div class="product-grid">
                    <article class="product-item">
                        <img src="img/product/Tomate.png" alt="Tomates frescos" width="200" height="200" loading="lazy">
                        <h3>Tomates Frescos</h3>
                        <p class="price">$3.000/kg</p>
                        <button onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')" class="add-to-cart" aria-label="Añadir Tomates al carrito">
                            Agregar al carrito <i class="fas fa-cart-plus" aria-hidden="true"></i>
                        </button>
                    </article>
                    <article class="product-item">
                        <img src="img/product/Cebolla larga.png" alt="Tomates frescos" width="200" height="200" loading="lazy">
                        <h3>Cebolla Larga</h3>
                        <p class="price">$3.500/Lb</p>
                        <button onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')" class="add-to-cart" aria-label="Añadir Tomates al carrito">
                            Agregar al carrito <i class="fas fa-cart-plus" aria-hidden="true"></i>
                        </button>
                    </article>
                    <article class="product-item">
                        <img src="img/product/Lechuga crespa.png" alt="Tomates frescos" width="200" height="200" loading="lazy">
                        <h3>Lechuga Crespa</h3>
                        <p class="price">$5.000/unidad</p>
                        <button onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')" class="add-to-cart" aria-label="Añadir Tomates al carrito">
                            Agregar al carrito <i class="fas fa-cart-plus" aria-hidden="true"></i>
                        </button>
                    </article>
                    <article class="product-item">
                        <img src="img/product/Curuba.png" alt="Tomates frescos" width="200" height="200" loading="lazy">
                        <h3>Curuba</h3>
                        <p class="price">$2.800/kg</p>
                        <button onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')" class="add-to-cart" aria-label="Añadir Tomates al carrito">
                            Agregar al carrito <i class="fas fa-cart-plus" aria-hidden="true"></i>
                        </button>
                    </article>
                    <article class="product-item">
                        <img src="img/product/Durazno.png" alt="Tomates frescos" width="200" height="200" loading="lazy">
                        <h3>Durazno</h3>
                        <p class="price">$6.300/kg</p>
                        <button onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')" class="add-to-cart" aria-label="Añadir Tomates al carrito">
                            Agregar al carrito <i class="fas fa-cart-plus" aria-hidden="true"></i>
                        </button>
                    </article>
                </div>
            </div>
        </section>
        <section class="blog">
            <div data-aos="fade-down"
            data-aos-easing="linear"
            data-aos-duration="1000" class="container">
                <h2 style="margin-top: 12%; display: flex; justify-content: center;">Descubre las características claves de</h2><h2 style="display: flex; justify-content: center;">nuestro software de compra de</h2><h2 style="display: flex; justify-content: center;">vegetales</h2>
                <hr>
                <div class="blog-grid">
                    <div class="blog-item">
                        <img src="img/product/Fresas.jpeg" alt="">
                        <h4>Compra vegetales frescos y de calidad con facilidad</h4>
                        <p>Ofrecemos una apmlia gama de características y beneficios para facilitar la compra de vegetales frescos y de calidad.</p>
                    </div>
                    <div class="blog-item">
                        <img src="img/es_de_frutas_y_verduras_1.png" alt="">
                        <h3>En cuentra una variedad de vegetales frescos en un solo lugar</h3>
                        <p>Navega por nuestra amplia sección de vegetales fescos y encuentra todo lo que necesitas para tus comidas dalidables. <button><a href="user/LOGIN.html">¡Me interesa!</a></button></p>
                    </div>
                    <div class="blog-item">
                        <img src="img/111.png" alt="">
                        <h3>Recibe tus vegetales directamente en tu puerta</h3>
                        <p>Te ofrecemos entregas rápidas y confiables para que disfrutes de vegetales frescos sin salir de tu hogar.</p><br><button><a href="user/LOGIN.html">¡Comprar ahora!</a></button>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer">
            <div data-aos="fade-zoom-in"
            data-aos-easing="ease-in-back"
            data-aos-delay="300"
            data-aos-offset="0" class="footer-top">
                <div class="container">
                    <div class="footer-grid">
                        <!-- Información de la empresa -->
                        <div class="footer-section">
                            <img src="img/logo/icon.png" alt="Logo Finca al Día" class="footer-logo" width="150" height="50">
                            <p class="company-description">Llevamos los productos más frescos del campo a tu mesa, garantizando calidad y frescura en cada entrega.</p>
                            <div class="social-links">
                                <a href="#" aria-label="Síguenos en Facebook" rel="noopener">
                                    <i class="fab fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="#" aria-label="Síguenos en Instagram" rel="noopener">
                                    <i class="fab fa-instagram" aria-hidden="true"></i>
                                </a>
                                <a href="#" aria-label="Contáctanos por WhatsApp" rel="noopener">
                                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Enlaces rápidos -->
                        <div class="footer-section">
                            <h3>Enlaces Rápidos</h3>
                            <ul class="footer-links">
                                <li><a href="#" onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')">Nuestros Productos</a></li>
                                <li><a href="#">Recetas</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#" onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')">Sobre Nosotros</a></li>
                                <li><a href="#" onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')">FAQ</a></li>
                            </ul>
                        </div>

                        <!-- Información de contacto -->
                        <div class="footer-section">
                            <h3>Contacto</h3>
                            <address class="contact-info">
                                <p><i class="fas fa-clock" aria-hidden="true"></i> Lunes a Sábados, 8:00 a.m a 6:00 p.m</p>
                                <p><i class="fas fa-map-marker-alt" aria-hidden="true"></i> [Tu dirección aquí]</p>
                                <p><i class="fas fa-envelope" aria-hidden="true"></i> 
                                    <a href="mailto:informacion@gmail.com">informacion@gmail.com</a>
                                </p>
                                <p><i class="fas fa-phone" aria-hidden="true"></i> 
                                    <a href="tel:+573001234567">300 123 4567</a>
                                </p>
                            </address>
                        </div>

                        <!-- Newsletter -->
                        <div class="footer-section">
                            <h3 id="newsletter-title">Boletín Informativo</h3>
                            <form class="newsletter-form" aria-labelledby="newsletter-title">
                                <div class="form-group">
                                    <label for="email-input" class="visually-hidden">Correo electrónico</label>
                                    <input 
                                        type="email" 
                                        id="email-input"
                                        name="email"
                                        placeholder="Tu correo electrónico" 
                                        required 
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                        aria-required="true"
                                    >
                                </div>
                                <button type="submit" class="btn-subscribe">Suscribirse</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <p>&copy; 2024 Finca al Día. Todos los derechos reservados.</p>
                    <div class="payment-methods" aria-label="Métodos de pago aceptados">
                        <img src="img/logo/visa.png" alt="Visa" width="50" height="30">
                        <img src="img/logo/logo-Mastercard.png" alt="Mastercard" width="50" height="30">
                        <img src="img/logo/nequi.png" alt="Nequi" width="50" height="30">
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="js/hamburguesa.js" defer></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
          </script>
    </body>
</html>