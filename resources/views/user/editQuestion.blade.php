@extends('layouts.app')

@section('titre')
Enginnova Community - Modifier une question
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Enginnova Community</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}">Home</a></li>
        <li><a href="{{ url('user/enginnova-community') }}">Enginnova Community</a></li>            
        <li class="active" style="color: gold;">Modifier la question</li>
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
          <div class="panel-heading" style="background-color: #ffffff;"><h3>Modifier Question</h3></div>
          <div class="panel-body">
            <?php $id = $post->id_post*1000; ?>
            <form role="form" action='{{ url("user/updateQuestion/{$id}") }}' method="POST">
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
                        <input type="text" required="required" maxlength="70" class="form-control" id="exampleInputEmail1" placeholder="Titre de votre question" name="titre_post" value="{{$post->titre_post}}"
  >
                      </div>
                      <div class="form-group">
                        <label for="contenu">Rédigez votre question</label>
                          <textarea class="form-control"   id="editor1" name="contenu" rows="10" cols="80">
                                              {{$post->contenu}}
                          </textarea>
                      </div>
                      <div class="form-group">
                        <label for="categorie">Catégorie de la question :</label>
                        <select class="form-control" id="exampleInputEmail1" name="categorie">
                          @if(count($categories) > 0)
                            <option value="{{ $post->id_categorie }}" selected="">{{ $categorie_question->name }}</option>
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
            <div class="col-md-3"></div>      
       </div>
       <!-- end form -->
     </div>
   </div>
 <!-- End contact  -->
@endsection

@section('footer')
  
@endsection
