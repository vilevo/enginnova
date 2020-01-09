@extends('layouts.admin')

@section('titre')
    Administration - Gestion mentor
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
                        <div class="cv">
                        	<h3>Mettre en ligne des trucs et astuces</h3>
                        	<form role="form" action='{{ url("admin/add-mentor") }}' method="POST" enctype="multipart/form-data">
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
			                      <label for="titre">Nom</label>
			                      <input type="text" required="required" maxlength="100" class="form-control" id="exampleInputEmail1" placeholder="Nom" name="nom" value="{{ old('nom') }}">
			                    </div>
			                    <div class="form-group">
			                      <label for="titre">Profession</label>
			                      <input type="text" required="required" maxlength="100" class="form-control" id="exampleInputEmail1" placeholder="Profession" name="profession" value="{{ old('profession') }}">
			                    </div>
			                    <div class="form-group">
			                      <input type="file" required="required" class="form-control" id="exampleInputEmail1" name="photo" >
			                    </div><br>
			      				<div class="form-group">
			                      <label for="about">Brief description</label>
			                       <input type="text" required="required" class="form-control" id="exampleInputEmail1" placeholder="Description" name="about" value="{{ old('about') }}">
			                    </div>
			                </div>
			                <div class="box-footer">
			                  <button class="btn btn-danger"><a href='#' style="color: white;">Bloquer</a></button>
			                  <button type="submit" class="btn btn-success">Publier</button>
			                </div>
			            </form>
                        </div>
                        <hr>
                        <h3>Les mentors</h3>
	                	@if($mentors)
	                		<ul>
	                			@foreach($mentors->all() as $mentor)
	                			<li><a href="#" id="select_mentor" data-id="{{$mentor->id}}">{{ $mentor->nom }}</a></li>
	                			@endforeach
	                		</ul>
	                	@else
	                	@endif
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

@section('formulaire')
<div class="modal fade" id="mentorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="exampleModalLabel">CV du candidat</h4>
    </div>
    
    <div class="modal-body">
    	<div class="card">
             <div class="card-header text-center">
               <div id="mentor_avt"></div>
               <h4 id="nom" style="font-weight: bold;"></h4>
               <p id="profession"></p>
               <p>@Enginnova</p>
             </div>
             <div class="card-body">
               <p class="text-center" id="mentor_desc"></p>
             </div>
      </div> 
    </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>  
  </div> 
  </div>
  </div>
@endsection