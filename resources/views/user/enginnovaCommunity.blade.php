@extends('layouts.app')

@section('titre')
	Enginnova Community
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Enginnova Community</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}"><i class="fa fa-home"></i> Home</a></li>           
        <li class="active" style="color: gold;">Enginnova Community</li>
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
                        <h3>Toutes les questions</h3>
                        @if (session('info'))
                            <h5>
                            <div class="alert alert-success">
                              {{ session('info') }}
                            </div></h5>
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

                        @if(count($posts) > 0)
                        @foreach($posts->all() as $post)
                          <div class="box box-widget">
                            <div class="box-header with-border">
                              <div class="user-block">
                                <?php $id_post=$post->id_post*1000; ?>
                                <img class="img-circle" src="https://enginnova.s3-us-west-2.amazonaws.com/<?php echo $post->avatar; ?>" width="50" height="50" alt="User profile picture" alt="User Image">
                                <span style="font-size: 16px; font-weight: 600;"><a href='{{ url("user/question/{$id_post}") }}'>{{$post->titre_post}}</a></span><br>
                                <span style="color: #999; font-size: 13px;">Posté le - {{date('d F Y',strtotime($post->created_at))}}</span>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <!-- post text -->
                              <p><?php echo substr($post->contenu, 0,145); ?>...</p>
                              <!-- Social sharing buttons -->
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-comments-o"></i> <b>{{$post->counts_commentaires}} Réponses</b></button>
                              <?php $id_user=$post->id*1000; ?>
                              <span class="pull-right text-muted">Posté par <a href='{{ url("user/profil/{$id_user}") }}'>{{ $post->name }}</a></span>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                            
                        @endforeach
                        {{ $posts->links() }}
                      @else
                        <div class="alert alert-danger"><h5>Pas de questions disponible pour le moment.</h5></div>
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
                                  <img class="media-object" src="https://enginnova.s3-us-west-2.amazonaws.com/<?php echo $astuce->photo; ?>" class="img-responsive" width="50" height="50" alt="image">
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
                                <?php $idline = $user->id*1000; ?>
                                <img class="img-circle" src="https://enginnova.s3-us-west-2.amazonaws.com/<?php echo $user->avatar; ?>" width="50" height="50" alt="User profile picture" alt="User Image">
                                <a href='{{ url("user/profil/{$idline}") }}'>{{$user->name}}</a> <br><hr>
                              @endif
                            @endforeach
                            <a href="#">Voir tous les utilisateurs en lignes</a>
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
                        <i class="fa fa-question-circle"></i>

                        <h3 class="box-title">Types Questions</h3>
                      </div>
                      <div class="box-body">
                        <ul class="mu-sidebar-catg">
                                  @if(count($categories)>0)
                                    @foreach($categories->all() as $categorie)
                                      <?php $id = $categorie->id_categorie*1000; ?>
                                      <li><a href='{{ url("user/questions-categorie/{$id}") }}' style="color: #337AB7;"><span class="fa fa-angle-double-right"></span> {{$categorie->name}}</a></li>
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
                </div>
@endsection

@section('footer')

@endsection
