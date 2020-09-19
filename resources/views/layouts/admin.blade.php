<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>@yield('titre')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href='{{asset("elp_files/assets/img/enginnova.ico")}}' type="image/x-icon"  />

    <!-- Font awesome -->
    <link href='{{asset("elp_files/assets/css/font-awesome.css")}}' rel="stylesheet" >
    <!-- Bootstrap -->
    <link href='{{asset("elp_files/assets/css/bootstrap.css")}}' rel="stylesheet">
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href='{{asset("elp_files/assets/css/slick.css")}}'>
    <!-- Fancybox slider -->
    <link rel="stylesheet" href='{{asset("elp_files/assets/css/jquery.fancybox.css")}}' type="text/css" media="screen" />
    <!-- Theme color -->
    <link id="switcher" href='{{asset("elp_files/assets/css/theme-color/default-theme.css")}}' rel="stylesheet">

    <!-- Main style sheet -->
    <link href='{{asset("elp_files/assets/css/style.css")}}' rel="stylesheet">
    <link href='{{asset("elp_files/assets/css/ec_style.css")}}' rel="stylesheet">
    <!-- FullCalendar -->
    <link href='{{asset("fullcalendar/fullcalendar.min.css")}}' rel="stylesheet">
   
    <!-- Google Fonts -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'> -->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('header_')
  </head>
  <body> 

  <!--START SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#">
      <i class="fa fa-angle-up"></i>      
    </a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header  -->
  <header id="mu-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-header-area">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="mu-header-top-left">
                  <div class="mu-top-email">
                    <i class="fa fa-envelope"></i>
                    <span>contact@enginnova.org</span>
                  </div>
                  <div class="mu-top-phone">
                    <i class="fa fa-phone"></i>
                    <span>(568) 986 652</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="mu-header-top-right">
                  <nav>
                    <ul class="mu-top-social-nav">
                      <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                      <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                      <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                      <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                      <li><a href="#"><span class="fa fa-youtube"></span></a></li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End header  -->
  <!-- Start menu -->
  <section id="mu-menu">
    <nav class="navbar navbar-default" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->              
          <!-- TEXT BASED LOGO -->
          <a class="navbar-brand"href="#"><!-- <img src="{{asset("template_files/varsity/assets/img/logo2.png")}}"> --><span>ELP</span></a>
          <!-- IMG BASED LOGO  -->
          <!-- <a class="navbar-brand"href=""><img src="{{asset("template_files/varsity/assets/img/logo2.png")}}"><span></span></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
            <li class="active"><a href="{{ url('admin/administrateur') }}">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestion <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('admin/slider-acceuil') }}">Slider acceuil</a></li>
                <li><a href="{{ url('admin/new-activite') }}">Activités acceuil</a></li>
                <li><a href="{{ url('admin/trucs-astuces') }}">Trucs et astuces</a></li>
                <li><a href="{{ url('admin/gestion-mentor') }}">Gestion mentors</a></li>
                <li><a href="{{ url('admin/api/users') }}">API Tokens</a></li>
              </ul>
            </li>           
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilisateurs <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('admin/traite-users') }}">Traité users</a></li>               
              </ul>
            </li>
            <li><a href="#" id="mu-search-icon"><i class="fa fa-search"></i></a></li>
            <!-- Authentication Links -->
            @guest
              <li><a href="{{ route('login') }}">Se connecter</a></li>
              <li><a href="{{ route('register') }}">S'inscrire</a></li>
            @else            
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu">
                    <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
              </li>
            @endguest
          </ul>                     
        </div><!--/.nav-collapse -->        
      </div>     
    </nav>
  </section>
  <!-- End menu -->
  <!-- Start search box -->
  <div id="mu-search">
    <div class="mu-search-area">      
      <button class="mu-search-close"><span class="fa fa-close"></span></button>
      <div class="container">
        <div class="row">
          <div class="col-md-12">            
            <form class="mu-search-form">
              <input type="search" placeholder="Type Your Keyword(s) & Hit Enter">              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End search box -->

  <!-- je commence la copie a partir dici-->
  <section id="mu-course-content">
    @yield('layout_main_content')
  </section>
      
