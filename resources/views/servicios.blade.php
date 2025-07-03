<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - La Finca al Día</title>
    <link rel="shortcut icon" href="img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/SERVICIOS.css')}}">
    <link rel="stylesheet" href="{{asset('css/NAV.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header>
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
                <a href="/notificaciones" role="menuitem" aria-label="Notificaciones">
                    <i class="fas fa-bell"></i>
                    <span class="visually-hidden">Notificaciones</span>
                </a>
            </li>
            <li role="none">
                <a href="/carrito" role="menuitem" aria-label="Carrito de Compras">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="visually-hidden">Carrito</span>
                </a>
            </li>
            <li role="none">
                <a href="/ayuda" role="menuitem" aria-label="Ayuda">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>Ayuda</span>
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
            <a href="/carrito">
                <i class="fas fa-shopping-cart"></i>
                <span>Carrito de Compras</span>
            </a>
        </li>
        <li>
            <a href="/ayuda">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>Necesito Ayuda</span>
            </a>
        </li>
        <li>
            <a href="/perfil">
                <i class="fas fa-user"></i>
                <span>Mi Perfil</span>
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
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h5><i class="fas fa-truck"></i> Entrega a Domicilio Rápida y Segura</h5>
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Te llevamos las verduras frescas hasta la puerta de tu casa con opciones de entrega en el mismo día o programadas.</p>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h5><i class="fa-solid fa-handshake"></i> Suscripciones Personalizadas</h5>
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Programa entregas regulares de tus verduras favoritas según tus cantidades y frecuencia preferidas.</p>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <h5><i class="fa-regular fa-bell"></i> Selección de Productos Locales y Orgánicos</h5>
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Ofrecemos verduras frescas de temporada y una línea especial de productos orgánicos.</p>
                </div>
              </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCuatro">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCuatro" aria-expanded="false" aria-controls="collapseCuatro">
                    <h5><i class="fa-solid fa-heart"></i> Asesoramiento Nutricional</h5>
                  </button>
                </h2>
                <div id="collapseCuatro" class="accordion-collapse collapse" aria-labelledby="headingCuatro" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Recibe consejos de expertos sobre cómo incorporar más verduras en tu dieta y recomendaciones personalizadas.</p>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="headingQuinto">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuinto" aria-expanded="false" aria-controls="collapseQuinto">
                    <h5><i class="fa-solid fa-location-dot"></i> Pedidos a Granel y Personalizados</h5>
                  </button>
                </h2>
                <div id="collapseQuinto" class="accordion-collapse collapse" aria-labelledby="headingQuinto" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Realiza pedidos grandes o selecciona las cantidades exactas que necesitas según tu preferencia.</p>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeis">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeis" aria-expanded="false" aria-controls="collapseSeis">
                    <h5><i class="fa-solid fa-comments-dollar"></i> Promociones Exclusivas y Ofertas Especiales</h5>
                  </button>
                </h2>
                <div id="collapseSeis" class="accordion-collapse collapse" aria-labelledby="headingSeis" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Accede a descuentos, promociones y ofertas exclusivas para clientes frecuentes.</p>
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="headingSiete">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSiete" aria-expanded="false" aria-controls="collapseSiete">
                    <h5><i class="fa-regular fa-star"></i> Garantía de Calidad</h5>
                  </button>
                </h2>
                <div id="collapseSiete" class="accordion-collapse collapse" aria-labelledby="headingSiete" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <p>Si un producto no cumple tus expectativas, ofrecemos reembolso o reemplazo sin inconvenientes.</p>
                  </div>
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
                        <img src="img/logo/icon.png" alt="Logo Finca al Día" class="footer-logo">
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
                            <li><a href="PRODUCTO.html">Nuestros Productos</a></li>
                            <li><a href="index2.html">Recetas</a></li>
                            <li><a href="index2.html">Blog</a></li>
                            <li><a href="ACERCA_DE.html">Sobre Nosotros</a></li>
                            <li><a href="SERVICIOS.html">FAQ</a></li>
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
                    <img src="img/logo/visa.png" alt="Visa">
                    <img src="img/logo/logo-Mastercard.png" alt="Mastercard">
                    <img src="img/logo/nequi.png" alt="Nequi">
                </div>
            </div>
        </div>
    </footer>

  <script src="{{ asset('js/hamburguesa.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
