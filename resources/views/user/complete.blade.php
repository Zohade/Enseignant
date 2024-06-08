@include('template.menu')
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/alert.css') }}">
    <title>Compléter inscription</title>
</head>

<body>
    <div id="form" class="form" data-user-grade="{{ session('user')['grade'] }}">
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

        <form action="#" method="post">
            @csrf
            <h1>Complétez votre inscription</h1>
            <select name="ville" id="ville">
                <option value=""><--Villes--></option>
                @foreach ($villes as $key => $ville)
                    <option value="{{ $ville->id }}">{{ $ville->name }}</option>
                @endforeach
            </select>
            <select id="circonscription" name="circonscription" required value="{{ old('circonscription') }}">
                <option>circonscription</option>
            </select>
            <div id="AjouterC" style="display: none;">
                <h3>Aucune circonscription n'est présente dans cette ville. Veuillez ajouter la vôtre</h3>
                <button type="button" id="AjouterCB">Ajouter votre circonscription</button>
            </div>
            <select id="ecole" name="ecole" required value="{{ old('ecole') }}">
                <option>ecole</option>
            </select>
            <select id="groupe" name="groupe" required value="{{ old('groupe') }}">
                <option>groupe</option>
            </select>
            <select id="classe" name="classe" required value="{{ old('classe') }}">
                <option>classe</option>
            </select>
        </form>
    </div>
    <!--Modal pour ajouter une circonscription-->
    <div id="modalC" style="display: none">
        <form action="{{ route('circonscription.store') }}" method="post">
            @csrf
            <input type="hidden" name="ville" id="ville-hidden" value="">
            <input type="text" name="nomC" id="nomC" placeholder="Nom de la circonscription">
            <label for="role">Votre rôle <select name="role" id="role">
                    <option value="chef">Chef</option>
                    <option value="collaborateur">Collaborateur</option>
                </select>
            </label>
            <div id="infoChef" style="display: none">
                <input type="text" name="nomChef" placeholder="Nom et prénom du Chef">
                <input type="tel" name="numChef" placeholder="Numéro du Chef">
            </div>
            <button type="submit">Créer</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(function() {
            $('#ville').change(function() {
                const villeId = $(this).val();
                updateCircons(villeId);
                $('#ville-hidden').val(villeId);
            });

            function updateCircons(villeId) {
                $.ajax({
                    url: '/get-circons/' + villeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const userGrade = $('#form').data('user-grade');
                        $('#circonscription').empty();
                        $('#circonscription').append('<option></option>');
                        if (data && data.circons && data.circons.length === 0 && userGrade ===
                            'cpins') {
                            $('#AjouterC').show();
                            $('#ville, #circonscription, #ecole, #groupe, #classe').hide();
                        } else if (data && data.circons) {
                            $('#AjouterC').hide();
                            $('#ville, #circonscription, #ecole, #groupe, #classe').show();
                            $.each(data.circons, function(key, value) {
                                $('#circonscription').append('<option value="' + value.id +
                                    '">' + value.nom + '</option>');
                            });
                        } else {
                            console.error('Unexpected response format:', data);
                            alert('Erreur de données: format de réponse inattendu.');
                        }
                    },
                    error: function(resultat, statut, erreur) {
                        console.error('AJAX error:', erreur);
                        alert('Erreur: ' + erreur);
                    }
                });
            }
        });

        const buttonCB = document.getElementById('AjouterCB');
        const modalC = document.getElementById('modalC');
        const role = document.getElementById('role');
        const infoChef = document.getElementById('infoChef');

        buttonCB.addEventListener('click', function() {
            modalC.style.display = 'block';
        });

        role.addEventListener('change', function() {
            if (this.value === 'collaborateur') {
                infoChef.style.display = 'block';
            } else {
                infoChef.style.display = 'none';
            }
        });
    </script>
</body>

</html>
