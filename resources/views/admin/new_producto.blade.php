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
            <form action="{{ route('producto.guardar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre del Producto</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select name="Categoria" id="">
                        <option value="">Selecione la categoria</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" required>
                </div>

                <div class="form-group">
                    <label for="valor_unitario">Valor Unitario</label>
                    <input type="number" name="valor_unitario" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="stock">Impuesto</label>
                    <select name="Impuesto" id="">
                        <option value="">Selecione el Impuesto</option>
                        @foreach ($impuestos as $impuesto)
                        <option value="{{ $impuesto->id }}">{{ $impuesto-> descripcion}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">Promocion</label>
                    <select name="Promocion" id="">
                        <option value="">Selecciona una promocion</option>
                        @foreach ($promociones as $promocion)
                        <option value="{{ $promocion->id }}">{{ $promocion-> descuento}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" accept=".jpg,.jpeg,.png" required>
                </div>
                <button type="submit">Registrar Producto</button>

                <div class="form-group">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-ver-productos">Regresar a ver productos</a>
                </div>
            </form>
        </div>
    </body>

    </html>