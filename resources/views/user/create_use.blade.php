@extends ('layouts.users.crear_usuario')

@section('title', 'Crear de usuarios')

@section('content')
    <div class="form-container">
        <div class="form-header">
            <h1>🥬 Finca Al Día</h1>
            <p>Crea un usuario con nuestra página</p>
        </div>
    
    <div class="form-content">
        <form action="{{ route('storeUsuario') }}" method="post">
            @csrf
            <input type="hidden" name="cliente_id" value="{{ $cliente_id }}">
            <div class="form-grid">
                <div class="form-section">
                    <h3 class="section-title">👤 Información de Usuario</h3>

                    <div class="form-group">
                        <label for="nom_usuario" class="form-label">Nombre de usuario *</label>
                        <input type="text" name="nom_usuario" id="nom_usuario" class="form-input" placeholder="Escribe un usuario que recuerdes ;)" required>
                    </div>

                    <div class="form-group">
                        <label for="contra" class="form-label">Contraseña *</label>
                        <input type="password" name="contra" id="contra" class="form-input" placeholder="Tu contraseña debe de ser única :)" required>
                    </div>

                    <div class="form-group">
                        <label for="confi_contra" class="form-label">Confirmar contraseña *</label>
                        <input type="password" name="confi_contra" id="confi_contra" class="form-input" placeholder="Confirma tu contraseña" required>
                    </div>
                </div>
            </div>
            
            <div class="submit-container">
                <button type="submit" class="submit-btn">🌱 Crear usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection