<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />

    <title>
        Paiement
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.2"></script>
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #f0f2f5;
        }

        .card-footer-btn {
            display: flex;
            align-items: center;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
        }

        .text-uppercase-bold-sm {
            text-transform: uppercase !important;
            font-weight: 500 !important;
            letter-spacing: 2px !important;
            font-size: 0.85rem !important;
        }

        .hover-lift-light {
            transition: box-shadow 0.25s ease, transform 0.25s ease,
                color 0.25s ease, background-color 0.15s ease-in;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .btn-group-lg>.btn,
        .btn-lg {
            padding: 0.8rem 1.85rem;
            font-size: 1.1rem;
            border-radius: 0.3rem;
        }

        .btn-dark {
            color: #fff;
            background-color: #1e2e50;
            border-color: #1e2e50;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(30, 46, 80, 0.09);
            border-radius: 0.25rem;
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .p-5 {
            padding: 3rem !important;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.5rem 1.5rem;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .table td,
        .table th {
            border-bottom: 0;
            border-top: 1px solid #edf2f9;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 1rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        .px-0 {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .table thead th,
        tbody td,
        tbody th {
            vertical-align: middle;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .icon-circle[class*="text-"] [fill]:not([fill="none"]),
        .icon-circle[class*="text-"] svg:not([fill="none"]),
        .svg-icon[class*="text-"] [fill]:not([fill="none"]),
        .svg-icon[class*="text-"] svg:not([fill="none"]) {
            fill: currentColor !important;
        }

        .svg-icon>svg {
            width: 1.45rem;
            height: 1.45rem;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo {
            margin-right: auto;
            /* Pousse le logo à gauche */
        }

        .title {
            margin: 0 auto;
            /* Centre le titre */
            text-align: center;
            /* Centrage du texte */
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <div class="container mt-6 mb-7">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-7">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-body p-5">
                        <div class="header">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="logo">
                            <h2 class="title">Minsihoue</h2>
                        </div>
                        <p class="fs-sm">
                            Facture d'achat du document {{ $document->titre }}
                            <strong>{{ $document->prix }} XOF</strong>
                        </p>
                        <div class="border-top border-gray-200 pt-4 mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted mb-2">Facture No.</div>
                                    <strong>00040</strong>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted mb-2">Date</div>
                                    <strong>29 juillet 2024</strong>
                                </div>
                            </div>
                        </div>
                        <div class="border-top border-gray-200 mt-4 py-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted mb-2">Client</div>
                                    <strong>{{ session('user')['name'] }}</strong>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <p class="fs-sm">
                                        @if (session('user')['grade'] == 'cpins')
                                            Conseillé pédagogique
                                        @elseif (session('user')['grade'] == 'directeur')
                                            Directeur
                                        @else
                                            Insituteur
                                        @endif
                                        <br />
                                        <a href="mailto:{{ session('user')['email'] }}" class="text-purple"><span
                                                class="__cf_email__"
                                                data-cfemail="413529242c243201242c20282d6f222e2c">{{ session('user')['email'] }}</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <table class="table border-bottom border-gray-200 mt-3">
                            <thead>
                                <tr>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">
                                        Description de la facture
                                    </th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">
                                        Prix
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-0">Prix du document</td>
                                    <td class="text-end px-0"> {{ number_format($document->prix, 0, '.', ' ') }}
                                        XOF</td>
                                </tr>
                                <tr>
                                    <td class="px-0">Frais de transaction</td>
                                    <td class="text-end px-0">
                                        {{ number_format($document->prix * 0.0183, 0, '.', ' ') }}
                                        XOF</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-5">
                            <div class="d-flex justify-content-end mt-3">
                                <h5 class="me-3">Total:</h5>
                                <h5 class="text-success">{{ number_format($document->prix * 1.0183, 0, '.', ' ') }} XOF
                                </h5>
                            </div>
                        </div>
                    </div>
                    <form id="paymentForm" action="{{ route('document.afterPaiement') }}" method="post">
                        @csrf
                        <input type="hidden" name="docId" value="{{ $document->id }}">
                        <button class="btn btn-primary" style="width: 100% ; background-color:teal" id="paid">
                            <span class="svg-icon text-white me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                    viewBox="0 0 512 512">
                                    <title>ionicons-v5-g</title>
                                    <path d="M336,208V113a80,80,0,0,0-160,0v95"
                                        style="fill: none; stroke: #000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 32px;">
                                    </path>
                                    <rect x="96" y="208" width="320" height="272" rx="48" ry="48"
                                        style="fill: none; stroke: #000; stroke-linecap: round; stroke-linejoin: round; stroke-width: 32px;">
                                    </rect>
                                </svg>
                            </span>
                            Payer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche la soumission par défaut du formulaire

            FedaPay.init('#paid', {
                public_key: "pk_sandbox_oDILAzktemGVvakIH5siOI5j",
                transaction: {
                    amount: {{ $document->prix }},
                    description: " Paiement de votre facture",
                },
            }).then(function() {
                // Soumet le formulaire après la réussite de FedaPay.init
                document.getElementById('paymentForm').submit();
            }).catch(function(error) {
                console.error('Erreur lors de l\'initialisation de FedaPay:', error);
            });
        });
    </script>
</body>

</html>
