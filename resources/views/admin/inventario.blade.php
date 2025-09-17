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

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

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

  tr {
    text-align: center;
  }
</style>

<body>
  <x-admin.nav-bar :notificaciones="$notificaciones ?? []" />
  <!-- Contenido principal -->
  <div class="main-content" style="margin-left:20px; padding:20px;">
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
      <table id="inventarioTable" class="table table-striped table-hover inventory-table">
        <thead class="table-dark">
          <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>U. Medida</th>
            <th>Valor Unitario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($inventarios as $item)
          <tr>
            <td><img src="{{ asset('img/product/' . $item->imagen) }}" alt="Imagen {{ $item->nombre_producto }}" width="70" height="70"></td>
            <td>{{ $item->nombre_producto }}</td>
            <td>{{ $item->categorias->nombre ?? 'Sin categoría' }}</td>
            @if ($item->stock <= 5)
              <td style="color: red; font-weight: bold;">{{ $item->stock ?? 'Sin stock' }}</td>
              @elseif ($item->stock >= 6 && $item->stock <= 30)
                <td style="color: orange; font-weight: bold;">{{ $item->stock ?? 'Sin stock' }}</td>
                @else
                <td style="color: darkgreen; font-weight: bold;">{{ $item->stock ?? 'Sin stock' }}</td>
                @endif
                <td>{{ $item->unidadMedida->abreviatura ?? 'No se encontro unidad de medida' }}</td>
                <td>${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
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
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Inicializar DataTable
      $('#inventarioTable').DataTable({
        "language": {
          "lengthMenu": "Mostrar _MENU_ registros por página",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "No hay registros disponibles",
          "infoFiltered": "(filtrado de _MAX_ registros totales)",
          "search": "Buscar:",
          "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
          }
        },
        "pageLength": 10,
        "lengthMenu": [5, 10, 25, 50, 100]
      });

      // SweetAlert2 para eliminar
      const forms = document.querySelectorAll('.form-eliminar');
      forms.forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          Swal.fire({
            title: '¿Estás seguro?',
            text: "Este producto será eliminado permanentemente.",
            imageUrl: "{{ asset('img/logo/icon.png') }}",
            imageWidth: 80,
            imageHeight: 80,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          });
        });
      });

      // Alertas de éxito o error
      @if(session('success'))
      Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('
        success ') }}',
        imageUrl: "{{ asset('img/logo/icon.png') }}",
        imageWidth: 80,
        imageHeight: 80,
        confirmButtonColor: '#28a745'
      });
      @endif

      @if(session('error'))
      Swal.fire({
        icon: 'error',
        title: '¡Error!',
        text: '{{ session('
        error ') }}',
        imageUrl: "{{ asset('img/logo/icon.png') }}",
        imageWidth: 80,
        imageHeight: 80,
        confirmButtonColor: '#d33'
      });
      @endif
    });
  </script>
</body>

</html>