
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gestión de Inventario</title>
  <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      width: 250px;
      min-height: 100vh;
      position: fixed;
    }
    .main-content {
      margin-left: 250px;
      padding: 2rem;
    }
    .btn-primary {
      background-color: #198754;
      border: none;
    }
    .inventory-table th, .inventory-table td {
      vertical-align: middle;
    }
  </style>
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
      <li class="nav-item mb-2"><a class="nav-link text-white" href="admin/PRODUCTOS_RECI.php"><i class="fas fa-boxes me-2"></i>Reportes</a></li>
      <li class="nav-item mt-5"><a class="nav-link text-danger" href="../INDEX_ADMI.html"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
    </ul>
  </div>
</div>

<!-- Sidebar fijo -->
<div class="sidebar bg-success text-white p-3 d-none d-md-block">
  <div class="text-center mb-4">
    <img src="../img/logo/icon.png" alt="Logo" class="img-fluid" width="100" />
    <h5 class="mt-2">Inventario</h5>
  </div>
  <ul class="nav flex-column">
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('inventario.index') }}"><i class="fas fa-home me-2"></i>Inicio</a></li>
      <li class="nav-item mb-2"><a class="nav-link text-white" href="{{ route('producto.index') }}"><i class="fas fa-boxes me-2"></i>Inventario</a></li>
    <li class="nav-item mb-2"><a class="nav-link text-white" href="PRODUCTOS_RECI.php"><i class="fas fa-boxes me-2"></i>Reportes</a></li>
    <li class="nav-item mt-5"><a class="nav-link text-danger" href="../INDEX_ADMI.html"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
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
              $total = 0;
              foreach ($inventarios as $item) {
                $total += $item->Valor_Unitario;
              }
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
              $categorias = $inventarios->pluck('Categoria')->unique();
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
            <td>{{ $item->categorias->nombre}}</td>  {{-- o el campo correcto --}}
            <td>{{ $item->promociones->nombre_promocion }}</td>
            <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
            <td>{{$item->impuestos->nombre_impuesto }}</td>

            <td>
              <a href="{{ url('editar_producto/' . $item->id) }}" class="btn btn-sm btn-warning mb-1">
                <i class="fas fa-edit"></i>
              </a>
              <a href="{{ url('eliminar_producto/' . $item->id) }}"
                 class="btn btn-sm btn-danger mb-1"
                 onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

