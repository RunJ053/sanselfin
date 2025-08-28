<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/nuevo_producto.css') }}">
    <link rel="shortcut icon" href="{{asset('img/logo/icon.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form-container">
        <div class="form-header">
            <h1>👤 Finca Al Día</h1>
            <p>Actualiza la información de tus usuarios fácilmente</p>
        </div>

        <div class="form-content">
            <h2>Editar Usuario</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" name="nombre" class="form-input"
                           value="{{ old('nombre', $usuario->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="apellidos" class="form-label">Apellidos *</label>
                    <input type="text" name="apellidos" class="form-input"
                           value="{{ old('apellidos', $usuario->apellidos) }}" required>
                </div>

                <div class="form-group">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-input"
                           value="{{ old('direccion', $usuario->direccion) }}">
                </div>

                <div class="form-group">
                    <label for="tipo_docu" class="form-label">Tipo de Documento</label>
                    <select name="tipo_docu" class="form-input form-select">
                        @foreach ($tiposDocumentos as $doc)
                            <option value="{{ $doc->id }}"
                                {{ $usuario->tipo_docu == $doc->id ? 'selected' : '' }}>
                                {{ $doc->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="documento" class="form-label">Número de Documento *</label>
                    <input type="number" name="documento" class="form-input"
                           value="{{ old('documento', $usuario->documento) }}" required>
                </div>

                <div class="form-group">
                    <label for="tipo_de_genero" class="form-label">Género</label>
                    <select name="tipo_de_genero" class="form-input form-select">
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}"
                                {{ $usuario->tipo_de_genero == $genero->id ? 'selected' : '' }}>
                                {{ $genero->descripcion_gen }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="edad" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="edad" class="form-input"
                           value="{{ old('edad', $usuario->edad) }}">
                </div>

                <div class="form-group">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="number" name="telefono" class="form-input"
                           value="{{ old('telefono', $usuario->telefono) }}">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico *</label>
                    <input type="email" name="email" class="form-input"
                           value="{{ old('email', $usuario->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="localidad" class="form-label">Localidad</label>
                    <select name="localidad" class="form-input form-select">
                        <option value="">Seleccione la localidad</option>
                        @foreach ($localidades as $localidad)
                            <option value="{{ $localidad->id }}"
                                {{ old('localidad', $usuario->localidad) == $localidad->id ? 'selected' : '' }}>
                                {{ $localidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="pass_us" class="form-label">Contraseña (opcional)</label>
                    <input type="password" name="pass_us" class="form-input" placeholder="Ingrese nueva contraseña">
                </div>

                <div class="submit-container">
                    <button type="submit" class="submit-btn">Actualizar Usuario</button>
                </div>

                <div class="submit-container">
                    <button class="submit-btnn">
                        <a href="{{ route('usuario.index') }}">Regresar</a>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
