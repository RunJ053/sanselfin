<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/LOGIN.CSS') }}">
</head>
<body>
    <img src="{{ asset('img/logo/icon.png') }}" alt="Icono" class="imagen-grande">
    <div class="login">
        <form action="{{ route('iniciarSesion') }}" method="POST">
            @csrf
            <h2>Inicio de sesión</h2>
            
            <label>Usuario</label>
            <input type="text" name="nombre_usuario" placeholder="User">

            <label>Contraseña</label>
            <input type="password" name="password" placeholder="Password">

            <input class="button" type="submit" value="Inicio de sesión">
            <a href="{{ route('registro') }}">¡Registrate aquí!</a>
            <a href="">¿Eres Administrador? Ingresa aqui</a>
            <p>Registarse con:</p>
            <div class="social-icons">
                <a href="https://accounts.google.com/AccountChooser/signinchooser?service=mail&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&flowName=GlifWebSignIn&flowEntry=AccountChooser&ec=asw-gmail-globalnav-signin&ddm=1"><i class="fa-brands fa-google-plus-g"></i></a>
            </div>    
            <p>¿Has olvidado tu contraseña?<a href="RECUPERACION_PASS.html">  La he olvidado :(</a></p>
            <p>¿Necesitas ayuda?<a href="../pages/AYUDA_CLIENTE.html">  ¡Aquí te ayudamos!</a></p>
        </form> 
    </div>
    <img src="{{ asset('img/logo/icon.png') }}" alt="Icono" class="imagen-grande">       
</body>
</html>
