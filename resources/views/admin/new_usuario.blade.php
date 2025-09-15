<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/nuevo_producto.css') }}">
    <link rel="shortcut icon" href="{{asset('img/logo/icon.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
<div class="form-container">
    <div class="form-header">
        <h1>👤 Registro de Usuarios</h1>
        <p>Agrega un nuevo usuario al sistema</p>
    </div>

    <div class="form-content">
        <h2>Registrar Nuevo Usuario</h2>

        <form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre" class="form-label">Nombre *</label>
                <input type="text" name="nombre" id="nombre" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="apellidos" class="form-label">Apellidos *</label>
                <input type="text" name="apellidos" id="apellidos" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="direccion" class="form-label">Dirección *</label>
                <input type="text" name="direccion" id="direccion" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="tipo_docu" class="form-label">Tipo de Documento *</label>
                <select name="tipo_docu" id="tipo_docu" class="form-input form-select" required>
                    <option value="">Seleccione el tipo de documento</option>
                    @foreach ($tipos_doc as $doc)
                        <option value="{{ $doc->id }}">{{ $doc->descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="documento" class="form-label">Número de Documento *</label>
                <input type="text" name="documento" id="documento" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="tipo_de_genero" class="form-label">Género *</label>
                <select name="tipo_de_genero" id="tipo_de_genero" class="form-input form-select" required>
                    <option value="">Seleccione género</option>
                    @foreach ($generos as $genero)
                        <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="edad" class="form-label">Fecha de Nacimiento *</label>
                <input type="date" name="edad" id="edad" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-input">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Correo Electrónico *</label>
                <input type="email" name="email" id="email" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="localidad" class="form-label">Localidad *</label>
                <select name="localidad" id="localidad" class="form-input form-select" required>
                    <option value="">Seleccione localidad</option>
                    @foreach ($localidades as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Contraseña (opcional)</label>
                <input type="password" name="password" id="password" class="form-input">
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input">
            </div>

            <div class="form-group">
                <label for="user_img" class="form-label">Foto de Perfil</label>
                <div class="file-upload">
                    <input type="file" name="user_img" id="user_img" class="form-input" accept=".jpg,.jpeg,.png">
                    <label for="user_img" class="file-upload-label">📄 Seleccionar archivo</label>
                </div>
                <div class="info-box">
                    💡 <strong>Importante:</strong> Sube una imagen clara del usuario.
                </div>
            </div>

            <div class="submit-container">
                <button type="submit" class="submit-btn">Registrar Usuario</button>
            </div>

            <div class="submit-container">
                <button type="button" class="submit-btnn">
                    <a href="{{ route('usuario.index') }}">Regresar a ver usuarios</a>
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
