@extends('inc.template')

@section('titre')
	Vérification de votre email
@endsection

@section('header')

@endsection

@section('content')
<div class="mu-page-breadcrumb-area">
    <h2 class="pull-left">Activation du compte</h2>
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('acceuil') }}"><i class="fa fa-home"></i> Home</a></li>            
        <li class="active" style="color: gold;">Vérification de votre email</li>
    </ol>
</div>
@endsection

@section('layout_main_content')
<div class="container">
	<div class="row">
		<h3>Veuillez confirmer votre email pour activer votre compte</h3>
	</div>
</div>
@endsection

@section('footer')

@endsection
