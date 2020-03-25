@extends('layouts_home.master')
@section('content')
  	<div id="main">
		<div class="container">
			<div class="small-header">
				<h1>Log in to Rank Eats</h1>
				@if (session()->has('message'))
				<p class="alert alert-success">{{ session('message') }}</p>
				@endif
			</div>
			<div class="row login">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
					<div class="form-group text-center">
						<div class="user-logo"> <img src="images/avatar.jpg" class="img-circle" width="150" height="150" alt="user login"> </div>
					</div>
					<form id="formLogin" class="forms" action="{{route('postLogin')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="form-group">
							<input type="text" class="form-control input-lg" name="email" id="inputUsername" placeholder="Username">
							<span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg" name="password" id="inputPassword" placeholder="Password">
							<span class="bg-danger color-palette">{{$errors -> first('password')}}</span>
						</div>
						
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
							<span class="bg-danger color-palette">{{$errors -> first('g-recaptcha-response')}}</span>
						</div>

						<div class="form-group last-row">
							<label class="checklabel"><input type="checkbox" name="logged">keep me logged-in </label>
							<a href="{{route('forgot_password')}}" class="pull-right">Forgot Password?</a> 
						</div>

						<div class="form-group">
							<button type="submit" id="submitLogin" class="btn btn-custom btn-lg btn-block">Login</button>
						</div>

					</form>
				</div>
			</div>
			<div class="small-header"> New here ? <a href="{{route('register')}}"><b>Join Us</b></a> </div>
		</div>
	</div>

@endsection