<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Monto</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movimientos as $mov)
        <tr>
            <td>{{ $mov->fecha }}</td>
            <td>{{ ucfirst($mov->tipo) }}</td>
            <td>{{ $mov->monto }}</td>
            <td>{{ $mov->descripcion }}</td>
        </tr>
        @endforeach
    </tbody>
</table>