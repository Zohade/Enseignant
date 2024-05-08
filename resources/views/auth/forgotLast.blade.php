<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/forgot.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/alert.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau mot de passe</title>
</head>
<body>

    <form class="form3" action="{{route('newpasschange')}}"  method="post">
        @csrf
        @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
        @endif
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                          <li>  {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
       <p class="form-title">Changer votre mot de passe</p>
        <div class="input-container">
          <input placeholder="Nouveau mot de passe" type="password" name="mot_de_passe">

          <span>
            <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
              <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
          </span>
        </div>
        <div class="input-container">
          <input placeholder="Confirmer" type="password" name="mot_de_passe_confirmation">

          <span>
            <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
              <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
          </span>
        </div>
        <input type="hidden" value="{{$userId}}" name="id">
        <button class="submit" type="submit">
        Sauvegarder
      </button>
   </form>

</body>
</html>
