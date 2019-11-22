@extends('inc.template')

@section('titre')
     Enginnova Learning program - Connexion
@endsection

@section('header')

@endsection

@section('layout_main_content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="panel panel-default" style="background-color: #fff;">
                <div class="panel-heading" style="background-color: #337AB7; color: white;"><b>Connexion</b></div>

                <div class="panel-body">

                    <form action="{{ route('login') }}" method="POST">
                         {{ csrf_field() }}
                      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                         @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                         @endif
                      </div>
                      <div class="row">
                        <div class="col-xs-8">
                          <div class="checkbox icheck">
                            <label>
                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                        </div>
                        <!-- /.col -->
                      </div>
                    </form>

                    <!-- <div class="social-auth-links text-center">
                      <p>- OR -</p>
                      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                        Facebook</a>
                      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                        Google+</a>
                    </div> -->
                    <!-- /.social-auth-links -->

                    <a href="{{ route('password.request') }}">Mot de passe oublié</a><br>
                    <a href="{{ route('register') }}" class="text-center">Crée un compte</a>

                  </div>
                  <!-- /.login-box-body -->
             </div>
                <!-- /.login-box -->           
        </div>
    </div>
</div>
@endsection

@section('footer')

@endsection

