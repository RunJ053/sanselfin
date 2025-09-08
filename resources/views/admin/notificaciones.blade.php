@extends('layouts.index_admin')

@section('title', 'Notificaciones')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">📢 Centro de Notificaciones</h2>

    {{-- Tarjeta: Nuevos usuarios --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-users"></i> Nuevos Usuarios Registrados
        </div>
        <div class="card-body">
            @if($nuevosUsuarios->isEmpty())
                <p class="text-muted">No hay usuarios recientes.</p>
            @else
                <div class="row">
                    @foreach($nuevosUsuarios as $usuario)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100 border-primary">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $usuario->nombre ?? 'Sin nombre' }}</h5>
                                    <p class="card-text">
                                        <strong>Email:</strong> {{ $usuario->email ?? 'N/A' }}<br>
                                        <strong>Teléfono:</strong> {{ $usuario->telefono ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="card-footer small text-muted">
                                    Registrado: {{ $usuario->created_at }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Tarjeta: Pedidos recientes --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <i class="fas fa-shopping-cart"></i> Pedidos Recientes
        </div>
        <div class="card-body">
            @if($pedidosRecientes->isEmpty())
                <p class="text-muted">No hay pedidos recientes.</p>
            @else
                <ul class="list-group">
                    @foreach($pedidosRecientes as $pedido)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>#{{ $pedido->id }}</strong> - {{ $pedido->direccion_envio }}
                            </span>
                            <span class="badge bg-success rounded-pill">
                                ${{ number_format($pedido->total, 2) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Tarjeta: Productos con stock bajo --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-danger text-white">
            <i class="fas fa-exclamation-triangle"></i> Productos con Stock Bajo
        </div>
        <div class="card-body">
            @if($productosStockBajo->isEmpty())
                <p class="text-muted">No hay productos con stock bajo.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-danger">
                        <tr>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productosStockBajo as $producto)
                            <tr>
                                <td>{{ $producto->nombre_producto }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ $producto->stock }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
