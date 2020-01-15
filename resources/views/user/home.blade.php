@extends('layouts.app')

@section('titre')
  {{ Auth::user()->name }}
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Enginnova</h2>
    <ol class="breadcrumb pull-right">           
        <li class="active" style="color: gold;"><i class="fa fa-home"></i> Home</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
	<div class="container">
    <div class="row">
        <div class="col-md-9">
          <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #ffffff;">
                        <h3>Tableau de bord</h3>
                          @if (session('info'))
                            <h5>
                            <div class="alert alert-success">
                              {{ session('info') }}
                            </div></h5>
                          @endif
                          @if (session('info_error'))
                            <h5>
                            <div class="alert alert-danger">
                              {{ session('info_error') }}
                            </div></h5>
                          @endif
                          @if (session('status'))
                              <div class="alert alert-success">
                                  {{ session('status') }}
                              </div>
                          @endif
                        <a href="{{ url('user/add-post') }}" class="pull-right"><h5 class="btn btn-primary"><i class="fa fa-plus"></i> Poser une question</h5></a><br>
                          <div class="forq" style="margin-top: 50px;">
                          <form action="#" method="POST" class="sidebar-form">
                            {{csrf_field()}}
                            <div class="input-group">
                              <input type="text" name="questions_titre" id="questions_titre" class="form-control" placeholder="Rechercher une question" style="width: 350px;">
                            </div>
                          </form>
                          </div>
                          <div id="questions_list"></div>
                      </div>
                      <div class="panel-body">
                        <div class="notification">
                          <ul class="timeline timeline-inverse">
                          @if(!empty($notif_selections))
                            @foreach($notif_selections->all() as $notif_selection)
                              <li>
                              <i class="fa fa-bell-o bg-blue"></i>

                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i></span>
                                  <h3 class="timeline-header"><a href="#" style="color: #337AB7;">Enginnova</a> Demande acceptée</h3>

                                  <div class="timeline-body">
                                    Hello {{Auth::user()->name}} ! <br>
                                    Votre demande de candidature pour le projet <b>{{ substr($notif_selection->titre_projet, 0,40)}}</b>... a été accepté.
                                  </div>
                                  <div class="timeline-footer">
                                    <?php  
                                      $id_user=$notif_selection->id_user*1000; 
                                      $id_fprojet=$notif_selection->id_fprojet*1000;
                                    ?>
                                    <a href='{{ url("user/accepte-job/{$id_user}/{$id_fprojet}") }}' title="Liquez ici pour bosser sur le projet" class="btn btn-primary btn-xs"><b>J'accepte le job</b></a>
                                    <!-- <a class="btn btn-danger btn-xs">Delete</a> -->
                                  </div>
                                </div>
                              </li>
                            @endforeach
                          @endif
                          @if($notif_cv != false)
                            <li>
                            <i class="fa fa-bell-o bg-blue"></i>

                              <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i></span>
                                <h3 class="timeline-header"><a href="#" style="color: #337AB7;">Mise à jour du profil</a></h3>

                                <div class="timeline-body">
                                  Hello {{Auth::user()->name}} ! <br> 
                                  Bienvenu sur Enginnova Community. Pour postuler aux projets vous devez mettre en ligne votre CV et vos informations personnelles.
                                </div>
                                <div class="timeline-footer">
                                  <?php $id_user = $id_user*1000; ?>
                                  <a href='{{ url("user/profil/{$id_user}") }}' title="Mettre en ligne un CV" class="btn btn-primary btn-xs">Mettre à jour le profil</a>
                                  <!-- <a class="btn btn-danger btn-xs">Delete</a> -->
                                </div>
                              </div>
                            </li>
                          @endif
                          </ul>                  
                        </div>
                        <div class="col-xs-12 table-responsive">
                          @if(!empty($user_projets))
                          @if(count($errors) > 0)
                          @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                              {{$error}}  
                            </div>
                          @endforeach
                          @endif
                          <h4>Mes projets</h4>
                          <table class="table table-striped">
                            <thead>
                            <tr>
                              <th>Titre</th>
                              <th>Date</th>
                              <th>Réponses</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_projets->all() as $user_projet)
                              <?php $id = $user_projet->id_fprojet*1000; ?>
                              @if($user_projet->actif == 1)
                                @if($user_projet->etat == 0)
                                <tr>
                                  <td><a href='{{ url("user/freelance-projet/{$id}") }}'><h5 style="color: #337AB7;">{{ substr($user_projet->titre_projet ,0,40)}}...</h5></a>
                                    <small class="label label-info"><i class="fa fa-history"></i> En cours</small>
                                  </td>
                                  <td>{{date('d F Y',strtotime($user_projet->created_at))}}</td>
                                  <td>{{$user_projet->reponses}} personnes</td>
                                  <td><a href='{{ url("user/edit-projet/{$id}") }}' id="booster" class="label label-success" style="background-color: gray;"><i class="fa fa-gear"></i> Gérer</a> | <a href="#" id="booster" class="label label-danger"><i class="fa fa-remove"></i> Supprimer</a></td>
                                </tr>
                                @else
                                <tr>
                                  <td><a href='{{ url("user/freelance-projet/{$id}") }}'><h5 style="color: #337AB7;">{{ substr($user_projet->titre_projet ,0,40)}}...</h5></a>
                                    <small class="label label-success"><i class="fa fa-check-circle-o"></i> Terminé</small>
                                  </td>
                                  <td>{{date('d F Y',strtotime($user_projet->created_at))}}</td>
                                  <td>{{$user_projet->reponses}} personnes</td>
                                  <td> <a href='{{ url("user/freelance-projet/{$id}") }}' class="label label-primary"><i class="fa fa-eye"></i> Voir</a></td>
                                </tr>
                                @endif
                              @else
                                <tr>
                                  <td><a href='{{ url("user/freelance-projet/{$id}") }}'><h5 style="color: #337AB7;">{{ substr($user_projet->titre_projet ,0,40)}}...</h5></a>
                                  </td>
                                  <td>{{date('d F Y',strtotime($user_projet->created_at))}}</td>
                                  <td>{{$user_projet->reponses}} personnes</td>
                                  <td><h6 style="color: maroon;">Le projet est en cours de traitement afin d'etre activé. Cela pendra au plus 48h. Votre projet a dépassé 48h ? Envoyez nous un mail. </h6><a href="#" class="label label-danger"><i class="fa fa-send"></i> Signaler le probleme </a></td>
                                </tr>
                              @endif
                            @endforeach
                            </tbody>
                          </table>
                          @else
                            <div class="alert alert-warning">
                              <h4>Vous n'avez aucun projet en ligne.</h4>
                              <a href="{{ url('user/add-projet') }}"><h5 class="label label-info"><i class="fa fa-plus"></i> Publier un projet</h5></a>
                            </div>
                          @endif
                        </div>
                        @if(!empty($wp_projets))
                        <div class="col-xs-12 table-responsive">
                          <h4>Les projets sur lesquels vous bossez</h4>
                            <table class="table table-striped">
                            <thead>
                            <tr>
                              <th>Titre</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wp_projets->all() as $wp_projet)
                              <?php $id = $wp_projet->id_fprojet*1000; ?>
                              @if($wp_projet->etat == true)
                                <tr>
                                <td><a href='{{ url("user/freelance-projet/{$id}") }}'><h5 style="color: #337AB7;">{{ substr($wp_projet->titre_projet ,0,40)}}...</h5></a>
                                  <small class="label label-success"><i class="fa fa-check-circle-o"></i> Terminé</small>
                                </td>
                                <td>{{date('d F Y',strtotime($wp_projet->created_at))}}</td>
                                <td></td>
                              </tr>
                              @else
                                <tr>
                                <td><a href='{{ url("user/freelance-projet/{$id}") }}'><h5 style="color: #337AB7;">{{ substr($wp_projet->titre_projet ,0,40)}}...</h5></a>
                                  <small class="label label-info"><i class="fa fa-history"></i> En cours</small>
                                </td>
                                <td>{{date('d F Y',strtotime($wp_projet->created_at))}}</td>
                                <td><a href='{{ url("user/workspace/{$id}") }}' id="booster" class="label label-success" style="background-color: gray;"><i class="fa fa-gear"></i> Acceder au projet</a></td>
                              </tr>
                              @endif
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                        @else
                        
                        @endif
                      </div>
                    </div>
        </div>
        <div class="col-md-3">
            <!-- start sidebar -->
                <aside class="mu-sidebar">
                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar" style="background-color: #ffffff;">
                    <div class="box box-primary">
                      <div class="box-header">
                        <i class="fa fa-history"></i>

                        <h3 class="box-title">Actualités</h3>
                      </div>
                      <div class="box-body">
                        @if(!empty($best_projets))
                          @foreach($best_projets->all() as $best_projet)
                            <div class="media">
                                 <?php $id_fprojet=$best_projet->id_fprojet*1000; ?>
                                  <div class="media-body">
                                    <h4 class="media-heading"><a href='{{ url("user/freelance-projet/{$id_fprojet}") }}' style="color: #337AB7; font-weight: bold; font-size: 0.8em;"><span class="label label-warning">[Freelance]</span> {{$best_projet->titre_projet}}</a></h4>                      
                                    <h6 style="color: gray;"><em><b>{{$best_projet->prix}}</b></em></h6>
                                  </div>
                            </div>
                          @endforeach
                        @endif

                        @if(!empty($astuces))
                          @foreach($astuces->all() as $astuce)
                            <div class="media">
                              <div class="media-left">
                                <a href="#">
                                  <img class="media-object" src='{{asset("posts/{$astuce->photo}")}}' class="img-responsive" width="50" height="50" alt="image">
                                </a>
                              </div>
                              <div class="media-body">
                                <h4 class="media-heading"><a href='{{url("user/geeking/{$astuce->id}")}}' style="color: #337AB7;">{{$astuce->titre}}</a></h4>                      
                                  <span class="popular-course-price"></span>
                              </div>
                            </div>
                          @endforeach
                        @endif                        
                      </div>
                    </div>
                  </div>
                  
                  <!-- end single sidebar -->
                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar">
                    <div class="box box-primary">
                      <div class="box-header">
                        <i class="fa fa-sticky-note"></i>

                        <h3 class="box-title">Utilisateurs connectés</h3>
                      </div>
                      <div class="box-body">
                        <ul class="mu-sidebar-catg">
                          @if(Auth::check())
                            @foreach($users as $user)
                              @if($user->isOnline())
                                {{$user->name}} <br><hr>
                              @endif
                            @endforeach
                          @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!-- end single sidebar -->
                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar">
                    <div class="box box-primary">
                      <div class="box-header">
                        <i class="fa fa-sticky-note"></i>

                        <h3 class="box-title">Types Projets</h3>
                      </div>
                      <div class="box-body">
                        <ul class="mu-sidebar-catg">
                          @if(count($categories)>0)
                                    @foreach($categories->all() as $categorie)
                                      <?php $id = $categorie->id_categorie*1000; ?>
                                      <li><a href='{{ url("user/projets-categorie/{$id}") }}' style="color: #337AB7;"><span class="fa fa-angle-double-right"></span> {{$categorie->name}}</a></li>
                                    @endforeach
                           @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!-- end single sidebar -->
                </aside>
                <!-- / end sidebar -->
        </div>
     </div>
     <div class="row">
       <div class="col-md-9">
         <h6></h6>
       </div>
     </div> 
</div>
@endsection

@section('footer')

@endsection

