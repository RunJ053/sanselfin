<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/NUEVA_CONTRASEÑA.CSS">
    <title>Nueva de contraseña</title>
</head>
<body>


   <div class="Nueva_contraseña">

    <form action="LOGIN.html" method="post">
        <h1>Restablecer de contraseña</h1> 

        <label>Nueva contraseña</label>
        <input type="text" placeholder="Digite contraseña"><br>
        <label>Confirmar contraseña</label>
        <input type="text" placeholder="Confirmar contraseña">
        <br>

        <h1>Informacion personal</h1>
        <p>Pregunta de seguridad</p>
        <label for="Pregunta de seguridad"></label>
        <select name="preg_seg" id="pregunta">
            <option value="1">¿Tienen mascotas?</option>
            <option value="2">¿Su color favorito es:?</option>
            <option value="3">¿cual es tu comida favorita</option>
        </select><br>
        <p>Respuesta de pregunta de seguridad</p>
        <label for="Respuesta de seguridad"></label>
        <input type="text" id="resp_seg" placeholder="Digite su Respuesta"><br>

        <button>Confirmar</button>
    </form>
   </div>
</body>
</html>