<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - La Finca al Día</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/NAV.css">
</head>
<body class="bg-light">
    <header class="bg-dark text-white p-3">
        <h1 class="text-center">Reportes</h1>
    </header>
    <nav class="main-nav" aria-label="Navegación principal">
        <div class="nav-left">
            <a href="INDEX_ADMI.html" class="logo-link">
                <img src="../img/logo/icon.png" alt="Logo de La Finca al Día" width="150" height="50">
            </a>
        </div>
        <div class="nav-center">
            <ul class="nav-links" role="menubar">
                <li role="none"><a href="../INDEX_ADMI.html" role="menuitem">Inicio</a></li>
                <li role="none"><a href="../admin/PRODUCTOS_RECI.html" role="menuitem">Productos agregados</a></li>
                <li role="none"><a href="../admin/Reporte.html" role="menuitem">Reporte</a></li>
                <li role="none"><a href="../admin/ver_pedidos.html" role="menuitem">Pedidos</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <ul class="nav-actions" role="menubar">
                <li role="none">
                    <a href="../pages/NOTIFICACIÓN_ADMIN.html" role="menuitem" aria-label="Notificaciones">
                        <i class="fas fa-bell"></i>
                        <span class="visually-hidden">Notificaciones</span>
                    </a>
                </li>
                <li role="none">
                    <a href="../index.html" class="logout-button" role="menuitem">Cerrar Sesión</a>
                </li>
            </ul>
            <button class="menu-toggle" onclick="toggleMenu()" aria-expanded="false" aria-label="Menú">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2 class="text-center">Resumen de Ventas</h2>
        <canvas id="ventasChart" class="mb-4"></canvas>
        
        <h3 class="mt-4">Detalles de Ventas</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-03-22</td>
                    <td>Manzanas</td>
                    <td>10</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td>2025-03-22</td>
                    <td>Leche</td>
                    <td>5</td>
                    <td>$15.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; 2025 La Finca al Día - Panel de Administración</p>
    </footer>
    
    <script>
        const ctx = document.getElementById('ventasChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
                datasets: [{
                    label: 'Ventas Mensuales ($)',
                    data: [500, 700, 1200, 900, 1500],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
