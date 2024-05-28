<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre')</title>
    <link rel="stylesheet" href="{{asset('assets/css/style_dash.css')}}">
</head>
<body>
    <nav class="navbar">
       <div class="navbar-left">
        <a href="index.html" class="logo"><img src="{{asset('assets/images/logo.png')}}" alt="logo"></a>
        <div class="search-box">
            <img src="{{asset('assets/images/search.png')}}" >
            <input type="text" placeholder="Rechercher">
        </div>
       </div>
       <div class="navbar-center">
        <ul>
            <li><a href="#" class="active-link"><img src="{{asset('assets/images/home.png')}}" alt="home"> <span>Accueil</span></a></li>
            <li><a href="#"><img src="{{asset('assets/images/network.png')}}" alt="network"> <span>Mes amis</span></a></li>
            <li><a href="#"><img src="{{asset('assets/images/jobs.png')}}" alt="jobs"> <span>Actualité</span></a></li>
            <li><a href="#"><img src="{{asset('assets/images/message.png')}}" alt="message"> <span>Messages</span></a></li>
            <li><a href="#"><img src="{{asset('assets/images/notification.png')}}" alt="notification"> <span>Notifications</span></a></li>
        </ul>
       </div>
       <div class="navbar-right">
        <div class="online">
            @php
                $avatar = Storage::url(session('user')['photo']);
            @endphp
        <img src="{{$avatar}}" class="nav-profile-img" onclick="toggleMenu()">
        </div>
       </div>
       <!----Dropdown menu-->
       <div class="profile-menu-wrap" id="profileMenu">
        <div class="profile-menu">
            <div class="user-info">
                <img src="{{$avatar}}">
                <div>
                    <h3>{{session('user')['name']}}</h3>
                    <a href="#">Voir votre profil</a>
                </div>
            </div>
            <hr>
            <a href="#" class="profile-menu-link">
                <img src="{{asset('assets/images/feedback.png')}}">
                <p>Give Feedback</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="{{asset('assets/images/setting.png')}}">
                <p>Paramètres</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="{{asset('assets/images/help.png')}}">
                <p>Aide et support</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="{{asset('assets/images/display.png')}}">
                <p>Display & Accessibility</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link" id="logout-link">
                <img src="{{asset('assets/images/logout.png')}}">
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


    <div class="container">
        <div class="left-sidebar">
            <div class="sidebar-profile-box">
                <img src="{{asset('assets/images/cover-pic.png')}}" width="100%">
                <div class="sidebar-profile-info">
                    <img src="{{$avatar}}">
                    <h1>{{session('user')['name']}}</h1>
                    <h3>{{session('user')['grade']}}</h3>
                    <ul>
                        <li>Profils vus <span>24</span></li>
                        <li>Posts vus <span>128</span></li>
                        <li>Nombre de connections<span>108</span></li>
                    </ul>
                </div>
                <div class="sidebar-profile-link">
                    <a href="#"><img src="{{asset('assets/images/items.png')}}">Mes publications</a>
                    <a href="#"><img src="{{asset('assets/images/premium.png')}}">Versions premium</a>
                </div>
            </div>

            <div class="sidebar-activity" id="sidebarActivity">
                <h3>RECENT</h3>
                <a href="#"><img src="{{asset('assets/images/recent.png')}}">Data Analysis</a>
                <h3>GROUPS</h3>
                <a href="#"><img src="{{asset('assets/images/group.png')}}">Data Analyst group</a>
                <h3>HASHTAG</h3>
                <a href="#"><img src="{{asset('assets/images/hashtag.png')}}">dataanalyst</a>
                <div class="discover-more-link">
                    <a href="#">Discover More</a>
                </div>
                </div>
                <p id="showMoreLink" onclick="toggleActivity()">Show more <b>+</b></p>

        </div>
        <div class="main-content">
            @yield('main')
        </div>
        <div class="right-sidebar">
            <div class="sidebar-news">
            <img src="{{asset('assets/images/more.png')}}" class="info-icon">
            <h3>Formations à venir</h3>
            <a href="#">Inflation in Canada Affects the Workforce</a>
            <span>2d ago &middot; 7,043 readers</span>
            <a href="#" class="read-more-link">Read More</a>
        </div>

            <div class="sidebar-ad">
                <small>Ad &middot; &middot; &middot;</small>
                <p>Master Web Development</p>
                 <div>
                    <img src="{{asset('assets/images/user-1.png')}}">
                    <img src="{{asset('assets/images/mi-logo.png')}}">

                 </div>
                 <b>Brand and Demand in Xiaomi</b>
                 <a href="#" class="ad-link">Learn More</a>
            </div>


            <div class="sidebar-useful-links">
                <a href="#">About</a>
                <a href="#">Accessibility</a>
                <a href="#">Help Center</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Advertising</a>
                <a href="#">Get the App</a>
                <a href="#">More</a>


                <div class="copyright-msg">
                    <img src="{{asset('assets/images/logo.png')}}">
                    <p>Linkedin &#169; 2022. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>

<script>
 // Get the modal
var modal = document.getElementById("logoutModal");

// Get the button that opens the modal
var btn = document.getElementById("logout-link");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the cancel button
var cancelBtn = document.getElementById("cancel-logout");

// Get the confirm button
var confirmBtn = document.getElementById("confirm-logout");

// When the user clicks on the button, open the modal
btn.onclick = function(event) {
    event.preventDefault();
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks on cancel button, close the modal
cancelBtn.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks on confirm button, log out (example: redirect to logout URL)
confirmBtn.onclick = function() {
    // Replace with your logout URL
    window.location.href = "/logout";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

    let profileMenu = document.getElementById("profileMenu");

    function toggleMenu(){
        profileMenu.classList.toggle("open-menu");
    }

    let sideActivity = document.getElementById("sidebarActivity");
    let moreLink = document.getElementById("showMoreLink");

    function toggleActivity(){
        sideActivity.classList.toggle("open-activity");
        if (sideActivity.classList.contains("open-activity")) {
            moreLink.innerHTML="Show less <b>-</b>";

        }
        else{
            moreLink.innerHTML="Show More <b>+</b>";
        }
    }

</script>
    @yield('script')
</body>
</html>
