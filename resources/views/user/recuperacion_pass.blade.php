<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/RECUPERACION_PASS.css">
    <title>Recuperacion contraseña</title>
</head>
<body>
    <div class="Recuperacion_contraseña">

        <form action="NUEVA_CONTRASEÑA.html" method="post">
            <h1>Recuperacion de contraseña</h1> 
    
            <label>Correo Electronico</label><br>
            <input type="text" placeholder="Digite su correo"><br><br>
    
            <label for="num_tele">Numero telefonico</label><br>
            <input type="text" id="num_tele"placeholder="Digite su numero" required><br><br>

            
            <h2>Pregunta de seguridad</h2>
            <label for="Pregunta de seguridad"></label>
            <select name="preg_seg" id="pregunta">
                <option value="1">¿Tienen mascotas?</option>
                <option value="2">¿Su color favorito es:?</option>
                <option value="3">¿cual es tu comida favorita?</option>
            </select>
            <br>
            <p>Respuesta de pregunta de seguridad</p>
            <label for="Respuesta de seguridad"></label>
            <input type="text" id="resp_seg" placeholder="Digite su respuesta" required><br>
    
            <button>Continuar</button> 
            
            
        </form>
    </div>

    
</body>

</html>