<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="{{asset('assets/css/register.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/alert.css')}}">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <p>Inscrivez-vous pour profiter pleinement de votre plateforme</p>
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
        <hr>
        <form action="{{route('signUpPost')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="Nom" name="nom" value="{{old("nom")}}" required>
                <input type="text" placeholder="Prénom" name="prenom" value="{{old("prenom")}}" required>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Adresse e-mail" name="mail" value="{{old("mail")}}" required>
                <input type="tel" placeholder="Numéro de téléphone" name="phone_number" value="{{old("phone_number")}}" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Mot de passe" name="password" required>
                <input type="password" placeholder="Confirmer mot de passe" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <select id="departement" name="departement" value="{{old("departement")}}" required>
                    <option>Département</option>
                    @foreach($departements as $key => $departement)
                        <option value="{{$departement->id}}">{{$departement->name}}</option>
                    @endforeach
                </select>
                <select id="ville" name="ville" required value="{{old("ville")}}">
                    <option>Ville</option>
                    <!-- Ajoutez les options pour le mois ici -->
                </select>
                <select id="arrondissement" name="arrondissement" value="{{old("arrondissement")}}" required>
                    <option>Arrondissement</option>
                    <!-- Ajoutez les options pour l'année ici -->
                </select>
            </div>
            <div class="form-group">
                <label>Grade:</label>
                <input type="radio" name="grade" value="instituteur" > Instituteur
                <input type="radio" name="grade" value="directeur"> Directeur
                <input type="radio" name="grade" value="cpins"> Cp ou Inspecteur
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(function() {
            $('#departement').change(function() {
                const departementId = $(this).val();
                updateVilles(departementId);
            });

            function updateVilles(departementId) {
                $.ajax({
                    url: '/get-villes/' + departementId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#ville').empty();
                        $('#ville').append('<option></option>');
                        $.each(data.villes, function(key, value) {
                            $('#ville').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    },
                    error: function(resultat, statut, erreur) {
                        alert(erreur);
                    }
                });
            }
        });

        $(function() {
            $('#ville').change(function() {
                const villeId = $(this).val();
                updateVilles(villeId);
            });

            function updateVilles(villeId) {
                $.ajax({
                    url: '/get-arrondissements/' + villeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#arrondissement').empty();
                        $('#arrondissement').append('<option></option>');
                        $.each(data.arrondissements, function(key, value) {
                            $('#arrondissement').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    },
                    error: function(resultat, statut, erreur) {
                        alert(erreur);
                    }
                });
            }
        });
    </script>
</body>
</html>
