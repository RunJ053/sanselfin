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

  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    .main-content {
      padding: 20px;
    }

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

    @media (min-width: 768px) {
      .main-content {
        margin-left: 250px;
      }
    }
  </style>
  
</head>


<body>

  <!-- Botón hamburguesa -->
  <button class="btn btn-success d-md-none m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Sidebar móvil -->
  <div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="sidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Finca al Día</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-carrot me-2"></i>Reportes</a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
                  <li class="nav-item mt-5"><a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>

        </form>

      </ul>
    </div>
  </div>

  <!-- Sidebar escritorio -->
  <div class="sidebar bg-success text-white p-3 d-none d-md-block position-fixed" style="width:250px; height:100vh;">
    <div class="text-center mb-4">
      <img src="img/logo/icon.png" alt="Logo" class="img-fluid" width="100" />
      <h5 class="mt-2">Finca al Día</h5>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-carrot me-2"></i>Reportes</a></li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>

      <li class="nav-item mt-5"><a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
    </ul>
  </div>

  <!-- Contenido principal -->
  <main class="main-content">
    <section>
      <div class="d-flex justify-content-between align-items-center mb-4">
  <h2>Galería Visual de Productos</h2>
  <a href="{{ route('dashboard.index') }}" class="btn btn-outline-success">
    <i class="fas fa-sync-alt"></i> Recargar Galería
  </a>
</div>

@if($agrupados->isNotEmpty())
  @foreach($agrupados as $categoria => $lista)
    <div class="categoria-section">
      <div class="categoria-title">{{ $categoria }}</div>
      <div class="row g-4">
        @foreach($lista as $p)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="producto-card">
              <img src="{{ asset('img/product/'.$p->imagen) }}" alt="{{ $p->nombre_producto }}">
              <div class="producto-info text-center">
                <strong>{{ $p->nombre_producto }}</strong><br>
                <small class="text-muted">${{ number_format($p->precio_unitario, 2, ',', '.') }}</small><br>
                <span class="badge bg-{{ $p->stock > 0 ? 'success' : 'danger' }}">
                  {{ $p->stock > 0 ? 'Stock: '.$p->stock : 'Agotado' }}
                </span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
@else
  <div class="alert alert-info">No hay productos con imágenes para mostrar.</div>
@endif
    </section>
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