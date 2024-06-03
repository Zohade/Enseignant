<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">

    <title>Mon profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/profil.css') }}">

</head>

<body>
    @php
        $user = session('user');
        $avatar = Storage::url($user['photo']);
    @endphp
    @include('template.menu')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container bootstrap snippets bootdeys">
        <div class="row" id="user-profile">
            <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="main-box clearfix">
                    <h2>{{ $user['name'] }} </h2>
                    <div class="profile-status">
                        <i class="fa fa-check-circle"></i> En ligne
                    </div>
                    <span class="label label-danger">Completez votre inscription</span>
                    <img src="{{ $avatar }}" alt class="profile-img img-responsive center-block">
                    <i class="fa fa-camera" aria-hidden="true" class="profile-img img-responsive center-block"></i>
                    <div class="profile-label">
                        <span class="label label-danger">{{ $user['grade'] }}</span>
                    </div>
                    {{-- <div class="profile-stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <span>Super User</span>
                    </div>
                    <div class="profile-since">
                        Membre depuis le :
                        {{ $user['created_at']->translatedFormat('D d F Y') }}
                    </div> --}}
                    <div class="profile-details">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-truck"></i>Orders: <span>456</span></li>
                            <li><i class="fa-li fa fa-comment"></i>Posts: <span>828</span></li>
                            <li><i class="fa-li fa fa-tasks"></i>Tasks done: <span>1024</span></li>
                        </ul>
                    </div>
                    <div class="profile-message-btn center-block text-center">
                        <a href="#" class="btn btn-success">
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
                                <li><i class="fa-li fa fa-whatsapp "></i>
                                    <a href="https://wa.me/{{ $user['phone_number'] }}">rendre public</a>
                                </li>
                                <li><i class="fa-li fa fa-envelope" aria-hidden="true"></i>
                                    <a href="mailto:{{ $user['email'] }}">rendre public</a>
                                </li>
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
                                                    <i class="fa fa-graduation-cap" aria-hidden="true"
                                                        title="formation"></i>
                                                </td>
                                                <td>
                                                    John Doe changed order status from
                                                </td>
                                                <td>
                                                    <span class="label label-danger">Rejetté</span>
                                                </td>
                                                <td>
                                                    2014/08/08 12:08
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="#" class="btn btn-success pull-right">Voir +</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-friends">
                                <table class="table">
                                    <thead>
                                        <th>Type</th>
                                        <th>Titre</th>
                                        <th>Auteur</th>
                                        <th>Prix</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                Fiche
                                            </td>
                                            <td>
                                                John Doe changed order status from
                                            </td>
                                            <td>
                                                John
                                            </td>
                                            <td>
                                                0 FCFA
                                            </td>
                                            <td>
                                                2014/08/08 12:08
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <a href="#" class="btn btn-success pull-right">Voir +</a>
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
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                            class="img-responsive" alt>
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">
                                                            Ryan Gossling
                                                        </div>
                                                        <div class="time hidden-xs">
                                                            September 21, 2013 18:28
                                                        </div>
                                                        <div class="text">
                                                            I don't think they tried to market it to the billionaire,
                                                            spelunking, base-jumping crowd.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-right clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                            class="img-responsive" alt>
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">
                                                            Mila Kunis
                                                        </div>
                                                        <div class="time hidden-xs">
                                                            September 21, 2013 12:45
                                                        </div>
                                                        <div class="text">
                                                            Normally, both your asses would be dead as fucking fried
                                                            chicken, but you happen to pull this shit while I'm in a
                                                            transitional period so I don't wanna kill you, I wanna help
                                                            you.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-right clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                            class="img-responsive" alt>
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">
                                                            Mila Kunis
                                                        </div>
                                                        <div class="time hidden-xs">
                                                            September 21, 2013 12:45
                                                        </div>
                                                        <div class="text">
                                                            Normally, both your asses would be dead as fucking fried
                                                            chicken, but you happen to pull this shit while I'm in a
                                                            transitional period so I don't wanna kill you, I wanna help
                                                            you.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-left clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                            class="img-responsive" alt>
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">
                                                            Ryan Gossling
                                                        </div>
                                                        <div class="time hidden-xs">
                                                            September 21, 2013 18:28
                                                        </div>
                                                        <div class="text">
                                                            I don't think they tried to market it to the billionaire,
                                                            spelunking, base-jumping crowd.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-item item-right clearfix">
                                                    <div class="conversation-user">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                            class="img-responsive" alt>
                                                    </div>
                                                    <div class="conversation-body">
                                                        <div class="name">
                                                            Mila Kunis
                                                        </div>
                                                        <div class="time hidden-xs">
                                                            September 21, 2013 12:45
                                                        </div>
                                                        <div class="text">
                                                            Normally, both your asses would be dead as fucking fried
                                                            chicken, but you happen to pull this shit while I'm in a
                                                            transitional period so I don't wanna kill you, I wanna help
                                                            you.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slimScrollBar"
                                                style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);">
                                            </div>
                                            <div class="slimScrollRail"
                                                style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-new-message">
                                        <form>
                                            <div class="form-group">
                                                <textarea class="form-control" rows="2" placeholder="Enter your message..."></textarea>
                                            </div>
                                            <div class="clearfix">
                                                <button type="submit" class="btn btn-success pull-right">Send
                                                    message</button>
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
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>
