<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>

<style>
    /* HEADER estilo similar a la primera imagen */
    .header-bar {
      position: fixed;
      top: 10px;
      left: 10px;
      right: 10px;
      z-index: 1030;
      border-radius: 18px;
      padding: 8px 20px;
      display: flex;
      align-items: center;
      box-shadow: 0 6px 18px rgba(0,0,0,0.12);
      background: linear-gradient(90deg, #5cc05f 0%, #3a9b3a 100%);
    }
    .header-brand img { height: 44px; width: auto; }
    .header-brand .brand-text { font-weight: 700; color: #fff; margin-left: 10px; letter-spacing: 0.2px; }

    .nav-links .nav-link {
      color: rgba(255,255,255,0.95);
      font-weight: 600;
      text-decoration: none;
    }

    .nav-links .nav-link:hover {
      color: #f8f9fa;
      text-decoration: none;
    }

    .user-area { display:flex; align-items:center; gap:12px; }
    .user-welcome { color: #fff; font-weight:600; margin-right:6px; }
    .logout-btn { background: #ffda3a; color: #1a1a1a; border-radius:22px; padding:6px 11px; font-weight:600; box-shadow: 0 2px 6px rgba(0,0,0,0.12); border: none; }
</style>
<x-admin.nav-bar :notificaciones="$notificaciones ?? []" />

<!-- Contenido -->
<div class="flex-grow-1 p-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
