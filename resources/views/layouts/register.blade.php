@extends('layouts_home.master')
@section('content')
  	<div id="main">
		<div class="container container-main">
			<div class="small-header">
				<h1>Join Us</h1>
			</div>
			<div class="row login">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
					<div class="form-group">
						<input type="radio" id="ranker" name="type" value="ranker" checked /> Ranker
						<input type="radio" id="business" name="type" value="business" /> Business Owner/Manager
					</div>
					<form id="register_rank" class="forms active" action="#" method="post">
						<h2>rank</h2>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control input-lg" name="inputUsername"  placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon">@</span>
								<input type="email" class="form-control input-lg" name="inputEmail" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control input-lg" name="inputPassword"  placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control input-lg" name="inputConfirmPassword" placeholder="Confirm Password">
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-custom btn-lg btn-block">Join</button>
						</div>
					</form>


					<form id="register_business" class="forms hidden" action="#" method="post">
						<h2>Location</h2>
						<div class="location">
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control input-lg" name="state"  placeholder="State">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control input-lg" name="city"  placeholder="City">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control input-lg" name="address"  placeholder="Address">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control input-lg" name="zipcode"  placeholder="Zip code">
								</div>
							</div>
						</div>
						<h2>Business Details</h2>
						<div class="infomation">
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control input-lg" name="inputUsername"  placeholder="Username">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon">@</span>
									<input type="email" class="form-control input-lg" name="inputEmail"  placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
									<input type="password" class="form-control input-lg" name="inputPassword"  placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
									<input type="password" class="form-control input-lg" name="inputConfirmPassword"  placeholder="Confirm Password">
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-custom btn-lg btn-block">Join</button>
						</div>
					</form>
				</div>
			</div>
			<div class="small-header"> Have an Account ? <a href="{{route('login')}}"><b>Login</b></a> </div>
		</div>
	</div>

@endsection
@section('script')
	<script type="text/javascript">
		
		$(document).on('input','input[name=type]',function(){
			var val = $(this).val();
			if(val == 'business'){
				$('#register_business').removeClass('hidden').addClass('active');
				$('#register_rank').removeClass('active').addClass('hidden');
			}else{
				$('#register_rank').removeClass('hidden').addClass('active');
				$('#register_business').removeClass('active').addClass('hidden');
			}
		});



	</script>

@endsection