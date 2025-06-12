<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="../INDEX_ADMI.html">
                <img src="../img/logo/icon.png" alt="Logo" width="40" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../INDEX_ADMI.html">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="PRODUCTOS_RECI.html">Productos</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="../index.html">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <header class="text-center mt-4">
        <h1>Panel de Administración</h1>
        <h2 class="text-secondary">Productos Agregados Recientemente</h2>
    </header>

    <!-- Botón para ver los productos -->
    <div class="text-center my-4">
        <a href="INVENTARIO.html" class="btn btn-success">Ver Productos</a>
    </div>

    <!-- Contenedor de productos -->
    <section id="productos" class="container">
        <h2 class="text-center">Productos Recientes</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="../img/product/tomate.jpg" class="card-img-top" alt="Tomates frescos">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tomates Frescos</h5>
                        <p class="card-text">Precio: $2.50 por kg</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="../img/product/lechuga.webp" class="card-img-top" alt="Lechuga orgánica" width="90px" height="173px">
                    <div class="card-body text-center">
                        <h5 class="card-title">Lechuga Orgánica</h5>
                        <p class="card-text">Precio: $1.20 por unidad</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="../img/product/zha.jfif" class="card-img-top" alt="Zanahorias dulces" width="90px" height="173px">
                    <div class="card-body text-center">
                        <h5 class="card-title">Zanahorias Dulces</h5>
                        <p class="card-text">Precio: $1.80 por kg</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="../img/product/naj.jfif" class="card-img-top" alt="Naranja" width="90px" height="173px">
                    <div class="card-body text-center">
                        <h5 class="card-title">Naranja</h5>
                        <p class="card-text">Precio: $1.80 por kg</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

