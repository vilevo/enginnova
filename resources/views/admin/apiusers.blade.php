@extends('layouts.admin')

@section('titre')
    Administration - API - Users
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
                        <h3>Liste des serveurs connectes</h3>
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
                        
                        <a class="pull-right" type="button" data-toggle="modal" data-target="#add-api-user"><h5 class="label label-info">Ajouter un serveur</h5></a>

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
                        {{-- <h4>{{$cv->name}}</h4>
                        <h4>{{$cv->email}}</h4>
                        <a href='{{ asset("cv/$cv->cv")}}'><img src='{{ asset("cv/$cv->cv") }}' alt="cv image" width="50%" height="50%"></a><br><br>
                        <button class="btn btn-danger"><a href="" style="color: white;">Bloquer</a></button>
                        <button class="btn btn-success"><a href='{{ url("admin/activer-cv/$cv->id_cv") }}' style="color: white;">Activer</a></button> --}}

                        <ul class="list-group list-unstyled">
                          @forelse ($users as $item)
                            <li class="list-group-item">
                              <p>Server: {{$item->username}}</p>
                              <p>Adress: {{$item->address}}</p>
                              <p class="text-primary">Token: {{$item->token}}</p>

                            <a class="btn btn-danger" href="{{url('/admin/api/users/' . $item->id . '/refresh')}}" role="button">Rafraichir</a>
                            </li>
                              
                       
                          @empty
                            <li>
                            
                              <p> Aucun serveur connecter</p>

                                <div>
                                  <button class="btn btn-primary center" type="button" data-toggle="modal" data-target="#add-api-user">Ajouter un serveur</button>
                                  
                                </div>
                            </li>
                          @endforelse
                         
                        </ul>

                    </div>
                </div>
        </div>
        <div class="col-md-3">
            
        </div>
    </div>
</div>
@endsection

@push('modals')
    <div id="add-api-user" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered small" role="document">
        {{-- <div class="modal-header">
          <h5 class="modal-title" id="my-modal-title">Ajouter un serveur</h5>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> --}}

      <form method="post" action="/admin/api/users/">
          <div class="modal-content">
            <div class="modal-body">
              {{ csrf_field() }}
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Nom du serveur</span>
                </div>
                <input class="form-control" type="text" name="username" placeholder="Serveur 1" aria-label="Serveur">
                
              </div>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Adresse</span>
                </div>
                <input value="https://" class="form-control" type="text" name="address" placeholder="https://" aria-label="Serveur">
                
              </div>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Mot de passe</span>
                </div>
                <input class="form-control" type="text" name="password" placeholder="Supermotdepasse" aria-label="Serveur">
                
              </div>

              

            </div>
          </div>

          <div class="modal-footer bg-white">
            <button type="submit" class="btn btn-primary m">Valider</button>
          </div>
        </form>

         
      </div>
    </div>
@endpush

@section('footer')

@endsection

