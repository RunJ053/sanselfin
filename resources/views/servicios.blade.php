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
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'segoe': ['Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif'],
          },
          backgroundImage: {
            'gradient-custom': 'linear-gradient(to bottom, #cfe8a9, #f8f4e3)',
          }
        }
      }
    }
  </script>
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
            <a href="{{ route('ayuda_cliente')}}" role="menuitem" aria-label="Ayuda">
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
          <a href="{{ route('ayuda_cliente') }}">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>Necesito Ayuda</span>
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
  <main class="max-w-3xl mx-auto mt-8 px-4">
    <div class="grid grid-cols-1 gap-6" id="accordionExample">

      <!-- Accordion Item 1 -->
      <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
        <h2 class="m-0 text-xl cursor-pointer text-gray-800 hover:text-green-500 transition-colors duration-200"
          onclick="toggleAccordion('collapseOne')">
          <button class="flex items-center w-full text-left focus:outline-none"
            aria-expanded="true" aria-controls="collapseOne">
            <h5 class="m-0 flex items-center gap-3">
              <i class="fas fa-truck text-red-500"></i>
              Entrega a Domicilio Rápida y Segura
            </h5>
            <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200" id="icon-collapseOne"></i>
          </button>
        </h2>
        <div id="collapseOne" class="mt-4 transition-all duration-300 ease-in-out max-h-96 overflow-hidden">
          <div class="text-gray-700 leading-relaxed">
            <p>Te llevamos las verduras frescas hasta la puerta de tu casa con opciones de entrega en el mismo día o programadas.</p>
          </div>
        </div>
      </div>

      <!-- Accordion Item 2 -->
      <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
        <h2 class="m-0 text-xl cursor-pointer text-gray-800 hover:text-green-500 transition-colors duration-200"
          onclick="toggleAccordion('collapseTwo')">
          <button class="flex items-center w-full text-left focus:outline-none"
            aria-expanded="false" aria-controls="collapseTwo">
            <h5 class="m-0 flex items-center gap-3">
              <i class="fa-solid fa-handshake text-red-500"></i>
              Suscripciones Personalizadas
            </h5>
            <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200" id="icon-collapseTwo"></i>
          </button>
        </h2>
        <div id="collapseTwo" class="mt-4 transition-all duration-300 ease-in-out max-h-0 overflow-hidden">
          <div class="text-gray-700 leading-relaxed">
            <p>Programa entregas regulares de tus verduras favoritas según tus cantidades y frecuencia preferidas.</p>
          </div>
        </div>
      </div>

      <!-- Accordion Item 3 -->
      <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
        <h2 class="m-0 text-xl cursor-pointer text-gray-800 hover:text-green-500 transition-colors duration-200"
          onclick="toggleAccordion('collapseThree')">
          <button class="flex items-center w-full text-left focus:outline-none"
            aria-expanded="false" aria-controls="collapseThree">
            <h5 class="m-0 flex items-center gap-3">
              <i class="fa-regular fa-bell text-red-500"></i>
              Selección de Productos Locales y Orgánicos
            </h5>
            <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200" id="icon-collapseThree"></i>
          </button>
        </h2>
        <div id="collapseThree" class="mt-4 transition-all duration-300 ease-in-out max-h-0 overflow-hidden">
          <div class="text-gray-700 leading-relaxed">
            <p>Ofrecemos verduras frescas de temporada y una línea especial de productos orgánicos.</p>
          </div>
        </div>
      </div>

      <!-- Accordion Item 4 -->
      <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
        <h2 class="m-0 text-xl cursor-pointer text-gray-800 hover:text-green-500 transition-colors duration-200"
          onclick="toggleAccordion('collapseCuatro')">
          <button class="flex items-center w-full text-left focus:outline-none"
            aria-expanded="false" aria-controls="collapseCuatro">
            <h5 class="m-0 flex items-center gap-3">
              <i class="fa-solid fa-heart text-red-500"></i>
              Asesoramiento Nutricional
            </h5>
            <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200" id="icon-collapseCuatro"></i>
          </button>
        </h2>
        <div id="collapseCuatro" class="mt-4 transition-all duration-300 ease-in-out max-h-0 overflow-hidden">
          <div class="text-gray-700 leading-relaxed">
            <p>Recibe consejos de expertos sobre cómo incorporar más verduras en tu dieta y recomendaciones personalizadas.</p>
          </div>
        </div>
      </div>

      <!-- Accordion Item 5 -->
      <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
        <h2 class="m-0 text-xl cursor-pointer text-gray-800 hover:text-green-500 transition-colors duration-200"
          onclick="toggleAccordion('collapseQuinto')">
          <button class="flex items-center w-full text-left focus:outline-none"
            aria-expanded="false" aria-controls="collapseQuinto">
            <h5 class="m-0 flex items-center gap-3">
              <i class="fa-solid fa-location-dot text-red-500"></i>
              Pedidos a Granel y Personalizados
            </h5>
            <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200" id="icon-collapseQuinto"></i>
          </button>
        </h2>
        <div id="collapseQuinto" class="mt-4 transition-all duration-300 ease-in-out max-h-0 overflow-hidden">
          <div class="text-gray-700 leading-relaxed">
            <p>Realiza pedidos grandes o selecciona las cantidades exactas que necesitas según tu preferencia.</p>
          </div>
        </div>
      </div>

      <!-- Accordion Item 6 -->
      <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
        <h2 class="m-0 text-xl cursor-pointer text-gray-800 hover:text-green-500 transition-colors duration-200"
          onclick="toggleAccordion('collapseSeis')">
          <button class="flex items-center w-full text-left focus:outline-none"
            aria-expanded="false" aria-controls="collapseSeis">
            <h5 class="m-0 flex items-center gap-3">
              <i class="fa-solid fa-comments-dollar text-red-500"></i>
              Promociones Exclusivas y Ofertas Especiales
            </h5>
            <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200" id="icon-collapseSeis"></i>
          </button>
        </h2>
        <div id="collapseSeis" class="mt-4 transition-all duration-300 ease-in-out max-h-0 overflow-hidden">
          <div class="text-gray-700 leading-relaxed">
            <p>Accede a descuentos, promociones y ofertas exclusivas para clientes frecuentes.</p>
          </div>
        </div>
      </div>

      <!-- Accordion Item 7 -->
      <div class="bg-white border border-gray-300 rounded-lg p-4 shadow-md">
        <h2 class="m-0 text-xl cursor-pointer text-gray-800 hover:text-green-500 transition-colors duration-200"
          onclick="toggleAccordion('collapseSiete')">
          <button class="flex items-center w-full text-left focus:outline-none"
            aria-expanded="false" aria-controls="collapseSiete">
            <h5 class="m-0 flex items-center gap-3">
              <i class="fa-regular fa-star text-red-500"></i>
              Garantía de Calidad
            </h5>
            <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200" id="icon-collapseSiete"></i>
          </button>
        </h2>
        <div id="collapseSiete" class="mt-4 transition-all duration-300 ease-in-out max-h-0 overflow-hidden">
          <div class="text-gray-700 leading-relaxed">
            <p>Si un producto no cumple tus expectativas, ofrecemos reembolso o reemplazo sin inconvenientes.</p>
          </div>
        </div>
      </div>

    </div>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    function toggleAccordion(targetId) {
      const element = document.getElementById(targetId);
      const icon = document.getElementById(`icon-${targetId}`);

      if (element.classList.contains('max-h-0')) {
        // Abrir
        element.classList.remove('max-h-0');
        element.classList.add('max-h-96');
        icon.classList.add('rotate-180');
      } else {
        // Cerrar
        element.classList.add('max-h-0');
        element.classList.remove('max-h-96');
        icon.classList.remove('rotate-180');
      }
    }

    // Inicializar el primer accordion como abierto
    document.addEventListener('DOMContentLoaded', function() {
      const firstAccordion = document.getElementById('collapseOne');
      const firstIcon = document.getElementById('icon-collapseOne');
      firstAccordion.classList.remove('max-h-0');
      firstAccordion.classList.add('max-h-96');
      firstIcon.classList.add('rotate-180');
    });
  </script>
</body>

</html>