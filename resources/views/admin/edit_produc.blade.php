<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="{{ asset('css/nuevo_producto.css') }}">
    <link rel="shortcut icon" href="{{asset('img/logo/icon.png')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <h1>🥬 Finca Al Día</h1>
            <p>Edita los detalles del producto seleccionado</p>
        </div>

        <div class="form-content">
            <h2>Editar Producto</h2>

            @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('productos.update', ['producto' => $producto->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre del Producto *</label>
                    <input type="text" name="nombre" id="nombre" class="form-input"
                        value="{{ old('nombre', $producto->nombre_producto) }}" required>
                </div>

                <div class="form-group">
                    <label for="Categoria" class="form-label">Categoría *</label>
                    <select name="Categoria" id="Categoria" class="form-input form-select" required>
                        <option value="">Seleccione la categoría</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ old('Categoria', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="descripcion" class="form-label">Descripción *</label>
                    <textarea name="descripcion" id="descripcion" class="form-input" rows="3" required>{{ old('descripcion', $producto->descripccion) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="valor_unitario" class="form-label">Valor Unitario *</label>
                    <input type="number" name="valor_unitario" id="valor_unitario" class="form-input"
                        step="0.01" value="{{ old('valor_unitario', $producto->precio_unitario) }}" required>
                </div>

                <div class="form-group">
                    <label for="cantidad" class="form-label">Cantidad *</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-input"
                        value="{{ old('cantidad', $producto->stock) }}" required>
                </div>

                <div class="form-group">
                    <label for="Promocion" class="form-label">Promoción *</label>
                    <select name="Promocion" id="Promocion" class="form-input form-select">
                        <option value="">Seleccione una promoción</option>
                        @foreach ($promociones as $promocion)
                        <option value="{{ $promocion->id }}"
                            {{ old('Promocion', $producto->descuento_id) == $promocion->id ? 'selected' : '' }}>
                            {{ $promocion->descuento }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="imagen" class="form-label">Imagen (opcional)</label>
                    <div class="file-upload">
                        <input type="file" name="imagen" id="imagen" class="form-input" accept=".jpg,.jpeg,.png">
                        <label for="imagen" class="file-upload-label">📄 Seleccionar archivo</label>
                    </div>
                    <div class="info-box">
                        💡 <strong>Nota:</strong> Sube una imagen clara si deseas reemplazar la actual.
                    </div>
                </div>

                <div class="submit-container">
                    <button type="submit" class="submit-btn">Actualizar Producto</button>
                </div>

                <div class="submit-container">
                    <a href="{{ route('admin.dashboard') }}" class="submit-btnn">Volver</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>