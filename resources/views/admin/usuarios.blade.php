@extends('layouts.usuarios')

@section('title', 'Listado de Usuarios')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        <i class="fas fa-users"></i> Gestión de Usuarios
    </h2>

    @if($usuarios->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No hay usuarios registrados aún.
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Tipo de documento</th>
                        <th>Genero</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td><strong>{{ $user->id }}</strong></td>
                            <td>{{ $user->nomb_usu }} {{ $user->ape_usu }}</td>
                            <td>{{ $user->correo_us }}</td>
                            <td>{{ $user->telf_usu }}</td>
                            <td>{{ $user->rol ?? 'Sin rol' }}</td>
                            <td>
                                <!-- Botón Editar -->
                                <a href="{{ route('usuario.edit', $user->id) }}" 
                                   class="btn btn-sm btn-primary mb-1">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón Eliminar -->
                                <form action="{{ route('usuario.destroy', $user->id) }}" 
                                      method="POST" 
                                      class="form-eliminar d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger btn-eliminar mb-1">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-3">
                {{ $usuarios->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.form-eliminar');

    forms.forEach(form => {
        const btn = form.querySelector('.btn-eliminar');
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Este usuario será eliminado permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
    