@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container container-main content-profile">
		<div class="row">
			<div class="col-md-3">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9">

				<form class="form_addbusiness" action="#" method="get" accept-charset="utf-8">
					<div class="form-group">
						<label>Name Business</label>
						<input type="text" name="name" value="">
						
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" value="">
						
					</div>

					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" name="phone" value="">
						
					</div>

					<div class="form-group">
						<label>Location</label>
						<input type="text" name="location" value="">
						
					</div>

					<div class="form-group">
						<label>Restaurant Type</label>
						<select>
							<option></option>
							<option>ádsadsdas</option>
						</select>
						
					</div>

					<div class="form-group">
						<label>Restaurant Image</label>
						<label for="image_restaurant" class="choose_img"><span><i class="fas fa-paperclip"></i> Choose image...</span>
							<input id="image_restaurant" class="hidden" type="file" name="image" value="" accept="image/*">
						</label>
						
					</div>

					<div class="form-group">
						<label>Descriptions</label>
						<textarea></textarea>
						
					</div>
					<input class="submit_addbusiness btn btn-primary" type="submit" style="width: 150px;" name="submit" value="Add Business">

				</form>

			</div>
		</div>
	</div>

</div>
@endsection