@extends('layouts.admin')

@section('titre')
    Administration - acceuil
@endsection

@section('header')

@endsection

@section('layout_main_content')
<div class="mu-course-container mu-blog-single">
    <div class="row">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #ffffff;">
                        <h3>Admin Dashboard</h3>
                        @if (session('info'))
                            <h5>
                            <div class="alert alert-success">
                              {{ session('info') }}
                            </div></h5>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{ url('user/add-post') }}" class="pull-right"><h5 class="label label-info">Nouvelle annonce</h5></a>
                          <div class="forq" style="margin-top: 50px;">
                          <form action="#" method="get" class="sidebar-form">
                            <div class="input-group">
                              <input type="text" name="q" class="form-control" placeholder="Rechercher un utilisateur">
                              <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                  </span>
                            </div>
                          </form>
                          </div>
                    </div>
                    <div class="panel-body">
                    	<h4>Total utilisateurs : {{count($users)}}</h4>
                    	<h4>Total questions : {{count($posts)}}</h4>
                    	<h4>Total freealce projets : {{count($fprojets)}}</h4>
                        <div class="cv">
                        	<h3>Les CV</h3>
                        	@if($new_cvs>0)
                        		<h4>Total CV : {{count($new_cvs)}}</h4>
                        		<h5 class="label label-primary"><a href="{{url('admin/cv-inactif')}}" style="color: white;">Total CV à traiter</a> : {{$new_cvs}}</h5>
                        	@else
                        	<h4 class="label label-warning">Vide</h4>
                        	@endif
                        	<hr>	
                        </div>
             			<div class="freelance_projet">
             				<h3>Les projets freelance</h3>
                        	@if($new_projets>0)
             				<h5 class="label label-primary"><a href="{{url('admin/freelance-projets')}}" style="color: white;">Total Projets à traités</a> : {{$new_projets}}</h5>
                            @else
                        	<h4 class="label label-warning">Vide</h4>
                        	@endif	
                        </div>
                        <div class="freelance_projet">
                        	<h3>Les projets freelance à booster</h3>
                        	@if($new_boosts>0)
             				<h5 class="label label-primary"><a href="{{url('admin/projets-boost')}}" style="color: white;">Total Projets à booster</a> : {{$new_boosts}}</h5>
                        	@else
                        	<h4 class="label label-warning">Vide</h4>
                        	@endif	
                        </div>
                        <div class="projets_encours">
                            <h3>Users selectionnés pour un projet</h3>
                            @if($new_manif>0)
                                <h5 class="label label-primary"><a href="{{url('admin/manif')}}" style="color: white;">Candidats sélectionés</a> : {{$new_manif}}</h5>
                            @else
                                <h6 class="label label-warning">Vide</h6>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-3">
            
        </div>
    </div>
</div>
@endsection

@section('footer')
	
@endsection

