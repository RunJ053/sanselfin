@extends('layouts.index2')

@section('title', 'La Finca al Día - Frutas y Verduras Frescas')

@section('content')
<header class="header">
    <nav class="main-nav" aria-label="Navegación principal">
        <!-- Logo -->
        <div class="nav-left">
            <a href="{{ route('user.dashboard') }}" class="logo-link">
                <img src="{{asset ('img/logo/icon.png')}}" alt="Logo de La Finca al Día" width="120" height="40">
            </a>
        </div>

        <!-- Enlaces de navegación centrales -->
        <div class="nav-center">
            <ul class="nav-links" role="menubar">
                <li role="none"><a href="{{ route('user.dashboard') }}" role="menuitem">Inicio</a></li>
                <li role="none"><a href="{{ route('producto') }}" role="menuitem">Productos</a></li>
                <li role="none"><a href="{{ route('servicio')}}" role="menuitem">Servicios</a></li>
                <li role="none"><a href="{{ route('acerca_de')}}" role="menuitem">Acerca de</a></li>
            </ul>
        </div>

        <!-- Acciones de la derecha -->
        <div class="nav-right">
            <ul class="nav-actions" role="menubar">
                <li role="none">
                    <a href="{{ route('notificaciones.index') }}" role="menuitem" aria-label="Notificaciones">
                        <div class="notification-container">
                            <i class="fas fa-bell"></i>
                            @if(isset($notificaciones) && $notificaciones->where('leida', false)->count() > 0)
                            @if($notificaciones->where('leida', false)->count() <= 99)
                                <span class="notification-badge">{{ $notificaciones->where('leida', false)->count() }}</span>
                                @else
                                <span class="notification-badge large-number">99+</span>
                                @endif
                                @endif
                        </div>
                        <span class="visually-hidden">Notificaciones</span>
                    </a>
                </li>

                <li role="none">
                    <a href="{{ route('carrito.index') }}" role="menuitem" aria-label="Carrito de Compras">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="visually-hidden">Carrito</span>
                    </a>
                </li>
            </ul>

            <!-- Avatar de usuario -->
            <div class="user-avatar" onclick="toggleDropdown()" role="button" aria-haspopup="true" aria-expanded="false">
                @auth <!-- Verificamos que el usuario esté autenticado -->
                @if (Auth::user()->user_img)
                <img src="{{ asset('img/usuario_img/' . Auth::user()->user_img) }}"
                    alt="Avatar de {{ Auth::user()->nombre }}"
                    class="avatar-image">
                @else
                <i class="fas fa-user"></i>
                @endif
                @endauth

                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="{{ route('myProfile') }}" class="dropdown-item">Mi Perfil</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>

                </div>
            </div>

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

        <!-- Enlaces de navegación móvil -->
        <ul class="mobile-nav-links">
            <li><a href="{{ route('user.dashboard') }}">Inicio</a></li>
            <li><a href="{{ route('producto') }}">Productos</a></li>
            <li><a href="{{ route('servicio')}}">Servicios</a></li>
            <li><a href="{{ route('acerca_de')}}">Acerca de</a></li>
        </ul>

        <!-- Acciones móvil -->
        <ul class="mobile-nav-actions">
            <li role="none">
                    <a href="{{ route('notificaciones.index') }}" role="menuitem" aria-label="Notificaciones">
                        <div class="notification-container">
                            <i class="fas fa-bell"></i>
                            @if(isset($notificaciones) && $notificaciones->where('leida', false)->count() > 0)
                            @if($notificaciones->where('leida', false)->count() <= 99)
                                <span class="notification-badge">{{ $notificaciones->where('leida', false)->count() }}</span>
                                @else
                                <span class="notification-badge large-number">99+</span>
                                @endif
                                @endif
                        </div>
                        <span class="visually-hidden">Notificaciones</span>
                    </a>
                </li>
            <li>
                <a href="{{ route('carrito.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Carrito de Compras</span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
