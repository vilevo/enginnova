@extends('layouts.admin')

@section('titre')
    Enginnova Community - espace d'administration
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
                        <h3>Traitements des projets freelance</h3>
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
                    	<h3>Activer le projet</h3><br>
                    	<h4>{{$freelance_projet->name}}</h4>
                    	<h4>{{$freelance_projet->email}}</h4>
			          <form role="form" action='{{ url("admin/activer-freelanceProjet/{$freelance_projet->id_fprojet}") }}' method="POST">
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
			                      <input type="text" required="required" maxlength="100" class="form-control" id="exampleInputEmail1" placeholder="Titre de votre projet" name="titre_projet" value="{{$freelance_projet->titre_projet}}">
			                    </div>
			                    <div class="input-group">
			                      <input type="text" required="required" size="30" class="form-control" id="exampleInputEmail1" placeholder="100.000" name="prix" value="{{$freelance_projet->prix}}">
			                      <span class="input-group-addon">FCFA</span>
			                    </div><br>
			                    <div class="form-group">
			                      <label for="contenu">Rédigez votre projet</label>
			                        <textarea class="form-control"  id="editor1" name="contenu" rows="10" cols="80">
			                                            <?php echo $freelance_projet->contenu ; ?>
			                        </textarea>
			                    </div>
			                    <div class="form-group">
			                      <label for="categorie">Catégorie</label>
			                      <select class="form-control" id="exampleInputEmail1" name="categorie">
			                        @if(count($categories) > 0)
			                        	<option value="{{ $freelance_projet->categorie }}" selected="">{{ $categorie_projet->name }}</option>
			                          @foreach($categories->all() as $categorie)
			                            <option value="{{ $categorie->id_categorie }}">{{ $categorie->name }}</option>
			                          @endforeach
			                        @endif
			                      </select>
			                    </div>
			                </div>
			                <div class="box-footer">
			                  <button class="btn btn-danger"><a href='#' style="color: white;">Bloquer</a></button>
			                  <button type="submit" class="btn btn-success">Activer</button>
			                </div>
			            </form>
			            <hr>
			            <h3>Booster le projet</h3>
			            @if(!empty($boost_projet))
			            <table class="table table-bordered table-striped table-hover">
			            	<thead>
								<tr>
									<td>N°</td>

									<td>Désignation</td>

									<td>date enregistrement</td>

									<td>debut</td>

									<td>fin</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{$boost_projet->id}}</td>

									<td>{{$boost_projet->name}}</td>

									<td>{{date('d/m/Y',strtotime($boost_projet->created_at))}}</td>

									<td>{{$boost_projet->debut}}</td>

									<td>{{$boost_projet->fin}}</td>
								</tr>

							</tbody>
			            </table>
			            <form method="POST" action='{{ url("admin/activer-boosterProjet/{$boost_projet->id_fprojet}") }}'>
			            	{{csrf_field()}}

			                  @if(count($errors) > 0)
			                    @foreach($errors->all() as $error)
			                      <div class="alert alert-danger">
			                        {{$error}}  
			                      </div>
			                    @endforeach
			                  @endif
			                <div class="form-group">
			                	<label>Debut</label>
								<input type="date" name="debut" class="form-control">
							</div>
							<div class="form-group">
								<label>Fin</label>
								<input type="date" name="fin" class="form-control">
							</div>
							<input type="submit" name="send">
						</form>
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

