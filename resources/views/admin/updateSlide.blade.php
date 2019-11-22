@extends('layouts.admin')

@section('titre')
    Administration - Slider update
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
                        	<h3>Mise à jour du slide</h3>
                        	<form role="form" action='{{ url("admin/slider-update/{$slide->id}") }}' method="POST">
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
			                      <label for="titre">Titre 1</label>
			                      <input type="text" required="required" maxlength="100" class="form-control" id="exampleInputEmail1" placeholder="Titre 1" name="titre_1" value="{{$slide->titre_1}}">
			                    </div>
			                    <div class="form-group">
			                      <input type="text" required="required" maxlength="100" class="form-control" id="exampleInputEmail1" placeholder="Titre 2" name="titre_2" value="{{$slide->titre_2}}">
			                    </div><br>
			                    <div class="form-group">
			                      <label for="contenu">Contenu</label>
			                        <textarea class="form-control"  id="editor1" name="contenu" rows="10" cols="80">
			                                            <?php echo $slide->contenu; ?>
			                        </textarea>
			                    </div>
			                </div>
			                <div class="box-footer">
			                  <button class="btn btn-danger"><a href='{{ url("admin/delete-slide/{$slide->id}") }}' style="color: white;">Bloquer</a></button>
			                  <button type="submit" class="btn btn-success">Mettre à jour</button>
			                </div>
			            </form>
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

