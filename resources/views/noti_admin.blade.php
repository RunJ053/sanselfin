<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Panel de Administración')</title>

<link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body{padding-top:85px}
.header-bar{position:fixed;top:10px;left:10px;right:10px;z-index:1030;background:linear-gradient(90deg,#5cc05f,#3a9b3a);border-radius:18px;padding:10px 20px;display:flex;align-items:center;box-shadow:0 6px 18px rgba(0,0,0,.15)}
.brand-text{color:#fff;font-weight:700;margin-left:10px}
.nav-link{color:#fff!important;font-weight:600;text-decoration:none}
.nav-link:hover{color:#f8f9fa!important}
.user-area{display:flex;align-items:center;gap:15px}
.user-welcome{color:#fff;font-weight:600}
.logout-btn{background:#ffd43b;border:none;border-radius:25px;padding:7px 15px;font-weight:600}
.notificaciones-panel{width:380px;max-height:420px;overflow:auto;border:none;border-radius:15px}
.notificaciones-header{background:#3a9b3a;color:#fff;padding:15px;font-weight:bold}
.notificacion-item{padding:12px 15px;border-bottom:1px solid #eee}
.notificacion-item:hover{background:#f8f9fa}
</style>
</head>
<body>

<header class="header-bar">
<a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-decoration-none">
<img src="{{ asset('img/logo/icon.png') }}" width="42">
<span class="brand-text">Finca al Día</span>
</a>

<nav class="ms-4 me-auto">
<ul class="navbar-nav flex-row gap-3">
<li><a class="nav-link" href="{{ route('admin.dashboard') }}">Inicio</a></li>
<li><a class="nav-link" href="{{ route('producto.index') }}">Inventario</a></li>
<li><a class="nav-link" href="{{ route('dashboard.index') }}">Reportes</a></li>
<li><a class="nav-link" href="{{ route('usuario.index') }}">Usuarios</a></li>
</ul>
</nav>

<div class="user-area">

@auth

<span class="user-welcome">
<i class="fas fa-user-circle"></i>
{{ session('nombre_usuario') ?? Auth::user()->nombre ?? Auth::user()->nomb_usu ?? 'Administrador' }}
</span>

<div class="dropdown">

<button class="btn btn-link text-white position-relative p-0 border-0"
data-bs-toggle="dropdown">

<i class="fas fa-bell fa-lg"></i>

@if(isset($notificaciones) && count($notificaciones)>0)
<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
{{ count($notificaciones) }}
</span>
@endif

</button>

<div class="dropdown-menu dropdown-menu-end shadow notificaciones-panel">

<div class="notificaciones-header">
<i class="fas fa-bell"></i> Notificaciones
</div>

@forelse($notificaciones ?? [] as $notificacion)
<div class="notificacion-item">
<strong>{{ $notificacion->titulo ?? 'Notificación' }}</strong><br>
<span>{{ $notificacion->mensaje ?? '' }}</span><br>
<small class="text-muted">{{ $notificacion->created_at->diffForHumans() ?? '' }}</small>
</div>
@empty
<div class="p-4 text-center">
No hay notificaciones.
</div>
@endforelse

</div>
</div>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button class="logout-btn">
<i class="fas fa-sign-out-alt"></i> Salir
</button>
</form>

@endauth

@guest
<a href="{{ route('login') }}" class="logout-btn text-decoration-none">Login</a>
@endguest

</div>

</header>

<div class="container-fluid">
@yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
