@extends('template.temp')
@section('titre')
    Accueil
@endsection
@section('main')
    @php
        $avatar = Storage::url(session('user')['photo']);
    @endphp
    <style>
        .btn {
            display: inline-block;
            padding: 0.9rem 1.8rem;
            font-size: 16px;
            font-weight: 700;
            color: black;
            border: 3px solid rgb(252, 70, 100);
            cursor: pointer;
            position: relative;
            background-color: transparent;
            text-decoration: none;
            overflow: hidden;
            z-index: 1;
            font-family: inherit;
        }

        .btn::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(252, 70, 100);
            transform: translateX(-100%);
            transition: all 0.3s;
            z-index: -1;
        }

        .btn:hover::before {
            transform: translateX(0);
        }
    </style>
    <div class="main-content">
        <div class="create-post">
            <div class="profile-message-btn center-block text-center">
            </div>
            @if (session('info') == null)
                <a class="btn" href="{{ route('user.index') }}">Complétez votre inscription</a> pour profiter de toutes les
                fonctionnalités de
                notre site
            @else
                <div class="create-post-input">
                    <form action="{{ route('publication.store') }}" method="POST" enctype="multipart/form-data">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->has('texte') || $errors->has('photo'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf

                        <img src="{{ $avatar }}">
                        <textarea rows="2" placeholder="Que voulez-vous publier ?" name="texte"></textarea>
                </div>
                <div class="create-post-links">
                    <li>
                        <input type="file" name="photo_pub" id="photo" style="display: none;">
                        <label for="photo"><img src="{{ asset('assets/images/photo.png') }}" alt="Photo"
                                style="cursor: pointer">Photo</label>

                    </li>
                    <li><img src="{{ asset('assets/images/document.png') }}"> <button type="button" id="document"
                            style="border: none;background:none">Document</button></li>
                    @if (session('user')['grade'] == 'cpins')
                        <li><img src="{{ asset('assets/images/event.png') }}"><button type="button" id="formation"
                                style="border: none;background:none"> Formation à venir</button></li>
                    @endif
                    <li><button type="submit" name="PostSoumission"
                            style="background:#045be6;border:none;color:#fff">Poster</button></li>
                    </form>

                </div>
            @endif
            <div id="preview"></div>
        </div>
        <div class="sort-by">
            <hr>
            <p><span><img src="{{ asset('assets/images/down-arrow.png') }}"></span> </p>

        </div>
        @foreach ($fils as $key => $post)
            <div class="post">
                <div class="post-author">
                    <img src="/storage/{{ $post->auteur->photo }}">
                    <div>
                        <h1>{{ $post->auteur->name }}</h1>
                        <small>Founder and CEO at Giva | Angel Investor</small>
                        <small>{{ $post->time }}</small>
                    </div>
                </div>
                <p>{{ $post->texte }}
                </p>
                @if ($post->photo != 'null')
                    <img src="/storage/{{ $post->photo }}"width="100%">
                @endif
                <div class="post-stats">
                    <div>
                        <img src="{{ asset('assets/images/thumbsup.png') }}">
                        <img src="{{ asset('assets/images/love.png') }}">
                        <img src="{{ asset('assets/images/clap.png') }}">
                        <span class="liked-users">Adam Doe and 89 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                </div>
                <div class="post-activity">
                    <div>
                        <img src="{{ asset('assets/images/user-1.png') }}" class="post-activity-user-icon">
                        <img src="{{ asset('assets/images/down-arrow.png') }}" class="post-activity-arrow-icon">

                    </div>
                    <div class="post-activity-link">
                        <img src="{{ asset('assets/images/like.png') }}">
                        <span>Like</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{ asset('assets/images/comment.png') }}">
                        <span>Comment</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{ asset('assets/images/share.png') }}">
                        <span>Share</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{ asset('assets/images/send.png') }}">
                        <span>Send</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Document Modal form-->
    <div class="body">
        <div id="modalDocument" class="modal">
            <div class="modal-content">

                <span class="close">&times;</span>
                <div class="form-container">
                    <form id="document-form" action="{{ route('publication.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any() && session('last_submitted') == 'document')
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h2>Soumettre un Document</h2>
                        <label for="doc-type">Type de document :</label>
                        <select id="doc-type" name="type" required>
                            <option value="">--Sélectionner le type--</option>
                            <option value="guide">Guide</option>
                            <option value="fiche">Fiche</option>
                        </select>

                        <div id="common-fields">
                            <label for="title">Titre :</label>
                            <input type="text" id="title" name="titre" required>

                            <div class="upload-btn-wrapper">
                                <button class="upload-btn">
                                    <i class="fa fa-upload" aria-hidden="true"></i> Choisir un fichier
                                </button>
                                <input type="file" id="file" name="document" required style="display:none">
                            </div>
                        </div>

                        <div id="common-fields">
                            <label for="description">Description :</label>
                            <textarea id="description" name="description" cols="25"></textarea>

                            <label for="class">Classe :</label>
                            <select name="classe" id="class">
                                <option value="">--Choisissez une classe--</option>
                                <option value="CI">CI</option>
                                <option value="CP">CP</option>
                                <option value="CE1">CE1</option>
                                <option value="CE2">CE2</option>
                                <option value="CM1">CM1</option>
                                <option value="CM2">CM2</option>
                            </select>
                        </div>

                        <div id="fiche-fields" class="conditional-fields" style="display: none;">
                            <label for="subject">Matière :</label>
                            <input type="text" id="subject" name="matiere">

                            <label for="learning-situation">Situation d'apprentissage :</label>
                            <input type="text" id="learning-situation" name="SA">
                        </div>

                        <label for="paid">Document payant :</label>
                        <label class="switch">
                            <input type="checkbox" id="paid" name="paid">
                            <span class="slider round"></span>
                        </label>
                        <!-- Affiche le prix du document si le document est payant -->
                        <div id="priceDoc" style="display: none;">
                            <label for="prix">Prix du document</label>
                            <input type="number" name="priceDoc" id="prix" min="0">
                        </div>
                        <button type="submit" name="DocumentSoumission">Soumettre</button>
                    </form>
                </div>
            </div>
        </div>


        <!-- Formation Modal -->
        <div id="modalFormation" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="form-container">
                    @if ($errors->any() && session('last_submitted') == 'formation')
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="formation-form" action="{{ route('publication.store') }}" method="POST">
                        @csrf
                        <h2>Programmez une Formation</h2>
                        <label for="titreForm">Titre de la formation</label>
                        <input type="text" name="titreForm" placeholder="Titre de la formation">
                        <label for="auteur"> Auteur</label>
                        <select name="auteur" id="auteur">
                            <option value="">--Choisissez un auteur--</option>
                            <option value="Vous">Vous</option>
                            <option value="Ministere">Ministère</option>
                            <option value="Circonscription">Circonscription</option>
                        </select>
                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc" cols="30" rows="2" placeholder="Une petite description"></textarea>
                        <div class="date">
                            <label for="dateDebut">
                                Date de début
                                <input type="date" name="DateDebut" placeholder="Date début">
                            </label>
                            <label for="dateFin">
                                Date de fin
                                <input type="date" name="DateFin" placeholder="Date fin">
                            </label>
                        </div>
                        <!--div id="programmation-wrapper">                                                                                                                             </div-->
                        <label for="paid">Formation payante :</label>
                        <label class="switch">
                            <input type="checkbox" id="forpaid" name="paid">
                            <span class="slider round"></span>
                        </label>
                        <!--affiche le prix du document si le document est payant-->
                        <div style="display: none" id="PriceFor">
                            <label for="prix">
                                Prix de la formation
                            </label>
                            <input type="number" name="priceFor" id="prix" min="0">
                        </div>
                        <button type="submit" name="FormationSoumission">Programmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/repeat/jquery.input.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/repeat/lib.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/repeat/repeater.js') }}"></script>
    <script>
        document.querySelector('.upload-btn').addEventListener('click', function() {
            document.querySelector('#file').click();
        });
        document.addEventListener('DOMContentLoaded', () => {
            const docTypeSelect = document.getElementById('doc-type');
            const ficheFields = document.getElementById('fiche-fields');
            const paidCheckbox = document.getElementById('paid');
            const priceDoc = document.getElementById('priceDoc');
            const pricefor = document.getElementById('PriceFor');
            const payant = document.getElementById('paid');
            const ForPayant = document.getElementById('forpaid');

            ForPayant.addEventListener('click', function() {
                if (this.checked) {
                    pricefor.style.display = 'block';
                } else {
                    pricefor.style.display = 'none';
                }
            })

            docTypeSelect.addEventListener('change', function() {
                if (this.value === 'fiche') {
                    ficheFields.style.display = 'block';
                } else {
                    ficheFields.style.display = 'none';
                }
            });
            paidCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    priceDoc.style.display = 'block';
                } else {
                    priceDoc.style.display = 'none';
                }
            });

            // Modal about document
            const modal = document.getElementById("modalDocument");
            const btn = document.getElementById("document");
            const formationBtn = document.getElementById('formation');
            const formationModal = document.getElementById('modalFormation');
            const span = document.getElementsByClassName("close")[0];

            btn.onclick = function() {
                modal.style.display = "block";
            }

            formationBtn.onclick = function() {
                formationModal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                if (event.target == formationModal) {
                    formationModal.style.display = "none";
                }
            }

        });
        // Photo treatment
        document.getElementById('photo').onchange = function(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById('preview');
                    preview.innerHTML = `
                <img src="${e.target.result}" alt="Image Preview" width="100"/>
                <div class="icon-container">
                    <div class="icon" id="edit-icon">
                        <img src="{{ asset('assets/images/edit.png') }}" alt="Edit">
                    </div>
                    <div class="icon" id="delete-icon">
                        <img src="{{ asset('assets/images/delete.png') }}" alt="Delete">
                    </div>
                </div>
            `;

                    document.getElementById('edit-icon').onclick = function() {
                        document.getElementById('photo').click();
                    };

                    document.getElementById('delete-icon').onclick = function() {
                        preview.innerHTML = '';
                        document.getElementById('photo').value = '';
                    };
                };
                reader.readAsDataURL(file);
            }
        };
    </script>
@endsection
