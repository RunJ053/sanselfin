<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Editar Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre_producto) }}" required>
        </div>

        <div class="mb-3">
            <label for="Categoria" class="form-label">Categoría</label>
            <select name="Categoria" class="form-select" required>
                <option value="">Seleccione la categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('Categoria', $producto->categoria_id) == $categoria->id ? 'selected' : ''}}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $producto->descripccion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="valor_unitario" class="form-label">Valor Unitario</label>
            <input type="number" name="valor_unitario" class="form-control" step="0.01" value="{{ old('valor_unitario', $producto->precio_unitario) }}" required>
        </div>

        <div class="mb-3">
            <label for="Impuesto" class="form-label">Impuesto</label>
            <select name="Impuesto" class="form-select" required>
                <option value="">Seleccione el impuesto</option>
                @foreach ($impuestos as $impuesto)
                    <option value="{{ $impuesto->id }}" {{ old('Impuesto', $producto->impuesto_id) == $impuesto->id ? 'selected' : '' }}>
                        {{ $impuesto->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="Promocion" class="form-label">Promoción</label>
            <select name="Promocion" class="form-select">
                <option value="">Seleccione una promoción</option>
                @foreach ($promociones as $promocion)
                    <option value="{{ $promocion->id }}" {{ old('Promocion', $producto->descuento_id) == $promocion->id ? 'selected' : '' }}>
                        {{ $promocion->descuento }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Actualizar Producto</button>
        <a href="{{ route('producto.index') }}" class="btn btn-secondary ms-2">Volver</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
