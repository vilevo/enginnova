@extends('layouts.app')

@section('titre')
Enginnova Community - publier une inquiétude
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Enginnova Community</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}">Home</a></li>
        <li><a href="{{ url('user/enginnova-community') }}">Enginnova Community</a></li>            
        <li class="active" style="color: gold;">Poser une question</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
   <div class="container">
     <div class="row">
      <div class="col-md-3"></div> 
      <!-- start form -->
       <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="background-color: #ffffff;"><h3>Nouvelle Question</h3></div>
          <div class="panel-body">
            <h3>Quel est le titre de votre question?</h3>
              <h5>Le titre permet aux gens de vite comprendre votre inquiètude afin de pouvoir vous aider.</h5>
              <div class="alert alert-warning">
                <h4>Imaginons que vous voulez poser une question</h4>
                <p style="color: gray;">
                  Par exemple<br>
                  <span class="fa fa-remove" style="color: red;"></span> Parse error: syntax error, unexpected '?>', expecting ')'<br>
                  <span class="fa fa-check" style="color: green;"></span>Comment résoudre "Syntax error, unexpected '?>', ')' expecting" en PHP 
                </p>
              </div>
                <form role="form" action="{{ url('user/insertQuestion') }}" method="POST">
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
                            <input type="text" required="required" maxlength="70" class="form-control" id="exampleInputEmail1" placeholder="Titre de votre question" name="titre_post">
                          </div>
                          <div class="form-group">
                            <label for="contenu">Rédigez votre question</label>
                              <textarea class="form-control"  id="editor1" name="contenu" rows="10" cols="80">
                                                  Exemple:
                                                  Je suis débutant en PHP, j'essaie d'afficher le contenu d'une variable mais je recois comme erreur : Parse error: syntax error, unexpected '?>', expecting ')' . Voici le code : echo substr($text, 0,8
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
                            <sapn style="font-size: 0.8em; color: maroon;">Veuillez choisir la catégorie à laquelle appartient votre question.</sapn>
                          </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Publier</button>
                      </div>
                    </form>
          </div>
        </div>
        
      </div> 
      <div class="col-md-3"></div>     
       </div>
       <!-- end form -->
     </div>
   </div>
@endsection

@section('footer')

@endsection
