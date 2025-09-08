<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tittle','Mi Perfil')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" href="{{ asset('img/logo/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/PERFIL.CSS') }}">
    <link rel="stylesheet" href="{{ asset('css/NAV.css') }}">
</head>

<body>
    @yield('content')

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Actualización Exitosa! 🎉',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @endif

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/myprofile.js') }}"></script>
    <script src="{{ asset('js/hamburguesa.js') }}"></script>
    <!-- Footer -->

</body>

</html>