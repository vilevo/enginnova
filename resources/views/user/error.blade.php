@extends('layouts.app')

@section('titre')
	erreur
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Error</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('user/home') }}"><i class="fa fa-home"></i> Home</a></li>            
        <li class="active" style="color: gold;">Une erreur s'est produite</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
<div class="container">
	<div class="row">
		<h3>{{ $message }}</h3>
	</div>
</div>
@endsection

@section('footer')

@endsection
