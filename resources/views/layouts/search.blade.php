@extends('layouts_home.master')
@section('content')

<div id="main" class="">
	<div class="banner banner-inner" style="background-image: url('{{($category_search) ? $category_search->UrlImgCategory : 'images/promo.jpg' }}');">
		<img src="images/promo.jpg" alt="" class="fade">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 inform-results">
			<h1>Search Results For "{{ (isset($keyword)) ? $keyword : 'All Eats'}}"</h1>
		</div>
	</div>
	<div class="container">

		<div class="col-sm-12 col-xs-12 " style="margin-top:30px;text-align: center;">
			@include('layouts.form-search')
		</div>
		<div class="col-sm-12 col-xs-12  col-md-8 col-lg-8 content-search" style="margin-top:30px;">
			@if(count($data_business_sponsored) > 0)
			<div class="results-sponsored">
				<h3 class="title">Sponsored Results</h3>
				<div class="clear"></div>
				@foreach($data_business_sponsored as $data)

					<div class="food-main">
						<div class="imbx">
							<a href="{{$data->permalink()}}"><img class="" src="{{$data->UrlAvatarBusiness}}" alt=""  style="width: 140px;height: 140px;object-fit: cover;"></a>
						</div>					
						<div class="imbx-detail">
							<div class="pr-dtl">
								<h4 style="font-size: 18px;"><a href="{{$data->permalink()}}">{{$data->name}}</a></h4>
								<p style="padding-right: 50px;">Address: {{$data->address}}</p>
								<p>City: {{$data->location->city}}</p>
								<p>State: {{$data->location->state}} - Zip: {{$data->location->code}}</p>
								<p>Phone: {{$data->phone}}</p>
								<ul class="star-rate">
									@php
										$val =  (int) substr(strrchr($data->RateBusiness,'.'),1);
										for($x=1;$x<=$data->RateBusiness;$x++) {
											echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
										}
										if (strpos($data->RateBusiness,'.') && $val != 0) {
											echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
										while ($x<=5) {
											echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
									@endphp
									
								</ul>
								@php
									$total_review = $data->review_rating()->join('users','users.id','=','review_ratings.user_id')
										       ->where('type_rate','=',1)
										       ->whereNull('users.deleted_at')->count();
								@endphp
								<a href="javascript:;" class="review-popup" data-id="{{$data->id}}"><span style="display: inline-block;line-height: 20px;padding-left: 10px;">#{{$total_review}} <i>reviews</i></span></a>
							</div>
						</div>					
					</div>
				@endforeach
			</div>
			@endif
			<h3 class="title">All Results</h3>
			<div class="clear"></div>
			<div class="results-all">
				@if(count($data_business))
				@foreach($data_business as $key => $data)
					<div class="food-main">
						<div class="imbx">
							<a href="{{$data->permalink()}}"><img class="" src="{{$data->UrlAvatarBusiness}}" alt="" style="width: 140px;height: 140px;object-fit: cover;"></a>
						</div>					
						<div class="imbx-detail">
							<div class="pr-dtl">
								<span class="top-results">{{$key+1}}</span>
								<h4 style="font-size: 18px;"><a href="{{$data->permalink()}}">{{$data->name}}</a></h4>
								<p style="padding-right: 50px;">Address: {{$data->address}}</p>
								<p>City: {{$data->city}}</p>
								<p>State: {{$data->state}} - Zip: {{$data->location->code}}</p>
								<p>Phone: {{$data->phone}}</p>
								<ul class="star-rate">
									@php
										$val =  (int) substr(strrchr($data->RateBusiness,'.'),1);
										for($x=1;$x<=$data->RateBusiness;$x++) {
											echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
										}
										if (strpos($data->RateBusiness,'.') && $val != 0) {
											echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
										while ($x<=5) {
											echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
									@endphp
									
								</ul>
								@php
									$total_review = $data->review_rating()->join('users','users.id','=','review_ratings.user_id')
										       ->where('type_rate','=',1)
										       ->whereNull('users.deleted_at')->count();
								@endphp
								<a href="javascript:;" class="review-popup" data-id="{{$data->id}}"><span style="display: inline-block;line-height: 20px;padding-left: 10px;">#{{$total_review}} <i>reviews</i></span></a>
							</div>
							
							@if(Auth::check())
				    			@if(Auth::user()->check_vote($data->business_id))
				    			<a href="javascript:;"  class="btn vote_now vote vote-{{$data->id}}-{{$data->location->IdCity}}"  data-id="{{$data->id}}" data-name="{{$data->name}}" data-category_id="{{$category_search->id}}">Vote</a>
				    			@else
				    			<a href="javascript:;" class="btn unvote vote vote-{{$data->id}}-{{$data->location->IdCity}}" data-id="{{$data->id}}" data-name="{{$data->name}}" data-category_id="{{$category_search->id}}">My Vote</a>
				    			@endif
			    			@else
			    				<a href="javascript:;" data-toggle="modal" data-target="#loginModal-vote" class="btn btn-warning vote" style="background-color: #f0ad4e;">Vote</a>
			    			@endif
						</div>					
					</div>
				@endforeach
				@else
					<h4 style="text-align: center;padding-bottom: 20px;">No Result<h4>
				@endif
				{!!$data_business -> appends(request()->except('page')) -> links()!!}
			</div>
		</div>
		<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 m-t-30">
			<div class="map_img">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26361000.332878!2d-113.75050573534398!3d36.242031228413545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2zSG9hIEvhu7M!5e0!3m2!1svi!2s!4v1586315585512!5m2!1svi!2s" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			</div>
			<div>
				<h4 style="font-size: 14px;" class="p-t-15">Is the EAT for a business you’re looking for missing?</h4>
				<div class="underMap" style="margin-top:10px;">
					<a @if(Auth::check()) data-target="#eatModal" @else data-target="#loginModal-addeat" @endif data-toggle="modal" style="color:#fff;background-color: #0d59b7;width: 100px;height: 35px;" class="btn bold" >Add EAT </a>
				</div>
				
			</div>
		</div>
	<!--container--> 
	</div>
</div>

@if(Auth::check())
<!-- Knight-->
	<div id="voteModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="listdish-popup" aria-hidden="true"> 
		<div class="modal-dialog">

			<!-- Modal content-->
			<form action="{{route('postReviewFrontEnd')}}" method="post" accept-charset="utf-8">
				@csrf
				<input type="hidden" name="business_id" value="">
				<input type="hidden" name="category_id" value="{{$category_search->id ?? ""}}">
				<div class="modal-content">
					<div style="padding: 15px;border-bottom: 1px solid #e5e5e5;">
						<div class="avata-popup " style="width: 100%;text-align: center;">
							<img src="{{Auth::user()->UrlAvatarUser}}" class="img-circle" style="object-fit: cover;" width="200" height="200" alt="{{Auth::user()->name}}">
							<p class="bold">{{Auth::user()->name}}</p>
						</div>
					</div>
					<div class="modal-body">
						<p style="text-align: center;">Would you like to write a review for this EAT?</p>
						<div class="okverify hidden">
							<div class="popup-star">
								<label class="customstar star-1">							
									<input type="radio" name="rate" value="1" checked="checked">
									<span class="starimg checkstar" ></span>
								</label>
								<label class="customstar star-2">							
									<input type="radio" name="rate" value="2">
									<span class="starimg" ></span>
								</label>
								<label class="customstar star-3">							
									<input type="radio" name="rate" value="3">
									<span class="starimg" ></span>
								</label>
								<label class="customstar star-4">							
									<input type="radio" name="rate" value="4">
									<span class="starimg" ></span>
								</label>
								<label class="customstar star-5">							
									<input type="radio" name="rate" value="5">
									<span class="starimg "></span>
								</label>
							</div>
							<div class="form-group choose-img">
								<div class="form-group"  style="text-align: center;">
									<div  class="dt-imgs">
										<div class="dt-close" style="position:relative;">
											<div id="previews" class="preview-img" style="width: 250px;position: relative;"></div>
										</div>
									</div>
								</div>
								<label for="image_restaurant" class="choose_img" style="width: 100%;">
									<span style="padding: 5px 20px;border: 1px solid #e1e1e1;border-radius: 5px;display: block;"><i class="fas fa-paperclip"></i> Choose image...</span>
									<input id="image_restaurant" class="hidden" type="file" value="" accept="image/*" multiple>
								</label>
							</div>
							<div class="form-group reviewBox">
								<textarea class="form-control" placeholder="Write Your Review" name="description"></textarea>
								<span class="e-lang" style="color: red;font-size: 11px;"></span>
							</div>
						</div>
						
					</div>
					<div class="modal-footer" style="text-align: center;">
						<div class="verify">
							<a href="javascript:;" data-dismiss="modal" class="btn btn-primary noverify" style="width: 80px;">NO</a>
							<a href="javascript:;" class="btn btn-primary yesverify" style="width: 80px;">YES</a>
						</div>
						<div class="firstWindow hidden" style="width: 100%;padding: 0 15px;">
							<button type="submit" class="btn btn-primary yesforvote" style="width: 100%">Submit</button>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
@endif
<div id="eatModal" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="fas fa-times-circle"></i></button>
				<h4 class="modal-title">Add EAT</h4>
			</div>
			<div class="modal-body">
				<a href="javascript:;"  style="color:#fff;" class="btn btn-primary rankerBtn">Ranker</a>
				{{-- &nbsp;
				<a href="javascript:;"  class="btn btn-primary" style="color:#fff;">Owner/Manager </a> --}}
				<div class="rankerShow" style="display:none;">
					<form action="" method="post" data-parsley-validate>
						@csrf
						<div class="form-group m-t-15">
							<label for="eat_item">EAT</label>
							<input type="text" class="form-control input-lg" name="category_name" id="eat_item" placeholder="Item" value="{{old('eat_name')}}" data-parsley-required />
							<span class="text-danger">{!!$errors -> first('category_name')!!}</span>
						</div>
						<div class="form-group">
							<label for="eat_location">Location</label>
							<div class="form-group">
								<select class="form-control select2" name="state" id="add_eat_state" data-parsley-required >
										<option value=""disabled selected="selected">Select State</option>
										@foreach($state as $data)
										<option value="{{$data->name}}">{{$data->name}}</option>
										@endforeach
								</select>
								<span class="bg-danger color-palette">{{$errors -> first('state')}}</span>
							</div>
							<div class="form-group">
								<select class="form-control select2" name="city" id="add_eat_city" style="width: 100%;">
									<option  value="" disabled selected >Select City</option>
								</select>
								<span class="bg-danger color-palette">{{$errors -> first('city')}}</span>
								
							</div>
							<div class="form-group">
								<input type="text" class="form-control " name="address"  placeholder="Address" value="{{old('address')}}" data-parsley-required>
								<span class="bg-danger color-palette">{{$errors -> first('address')}}</span>
							</div>
							<div class="form-group">
								<input type="text" class="form-control " name="zipcode" placeholder="Zip Code" value="{{old('zipcode')}}" data-parsley-required>
								<span class="bg-danger color-palette">{{$errors -> first('zipcode')}}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="business_name">Business Name</label>
							<input type="text" class="form-control input-lg" name="business_name" id="business_name" value="{{old('business_name')}}" placeholder="Business Name" data-parsley-required />
							<span class="text-danger">{!!$errors -> first('business_name')!!}</span>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<div id="loginModal-addeat" class="modal fade in" role="dialog" tabindex="-1" aria-labelledby="popup" aria-hidden="true">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="fas fa-times-circle"></i></button>
				<h4 class="modal-title">&nbsp;</h4>
			</div>
			<div class="modal-body">
				<p>Must be logged in to Add EAT, <a href="{{route('sign_in')}}">Login Here</a></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>

	</div>
</div>
<div id="loginModal-vote" class="modal fade in" role="dialog" tabindex="-1" aria-labelledby="popup" aria-hidden="true">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="fas fa-times-circle"></i></button>
				<h4 class="modal-title">&nbsp;</h4>
			</div>
			<div class="modal-body">
				<p>Must be logged in to vote, <a href="{{route('sign_in')}}">Login Here</a></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>

	</div>
</div>

<div id="un_vote" class="modal fade in" role="dialog" tabindex="-1" aria-labelledby="popup" aria-hidden="true">
	<div class="modal-dialog">
		<input type="hidden" name="business_id" value="">
		<input type="hidden" name="category_id" value="">

		{{-- <input type="hidden" name="city_id" value=""> --}}
		<input type="hidden" name="unvoted" value="{{route('ajax_unvoted')}}">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<p class="message">You voted for business21; 0/1 votes remain.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-success unvote_submit">Yes</button>
			</div>
		</div>

	</div>
</div>
<div id="review-popup" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true" style="top: 80px;"> 
	<div class="modal-dialog" style="max-width: 850px;width: 100%;">

		<!-- Modal content-->
			<div class="modal-content">
				{{-- <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
					
				</div> --}}
				<div class="modal-body">
					<h3 class="title m-b-20">Reviews</h3>
					<div id="reviewforbusiness" class="tab-pane">
						
						<h1 class="no-results hidden" style="text-align: center; "></h1>
					</div>
				</div>
			</div>

	</div>
</div>

<input type="hidden" name="vote-ajax" value="{{route('vote_ajax')}}">
<input type="hidden" name="postReviewFrontEnd" value="{{route('postReviewFrontEnd')}}">
<input type="hidden" name="review_search" value="{{route('review_search')}}">
@endsection

@section('script')
<script type="text/javascript">
	$("#add_eat_state").change(function(){
		var name_state = $(this).val();

		var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('ajaxCity') }}",
          method:"POST",
          data:{name_state:name_state, _token:_token},
          success:function(data){ 
          	console.log(data)
            $('#add_eat_city').html(data);
          }
        });

		/*$.get("tasteadmin/staff/restaurant-dish/"+ name_state,function(data){
			$("#id_city").html('<option value="0"  selected >Select City</option>'+data);
		});*/				
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.starimg',function(){
			$(this).addClass('checkstar');
			$(this).closest('.popup-star').find('.starimg').addClass('checkstar');
			$(this).closest('.customstar').nextAll().find('.starimg').removeClass('checkstar');

		});
	});

	// show form add eat

	$(document).on('click','.rankerBtn',function(){
		var modal = $('#eatModal');
		modal.find('.rankerShow').addClass('show');
	});

	$(document).on('click','.noverify',function(){
		$('#voteModal').hide();
	});
	$(document).on('click','.yesverify',function(){
		$(this).closest('form').find('.okverify').removeClass('hidden');
		$(this).closest('.modal-footer').find('.verify').addClass('hidden');
		$(this).closest('.modal-footer').find('.firstWindow').removeClass('hidden');
	});
	$(document).on('click','.readmore',function(){
		$(this).addClass('hidden');
		$(this).closest('.description').find('.show_readmore').removeClass('hidden');
	});

</script>
	<script type="text/javascript">
		$(document).ready(function() {
			var images = function(input, imgPreview) {
				if (input.files) {
					var arr = [];
					var filesAmount = input.files.length;
					for (i = 0; i < filesAmount; i++) {
						var reader = new FileReader();
						reader.onload = function(event) {
							$('<div class="dt-close" style="position:relative;"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').appendTo(imgPreview);
						}
						reader.readAsDataURL(input.files[i]);
					}
				}
			};

			$('#image_restaurant').on('change', function() {
				images(this, '#previews');
			});
			/*clear the file list when image is clicked*/
			$(document).on('click','.deletetimg',function(){
				if(confirm("You want to delete it?"))
				{
					$(this).closest('#previews').html('');
					$("#image_restaurant").val(null);/* xóa tên của file trong input*/
				}
				else
					return false;
			});
		});
	</script>
@stop