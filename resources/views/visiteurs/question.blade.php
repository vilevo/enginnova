@extends('inc.template')

@section('titre')
	Enginnova Community - {{$post->titre_post}}
@endsection

@section('header')
<!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb" style="background-color: #337AB7;">
   <div class="container">
     <div class="row" style="background-color: #337AB7;">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2 class="pull-left">Enginnova Community</h2>
           <ol class="breadcrumb pull-right">
            <li><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i> Acceuil</a></li>
            <li><a href="{{ url('enginnova-community') }}">Enginnova Community</a></li>          
            <li class="active" style="color: gold;">Question</li>
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
                        <h3>Question</h3>
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
                                <?php $id_post=$post->id_post*1000; ?>
                                <img class="img-circle" src='{{ asset("avatars/{$post->avatar}") }}' width="50" height="50" alt="User profile picture" alt="User Image">
                                <span style="font-size: 16px; font-weight: 600;"><a href='{{ url("question/{$id_post}") }}'>{{$post->titre_post}}</a></span><br>
                                <span style="color: #999; font-size: 13px;">Posté le - {{date('d F Y',strtotime($post->created_at))}}</span>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <!-- post text -->
                              <p><?php echo $post->contenu; ?></p>
                              <!-- Social sharing buttons -->
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-comments-o"></i> <b>{{$post->counts_commentaires}} Réponses</b></button>
                              <?php $id_user=$post->id*1000; ?>
                              <span class="pull-right text-muted">Posté par <a href='{{ url("user/profil/{$id_user}") }}'>{{ $post->name }}</a></span>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                          <div class="mu-blog-tags">
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
                                <i class="fa fa-question-circle"></i>

                                <h3 class="box-title">Questions Similaires</h3>
                              </div>
                              <div class="box-body">
                                 @if(!empty($questions_similaires))
                                          <ul>
                                          @foreach($questions_similaires->all() as $question_similaire)
                                            <?php $id_post=$question_similaire->id_post*1000; ?>
                                            <li><a href='{{ url("user/question/{$id_post}") }}' style="color: #337AB7;"><span class="fa fa-angle-double-right"></span> {{$question_similaire->titre_post}}</a></li>
                                          @endforeach
                                          </ul>
                                        @else
                                          <h5>Pas de questions similaires disponible</h5>
                                        @endif
                              </div>
                            </div>
                          </div>
                  <!-- end single sidebar -->
                      </aside>
                    </div>
                  </div>
              


<!-- start blog comment -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #ffffff;">
                        <h3>{{$post->counts_commentaires}} Réponses </h3>
                      </div>
                      <div class="panel-body">
                          <div class="mu-comments-area">
                      <div class="comments">
                        <ul class="commentlist">
                        @if(count($commentaires)>0)
                          @foreach($commentaires as $commentaire)
                            <li>
                              <div class="media">
                                <div class="media-left">
                                  <img alt="img" src='{{ asset("avatars/{$commentaire->avatar}") }}' width="100" height="100" class="media-object news-img">
                                </div>
                                <div class="media-body">
                                  <?php $id_user=$commentaire->id_user*1000; ?>
                                 <a href='{{ url("user/profil/{$id_user}") }}'><h4 class="author-name">{{$commentaire->name}}</h4></a>
                                 <span class="comments-date">{{date('d F Y, H:i',strtotime($commentaire->created_at))}}</span>
                                 <p><?php echo $commentaire->contenu; ?></p>      
                                  <a class="" href='#' style="color: #337AB7;"><i class="fa fa-thumbs-up" style="color: #337AB7;"></i> Vrai {{$commentaire->count_vote}}</a>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        @else
                          <li>Aucune réponse pour le moment</li>
                        @endif
                        </ul>
                      </div>
                    </div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="col-md-3">
                  </div>
                </div>

<!-- start respond form -->
                <div class="row">
                  <div class="col-md-9">
                    <div id="respond">
                      <h3 class="reply-title">Proposer une solution</h3>
                      <form role="form" method="post" action="{{ url('user/addSolution') }}">
                        <div class="box-body">
                            {{csrf_field()}}

                            @if(count($errors) > 0)
                              @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                  {{$error}}  
                                </div>
                              @endforeach
                            @endif
                            <div class="form-group">
                              <label for="contenu">Rédigez votre solution</label>
                                <textarea class="form-control"  id="editor1" name="contenu" rows="10" cols="80">
                                                    Détaillez votre solution ici
                                </textarea>
                            </div>
                            <input type="hidden" value='{{ $post->id_post }}' name="x">
                        </div>
                        <div class="alert alert-warning" >
                              <img src='{{asset("elp_files/assets/img/support.png")}}' alt="image" class="img-responsive"><br>
                              <h4>Allez! inscrivez-vous pour rejoindre notre communauté et pour répondre à cette question.</h4><br>
                              <a href="{{ route('register') }}" class="mu-post-btn" style="color: maroon;"><i class="fa fa-long-arrow-right"></i> S'inscricre </a>
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Répondre</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-3">
                  </div>
                </div>
                <!-- end respond form -->
</div>
@endsection

@section('footer')

@endsection
