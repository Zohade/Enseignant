<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/register.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
</head>
<body><form action="{{route('signUpPost')}}" class="form" method="post">
    @csrf
    <p class="title">Inscription </p>
    <p class="message">Inscrivez-vous pour profiter pleinement de votre application </p>
        <div class="flex">
        <label>
            <input class="input" id="oh" type="text" placeholder="">
            <span>Nom</span>
        </label>

        <label>
            <input class="input" type="text" placeholder="">
            <span>Prénoms</span>
        </label>
    </div>

    <label>
        <input class="input" type="email" placeholder="">
        <span>Adresse mail</span>
    </label>

    <label>
        <input class="input" type="password" placeholder="">
        <span>Mot de passe</span>
    </label>
    <label>
        <input class="input" type="password" placeholder="">
        <span>Confirmez le mot de passe</span>
    </label>
    <button class="submit">S'inscrire</button>
    <p class="signin">Si vous avez déjà un compte, <a href="{{route('login')}}">Connectez-vous</a> </p>
</form></body>
</html>
