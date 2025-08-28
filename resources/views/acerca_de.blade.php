<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Finca al Día - Acerca de</title>
    <link rel="stylesheet" href="{{asset('css/ACERCA_DE.css')}}">
    <link rel="stylesheet" href="{{asset('css/NAV.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo/icon.png" type="image/x-icon">
    <link rel="shortcut icon" href={{ asset('img/logo/icon.png') }} type="image/x-icon">
</head>

<body>
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
                        <a href="{{ route('myProfile') }}" role="menuitem" aria-label="Notificaciones">
                            <i class="fas fa-bell"></i>
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
                <li>
                    <a href="/notificaciones">
                        <i class="fas fa-bell"></i>
                        <span>Notificaciones</span>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Conoce La Finca al Día</h1>
                <p class="hero-subtitle">
                    Más que un marketplace, somos tu aliado en llevar productos frescos y de calidad directamente a tu hogar
                </p>
            </div>
        </div>
    </section>

    <div class="container main-content">
        <!-- Historia Section -->
        <div class="content-card">
            <div class="section-icon">
                <i class="fas fa-seedling"></i>
            </div>
            <h2 class="section-title">Nuestra Historia</h2>
            <p class="section-text">
                Nacimos en 2020 con una visión simple pero poderosa: conectar directamente a los productores locales con las familias que buscan productos frescos y auténticos. Lo que comenzó como una pequeña iniciativa familiar, hoy se ha convertido en la plataforma de confianza para más de 10,000 hogares que valoran la calidad, frescura y el apoyo a la economía local.
            </p>
        </div>

        <!-- Filosofía Section -->
        <div class="content-card">
            <div class="section-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h2 class="section-title">Nuestra Filosofía</h2>
            <p class="section-text">
                Creemos que cada producto cuenta una historia. Desde las manos que lo cultivaron hasta la mesa donde se compartirá, nosotros somos el puente que honra esa cadena de valor. Nos enfocamos en la sostenibilidad, el comercio justo y en crear una comunidad donde productores y consumidores se beneficien mutuamente.
            </p>
        </div>

        <!-- Values Section -->
        <div class="values-section">
            <div class="values-grid">
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="value-title">Sostenibilidad</h3>
                    <p class="value-text">Promovemos prácticas agrícolas responsables que cuiden nuestro planeta para las futuras generaciones.</p>
                </div>
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="value-title">Comunidad</h3>
                    <p class="value-text">Fortalecemos los lazos entre productores locales y consumidores conscientes de nuestra región.</p>
                </div>
                <div class="value-item">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="value-title">Calidad</h3>
                    <p class="value-text">Cada producto pasa por rigurosos controles de calidad para garantizar frescura y sabor excepcionales.</p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Familias Satisfechas</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Productores Locales</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">15K+</div>
                        <div class="stat-label">Productos Entregados</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Satisfacción del Cliente</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <h3 class="contact-title">¡Conversemos!</h3>
            <p class="contact-subtitle">¿Tienes preguntas, sugerencias o quieres ser parte de nuestra comunidad? Nos encantaría escucharte</p>

            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" placeholder="Escribe tu nombre completo">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" placeholder="tu.email@ejemplo.com">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Asunto</label>
                    <input type="text" class="form-control" placeholder="¿En qué te podemos ayudar?">
                </div>
                <div class="form-group">
                    <label class="form-label">Mensaje</label>
                    <textarea class="form-control" placeholder="Comparte tus comentarios, preguntas o ideas con nosotros..."></textarea>
                </div>
                <button type="submit" class="btn-send">
                    <i class="fas fa-paper-plane"></i>
                    Enviar mensaje
                </button>
            </form>
        </div>
    </div>

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
    <script src="{{ asset('js/hamburguesa.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.content-card, .value-item, .contact-section').forEach((el) => {
            observer.observe(el);
        });

        // Add smooth scrolling for better UX
        document.documentElement.style.scrollBehavior = 'smooth';

        // Form validation (basic)
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            const inputs = this.querySelectorAll('input, textarea');
            let isValid = true;

            inputs.forEach(input => {
                if (input.hasAttribute('required') && !input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = '#e74c3c';
                } else {
                    input.style.borderColor = 'var(--border-light)';
                }
            });

            if (isValid) {
                // Here you would normally send the form data
                alert('¡Gracias por tu mensaje! Te contactaremos pronto.');
                this.reset();
            } else {
                alert('Por favor completa todos los campos requeridos.');
            }
        });
    </script>
</body>

</html>