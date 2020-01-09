@extends('layouts.admin')

@section('titre')
    Administration - Edit {{$user->name}}
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
                          <form action="#" method="POST" class="sidebar-form">
                            {{csrf_field()}}
                            <div class="input-group">
                              <input type="text" name="search_user" id="search_user" class="form-control" placeholder="Rechercher une question" style="width: 350px;">
                            </div>
                          </form>
                          </div>
                          <div id="users_list"></div>
                    </div>
                    <div class="panel-body">
                        
                        <div class="card">
				             <div class="card-header text-center">
				               <div><img class="img-thumbnail img-responsive" height="150" width="150" src='{{ asset("avatars/{$user->avatar}") }}'></div>
				               <h4 style="font-weight: bold;">{{$user->name}}</h4>
				               <p>{{$user->profession}}</p>
				               <p>@Enginnova</p>
				             </div>
				             <div class="card-body">
				               <p class="text-center">
				               <strong>Email</strong> : {{$user->email}},
				               <strong>Numéro : </strong> {{$user->telephone}},
				               <strong>Adresse : </strong> {{$user->adresse}}
				           		</p>
				             </div>
				             <?php $user_id=$user->id*1000; ?>
				             <div class="card-footer d-flex justify-content-center">
               					<button class="btn btn-danger pull-left"><a href='{{ url("user/profil/{$user_id}") }}' style="color: white;">Supprimer</a></button>
             				 </div>
				             <div class="card-footer d-flex justify-content-center">
               					<button class="btn btn-primary pull-right"><a href='{{ url("user/profil/{$user_id}") }}' style="color: white;">Voir le profil</a></button>
             				 </div>
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
