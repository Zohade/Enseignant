<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/alert.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}">
</head>

<body>
    <div class="container">
        <h2>
            <div class="logo"></div>Inscription
        </h2>
        <p>Inscrivez-vous pour profiter pleinement de votre plateforme</p>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <hr>
        <form action="{{ route('signUpPost') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="Nom" name="nom" value="{{ old('nom') }}" required>
                <input type="text" placeholder="Prénom" name="prenom" value="{{ old('prenom') }}" required>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Adresse e-mail" name="mail" value="{{ old('mail') }}" required>
                <input type="tel" placeholder="Numéro de téléphone" name="phone_number"
                    value="{{ old('phone_number') }}" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Mot de passe" name="password" required id="password">
                <input type="password" placeholder="Confirmer mot de passe" name="password_confirmation" required>
            </div>
            <div id="strengthMessage"></div>
            <div class="textPass">
                <p>
                <ul>
                    <li>Minimum 8 caractères</li>
                    <li>Au moins une lettre majuscule</li>
                    <li>Au moins une lettre miniscule</li>
                    <li>Au moins un chiffre</li>
                    <li>Au moins un caractère spécial</li>
                </ul>
                </p>
            </div>
            <div class="form-group">
                <select id="departement" name="departement" value="{{ old('departement') }}" required>
                    <option>Département</option>
                    @foreach ($departements as $key => $departement)
                        <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                    @endforeach
                </select>
                <select id="ville" name="ville" required value="{{ old('ville') }}">
                    <option>Ville</option>
                </select>
                <select id="arrondissement" name="arrondissement" value="{{ old('arrondissement') }}" required>
                    <option>Arrondissement</option>
                </select>
            </div>
            <div class="form-group">
                <label>Grade:</label>
                <input type="radio" name="grade" value="instituteur"> Instituteur
                <input type="radio" name="grade" value="directeur"> Directeur
                <input type="radio" name="grade" value="cpins"> Cp ou Inspecteur
            </div>
            <div class="form-group">
                <button type="submit" class="form-btn">S'inscrire</button>
            </div>
        </form>
        <p class="sign-up-label">
            Vous avez déjà un compte ?
            <a class="sign-up-link" href="{{ route('login') }}">
                Connectez-vous
            </a>
            </form>
        </p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        document.getElementById('password').addEventListener('input', function() {
            var password = this.value;
            var strengthMessage = document.getElementById('strengthMessage');

            var strength = getPasswordStrength(password);

            switch (strength) {
                case 'weak':
                    strengthMessage.textContent = 'Faible';
                    strengthMessage.className = 'weak';
                    break;
                case 'medium':
                    strengthMessage.textContent = 'Moyen';
                    strengthMessage.className = 'medium';
                    break;
                case 'strong':
                    strengthMessage.textContent = 'Fort';
                    strengthMessage.className = 'strong';
                    break;
                default:
                    strengthMessage.textContent = '';
                    strengthMessage.className = '';
            }
        });

        function getPasswordStrength(password) {
            var strength = 'weak';
            if (password.length >= 8) {
                var hasUpperCase = /[A-Z]/.test(password);
                var hasLowerCase = /[a-z]/.test(password);
                var hasNumbers = /[0-9]/.test(password);
                var hasSpecialChars = /[!@#\$%\^\&*\)\(+=._-]/.test(password);

                if (hasUpperCase + hasLowerCase + hasNumbers + hasSpecialChars >= 3) {
                    strength = 'medium';
                }
                if (hasUpperCase + hasLowerCase + hasNumbers + hasSpecialChars === 4) {
                    strength = 'strong';
                }
            }

            return strength;
        }

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
