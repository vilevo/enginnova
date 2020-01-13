<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Enginnova Learning Program, ELP, apprendre à programmé, togo start up, communauté de developpeur, enginnova, gagner de l'argent en ligne">
    <meta name="description" content="Enginnova Community est un réseau de jeune entrepreneurs togolais dont l'objectif est d'accoitre le developpement numérique du togo à partir des formations, réseautages et des projets freelance.">    
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

   
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  @yield('meta')
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
                    <span>+228 92991111</span>
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
            <li class="active"><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book"></i> Formations<span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('learn-to-code-from-scratch') }}">Learn 2 code from scratch</a></li>
                <li><a href="{{ url('Learning-program-pro') }}">Learning program pro</a></li>
              </ul>
            </li>           
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Enginnova Community <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('enginnova-community') }}">Enginnova Learning</a></li>                
                <li><a href="{{ url('freelance') }}">Freelance</a></li>                
              </ul>
            </li>
            <li><a href="{{ route('login') }}"><span class="label label-primary"><i class="fa fa-sign-in"></i> Connexion</span></a></li>
            <!-- <li><a href="{{ route('register') }}">S'inscrire</a></li> -->            
            <li><a href="{{ url('contact') }}"><i class="fa fa-phone"></i> Contact</a></li>
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
  @yield('header')
  <!-- End search box -->
  <!-- je commence la copie a partir dici-->
  
    @yield('layout_main_content')
  
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
                <h4>Informations</h4>
                <ul>
                  <li><a href="{{url('a-propos')}}">A propos</a></li>
                  <li><a href="{{url('learn-to-code-from-scratch')}}">Formations</a></li>
                  <li><a href="{{url('conditions-generales')}}">Conditions Générales d'utilisations</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="mu-footer-widget">
                <h4>Enginnova community</h4>
                <ul>
                  <li><a href="{{ route('login') }}">Débutez</a></li>
                  <li><a href="#">Aide</a></li>                  
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="mu-footer-widget">
                <h4>News letter</h4>
                <p>Découvrez nos dernières mise à jour, actualités & offres de formation</p>
                <form class="mu-subscribe-form">
                  <input type="email" placeholder="Type your Email">
                  <button class="mu-subscribe-btn" type="submit">s'abonner!</button>
                </form>               
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
              <div class="mu-footer-widget">
                <h4>Contact</h4>
                <address>
                  <p>Lomé, TOGO</p>
                  <p>Phone: +228 92991111 </p>
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
    <div class="mu-footer-bottom" style="background-color: #337AB7;">
      <div class="container">
        <div class="mu-footer-bottom-area">
          <p>&copy; All Right Reserved. Designed by <a href="http://www.markups.io/" rel="nofollow">Enginnova</a></p>
        </div>
      </div>
    </div>
    <!-- end footer bottom -->
  </footer>
  <!-- End footer -->
  
  <!-- jQuery library -->
  <script src='{{asset("elp_files/assets/js/jquery.min.js")}}'></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src='{{asset("elp_files/assets/js/bootstrap.js")}}'></script>
  <!-- Slick slider -->
  <script type="text/javascript" src='{{asset("elp_files/assets/js/slick.js")}}'></script>
  <!-- Counter -->
  <script type="text/javascript" src='{{asset("elp_files/assets/js/waypoints.js")}}'></script>
  <script type="text/javascript" src='{{asset("elp_files/assets/js/jquery.counterup.js")}}'></script>
  <!-- Mixit slider -->
  <script type="text/javascript" src='{{asset("elp_files/assets/js/jquery.mixitup.js")}}'></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src='{{asset("elp_files/assets/js/jquery.fancybox.pack.js")}}'></script>
  <!-- CK Editor -->
  <script src='{{asset("ckeditor/ckeditor.js")}}'></script>
  <!-- Custom js -->
  <script src='{{asset("elp_files/assets/js/custom.js")}}'></script>
  <!-- Social Share -->
  <script src='{{asset("elp_files/assets/js/socialShare.js")}}'></script>

  <script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1')
    });

    $(document).ready(function(){
      $('#questions_titre').keyup(function(){
              var query = $(this).val();
              if (query != '') {
                  var _token = $('input[name="_token"]').val();
                  $.ajax({
                    url:"http://localhost/ec/public/fetchQuestions",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                      $('#questions_list').fadeIn();
                      $('#questions_list').html(data);
                    }
                  });
              }
          });
    });

    $(document).ready(function(){
      $('#enguser_name').keyup(function(){
              var query = $(this).val();
              if (query != '') {
                  var _token = $('input[name="_token"]').val();
                  $.ajax({
                    url:"http://localhost/ec/public/fetchUser",
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

    $(document).ready(function(){
      $('#booster').click(function(){
        $('#boosterModal').modal('show');
      });
    });
  </script>
  @yield('footer')
  </body>
</html>
@yield('formulaire')