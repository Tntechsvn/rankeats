@extends('layouts_home.master')
@section('content')
  	<div id="main">
		<div class="container">
			<div class="small-header p-t-30">
				<h1>Join Us</h1>
			</div>
			<div class="row login">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
					<div class="form-group">
						<input type="radio" id="ranker" name="type" value="ranker" checked /> Ranker
						<input type="radio" id="business" name="type" value="business" /> Business Owner/Manager
					</div>
					<form id="register_rank" class="forms active" action="{{route('postSignUp')}}" method="post">
						@csrf
						<input type="hidden" name="type" value="1"/>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control input-sm" name="name"  placeholder="Username" value="{{old('name')}}">
								<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon">@</span>
								<input type="email" class="form-control input-sm" name="email" placeholder="Email" value="{{old('email')}}">
								<span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control input-sm" name="password"  placeholder="Password">
								<span class="bg-danger color-palette">{{$errors -> first('password')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control input-sm" name="re_password" placeholder="Confirm Password">
								<span class="bg-danger color-palette">{{$errors -> first('re_password')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
							<span class="bg-danger color-palette">{{$errors -> first('g-recaptcha-response')}}</span>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-custom btn-lg btn-block">Join</button>
						</div>
					</form>


					<form id="register_business" class="forms hidden" action="{{route('postSignUp')}}" method="post">
						@csrf
						<input type="hidden" name="type" value="2"/>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><i class="fas fa-location-arrow"></i></span>
								<input class="form-control " type="text" name="" value="1">
								<button><i class="fas fa-minus"></i></button>
								<button><i class="fas fa-plus"></i></button>
							</div>
							<span class="bg-danger color-palette">{{$errors -> first('address')}}</span>
						</div>
						<div class="location">
							<h4>Business Location</h4>
							<div class="form-group">
								<input type="text" class="form-control " name="state"  placeholder="State" value="">
								<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="city" placeholder="City" value="">
								<span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
								
							</div>
							<div class="form-group">
								<input type="text" class="form-control " name="address"  placeholder="Address">
								<span class="bg-danger color-palette">{{$errors -> first('password')}}</span>
							</div>
							<div class="form-group">
								<input type="text" class="form-control " name="zipcode" placeholder="Zip Code">
								<span class="bg-danger color-palette">{{$errors -> first('re_password')}}</span>
							</div>
						</div>
						<div class="detail">
							<h4>Business Details</h4>
							<div class="form-group">
								<input type="text" class="form-control " name="name"  placeholder="Business Name" value="">
								<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
							</div>
						</div>
						<div class="owner-manager">
							<h4>Owner/Manager Details</h4>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control" name="firstname"  placeholder="First Name" value="">
									<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control" name="lastname"  placeholder="Last Name" value="">
									<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
								</div>
							</div>
							<div class="form-group">
								
								<input id="owner" type="checkbox" class="" name="owner"  placeholder="Last Name" value="">
								<label for="owner">Owner</label>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-custom btn-lg btn-block">Join</button>
						</div>
					</form>

					{{-- <form id="register_business" class="forms hidden" action="{{route('postSignUp')}}" method="post">
						@csrf
						<input type="hidden" name="type" value="2"/>
						<div class="location form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
								<input type="text" name="search_rs" id="search_rs" class="form-control input-sm"/>
								<input  type="hidden" id="longitude" name="longitude">
								<input  type="hidden" id="latitude" name="latitude">
								<input  type="hidden" id="address" name="address">
								<input  type="hidden" id="city" name="city">
								<input  type="hidden" id="state" name="state">
								<input  type="hidden" id="country" name="country">
							</div>
							<span class="bg-danger color-palette">{{$errors -> first('address')}}</span>
						</div>
						<div class="infomation">
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control input-sm" name="name"  placeholder="Username" value="{{old('name')}}">
									<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon">@</span>
									<input type="email" class="form-control input-sm" name="email" placeholder="Email" value="{{old('email')}}">
									<span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
									<input type="password" class="form-control input-sm" name="password"  placeholder="Password">
									<span class="bg-danger color-palette">{{$errors -> first('password')}}</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
									<input type="password" class="form-control input-sm" name="re_password" placeholder="Confirm Password">
									<span class="bg-danger color-palette">{{$errors -> first('re_password')}}</span>
								</div>
							</div>
							<div class="form-group">
								<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
								<span class="bg-danger color-palette">{{$errors -> first('g-recaptcha-response')}}</span>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-custom btn-lg btn-block">Join</button>
						</div>
					</form> --}}
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

<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', initialize);
  function initialize(){
    var search = document.getElementById('search_rs');
    var autocomplete = new google.maps.places.Autocomplete(search);
    google.maps.event.addListener(autocomplete, 'place_changed', function(){
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      document.getElementById('address').value = place.formatted_address;
      document.getElementById('longitude').value = place.geometry.location.lng();
      document.getElementById('latitude').value = place.geometry.location.lat();
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        switch (addressType) {
          case 'locality':
          var city = place.address_components[i].long_name;
          break;
          case 'administrative_area_level_1':
          var state = place.address_components[i].long_name;
          break;
          case 'country':
          var country = place.address_components[i].long_name;
          break;
        }
      }
      document.getElementById('city').value = city;
      document.getElementById('state').value = state;
      document.getElementById('country').value = country;     
    });
  };
</script>
@endsection