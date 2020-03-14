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
				<div class="tab-content">
					<div id="reviewforbusiness" class="tab-pane">
						<h3 class="title m-b-20">My Reviews</h3>
						
						<div class="row m-b-20">
							<div class="col-lg-1">
								<div class="avata">
									<img src="images/avatar-default.png" alt="">
								</div>
							</div>
							<div class="col-lg-11">
								<div class="content-right p-b-20">
								<h4>name reviews</h4>
								<span class="review-date">12 tháng 3 2020</span>
								<div class="star-view clear p-b-10">
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<span class="bold p-l-20">Review restaurent king bbq</span>
								</div>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et lorem sit amet justo consequat porttitor. Fusce ut ultrices nunc. Suspendisse ut porta libero, quis venenatis nisi. Phasellus pellentesque, est at fermentum rutrum, ante purus suscipit arcu, sit amet sollicitudin nibh lorem vitae odio.</p>
							</div>
							</div>
						</div>
						<div class="row m-b-20">
							<div class="col-lg-1">
								<div class="avata">
									<img src="images/avatar-default.png" alt="">
								</div>
							</div>
							<div class="col-lg-11">
								<div class="content-right p-b-20">
								<h4>name reviews</h4>
								<span class="review-date">12 tháng 3 2020</span>
								<div class="star-view clear p-b-10">
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<span class="bold p-l-20">Review restaurent king bbq</span>
								</div>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et lorem sit amet justo consequat porttitor. Fusce ut ultrices nunc. Suspendisse ut porta libero, quis venenatis nisi. Phasellus pellentesque, est at fermentum rutrum, ante purus suscipit arcu, sit amet sollicitudin nibh lorem vitae odio.</p>
							</div>
							</div>
						</div>
						<div class="row m-b-20">
							<div class="col-lg-1">
								<div class="avata">
									<img src="images/avatar-default.png" alt="">
								</div>
							</div>
							<div class="col-lg-11">
								<div class="content-right p-b-20">
								<h4>name reviews</h4>
								<span class="review-date">12 tháng 3 2020</span>
								<div class="star-view clear p-b-10">
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<span class="bold p-l-20">Review restaurent king bbq</span>
								</div>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et lorem sit amet justo consequat porttitor. Fusce ut ultrices nunc. Suspendisse ut porta libero, quis venenatis nisi. Phasellus pellentesque, est at fermentum rutrum, ante purus suscipit arcu, sit amet sollicitudin nibh lorem vitae odio.</p>
							</div>
							</div>
						</div>
						<div class="row m-b-20">
							<div class="col-lg-1">
								<div class="avata">
									<img src="images/avatar-default.png" alt="">
								</div>
							</div>
							<div class="col-lg-11">
								<div class="content-right p-b-20">
								<h4>name reviews</h4>
								<span class="review-date">12 tháng 3 2020</span>
								<div class="star-view clear p-b-10">
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<span class="bold p-l-20">Review restaurent king bbq</span>
								</div>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et lorem sit amet justo consequat porttitor. Fusce ut ultrices nunc. Suspendisse ut porta libero, quis venenatis nisi. Phasellus pellentesque, est at fermentum rutrum, ante purus suscipit arcu, sit amet sollicitudin nibh lorem vitae odio.</p>
							</div>
							</div>
						</div>
						<div class="row m-b-20">
							<div class="col-lg-1">
								<div class="avata">
									<img src="images/avatar-default.png" alt="">
								</div>
							</div>
							<div class="col-lg-11">
								<div class="content-right p-b-20">
								<h4>name reviews</h4>
								<span class="review-date">12 tháng 3 2020</span>
								<div class="star-view clear p-b-10">
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<span class="bold p-l-20">Review restaurent king bbq</span>
								</div>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et lorem sit amet justo consequat porttitor. Fusce ut ultrices nunc. Suspendisse ut porta libero, quis venenatis nisi. Phasellus pellentesque, est at fermentum rutrum, ante purus suscipit arcu, sit amet sollicitudin nibh lorem vitae odio.</p>
							</div>
							</div>
						</div>
						<div class="row m-b-20">
							<div class="col-lg-1">
								<div class="avata">
									<img src="images/avatar-default.png" alt="">
								</div>
							</div>
							<div class="col-lg-11">
								<div class="content-right p-b-20">
								<h4>name reviews</h4>
								<span class="review-date">12 tháng 3 2020</span>
								<div class="star-view clear p-b-10">
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<i class="fas fa-star star-rate"></i>
									<span class="bold p-l-20">Review restaurent king bbq</span>
								</div>
								
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et lorem sit amet justo consequat porttitor. Fusce ut ultrices nunc. Suspendisse ut porta libero, quis venenatis nisi. Phasellus pellentesque, est at fermentum rutrum, ante purus suscipit arcu, sit amet sollicitudin nibh lorem vitae odio.</p>
							</div>
							</div>
						</div>
					</div>
					<div id="menuforbusiness" class="tab-pane ">
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
					<div id="infobusiness" class="tab-pane active">
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
						<label>Restaurant Image</label>
						<div class="form-group"  style="text-align: center;">
	                    	<div  class="dt-imgs">
	                    		<div class="dt-close" >
	                    			<div id="previews" class="preview-img" style="width: 250px;"></div>
	                    		</div>
	                    	</div>
	                    </div>
						<label for="image_restaurant" class="choose_img"><span><i class="fas fa-paperclip"></i> Choose image...</span>
							<input id="image_restaurant" class="hidden" type="file" name="image" value="" accept="image/*">
						</label>
						
					</div>

					<div class="form-group">
						<label>Descriptions</label>
						<textarea></textarea>
						
					</div>
					<input class="submit_addbusiness btn btn-primary" type="submit" style="width: 150px;" name="submit" value="Update">

				</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
	<script type="text/javascript" src="js/fSelect.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.test').fSelect();
		});
	</script>
@stop