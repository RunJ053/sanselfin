<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Redirigiendo a PayU...</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body onload="document.forms['payuForm'].submit();">
    <div id="loading-overlay" class="fixed inset-0 flex items-center justify-center bg-white z-50">
        <div class="flex flex-col items-center">
            <!-- Spinner -->
            <svg class="animate-spin h-10 w-10 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <p class="mt-4 text-lg font-semibold text-gray-700">Redirigiendo a PayU, por favor espera...</p>
        </div>
    </div>

    <form name="payuForm" method="POST" action="{{ $url }}">
        <input name="extra1" type="hidden" value="{{ Auth::id() }}">
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