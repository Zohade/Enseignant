<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EPP AGBONON</title>
</head>

<body>
    <h1>{{ $data['title'] }}</h1>
    <p>{{ $data['body'] }}</p>
    <form action="{{$data['confirmationLink']}}" method="get">
        @csrf
        <button class="btn btn-success">
           Confirmez
        </button>
    </form>

</body>

</html>

