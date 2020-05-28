@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container content-profile">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-5 col-xs-12 menu-sidebar">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 col-lg-9 col-sm-7 col-xs-12 content-search content-right-profile">
					<div id="menuforbusiness" style="padding: 20px 0;">
						<form class="form_addbusiness" action="#" method="get" accept-charset="utf-8">
							<div class="form-group">
								<label>Name Food</label>
								<input type="text" name="name" value="">
								
							</div>

							<div class="form-group">
								<label>Menu Type</label>
								<select class="test" multiple="multiple"  name="Category_type[]">
									<optgroup>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</optgroup>
								</select>
								<span class="errors"></span>
							</div>

							<div class="form-group">
								<label>Descriptions</label>
								<textarea></textarea>
								
							</div>
							<input class="submit_post btn btn-primary" type="submit" style="width: 150px;" name="submit" value="Post">	
						</form>
					</div>
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
	<script type="text/javascript" src="{{asset('public/js/fSelect.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.test').fSelect();
		});
	</script>
	
@stop