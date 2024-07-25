<link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">
<nav class="navbar">
    <div class="navbar-left">
        <a href="index.html" class="logo"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"
                style="width: 50px"></a>
        <div class="search-box">
            <img src="{{ asset('assets/images/search.png') }}">
            <input type="text" placeholder="Rechercher">
        </div>
    </div>
    <div class="navbar-center">
        <ul>
            <li><a href="{{ route('dash') }}" class="{{ request()->routeIs('dash') ? 'active-link' : '' }}">
                    <img src="{{ asset('assets/images/home.png') }}" alt="home">
                    <span>Accueil</span></a></li>
            <li><a href="{{ route('document.index') }}"
                    class="{{ request()->routeIs('document.index') ? 'active-link' : '' }}">
                    <img src="{{ asset('assets/images/guide.png') }}" alt="network">
                    <span>Documents</span></a></li>
            <li><a href="#" class="{{ request()->routeIs('messages') ? 'active-link' : '' }}">
                    <img src="{{ asset('assets/images/message.png') }}" alt="message">
                    <span>Collaboration</span></a></li>
            <li><a href="#" class="{{ request()->routeIs('notifications') ? 'active-link' : '' }}">
                    <img src="{{ asset('assets/images/notification.png') }}" alt="notification">
                    <span>Notifications</span></a></li>
        </ul>

    </div>
    <div class="navbar-right">
        <div class="online">
            @php
                $avatar = Storage::url(session('user')['photo']);
            @endphp
            <img src="{{ $avatar }}" class="nav-profile-img" onclick="toggleMenu()">
        </div>
    </div>
    <!----Dropdown menu-->
    <div class="profile-menu-wrap" id="profileMenu">
        <div class="profile-menu">
            <div class="user-info">
                <img src="{{ $avatar }}">
                <div>
                    <h3>{{ session('user')['name'] }}</h3>
                    <a href="{{ route('profil.index', ['userId' => session('user')['id']]) }}">Voir votre profil</a>
                </div>
            </div>
            <hr>
            <a href="#" class="profile-menu-link">
                <img src="{{ asset('assets/images/setting.png') }}">
                <p>Paramètres</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="{{ asset('assets/images/help.png') }}">
                <p>Aide et support</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="{{ asset('assets/images/display.png') }}">
                <p>Display & Accessibility</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link" id="logout-link">
                <img src="{{ asset('assets/images/logout.png') }}">
                <p>Deconnexion</p>
                <span>></span>
            </a>
            <!-- The Modal -->
            <div id="logoutModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p style="color:black">Êtes-vous sûr de vouloir vous déconnecter ?</p>
                    <button id="confirm-logout">Oui</button>
                    <button id="cancel-logout">Non</button>
                </div>
            </div>


        </div>
    </div>
</nav>
<script>
    var modal = document.getElementById("logoutModal");
    var btn = document.getElementById("logout-link");
    var span = document.getElementsByClassName("close")[0];
    var cancelBtn = document.getElementById("cancel-logout");
    var confirmBtn = document.getElementById("confirm-logout");
    btn.onclick = function(event) {
        event.preventDefault();
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }
    cancelBtn.onclick = function() {
        modal.style.display = "none";
    }
    confirmBtn.onclick = function() {
        window.location.href = "/logout";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    let profileMenu = document.getElementById("profileMenu");

    function toggleMenu() {
        profileMenu.classList.toggle("open-menu");
    }

    let sideActivity = document.getElementById("sidebarActivity");
    let moreLink = document.getElementById("showMoreLink");

    function toggleActivity() {
        sideActivity.classList.toggle("open-activity");
        if (sideActivity.classList.contains("open-activity")) {
            moreLink.innerHTML = "Show less <b>-</b>";

        } else {
            moreLink.innerHTML = "Show More <b>+</b>";
        }
    }
</script>
