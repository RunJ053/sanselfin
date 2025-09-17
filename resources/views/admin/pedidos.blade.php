@extends('layouts.noti_admin')

@section('content')
<br><br><br>
<x-admin.nav-bar :notificaciones="$notificaciones ?? []" />

<div class="container mt-4">
    <h2 class="mb-4 text-center">Gestión de Pedidos</h2>

    <div class="row">
        <!-- Columna Pendientes -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-danger text-white text-center fw-bold">
                    Pendientes
                </div>
                <div class="card-body" style="min-height: 300px;">
                    @forelse($pedidos->where('estado_id', 3) as $pedido)
                    <div class="card mb-3 border-start border-danger">
                        <div class="card-body p-2">
                            <strong>Pedido #{{ $pedido->id }}</strong><br>
                            <strong>Cliente:</strong> {{ $pedido->usuarios->nombre ?? 'N/A' }}<br>
                            @if ($pedido->envios === 3)
                            <strong>Lugar de entrega:</strong> {{ $pedido->envio->nombre_opcion ?? 'N/A' }}<br>
                            @else
                            <strong>Lugar de entrega:</strong> {{ $pedido->direccion_envio ?? 'N/A' }}<br>
                            @endif
                            <strong>Total:</strong> ${{ number_format($pedido->total, 2) }}<br>
                            <small>
                                <strong>Productos:</strong>
                                @foreach($pedido->detalles as $detalle)
                                {{ $detalle->producto->nombre_producto }} (x{{ $detalle->cantidad }}),
                                @endforeach
                            </small>
                            <form action="{{ route('admin.pedidos.cambiarEstado', $pedido->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="estado_id" value="4"> <!-- En Proceso -->
                                <button type="submit" class="btn btn-warning btn-sm">Mover a En Proceso</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center">No hay pedidos pendientes.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Columna En Proceso -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-white text-center fw-bold">
                    En Proceso
                </div>
                <div class="card-body" style="min-height: 300px;">
                    @forelse($pedidos->where('estado_id', 4) as $pedido)
                    <div class="card mb-3 border-start border-warning">
                        <div class="card-body p-2">
                            <strong>Pedido #{{ $pedido->id }}</strong><br>
                            <strong>Cliente:</strong> {{ $pedido->usuarios->nombre ?? 'N/A' }}<br>
                            @if ($pedido->envios === 3)
                            <strong>Lugar de entrega:</strong> {{ $pedido->envio->nombre_opcion ?? 'N/A' }}<br>
                            @else
                            <strong>Lugar de entrega:</strong> {{ $pedido->direccion_envio ?? 'N/A' }}<br>
                            @endif
                            <strong>Total:</strong> ${{ number_format($pedido->total, 2) }}<br>
                            <small>
                                <strong>Productos:</strong>
                                @foreach($pedido->detalles as $detalle)
                                {{ $detalle->producto->nombre_producto }} (x{{ $detalle->cantidad }}),
                                @endforeach
                            </small>
                            <form action="{{ route('admin.pedidos.cambiarEstado', $pedido->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="estado_id" value="6"> <!-- Enviado -->
                                <button type="submit" class="btn btn-primary btn-sm">Mover a Enviado</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center">No hay pedidos en proceso.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Columna Enviados -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    Enviados
                </div>
                <div class="card-body" style="min-height: 300px;">
                    @forelse($pedidos->where('estado_id', 6) as $pedido)
                    <div class="card mb-3 border-start border-primary">
                        <div class="card-body p-2">
                            <strong>Pedido #{{ $pedido->id }}</strong><br>
                            <strong>Cliente:</strong> {{ $pedido->usuarios->nombre ?? 'N/A' }}<br>
                            @if ($pedido->envios === 3)
                            <strong>Lugar de entrega:</strong> {{ $pedido->envio->nombre_opcion ?? 'N/A' }}<br>
                            @else
                            <strong>Lugar de entrega:</strong> {{ $pedido->direccion_envio ?? 'N/A' }}<br>
                            @endif
                            <strong>Total:</strong> ${{ number_format($pedido->total, 2) }}<br>
                            <small>
                                <strong>Productos:</strong>
                                @foreach($pedido->detalles as $detalle)
                                {{ $detalle->producto->nombre_producto }} (x{{ $detalle->cantidad }}),
                                @endforeach
                            </small>
                            <form action="{{ route('admin.pedidos.cambiarEstado', $pedido->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="estado_id" value="7"> <!-- Entregado -->
                                <button type="submit" class="btn btn-success btn-sm">Marcar como Entregado</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center">No hay pedidos enviados.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection