@extends('inc.template')

@section('titre')
	Enginnova - Mentors
@endsection

@section('header')
<!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb" style="background-color: #337AB7;">
   <div class="container">
     <div class="row" style="background-color: #337AB7;">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2 class="pull-left">Mentors</h2>
           <ol class="breadcrumb pull-right">
            <li><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i> Acceuil</a></li>            
            <li class="active" style="color: gold">Les Mentors</li>
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
		@if($mentors)
			@foreach($mentors->all() as $mentor)
				<div class="col-sm-4">
				<!-- Widget: user widget style 1 -->
		          <div class="box box-widget widget-user">
		            <!-- Add the bg color to the header using any of the bg-* classes -->
		            <div class="widget-user-header bg-aqua-active" style="background: rgb(0, 167, 208);">
		              <h3 class="widget-user-username" style="color: white;">{{$mentor->nom}}</h3>
		              <h5 class="widget-user-desc" style="color: white;">{{$mentor->profession}}</h5>
		            </div>
		            <div class="widget-user-image">
		              <img class="img-thumbnail img-responsive" height="150" width="150" src="https://enginnova.s3-us-west-2.amazonaws.com/<?php echo $mentor->photo; ?>" alt="User Avatar">
		            </div>
		            <div class="box-footer">
		              <div class="row">
		              	<div class="col-sm-12">
		              		<p>{{$mentor->about}}</p>
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
