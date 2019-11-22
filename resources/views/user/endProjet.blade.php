@extends('layouts.app')

@section('titre')
Enginnova Freelance - Projet Terminé
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Freelance</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('user/freelance') }}">Projets Freelance</a></li>            
        <li class="active" style="color: gold;">Noter les participants</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
  <div class="container">
  	<div class="row">
  		<div class="col-md-6 col-md-offset-3">
  			<div class="panel panel-default">
  				<div class="panel-heading" style="background-color: #ffffff;">
  					<h3><i class="fa fa-gears"></i> Gestion projet</h3>
		            <ul style="display: inline-block;">
		                <li style="display: inline-block;" class="label label-primary">Veuillez noter les participants</li>
		            </ul>
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
  				@if(!empty($manifestations))
		            <h4 style="color: #337AB7; font-weight: bold; font-size: 0.8em;">Cliquez sur selectionné pour noté le participant</h4>
					@foreach($manifestations->all() as $manifestation)
					    <div class="media">
					        <?php $id_user=$manifestation->id_user*1000; 
					            $id_fprojet=$manifestation->id_fprojet*1000; ?>
							@if($manifestation->selectionne == true && $manifestation->valider == true)
					        <a href="#" class="pull-right" data-id="{{$manifestation->id_user}}" data-idw="{{$idw}}" id="select_candidat"> <span class="label label-info"><b>Sélectionné</b></span></a>
					        <div class="media-left">
					            <a href="#">
					                <img class="media-object" src='{{ asset("avatars/{$manifestation->avatar}") }}' width="50" height="50" alt="User profile picture">
					            </a>
					        </div>
					        <div class="media-body">
					            <h4 class="media-heading"><a href='{{ url("user/profil/{$id_user}") }}'>{{ $manifestation->name }}</a></h4>
					            <h6>{{$manifestation->profession}}</h6>
					        </div>
					            <h6 style="color: green;">A accepté le job</h6>
					        @endif
					            <hr>
					    </div>
					@endforeach
              	@endif
              		<br>
              		<a href='{{ url("user/the-end/{$idp}/{$idw}") }}' class="pull-right" style="color: #337AB7; font-size: 1em; font-weight: bold;">Fin du projet <i class="fa fa-angle-double-right"></i></a>
  				</div>
  			</div>
  		</div>
  	</div>
  	
  </div>
@endsection

@section('footer')
@endsection

@section('formulaire')
<div class="modal fade" id="CvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel">Noter le participant</h4>
      <div id="reponse"></div>
    </div>
    <form id="noteForm" class="contactform" action="#" method="POST">
                          {{csrf_field()}}
    <div class="modal-body">
    	<div class="form-group">
    		<label for="note">Note</label>
                @if(count($observations) > 0)
                    @foreach($observations->all() as $observation)
                        <div class="radio">
			                <label>
			                    <input type="radio" name="observation" id="observation" value="{{ $observation->id_observation }}">
			                      {{ $observation->name }}
			                </label>
	            		</div>
                    @endforeach
                @endif
    	</div>
    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
    </form>  
  </div> 
  </div>
  </div>
@endsection
