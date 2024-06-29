<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/fedapay@1.2.2/dist/index.min.js"></script>
    <title>Paiement</title>
</head>


<body>
    <form action="{{ route('document.afterPaiement') }}" method="POST" lass="card">
        @csrf
        <input type="hidden" name="docId" value="{{ $document->id }}">
        <script src="https://checkout.fedapay.com/js/checkout.js" data-public-key="pk_live_lVd5w9Ls7FnH7I5eAVKi76oz"
            data-button-text="Payer {{ $document->prix }} XOF" data-button-class="button-class"
            data-transaction-amount="{{ $document->prix }}"
            data-transaction-description="Paiement pour l'achat de votre document sur Minsihoue" data-currency-iso="XOF"
            data-widget-description="Minsihoue, la communauté des Enseignants du primaire"
            data-widget-user="styvoben24@gmail.com" data-widget-image="{{ asset('assets/images/logo.png') }}"
            data-widget-title="Minsihoue" data-customer-email="{{ session('user')['email'] }}"></script>
    </form>
</body>

</html>
