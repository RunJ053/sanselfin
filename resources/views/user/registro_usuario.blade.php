<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/REGISTRO_USUARIO.CSS')}}">
    <link rel="import" href="{{ asset("js/ppp.js") }}">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>🥬 Finca Al Día</h1>
            <p>Únete a nuestra comunidad de productos frescos y naturales</p>
        </div>
        
        <div class="form-content">
        
            <form action="{{ route('store') }}" method="post">
                @csrf
                <div class="form-grid">
                    <div class="form-section">
                        <h3 class="section-title">👤 Información Personal</h3>

                        <div class="form-group">
                            <label for="nom" class="form-label">Nombres *</label>
                            <input type="text" name="nom" id="nom" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="ape" class="form-label">Apellidos *</label>
                            <input type="text" name="ape" id="ape" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="tip_doc" class="form-label">Tipo de documento *</label>
                            <select name="tipodocu" id="tip_doc" class="form-input form-select" required>
                                <option value="">Selecciona un tipo de documento</option>
                                @foreach ($tipoDocumento as $t)
                                    <option value="{{ $t->id }}">{{ $t->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="num_doc" class="form-label">Número del documento *</label>
                            <input type="text" name="num_doc" id="num_doc" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="sexo" class="form-label">Orientación sexual *</label>
                            <select name="sexo" id="sexo" class="form-input form-select" required>
                                <option value="">Selecciona una opción</option>
                                @foreach ($genero as $orientacion)
                                    <option value="{{ $orientacion->id }}">{{ $orientacion->descripcion_gen }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="correo" class="form-label">Correo electrónico *</label>
                            <input type="email" name="correo" id="correo" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono" class="form-label">Número telefónico *</label>
                            <input type="text" name="telefono" id="telefono" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title">📍 Información Necesaria</h3>

                        <div class="form-group">
                            <label for="preg_seg" class="form-label">Pregunta de seguridad *</label>
                            <select name="Pregunta_seguridad" id="preg_seg" class="form-input form-select" required>
                                <option value="">Selecciona una pregunta de seguridad</option>
                                @foreach ($seguridad as $seg)
                                    <option value="{{ $seg->id }}">{{ $seg->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="respuesta" class="form-label">Respuesta a la pregunta *</label>
                            <input type="text" name="Respuesta_pregunta" id="respuesta" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="direccion" class="form-label">Dirección *</label>
                            <input type="text" name="Direccion" id="direccion" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="localidad" class="form-label">Localidad *</label>
                            <input type="text" name="Localidad" id="localidad" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_nac" class="form-label">Fecha de nacimiento *</label>
                            <input type="date" name="fecha_nac" id="fecha_nac" class="form-input" required>
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
                    <button type="submit" class="submit-btn">🌱 Crear mi cuenta</button>
                </div>
            </form>
        </div>
    </div>
    <script src="js/ppp.js"></script>
</body>
</html>