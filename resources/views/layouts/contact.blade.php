@extends('layouts_home.master')
@section('content')


<div id="main">
 

	<div class="container ">
		<div class="small-header">
			<h1 class="p-t-30">Contact Us</h1>
		</div>
		<div class="row login">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
				<form id="formContact" action="{{route('createContact')}}" method="post" data-parsley-validate>
					@csrf
					<div class="form-group">
						<div class="icon-group"> 
							<span class="icon-form input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" name="name_user_contact" id="inputYourname" value="{{old('name_user_contact')}}" placeholder="Your Name" data-parsley-required>
						</div>
						<span class="errors">{{$errors -> first('name_user_contact')}}</span>
					</div>
					<div class="form-group">
						<div class="icon-group"> <span class="icon-form input-group-addon">@</span>
							<input type="email" class="form-control" name="email" id="inputEmail" value="{{old('email')}}" placeholder="Email" data-parsley-required>							
						</div>
						<span class="errors">{{$errors -> first('email')}}</span>
					</div>
					<div class="form-group">
						<div class="icon-group"> <span class="icon-form input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>
							<input type="text" class="form-control" name="subject" id="inputSubject" value="{{old('subject')}}" placeholder="Subject" data-parsley-required>							
						</div>
						<span class="errors">{{$errors -> first('subject')}}</span>
					</div>
					<div class="form-group">
						<textarea class="form-control" id="inputMessage" name="message" rows="3" placeholder="Message" data-parsley-required>{{old('message')}}</textarea>
						<span class="errors">{{$errors -> first('message')}}</span>
					</div>
					
					<div class="form-group">
						<div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
						<span class="errors">{{$errors -> first('g-recaptcha-response')}}</span>
					</div>

					<div class="form-group">
						<button type="submit" id="sendMail" class="btn btn-custom btn-lg btn-block">Send Message</button>
					</div>
				</form>
			</div>
		</div>
	</div>


</div>


  @endsection
