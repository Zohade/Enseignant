<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Mon profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
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
                    <span class="label label-danger">Completez votre inscription</span>
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
                    <div class="profile-message-btn center-block text-center">
                        <a href="{{ route('user.index') }}" class="btn btn-success">
                            <i class="fa fa-envelope"></i> Completer votre inscription
                        </a>
                    </div>
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
                                    10880 Malibu Point,
                                    <br> Malibu, Calif., 90265
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Circonscription
                                </div>
                                <div class="profile-user-details-value">
                                    10880 Malibu Point,
                                    <br> Malibu, Calif., 90265
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Ecole
                                </div>
                                <div class="profile-user-details-value">
                                    oh
                                </div>
                            </div>
                            <div class="profile-user-details clearfix">
                                <div class="profile-user-details-label">
                                    Classe
                                </div>
                                <div class="profile-user-details-value">
                                    ok
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 profile-social">
                            <ul class="fa-ul">
                                <li><i class="fa-li fa fa-phone-square"></i><a
                                        href="tel:+229{{ $user['phone_number'] }}">{{ $user['phone_number'] }}</a>
                                </li>
                                <li><i class="fa-li fa fa-whatsapp"></i><a
                                        href="https://wa.me/{{ $user['phone_number'] }}">rendre public</a></li>
                                <li><i class="fa-li fa fa-envelope" aria-hidden="true"></i><a
                                        href="mailto:{{ $user['email'] }}">rendre public</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tabs-wrapper profile-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-activity" data-toggle="tab">Vos publications</a></li>
                            <li><a href="#tab-friends" data-toggle="tab">Vos téléchargements</a></li>
                            <li><a href="#tab-chat" data-toggle="tab">Chat</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-activity">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>Type</th>
                                            <th>Contenu</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-book" aria-hidden="true" title="document"></i>
                                                </td>
                                                <td>
                                                    John Doe changed order status from
                                                </td>
                                                <td>
                                                    <span class="label label-primary">En attente</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"
                                                        title="post"></i>
                                                </td>
                                                <td>
                                                    John Doe posted a comment in <a href="#">Lost in Translation
                                                        opening scene</a> discussion.
                                                </td>
                                                <td>
                                                    <span class="label label-success">Validé</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-book" aria-hidden="true" title="document"></i>
                                                </td>
                                                <td>
                                                    John Doe changed order status from
                                                </td>
                                                <td>
                                                    <span class="label label-primary">En attente</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"
                                                        title="post"></i>
                                                </td>
                                                <td>
                                                    John Doe posted a comment in <a href="#">Lost in Translation
                                                        opening scene</a> discussion.
                                                </td>
                                                <td>
                                                    <span class="label label-success">Validé</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-book" aria-hidden="true" title="document"></i>
                                                </td>
                                                <td>
                                                    John Doe changed order status from
                                                </td>
                                                <td>
                                                    <span class="label label-primary">En attente</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"
                                                        title="post"></i>
                                                </td>
                                                <td>
                                                    John Doe posted a comment in <a href="#">Lost in Translation
                                                        opening scene</a> discussion.
                                                </td>
                                                <td>
                                                    <span class="label label-success">Validé</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-book" aria-hidden="true" title="document"></i>
                                                </td>
                                                <td>
                                                    John Doe changed order status from
                                                </td>
                                                <td>
                                                    <span class="label label-primary">En attente</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"
                                                        title="post"></i>
                                                </td>
                                                <td>
                                                    John Doe posted a comment in <a href="#">Lost in Translation
                                                        opening scene</a> discussion.
                                                </td>
                                                <td>
                                                    <span class="label label-success">Validé</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-book" aria-hidden="true" title="document"></i>
                                                </td>
                                                <td>
                                                    John Doe changed order status from
                                                </td>
                                                <td>
                                                    <span class="label label-primary">En attente</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"
                                                        title="post"></i>
                                                </td>
                                                <td>
                                                    John Doe posted a comment in <a href="#">Lost in Translation
                                                        opening scene</a> discussion.
                                                </td>
                                                <td>
                                                    <span class="label label-success">Validé</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
                                            <tr>
                                                <td>
                                                    <a href="#" class="user-link">Ipsum</a>
                                                </td>
                                                <td>25</td>
                                                <td>2012/05/06</td>
                                                <td class="text-center">
                                                    <span class="label label-default">Inactive</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="user-link">Dolor</a>
                                                </td>
                                                <td>25</td>
                                                <td>2012/05/06</td>
                                                <td class="text-center">
                                                    <span class="label label-default">Inactive</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="user-link">Amet</a>
                                                </td>
                                                <td>25</td>
                                                <td>2012/05/06</td>
                                                <td class="text-center">
                                                    <span class="label label-default">Inactive</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="user-link">Sedit</a>
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
                                                <div class="conversation-item item-left clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/user_1.jpg"
                                                            alt="Male">
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">John</div>
                                                        <div class="time hidden-xs">21:00</div>
                                                        <div class="text">
                                                            Hello!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-right clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/user_2.jpg"
                                                            alt="Female">
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">Alice</div>
                                                        <div class="time hidden-xs">21:00</div>
                                                        <div class="text">
                                                            Hi, John
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-right clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/user_2.jpg"
                                                            alt="Female">
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">Alice</div>
                                                        <div class="time hidden-xs">21:00</div>
                                                        <div class="text">
                                                            How are you?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-left clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/user_1.jpg"
                                                            alt="Male">
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">John</div>
                                                        <div class="time hidden-xs">21:00</div>
                                                        <div class="text">
                                                            I'm good. How are you?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-left clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/user_1.jpg"
                                                            alt="Male">
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">John</div>
                                                        <div class="time hidden-xs">21:00</div>
                                                        <div class="text">
                                                            I'm looking for a job.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-right clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/user_2.jpg"
                                                            alt="Female">
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">Alice</div>
                                                        <div class="time hidden-xs">21:00</div>
                                                        <div class="text">
                                                            Sorry to hear that.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slimScrollBar"
                                                style="background: rgb(232, 230, 230); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px;">
                                            </div>
                                            <div class="slimScrollRail"
                                                style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-new-message">
                                        <form>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Enter message..." rows="2"></textarea>
                                            </div>
                                            <div class="clearfix">
                                                <button type="submit" class="btn btn-success pull-right">Send
                                                    message</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="profileFirstName" class="col-sm-2 control-label">First
                                            name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="profileFirstName"
                                                placeholder="First name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profileLastName" class="col-sm-2 control-label">Last name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="profileLastName"
                                                placeholder="Last name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profileEmail" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="profileEmail"
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profilePassword" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="profilePassword"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="profilePassword2" class="col-sm-2 control-label">Confirm
                                            password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="profilePassword2"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Save</button>
                                        </div>
                                    </div>
                                </form>
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

            // Event listener for the "Modifier Photo" button
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
                    // Set the source of the image and initialize the cropper
                    $("#ImageBase").attr('src', window.URL.createObjectURL(file));
                    if (cropper) {
                        cropper.destroy(); // Destroy the old cropper instance
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: 4 / 3,
                    });

                    // Event listener for the "OK" button
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
        });
    </script>
