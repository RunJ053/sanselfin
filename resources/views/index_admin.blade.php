<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Inventario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon y CSS -->
  <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon" />
  <link rel="stylesheet" href="{{ asset('css/reporte_admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

  <!-- Bootstrap y Chart.js -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>

  <!-- Iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

 <style>
    /* HEADER estilo*/
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
      text-decoration: none; /* quita la raya */
    }

    .nav-links .nav-link:hover {
      color: #f8f9fa;
      text-decoration: none; /* no mostrar raya al pasar el mouse */
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
  <button class="navbar-toggler ms-3 d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
    <span class="navbar-toggler-icon" style="filter: invert(1)"></span>
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
      <div class="d-flex align-items-center gap-3">
        <div class="user-welcome">
          <i class="fas fa-user-circle me-1"></i>
          {{ session('nombre_usuario') ?? Auth::user()->nombre ?? Auth::user()->nomb_usu ?? 'Administrador' }}
        </div>

        <!-- campana al lado del usuario -->
      <a href="{{ route('admin.noti_admin') }}" class="btn btn-link text-white position-relative p-0" style="font-size: 1rem;">
        <i class="fas fa-bell"></i>
        @if(!empty($notificaciones) && count($notificaciones) > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{ count($notificaciones) }}
          </span>
        @endif
      </a>

        <!-- botón salir -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Salir
          </button>
        </form>
      </div>
    @else
      <a href="{{ route('login') }}" class="logout-btn">
        <i class="fas fa-exclamation-circle"></i> Login
      </a>
    @endauth
  </div>
</header>


  <!-- CONTENIDO PRINCIPAL -->
  <main class="main-content container-fluid">
    <div class="bg-light p-3">
      <section class="hero bg-white p-4 rounded shadow-sm mb-4">
        <div class="row align-items-center">
          <div class="col-md-6 text-start">
            <h2 class="fw-bold">Bienvenido, Administrador</h2>
            <p class="text-muted">Gracias por iniciar sesión en <strong>La Finca al Día</strong>. Administra tus productos y pedidos fácilmente.</p>
          </div>
          <div class="col-md-6 text-center">
            <i class="fas fa-user" style="margin-block-end: 5px;"></i>
            @auth
              <p style="margin-top: 15px;">Bienvenido, {{ session('nombre_usuario') ?? Auth::user()->nombre ?? Auth::user()->nomb_usu }}!</p>
            @else
              <p>Por favor, inicia sesión.</p>
            @endauth
          </div>
        </div>
      </section>

      @if(auth()->check() && auth()->user()->role == 2)
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mb-4">
        <!-- Tarjeta Usuarios -->
        <div class="col">
          <a href="{{ route('usuario.index') }}" class="text-decoration-none">
            <div class="card bg-primary text-white shadow h-100 card-hover">
              <div class="card-body">
                <h5><i class="fas fa-users me-2"></i>Usuarios</h5>
                <p>
                  @if (isset($numeroUsuarios))
                    Usuarios Registrados: {{ $numeroUsuarios }}
                  @else
                    Información de usuarios no disponible
                  @endif
                </p>
              </div>
            </div>
          </a>
        </div>

        <!-- Tarjeta Productos -->
        <div class="col">
          <a href="{{ route('tarjeta.Producto') }}" class="text-decoration-none">
            <div class="card bg-success text-white shadow h-100 card-hover">
              <div class="card-body">
                <h5><i class="fas fa-carrot me-2"></i>Productos</h5>
                <p>{{ isset($inventarios) ? count($inventarios) : 0 }}</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Tarjeta Stock -->
        <div class="col">
          <a href="{{ route('tarjeta.Stock') }}" class="text-decoration-none">
            <div class="card bg-warning text-dark shadow h-100 card-hover">
              <div class="card-body">
                <h5><i class="fas fa-warehouse me-2"></i>Stock</h5>
                <p>
                  @if (isset($cantidadMax) && isset($cantidadMin))
                    Máximo: {{ $cantidadMax }} unidades, 
                    Mínimo: {{ $cantidadMin }} unidades
                  @else
                    Información de stock no disponible
                  @endif
                </p>
              </div>
            </div>
          </a>
        </div>

        <!-- Tarjeta Pedidos -->
        <div class="col">
          <a href="{{ route('tarjeta.Pedido') }}" class="text-decoration-none">
            <div class="card bg-danger text-white shadow h-100 card-hover">
              <div class="card-body">
                <h5><i class="fas fa-shopping-cart me-2"></i>Pedidos</h5>
                <p>12 activos</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endif

      <section>
        <h2 class="mb-4"><i class="fas fa-chart-bar me-2"></i>Dashboard General</h2>

        <!-- Gráfico productos por categoría -->
        <div class="chart-card mb-4">
          <h5 class="mb-3">📊 Productos por Categoría</h5>
          <div class="chart-container">
            <canvas id="graficoCategorias"></canvas>
          </div>
        </div>

        <div class="row">
          <!-- Resumen de Tareas -->
          <div class="col-md-6">
            <div class="chart-card mb-4">
              <h5 class="mb-3">📈 Resumen de Tareas</h5>
              <div class="chart-container">
                <canvas id="graficoTareas"></canvas>
              </div>
            </div>
          </div>

          <!-- Gestión de Tareas -->
          <div class="col-md-6">
            <div class="chart-card mb-4">
              <h5 class="mb-3">📝 Gestión de Tareas</h5>

              <!-- Formulario -->
              <form method="POST" action="{{ route('tarea.store') }}" class="row g-3 mb-3">
                @csrf
                <div class="col-md-4"><input type="text" name="tarea_titulo" class="form-control" placeholder="Título" required></div>
                <div class="col-md-4"><input type="text" name="tarea_descripcion" class="form-control" placeholder="Descripción (opcional)"></div>
                <div class="col-md-2">
                  <select name="tarea_tipo" class="form-select">
                    <option value="pendiente">Pendiente</option>
                    <option value="hecha">Hecha</option>
                  </select>
                </div>
                <div class="col-md-2"><button class="btn btn-success w-100">Agregar</button></div>
              </form>

              <!-- Listado -->
              <div class="row">
                <div class="col-md-6">
                  <h6 class="text-warning">Pendientes</h6>
                  @forelse($pendientes ?? [] as $tarea)
                    <div class="tarea-card">
                      <strong>{{ $tarea->titulo }}</strong>
                      <p class="mb-1">{{ $tarea->descripcion }}</p>
                      <small>{{ $tarea->fecha_creacion }}</small>
                      <div class="tarea-acciones mt-2">
                        <a href="{{ route('tarea.hecha', $tarea->id) }}" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                        <a href="{{ route('tarea.eliminar', $tarea->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </div>
                  @empty
                    <p class="text-muted">No hay tareas pendientes.</p>
                  @endforelse
                </div>

                <div class="col-md-6">
                  <h6 class="text-success">Hechas</h6>
                  @forelse($hechas ?? [] as $tarea)
                    <div class="tarea-card hecha">
                      <strong>{{ $tarea->titulo }}</strong>
                      <p class="mb-1">{{ $tarea->descripcion }}</p>
                      <small>{{ $tarea->fecha_creacion }}</small>
                      <div class="tarea-acciones mt-2">
                        <a href="{{ route('tarea.eliminar', $tarea->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </div>
                  @empty
                    <p class="text-muted">No hay tareas echas.</p>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Productos recientes -->
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
                      <img src="{{ asset('img/product/' . $producto->imagen) }}" width="45" height="45" style="object-fit:cover; border-radius:6px;">
                    @else
                      Sin imagen
                    @endif
                  </td>
                  <td>{{ $producto->nombre_producto }}</td>
                  <td>{{ $producto->descripccion }}</td>
                  <td>${{ number_format($producto->precio_unitario ?? 0, 0, ',', '.') }}</td>
                  <td>{{ $producto->categorias->nombre ?? 'Sin categoría' }}</td>
                  <td>{{ \Carbon\Carbon::parse($producto->created_at)->format('Y-m-d') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="paginador d-flex justify-content-center">
              {{ $productosRecientes->links() }}
            </div>
          </div>
        </div>

      </section>
    </div>
  </main>

  <!-- Chart.js Scripts -->
  <script>
    const ctxCatEl = document.getElementById('graficoCategorias');
    if (ctxCatEl) {
      const ctxCat = ctxCatEl.getContext('2d');
      const gradient = ctxCat.createLinearGradient(0, 0, 0, 300);
      gradient.addColorStop(0, 'rgba(42, 193, 50, 0.4)');
      gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

      new Chart(ctxCat, {
        type: 'bar',
        data: {
          labels: {!! json_encode($dataCat->isNotEmpty() ? array_keys($dataCat->toArray()) : []) !!},
          datasets: [{
            label: "Cantidad de productos",
            data: {!! json_encode($dataCat->isNotEmpty() ? array_values($dataCat->toArray()) : []) !!},
            backgroundColor: gradient,
            borderWidth: 1,
            borderColor: '#2d2d2d',
            hoverBackgroundColor: '#606060',
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { display: false },
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
    }

    @if (!empty($labelsTareas) && !empty($datosTareas))
    const ctxTareasEl = document.getElementById('graficoTareas');
    if (ctxTareasEl) {
      const ctxTareas = ctxTareasEl.getContext('2d');
      new Chart(ctxTareas, {
        type: 'doughnut',
        data: {
          labels: {!! json_encode($labelsTareas) !!},
          datasets: [{
            label: "Tareas",
            data: {!! json_encode($datosTareas) !!},
            backgroundColor: ['#ffc107', '#28a745'],
            borderColor: '#fff',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom',
              labels: { color: '#444' }
            }
          }
        }
      });
    }
    @endif
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
