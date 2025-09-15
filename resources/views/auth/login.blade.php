@extends('layouts.auth.login_Layout')

@section('title', 'Iniciar Sesión')

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6 fade-in-1">

                <marquee style="max-width: 100%; font-family:Georgia, 'Times New Roman', Times, serif;" behavior="scroll" direction="left" scrollamount="14">
                    <strong>Si te registras puedes comprar más de lo que esperas ;) </strong>
                    <img style="width: 40px;  height: auto; border-radius: 50%;" src="{{asset('img/es_de_frutas_y_verduras_1.webp')}}" alt="imagen_prueba">
                    <strong>Sabias que las compras online son inseguras, por eso nos preocupamos por tu seguridad</strong> <i class="fas fa-lock me-2"></i>
                    Asegurate de tener una buena contraseña :)
                    <img style="width: 40px;  height: auto; border-radius: 30%;" src="{{asset('img/es_de_frutas_y_verduras_3.png')}}" alt="imagen_prueba">
                </marquee>

                <img style="margin-top:15%;" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <div class="login-card p-4">

                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                            <form action="{{ route('iniciarSesion') }}" method="POST">
                                @csrf

                                <div class="d-flex align-items-center mb-4 pb-1 fade-in-2">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ asset('img/logo/icon.png') }}" alt="Logo" class="logo-img me-3" style="width: 50px; height: 50px;">
                                    </a>
                                    <span class="h1 fw-bold mb-0 brand-title">Finca Al Día</span>
                                </div>

                                <h5 class="fw-normal mb-4 pb-3 fade-in-2" style="letter-spacing: 1px; color: #495057;">Inicia sesión en tu cuenta</h5>
                                <div class="form-floating mb-4 fade-in-3">
                                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="loginEmail" name="email" placeholder="correo@ejemplo.com" value="{{ old('email') }}" required>
                                    <label for="loginEmail"><i class="fas fa-envelope me-2"></i>Correo electrónico</label>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-4 fade-in-3">
                                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="loginPassword" name="password" placeholder="Contraseña" required>
                                    <label for="loginPassword"><i class="fas fa-lock me-2"></i>Contraseña</label>
                                </div>
                                <div class="pt-1 mb-4 fade-in-4">
                                    <button class="btn btn-primary-custom w-100" type="submit">
                                        <span class="btn-text"><i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión</span>
                                        <span class="btn-spinner d-none"><i class="fas fa-spinner fa-spin me-2"></i>Iniciando sesión...</span>
                                    </button>
                                </div>
                                <div class="text-center mb-4 fade-in-4">
                                    <a class="small text-muted text-decoration-none" href="{{ route('password.request') }}"><i class="fas fa-key me-1"></i>¿Olvidaste tu contraseña?</a>
                                </div>
                                <p class="mb-4 pb-lg-2 text-center fade-in-4" style="color: #393f81;">
                                    ¿No tienes una cuenta?
                                    <a href="#!" class="text-decoration-none" style="color: #393f81;" id="showRegisterTab"><strong>Regístrate aquí</strong></a>
                                </p>
                            </form>
                        </div>
                        <!-- Registro de usuario -->
                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                            <form method="POST" action="{{ route('register.user') }}" id="registerForm">
                                @csrf
                                <div class="d-flex align-items-center mb-4 pb-1 fade-in-2">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ asset('img/logo/icon.png') }}" alt="Logo" class="logo-img me-3" style="width: 50px; height: 50px;">
                                    </a>
                                    <span class="h1 fw-bold mb-0 brand-title">Finca Al Día</span>
                                </div>

                                <h5 class="fw-normal mb-4 pb-3 fade-in-2" style="letter-spacing: 1px; color: #495057;">Crea una cuenta nueva</h5>

                                <div class="row mb-4 fade-in-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="hidden" name="tipo_usuario" value="1">
                                            <input type="text" class="form-control form-control-lg @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido') }}" required>
                                            <label for="apellido"><i class="fas fa-user me-2"></i>Apellido</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control form-control-lg @error('nombre') is-invalid @enderror" id="registerNombre" name="nombre" value="{{ old('nombre') }}" required>
                                            <label for="registerNombre"><i class="fas fa-user me-2"></i>Nombre</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating mb-4 fade-in-4">
                                    <input type="text" class="form-control form-control-lg @error('direccion') is-invalid @enderror" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                                    <label for="direccion"><i class="fas fa-location-dot me-2"></i>Dirección</label>
                                </div>

                                <div class="row mb-4 fade-in-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="registerEmail" name="email" placeholder="correo@ejemplo.com" value="{{ old('email') }}" required>
                                            <label for="registerEmail"><i class="fas fa-envelope me-2"></i>Correo electrónico</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control form-control @error('fecha_nac') is-invalid @enderror" id="fecha_nac" name="fecha_nac" value="{{ old('fecha_nac') }}" required>
                                            <label for="fecha_nac"><i class="fas fa-calendar-alt me-2"></i>Fecha de Nacimiento</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4 fade-in-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="registerPassword" name="password" placeholder="Contraseña" required>
                                            <label for="registerPassword"><i class="fas fa-lock me-2"></i>Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" class="form-control form-control @error('password_confirmation') is-invalid @enderror" id="confirmRegisterPassword" name="password_confirmation" required>
                                            <label for="confirmRegisterPassword"><i class="fas fa-lock me-2"></i>Confirmar Contraseña</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-1 mb-4 fade-in-4">
                                    <button class="btn btn-primary-custom btn-lg btn-block w-100" type="submit">
                                        <span class="btn-text"><i class="fas fa-user-plus me-2"></i>Registrar</span> <span class="btn-spinner d-none"><i class="fas fa-spinner fa-spin me-2"></i>Registrando...</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection