@extends('layouts.app')

@section('titre')
	{{ Auth::user()->name }} - votre parcours
@endsection

@section('header')

@endsection

@section('layout_main_content')
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-contact-area">
          <!-- start title -->
          <div class="mu-title">
            <h5>@if (session('info'))
                  <div class="alert alert-success">
                    {{ session('info') }}
                  </div>
                @endif</h5>
          </div>
          <!-- end title -->
          <!-- start contact content -->
          <div class="mu-contact-content">


            <div class="row">
              <div class="col-md-6">
                <div class="mu-contact-left">
                 
                </div>
              </div>
              <div class="col-md-6">
                <div class="mu-contact-right">
                  <h2 align="center">Votre parcours</h2>
                  <h2 align="center">Vos points</h2>
                </div>
              </div>
            </div>
          </div>
          <!-- end contact content -->
         </div>
       </div>
     </div>
   </div>
@endsection

@section('footer')

@endsection
