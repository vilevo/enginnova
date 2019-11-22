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
        <li style="color: gold;"><a href="{{url('user/home')}}"><i class="fa fa-home"></i> Home</a></li>          
        <li class="active" style="color: gold;">Profil</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
   <div class="container">
            <div class="row profil">
              <!-- profil info -->
              <div class="col-md-3">
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <?php $id = $user->id*1000; ?>
                    @if($user->id == Auth::user()->id)
                      <a href='#' id="updateAvatar"><img class="profile-user-img img-responsive" src='{{ asset("avatars/{$user->avatar}") }}' alt="User profile picture"></a>
                    @else
                      <a href='#'><img class="profile-user-img img-responsive" src='{{ asset("avatars/{$user->avatar}") }}' alt="User profile picture"></a>
                    @endif

                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                    <p class="text-muted text-center">{{$user->profession}}</p>

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Points Réponses</b> <a class="pull-right"><span class="label label-info">{{$note}}</span></a>
                      </li>
                      <li class="list-group-item">
                        <b>Projets Traités</b> <a class="pull-right"><span class="label label-info">{{$nbr_projet_traite}}</span></a>
                      </li>
                      <li class="list-group-item">
                        <b>Total Points</b> <a class="pull-right"><span class="label label-info">{{$point_total}}</span></a>
                      </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block">
                      @if($point_total < 1667)
                        Aucune étoile
                      @elseif($point_total >= 1667 && $point_total < 3334)
                        <span class="fa fa-star" style="color: yellow;"></span>
                      @elseif($point_total >= 3334 && $point_total < 5000)
                        <span class="fa fa-star" style="color: yellow;"></span>
                        <span class="fa fa-star" style="color: yellow;"></span>
                      @elseif($point_total >= 5000)
                        <span class="fa fa-star" style="color: yellow;"></span>
                        <span class="fa fa-star" style="color: yellow;"></span>
                        <span class="fa fa-star" style="color: yellow;"></span>
                      @endif
                    </a>
                  </div>
                </div>
                <!-- end profil info -->
                <!-- About Me Box -->
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

                    <p class="text-muted">
                      {{$user->email}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-phone margin-r-5"></i> Téléphone</strong>

                    <p class="text-muted">
                      {{$user->telephone}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Adresse</strong>

                    <p class="text-muted">{{$user->ville}}, {{$user->adresse}}</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Compétences</strong>

                    <p>
                      <span class="label label-success">{{$user->competences}}</span>
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                    <p>{{$user->description}}</p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- end about me box -->

              </div>
              <!-- end profil info -->
              <!-- start profil info perso -->
              <div class="col-md-9">
                <div class="panel panel-default">
                  <div class="panel-heading" style="background-color: #ffffff;">
                    <h3>Profil</h3>
                    <h5>@if (session('info_cv'))
                            <div class="alert alert-success">
                              {{ session('info_cv') }}
                            </div>
                          @endif</h5>
                    <h5>@if (session('info'))
                            <div class="alert alert-success">
                              {{ session('info') }}
                            </div>
                          @endif</h5>
                    <h5>@if (session('info_avatar'))
                            <div class="alert alert-success">
                              {{ session('info_avatar') }}
                            </div>
                          @endif</h5>

                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                          <div class="alert alert-danger">
                            {{$error}}  
                          </div>
                        @endforeach
                    @endif
                  </div>
                  <div class="panel-body">
                      <div class="nav-tabs-custom" style="background-color: #ffffff;">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">CV</a></li>
                        <li><a href="#timeline" data-toggle="tab">Expérience</a></li>
                        @if($user->id == Auth::user()->id)
                          <li><a href="#settings" data-toggle="tab">Informations</a></li>
                        @endif
                      </ul>
                      <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                          <!-- Post -->
                          <div class="post">
                            <div class="row margin-bottom">
                              <div class="col-sm-12">
                                <h4 align="center">Curriculum Vitae</h4>
                              <?php $id = $user->id*1000; ?>
                              @if($cv != false)
                                <a href='{{ asset("cv/{$cv->cv}") }}'><img class="img-responsive" src='{{ asset("cv/{$cv->cv}") }}' width="80%" height="80%" alt="Votre CV"></a><br>
                                @if($user->id == Auth::user()->id)
                                  <a href='#' id="updateCv" class="mu-post-btn"><i class=""></i>mettre à jour mon CV</a>
                                  <h6 style="color: maroon;">Le traitement de votre CV a dépassé 48h ? Envoyez nous un mail.
                                  </h6><a href="#" id="booster" class="label label-danger"><i class="fa fa-send"></i> Signaler le probleme </a>
                                @endif
                              @else
                                <img class="img-responsive" src="{{ asset('cv/default.jpg') }}" width="80%" height="80%" alt="Votre CV">
                                  @if($user->id == Auth::user()->id)
                                    <a href='#' id="updateCv" class="mu-post-btn"><i class=""></i>mettre à jour mon CV</a>
                                    <h6 style="color: maroon;">Le traitement de votre CV a dépassé 48h ? Envoyez nous un mail.
                                  </h6><a href="#" id="booster" class="label label-danger"><i class="fa fa-send"></i> Signaler le probleme </a>
                                  @endif  
                              @endif
                              </div>
                              
                            </div>
                            <!-- /.row -->
                            <!-- <ul class="list-inline">
                              <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                              <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                              </li>
                              <li class="pull-right">
                                <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                                  (5)</a></li>
                            </ul>
                            <input class="form-control input-sm" type="text" placeholder="Type a comment"> -->
                          </div>
                          <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                          <!-- The timeline -->
                          <ul class="timeline timeline-inverse">
                            @if(!empty($experiences))
                              @foreach($experiences->all() as $experience)
                                <!-- timeline time label -->
                                <li class="time-label">
                                      <span class="bg-red">
                                        {{date('d F Y',strtotime($experience->created_at))}}
                                      </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                  <i class="fa fa-clock-o bg-blue"></i>

                                  <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{date('H:i',strtotime($experience->created_at))}}</span>

                                    <h3 class="timeline-header"><a href="#">{{$experience->titre_projet}}</a></h3>

                                    <div class="timeline-body">
                                      @if($experience->projet_traite == true)
                                        <h5><strong>Projet traité :</strong> <i class="fa fa-check-circle-o"></i> Oui</h5>
                                      @else
                                        <h5><strong>Projet traité :</strong> <i class="fa fa-thumbs-o-down"></i> Non</h5>
                                      @endif

                                      @if($experience->id_observation != 0)
                                        <h5><strong>Observation du chef projet :</strong> <i class="fa fa-check-circle-o"></i> {{$experience->name}}</h5>
                                      @else
                                        <h5><strong>Observation du chef projet :</strong> Aucune observation...</h5>
                                      @endif
                                    </div>
                                    <div class="timeline-footer">
                                      <?php $idp = $experience->id_fprojet*1000; ?>
                                      <a class="btn btn-primary btn-xs" href='{{ url("user/freelance-projet/{$idp}") }}'>Voir le projet</a>
                                    </div>
                                  </div>
                                </li>
                                <!-- END timeline item -->
                              @endforeach
                            @else
                              <h6 style="color: maroon;">{{ $user->name }} n'a aucune expérience pour le moment</h6>
                            @endif
                            
                           <!--  <li>
                              <i class="fa fa-clock-o bg-gray"></i>
                            </li> -->
                          </ul>
                        </div>
                        <!-- /.tab-pane -->
                      @if($user->id == Auth::user()->id)
                        <div class="tab-pane" id="settings">
                            <br>
                          <?php $id = $user->id*1000; ?>
                          <form role="form" action='{{ url("user/updateProfil/{$id}") }}' method="POST" class="form-horizontal">
                            {{csrf_field()}}
                              <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Nom</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="exampleInputEmail1" required="required" size="30" value="{{$user->name}}" name="name">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email </label>
                                <div class="col-sm-10">
                                  <input type="email" class="form-control" id="exampleInputEmail1" required="required" value="{{$user->email}}" name="email">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="telephone" class="col-sm-2 control-label">Télephone</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="exampleInputEmail1" required="required" value="{{$user->telephone}}" name="telephone">
                                </div>
                              </div>
                               <div class="form-group">
                                <label for="profession" class="col-sm-2 control-label">Profession</label>
                                <div class="col-sm-10">
                                 <select class="form-control" name="profession">
                                    @if(count($professions) > 0)
                                      @foreach($professions->all() as $profession)
                                        <option value="{{ $profession->name }}">{{ $profession->name }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="competences" class="col-sm-2 control-label">Compétences</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="exampleInputEmail1" required="required" value="{{$user->competences}}" name="competences">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="ville" class="col-sm-2 control-label">Ville</label>
                                <div class="col-sm-10">
                                  <select class="form-control" name="ville">
                                        <option value="{{ $user->ville }}">{{ $user->ville }}</option>
                                        <option value="kara">kara</option>
                                        <option value="sokode">sokode</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="adresse" class="col-sm-2 control-label">Adresse</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="exampleInputEmail1" required="required" value="{{$user->adresse}}" name="adresse">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="adresse" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                  <textarea class="form-control" required="required" aria-required="true" rows="8" cols="45" name="description">{{$user->description}}</textarea>
                                </div>
                              </div>  
                              <button type="submit" class="btn btn-primary">Mettre à jour</button>
                          </form>
                        </div>
                        <!-- /.tab-pane -->
                      @endif
                      </div>
                      <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                    <h3>Questions</h3>
                    @if(!empty($questions))
                      @foreach($questions->all() as $question)
                          <div class="box box-widget">
                            <div class="box-header with-border">
                              <div class="user-block">
                                <?php $id_post=$question->id_post*1000; ?>
                                <img class="img-circle" src='{{ asset("avatars/{$user->avatar}") }}' width="50" height="50" alt="User profile picture" alt="User Image">
                                <span style="font-size: 16px; font-weight: 600;"><a href='{{ url("user/question/{$id_post}") }}'>{{$question->titre_post}}</a></span><br>
                                <span style="color: #999; font-size: 13px;">Posté le - {{date('d F Y',strtotime($question->created_at))}}</span>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <!-- post text -->
                              <p><?php echo substr($question->contenu, 0,145); ?>...</p>
                              <!-- Social sharing buttons -->
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-comments-o"></i> <b>{{$question->counts_commentaires}} Réponses</b></button>
                              <?php $id_user=$question->id*1000; ?>
                              <span class="pull-right text-muted">Posté par <a href='{{ url("user/profil/{$id_user}") }}'>{{ $user->name }}</a></span>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                            
                        @endforeach
                        {{ $questions->links() }}
                    @else
                      <div class="alert alert-danger">
                        <h6>Aucune question mise en ligne par {{ $user->name }}</h6>
                      </div>
                    @endif
                  </div>
                </div>
              
              </div>
              <!-- end profil info perso -->
            </div>
   </div>
@endsection

@section('footer')
@endsection

@section('formulaire')
<div class="modal fade" id="cvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel">Mettre à jour CV</h4>
    </div>
    <?php $id = $user->id*1000; ?>
    <form id="cvForm" class="contactform" action='{{ url("user/mettre-a-jour-cv/$id")}}' method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}
    <div class="modal-body">
        <p class="comment-form-author "><input type="file" name="cv" id="cv"></p>
        <span style="font-size: 0.8em; color: maroon;">Format du ficher: jpeg, png ou jpg. Poids max 1Mb. Votre email ou numéro de telelphone ne doit pas apparaitre sur le CV.</span><br>
    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
      </form>    
  </div> 
  </div>
  </div>

  <div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel">Mettre à jour photo de profil</h4>
    </div>
    <?php $id = $user->id*1000; ?>
    <form id="avatarForm" class="contactform" action='{{ url("user/mettre-a-jour-avatar")}}' method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}
    <div class="modal-body">
        <p class="comment-form-author "><input type="file" name="avatar" id="avatar"></p>
        <span style="font-size: 0.8em; color: maroon;">Format du ficher: jpeg, png ou jpg. Poids max 1Mb.</span><br>
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