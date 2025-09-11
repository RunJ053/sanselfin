@extends('layouts.noti_admin')

@section('title', 'Listado de Pedidos')

@section('content')
<div class="container">
    <h2 class="mb-4">
        <i class="fas fa-shopping-cart text-success"></i> Listado de Pedidos
    </h2>

    @if($pedidos->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No hay pedidos registrados aún.
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-striped table-hover">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Dirección de Envío</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td><strong>#{{ $pedido->id }}</strong></td>
                            <td>{{ $pedido->cliente->nomb_usu ?? 'Cliente desconocido' }}</td>
                            <td>{{ $pedido->direccion_envio }}</td>
                            <td>${{ number_format($pedido->total, 2) }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('pedidos.show', $pedido->id) }}" 
                                   class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
