@extends('layouts_home.master')
@section('content')

<div id="main" class="">
	<div class="banner">
		<img src="images/promo.jpg" alt="" class="fade">
	</div>
	<div class="container container-main">

		<div class="col-sm-12 col-xs-12 " style="margin-top:30px;text-align: center;">
			@include('layouts.form-search')
		</div>
		<div class="col-lg-12 inform-results">
			<h1>You are searching for with the keyword of "@if(isset($keyword)){{$keyword}}@else{{'All Eats'}}@endif"</h1>
			<div class="img">
				<img src="@if($list_cate->first()->url_img != null){{asset('').'storage/'.$list_cate->first()->url_img}}@else{{'images/map_main.png'}}@endif">
			</div>
		</div>

		<div class="col-sm-12 col-xs-12  col-md-8 col-lg-8 content-search p-t-20 p-b-20" style="margin-top:30px;">
			<div class="results-sponsored">
				<h3 class="title">Sponsored Results</h3>
				<div class="clear"></div>
				@foreach($data_business_sponsored as $data)
					<div class="food-main">
						<div class="imbx">
							<a href="{{$data['permalink']}}"><img class="" src="@if($data['url_img']){{asset('').'storage/'.$data['url_img']}}@else{{'images/map_main.png'}}@endif" alt="" style="width: 100%;"></a>
						</div>					
						<div class="imbx-detail">
							<div class="pr-dtl">
								<h4><a href="{{$data['permalink']}}">{{$data['business_name']}}</a></h4>
								<ul class="star-rate">
									@php
										$val =  (int) substr(strrchr($data['rate'],'.'),1);
										for($x=1;$x<=$data['rate'];$x++) {
											echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
										}
										if (strpos($data['rate'],'.') && $val != 0) {
											echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
										while ($x<=5) {
										echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
										$x++;
									}
									@endphp
								</ul>

								<div class="pr-dtail">
									<ul class="p-t-15">
										<li>$$$.</li>
										@foreach($data['category_business'] as $cate)
										<li>{{$cate}}</li>
										@endforeach
									</ul>
								</div>
							</div>
							<div class="pr-dtlr">
								<p>{{$data['business_phone']}}</p>
								<p>{{$data['total_vote']}} <i>reviews</i></p>
							</div>
							<p>{{$data['location']}}</p>

							<p>{{$data['description']}}<a href="javascript:;" class="m-l-10">read more</a></p>
							<a href="javascript:;" @if(!Auth::check()) data-target="#loginModal" @endif class="btn btn-warning @if(Auth::check()) vote_now @endif" data-toggle="modal" data-id="{{$data['id']}}" >Vote</a>
				


						</div>					
					</div>
				@endforeach
			</div>
			<h3 class="title">All Results</h3>
			<div class="clear"></div>
			<div class="results-all">
				
				@foreach($data_business as $data)
					<div class="food-main">
						<div class="imbx">
							<a href="{{$data['permalink']}}"><img class="" src="@if($data['url_img']){{asset('').'storage/'.$data['url_img']}}@else{{'images/map_main.png'}}@endif" alt="" style="width: 100%;"></a>
						</div>					
						<div class="imbx-detail">
							<div class="pr-dtl">
								<h4><a href="{{$data['permalink']}}">{{$data['business_name']}}</a></h4>
								<ul class="star-rate">
									@php
										$val =  (int) substr(strrchr($data['rate'],'.'),1);
										for($x=1;$x<=$data['rate'];$x++) {
											echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
										}
										if (strpos($data['rate'],'.') && $val != 0) {
											echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
										while ($x<=5) {
											echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
									@endphp
								</ul>
								<div class="pr-dtail">
									<ul class="p-t-15">
										<li>$$$.</li>
										@foreach($data['category_business'] as $cate)
										<li>{{$cate}}</li>
										@endforeach
									</ul>
								</div>
							</div>
							<div class="pr-dtlr">
								<p>{{$data['business_phone']}}</p>
								<p>{{$data['total_vote']}} <i>reviews</i></p>
							</div>
							<p>{{$data['location']}}</p>
							<p>{{$data['description']}}<a href="javascript:;" class="m-l-10">read more</a></p>
							<a href="javascript:;" @if(!Auth::check()) data-target="#loginModal" @endif class="btn btn-warning @if(Auth::check()) vote_now @endif" data-toggle="modal" data-id="{{$data['id']}}" >Vote</a>
						</div>					
					</div>

				@endforeach
				{!!$list_cate -> appends(request()->except('page')) -> links()!!}
			</div>
		</div>
		<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 m-t-30">
			<div class="map_img">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3709.807695902279!2d105.83079121539541!3d21.59342827363624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1584071260154!5m2!1svi!2s" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			</div>
			<div><h4>Is the EAT for a business you’re looking for missing?</h4>
				<div class="underMap" style="margin-top:10px;">
					<a @if(Auth::check()) data-target="#eatModal" @else data-target="#loginModal" @endif data-toggle="modal" style="color:#fff;" class="btn btn-primary" >Add EAT </a></div>
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
				<div class="modal-content">
					<div class="modal-header">
						<div class="avata-popup " style="width: 100%;text-align: center;">
							<img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}">
							<p class="bold">{{Auth::user()->name}}</p>
						</div>
					</div>
					<div class="modal-body">
						<p>Would you like to write a review for this EAT?</p>
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
							<div class="form-group reviewBox">
								<textarea class="form-control" placeholder="Write Your Review" name="description"></textarea>
							</div>
						</div>
						
					</div>
					<div class="modal-footer" style="text-align: center;">
						<div class="verify">
							<a href="javascript:;" class="btn btn-primary noverify" style="width: 80px;">CANCEL</a>
							<a href="javascript:;" class="btn btn-primary yesverify" style="width: 80px;">OK</a>
						</div>
						<div class="firstWindow hidden" style="width: 100%">
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
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add EAT</h4>
			</div>
			<div class="modal-body">
				<a href="javascript:;"  style="color:#fff;" class="btn btn-primary rankerBtn">Ranker</a>
				&nbsp;
				<a href="javascript:;"  class="btn btn-primary" style="color:#fff;">Owner/Manager </a>
				<div class="rankerShow" style="display:none;">
					<form action="{{route('postCreateEatsFrontEnd')}}" method="post" data-parsley-validate>
						@csrf
						<div class="form-group m-t-15">
							<label for="eat_item">EAT</label>
							<input type="text" class="form-control input-lg" name="category_name" id="eat_item" placeholder="Item" value="{{old('eat_name')}}" data-parsley-required />
							<span class="text-danger">{!!$errors -> first('category_name')!!}</span>
						</div>
						<div class="form-group">
							<label for="eat_location">Location</label>
							<input type="text" name="search" id="location_res_eat" class="form-control"  data-parsley-required style="height: 46px" />
							<input  type="hidden" id="longitude1" name="longitude">
							<input  type="hidden" id="latitude1" name="latitude" >
							<input  type="hidden" id="address1" name="address" >
							<input  type="hidden" id="city1" name="city" >
							<input  type="hidden" id="state1" name="state">
							<input  type="hidden" id="country1" name="country">
							<span class="text-danger">{!!$errors -> first('address')!!}</span>
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

<div id="loginModal" class="modal fade in" role="dialog" tabindex="-1" aria-labelledby="popup" aria-hidden="true">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
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


<input type="hidden" name="vote-ajax" value="{{route('vote_ajax')}}">
@endsection

@section('script')
<script type="text/javascript">
	google.maps.event.addDomListener(window, 'load', initialize);
	function initialize(){
		var search = document.getElementById('location_res_eat');
		var autocomplete = new google.maps.places.Autocomplete(search);
		google.maps.event.addListener(autocomplete, 'place_changed', function(){
			var place = autocomplete.getPlace();
			if (!place.geometry) {
				window.alert("No details available for input: '" + place.name + "'");
				return;
			}
			document.getElementById('address1').value = place.formatted_address;
			document.getElementById('longitude1').value = place.geometry.location.lng();
			document.getElementById('latitude1').value = place.geometry.location.lat();
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
			document.getElementById('city1').value = city;
			document.getElementById('state1').value = state;
			document.getElementById('country1').value = country;     
		});
	};
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.starimg',function(){
			$(this).addClass('checkstar');
			$(this).closest('.popup-star').find('.starimg').addClass('checkstar');
			$(this).closest('.customstar').nextAll().find('.starimg').removeClass('checkstar');

		});

		// $(document).on('click','.vote_now', function(){
		// 	var user = $('input[name=user]').val();
		// 	var modal_login = $('#loginModal');
		// 	console.log(user);
		// 	if(user == ""){
		// 		modal_login.show();
		// 	}
		// });
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

</script>
@stop