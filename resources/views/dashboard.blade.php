<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Inventario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS personalizado -->
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
    .chart-card, .table-card {
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
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('inventario.index') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-carrot me-2"></i>Reportes</a></li>
      <li class="nav-item mt-5"><a class="nav-link text-danger" href="../INDEX_ADMI.html"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
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
    <li class="nav-item"><a class="nav-link text-white" href="{{ route('inventario.index') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
    <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-carrot me-2"></i>Reportes</a></li>
    <li class="nav-item mt-5"><a class="nav-link text-danger" href="../INDEX_ADMI.html"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
  </ul>
</div>

<!-- Contenido principal -->
<main class="main-content">
  <section>
    <h2 class="mb-3"><i class="fas fa-chart-bar me-2"></i>Dashboard de Productos</h2>

    <!-- Gráfico -->
    <div class="chart-card mb-4">
      <h5 class="mb-3">📊 Productos por Categoría</h5>
      <div class="chart-container">
        <canvas id="graficoCategorias"></canvas>
      </div>
    </div>

    <!-- Tabla -->
    <div class="table-card">
      <h5 class="mb-3">🆕 Productos Recientes</h5>
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-success">
            <tr>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Categoría</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody>
            @foreach($productosRecientes as $producto)
              <tr>
                <td>
                  @if ($producto->imagen)
                  <img src="{{asset('img/product/' . $producto->imagen)}}" alt="img" width="45" height="45" style="object-fit:cover; border-radius:6px;">
                  @else
                  Aun no tiene imagen el producto
                  @endif
               </td>
              
                <td>{{ $producto->nombre_producto }}</td>
                <td>{{ $producto->descripccion }}</td>
                <td>${{ number_format($producto->precio_unitario, 0, ',', '.') }}</td>
                <td>{{ $producto->categorias->nombre ?? 'Sin categoría' }}</td>
                <td>{{ \Carbon\Carbon::parse($producto->created_at)->format('Y-m-d') }}</td>
              </tr>
            @endforeach
          </tbody>
          
        </table>
        <div class="paginador" style="display: flex; justify-content: center;">
          {{ $productosRecientes->links()}}
        </div>
        
      </div>
    </div>
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

<!-- Chart.js Script -->
<script>
  const ctx = document.getElementById('graficoCategorias').getContext('2d');
  const gradient = ctx.createLinearGradient(0, 0, 0, 300);
  gradient.addColorStop(0, 'rgba(46, 125, 50, 0.4)');
  gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($dataCat->keys()) !!},
      datasets: [{
        label: 'Cantidad de productos',
        data: {!! json_encode($dataCat->values()) !!},
        backgroundColor: gradient,
        borderColor: '#2e7d32',
        borderWidth: 1,
        hoverBackgroundColor: '#66bb6a'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          backgroundColor: '#2e7d32',
          titleColor: '#fff',
          bodyColor: '#fff'
        }
      },
      scales: {
        x: {
          ticks: { color: '#555', font: { size: 12 } },
          grid: { display: false }
        },
        y: {
          beginAtZero: true,
          ticks: { stepSize: 1, color: '#555', font: { size: 12 } },
          grid: { color: 'rgba(0,0,0,0.05)' }
        }
      }
    }
  });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
