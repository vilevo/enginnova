@extends('layouts.admin')

@section('titre')
    Administration - candidats selectionnes
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
                        <div class="projets_encours">
                            <h3>Users selectionnés pour un projet</h3>
                            @if(!empty($manifestations))
                                <ul class="mu-sidebar-catg">
                                    <?php $i =1; ?>
                                @foreach($manifestations->all() as $manifestation)
                                    <li>
                                        <a href='#") }}' style="color: #337AB7;">{{$i++}} {{$manifestation->name}}</a>
                                        <h5>{{$manifestation->email}}</h5>
                                        <h5>{{$manifestation->telephone}}</h5>
                                        <hr>
                                    </li>
                                @endforeach
                                </ul>
                            @else
                                <h6>Aucun candidats selectinés en cours</h6>
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

