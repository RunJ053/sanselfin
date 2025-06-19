@extends('layouts.index')

@section('title','La Finca al Día - Frutas y Verduras Frescas')

@section('content')

<nav class="main-nav" aria-label="Navegación principal">
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo-link">
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
                <h1 data-aos="fade-down" id="hero-title">La Finca al Día</h1>
                <p class="welcome-text"
                    style="font-weight: bold; font-size: 30px; font-family:'Courier New', Courier, monospace">
                    Bienvenido, Descubre la forma más fácil y conveniente de comprar vegetales frescos directamente
                    de la finca. Nuestro software de venta en línea te ofrece una experiencia única y de calidad.
                </p>
            </div>
            <div data-aos="fade-left" class="hero-info">
                <p>Descubre más productos</p>
                <a href="user/LOGIN.html" class="button">Explorar Productos</a>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="mas_para_ti" aria-labelledby="features-title">
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
                    <p>Puedes descubrir nuestra selección especial de productos que están marcando la diferencia
                        este mes.</p>
                </div>
                <div class="item">
                    <h4><i class="fa-solid fa-people-carry-box" aria-hidden="true"></i> Atención Personalizada</h4>
                    <p>Nuestro equipo está siempre disponible para ofrecerte una atención personalizada.</p>
                </div>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" data-aos-duration="900" class="products py-12 px-4 h-[900px]" aria-labelledby="products-title">
        <div class="container mx-auto max-w-7xl">
            <h2 id="products-title" class="text-3xl font-bold text-center mb-2 text-green-800">Nuestra Galería de Productos</h2>
            <p class="text-3xl font-bold text-center mb-2 text-green-800">Descubre nuestra selección de frutas y verduras frescas directamente del campo a tu mesa.</p>
            <div class="relative">
                <!-- Controles del carrusel -->
                <button id="prevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full shadow-md w-10 h-10 flex items-center justify-center hover:bg-gray-100">
                    <i class="fas fa-chevron-left text-gray-700"></i>
                </button>
                <button id="nextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white rounded-full shadow-md w-10 h-10 flex items-center justify-center hover:bg-gray-100">
                    <i class="fas fa-chevron-right text-gray-700"></i>
                </button>
                <!-- Carrusel -->
                <div id="carousel" class="carousel-container overflow-x-auto flex space-x-4 py-4 px-2 scroll-smooth" style="scrollbar-width: none;">
                    <!-- Producto 1 -->
                    <article class="product-item flex-shrink-0 w-64 h-100 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg flex flex-col items-center">
                        <img src="img/product/Tomate.png" alt="Tomates frescos" class="w-full h-48 object-cover" loading="lazy">
                        <div class="p-1 text-center"> <!-- Añadido text-center para centrar el texto -->
                            <h3 class="text-lg font-semibold text-gray-800">Tomates Frescos</h3>
                            <p class="price text-green-600 font-medium mt-1">$3.000/kg</p>
                            <button onclick="showAlert()" class="add-to-cart w-full bg-green-600 hover:bg-green-700 text-white px-1 py-1 rounded mt-1 transition-colors">
                                Agregar al carrito <i class="fas fa-cart-plus ml-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </article>
                    <!-- Producto 2 -->
                    <article class="product-item flex-shrink-0 w-64 h-100 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg flex flex-col items-center">
                        <img src="img/product/Cebolla larga.png" alt="Cebolla Larga" class="w-full h-48 object-cover" loading="lazy">
                        <div class="p-1 text-center">
                            <h3 class="text-lg font-semibold text-gray-800">Cebolla Larga</h3>
                            <p class="price text-green-600 font-medium mt-1">$3.500/Lb</p>
                            <button onclick="showAlert()" class="add-to-cart w-full bg-green-600 hover:bg-green-700 text-white px-1 py-1 rounded mt-1 transition-colors">
                                Agregar al carrito <i class="fas fa-cart-plus ml-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </article>

                    <!-- Producto 3 -->
                    <article class="product-item flex-shrink-0 w-64 h-100 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg flex flex-col items-center">
                        <img src="img/product/Lechuga crespa.png" alt="Lechuga Crespa" class="w-full h-48 object-cover" loading="lazy">
                        <div class="p-1 text-center">
                            <h3 class="text-lg font-semibold text-gray-800">Lechuga Crespa</h3>
                            <p class="price text-green-600 font-medium mt-1">$5.000/unidad</p>
                            <button onclick="showAlert()" class="add-to-cart w-full bg-green-600 hover:bg-green-700 text-white px-1 py-1 rounded mt-1 transition-colors">
                                Agregar al carrito <i class="fas fa-cart-plus ml-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </article>
                    <!-- Producto 4 -->
                    <article class="product-item flex-shrink-0 w-64 h-100 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg flex flex-col items-center">
                        <img src="img/product/Curuba.png" alt="Curuba" class="w-full h-48 object-cover" loading="lazy">
                        <div class="p-1 text-center">
                            <h3 class="text-lg font-semibold text-gray-800">Curuba</h3>
                            <p class="price text-green-600 font-medium mt-1">$2.800/kg</p>
                            <button onclick="showAlert()" class="add-to-cart w-full bg-green-600 hover:bg-green-700 text-white px-1 py-1 rounded mt-1 transition-colors">
                                Agregar al carrito <i class="fas fa-cart-plus ml-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </article>
                    <!-- Producto 5 -->
                    <article class="product-item flex-shrink-0 w-64 h-100 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg flex flex-col items-center">
                        <img src="img/product/Durazno.png" alt="Durazno" class="w-full h-48 object-cover" loading="lazy">
                        <div class="p-1 text-center">
                            <h3 class="text-lg font-semibold text-gray-800">Durazno</h3>
                            <p class="price text-green-600 font-medium mt-1">$6.300/kg</p>
                            <button onclick="showAlert()" class="add-to-cart w-full bg-green-600 hover:bg-green-700 text-white px-1 py-1 rounded mt-1 transition-colors">
                                Agregar al carrito <i class="fas fa-cart-plus ml-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </article>
                    <!-- Puedes agregar más productos aquí -->
                </div>
    </section>


    <section class="blog">
        <div data-aos="fade-down" data-aos-easing="linear" class="container">
            <h2 style="margin-top: 12%; display: flex; justify-content: center;">Descubre las características claves
                de</h2>
            <h2 style="display: flex; justify-content: center;">nuestro software de compra de</h2>
            <h2 style="display: flex; justify-content: center;">vegetales</h2>
            <hr>
            <div class="blog-grid">
                <div class="blog-item">
                    <img src="img/product/Fresas.jpeg" alt="">
                    <h4>Compra vegetales frescos y de calidad con facilidad</h4>
                    <p>Ofrecemos una apmlia gama de características y beneficios para facilitar la compra de
                        vegetales frescos y de calidad.</p>
                </div>
                <div class="blog-item">
                    <img src="img/es_de_frutas_y_verduras_1.webp" alt="">
                    <h3>En cuentra una variedad de vegetales frescos en un solo lugar</h3>
                    <p>Navega por nuestra amplia sección de vegetales fescos y encuentra todo lo que necesitas para
                        tus comidas dalidables. <button><a href="user/LOGIN.html">¡Me interesa!</a></button></p>
                </div>
                <div class="blog-item">
                    <img src="img/111.webp" alt="">
                    <h3>Recibe tus vegetales directamente en tu puerta</h3>
                    <p>Te ofrecemos entregas rápidas y confiables para que disfrutes de vegetales frescos sin salir
                        de tu hogar.</p><br><button><a href="user/LOGIN.html">¡Comprar ahora!</a></button>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-delay="100" data-aos-offset="0"
            class="footer-top">
            <div class="container">
                <div class="footer-grid">
                    <!-- Información de la empresa -->
                    <div class="footer-section">
                        <img src="img/logo/icon.png" alt="Logo Finca al Día" class="footer-logo" width="150"
                            height="50">
                        <p class="company-description">Llevamos los productos más frescos del campo a tu mesa,
                            garantizando calidad y frescura en cada entrega.</p>
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
                            <li><a href="#"
                                    onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')">Nuestros
                                    Productos</a></li>
                            <li><a href="#">Recetas</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#"
                                    onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')">Sobre
                                    Nosotros</a></li>
                            <li><a href="#"
                                    onclick="alert('Empieza registrandote primero. ¡Y asi puedes realizar compras!')">FAQ</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Información de contacto -->
                    <div class="footer-section">
                        <h3>Contacto</h3>
                        <address class="contact-info">
                            <p><i class="fas fa-clock" aria-hidden="true"></i> Lunes a Sábados, 8:00 a.m a 6:00 p.m
                            </p>
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
                                <input type="email" id="email-input" name="email"
                                    placeholder="Tu correo electrónico" required
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" aria-required="true">
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
    @endsection