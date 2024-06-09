<a href="{{ route('dash') }}"><i style="font-size:24px" class="fa">&#xf0a8;</i></a>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/complete.css') }}">
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
            @if (session('user')['grade'] != 'cpins')
                <select id="ecole" name="ecole" required value="{{ old('ecole') }}">
                    <option>ecole</option>
                </select>
                <div id="AjouterE" style="display: none;">
                    <h3>Aucune école n'est présente dans cette circonscription. Veuillez ajouter la vôtre</h3>
                    <button type="button" id="AjouterEB">Ajouter votre école</button>
                </div>
                <select id="groupe" name="groupe" required value="{{ old('groupe') }}">
                    <option>groupe</option>
                </select>
                <div id="AjouterG" style="display: none;">
                    <h3>Aucun groupe n'est présent dans cette école. Veuillez ajouter le vôtre</h3>
                    <button type="button" id="AjouterGB">Ajouter votre groupe</button>
                </div>
                @if (session('user')['grade'] == 'instituteur')
                    <select id="classe" name="classe" required value="{{ old('classe') }}">
                        <option>classe</option>
                    </select>
                    <div id="AjouterCl" style="display: none;">
                        <h3>Aucune classe n'est présente dans ce groupe. Veuillez ajouter la vôtre</h3>
                        <button type="button" id="AjouterClB">Ajouter votre classe</button>
                    </div>
                @endif
            @endif
            <button type="submit">Compètez</button>
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
            <button type="submit" style="display: block">Créer</button>
        </form>
    </div>
    <!--Modal pour ajouter école-->
    <div id="modalE" style="display: none">
        <form action="{{ route('ecole.store') }}" method="post">
            @csrf
            <input type="hidden" name="circonscription" id="circonscription-hidden" value="">
            <input type="text" name="nomE" id="nomE" placeholder="Nom de l'école">
            <input type="text" name="groupe" id="nomE" placeholder="Votre groupe" maxlength="1">
            <button type="submit" style="display: block">Créer</button>
        </form>
    </div>
    <!--ModalG-->
    <div id="modalG" style="display: none">
        <form action="{{ route('groupe.store') }}" method="post">
            @csrf
            <input type="hidden" name="ecole" id="ecole-hidden" value="">
            <input type="text" name="groupe" id="groupe" placeholder="Votre groupe" maxlength="1">
            <button type="submit" style="display: block">Créer</button>
        </form>
    </div>
    <!--Modal Classe-->
    <div id="modalCl" style="display: none">
        <form action="{{ route('classe.store') }}" method="post">
            @csrf
            <input type="hidden" name="groupe" id="groupe-hidden" value="">
            <label for="classe"> Votre classe</label>
            <select name="classe" id="classe">
                <option value="CI">CI</option>
                <option value="CP">CP</option>
                <option value="CE1">CE1</option>
                <option value="CE2">CE2</option>
                <option value="CM1">CM1</option>
                <option value="CM2">CM2</option>
            </select>
            <button type="submit" style="display: block">Créer</button>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#ville').change(function() {
                const villeId = $(this).val();
                updateOptions(villeId, 'circons', '#circonscription', 'circons', 'AjouterC', 'cpins',
                    'ville, #circonscription, #ecole, #groupe, #classe');
                $('#ville-hidden').val(villeId);
            });

            $('#circonscription').change(function() {
                const circonscriptionId = $(this).val();
                updateOptions(circonscriptionId, 'ecoles', '#ecole', 'ecoles', 'AjouterE', 'directeur',
                    'ville, #ecole, #groupe, #classe');
                $('#circonscription-hidden').val(circonscriptionId);
            });

            $('#ecole').change(function() {
                const ecoleId = $(this).val();
                updateOptions(ecoleId, 'groupes', '#groupe', 'groupes', 'AjouterG', 'directeur', '');
                $('#ecole-hidden').val(ecoleId);
            });

            $('#groupe').change(function() {
                const groupeId = $(this).val();
                updateOptions(groupeId, 'classes', '#classe', 'classes', 'AjouterCl', 'instituteur', '');
                $('#groupe-hidden').val(groupeId);
            });

            function updateOptions(id, urlSegment, selectId, dataKey, addButtonId, userGradeValue,
                elementsToShowHide) {
                $.ajax({
                    url: `/get-${urlSegment}/` + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const userGrade = $('#form').data('user-grade');
                        $(selectId).empty();
                        $(selectId).append('<option></option>');

                        if (data && data[dataKey] && data[dataKey].length === 0) {
                            if (userGrade === userGradeValue && addButtonId) {
                                $(`#${addButtonId}`).show();
                                $(`#${elementsToShowHide}`).hide();
                            } else if (addButtonId) {
                                alert('Vous ne pouvez pas compléter votre inscription. Attendez que votre ' +
                                    dataKey + ' soit ajoutée');
                                $(`#${elementsToShowHide}`).hide();
                            }
                        } else if (data && data[dataKey]) {
                            if (addButtonId) $(`#${addButtonId}`).hide();
                            if (elementsToShowHide) $(`#${elementsToShowHide}`).show();
                            $.each(data[dataKey], function(key, value) {
                                $(selectId).append('<option value="' + value.id + '">' + value
                                    .nom + '</option>');
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

            const modalC = document.getElementById('modalC');
            const modalE = document.getElementById('modalE');
            const modalG = document.getElementById('modalG');
            const modalCl = document.getElementById('modalCl')
            const role = document.getElementById('role');
            const infoChef = document.getElementById('infoChef');
            const buttonCB = document.getElementById('AjouterCB');
            const buttonCE = document.getElementById('AjouterEB');
            const buttonGB = document.getElementById('AjouterGB');
            const buttonClB = document.getElementById('AjouterClB');

            if (buttonCE) {
                buttonCE.addEventListener('click', function() {
                    modalE.style.display = 'block';
                });
            }
            if (buttonClB) {
                buttonClB.addEventListener('click', function() {
                    modalCl.style.display = 'block';
                });
            }

            if (buttonCB) {
                buttonCB.addEventListener('click', function() {
                    modalC.style.display = 'block';
                });
            }

            if (role) {
                role.addEventListener('change', function() {
                    if (this.value === 'collaborateur') {
                        infoChef.style.display = 'block';
                    } else {
                        infoChef.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>

</html>
