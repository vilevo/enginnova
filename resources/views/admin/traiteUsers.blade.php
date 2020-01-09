@extends('layouts.admin')

@section('titre')
    Administration - Gestion mentor
@endsection

@section('header')

@endsection

@section('layout_main_content')
<div class="mu-course-container mu-blog-single">
    <div class="row">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-8">
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
                        
                             @if($users)
                            <?php $i=0; ?>
                                <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <td>N°</td>
                                                <td>User</td>
                                                <td>Email</td>
                                                <td>Telephone</td>
                                                <td>Profession</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                @foreach($users->all() as $user)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->telephone}}</td>
                                            <td>{{$user->profession}}</td>
                                            <td>Action</td>
                                        </tr>
                                @endforeach
                                        </tbody>
                                    </table>
                            {{ $users->links() }}
                        @endif
                    
                    </div>
                </div>
        </div>
        <div class="col-md-2">
            
        </div>
    </div>
</div>
@endsection

@section('footer')
	
@endsection
