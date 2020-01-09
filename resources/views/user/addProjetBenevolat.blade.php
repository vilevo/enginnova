@extends('layouts.app')

@section('titre')
Freelance - publier un projet
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Freelance</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}">Home</a></li>
        <li><a href="{{ url('user/freelance') }}">Projets Freelance</a></li>            
        <li class="active" style="color: gold;">Publier un projet freelance</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
   <div class="container">
     <div class="row">
      <div class="col-md-5">
              <div id="benevola" class="alert alert-warning">
                <h4>Projet Bénévolat</h4>
                <img src='{{asset("elp_files/assets/img/pic/happy.jpg")}}' height="200" width="600" class="img-responsive">
                <div id="benevola_desc" style="margin-top: 10px;">
                  <p>Allez sauter de joie! Plus de soucis à se faire avec l'instauration des projets bénévolats par enginnova.<br> Vous avez un projet mais pas les fonds les neccessaires pour le démarré? Enginnova vous aide à former votre équipe gratuitement.<br> Veuillez remplir le formulaire, puis après une étude détaillée et validation de votre projet, nous vous aiderons à le réaliser <i class="fa fa-hand-peace-o" style="color: green;"></i> .</p>
                </div>
              </div>
            </div>
      <!-- start form -->
       <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="background-color: #ffffff;"><h3>Nouveau Projet Bénévolat</h3></div>
          <div class="panel-body">
            <h3>Quel est le titre de votre projet?</h3>
              <h5>Le choix d'un bon titre est très important car elle permet d'avoir beaucoup de candidature.</h5>
              <div class="alert alert-warning">
                <h4>Imaginons que vous etes à la recherche de developpeurs</h4>
                <p style="color: gray;">
                  Par exemple<br>
                  <span class="fa fa-remove" style="color: red;"></span>Je cherche des developpeurs<br>
                  <span class="fa fa-check" style="color: green;"></span>Vous etes bon en python? cet projet vous est destiné 
                </p>
              </div>
              <form role="form" action="{{ url('user/insertProjetBenevolat') }}" method="POST">
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
                          <input type="text" required="required" maxlength="70" class="form-control" id="exampleInputEmail1" placeholder="Titre de votre projet" name="titre_projet">
                        </div>
                        <div class="form-group">
                          <label for="contenu">Rédigez votre projet</label>
                            <textarea class="form-control"  id="editor1" name="contenu" rows="10" cols="80">
                                                Exemple : 
                                                Je suis à la recherche d'un bon developpeur en python qui aime travailler en équipe...
                            </textarea>
                        </div>
                        <div class="form-group">
                          <label for="categorie">Catégorie</label>
                          <select class="form-control" id="exampleInputEmail1" name="categorie">
                            @if(count($categories) > 0)
                              @foreach($categories->all() as $categorie)
                                <option value="{{ $categorie->id_categorie }}">{{ $categorie->name }}</option>
                              @endforeach
                          @endif
                          </select>
                          <sapn style="font-size: 0.8em; color: maroon;">Veuillez choisir la catégorie à laquelle appartient votre projet.</sapn>
                        </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Publier</button>
                    </div>
                  </form>
          </div>
        </div>
          
      </div>
             <div class="col-md-1"></div>     
       </div>
       <!-- end form -->
     </div>
   </div>
@endsection

@section('footer')

@endsection
