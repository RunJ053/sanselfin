<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/CREAR_USUARIO.CSS">
</head>
<body>
    <div class="crear_user">
        <form action="" method="post">
            <h2>Crea un usuario con nuestra página</h2>
            <label>Nombre de usuario</label>
            <input type="text" name="nom_usuario" placeholder="Escribe un usuario que recuerdes ;)" required>
            <label>Contraseña</label>
            <input type="password" name="contra" placeholder="Tu contraseña debe de ser única :)" required>
            <label>Confirmar contraseña</label>
            <input type="password" name="confi_contra" placeholder="Confirma tu contraseña" required>
            <button type="submit" name="crear" id="crear">Crear usuario</button>
        </form>
    </div>
</body>
</html>