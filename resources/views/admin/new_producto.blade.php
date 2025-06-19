    <!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
        <link rel="stylesheet" href="{{ asset('css/nuevo_producto.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <h2>Registrar Nuevo Producto</h2>
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label for="codigo">Código del Producto</label>
            <input type="text" name="codigo" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre del Producto</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="categoria">Categoría</label>
            <input type="text" name="categoria" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="valor_unitario">Valor Unitario</label>
            <input type="number" name="valor_unitario" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" required>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" accept="image/*" required>
        </div>

        <button type="submit">Registrar Producto</button>
        <div class="form-group">
        <a href="{{ route('inventario.index') }}" class="btn btn-ver-productos">Ver producto</a>
    </div>

        </form>
    </div>
    </body>

    </html>
