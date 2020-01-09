@extends('inc.template')

@section('titre')
	Enginnova - Utilisateurs
@endsection

@section('header')
<!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb" style="background-color: #337AB7;">
   <div class="container">
     <div class="row" style="background-color: #337AB7;">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2 class="pull-left">Utilisateurs</h2>
           <ol class="breadcrumb pull-right">
            <li><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i> Acceuil</a></li>            
            <li class="active" style="color: gold">Les Utilisateurs</li>
          </ol>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End breadcrumb -->
@endsection

@section('layout_main_content')
<div class="container">
	<div class="row">
		<div class="row">
			<div class="col-md-6">
				<div class="forq" style="margin-top: 50px;">
                    <form action="#" method="POST">
                            {{csrf_field()}}
                        <div class="input-group">
                            <input type="text" name="enguser_name" id="enguser_name" class="form-control" placeholder="Rechercher un utilisateur" style="width: 350px;">
                        </div>
                    </form>
                </div>
                <div id="users_list"></div><br>
			</div>
		</div>
		
		@if($users)
			@foreach($users->all() as $user)
				<div class="col-sm-4">
				<!-- Widget: user widget style 1 -->
		          <div class="box box-widget widget-user">
		            <!-- Add the bg color to the header using any of the bg-* classes -->
		            <div class="widget-user-header bg-aqua-active" style="background: rgb(0, 167, 208);">
		              <h3 class="widget-user-username" style="color: white;">{{$user->name}}</h3>
		              <h5 class="widget-user-desc" style="color: white;">{{$user->profession}}</h5>
		            </div>
		            <div class="widget-user-image">
		              <img class="img-thumbnail img-responsive" height="150" width="150" src='{{ asset("avatars/{$user->avatar}") }}' alt="User Avatar">
		            </div>
		            <div class="box-footer">
		              <div class="row">
		              	<div class="col-sm-12">
		              		<p>{{$user->description}}</p>
		              		<?php $id_user=$user->id*1000; ?>
		              		<a href='{{ url("user/profil/{$id_user}") }}' class="label label-primary pull-right"><i class="fa fa-eye"></i> Voir le profil</a>
		              	</div>
		              </div>
		              <!-- /.row -->
		            </div>
		          </div>
		          <!-- /.widget-user -->
		        </div>
        	@endforeach
        @endif
	</div>
</div>
@endsection

@section('footer')

@endsection