<!-- et fini ici-->
  <!-- Start footer -->
  <footer id="mu-footer">
    <!-- start footer top -->
    <div class="mu-footer-top">
      <div class="container">
        <div class="mu-footer-top-area">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="mu-footer-widget">
                <h4>Information</h4>
                <ul>
                  <li><a href="#">About Us</a></li>
                  <li><a href="">Features</a></li>
                  <li><a href="">Course</a></li>
                  <li><a href="">Event</a></li>
                  <li><a href="">Sitemap</a></li>
                  <li><a href="">Term Of Use</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="mu-footer-widget">
                <h4>Student Help</h4>
                <ul>
                  <li><a href="">Get Started</a></li>
                  <li><a href="#">My Questions</a></li>
                  <li><a href="">Download Files</a></li>
                  <li><a href="">Latest Course</a></li>
                  <li><a href="">Academic News</a></li>                  
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="mu-footer-widget">
                <h4>News letter</h4>
                <p>Get latest update, news & academic offers</p>
                <form class="mu-subscribe-form">
                  <input type="email" placeholder="Type your Email">
                  <button class="mu-subscribe-btn" type="submit">Subscribe!</button>
                </form>               
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="mu-footer-widget">
                <h4>Contact</h4>
                <address>
                  <p>P.O. Box 320, Ross, California 9495, USA</p>
                  <p>Phone: (415) 453-1568 </p>
                  <p>Website: www.enginnova.org</p>
                  <p>Email: contact@enginnova.org</p>
                </address>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end footer top -->
    <!-- start footer bottom -->
    <div class="mu-footer-bottom">
      <div class="container">
        <div class="mu-footer-bottom-area">
          <p>&copy; All Right Reserved. Designed by <a href="http://www.markups.io/" rel="nofollow">MarkUps.io</a></p>
        </div>
      </div>
    </div>
    <!-- end footer bottom -->
  </footer>
  <!-- End footer -->
  @stack('modals')
  <!-- jQuery library -->
  <script src='{{asset("elp_files/assets/js/jquery.min.js")}}'></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src='{{asset("elp_files/assets/js/bootstrap.js")}}'></script>
  <script src='{{asset("elp_files/assets/js/jquery-ui.min")}}'></script>
  <!-- Slick slider -->
  <script type="text/javascript" src='{{asset("elp_files/assets/js/slick.js")}}'></script>
  <!-- Counter -->
  <script type="text/javascript" src='{{asset("elp_files/assets/js/waypoints.js")}}'></script>
  <script type="text/javascript" src='{{asset("elp_files/assets/js/jquery.counterup.js")}}'></script>
  <!-- Mixit slider -->
  <script type="text/javascript" src='{{asset("elp_files/assets/js/jquery.mixitup.js")}}'></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src='{{asset("elp_files/assets/js/jquery.fancybox.pack.js")}}'></script>
  <!-- Custom js -->
  <script src='{{asset("elp_files/assets/js/custom.js")}}'></script>
  <!-- CK Editor -->
  <script src='{{asset("ckeditor/ckeditor.js")}}'></script>
  <!-- fullcalendar -->
  <script src='{{asset("fullcalendar/moment.js")}}'></script>
  <script src='{{asset("fullcalendar/fullcalendar.min.js")}}'></script>
  <script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1')
    });
    $(document).on('click', '#select_mentor', function(){
      var id = $(this).data("id");
      if (id != '') {
                var url = "http://enginnova.herokuapp.com/fetch-mentor/"+id;
                $.get(url, function(data){
                    $('#mentor_avt').empty();
                    $('#mentorModal').modal('show');
                    $('#mentor_avt').append('<img class="img-thumbnail img-responsive" height="150" width="150" src="http://enginnova.herokuapp.com/avatars/'+data.avatar+'">');
                    $('#nom').html(data.nom);
                    $('#profession').html(data.profession);
                    $('#mentor_desc').html(data.about);
                });
              }
    });

    $(document).ready(function(){
      $('#search_user').keyup(function(){
              var query = $(this).val();
              if (query != '') {
                  var _token = $('input[name="_token"]').val();
                  $.ajax({
                    url:"http://enginnova.herokuapp.com/admin/fetch-user",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                      $('#users_list').fadeIn();
                      $('#users_list').html(data);
                    }
                  });
              }
          });
    });
  </script>
  @yield('footer')
  @yield('formulaire')
  
  </body>
</html>
