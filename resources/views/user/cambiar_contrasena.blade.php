@extends('layouts.users.edicion_usuario_Layout')

@section('title', 'Cambiar Contraseña')

@section('content')
    <div class="form-container">
        <div class="form-header">
            <h1>🔒 Cambiar Contraseña</h1>
        </div>
        
        <div class="form-content">
            <form action="{{ route('user.changePassword') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="current_password" class="form-label">Contraseña Actual *</label>
                    <input type="password" name="current_password" id="current_password" class="form-input" required>
                    @error('current_password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password" class="form-label">Nueva Contraseña *</label>
                    <input type="password" name="new_password" id="new_password" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña *</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-input" required>
                </div>

                <div class="submit-container">
                    <button type="submit" class="submit-btn">Actualizar Contraseña</button>
                </div>
            </form>
        </div>
    </div>
@endsection