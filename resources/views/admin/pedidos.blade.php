@extends('layouts.noti_admin')

@section('content')
<br><br><br>
<div class="container mt-4">
    <h2 class="mb-4 text-center">Pedidos Registrados</h2>

    <div class="row">
        <!-- Columna En Proceso -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-white text-center fw-bold">
                    En Proceso
                </div>
                <div class="card-body" style="min-height: 300px;">
                    @forelse($pedidos->where('estado', 'En Proceso') as $pedido)
                        <div class="card mb-3 border-start border-warning">
                            <div class="card-body p-2">
                                <strong>Pedido #{{ $pedido->id }}</strong><br>
                                Cliente: {{ $pedido->usuario->nombre ?? 'N/A' }}<br>
                                Total: ${{ number_format($pedido->total, 2) }}
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">No hay pedidos en proceso.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Columna En Entrega -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    En Entrega
                </div>
                <div class="card-body" style="min-height: 300px;">
                    @forelse($pedidos->where('estado', 'En Entrega') as $pedido)
                        <div class="card mb-3 border-start border-primary">
                            <div class="card-body p-2">
                                <strong>Pedido #{{ $pedido->id }}</strong><br>
                                Cliente: {{ $pedido->usuario->nombre ?? 'N/A' }}<br>
                                Total: ${{ number_format($pedido->total, 2) }}
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">No hay pedidos en entrega.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Columna Entregado -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white text-center fw-bold">
                    Entregado
                </div>
                <div class="card-body" style="min-height: 300px;">
                    @forelse($pedidos->where('estado', 'Entregado') as $pedido)
                        <div class="card mb-3 border-start border-success">
                            <div class="card-body p-2">
                                <strong>Pedido #{{ $pedido->id }}</strong><br>
                                Cliente: {{ $pedido->usuario->nombre ?? 'N/A' }}<br>
                                Total: ${{ number_format($pedido->total, 2) }}
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">No hay pedidos entregados.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
