@extends('layouts.app')

@section('titre')
  Enginnova Freelance - projet
@endsection

@section('header')
@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Freelance</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('user/freelance') }}">Projets Freelance</a></li>            
        <li class="active" style="color: gold;">Projet</li>
    </ol>
</div>
@endsection

@section('layout_main_content')

	<!-- start course content container -->
                <div class="container">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #ffffff;">
                        <h3>Projet</h3>
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
                        @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                          <div class="alert alert-danger">
                            {{$error}}  
                          </div>
                        @endforeach
                        @endif
                        <?php $id = $freelance_projet->id_fprojet*1000; ?>
                        <a href="{{ url('user/add-projet') }}" class="pull-right"><h5 class="btn btn-primary"><i class="fa fa-plus"></i> Publier un projet</h5></a><br>
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
                        <div class="box box-widget">
                            <div class="box-header with-border">
                              <div class="user-block">
                                <?php $id_fprojet=$freelance_projet->id_fprojet*1000; ?>
                                <img class="img-circle" src='{{ asset("avatars/{$freelance_projet->avatar}") }}' width="50" height="50" alt="User profile picture" alt="User Image">
                                <span style="font-size: 16px; font-weight: 600;"><a href='{{ url("user/freelance-projet/{$id_fprojet}") }}'>{{$freelance_projet->titre_projet}}</a></span><br>
                                <span style="color: #999; font-size: 13px;">Posté le - {{date('d F Y',strtotime($freelance_projet->created_at))}}</span>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <!-- post text -->
                              <p><?php echo substr($freelance_projet->contenu, 0,145); ?>...</p>
                              <!-- Social sharing buttons -->
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-users"></i> <b>{{$freelance_projet->reponses}} Interessés</b></button>
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-money"></i> <b>{{$freelance_projet->prix}}</b></button>
                              <?php $id_user=$freelance_projet->id_user*1000; ?>
                              <span class="pull-right text-muted">Posté par <a href='{{ url("user/profil/{$id_user}") }}'>{{ $freelance_projet->name }}</a></span>

                              <div class="mu-blog-meta">
                                <br>
                                @if($freelance_projet->etat==0)
                                  <?php $id = $freelance_projet->id_fprojet*1000; ?>
                                  <a class="mu-post-btn" href='{{ url("user/postuler-au-Projet/{$id}") }}' style="color: maroon;"><i class="fa fa-long-arrow-right"></i> Postuler au projet</a>
                                @else
                                  <div class="alert alert-danger">
                                      <h4>Cet projet a déjà été réalisé!</h4>
                                  </div>
                                @endif
                              </div>
                            </div>
                          @if( $freelance_projet->id_user == Auth::user()->id )
                            @if($freelance_projet->etat==0)
                            <ul class="mu-news-single-tagnav">
                            <li>Options :</li>
                              <li><a class="" href='{{ url("user/edit-projet/{$id}") }}' style="color: maroon;"><span class="fa fa-gear" style="color: gray;"></span> <b>Gérer</b></a></li>
                              <li><a class="" href='{{ url("user/deleteProjet/{$id}") }}' style="color: maroon;"><span class="fa fa-remove" style="color: red;"></span> <b>Supprimer</b></a></li>                            
                            </ul>
                            @endif
                          @endif
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                          @if( $freelance_projet->id_user == Auth::user()->id )
                            <div class="alert alert-warning" >
                              <img src='{{asset("elp_files/assets/img/support.png")}}' alt="image" class="img-responsive">
                              <h4>Vous voulez mettre en avant votre projet pour avoir beaucoup de candidature? <a href='#' id="booster">Cliquez ici </a></h4>
                            </div>
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
                                        <h4 class="media-heading"><a href='{{ url("user/freelance-projet/{$id_fprojet}") }}' style="color: #337AB7; font-weight: bold; font-size: 0.8em;">{{$best_projet->titre_projet}}</a></h4>                      
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

                                <h3 class="box-title">Projets Similaires</h3>
                              </div>
                              <div class="box-body">
                                @if(!empty($projets_similaires))
                                          <ul>
                                          @foreach($projets_similaires->all() as $projet_similaire)
                                          <?php $id_fprojet=$projet_similaire->id_fprojet*1000; ?>
                                            <li><a href='{{ url("user/freelance-projet/{$id_fprojet}") }}' style="color: #337AB7;"><span class="fa fa-angle-double-right"></span>{{$projet_similaire->titre_projet}}</a></li>
                                          @endforeach
                                          </ul>
                                        @else
                                          <h5>Pas de projets similaires disponible</h5>
                                       @endif
                              </div>
                            </div>
                          </div>
                  <!-- end single sidebar -->
                      </aside>
                    </div>
                  </div>
                </div>

@endsection

@section('footer')

@endsection

@section('formulaire')
<div class="modal fade" id="boosterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel">Mettre en avant son projet</h4>
    </div>
    
    <form id="cvForm" class="contactform" action='{{ url("user/booster-projet/$id")}}' method="POST">
                          {{csrf_field()}}
    <div class="modal-body">
         <div class="form-group">
          <label for="profession">Veuillez choisir la duré de votre forfait</label>
            <h5>Une semaine => 2500FCFA</h5>
            <h5>Deux semaine => 5000FCFA</h5>
            <select class="form-control" name="forfait">
              @if(count($forfaits) > 0)
                @foreach($forfaits->all() as $forfait)
                  <option value="{{ $forfait->id }}">{{ $forfait->name }}</option>
                @endforeach
              @endif
            </select>
            <span style="font-size: 0.8em; color: maroon;">Pour le moment seul flooz et Tmoney sont acceptés</span>
          </div>
        <br>
    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
      </form>    
  </div> 
  </div>
  </div>
@endsection
