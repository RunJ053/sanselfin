@extends('layouts.noti_admin')

@section('title', 'Notificaciones')

@section('content')
<br><br>
<div class="container py-4">
    <h2 class="mb-4 text-center">📢 Centro de Notificaciones</h2>


    {{-- Tarjeta: Pedidos recientes --}}
<<<<<<< HEAD
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-shopping-cart"></i> Pedidos Recientes
                </span>

                {{-- Flecha solo si hay pedidos --}}
                @if(!$pedidosRecientes->isEmpty())
                    <a href="{{ route('pedidos.index') }}" class="text-white" title="Ver todos los pedidos">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                @endif
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

=======
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
>>>>>>> f8f6434529de20a93f73e2362feb619e84477b25

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
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> f8f6434529de20a93f73e2362feb619e84477b25
