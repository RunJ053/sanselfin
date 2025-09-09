<h2>Resultado del Pago</h2>
<p>Referencia: {{ request('referenceCode') }}</p>
<p>Total: {{ request('TX_VALUE') }}</p>
<p>Estado: {{ request('transactionState') }}</p>

@if(request('transactionState') == 4)
    <p style="color:green;">✅ Transacción aprobada</p>
@elseif(request('transactionState') == 6)
    <p style="color:red;">❌ Transacción rechazada</p>
@elseif(request('transactionState') == 7)
    <p style="color:orange;">⏳ Transacción pendiente</p>
@endif
