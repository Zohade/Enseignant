<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Mon profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/profil.css') }}">
    <script src="{{ asset('assets/vendor/cropper/cropper.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/cropper/cropper.css') }}">
    <style>
        #photoPreview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            display: none;
        }

        .img-container img {
            max-width: 100%;
            max-height: 60vh;
        }
    </style>
</head>

<body>
    @php
        $user = session('user');
        $avatar = Storage::url($user['photo']);
    @endphp
    @include('template.menu')
    <div class="container bootstrap snippets bootdeys">
        <div class="row" id="user-profile">
            <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="main-box clearfix">
                    <h2>{{ $user['name'] }}</h2>
                    <div class="profile-status">
                        <i class="fa fa-check-circle"></i> En ligne
                    </div>
                    @if (session('info') == null)
                        <span class="label label-danger">Completez votre inscription</span>
                    @endif
                    <img src="{{ $avatar }}" alt class="profile-img img-responsive center-block" id="ImageBase">
                    <!--bouton pour déclencher le form de modification photo-->
                    <button id="modifierPhoto" title="Modifier photo" style="border: none">
                        <i class="fa fa-camera-retro fa-lg"></i> Modifier la photo
                    </button>
                    <!-- Formulaire de modification de la photo-->
                    <form action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        <input type="file" id="photoInput" name="photo" style="display: none;" accept="image/*"
                            data-action="{{ route('profil.store') }}">
                    </form>
                    <button id="buttonOK" style="display: none">Continuez</button>
                    <img id="photoPreview" src="#" alt="Prévisualisation de la photo">
                    <div class="profile-label">
                        <span class="label label-danger">{{ $user['grade'] }}</span>
                    </div>
                    <div class="profile-details">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-truck"></i>Orders: <span>456</span></li>
                            <li><i class="fa-li fa fa-comment"></i>Posts: <span>828</span></li>
                            <li><i class="fa-li fa fa-tasks"></i>Tasks done: <span>1024</span></li>
                        </ul>
                    </div>
                    @if (session('info') == null)
                        <div class="profile-message-btn center-block text-center">
                            <a href="{{ route('user.index') }}" class="btn btn-success">
                                <i class="fa fa-envelope"></i> Completer votre inscription
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="main-box clearfix">
                    <div class="profile-header">
                        <h3><span>Vos informations</span></h3>
                        <a href="#" class="btn btn-primary edit-profile">
                            <i class="fa fa-pencil-square fa-lg"></i> Modifier vos informations
                        </a>
                    </div>
                    <div class="row profile-user-info">
                        <div class="col-sm-8">
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Nom
                                </div>
                                <div class="profile-user-details-value">
                                    {{ $user['name'] }}
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Adresse
                                </div>
                                <div class="profile-user-details-value">
                                    {{ $data['arrondissement']->name . ', ' . $data['ville']->name . ', ' . $data['departement']->name }}
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Circonscription
                                </div>
                                <div class="profile-user-details-value">
                                    {{ $data['circonscription']->nom }}
                                </div>
                            </div>
                            @if (session('user')['grade'] != 'cpins')
                                <div class="profile-user-details clearfix">
                                    <div class="profile-user-details-label">
                                        Ecole
                                    </div>
                                    <div class="profile-user-details-value">
                                        {{ $data['ecole']->nom }}
                                    </div>
                                </div>
                                <div class="profile-user-details clearfix">
                                    <div class="profile-user-details-label">
                                        Groupe
                                    </div>
                                    <div class="profile-user-details-value">
                                        {{ $data['groupe']->nom }}
                                    </div>
                                </div>
                                @if (session('user')['grade'] == 'insituteur')
                                    <div class="profile-user-details clearfix">
                                        <div class="profile-user-details-label">
                                            Classe
                                        </div>
                                        <div class="profile-user-details-value">
                                            {{ $data['classe']->nom }}
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-sm-4 profile-social">
                            <ul class="fa-ul">
                                <li><i class="fa-li fa fa-twitter-square"></i><a
                                        href="tel:+229{{ $user['phone_number'] }}">{{ $user['phone_number'] }}</a>
                                </li>
                                <li><i class="fa-li fa fa-whatsapp"></i><a
                                        href="https://wa.me/{{ $user['phone_number'] }}">{{ $user['phone_number'] }}</a>
                                </li>
                                <li><i class="fa-li fa fa-envelope" aria-hidden="true"></i><a
                                        href="mailto:{{ $user['email'] }}">{{ $user['email'] }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tabs-wrapper profile-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-activity" data-toggle="tab">Vos publications</a></li>
                            <li><a href="#tab-friends" data-toggle="tab">Vos téléchargements</a></li>
                            @if (session('user')['grade'] == 'directeur')
                                <li><a href="#tab-chat" data-toggle="tab">Publication en attente de validation</a></li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-activity">
                                <!-- Ajout de la liste déroulante -->
                                <div class="form-group">
                                    <label for="publicationType">Sélectionnez le type de publication :</label>
                                    <select class="form-control" id="publicationType">
                                        <option value="posts">Posts</option>
                                        <option value="documents">Documents</option>
                                        @if ($user['grade'] == 'cpins')
                                            <option value="formations">Formations</option>
                                        @endif
                                    </select>
                                </div>

                                <div id="postsContainer">
                                    @if ($data['posts'] == null)
                                        <p>Vous n'avez aucun post</p>
                                    @else
                                        @foreach ($data['posts'] as $post)
                                            <div class="post">
                                                <div
                                                    class="post-header d-flex justify-content-between align-items-center">
                                                    <div class="post-author">
                                                        <img src="{{ $avatar }}" class="author-avatar">
                                                        <div>
                                                            <span class="author-name">{{ $user['name'] }}</span>
                                                            <small>{{ $post->time_elapsed }}</small>
                                                            <!-- Durée de la publication -->
                                                        </div>
                                                    </div>
                                                    <div class="post-options dropdown">
                                                        <button class="btn dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </button>
                                                        @if ($user['grade'] == 'instituteur')
                                                            @if ($post->statutPub == 'attente')
                                                                <span class="label label-primary">En attente</span>
                                                            @elseif($post->statutPub == 'valide')
                                                                <span class="label label-success">On Hold</span>
                                                            @elseif($post->statutPub == 'rejet')
                                                                <span class="label label-danger">Rejetté</span>
                                                            @endif
                                                        @endif
                                                        <div class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <li><a href="{{ route('post.destroy', ['post' => $post->id]) }}"
                                                                    class="offset-1"
                                                                    onclick="event.preventDefault(); if (confirm('Êtes-vous sûr de vouloir supprimer ce post ?')) document.getElementById('delete-form-{{ $post->id }}').submit();">
                                                                    Supprimer </a> </li>
                                                            <form id="delete-form-{{ $post->id }}"
                                                                action="{{ route('post.destroy', ['post' => $post->id]) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <li>
                                                                <a href="#" class="dropdown-item"
                                                                    onclick="event.preventDefault(); document.getElementById('edit-post-{{ $post->id }}').style.display='block';">
                                                                    Modifier
                                                                </a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#">Partager</a>
                                                            </li>
                                                        </div>
                                                        <form id="edit-post-{{ $post->id }}"
                                                            action="{{ route('post.update', ['post' => $post->id]) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <textarea class="form-control" name="texte" rows="2">{{ $post->texte }}</textarea>
                                                            </div>
                                                            <div class="clearfix">
                                                                <input type="submit" name="PostSoumission"
                                                                    class="btn btn-success pull-right"
                                                                    value="Enregistrer">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <p style="font-weight: bold;color:black">{{ $post->texte }}</p>
                                                @if ($post->photo != 'null')
                                                    <img src="{{ asset('storage/' . $post->photo) }}" width="100%"
                                                        class="post-image">
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>


                                <div id="documentsContainer" style="display: none;">
                                    @if ($data['documents'] == null)
                                        <p>Vous n'avez aucun document soumis</p>
                                    @else
                                        @foreach ($data['documents'] as $document)
                                            <div class="document">
                                                <h4>{{ $document->title }}</h4>
                                                <p>{{ $document->description }}</p>
                                                <a href="{{ asset('storage/' . $document->file) }}"
                                                    download>Télécharger</a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @if ($user['grade'] == 'cpins')
                                    <div id="formationsContainer" style="display: none;">
                                        @if ($data['formations'] == null)
                                            <p>Vous n'avez programmé aucune formation</p>
                                        @else
                                            @foreach ($data['formations'] as $formation)
                                                <div class="formation">
                                                    <h4>{{ $formation->title }}</h4>
                                                    <p>{{ $formation->description }}</p>
                                                    {{-- <a href="{{ route('formations.show', $formation->id) }}">Voir Détails</a> --}}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="tab-friends">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th><span>Type</span></th>
                                                <th><span>Contenu</span></th>
                                                <th><span>Date</span></th>
                                                <th><span>Status</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#" class="user-link">Lorem</a>
                                                </td>
                                                <td>25</td>
                                                <td>2012/05/06</td>
                                                <td class="text-center">
                                                    <span class="label label-default">Inactive</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-chat">
                                <div class="conversation-wrapper">
                                    <div class="conversation-content">
                                        <div class="slimScrollDiv"
                                            style="position: relative; overflow: hidden; width: auto; height: 340px;">
                                            <div class="conversation-inner"
                                                style="overflow: hidden; width: auto; height: 340px;">
                                            </div>
                                            <div class="slimScrollBar"
                                                style="background: rgb(232, 230, 230); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px;">
                                            </div>
                                            <div class="slimScrollRail"
                                                style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let cropper;
            var form = document.getElementById('form');

            $('#modifierPhoto').on('click', function() {
                $('#photoInput').click();
            });

            $('#photoInput').on('change', function(event) {
                var image = document.getElementById('ImageBase');
                var files = $(this)[0].files;
                var file = files[0];
                var url = $(this).attr('data-action');
                if (file) {
                    $("#buttonOK").show();
                    $("#ImageBase").attr('src', window.URL.createObjectURL(file));
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: 4 / 3,
                    });

                    $("#buttonOK").off('click').on('click', function() {
                        cropper.getCroppedCanvas().toBlob(function(blob) {
                            var formData = new FormData(form);
                            formData.append("croppedImage", blob);
                            $.ajax({
                                type: "POST",
                                url: url,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr(
                                            'content')
                                },
                                data: formData,
                                processData: false, // Important for sending FormData
                                contentType: false, // Important for sending FormData
                                dataType: 'JSON',
                                success: function(data) {
                                    alert(
                                        'Votre photo de profil a été mis à jour avec succès'
                                    );
                                    window.location.reload();
                                },
                                error: function(err) {
                                    alert('Une erreur s\'est produite');
                                }
                            });
                        });
                    });
                }
            });

            $('#publicationType').on('change', function() {
                var selectedType = $(this).val();
                if (selectedType === 'posts') {
                    $('#postsContainer').show();
                    $('#documentsContainer').hide();
                    $('#formationsContainer').hide();
                } else if (selectedType === 'documents') {
                    $('#postsContainer').hide();
                    $('#documentsContainer').show();
                    $('#formationsContainer').hide();
                } else if (selectedType === 'formations') {
                    $('#postsContainer').hide();
                    $('#documentsContainer').hide();
                    $('#formationsContainer').show();
                }
            });
        });
    </script>

</body>

</html>
