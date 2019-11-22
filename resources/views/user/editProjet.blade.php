@extends('layouts.app')

@section('titre')
Enginnova Freelance - Modifier un projet
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Freelance</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('user/freelance') }}">Projets Freelance</a></li>            
        <li class="active" style="color: gold;">Modifier le projet</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
   <div class="container">
     <div class="row">
      <!-- start form -->
       <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="background-color: #ffffff;"><h3>Modifier Projet</h3></div>
          <div class="panel-body">
            <?php $id = $freelance_projet->id_fprojet*1000; ?>
            <div class="alert alert-warning" >
                <img src='{{asset("elp_files/assets/img/support.png")}}' alt="image" class="img-responsive">
                <h4>Vous voulez mettre en avant votre projet pour avoir beaucoup de candidature? <a href='#' id="booster">Cliquez ici </a></h4>
            </div>
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
            <form role="form" action='{{ url("user/updateProjet/{$id}") }}' method="POST">
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
                        <label for="titre">Titre</label>
                        <input type="text" required="required" maxlength="70" class="form-control" id="exampleInputEmail1" placeholder="Titre de votre projet" name="titre_projet" value="{{$freelance_projet->titre_projet}}">
                      </div>
                      <div class="input-group">
                        <input type="text" required="required" size="30" class="form-control" id="exampleInputEmail1" placeholder="100.000" name="prix" value="{{$freelance_projet->prix}}">
                        <span class="input-group-addon">FCFA</span>
                      </div><br>
                      <div class="form-group">
                        <label for="contenu">Rédigez votre projet</label>
                          <textarea class="form-control"  id="editor1" name="contenu" rows="10" cols="80">
                                              <?php echo $freelance_projet->contenu ; ?>
                          </textarea>
                      </div>
                      <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <select class="form-control" id="exampleInputEmail1" name="categorie">
                          @if(count($categories) > 0)
                            <option value="{{ $freelance_projet->categorie }}" selected="">{{ $categorie_projet->name }}</option>
                            @foreach($categories->all() as $categorie)
                              <option value="{{ $categorie->id_categorie }}">{{ $categorie->name }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                  </div>
            </form>
          </div>
        </div> 
        </div>
        <!-- end form --> 
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #ffffff;"><h3>Candidatures</h3></div>
            <div class="panel-body">
              @if(!empty($manifestations))
              <h5><a href='{{ url("user/gestion-projet/{$id}") }}' style="color: #337AB7;"><i class="fa fa-gears"></i> <b>Gestion du projet</b></a></h5>
                @foreach($manifestations->all() as $manifestation)
                  <div class="media">
                    <div class="media-left">
                      <img class="media-object" src='{{ asset("avatars/{$manifestation->avatar}") }}' width="50" height="50" alt="User profile picture">
                    </div>
                    <div class="media-body">
                      <?php $id_user=$manifestation->id_user*1000; ?>
                      <h4 class="media-heading"><a href='{{ url("user/profil/{$id_user}") }}'>{{ $manifestation->name }}</a></h4>
                      <h6>{{$manifestation->profession}}</h6>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="alert alert-info" >
                  <h4>Vous n'avez aucune candidature pour le moment! Mettez en avant votre projet pour avoir beaucoup de candidature!</h4>
            </div>
              @endif
            </div>
          </div>
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
