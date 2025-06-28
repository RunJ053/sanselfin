@extends('layouts.auth.forgot_password_Layout')

@section('tittle', 'Restablecer Contraseña')

@section('content')
<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container py-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-7 col-lg-5 col-xl-5">
                <div class="login-card p-4">
                    <div class="d-flex align-items-center mb-4 pb-1">
                        <img src="{{ asset('img/logo/icon.png') }}" alt="Logo" class="logo-img me-3" style="width: 50px; height: 50px;">
                        <span class="h1 fw-bold mb-0 brand-title">Finca Al Día</span>
                    </div>

                    <h5 class="fw-normal mb-4 pb-3" style="letter-spacing: 1px; color: #495057;">
                        Restablecer Contraseña
                    </h5>

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <p class="text-muted mb-4">Ingresa tu dirección de correo electrónico para recibir un código de verificación y restablecer tu contraseña.</p>

                        <div class="form-floating mb-4">
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="correo@ejemplo.com" value="{{ old('email') }}" required autofocus>
                            <label for="email"><i class="fas fa-envelope me-2"></i>Correo electrónico</label>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary-custom w-100" type="submit">
                            <span class="btn-text"><i class="fas fa-paper-plane me-2"></i>Enviar Código de Restablecimiento</span>
                            <span class="btn-spinner d-none"><i class="fas fa-spinner fa-spin me-2"></i>Enviando...</span>
                        </button>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="small text-muted text-decoration-none"><i class="fas fa-arrow-left me-1"></i>Volver al inicio de sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection