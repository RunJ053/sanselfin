@extends('layouts.index')

@section('title','La Finca al Día - Frutas y Verduras Frescas')

@section('content')

<nav class="main-nav" aria-label="Navegación principal">
    <!-- Logo -->
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo-link">
            <img src="{{ asset('img/logo/icon.png') }}" alt="Logo de La Finca al Día" width="120" height="40">
        </a>
    </div>

    <!-- Enlaces de navegación centrales -->
    <div class="nav-center">
        <ul class="nav-links" role="menubar">
        </ul>
    </div>

    <!-- Acciones de la derecha -->
    <div class="nav-right">
        <ul class="nav-actions" role="menubar">
            <li role="none">
                <a href="{{ route('login') }}" role="menuitem" aria-label="Ayuda">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Login</span>
                </a>
            </li>
        </ul>

        <!-- Botón hamburguesa -->
        <button class="menu-toggle" onclick="toggleMobileMenu()" aria-expanded="false" aria-label="Menú">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

<!-- Overlay para móvil -->
<div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileMenu()"></div>

<!-- Menú móvil -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <button class="mobile-menu-close" onclick="closeMobileMenu()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Acciones móvil -->
    <ul class="mobile-nav-actions">
        <li>
            <a href="{{ route('login') }}">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>Login</span>
            </a>
        </li>
    </ul>
</div>
<main>
        <!-- Sección Hero -->
        <section data-aos="zoom-in-down" class="hero" aria-labelledby="hero-title">
            <div class="container">
                <div class="hero-text">
                    <h1 data-aos="fade-down" id="hero-title">La Finca al Día</h1>
                    <p class="welcome-text" data-aos="fade-up" data-aos-delay="300">
                        Bienvenido, Descubre la forma más fácil y conveniente de comprar vegetales frescos directamente
                        de la finca. Nuestro software de venta en línea te ofrece una experiencia única y de calidad.
                    </p>
                </div>
                <div data-aos="fade-up" data-aos-delay="600" class="hero-info">
                    <p>Descubre más productos</p>
                    <a href="#" class="button" onclick="showAlert2()">Explorar Productos</a>
                </div>
            </div>
        </section>

        <!-- Sección de Productos -->
        <x-index-carousel />

        <!-- Sección "Más para ti" -->
        <section data-aos="fade-up" class="mas_para_ti" aria-labelledby="features-title">
            <div class="container">
                <h4 id="features-title">Lo Mejor para Ti</h4>
                <h2>Productos Seleccionados</h2>
                <p>Conoce los productos que hemos seleccionado especialmente para ti, combinando estilo y frescura.</p>
                
                <div class="features-grid">
                    <div class="feature-item">
                        <h4><i class="fa-solid fa-star"></i> Calidad Garantizada</h4>
                        <p>Tus productos son seleccionados con los más altos estándares de calidad.</p>
                    </div>
                    <div class="feature-item">
                        <h4><i class="fa-solid fa-truck-pickup"></i> Entrega Rápida</h4>
                        <p>Disfruta de un servicio de entrega eficiente para que tus productos lleguen a tiempo.</p>
                    </div>
                    <div class="feature-item">
                        <h4><i class="fa-solid fa-check-to-slot"></i> Productos Destacados</h4>
                        <p>Puedes descubrir nuestra selección especial de productos que están marcando la diferencia este mes.</p>
                    </div>
                    <div class="feature-item">
                        <h4><i class="fa-solid fa-people-carry-box"></i> Atención Personalizada</h4>
                        <p>Nuestro equipo está siempre disponible para ofrecerte una atención personalizada.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Blog -->
        <section class="blog">
            <div data-aos="fade-down" data-aos-easing="linear" class="container">
                <h2>Descubre las características claves de nuestro software de compra de vegetales</h2>
                <hr>
                
                <div class="blog-grid">
                    <div class="blog-item">
                        <img src="img/product/Fresas.jpeg" alt="Fresas frescas">
                        <div class="content">
                            <h4>Compra vegetales frescos y de calidad con facilidad</h4>
                            <p>Ofrecemos una amplia gama de características y beneficios para facilitar la compra de vegetales frescos y de calidad.</p>
                        </div>
                    </div>
                    
                    <div class="blog-item">
                        <img src="img/es_de_frutas_y_verduras_1.webp" alt="Variedad de frutas y verduras">
                        <div class="content">
                            <h3>Encuentra una variedad de vegetales frescos en un solo lugar</h3>
                            <p>Navega por nuestra amplia sección de vegetales frescos y encuentra todo lo que necesitas para tus comidas saludables.</p>
                            <button><a href="user/LOGIN.html">¡Me interesa!</a></button>
                        </div>
                    </div>
                    
                    <div class="blog-item">
                        <img src="img/111.webp" alt="Entrega a domicilio">
                        <div class="content">
                            <h3>Recibe tus vegetales directamente en tu puerta</h3>
                            <p>Te ofrecemos entregas rápidas y confiables para que disfrutes de vegetales frescos sin salir de tu hogar.</p>
                            <button><a href="user/LOGIN.html">¡Comprar ahora!</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<footer data-aos="fade-up"
    data-aos-duration="100"
    class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">
                <!-- Sección de información de la empresa -->
                <div class="footer-section">
                    <img src="{{asset('img/logo/icon.png')}}" alt="Logo Finca al Día" class="footer-logo">
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
                        <li><a href="{{route('producto')}}">Nuestros Productos</a></li>
                        <li><a href="{{route('servicio')}}">Sobre Nosotros</a></li>
                        <li><a href="{{route('acerca_de')}}">FAQ</a></li>
                    </ul>
                </div>
                <!-- Sección de contacto -->
                <div class="footer-section">
                    <h3>Contacto</h3>
                    <div class="contact-info">
                        <p><i class="fas fa-clock"></i> Lunes a Sábados, 8:00 a.m a 6:00 p.m</p>
                        <p><i class="fas fa-map-marker-alt"></i> 
                            <a href="https://share.google/uCjgbp9lKkg6hyuRB" target="_blank" rel="noopener noreferrer"> Tv. 94 L #88-08, Bogotá</a>
                        </p>
                        <p><i class="fas fa-envelope"></i> fincaaldia25@gmail.com</p>
                        <p><i class="fas fa-phone"></i> 300 123 4567</p>
                    </div>
                </div>
                <!-- Sección de newsletter -->
                <div class="footer-section">
                    <h3>Boletín Informativo</h3>
                    <p>Suscríbete para recibir ofertas especiales y noticias sobre productos frescos.</p>
                    <form class="newsletter-form" id="newsletter-form" method="POST" action="{{route('subscribe')}}">
                        @csrf
                        <input type="email" name="email" placeholder="Tu correo electrónico" required>
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
                <img src="{{asset('img/logo/visa.png')}}" alt="Visa">
                <img src="{{asset('img/logo/logo-Mastercard.png')}}" alt="Mastercard">
                <img src="{{asset('img/logo/nequi.png')}}" alt="Nequi">
            </div>
        </div>
    </div>
</footer>
@endsection