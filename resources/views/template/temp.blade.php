<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style_dash.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/alert.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    @include('template.menu')

    <div class="container">
        <div class="left-sidebar">
            <div class="sidebar-profile-box">
                <img src="{{ asset('assets/images/teal.jpg') }}" width="100%">
                <div class="sidebar-profile-info">
                    <a href="{{ route('profil.index', ['userId' => session('user')['id']]) }}">
                        <img src="{{ $avatar }}">
                        <h1>{{ session('user')['name'] }}</h1>
                    </a>
                    <h3>
                        @if (session('user')['grade'] == 'cpins')
                            Conseiller pédagogique
                        @elseif(session('user')['grade'] == 'instituteur')
                            Instituteur
                        @else
                            Directeur
                        @endif
                    </h3>

                    <ul>
                        <li>Posts publiés<span>24</span></li>
                        <li>Documents publiés <span>128</span></li>
                        <li>Nombre de téléchargements<span>108</span></li>
                    </ul>
                </div>
                <div class="sidebar-profile-link">
                    <a href="{{ route('profil.index', ['userId' => session('user')['id']]) }}"><img
                            src="{{ asset('assets/images/items.png') }}">Mes
                        publications</a>
                    {{-- <a href="#"><img src="{{ asset('assets/images/premium.png') }}">Versions premium</a> --}}
                </div>
            </div>

            {{-- <div class="sidebar-activity" id="sidebarActivity">
                <h3>RECENT</h3>
                <a href="#"><img src="{{ asset('assets/images/recent.png') }}">Data Analysis</a>
                <h3>GROUPS</h3>
                <a href="#"><img src="{{ asset('assets/images/group.png') }}">Data Analyst group</a>
                <h3>HASHTAG</h3>
                <a href="#"><img src="{{ asset('assets/images/hashtag.png') }}">dataanalyst</a>
                <div class="discover-more-link">
                    <a href="#">Découvrir plus</a>
                </div>
            </div>
            <p id="showMoreLink" onclick="toggleActivity()">Voir plus<b>+</b></p> --}}

        </div>
        <div class="main-content">
            @yield('main')
        </div>
        <div class="right-sidebar">
            <div class="sidebar-news ok">
                <h3>Formations à venir</h3>
            </div>
            @foreach ($formationsAvenir as $key => $formationAvenir)
                <div class="sidebar-news">
                    <a href="#">{{ $formationAvenir->titre }}</a><br>
                    <span>Début: {{ $formationAvenir->dateDebut }} &middot; 20 personnes intéressées</span>
                    <a href="#" class="read-more-link">Voir plus </a>
                </div>

                <div class="sidebar-ad">
                    <small>Formateur &middot; &middot; &middot;</small>
                    <p>{{ $formationAvenir->formateur }}</p>
                    <div>
                        <img src="{{ asset('assets/images/ministere.png') }}">
                        {{-- <img src="{{ asset('assets/images/mi-logo.png') }}"> --}}

                    </div>
                    <b>{{ $formationAvenir->desc }}</b>
                </div>
            @endforeach


            <div class="sidebar-useful-links">
                {{-- <a href="#">A propos</a>
                <a href="#">Accessibility</a>
                <a href="#">Help Center</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Advertising</a>
                <a href="#">Get the App</a>
                <a href="#">More</a> --}}


                <div class="copyright-msg">
                    <img src="{{ asset('assets/images/logo.png') }}">
                    <p>Minsihoue &#169; 2024. Tous droits réservé</p>
                </div>
            </div>
        </div>
    </div>
    @yield('script')
</body>

</html>
