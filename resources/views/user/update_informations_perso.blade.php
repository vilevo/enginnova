@extends('layouts.app')

@section('titre')
Enginnova Community - Mettez à jour vos informations personnelles
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Enginnova Community</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}">Home</a></li>           
        <li class="active" style="color: gold;">Informations personnelles</li>
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
