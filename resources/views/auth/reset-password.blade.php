@extends('layouts.auth.reset-password_Layout')

@section('title', 'Restablecer Contraseña')

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
                        Establece tu Nueva Contraseña
                    </h5>

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg @error('token') is-invalid @enderror" id="token" name="token" placeholder="Código de Verificación" value="{{ old('token') }}" required autofocus>
                            <label for="token"><i class="fas fa-hashtag me-2"></i>Código de Verificación</label>
                            @error('token')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Se ha eliminado el campo de 'Contraseña Anterior' --}}

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Nueva Contraseña" required>
                            <label for="password"><i class="fas fa-lock me-2"></i>Nueva Contraseña</label>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Nueva Contraseña" required>
                            <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirmar Nueva Contraseña</label>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary-custom w-100" type="submit">
                            <span class="btn-text"><i class="fas fa-sync-alt me-2"></i>Restablecer Contraseña</span>
                            <span class="btn-spinner d-none"><i class="fas fa-spinner fa-spin me-2"></i>Restableciendo...</span>
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