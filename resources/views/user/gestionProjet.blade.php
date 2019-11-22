@extends('layouts.app')

@section('titre')
  {{ Auth::user()->name }}
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Freelance</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('user/freelance') }}">Projets Freelance</a></li>            
        <li class="active" style="color: gold;">Gestion du projet</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
	<div class="container">
    <div class="row">
    	<div class="col-md-3"></div>
    			<div class="col-md-6">
		          <div class="panel panel-default">
		                      <div class="panel-heading" style="background-color: #ffffff;">
		                        <h3><i class="fa fa-gears"></i> Gestion projet</h3>
		                        <ul style="display: inline-block;">
		                        	<li style="display: inline-block;" class="label label-primary">Sélectionner Candidats</li>
		                        </ul>
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
		                      </div>
		                      <div class="panel-body">
		                     	@if(!empty($manifestations))
		                     		<h4 style="color: #337AB7; font-weight: bold; font-size: 0.8em;">Cliquez sur le nom d'un utilisateur pour acceder à son profil</h4>
					                @foreach($manifestations->all() as $manifestation)
					                  <div class="media">
					                  	<!-- <a href="#" id="select_candidat" data-id="{{$manifestation->id}}" class="pull-right"> <span class="label label-info">Voir son CV</span></a> -->
					                  	<?php $id_user=$manifestation->id_user*1000; 
					                  		  $id_fprojet=$manifestation->id_fprojet*1000; 
					                  	?>
					                  	@if($manifestation->selectionne == true)
					                  		<a href='{{ url("user/annuler-candidat-selection/$id_user/$id_fprojet") }}'  class="pull-right"> <span class="label label-info"><b>Annuler Séléction</b></span></a>
					                  	@else
					                  		<a href='{{ url("user/notifier-candidat-selectionne/$id_user/$id_fprojet") }}'  class="pull-right"> <span class="label label-info"><b>Sélectionné</b></span></a>
					                  	@endif
					                    <div class="media-left">
					                      <a href="#">
					                        <img class="media-object" src='{{ asset("avatars/{$manifestation->avatar}") }}' width="50" height="50" alt="User profile picture">
					                      </a>
					                    </div>
					                    <div class="media-body">
					                      <h4 class="media-heading"><a href='{{ url("user/profil/{$id_user}") }}'>{{ $manifestation->name }}</a></h4>
					                      	<h6>{{$manifestation->profession}}</h6>
					                    </div>
					                    @if($manifestation->valider == true)
					                      		<h6 style="color: green;">A accepté le job</h6>
					                      	@else
					                      		<h6 style="color: red; font-weight: bold;">N'a pas encore accepté le job</h6>
					                      	@endif
					                    <hr>
					                  </div>
					                @endforeach
              					@endif
              					<br>
              					<a href='{{url("user/workspace/$id_fprojet")}}' class="pull-right" style="color: #337AB7; font-size: 1em; font-weight: bold;">Suivant <i class="fa fa-angle-double-right"></i></a>
		                      </div>
		             </div>
		        </div>
		      <div class="col-md-3"></div>
     </div> 
</div>
@endsection

@section('footer')

@endsection

@section('formulaire')
<!-- <div class="modal fade" id="CvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel">CV du candidat</h4>
    </div>
    
    <div class="modal-body">
    	<h4 style="color: #337AB7; font-weight: bold; font-size: 0.8em;">Cliquez sur l'image pour acceder au CV</h4>
        <div id="CV"></div> 
    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>  
  </div> 
  </div>
  </div> -->
@endsection