</header>
<main>
    <!-- Sección Hero -->
    <section data-aos="zoom-in-down" class="hero" aria-labelledby="hero-title">
        <div class="container">
            <div class="hero-text">
                <h2 data-aos="fade-down">La Finca al Día:</h2>
                <h1 data-aos="fade-down" data-aos-delay="200" id="hero-title">
                    @auth
                    <p>Bienvenido, {{ session('nombre_usuario') ?? Auth::user()->nombre }}!</p>
                    @else
                    <p>Por favor, inicia sesión.</p>
                    @endauth
                </h1>
                <p class="welcome-text" data-aos="fade-up" data-aos-delay="400">
                    Descubre la forma más fácil y conveniente de comprar vegetales frescos directamente
                    de la finca. Nuestro software de venta en línea te ofrece una experiencia única y de calidad.
                </p>
            </div>
            <div data-aos="fade-left" data-aos-delay="600" class="hero-info">
                <p>Descubre más productos</p>
                <button class="button"><a href="{{ route('producto')}}">Explorar Productos</a></button>
            </div>
        </div>
    </section>

    <!-- Sección de Productos con Grid -->
    <x-usuario-carousel :productos="$productos" />

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

    <!-- Sección de Ofertas -->
    <section data-aos="fade-up" class="offers">
        <div class="container">
            <h2>Ofertas Especiales</h2>
            <div class="offer-grid">
                <div class="offer-image">
                    <img src="{{asset('img/es_de_frutas_y_verduras_1.webp')}}" alt="Ofertas Especiales">
                </div>
                <div class="offer-info">
                    <div class="offer-item">
                        <h3>Descuento en Frutas</h3>
                        <p>20% de descuento en todas las frutas esta semana.</p>
                    </div>
                    <div class="offer-item">
                        <h3>Compra 2, Lleva 3</h3>
                        <p>Compra 2 lechugas y llévate la tercera gratis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección Testimonios -->
    <section data-aos="fade-up" data-aos-delay="100" class="testimonials">
        <div class="container">
            <h2>Testimonios</h2>
            <p>¿Aún tienes dudas? Acércate a los demás para saber qué piensan sobre nosotros.</p>
            <div class="testimonial-grid">
                <div class="testimonial-item">
                    <div class="testimonial-content">
                        <p>"Los productos son siempre frescos y de alta calidad. ¡Recomiendo La Finca al Día!"</p>
                        <div class="testimonial-author">
                            <span class="author-name">Juan P.</span>
                        </div>
                    </div>
                    <div class="testimonial-image">
                        <img src="{{asset('img/logo/icon.png')}}" alt="Juan P.">
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-content">
                        <p>"Excelente servicio al cliente y entrega rápida. ¡Estoy muy satisfecha!"</p>
                        <div class="testimonial-author">
                            <span class="author-name">María G.</span>
                        </div>
                    </div>
                    <div class="testimonial-image">
                        <img src="{{asset('img/product/Carambola.png')}}" alt="María G.">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-aos="fade-up" class="preguntas">
        <div class="container">
            <h2>Preguntas Frecuentes</h2>
            <p>¿Tienes alguna pregunta? Aquí te dejamos algunas respuestas a las preguntas más frecuentes.</p>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            ¿Cómo puedo contactarlos?
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Puedes contactarnos a través de nuestro fourmulario de contacto o por teléfono.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            ¿Cómo puedo pagar?
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Aceptamos pagos en efectivo ó transferencia bancaria.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            ¿Cuál es el tiempo de entrega?
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">El tiempo de entrega es de 1 a 2 días hábiles, dependiendo de tu ubicación.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            ¿Cada cuanto hacen ofertas?
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">La mayoria de ofertas se realizan en eventos especiales.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-aos="fade-up" class="blog">
        <div class="container">
            <h2>Últimos Artículos del Blog</h2>
            <hr>
            <div data-aos="fade-up"
                data-aos-delay="100"
                class="blog-grid">
                <div class="blog-item">
                    <img src="{{asset('img/verduras_frutas_y_hortalizas_5.webp')}}" alt="">
                    <h3><a href="https://www.google.com/search?q=beneficios+de+comer+frutas&rlz=1C1GCEA_enCO1117CO1126&oq=beneficios+de+comer+frutas&gs_lcrp=EgZjaHJvbWUyCQgAEEUYORiABDIHCAEQABiABDIHCAIQABiABDIHCAMQABiABDIHCAQQABiABDIHCAUQABiABDIHCAYQABiABDIHCAcQABiABDIHCAgQABiABDIHCAkQABiABNIBCTExMzYyajBqN6gCALACAA&sourceid=chrome&ie=UTF-8">Beneficios de Comer Frutas Frescas</a></h3>
                    <p>Descubre por qué las frutas son esenciales para una dieta saludable.</p>
                </div>
                <div class="blog-item">
                    <img src="{{asset('img/verduras_frutas_y_hortalizas_6.webp')}}" alt="">
                    <h3><a href="https://www.google.com/search?q=10+beneficios+de+comer+verduras&sca_esv=c7459735fc04b658&rlz=1C1GCEA_enCO1117CO1126&sxsrf=AHTn8zrwI3Q-HQ8hEHg0TjzndM5w2BrFWg%3A1738192710510&ei=RreaZ53tHoaawbkPq9nduAY&oq=10+benfios+de+comer+verdu&gs_lp=Egxnd3Mtd2l6LXNlcnAiGTEwIGJlbmZpb3MgZGUgY29tZXIgdmVyZHUqAggAMgcQABiABBgNMgYQABgWGB4yBhAAGBYYHkiwLlAAWP0ncAF4AZABAJgBuAGgAd4ZqgEEMC4yNbgBA8gBAPgBAZgCGqACkhuoAhTCAgcQIxgnGOoCwgITEAAYgAQYQxi0AhiKBRjqAtgBAcICChAjGIAEGCcYigXCAgoQABiABBhDGIoFwgIFEAAYgATCAgsQABiABBixAxiDAcICCBAAGIAEGLEDwgILEC4YgAQYsQMY1ALCAgoQABiABBgUGIcCwgIIEAAYFhgKGB7CAgUQIRigAZgDF_EFlltSxCNuiXe6BgYIARABGAGSBwQxLjI1oAetrwE&sclient=gws-wiz-serp">Recetas Deliciosas con Verduras</a></h3>
                    <p>Explora recetas fáciles y deliciosas para incorporar más verduras en tu dieta.</p>
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