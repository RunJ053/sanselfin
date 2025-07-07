<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Inventario</title>
  <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/INVENTARIO.CSS') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>

<!-- Botón hamburguesa móvil -->
<button class="btn btn-success d-md-none m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
  <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="sidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Inventario</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-chart-bar me-2"></i>Reportes</a></li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
            <li class="nav-item mt-5"><a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
        </form>
      </ul>
  </div>
</div>

<!-- Sidebar fijo para escritorio -->
<div class="sidebar bg-success text-white p-3 d-none d-md-block position-fixed" style="width:250px; height:100vh;">
  <div class="text-center mb-4">
    <img src="{{ asset('img/logo/icon.png') }}" alt="Logo" class="img-fluid" width="100" />
    <h5 class="mt-2">Inventario</h5>
  </div>
  <ul class="nav flex-column">
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-chart-bar me-2"></i>Reportes</a></li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>

        <li class="nav-item mt-5"><a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
      </ul>
</div>

<!-- Contenido principal -->
<div class="main-content" style="margin-left:250px; padding:20px;">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Inventario</h2>
    <a href="{{ route('producto.create') }}" class="btn btn-primary">
      <i class="fas fa-plus me-1"></i>Nuevo Producto
    </a>
  </div>

  <!-- Estadísticas -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card bg-success text-white shadow">
        <div class="card-body">
          <h5><i class="fas fa-dollar-sign me-2"></i>Valor Total Inventario</h5>
          <p class="fs-4">
            @php
              $total = $inventarios->sum('precio_unitario');
              echo number_format($total, 0, ',', '.');
            @endphp
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-primary text-white shadow">
        <div class="card-body">
          <h5><i class="fas fa-boxes me-2"></i>Productos Totales</h5>
          <p class="fs-4">{{ count($inventarios) }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-warning text-dark shadow">
        <div class="card-body">
          <h5><i class="fas fa-tags me-2"></i>Total Categorías</h5>
          <p class="fs-4">{{ count($categorias) }}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabla de productos -->
  <div class="table-responsive">
    <table class="table table-striped table-hover inventory-table">
      <thead class="table-dark">
        <tr>
          <th>Código</th>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Descripción</th>
          <th>Valor Unitario</th>
          <th>Impuesto</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($inventarios as $item)
        <tr>
          <td>{{ $item->id }}</td>
          <td>{{ $item->nombre_producto }}</td>
          <td>{{ $item->categorias->nombre ?? 'Sin categoría' }}</td>
          <td>{{ $item->promociones->nombre_promocion ?? 'Sin promoción' }}</td>
          <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
          <td>{{ $item->impuestos->nombre_impuesto ?? 'Sin impuesto' }}</td>
          <td>
            <a href="{{ route('producto.edit', $item->id) }}" class="btn btn-sm btn-warning mb-1">
              <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('producto.destroy', $item->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('¿Estás seguro de eliminar este producto?');">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
