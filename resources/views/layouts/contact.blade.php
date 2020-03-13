@extends('layouts_home.master')
@section('content')


<div id="main">
 

	<div class="container container-main">
		<div class="small-header">
			<h1>Contact Us</h1>
		</div>
		<div class="row login">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
				<form id="formContact" action="send_mail.php" method="post">
					<div class="form-group">
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" name="inputYourname" id="inputYourname" placeholder="Your Name">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group"> <span class="input-group-addon">@</span>
							<input type="text" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-info-sign"></span></span>
							<input type="text" class="form-control" name="inputSubject" id="inputSubject" placeholder="Subject">
						</div>
					</div>
					<div class="form-group">
						<textarea class="form-control" id="inputMessage" name="inputMessage" rows="3" placeholder="Message"></textarea>
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
