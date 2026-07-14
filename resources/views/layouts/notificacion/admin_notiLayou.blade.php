div class="dropdown">

    <!-- Botón de la campana -->
    <button
        class="btn btn-link text-white position-relative border-0 p-0"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false">

        <i class="fas fa-bell fa-lg"></i>

        @if($notificaciones->count() > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $notificaciones->count() }}
            </span>
        @endif

    </button>

    <!-- Panel de notificaciones -->
    <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0 mt-3"
        style="
            width:380px;
            max-height:500px;
            overflow-y:auto;
            border-radius:15px;
        ">

        <!-- Encabezado -->
        <div class="bg-success text-white p-3">
            <h6 class="mb-0">
                <i class="fas fa-bell me-2"></i>
                Notificaciones
            </h6>
        </div>

        @forelse($notificaciones as $notificacion)

            <div class="border-bottom p-3">

                <div class="d-flex">

                    <div class="me-3">

                        <i class="fas {{ $notificacion->icono }} fa-lg text-{{ $notificacion->color }}"></i>

                    </div>

                    <div class="flex-grow-1">

                        <strong>
                            {{ $notificacion->titulo }}
                        </strong>

                        <br>

                        <span class="text-muted">
                            {{ $notificacion->mensaje }}
                        </span>

                        <br>

                        <small class="text-secondary">
                            @if($notificacion->fecha)
                                {{ \Carbon\Carbon::parse($notificacion->fecha)->diffForHumans() }}
                            @endif
                        </small>

                    </div>

                </div>

            </div>

        @empty

            <div class="text-center p-5">

                <i class="fas fa-bell-slash fa-3x text-secondary mb-3"></i>

                <h6>No hay notificaciones</h6>

                <small class="text-muted">
                    Todo está al día.
                </small>

            </div>

        @endforelse

    </div>

</div>