<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/INVENTARIO.CSS">

</head>
<body>   
    <nav>
        <div class="nav-left">
            <img src="../img/logo/icon.png" alt="Logo">
            <div class="nav-link">
                <ul>
                    <li><a href="../INDEX_ADMI.html">Inicio</a></li>
                    <li><a href="PRODUCTOS_RECI.html">Productos</a></li>
                </ul>
            </div>
        </div>
        <div class="nav-right">
            <div class="nav-us">
                <ul>
                 <li><a href="../index.html" class="logout-button">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <header class="header">
            <h1>Gestión de Inventario</h1>
            <button class="btn-primary">Nuevo Producto</button>
        </header>

        <div class="stats">
            <div class="stat-card">
                <p>Valor Total Inventario</p>
                <p class="stat-value">$</p>
            </div>
            <div class="stat-card">
                <p>Stock Promedio</p>
                <p class="stat-value"> unidades</p>
            </div>
            <div class="stat-card">
                <p>Productos Bajo Stock</p>
                <p class="stat-value"></p>
            </div>
            <div class="stat-card">
                <p>Total Categorías</p>
                <p class="stat-value"></p>
            </div>
        </div>

        <div class="filters">
            <form method="post" action="">
                <div class="filter-group">
                    <input type="text" name="search" placeholder="Buscar productos...">
                    <select name="category">
                        <option value="1">Todas las categorías</option>
                        <option value="2">Verduras</option>
                        <option value="3">Frutas</option>
                    </select>
                    <button type="submit">Filtrar</button>
                </div>
            </form>
        </div>
        
        <table class="inventory-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>SKU</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Última Reposición</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>Freza</td>
                        <td>FRZ-053-FRU-H</td>
                        <td>Frutas</td>
                        <td>20</td>
                        <td>2000</td>
                        <td>12</td>
                        <td>
                            <button class="btn-action">Editar</button>
                            <button class="btn-action">Eliminar</button>
                        </td>
                    </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button class="btn-pagination">Anterior</button>
            <span>Página 1 de 10</span>
            <button class="btn-pagination">Siguiente</button>
        </div>
    </div>
</body>
</html>
