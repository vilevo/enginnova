@extends('layouts.app')

@section('titre')
 Enginnova Freelance - devenez freelance et gagné de l'argent 
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Freelance</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('user/freelance') }}">Projets Freelance</a></li>            
        <li class="active" style="color: gold;">Meilleurs projets freelance</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
<!-- start course content container -->
                <div class="container">
                  <div class="row">
                    <div class="col-md-9">
                       <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #ffffff;">
                        <h3>Tous les meilleurs projets</h3>
                        @if (session('info'))
                            <h5>
                            <div class="alert alert-success">
                              {{ session('info') }}
                            </div></h5>
                          @endif
                        <a href="{{ url('user/add-projet') }}" class="pull-right"><h5 class="btn btn-primary"><i class="fa fa-plus"></i> Publier un projet</h5></a><br>
                          <div class="forq" style="margin-top: 50px;">
                          <form action="#" method="POST" class="sidebar-form">
                            {{csrf_field()}}
                            <div class="input-group">
                              <input type="text" name="questions_titre" id="questions_titre" class="form-control" placeholder="Rechercher une question" style="width: 350px;">
                            </div>
                          </form>
                          </div>
                          <div id="questions_list"></div>
                      </div>
                      <div class="panel-body">
                      @if(count($freelance_projets) > 0)
                        @foreach($freelance_projets->all() as $freelance_projet)
                          <div class="box box-widget">
                            <div class="box-header with-border">
                              <div class="user-block">
                                <?php $id_fprojet=$freelance_projet->id_fprojet*1000; ?>
                                <span style="font-size: 16px; font-weight: 600;"><a href='{{ url("user/freelance-projet/{$id_fprojet}") }}'>{{$freelance_projet->titre_projet}}</a></span><br>
                                <span style="color: #999; font-size: 13px;">Posté le - {{date('d F Y',strtotime($freelance_projet->created_at))}}</span>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <!-- post text -->
                              <p><?php echo substr($freelance_projet->contenu, 0,145); ?>...</p>
                              <!-- Social sharing buttons -->
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-users"></i> <b>{{$freelance_projet->reponses}} Interessés</b></button>
                              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-money"></i> <b>{{$freelance_projet->prix}}</b></button>
                            </div>
                            <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                        @endforeach
                        {{ $freelance_projets->links() }}
                      @else
                        <div class="alert alert-danger"><h5>Pas de projets disponible pour le moment.</h5></div>
                      @endif
                    </div>
                  </div>
                </div>
                    <div class="col-md-3">
                          <!-- start sidebar -->
                <aside class="mu-sidebar">
                 
                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar">
                    <div class="box box-primary">
                      <div class="box-header">
                        <i class="fa fa-sticky-note"></i>

                        <h3 class="box-title">Types Projets</h3>
                      </div>
                      <div class="box-body">
                        <ul class="mu-sidebar-catg">
                          @if(count($categories)>0)
                                    @foreach($categories->all() as $categorie)
                                      <?php $id = $categorie->id_categorie*1000; ?>
                                      <li><a href='{{ url("user/projets-categorie/{$id}") }}' style="color: #337AB7;"><span class="fa fa-angle-double-right"></span> {{$categorie->name}}</a></li>
                                    @endforeach
                                  @endif
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!-- end single sidebar -->
                </aside>
                <!-- / end sidebar -->
                    </div>
                  </div>
                </div>
@endsection

@section('footer')

@endsection
