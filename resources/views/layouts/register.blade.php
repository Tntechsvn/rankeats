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
						<input type="radio" id="ranker" name="type" value="ranker" {{(old('type') != 2) ? 'checked' : ''}} style="position: relative;top: 2px;" /><label for="ranker" style="margin-right: 30px"> Ranker </label>
						<input type="radio" id="business" name="type" value="business" @if(old('type') == 2) checked @endif style="position: relative;top: 2px;" /><label for="business">Business Verification</label> 
					</div>
					<form id="register_rank" class="forms {{(old('type') != 2) ? 'active' : 'hidden'}}" action="{{route('postSignUp')}}" method="post" >
						@csrf
						<input type="hidden" name="type" value="1"/>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control" name="firstname" placeholder="First Name" value="{{old('firstname')}}">
							</div>
							<span class="bg-danger color-palette error-firstname">{{$errors -> first('firstname')}}</span>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control" name="lastname"  placeholder="Last Name" value="{{old('lastname')}}">
							</div>
							<span class="bg-danger color-palette error-lastname">{{$errors -> first('lastname')}}</span>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								<input type="text" class="form-control " name="name"  placeholder="Username" value="{{old('name')}}">
							</div>
								<span class="bg-danger color-palette error-name">{{$errors -> first('name')}}</span>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon">@</span>
								<input type="email" class="form-control " name="email" placeholder="Email" value="{{old('email')}}">
							</div>
								<span class="bg-danger color-palette error-email">{{$errors -> first('email')}}</span>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control " name="password"  placeholder="Password">
							</div>
								<span class="bg-danger color-palette error-password">{{$errors -> first('password')}}</span>
						</div>
						<div class="form-group">
							<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control " name="re_password" placeholder="Confirm Password">
							</div>
								<span class="bg-danger color-palette error-re_password">{{$errors -> first('re_password')}}</span>
						</div>
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
							<span class="bg-danger color-palette error-recaptcha">{{$errors -> first('g-recaptcha-response')}}</span>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-custom btn-lg btn-block rank-join">Join</button>
						</div>
					</form>


					<form id="register_business" class="forms {{(old('type') == 2) ? 'active' : 'hidden'}}" action="{{route('postSignUp')}}" method="post">
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
									
								</div>
								<span class="bg-danger color-palette">{{$errors -> first('firstname')}}</span>
							</div>
							<div class="form-group">
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control" name="lastname"  placeholder="Last Name" value="{{old('lastname')}}">
									
								</div>
								<span class="bg-danger color-palette">{{$errors -> first('lastname')}}</span>
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


				</div>
			</div>
			<div class="small-header"> Have an Account ? <a href="{{route('sign_in')}}"><b>Login</b></a> </div>
		</div>
	</div>
<input type="hidden" name="rank" value="{{route('rank-join')}}">
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

@endsection