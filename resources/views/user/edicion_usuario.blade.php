@extends('layouts.users.edicion_usuario_Layout')

@section('title', 'Edición de Usuario')

@section('content')
<div class="form-container">
    <div class="form-header">
        <h1>🥬 Finca Al Día</h1>
        <p>Únete a nuestra comunidad de productos frescos y naturales</p>
    </div>

    <div class="form-content">
        <form action="{{ route('user.update', $usuario->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-section">
                    <h3 class="section-title">👤 Información Personal</h3>

                    <div class="form-group">
                        <label for="nom" class="form-label">Nombres *</label>
                        <input type="text" name="nom" id="nom" class="form-input" value="{{ $usuario->nombre }}" required>
                    </div>

                    <div class="form-group">
                        <label for="ape" class="form-label">Apellidos *</label>
                        <input type="text" name="ape" id="ape" class="form-input" value="{{ $usuario->apellidos }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tip_doc" class="form-label">Tipo de documento *</label>
                        <select name="tipodocu" id="tip_doc" class="form-input form-select" required>
                            <option value="">Selecciona un tipo de documento</option>
                            @foreach ($tipoDocumento as $t)
                            <option value="{{ $t->id }}" {{ $t->id == $usuario->tipo_docu ? 'selected' : '' }}>{{ $t->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="num_doc" class="form-label">Número del documento *</label>
                        <input type="number" name="num_doc" id="num_doc" class="form-input" value="{{ $usuario->documento }}" required>
                    </div>

                    <div class="form-group">
                        <label for="sexo" class="form-label">Orientación sexual *</label>
                        <select name="sexo" id="sexo" class="form-input form-select">
                            <option value="">Selecciona una opción</option>
                            @foreach ($genero as $orientacion)
                            <option value="{{ $orientacion->id }}" {{ $orientacion->id == $usuario->tipo_de_genero ? 'selected' : '' }}>{{ $orientacion->descripcion_gen }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="correo" class="form-label">Correo electrónico *</label>
                        <input type="email" name="correo" id="correo" class="form-input" value="{{ $usuario->email }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="form-label">Número telefónico *</label>
                        <input type="number" name="telefono" id="telefono" class="form-input" value="{{ $usuario->telefono }}" required>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">📍 Información Necesaria</h3>

                    <div class="form-group">
                        <label for="locadidad" class="form-label">Localidad *</label>
                        <select name="Localidad" id="Localidad" class="form-input form-select" required>
                            <option value="">Selecciona una localidad</option>
                            @foreach ($localidad as $lcd)
                            <option value="{{ $lcd->id }}" {{ $lcd->id == $usuario->localidad ? 'selected' : '' }}>{{ $lcd->descripcion }}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="direccion" class="form-label">Dirección *</label>
                        <input type="text" name="Direccion" id="direccion" class="form-input" value="{{ $usuario->direccion }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_nac" class="form-label">Fecha de nacimiento *</label>
                        <input type="date" name="fecha_nac" id="fecha_nac" class="form-input" value="{{ $usuario->edad }}" required>
                    </div>

                    <div class="form-group">
                        <label for="img_user" class="form-label">Imagen de usuario</label>
                        <div class="file-upload">
                            <input type="file" name="img_user" id="img_user" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="img_user" class="file-upload-label">📄 Seleccionar archivo</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="doc" class="form-label">Cargue su documento de identidad</label>
                        <div class="file-upload">
                            <input type="file" name="doc" id="doc" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="doc" class="file-upload-label">📄 Seleccionar archivo</label>
                        </div>
                        <div class="info-box">
                            💡 <strong>Importante:</strong> Sube una copia clara de tu documento de identidad para verificar tu cuenta y garantizar la seguridad de tus compras.
                        </div>
                    </div>
                </div>
            </div>

            <div class="submit-container">
                <button type="submit" class="submit-btn">🌱 Actualizar Información</button>
            </div>
        </form>
    </div>
</div>
@endsection