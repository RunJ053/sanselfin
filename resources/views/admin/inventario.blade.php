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
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('inventario.index') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-chart-bar me-2"></i>Reportes</a></li>
      <li class="nav-item mt-5"><a class="nav-link text-danger" href="{{ url('INDEX_ADMI.html') }}"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
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
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('inventario.index') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-chart-bar me-2"></i>Reportes</a></li>
    <li class="nav-item mt-5"><a class="nav-link text-danger" href="{{ url('INDEX_ADMI.html') }}"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
  </ul>
</div>

<!-- Contenido Principal -->
<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Inventario</h2>
    <a href="{{ route('producto.create') }}" class="btn btn-primary">
      <i class="fas fa-plus me-1"></i>Nuevo Producto
    </a>
  </div>

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
          <p class="fs-4">
            @php
              $categorias = $inventarios->pluck('categoria_id')->unique();
              echo count($categorias);
            @endphp
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover inventory-table">
      <thead class="table-dark">
        <tr>
          <th>Código</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Categoría</th>
          <th>promociones</th>
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
      <td>{{ $item->descripccion}}</td>
      <td>{{ $item->categorias->nombre }}</td>
      <td>{{ $item->promociones->nombre_promocion }}</td>
      <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
      <td>{{ $item->impuestos->nombre_impuesto }}</td>
      <td>
        <a href="{{ route('productos.edit', $item->id) }}" class="btn btn-sm btn-warning mb-1">
          <i class="fas fa-edit"></i>
        </a>

        <form action="{{ route('productos.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger mb-1">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      </td>
    </tr>
  @endforeach
</tbody>
    </table>
  </div>
</div>

  <!-- Footer -->
  <footer class="footer mt-5">
    <div class="footer-top py-5">
      <div class="container">
        <div class="row footer-grid">
          <div class="col-md-3 footer-section">
            <img src="{{ asset('img/logo/icon.png') }}" alt="Logo Finca al Día" class="footer-logo mb-3">
            <p>Llevamos los productos más frescos del campo a tu mesa.</p>
            <div class="social-links mt-3">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
          </div>

          <div class="col-md-3 footer-section">
            <h3>Enlaces Rápidos</h3>
            <ul class="footer-links">
              <li><a href="#">Nuestros Productos</a></li>
              <li><a href="#">Recetas</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Sobre Nosotros</a></li>
              <li><a href="#">FAQ</a></li>
            </ul>
          </div>

          <div class="col-md-3 footer-section">
            <h3>Contacto</h3>
            <p><i class="fas fa-clock"></i> Lunes a Sábados, 8:00 a.m a 6:00 p.m</p>
            <p><i class="fas fa-map-marker-alt"></i> [Tu dirección aquí]</p>
            <p><i class="fas fa-envelope"></i> informacion@gmail.com</p>
            <p><i class="fas fa-phone"></i> 300 123 4567</p>
          </div>

          <div class="col-md-3 footer-section">
            <h3>Boletín Informativo</h3>
            <p>Suscríbete para recibir ofertas y novedades.</p>
            <form class="newsletter-form">
              <input type="email" class="form-control mb-2" placeholder="Tu correo electrónico" required>
              <button type="submit" class="btn btn-suscribir">Suscribirse</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom text-center py-3">
      <div class="container">
        <p class="mb-2">&copy; 2024 Finca al Día. Todos los derechos reservados.</p>
        <div class="payment-methods">
          <img src="{{ asset('img/logo/visa.png') }}" alt="Visa">
          <img src="{{ asset('img/logo/logo-Mastercard.png') }}" alt="Mastercard">
          <img src="{{ asset('img/logo/nequi.png') }}" alt="Nequi">
        </div>
      </div>
    </div>
  </footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>