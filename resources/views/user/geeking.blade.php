@extends('layouts.app')

@section('titre')
	Enginnova Geeking - {{$astuce->titre}}
@endsection

@section('meta')
<meta property="og:url" content='{{ url("geeking/{$astuce->id}") }}'>
      <meta property="og:type" content="website">
      <meta property="og:title" content="{{$astuce->titre}}">
      <meta property="og:description" content="<?php echo substr($astuce->contenu, 0,200); ?>">
<meta property="og:image" content='{{asset("posts/{$astuce->photo}")}}'>
@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Enginnova</h2>
    <ol class="breadcrumb pull-right"> 
        <li style="color: gold;"><a href="{{url('user/home')}}"><i class="fa fa-home"></i> Home</a></li>          
        <li class="active" style="color: gold;">Tech infos et astuces</li>
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
                        <h3>Activités</h3>
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
                        <div class="box box-widget">
                            <div class="box-header with-border">
                              <div class="user-block">
                                <img class="img-circle" src='{{ asset("avatars/enginnova.png") }}' width="100" height="100" alt="User profile picture" alt="User Image">
                                <figure class="mu-blog-single-img">
                          			<a href="#"><img alt="img" class="img-responsive" src='{{asset("posts/{$astuce->photo}")}}' alt="image"></a>
                          		</figure><br>
                                <span style="font-size: 16px; font-weight: 600;"><a href='{{ url("user/geeking/{$astuce->id}") }}'>{{$astuce->titre}}</a></span><br>
                                <span style="color: #999; font-size: 13px;">Posté le - {{date('d F Y',strtotime($astuce->created_at))}}</span>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <!-- post text -->
                              <p><?php echo $astuce->contenu; ?></p>
                              <!-- Social sharing buttons -->
                              Partager sur : <br>
                              <button class='btn partager_facebook' style='background: #3b5998; color: white;' data-url='{{ url("geeking/{$astuce->id}") }}'>
	                           <span class='icon-facebook2'></span> facebook
	                           </button>
	                  
	                           <button class='btn partager_twitter' style='background: #00aced; color: white;' data-url='{{ url("geeking/{$astuce->id}") }}'>
	                             <span class='icon-twitter'></span> twitter
	                          </button>
	                 
	                          <button class='btn partager_whatsapp' style='background: green;'>
	                          	<a href='whatsapp://send?text={{ url("geeking/{$astuce->id}") }}' data-action='share/whatsapp/share' style='color: white;'><span class='icon-whatsapp'></span> whatsapp</a>
	                          </button>
                              <span class="pull-right text-muted">Posté par <a href='#'>Enginnova</a></span>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
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
                            </div>
                          </div>
                        </div>
                        <!-- end single sidebar -->
                        <!-- start single sidebar -->
                          <div class="mu-single-sidebar">
                            <div class="box box-primary">
                              <div class="box-header">
                                <i class="fa fa-sticky-note"></i>

                                <h3 class="box-title">Similaires</h3>
                              </div>
                              <div class="box-body">
                                @if(!empty($similaires))
                                  @foreach($similaires->all() as $similaire)
                                    <div class="media">
    					                        <div class="media-left">
    					                          <a href="#">
    					                            <img class="media-object" src='{{asset("posts/{$similaire->photo}")}}' class="img-responsive" width="50" height="50" alt="image">
    					                          </a>
    					                        </div>
    					                        <div class="media-body">
    					                          <h4 class="media-heading"><a href='{{url("geeking/{$similaire->id}")}}' style="color: #337AB7;">{{$similaire->titre}}</a></h4>                      
    					                          <span class="popular-course-price"></span>
    					                        </div>
    					                      </div>
                                  @endforeach
                                @else
                                  <h5>Pas d'autres activités disponibles'</h5>
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
