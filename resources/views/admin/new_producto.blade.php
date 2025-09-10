<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="{{ asset('css/nuevo_producto.css') }}">
    <link rel="shortcut icon" href="{{asset('img/logo/icon.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <h1>🥬 Finca Al Día</h1>
            <p>Únete a nuestra comunidad de productos frescos y naturales</p>
        </div>

        <div class="form-content">
            <h2>Registrar Nuevo Producto</h2>
            <form action="{{ route('producto.guardar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre del Producto *</label>
                    <input type="text" name="nombre" id="nombre" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="categoria" class="form-label">Categoría *</label>
                    <select name="Categoria" id="categoria" class="form-input form-select" required>
                        <option value="">Seleccione la categoría</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="descripcion" class="form-label">Descripción *</label>
                    <textarea name="descripcion" id="descripcion" class="form-input" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="cantidad" class="form-label">Cantidad *</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-input" min="1" max="100" required>
                </div>

                <div class="form-group">
                    <label for="valor_unitario" class="form-label">Valor Unitario *</label>
                    <input type="number" name="valor_unitario" id="valor_unitario" class="form-input" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="promocion" class="form-label">Promoción *</label>
                    <select name="Promocion" id="promocion" class="form-input form-select" required>
                        <option value="">Selecciona una promoción</option>
                        @foreach ($promociones as $promocion)
                        <option value="{{ $promocion->id }}">{{ $promocion->descuento }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="imagen" class="form-label">Cargue su Imagen</label>
                    <div class="file-upload">
                        <input type="file" name="imagen" id="imagen" class="form-input" accept=".jpg,.jpeg,.png">
                        <label for="doc" class="file-upload-label">📄 Seleccionar archivo</label>
                    </div>
                    <div class="info-box">
                        💡 <strong>Importante:</strong> Sube una iamgen clara del producto al registrar.
                    </div>
                </div>


                <div class="submit-container">
                    <button type="submit" class="submit-btn">Registrar Producto</button>
                </div>

                <div class="submit-container">
                    <button class="submit-btnn">
                        <a href="{{ route('admin.dashboard') }}">Regresar a ver productos</a>
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>