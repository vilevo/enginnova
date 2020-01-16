@extends('inc.template')

@section('titre')
	Enginnova Freelance - {{$freelance_projet->titre_projet}}
@endsection

@section('header')
<!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb" style="background-color: #337AB7;">
   <div class="container">
     <div class="row" style="background-color: #337AB7;">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2 class="pull-left">Freelance</h2>
           <ol class="breadcrumb pull-right">
            <li><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i>Acceuil</a></li>
            <li><a href="{{ url('freelance') }}">Freelance</a></li>            
            <li class="active" style="color: gold;">Projet</li>
          </ol>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End breadcrumb -->
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
                                <img class="img-circle" src="https://enginnova.s3-us-west-2.amazonaws.com/<?php echo $freelance_projet->avatar; ?>" width="50" height="50" alt="User profile picture" alt="User Image">
                                <span style="font-size: 16px; font-weight: 600;"><a href='{{ url("user/freelance-projet/{$id_fprojet}") }}'>
                                   @if($freelance_projet->type=="benevolat")
                                    {{$freelance_projet->titre_projet}} <span class="label label-info">[bénévolat]</span>
                                  @else
                                    {{$freelance_projet->titre_projet}} 
                                  @endif
                                </a></span><br>
                                <span style="color: #999; font-size: 13px;">Posté le - {{date('d F Y',strtotime($freelance_projet->created_at))}}</span>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <!-- post text -->
                              <p><?php echo $freelance_projet->contenu; ?></p>
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
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
               				<div class="alert alert-warning" >
                              <img src='{{asset("elp_files/assets/img/support.png")}}' alt="image" class="img-responsive"><br>
                              <h4>Allez! inscrivez-vous pour rejoindre notre communauté et pour participer à la réalisation de cet projet.</h4><br>
                              <a href="{{ route('register') }}" class="mu-post-btn" style="color: maroon;"><i class="fa fa-long-arrow-right"></i> S'inscricre </a>
                        	</div>
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
                                <h4 class="media-heading"><a href='{{url("geeking/{$astuce->id}")}}' style="color: #337AB7;">{{$astuce->titre}}</a></h4>                      
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
