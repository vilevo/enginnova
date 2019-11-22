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
            <li><a href="{{ url('Learning-program-pro') }}">Learning Program Pro</a></li>
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
                  Frais de formation (en FCFA) : 10.000 Par module ; 50.000 pour la formation complète (6 modules) <br>
                  Possibilité de Cours du soir : Oui <br>
                  Possibilité de réduction des frais de formation : Oui
                </p>
              </div>
                <form role="form" action="{{ url('add-fp') }}" method="POST">
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
                           <label for="titre">Module</label>
                            <select name="module" class="form-control" id="exampleInputEmail1">
                              <option value="IA">Intelligence Artificielle</option>
                              <option value="RV">Réalité Virtuelle</option>
                              <option value="LEI">Leadership entrepreneurial et innovation</option>
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