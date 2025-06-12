<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - Administrador</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/ADMINISTRADOR.CSS">
    <link rel="shortcut icon" href="../img/logo/icon.png" type="image/x-icon">
</head>
<img src="../img/logo/icon.png" alt="Icono" class="imagen-grande">
<body>
    <div class="login-container">                                                             
        <h2>Inicio de Sesión Administrador</h2>
        <form action="../INDEX_ADMI.html" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" placeholder="Ingrese su usuario" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" placeholder="Ingrese su contraseña" required>
            
            <button type="submit" class="login-btn">Iniciar Sesión</button>
        </form>
        <p>¿No tienes acceso?<a href="../pages/AYUDA_CLIENTE.html"> Contacta al soporte.</a></p>
    </div>

    <img src="../img/logo/icon.png" alt="Icono" class="imagen-grande">
</body>
</html>
