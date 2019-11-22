@extends('inc.template')

@section('titre')
    Enginnova Learning program - Inscription
@endsection

@section('header')
<!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb" style="background-color: #337AB7;">
   <div class="container">
     <div class="row" style="background-color: #337AB7;">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2 class="pull-left">Enginnova Learning Program</h2>
           <ol class="breadcrumb pull-right">
            <li><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i>Acceuil</a></li>            
            <li><a href="{{ url('learn-to-code-from-scratch') }}">learn 2 Code From Scratch</a></li>
            <li class="active" style="color: gold;">Inscription</li>
          </ol>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End breadcrumb -->
@endsection

@section('layout_main_content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
          <div class="panel panel-default">
          <div class="panel-heading" style="background-color: #ffffff;"><h3>S'inscrire à la formation</h3>
            @if (session('info'))
              <div class="alert alert-success">
                <h5>{{ session('info') }}</h5>
              </div>
            @endif
            @if (session('info_error'))
              <div class="alert alert-danger">
                <h5>{{ session('info_error') }}</h5>
              </div>
            @endif
          </div>
          <div class="panel-body">
              <div class="alert alert-warning">
                <h4>Rappel</h4>
                <p style="color: gray;">
                  Frais de formation (en FCFA) , 1 personne = 15.000 ; Duo = 14.000 ; Trio = 12.000 ; Groupe de 5 personnes = 10.000 <br>
                  Possibilité de Cours du soir : Oui <br>
                  Possibilité de réduction des frais de formation : Oui
                </p>
              </div>
                <form role="form" action="{{ url('add-fs') }}" method="POST">
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
                            <label for="titre">Nom complet</label>
                            <input type="text" required="required" maxlength="70" class="form-control" id="exampleInputEmail1" placeholder="Nom complet" name="nom">
                          </div>
                          <div class="form-group">
                            <label for="titre">Numéro de téléphone</label>
                            <input type="text" required="required" maxlength="70" class="form-control" id="exampleInputEmail1" placeholder="Numéro de téléphone" name="numero">
                          </div>
                          <div class="form-group">
                           <label for="titre">Email</label>
                            <input type="email" required="required" maxlength="70" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
                          </div>
                          <div class="form-group">
                           <label for="titre">Niveau</label>
                            <select name="niveau" class="form-control" id="exampleInputEmail1">
                              <option value="debutant">Débutant</option>
                              <option value="junior">Junior</option>
                              <option value="senior">Senior</option>
                            </select>
                          </div>
                    </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                      </div>
                    </form>
          </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

@endsection