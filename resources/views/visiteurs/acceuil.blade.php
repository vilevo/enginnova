@extends('inc.index_template')

@section('titre')
	Enginnova Learning Program - acceuil
@endsection

@section('layout_main_content')

	 <!-- Start Slider -->
  <section id="mu-slider">
    @if(!empty($slides))
      @foreach($slides->all() as $slide)
        <!-- Start single slider item -->
        <div class="mu-slider-single">
          <div class="mu-slider-img">
            <figure>
              <img src="https://enginnova.s3-us-west-2.amazonaws.com/elpfiles/<?php echo $slide->image; ?>"  alt="img">
            </figure>
          </div>
          <div class="mu-slider-content">
            <h4>{{ $slide->titre_1 }}</h4>
            <span></span>
            <h2>{{ $slide->titre_2 }}</h2>
            <p>{{ $slide->contenu }}</p>
            <a href="{{ route('register') }}" class="mu-read-more-btn">S'inscrire</a>
          </div>
        </div>
      @endforeach
    @endif
  </section>
  <!-- End Slider -->
  <!-- Start service  -->
  <section id="mu-service">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-service-area">
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-money"></span>
              <h3><a href="{{url('freelance')}}" style="color: white;">Gagnez de l'Argent</a></h3>
              <p>Participez aux projets freelance ou mettez en ligne vos propres projets.</p>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-users"></span>
              <h3><a href="{{ url('enginnova-community') }}" style="color: white;">La Communauté</a></h3>
              <p>Elargissez et partagez vos connaissances avec nous.</p>
            </div>
            <!-- Start single service -->
            <!-- Start single service -->
            <div class="mu-service-single">
              <span class="fa fa-book"></span>
              <h3><a href="{{url('learn-to-code-from-scratch')}}" style="color: white;">Best Formations</a></h3>
              <p>Bénéficiez des meilleurs formations dans le numérique.</p>
            </div>
            <!-- Start single service -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End service  -->

  <!-- Start about us -->
  <section id="mu-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-about-us-area">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-left">
                  <!-- Start Title -->
                  <div class="mu-title">
                    <h2>A Propos</h2>
                  </div>
                  <!-- End Title -->
                  <p>Enginnova Community est un réseau de jeune entrepreneurs togolais dont l'objectif est d'accoitre le developpement numérique du togo à partir de formations, réseautage et des projets freelance</p>
                  <ul>
                    <li> Permettre aux plus grands nombre de talents de se former et de se perfectionner.</li>
                    <li> Préparer le cadre transitoire dynamique aux entreprises surtout œuvrant dans les secteurs du numérique à mieux embrasser les nouvelles technologies d’actualité ou du futur afin de mieux se positionner sur le marché.</li>
                    <li> Offrir des opportunités d’innovations aux entreprises en formant leurs personnels aux technologies de pointe : Intelligence Artificielle, l’IOT, Réalité Virtuelle et Augmentée ,qui sont des outils moteurs de croissance et d’innovation pour les entreprises et startups.</li>
                    <li>Offrir un apprentissage concret aux techniques récentes.</li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="mu-about-us-right">
                <a id="mu-abtus-video" href="https://www.youtube.com/embed/BurO7YRxDhk" target="mutube-video">
                  <img src='{{asset("elp_files/assets/img/degrad.png")}}' alt="img">
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us -->

  <!-- Start about us counter -->
  <section id="mu-abtus-counter">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-abtus-counter-area">
            <div class="row">
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-book"></span>
                  <h4 class="counter">{{$questions}}</h4>
                  <p><a href="{{ url('enginnova-community') }}" style="color: white;">Questions</a></p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-users"></span>
                  <h4 class="counter">{{$users}}</h4>
                  <p><a href="{{ url('enginnova-users') }}" style="color: white;">Utilisateurs</a></p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single">
                  <span class="fa fa-sticky-note"></span>
                  <h4 class="counter">{{$projets_freelances}}</h4>
                  <p><a href="{{ url('freelance') }}" style="color: white;">Projets</a></p>
                </div>
              </div>
              <!-- End counter item -->
              <!-- Start counter item -->
              <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="mu-abtus-counter-single no-border">
                  <span class="fa fa-user-secret"></span>
                  <h4 class="counter">{{$mentors}}</h4>
                  <p><a href="{{ url('enginnova-mentors') }}" style="color: white;">Mentors</a></p>
                </div>
              </div>
              <!-- End counter item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about us counter -->

  <!-- Start features section -->
  <section id="mu-features">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-features-area">
            <!-- Start Title -->
            <div class="mu-title">
              <h2>NOS PRESTATIONS</h2>
              <p>Voici une liste détaillée de nos prestations.</p>
            </div>
            <!-- End Title -->
            <!-- Start features content -->
            <div class="mu-features-content">
              <div class="row">
                <div class="col-lg-4 col-md-4  col-sm-6">
                  <div class="mu-single-feature">
                    <span class="fa fa-users"></span>
                    <h4>Environnement</h4>
                    <p>Vivre l’expérience start-up! l’environnement de Enginnova offrent des opportunités de rencontres et d’échanges qui permettent d’élargir son réseau et de stimuler la créativité.</p>
                    <a href="#">Read More</a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="mu-single-feature">
                    <span class="fa fa-users"></span>
                    <h4>Prof expérimantés</h4>
                    <p>Formation assurée par des développeurs et consultants experts dans leurs domaines, offrant un apprentissage concret aux techniques récentes.</p>
                    <a href="#">Read More</a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="mu-single-feature">
                    <span class="fa fa-history"></span>
                    <h4>La formation</h4>
                    <p>Les formations ont une duré de 80 heures (21 jours). Les 3 dernières semaines de formation sont allouées à la réalisation d’un projet réel pour booster l'apprentissage.</p>
                    <a href="#">Read More</a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="mu-single-feature">
                    <span class="fa fa-laptop"></span>
                    <h4>Projets freelance</h4>
                    <p>Il est possible de mettre en ligne vos projets enfin de trouvez une main d'oeuvre compétente de bonne qualité sur notre plateforme pour les réalisés.</p>
                    <a href="#">Read More</a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="mu-single-feature">
                    <span class="fa fa-laptop"></span>
                    <h4>Projets benevolats</h4>
                    <p>Vous avez la possiblité de mettre en ligne des projets benevolats au cas vous n'auriez pas les ressources neccessaires pour débuter votre projet.</p>
                    <a href="#">Read More</a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                  <div class="mu-single-feature">
                    <span class="fa fa-users"></span>
                    <h4>Enginnova community</h4>
                    <p>Vous avez une inquiétude? peu importe le domaine, publiez votre question sur la plateforme et vous aurez des réponses satisfaisantes.</p>
                    <a href="#">Read More</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- End features content -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End features section -->

  <!-- Start latest course section -->
  <section id="mu-latest-courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-latest-courses-area">
            <!-- Start Title -->
            <div class="mu-title">
              <h2>Nos Activités</h2>
              <p></p>
            </div>
            <!-- End Title -->
            <!-- Start latest course content -->
            <div id="mu-latest-course-slide" class="mu-latest-courses-content">
              @if(!empty($activites))
                @foreach($activites->all() as $activite)
                  <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="mu-latest-course-single">
                      <figure class="mu-latest-course-img">
                        <a href="#"><img src="https://enginnova.s3-us-west-2.amazonaws.com/<?php echo $activite->photo; ?>" alt="img"></a>
                        <figcaption class="mu-latest-course-imgcaption">
                          <a href="#">#Enginnova</a>
                          <span><i class="fa fa-calendar"></i> {{date('d F',strtotime($activite->created_at))}}</span>
                        </figcaption>
                      </figure>
                      <div class="mu-latest-course-single-content">
                        <h4><a href="#">{{$activite->titre}}</a></h4>
                        <p><?php echo substr($activite->contenu, 0,200); ?>...</p>
                        <div class="mu-latest-course-single-contbottom">
                          <!-- <a class="mu-course-details" href="#">Details</a> -->
                          <a href='{{ url("lire-activite/{$activite->id}") }}'><span class="mu-course-price">Lire <i class="fa fa-eye"></i></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
            <!-- End latest course content -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End latest course section -->

  <!-- Start our teacher -->
  <section id="mu-our-teacher">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-our-teacher-area">
            <!-- begain title -->
            <div class="mu-title">
              <h2>L'équipe</h2>
              <p>Burreau Executif</p>
            </div>
            <!-- end title -->
            <!-- begain our teacher content -->
            <div class="mu-our-teacher-content">
              <div class="row">
                <div class="col-lg-3 col-md-3  col-sm-6">
                  <div class="mu-our-teacher-single">
                    <figure class="mu-our-teacher-img">
                      <img src='{{asset("elp_files/assets/img/teachers/teacher-01.png")}}' alt="teacher img">
                      <div class="mu-our-teacher-social">
                        <a href="#"><span class="fa fa-facebook"></span></a>
                        <a href="#"><span class="fa fa-twitter"></span></a>
                        <a href="#"><span class="fa fa-linkedin"></span></a>
                        <a href="#"><span class="fa fa-google-plus"></span></a>
                      </div>
                    </figure>
                    <div class="mu-ourteacher-single-content">
                      <h4>Joel AGBOGLO</h4>
                      <span>CEO</span>
                      <p>Fondateur et Responsable du departement des IOT</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                  <div class="mu-our-teacher-single">
                    <figure class="mu-our-teacher-img">
                      <img src='{{asset("elp_files/assets/img/teachers/teacher-02.png")}}' alt="teacher img">
                      <div class="mu-our-teacher-social">
                        <a href="#"><span class="fa fa-facebook"></span></a>
                        <a href="#"><span class="fa fa-twitter"></span></a>
                        <a href="#"><span class="fa fa-linkedin"></span></a>
                        <a href="#"><span class="fa fa-google-plus"></span></a>
                      </div>
                    </figure>
                    <div class="mu-ourteacher-single-content">
                      <h4>Hilario HOUMEY</h4>
                      <span>CTO</span>
                      <p>Responsable du departement technologique</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                  <div class="mu-our-teacher-single">
                    <figure class="mu-our-teacher-img">
                      <img src='{{asset("elp_files/assets/img/teachers/teacher-03.png")}}' alt="teacher img">
                      <div class="mu-our-teacher-social">
                        <a href="#"><span class="fa fa-facebook"></span></a>
                        <a href="#"><span class="fa fa-twitter"></span></a>
                        <a href="#"><span class="fa fa-linkedin"></span></a>
                        <a href="#"><span class="fa fa-google-plus"></span></a>
                      </div>
                    </figure>
                    <div class="mu-ourteacher-single-content">
                      <h4>Israel AZAMETI</h4>
                      <span>COO</span>
                      <p>Responsable management et ressources humaines</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                  <div class="mu-our-teacher-single">
                    <figure class="mu-our-teacher-img">
                      <img src='{{asset("elp_files/assets/img/teachers/teacher-04.png")}}' alt="teacher img">
                      <div class="mu-our-teacher-social">
                        <a href="#"><span class="fa fa-facebook"></span></a>
                        <a href="#"><span class="fa fa-twitter"></span></a>
                        <a href="#"><span class="fa fa-linkedin"></span></a>
                        <a href="#"><span class="fa fa-google-plus"></span></a>
                      </div>
                    </figure>
                    <div class="mu-ourteacher-single-content">
                      <h4>Maia HOUMEY</h4>
                      <span>Secretaire general</span>
                      <p>Porte parole et responsable relationship</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End our teacher content -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End our teacher -->

  <!-- Start testimonial -->
  <section id="mu-testimonial">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="mu-testimonial-area">
            <div id="mu-testimonial-slide" class="mu-testimonial-content">
              <!-- start testimonial single item -->
              <div class="mu-testimonial-item">
                <div class="mu-testimonial-quote">
                  <blockquote>
                    <p>grace à la formation de enginnova, j'ai pu developper mon aplication mobile en 3 jours.</p>
                  </blockquote>
                </div>
                <div class="mu-testimonial-img">
                  <img src="{{asset("elp_files/assets/img/testimonial-1.png")}}" alt="img">
                </div>
                <div class="mu-testimonial-info">
                  <h4>john doe</h4>
                  <span>Etudiant entrepreneur</span>
                </div>
              </div>
              <!-- end testimonial single item -->
              <!-- start testimonial single item -->
              <div class="mu-testimonial-item">
                <div class="mu-testimonial-quote">
                  <blockquote>
                    <p>grace à enginnova j'ai pu lancer mon projet et reçu un finacement.</p>
                  </blockquote>
                </div>
                <div class="mu-testimonial-img">
                  <img src="{{asset("elp_files/assets/img/testimonial-3.png")}}" alt="img">
                </div>
                <div class="mu-testimonial-info">
                  <h4>Rebaca Michel</h4>
                  <span>Entrepreneur</span>
                </div>
              </div>
              <!-- end testimonial single item -->
              <!-- start testimonial single item -->
              <div class="mu-testimonial-item">
                <div class="mu-testimonial-quote">
                  <blockquote>
                    <p>grace à la formation de enginnova, je sais faire une modélisation 3D.</p>
                  </blockquote>
                </div>
                <div class="mu-testimonial-img">
                  <img src="{{asset("elp_files/assets/img/testimonial-2.png")}}" alt="img">
                </div>
                <div class="mu-testimonial-info">
                  <h4>Stev Smith</h4>
                  <span>Etudiant</span>
                </div>
              </div>
              <!-- end testimonial single item -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End testimonial -->
<section id="mu-from-blog"></section>
@endsection

@section('footer')

@endsection
