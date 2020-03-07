@extends('layouts_home.master')
@section('content')
  	<div id="main">
		<div class="container container-main">
			<div class="small-header">
				<h1>Join Us</h1>
			</div>
			<div class="row login">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
					<div id="output-register"></div>
					<form id="formRegister" class="forms" action="submit_register.php" method="post">
						<div class="form-group">
							<input type="radio" name="type" value="ranker" checked /> Ranker
							<input type="radio" name="type" value="business" /> Business Owner/Manager 
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control input-lg" name="inputUsername" id="inputUsername" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon">@</span>
								<input type="email" class="form-control input-lg" name="inputEmail" id="inputEmail" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control input-lg" name="inputPassword" id="inputPassword" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control input-lg" name="inputConfirmPassword" id="inputConfirmPassword" placeholder="Confirm Password">
							</div>
						</div>
						<div class="form-group">
							<button type="submit" id="submitRegister" class="btn btn-custom btn-lg btn-block">Join</button>
						</div>
					</form>
				</div>
			</div>
			<div class="small-header"> Have an Account ? <a href="{{route('login')}}"><b>Login</b></a> </div>
		</div>
	</div>

@endsection