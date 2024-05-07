<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/form.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/alert.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<body>
    <div class="form-container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        <p class="title">Connexion</p>
        <form class="form" action="{{route('loginPost')}}" method="POST">
            @csrf
            <input type="email" name="Son_mail" class="input" value="{{old('Son_mail')}}" placeholder="Adresse mail ou numéro de téléphone" required>
            <input type="password" name="Son_pass" class="input" placeholder="Mot de passe" required>
            <p class="page-link">
            <a href="{{route('forget')}}" style="color:teal;" class="page-link-label">Mot de passe oublié?</a>
            </p>
            <button class="form-btn">Connexion</button>
        </form>
        <p class="sign-up-label">
            Vous n'avez pas un compte ?
            <a class="sign-up-link" href="{{route('signUp')}}" >
                Inscrivez-vous
            </a>
            </form>
        </p>
   </div>
</body>
</html>
