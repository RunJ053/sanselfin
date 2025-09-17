<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Dashboard Inventario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS personalizado -->
  <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon" />
  <link rel="stylesheet" href="{{ asset('css/reporte_admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

  <!-- Bootstrap y Chart.js -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* HEADER estilo similar a la primera imagen */
    .header-bar {
      position: fixed;
      top: 10px;
      left: 10px;
      right: 10px;
      z-index: 1030;
      border-radius: 18px;
      padding: 8px 20px;
      display: flex;
      align-items: center;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
      background: linear-gradient(90deg, #5cc05f 0%, #3a9b3a 100%);
    }

    .header-brand img {
      height: 44px;
      width: auto;
    }

    .header-brand .brand-text {
      font-weight: 700;
      color: #fff;
      margin-left: 10px;
      letter-spacing: 0.2px;
    }

    .nav-links .nav-link {
      color: rgba(255, 255, 255, 0.95);
      font-weight: 600;
      text-decoration: none;
      /* quita la raya */
    }

    .nav-links .nav-link:hover {
      color: #f8f9fa;
      text-decoration: none;
      /* no mostrar raya al pasar el mouse */
    }


    .user-area {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .user-welcome {
      color: #fff;
      font-weight: 600;
      margin-right: 6px;
    }

    .logout-btn {
      background: #ffda3a;
      color: #1a1a1a;
      border-radius: 22px;
      padding: 6px 11px;
      font-weight: 600;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
      border: none;
    }

    /* Ajuste del contenido principal para que no quede debajo del header */
    .main-content {
      padding: 24px;
      margin-top: 106px;
    }

    /* ajustar si cambias la altura del header */

    /* Restantes estilos originales */
    .chart-container {
      position: relative;
      height: 350px;
      width: 100%;
      max-width: 700px;
      margin: 0 auto;
    }

    .chart-card,
    .table-card {
      background-color: white;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .tarea-card {
      background-color: #f9f9f9;
      border-left: 4px solid #ffc107;
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 10px;
    }

    .tarea-card.hecha {
      border-left-color: #28a745;
      background-color: #eaf6ea;
    }

    .tarea-acciones a {
      margin-right: 6px;
    }

    .grafico-contenedor {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
      align-items: center;
    }

    .grafico-contenedor canvas {
      background: #fff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      width: 300px !important;
      height: 300px !important;
      max-width: 100%;
    }

    .tarea-acciones a {
      margin-right: 5px;
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }

      /* se muestra el toggler en móvil */
      .user-welcome {
        display: none;
      }

      .header-bar {
        left: 6px;
        right: 6px;
        top: 6px;
        padding: 8px 12px;
      }

      .main-content {
        margin-top: 96px;
        padding: 12px;
      }
    }

    .card-hover {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }
  </style>
</head>

<body>
  <main>
    <x-admin.nav-bar :notificaciones="$notificaciones ?? []" />
    <!-- Contenido principal -->
    <div class="main-content container mx-auto px-4">
      <!-- Encabezado -->
      <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Galería Visual de Productos</h2>
        <a href="{{ route('galeria.index') }}"
          class="mt-3 md:mt-0 inline-flex items-center gap-2 border border-green-600 text-green-600 px-4 py-2 rounded-lg hover:bg-green-600 hover:text-white transition">
          <i class="fas fa-sync-alt"></i> Recargar Galería
        </a>
      </div>

      @if($agrupados->isNotEmpty())
      @foreach($agrupados as $categoria => $lista)
      <!-- Sección por categoría -->
      <div class="mb-10">
        <div class="flex items-center gap-2 mb-4 bg-green-50 border-l-4 border-green-500 px-4 py-2 rounded-md">
          <i class="fas fa-tag text-green-600"></i>
          <h3 class="text-lg md:text-xl font-semibold text-gray-700">{{ $categoria }}</h3>
        </div>

        <!-- Grid de productos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          @foreach($lista as $p)
          <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition card-hover">
            <img src="{{ asset('img/product/'.$p->imagen) }}"
              alt="{{ $p->nombre_producto }}"
              class="w-full h-40 object-cover">
            <div class="p-4 text-center">
              <p class="font-bold text-gray-800">{{ $p->nombre_producto }}</p>
              <p class="text-gray-500 text-sm mb-2">
                ${{ number_format($p->precio_unitario, 2, ',', '.') }}
              </p>
              <span class="px-3 py-1 rounded-full text-xs font-semibold
                  {{ $p->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $p->stock > 0 ? 'Stock: '.$p->stock : 'Agotado' }}
              </span>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
      @else
      <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-md" role="alert">
        <p>No hay productos con imágenes para mostrar.</p>
      </div>
      @endif
    </div>
  </main>
  <!-- Footer -->
  <footer class="footer mt-5">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-section">
          <img src="{{asset('img/logo/icon.png')}}" alt="Logo" class="footer-logo">
          <p>Llevamos los productos más frescos del campo a tu mesa.</p>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
          </div>
        </div>

        <div class="footer-section">
          <h3>Enlaces Rápidos</h3>
          <a href="#">Nuestros Productos</a><br>
          <a href="#">Recetas</a><br>
          <a href="#">Blog</a><br>
          <a href="#">Sobre Nosotros</a><br>
          <a href="#">FAQ</a>
        </div>

        <div class="footer-section">
          <h3>Contacto</h3>
          <p><i class="fas fa-clock"></i> Lunes a Sábados, 8:00 a.m a 6:00 p.m</p>
          <p><i class="fas fa-map-marker-alt"></i> [Tu dirección aquí]</p>
          <p><i class="fas fa-envelope"></i> informacion@gmail.com</p>
          <p><i class="fas fa-phone"></i> 300 123 4567</p>
        </div>

        <div class="footer-section">
          <h3>Boletín Informativo</h3>
          <p>Suscríbete para recibir ofertas y novedades frescas.</p>
          <form class="newsletter-form">
            <input type="email" placeholder="Tu correo electrónico" required>
            <button type="submit" class="btn btn-success mt-2">Suscribirse</button>
          </form>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p class="mb-2">&copy; 2024 Finca al Día. Todos los derechos reservados.</p>
      <div class="payment-methods">
        <img src="img/logo/visa.png" alt="Visa">
        <img src="img/logo/logo-Mastercard.png" alt="Mastercard">
        <img src="img/logo/nequi.png" alt="Nequi">
      </div>
    </div>
  </footer>
  </main>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>