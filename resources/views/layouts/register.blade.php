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
						<input type="radio" id="business" name="type" value="business" /> Business Verification
					</div>
					<form id="register_rank" class="forms active" action="{{route('postSignUp')}}" method="post">
						@csrf
						<input type="hidden" name="type" value="1"/>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control" name="firstname"  placeholder="First Name" value="{{old('firstname')}}">
								<span class="bg-danger color-palette">{{$errors -> first('firstname')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control" name="lastname"  placeholder="Last Name" value="{{old('lastname')}}">
								<span class="bg-danger color-palette">{{$errors -> first('lastname')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control input-lg" name="name"  placeholder="Username" value="{{old('name')}}">
								<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon">@</span>
								<input type="email" class="form-control input-lg" name="email" placeholder="Email" value="{{old('email')}}">
								<span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control input-lg" name="password"  placeholder="Password">
								<span class="bg-danger color-palette">{{$errors -> first('password')}}</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control input-lg" name="re_password" placeholder="Confirm Password">
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
						<div class="form-group ">
							<div class="input-group"> <span class="input-group-addon"><i class="fas fa-location-arrow"></i></span>
								<input class="form-control number-location" type="number" name="" value="1">
								<button class="button-number-location button-number-location-plus" ><i class="fas fa-plus"></i></button>
								<button class="button-number-location m-r-10 button-number-location-minus" ><i class="fas fa-minus"></i></button>
							</div>
							<span class="bg-danger color-palette"></span>
						</div>
						<div class="location">
							<h4>Business Location</h4>
							<div class="form-group">
								<select class="form-control select2" name="state" id="name_state">
										<option value=""disabled selected="selected">Select State</option>
										@foreach($state as $data)
										<option value="{{$data->name}}">{{$data->name}}</option>
										@endforeach
								</select>
								<span class="bg-danger color-palette">{{$errors -> first('state')}}</span>
							</div>
							<div class="form-group">
								<select class="form-control select2" name="city" id="id_city" style="width: 100%;">
									<option  value="" disabled selected >Select City</option>
								</select>
								<span class="bg-danger color-palette">{{$errors -> first('city')}}</span>
								
							</div>
							<div class="form-group">
								<input type="text" class="form-control " name="address"  placeholder="Address" value="{{old('address')}}">
								<span class="bg-danger color-palette">{{$errors -> first('address')}}</span>
							</div>
							<div class="form-group">
								<input type="text" class="form-control " name="zipcode" placeholder="Zip Code" value="{{old('zipcode')}}">
								<span class="bg-danger color-palette">{{$errors -> first('zipcode')}}</span>
							</div>
						</div>
						<div class="detail">
							<h4>Business Details</h4>
							<div class="form-group">
								<input type="text" class="form-control " name="name_business"  placeholder="Business Name" value="{{old('name_business')}}">
								<span class="bg-danger color-palette">{{$errors -> first('name_business')}}</span>
							</div>
						</div>
						<div class="owner-manager">
							<h4>Owner/Manager Details</h4>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control" name="firstname"  placeholder="First Name" value="{{old('firstname')}}">
									<span class="bg-danger color-palette">{{$errors -> first('firstname')}}</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control" name="lastname"  placeholder="Last Name" value="{{old('lastname')}}">
									<span class="bg-danger color-palette">{{$errors -> first('lastname')}}</span>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="name" placeholder="Username" value="{{old('name')}}">
								<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
								
							</div>

							<div class="form-group">
								<input type="text" class="form-control" name="email" placeholder="email" value="{{old('email')}}">
								<span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
								
							</div>
							<div class="form-group">
								<input type="password" class="form-control " name="password"  placeholder="password" value="{{old('password')}}">
								<span class="bg-danger color-palette">{{$errors -> first('password')}}</span>
							</div>
							<div class="form-group">
								<input type="password" class="form-control " name="re_password" placeholder="re password" value="">
								<span class="bg-danger color-palette">{{$errors -> first('re_password')}}</span>
							</div>

							<div class="form-group check-role">
								<div class="">
									<input id="owner" type="radio" class="" name="check"  value="owner" checked="checked">
									<label for="owner">Owner</label>
								</div>
								<div class="">
									<input id="manager" type="radio" class="" name="check" value="manager">
									<label for="manager">Manager</label>
								</div>
								<div class="">
									<input id="other" type="radio" class="" name="check" value="other">
									<label for="other">Other</label>
								</div>
								
							</div>
							<div class="form-group other-choose hidden">
								<div class="">
									<input type="text" class="form-control" name="other_choose" placeholder="Enter Other" value="{{old('other_choose')}}">
								</div>
							</div>
							<div class="form-group">
								<p style="clear: both;">Please enter the business number that can be verified online and call to confinm</p>
								<div class="input-group"> <span class="input-group-addon"><i class="fas fa-phone-alt"></i></span>
									<input type="text" class="form-control" name="phone"  placeholder="Business Phone" value="{{old('phone')}}">
									<span class="bg-danger color-palette">{{$errors -> first('phone')}}</span>
								</div>
								
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
			<div class="small-header"> Have an Account ? <a href="{{route('sign_in')}}"><b>Login</b></a> </div>
		</div>
	</div>

@endsection
@section('script')
<script type="text/javascript">
	$("#name_state").change(function(){
		var name_state = $(this).val();

		var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('ajaxCity') }}",
          method:"POST",
          data:{name_state:name_state, _token:_token},
          success:function(data){ 
          	console.log(data)
            $('#id_city').html(data);
          }
        });

		/*$.get("tasteadmin/staff/restaurant-dish/"+ name_state,function(data){
			$("#id_city").html('<option value="0"  selected >Select City</option>'+data);
		});*/				
	});
</script>
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

		$(document).on('click','input[name=check]',function(){
			var value = $(this).val();
			if(value == "other"){
				$(this).closest('form').find('.other-choose').toggle().removeClass('hidden');
			}else{
				$(this).closest('form').find('.other-choose').toggle().addClass('hidden');
			}
		});

		$(document).on('click','.button-number-location-plus',function(e){
			e.preventDefault();
			var value = $(this).closest('form').find('.number-location').val();
			if(value == ""){
				$(this).closest('form').find('.number-location').val(1);
			}else{
				$(this).closest('form').find('.number-location').val(parseInt(value)+1);
			}
		});

		$(document).on('click','.button-number-location-minus',function(e){
			e.preventDefault();
			var value = $(this).closest('form').find('.number-location').val();
			if(value == "" || value == 1){
				$(this).closest('form').find('.number-location').val(1);
			}else{
				$(this).closest('form').find('.number-location').val(parseInt(value)-1);
			}
			
		});



	</script>

	{{--<script type="text/javascript">
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
	</script>--}}
@endsection