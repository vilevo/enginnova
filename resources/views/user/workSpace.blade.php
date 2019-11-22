@extends('layouts.app')

@section('titre')
Enginnova Freelance - work space
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Freelance</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('user/freelance') }}">Projets Freelance</a></li>            
        <li class="active" style="color: gold;">Work Space</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
   <div class="container">
   	<div class="row">
   		<div class="col-md-3">
   			
   		</div>
   		<div class="col-md-6">
   			@if (session('welcome'))
		        <div class="alert alert-success">
		        	<h5>{{ session('welcome') }}</h5>
		        </div>
		    @endif
   		</div>
   		<div class="col-md-3">
   			
   		</div>
   	</div>
     <div class="row"> 
     	<div class="col-md-3">
     		<?php $id_user=$fprojet->id_user*1000; 
				 $id_fprojet=$fprojet->id_fprojet*1000; 
							    ?>
     		@if($fprojet->id_user == Auth::user()->id)
     		<div class="box box-primary">
	          	<div class="box-header">
	              <i class="fa fa-plus"></i>
	              <h3 class="box-title">Ajouter une tache</h3>
	              @if (session('info'))
		            <h5>
		            <div class="alert alert-success">
		                {{ session('info') }}
		            </div></h5>
		          @endif
            	</div>
            	<div class="box-body">
            		<form role="form" action='{{ url("user/add-teamplanning/$id_workspace") }}' method="POST">
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
		                        <label for="titre">Nom de la tache</label>
		                        <input type="text" required="required" maxlength="70" class="form-control" id="exampleInputEmail1" name="titre">
		                      </div>
		                      <div class="form-group">
		                      	<label for="debut">Début de la tache</label>
		                        <input type="date" required="required"  class="form-control" id="exampleInputEmail1" name="debut">
		                      </div><br>
		                      <div class="form-group">
		                        <label for="fin">Fin de la tache</label>
		                         <input type="date" required="required"  class="form-control" id="exampleInputEmail1" name="fin">
		                      </div>
		                </div>
		                <div class="box-footer">
		                    <button type="submit" class="btn btn-primary">Ajouter la tache</button>
		                </div>
            		</form>
            	</div>
            </div>
     		@endif	
       	</div>
      <!-- start form -->
       <div class="col-md-9">
        <div class="panel panel-default">
          <div class="panel-heading" style="background-color: #ffffff;">
          	@if($fprojet->id_user == Auth::user()->id)
          	<a href='{{ url("user/end-projet/$id_fprojet/$id_workspace")}}' class="pull-right"><span class="btn btn-success"><b>Projet terminé</b></span></a>
          	@endif
          	<h3><i class="fa fa-calendar"></i> Gestion du planning</h3>
          </div>
          <div class="panel-body">
          	<h4></h4>
          	<!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="fa fa-clipboard"></i>
              <h3 class="box-title">Les taches en cours</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
              	@if(!empty($taches))
              		@foreach($taches->all() as $tache)
		                <li style="border-radius: 2px;
						  padding: 10px;
						  background: #f4f4f4;
						  margin-bottom: 2px;
						  border-left: 2px solid #e6e7e8;
						  color: #444;">
		                  <!-- drag handle -->
		                  <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                  </span>
		                  <!-- todo text -->
		                  <span class="text" style="color: #337AB7;"><b>{{$tache->titre}}</b></span>
		                  <!-- Emphasis label -->
		                  @if($tache->valider == true)
		                  	<small class="label label-success"><i class="fa fa-check-circle-o"></i> Fait</small>
		                  @else
		                  	<small class="label label-danger"><i class="fa fa-thumbs-down"></i> Pas fait</small>
		                  @endif
		                  <!-- General tools such as edit or delete-->
		                  @if($fprojet->id_user == Auth::user()->id)
		                  <div class="tools">
		                    <a href='{{ url("user/delete-tache/$tache->id/$fprojet->id_fprojet")}}'><i class="fa fa-trash-o"></i></a>
		                    <a href='{{ url("user/tache-faite/$tache->id/$fprojet->id_fprojet")}}'><i class="fa fa-check-circle-o">Tache faite</i></a>
		                  </div>
		                  @endif
		                </li>
		            @endforeach
                @else
                	<div class="" id="team_discussion">
	            	<h5 class="alert alert-danger">Aucune tache en cours. Veuillez ajouter des taches à votre planning.</h5>
	            </div>
                @endif
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          	@if (session('info_p'))
		            <h5>
		            <div class="alert alert-success">
		                {{ session('info_p') }}
		            </div></h5>
		    @endif
            @if(!empty($calendar_details))
            	 {!! $calendar_details->calendar() !!}
            @else
            	<div class="" id="team_discussion">
	            	<h5 class="alert alert-danger">Aucune tache. Veuillez ajouter des taches à votre planning.</h5>
	            </div>
            @endif
            <hr>
          </div>
        </div>
        
      </div>    
    </div>
       <div class="row">
       		<div class="col-md-6">
       		    <div class="box box-primary">
	          	<div class="box-header">
	              <i class="fa fa-users"></i>

	              <h3 class="box-title">L'équipe</h3>
            	</div>
            	<div class="box-body">
            		@if(!empty($fprojet))
            			<div class="media">
            					<span class="pull-right" style="color: #337AB7;"><b>Chef projet</b></span>
								<div class="media-left">
							        <a href="#"><img class="media-object" src='{{ asset("avatars/{$fprojet->avatar}") }}' width="50" height="50" alt="User profile picture"></a>
							    </div>
							    <div class="media-body">
							        <h4 class="media-heading"><a href='{{ url("user/profil/{$id_user}") }}'>{{ $fprojet->name }}</a></h4>
							        <h6>{{$fprojet->profession}}</h6>
							    </div>
							    <hr>
							</div>
            		@endif
            		@if(!empty($experience_users))
				        @foreach($experience_users->all() as $experience_user)
							<div class="media">
							    <?php $id_user=$experience_user->id_user*1000; 
							          $id_fprojet=$experience_user->id_fprojet*1000; 
							    ?>
								<div class="media-left">
							        <a href="#"><img class="media-object" src='{{ asset("avatars/{$experience_user->avatar}") }}' width="50" height="50" alt="User profile picture"></a>
							    </div>
							    <div class="media-body">
							        <h4 class="media-heading"><a href='{{ url("user/profil/{$id_user}") }}'>{{ $experience_user->name }}</a></h4>
							        <h6>{{$experience_user->profession}}</h6>
							    </div>
							    <hr>
							</div>
						@endforeach
					@else
						<div class="" id="team_discussion">
			            	<h5 class="alert alert-danger">Il n'y a auncun participant pour le moment.</h5>
			            </div>
		            @endif
            	</div>
            </div>      
      	  </div>  
       		<div class="col-md-6">
	      	
	          	<div class="box box-primary">
	          	<div class="box-header">
	              <i class="fa fa-comments-o"></i>
	              <h3 class="box-title">Discussions</h3>
	              @if (session('info'))
		            <h5>
		            <div class="alert alert-success">
		                {{ session('info') }}
		            </div></h5>
		          @endif
            	</div>
            	<div class="box-body chat" id="chat-box">
            		<div class="item">
			            @if(!empty($chats))
			            	 
		                          @foreach($chats as $chat)
		                          <?php $id_user=$chat->id_user*1000; ?>
		                          @if($chat->id_user != Auth::user()->id)
		                            <div class="chatMsg" style="
						            	border: 2px solid #dedede;
										background-color: #ffffff;
										border-radius: 5px;
										padding: 10px;
										margin: 10px 0;
						            ">
						            	<span style="color: #337AB7; font-weight: bold;">{{$chat->name}}</span>
						            	<a href='{{ url("user/profil/{$id_user}") }}'><img src='{{ asset("avatars/{$chat->avatar}") }}' alt="Avatar" style="
						            		float: left;
											max-width: 60px;
											width: 100%;
											margin-right: 20px;
											border-radius: 50%;
						            	"></a>
						            	<p>{{$chat->message}} <br>
						            	 <span style="color: gray;">{{date('d F Y, H:i',strtotime($chat->created_at))}}</span>
						            	</p>
						            	
			            			</div>
			            		@endif
			            		@if($chat->id_user == Auth::user()->id)
			            		<div class="chatMsg darker" style="
					            	border: 2px solid #dedede;
									border-color: #ccc;
				  					background-color: #ddd;
									border-radius: 5px;
									padding: 10px;
									margin: 10px 0;
					            ">
					            	<a href='{{ url("user/profil/{$id_user}") }}'><img src='{{ asset("avatars/{$chat->avatar}") }}' alt="Avatar" style="
					            		float: right;
										margin-left: 20px;
										margin-right: 0;
										max-width: 60px;
										width: 100%;
										border-radius: 50%;
					            	"></a>
					            	<p>{{$chat->message}}</p>
					            	<span style="color: #999;">{{date('d F Y, H:i',strtotime($chat->created_at))}}</span>
					            </div>
					            @endif
		                       @endforeach
		                    {{$chats->links()}}
			            @else
			            <div class="" id="team_discussion">
			            	<h5 class="alert alert-danger">Aucune discussion. Lancez une discussion</h5>
			            </div>
			            @endif
	        	</div>
	            <?php $id_workspace = $workspace->id; ?>
            	<div class="box-footer">
	            <form role="form" action='{{ url("user/teamchat-add/$id_workspace") }}' method="POST">
	                 {{csrf_field()}}

	                    @if(count($errors) > 0)
	                      @foreach($errors->all() as $error)
	                        <div class="alert alert-danger">
	                          {{$error}}  
	                        </div>
	                      @endforeach
	                    @endif
	                      <div class="input-group">
	                        <input type="text" name="message" class="form-control" placeholder="Ecrivez votre message ici...">
	                        <div class="input-group-btn">
                 				<button type="submit" class="btn btn-success"><i class="fa fa-send"></i></button>
                			</div>
	                      </div>
	            </form>
	        	</div>
	        </div>
	        </div>

      	</div> 
       </div>
       <!-- end form -->
     </div>
   </div>
@endsection
@section('fullcalendar')
 @if(!empty($calendar_details))
	{!! $calendar_details->script() !!}
 @endif
@endsection
@section('footer')
@endsection
