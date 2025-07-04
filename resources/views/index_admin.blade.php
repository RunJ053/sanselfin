<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>La Finca al Día - Panel Admin</title>
  <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/ADMINISTRADOR.CSS') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>

<!-- Botón hamburguesa para móviles -->
<button class="btn btn-success d-md-none m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
  <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Offcanvas para móviles -->
<div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="sidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Finca al Día</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('inventario.index') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-carrot me-2"></i>Reportes</a></li>
      <li class="nav-item mt-5"><a class="nav-link text-danger" href="{{ url('index.html') }}"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
    </ul>
  </div>
</div>

<!-- Sidebar fijo para pantallas grandes -->
<div class="sidebar bg-success text-white p-3 d-none d-md-block" style="width:250px; height:100vh; position:fixed;">
  <div class="text-center mb-4">
    <img src="{{ asset('img/logo/icon.png') }}" alt="Logo" class="img-fluid" width="100" />
    <h5 class="mt-2">Finca al Día</h5>
  </div>
  <ul class="nav flex-column">
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('inventario.index') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
    <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="fas fa-carrot me-2"></i>Reportes</a></li>
    <li class="nav-item mt-5"><a class="nav-link text-danger" href="{{ url('index.html') }}"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
  </ul>
</div>

<!-- Contenido principal -->
<div class="main-content bg-light p-3" style="margin-left: 250px;">
  <section class="hero bg-white p-4 rounded shadow-sm mb-4">
    <div class="row align-items-center">
      <div class="col-md-6 text-start">
        <h2 class="fw-bold">Bienvenido, Administrador</h2>
        <p class="text-muted">Gracias por iniciar sesión en <strong>La Finca al Día</strong>. Administra tus productos y pedidos fácilmente.</p>
      </div>
      <div class="col-md-6 text-center">
        <img src="{{ asset('img/es_de_frutas_y_verduras_1.png') }}" alt="Bienvenida" class="hero-img img-fluid rounded">
      </div>
    </div>
  </section>

  <!-- Tarjetas -->
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mb-4">
    <div class="col">
      <div class="card bg-primary text-white shadow">
        <div class="card-body">
          <h5><i class="fas fa-users me-2"></i>Usuarios</h5>
          <p>2 registrados</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card bg-success text-white shadow">
        <div class="card-body">
          <h5><i class="fas fa-carrot me-2"></i>Productos</h5>
          <p>25 disponibles</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card bg-warning text-dark shadow">
        <div class="card-body">
          <h5><i class="fas fa-warehouse me-2"></i>Stock</h5>
          <p>5 unidades</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card bg-danger text-white shadow">
        <div class="card-body">
          <h5><i class="fas fa-shopping-cart me-2"></i>Pedidos</h5>
          <p>12 activos</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Carrusel -->
  <section class="products mt-5">
    <h3 class="mb-4 text-center">Nuestros Productos</h3>
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="d-flex flex-column flex-sm-row justify-content-center gap-4 flex-wrap">
            <div class="card text-center" style="width: 16rem;">
              <img src="{{ asset('img/product/tomate.jpg') }}" class="product-img card-img-top" alt="Tomates">
              <div class="card-body">
                <h5 class="card-title">Tomates Frescos</h5>
                <p class="card-text">Precio: $3000 por kg</p>
              </div>
            </div>
            <div class="card text-center" style="width: 16rem;">
              <img src="{{ asset('img/product/lechuga.webp') }}" class="product-img card-img-top" alt="Lechuga">
              <div class="card-body">
                <h5 class="card-title">Lechuga Orgánica</h5>
                <p class="card-text">Precio: $8000 por unidad</p>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="d-flex flex-column flex-sm-row justify-content-center gap-4 flex-wrap">
            <div class="card text-center" style="width: 16rem;">
              <img src="{{ asset('img/product/zha.jfif') }}" class="product-img card-img-top" alt="Zanahorias">
              <div class="card-body">
                <h5 class="card-title">Zanahorias Dulces</h5>
                <p class="card-text">Precio: $20000 por kg</p>
              </div>
            </div>
            <div class="card text-center" style="width: 16rem;">
              <img src="{{ asset('img/product/naj.jfif') }}" class="product-img card-img-top" alt="Naranja">
              <div class="card-body">
                <h5 class="card-title">Naranja</h5>
                <p class="card-text">Precio: $10000 por kg</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded-circle"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded-circle"></span>
      </button>
    </div>
  </section>
</div>

<!-- Footer -->
<footer class="footer mt-5">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-section">
        <img src="{{ asset('img/logo/icon.png') }}" alt="Logo" class="footer-logo">
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

  <div class="footer-bottom text-center py-3">
    <p class="mb-2">&copy; 2024 Finca al Día. Todos los derechos reservados.</p>
    <div class="payment-methods">
      <img src="{{ asset('img/logo/visa.png') }}" alt="Visa">
      <img src="{{ asset('img/logo/logo-Mastercard.png') }}" alt="Mastercard">
      <img src="{{ asset('img/logo/nequi.png') }}" alt="Nequi">
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
