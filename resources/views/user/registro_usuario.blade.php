<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/REGISTRO_USUARIO.CSS')}}">
</head>
<body>
    
    <div class="contenedor_registro">
        
        <form action="" method="post">
            <div id="firs_part">
                <h3>Información personal</h3>

                <label for="nom">Nombre</label> <br>
                <input type="text" name="nom" required> <br><br>

                <label for="senom">Segundo nombre</label><br>
                <input type="text" name="senom"><br><br>

                <label for="ape">Apellidos</label><br>
                <input type="text" name="ape" required><br><br>

                <label for="tip_doc">Tipo de documento</label><br>
                <select name="Id_Documento" required>
                </select><br><br>

                <label for="num_doc">Número del documento</label><br>
                <input type="text" id="num_doc" name="num_doc" required><br><br>

                <label for="sexo">Orientación sexual</label><br>
                <select name="sexo" id="sexo" required>
                    <option value="">Selecciona una opción</option>
                    @foreach ($generos as $orientacion)
                        <option value="{{ $orientacion->id }}">{{ $orientacion->descripcion_gen }}</option>
                    @endforeach
                </select><br><br>

                <label for="correo">Correo electrónico</label><br>
                <input type="email" id="correo" name="correo" required><br><br>
            </div>

            <div id="second_part">
                <h3>Información necesaria</h3>
                <label for="preg_seg">Pregunta de seguridad</label><br>
                <select name="Pregunta_seguridad" id="preg_seg" required>

                </select><br><br>

                <label for="respuesta">Respuesta a la pregunta</label><br>
                <input type="text" id="respuesta" name="Respuesta_pregunta" required><br><br>

                <label for="direccion">Dirección</label><br>
                <input type="text" id="direccion" name="Direccion" required><br><br>

                <label for="localidad">Localidad</label><br>
                <input type="text" id="localidad" name="Localidad" required><br><br>

                <label for="fecha_nac">Fecha de nacimiento</label><br>
                <input type="date" id="fecha_nac" name="fecha_nac" required><br><br>

                <label for="doc">Cargue su documento de identidad</label><br>
                <p>El documento de identidad es fundamental para verificar tu identidad de manera oficial y garantizar la seguridad en los trámites. Cargarlo correctamente nos permite procesar tu solicitud de forma eficiente y sin demoras, asegurando la autenticidad de los datos proporcionados.</p><br>
                <input type="file" name="doc" id="doc" required><br><br><br>
            </div>

            <div class="button-container">
                <button type="submit"></button>
            </div>
        </form>
    </div>
</body>
</html>