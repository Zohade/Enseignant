<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linkedin</title>
    <link rel="stylesheet" href="{{asset('assets/css/style_dash.css')}}">
</head>
<body>

    <nav class="navbar">
       <div class="navbar-left">
        <a href="index.html" class="logo"><img src="{{asset('assets/images/logo.png')}}" alt="logo"></a>
        <div class="search-box">
            <img src="{{asset('assets/images/search.png')}}" >
            <input type="text" placeholder="Search for anything">
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
        <img src="{{asset('assets/images/user-1.png')}}" class="nav-profile-img" onclick="toggleMenu()">
        </div>
       </div>
       <!----Dropdown menu-->
       <div class="profile-menu-wrap" id="profileMenu">
        <div class="profile-menu">
            <div class="user-info">
                <img src="{{asset('assets/images/user-1.png')}}">
                <div>
                    <h3>John Doe</h3>
                    <a href="#">See your profile</a>
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
                <p>Settings & Privacy</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="{{asset('assets/images/help.png')}}">
                <p>Help & Support</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="{{asset('assets/images/display.png')}}">
                <p>Display & Accessibility</p>
                <span>></span>
            </a>
            <a href="#" class="profile-menu-link">
                <img src="{{asset('assets/images/logout.png')}}">
                <p>Logout</p>
                <span>></span>
            </a>


        </div>
       </div>




    </nav>


    <div class="container">
        <div class="left-sidebar">
            <div class="sidebar-profile-box">
                <img src="{{asset('assets/images/cover-pic.png')}}" width="100%">
                <div class="sidebar-profile-info">
                    <img src="{{asset('assets/images/user-1.png')}}">
                    <h1>John Doe</h1>
                    <h3>Data Analyst at IBM</h3>
                    <ul>
                        <li>Your profile views <span>24</span></li>
                        <li>Your post views <span>128</span></li>
                        <li>Your Connections<span>108</span></li>
                    </ul>
                </div>
                <div class="sidebar-profile-link">
                    <a href="#"><img src="{{asset('assets/images/items.png')}}">My Items</a>
                    <a href="#"><img src="{{asset('assets/images/premium.png')}}">Try Premium</a>
                </div>
            </div>

            <div class="sidebar-activity" id="sidebarActivity">
                <h3>RECENT</h3>
                <a href="#"><img src="{{asset('assets/images/recent.png')}}">Data Analysis</a>
                <a href="#"><img src="{{asset('assets/images/recent.png')}}">UI UX Design</a>
                <a href="#"><img src="{{asset('assets/images/recent.png')}}">Web Development</a>
                <a href="#"><img src="{{asset('assets/images/recent.png')}}">Object Oriented Programming</a>
                <a href="#"><img src="{{asset('assets/images/recent.png')}}">Operating Systems</a>
                <a href="#"><img src="{{asset('assets/images/recent.png')}}">Platform technologies</a>
                <h3>GROUPS</h3>
                <a href="#"><img src="{{asset('assets/images/group.png')}}">Data Analyst group</a>
                <a href="#"><img src="{{asset('assets/images/group.png')}}">Learn NumPy</a>
                <a href="#"><img src="{{asset('assets/images/group.png')}}">Machine Learning group</a>
                <a href="#"><img src="{{asset('assets/images/group.png')}}">Data Science Aspirants</a>
                <h3>HASHTAG</h3>
                <a href="#"><img src="{{asset('assets/images/hashtag.png')}}">dataanalyst</a>
                <a href="#"><img src="{{asset('assets/images/hashtag.png')}}">numpy</a>
                <a href="#"><img src="{{asset('assets/images/hashtag.png')}}">machinelearning</a>
                <a href="#"><img src="{{asset('assets/images/hashtag.png')}}">datascience</a>
                <div class="discover-more-link">
                    <a href="#">Discover More</a>
                </div>
                </div>
                <p id="showMoreLink" onclick="toggleActivity()">Show more <b>+</b></p>

        </div>
        <div class="main-content">
            <div class="create-post">
                <div class="create-post-input">
                    <img src="{{asset('assets/images/user-1.png')}}">
                    <textarea rows="2" placeholder="Write Something"></textarea>
                </div>
                <div class="create-post-links">
                    <li><img src="{{asset('assets/images/photo.png')}}">Photo</li>
                    <li><img src="{{asset('assets/images/video.png')}}">Video</li>
                    <li><img src="{{asset('assets/images/event.png')}}">Event</li>
                    <li>Post</li>
                </div>
            </div>
            <div class="sort-by">
                <hr>
                <p>Sort by : <span>top <img src="{{asset('assets/images/down-arrow.png')}}" ></span> </p>

            </div>
            <div class="post">
                <div class="post-author">
                    <img src="{{asset('assets/images/user-3.png')}}">
                    <div>
                        <h1>Bejamin Leo</h1>
                        <small>Founder and CEO at Giva | Angel Investor</small>
                        <small>2 hours ago </small>
                    </div>
                </div>
                <p>The sucess of every website depends on Search engine optimisation
                    and digital marketing strategy. If you are not in the first page of all major search engines
                    then you are ahead among your competitors.
                </p>
                <img src="{{asset('assets/images/post-image-1.png')}}"width="100%">



                <div class="post-stats">
                    <div>
                        <img src="{{asset('assets/images/thumbsup.png')}}" >
                        <img src="{{asset('assets/images/love.png')}}">
                        <img src="{{asset('assets/images/clap.png')}}">
                        <span class="liked-users">Adam Doe and 89 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                </div>
                <div class="post-activity">
                    <div>
                        <img src="{{asset('assets/images/user-1.png')}}" class="post-activity-user-icon">
                        <img src="{{asset('assets/images/down-arrow.png')}}" class="post-activity-arrow-icon">

                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/like.png')}}">
                        <span>Like</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/comment.png')}}">
                        <span>Comment</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/share.png')}}">
                        <span>Share</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/send.png')}}">
                        <span>Send</span>
                    </div>
                </div>
            </div>



            <div class="post">
                <div class="post-author">
                    <img src="{{asset('assets/images/user-4.png')}}">
                    <div>
                        <h1>Claire Smith</h1>
                        <small>SDE at Swiggy | Solopreneur</small>
                        <small>2 hours ago </small>
                    </div>
                </div>
                <p>The sucess of every website depends on Search engine optimisation
                    and digital marketing strategy. If you are not in the first page of all major search engines
                    then you are ahead among your competitors.
                </p>
                <img src="{{asset('assets/images/post-image-2.png')}}"width="100%">



                <div class="post-stats">
                    <div>
                        <img src="{{asset('assets/images/thumbsup.png')}}" >
                        <img src="{{asset('assets/images/love.png')}}">
                        <img src="{{asset('assets/images/clap.png')}}">
                        <span class="liked-users">Adam Doe and 89 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                </div>
                <div class="post-activity">
                    <div>
                        <img src="{{asset('assets/images/user-1.png')}}" class="post-activity-user-icon">
                        <img src="{{asset('assets/images/down-arrow.png')}}" class="post-activity-arrow-icon">

                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/like.png')}}">
                        <span>Like</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/comment.png')}}">
                        <span>Comment</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/share.png')}}">
                        <span>Share</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/send.png')}}">
                        <span>Send</span>
                    </div>
                </div>
            </div>


            <div class="post">
                <div class="post-author">
                    <img src="{{asset('assets/images/user-3.png')}}">
                    <div>
                        <h1>Bejamin Leo</h1>
                        <small>Founder and CEO at Giva | Angel Investor</small>
                        <small>2 hours ago </small>
                    </div>
                </div>
                <p>The sucess of every website depends on Search engine optimisation
                    and digital marketing strategy. If you are not in the first page of all major search engines
                    then you are ahead among your competitors.
                </p>
                <img src="{{asset('assets/images/post-image-3.png')}}"width="100%">



                <div class="post-stats">
                    <div>
                        <img src="{{asset('assets/images/thumbsup.png')}}" >
                        <img src="{{asset('assets/images/love.png')}}">
                        <img src="{{asset('assets/images/clap.png')}}">
                        <span class="liked-users">Adam Doe and 89 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                </div>
                <div class="post-activity">
                    <div>
                        <img src="{{asset('assets/images/user-1.png')}}" class="post-activity-user-icon">
                        <img src="{{asset('assets/images/down-arrow.png')}}" class="post-activity-arrow-icon">

                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/like.png')}}">
                        <span>Like</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/comment.png')}}">
                        <span>Comment</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/share.png')}}">
                        <span>Share</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/send.png')}}">
                        <span>Send</span>
                    </div>
                </div>
            </div>


            <div class="post">
                <div class="post-author">
                    <img src="{{asset('assets/images/user-3.png')}}">
                    <div>
                        <h1>Bejamin Leo</h1>
                        <small>Founder and CEO at Giva | Angel Investor</small>
                        <small>2 hours ago </small>
                    </div>
                </div>
                <p>The sucess of every website depends on Search engine optimisation
                    and digital marketing strategy. If you are not in the first page of all major search engines
                    then you are ahead among your competitors.
                </p>
                <img src="{{asset('assets/images/post-image-4.png')}}"width="100%">



                <div class="post-stats">
                    <div>
                        <img src="{{asset('assets/images/thumbsup.png')}}" >
                        <img src="{{asset('assets/images/love.png')}}">
                        <img src="{{asset('assets/images/clap.png')}}">
                        <span class="liked-users">Adam Doe and 89 others</span>
                    </div>
                    <div>
                        <span>22 comments &middot; 40 shares</span>
                    </div>
                </div>
                <div class="post-activity">
                    <div>
                        <img src="{{asset('assets/images/user-1.png')}}" class="post-activity-user-icon">
                        <img src="{{asset('assets/images/down-arrow.png')}}" class="post-activity-arrow-icon">

                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/like.png')}}">
                        <span>Like</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/comment.png')}}">
                        <span>Comment</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/share.png')}}">
                        <span>Share</span>
                    </div>
                    <div class="post-activity-link">
                        <img src="{{asset('assets/images/send.png')}}">
                        <span>Send</span>
                    </div>
                </div>
            </div>

        </div>
        <div class="right-sidebar">
            <div class="sidebar-news">
            <img src="{{asset('assets/images/more.png')}}" class="info-icon">
            <h3>Trending News</h3>

            <a href="#">High Demand for Skilled Employees</a>
            <span>1d ago &middot; 10,934 readers</span>


            <a href="#">Inflation in Canada Affects the Workforce</a>
            <span>2d ago &middot; 7,043 readers</span>


            <a href="#">Mass Recruiters fire Employees</a>
            <span>4d ago &middot; 17,789 readers</span>


            <a href="#">Crypto predicted to Boom this year</a>
            <span>9d ago &middot; 2, 436 readers</span>

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
</body>
</html>
