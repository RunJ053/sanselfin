<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Usuarios</title>
  <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/INVENTARIO.CSS') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
</head>
<body>

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
      box-shadow: 0 6px 18px rgba(0,0,0,0.12);
      background: linear-gradient(90deg, #5cc05f 0%, #3a9b3a 100%);
    }
    .header-brand img { height: 44px; width: auto; }
    .header-brand .brand-text { font-weight: 700; color: #fff; margin-left: 10px; letter-spacing: 0.2px; }

.nav-links .nav-link {
  color: rgba(255,255,255,0.95);
  font-weight: 600;
  text-decoration: none;
 
  padding: 6px 14px;
  border-radius: 50px; /* redondeado */
  transition: background 0.3s ease;
}
.nav-links .nav-link:hover {
  color: #fff;
  text-decoration: none;
}


    .user-area { display:flex; align-items:center; gap:12px; }
    .user-welcome { color: #fff; font-weight:600; margin-right:6px; }
    .logout-btn { background: #ffda3a; color: #1a1a1a; border-radius:22px; padding:6px 11px; font-weight:600; box-shadow: 0 2px 6px rgba(0,0,0,0.12); border: none; }

    /* Ajuste del contenido principal para que no quede debajo del header */
    .main-content { padding: 24px; margin-top: 106px; } /* ajustar si cambias la altura del header */

    /* Restantes estilos originales */
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
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      width: 300px !important;
      height: 300px !important;
      max-width: 100%;
    }

    .tarea-acciones a { margin-right: 5px; }

    @media (max-width: 768px) {
      .nav-links { display: none; } /* se muestra el toggler en móvil */
      .user-welcome { display: none; }
      .header-bar { left: 6px; right: 6px; top: 6px; padding: 8px 12px; }
      .main-content { margin-top: 96px; padding: 12px; }
    }

    .card-hover {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
      cursor: pointer;
    }

    .btn-nuevo {
  background: #28a745;
  color: #fff;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 50px; /* redondeado */
  border: none;
  transition: all 0.2s ease-in-out;
  text-decoration: none;
}
.btn-nuevo:hover {
  background: #218838;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  text-decoration: none;
}

/* Tarjetas de estadísticas redondas */
.stat-card {
  background: #fff;
  border-radius: 20px; /* esquinas redondeadas */
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  text-align: center;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.stat-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.15);
}
.stat-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%; /* icono dentro de un círculo */
  background: #5cc05f;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
  font-size: 24px;
  margin: 0 auto 12px auto;
}
  </style>
</head>

<body>
  <!-- HEADER -->
  <header class="header-bar">
    <div class="d-flex align-items-center header-brand">
      <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
        <img src="{{ asset('img/logo/icon.png') }}" alt="Logo">
        <span class="brand-text">Finca al Día</span>
      </a>
    </div>

    <!-- toggler móvil -->
    <button class="nav-toggler ms-3 d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
      <span class="nav-toggler-icon" style="filter: invert(1)"></span>
    </button>

    <!-- enlaces -->
    <nav class="ms-4 me-auto collapse d-md-flex nav-links" id="topNav">
      <ul class="navbar-nav d-flex flex-row gap-3">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-1"></i> Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-1"></i> Inventario</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-chart-bar me-1"></i> Reportes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('usuario.index') }}"><i class="fas fa-users me-1"></i> Usuarios</a></li>
      </ul>
    </nav>

    <!-- usuario -->
    <div class="user-area ms-auto">
      @auth
        <div class="user-welcome">
          <i class="fas fa-user-circle me-1"></i>
          {{ session('nombre_usuario') ?? Auth::user()->nombre ?? Auth::user()->nomb_usu ?? 'Administrador' }}
        </div>

      <a href="{{ route('admin.noti_admin') }}" class="btn btn-link text-white position-relative p-0" style="font-size: 1rem;">
      <i class="fas fa-bell"></i>
      @if(!empty($notificaciones) && count($notificaciones) > 0)
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ count($notificaciones) }}
        </span>
      @endif
    </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Salir
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="logout-btn">
          <i class="fas fa-exclamation-circle"></i> Login
        </a>
      @endauth
    </div>
  </header>

<!-- Contenido principal -->
<div class="main-content" style="margin-left:20px; padding:20px;">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Usuarios</h2>
    <a href="{{ route('usuario.create') }}" class="btn-nuevo">
      <i class="fas fa-user-plus"></i>Nuevo Usuario
    </a>
  </div>

  <!-- Estadísticas -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card bg-success text-white shadow">
        <div class="card-body">
          <h5><i class="fas fa-users me-2"></i>Total Usuarios</h5>
          <p class="fs-4">{{ count($usuarios) }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-primary text-white shadow">
        <div class="card-body">
          <h5><i class="fas fa-boxes me-2"></i>Productos Totales</h5>
          <p class="fs-4">{{ count($inventarios ?? []) }}</p>

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

  <!-- Tabla de usuarios -->
  <div class="table-responsive">
    <table class="table table-striped table-hover">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Dirección</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($usuarios as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->nombre }}</td>
          <td>{{ $user->apellidos }}</td>
          <td>{{ $user->direccion }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->telefono }}</td>
          <td>
                <!-- Botón Editar -->
                <a href="{{ route('usuario.edit', $user->id)}}" 
                class="btn btn-sm btn-warning mb-1">
                    <i class="fas fa-edit"></i>
                </a>

                <!-- Botón Eliminar -->
                <form action="{{ route('usuario.destroy', $user->id) }}" 
                    method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger mb-1" 
                            onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
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
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>