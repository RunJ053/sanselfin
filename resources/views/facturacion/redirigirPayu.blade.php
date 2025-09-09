<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Redirigiendo a PayU...</title>
</head>
<body onload="document.forms['payuForm'].submit();">
    <p>Redirigiendo a PayU, por favor espera...</p>

    <form name="payuForm" method="POST" action="{{ $url }}">
        <input name="merchantId" type="hidden" value="{{ $merchantId }}">
        <input name="accountId" type="hidden" value="{{ $accountId }}">
        <input name="description" type="hidden" value="Compra en mi tienda">
        <input name="referenceCode" type="hidden" value="{{ $referenceCode }}">
        <input name="amount" type="hidden" value="{{ $amount }}">
        <input name="currency" type="hidden" value="{{ $currency }}">
        <input name="signature" type="hidden" value="{{ $signature }}">
        <input name="test" type="hidden" value="1">
        <input name="responseUrl" type="hidden" value="{{ $responseUrl }}">
        <input name="confirmationUrl" type="hidden" value="{{ $confirmationUrl }}">
        <input name="buyerEmail" type="hidden" value="{{ Auth::user()->email }}">
    </form>
</body>
</html>