@extends('layouts_home.master')
@section('content')

@php 
	$reviews = $info_business->review_rating()->join('users','users.id','=','review_ratings.user_id')
										       ->where('type_rate','=',1)
										       ->whereNull('users.deleted_at')->get();
@endphp
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
				<div class="tab-content" style="margin-right: -15px;">
					<div>
						<h3 class="title m-b-20">My Businesses</h3>
						<div class="clear"></div>
						<form class="" action="{{route('postEditBusiness',['id_business'=>$info_business->id])}}" method="post" accept-charset="utf-8">
							@csrf
							<div class="form-group">
								<label>Business Picture</label>
								<div class="form-group"  style="text-align: center;">
									<div  class="dt-imgs">
										<div class="dt-close" style="position:relative;">
											<div id="previews" class="preview-img" style="width: 250px;position: relative;">@if($info_business ->url_img != null)<img class='thumb' src="{{asset('').'storage/'.$info_business ->url_img}}" style='width:100%;'><div class="deletetimg tsm"><i class="fas fa-times-circle"></i></div>@endif</div>
										</div>
									</div>
								</div>
								<label for="image_restaurant" class="choose_img">
									<span style="padding: 5px 20px;border: 1px solid #e1e1e1;border-radius: 5px;"><i class="fas fa-paperclip"></i> Choose image...</span>
									<input id="image_restaurant" class="hidden" type="file" value="" accept="image/*">
								</label>

							</div>
							<div class="form-group">
								<p>Name</p>
								<div class="input-group" > <span class="input-group-addon" style="padding: 6px 15px;"><i class="fas fa-user"></i></span>
									<input type="text" class="form-control " value="{{$info_business->name}}" readonly="readonly">
									<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
								</div>
							</div>
							<div class="form-group">
								<p>Email</p>
								<div class="input-group" > <span class="input-group-addon" style="padding: 6px 15px;"><i class="fas fa-envelope"></i></span>
									<input type="email" class="form-control " name="email" value="{{$info_business->email}}">
									<span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
								</div>
							</div>
							<div class="form-group">
								<p>Phone Number</p>
								<div class="input-group"><span class="input-group-addon" style="padding: 6px 15px;"><i class="fas fa-phone-alt"></i></span>
									<input type="phone" class="form-control " name="phone" value="{{$info_business->phone}}">
									<span class="bg-danger color-palette">{{$errors -> first('phone')}}</span>
								</div>
							</div>
							<div class="form-group">
								<p>Website</p>
								<div class="input-group"> <span class="input-group-addon" style="padding: 6px 15px;"><i class="fas fa-globe-americas"></i></span>
									<input type="text" class="form-control " name="website" value="{{$info_business->website}}">
									<span class="bg-danger color-palette">{{$errors -> first('website')}}</span>
								</div>
							</div>
							<div class="form-group">
								<p>Add Business Opening</p>
								@php
									$date = date("Y-m-d",strtotime($info_business->day_opening))
								@endphp
								<div class="input-group"> <span class="input-group-addon" style="padding: 6px 15px;"><i class="fas fa-calendar-alt"></i></span>
									<input type="text" class="form-control datepicker" name="day_opening" placeholder="YYYY/mm/dd" value="{{$date}}">
									<span class="bg-danger color-palette">{{$errors -> first('day_opening')}}</span>
								</div>
							</div>
							<div class="form-group">
								<p>Address</p>
								<div class="input-group" style="width: 100%">
									<input type="text" class="form-control " name="address" value="{{$info_business->location->address}}">
									<span class="bg-danger color-palette">{{$errors -> first('address')}}</span>
								</div>
							</div>
							<div class="" style="display: flex;justify-content: space-between;">
								<div class="form-group" style="width: 30%">
								
									<div class="input-group" style="width: 100%">
										<p>State</p>
										 	<select class="form-control"  name="state"  id="state_profile">
								             	 <option value="" selected="selected">Select State</option>
								             	 @foreach($state as $data)
								             	 <option value="{{$data->name}}" 
								             	 	@if($info_business->location_id != null)
								             	 		@if($info_business->location->state == $data->name){{'selected'}}@endif
								             	 	@endif"
								             	 	>{{$data->name}}
								             	 </option>
								             	 @endforeach
							            	</select>
							            	<span class="bg-danger color-palette">{{$errors -> first('state')}}</span>
									</div>
								</div>
								<div class="form-group" style="width: 30%">
									<div class="input-group" style="width: 100%">
										<p>City</p>
										 <select class="form-control" id="city_profile1" name="city" style="width: 100%;">
							                <option value="" selected="selected">Select City</option>
							                @if($info_business->location_id != null)
								                @if($info_business->location->city != null)
								                <option  value="{{$info_business->location->city}}" selected >{{$info_business->location->city}}</option>
								                @endif
							                @endif							               
							            </select>
							            <span class="bg-danger color-palette">{{$errors -> first('city')}}</span>
									</div>
								</div>
								<div class="form-group" style="width: 30%">
									<div class="input-group" style="width: 100%">
										<p>Zipcode</p>
										<input type="text" class="form-control " name="zipcode" value="{{$info_business->location->code}}">
										<span class="bg-danger color-palette">{{$errors -> first('zipcode')}}</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<i class="fas fa-star"></i> Reviews: <a href="javascript" data-toggle="modal" data-target="#review-popup">{{$reviews->count()}} reviews </a>
							</div>
							<div class="form-group">
								<span>Time open - close</span>
										
								<div class="row">
									@php 
										$days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
									@endphp
									@for($i=0;$i<=6;$i++)
										@php
										$open_from = '';
										$open_till ='';
											foreach($info_business->business_hour as $val){
												if($val -> business_days == $days[$i]){
													$open_from = $val->open_from;
													$open_till = $val->open_till;
												}
											}
											
										@endphp
									<div class="col-lg-6 uptime" style="margin-bottom: 10px;">
										<span class="bold" style="display: inline-block;width: 45px;">{{$days[$i]}}</span>
										<select class="choose-method" name="">

											<option value="open">Open</option>
											<option value="close" @foreach($info_business->business_hour as $val)
													@if($val -> business_days == $days[$i])
														@if($val ->open_from == null && $val ->open_till == null){{'selected'}}@endif
													@endif
												@endforeach>Close</option>
											
										</select>
										<div class="show_time @foreach($info_business->business_hour as $val)
													@if($val -> business_days == $days[$i])
														@if($val ->open_from == null && $val ->open_till == null){{'hidden'}}@endif
													@endif
												@endforeach" style="margin-top: 10px;padding-left: 50px;">
											<input class="timepic time-open choose-time" type="text" value="{{$open_from}}" name="time_open[{{$days[$i]}}][]" autocomplete="off" />
											-
											<input class="timepic time-close choose-time" type="text" value="{{$open_till}}"
												name="time_close[{{$days[$i]}}][]" autocomplete="off" />
										</div>
									</div>
									@endfor
								</div>
							</div>
							
							<div class="form-group">
								<a data-toggle="modal" data-target="#sentmail-popup" href="javascript:;" class="btn btn-success" style="color: #fff">Email followwer</a>
								<a href="{{$info_business->permalink()}}" class="btn btn-primary" style="color: #fff">Visit Business Page</a>
								<button type="submit" class="btn btn-primary" style="color: #fff" > Update</button>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div id="sentmail-popup" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true"> 
	<div class="modal-dialog">

		<!-- Modal content-->
		<form action="{{route('sendMailFollwers')}}" method="post" accept-charset="utf-8">
			@csrf
			<input type="hidden" name="business" value="{{$info_business->id}}">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="fas fa-times-circle"></i></button>
					<h2 style="text-align: center;">Sent message to follwers</h2>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input class="form-control" type="text" name="subject" value="" placeholder="Subject">
						<span class="bg-danger color-palette">{{$errors -> first('subject')}}</span>
					</div>
					<div class="form-group">
						<textarea class="form-control" name="message" placeholder="Message"></textarea>
						<span class="bg-danger color-palette">{{$errors -> first('message')}}</span>
					</div>
				</div>
				<div class="modal-footer">
					<div class="firstWindow" style="width: 100%">
						<button type="submit" class="btn btn-default " data-dismiss="modal" >Cancel</button>
						<button type="submit" class="btn btn-primary " >Save</button>
					</div>
				</div>
			</div>
		</form>

	</div>
</div>
<div id="review-popup" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true"> 
	<div class="modal-dialog" style="max-width: 920px;width: 100%;">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="far fa-times-circle"></i></button>
					<h3 class="title">Review business</h3>
				</div>
				<div class="modal-body" style="max-height: 800px;overflow-y: scroll;">
					<div id="reviewforbusiness" class="tab-pane">
					
					@foreach( $reviews as $data)
					{{--@dump($data)--}}
					<div class="list-review m-b-20">
						<div class="avata">
							<img src="{{$data->user->UrlAvatarUser}}" alt="" >
							<div class="photo-img">
								<a href="javascript:;" class="show-photo" data-id="{{$data->user->id}}"><i class="fas fa-camera-retro"></i> 20 photo</a>
								
							</div>
							
						</div>
						<div class="info">
							<div class="content-right p-b-20">
								<h4>{{$data->user->name ?? ""}}</h4>
							
								<div class="star-view clear p-b-10">
									@for($i = 1;$i <= 5;$i++)
									<i class="fas fa-star star-rate"></i>
									@endfor
									<span class="review-date">{{date('m-d-Y', strtotime($data->created_at))}}</span>
								</div>
								<div class="review-address">
									<i class="fas fa-map-marker-alt"></i> {{$data->user->location->address ?? ""}}, {{$data->user->location->city ?? ""}}, {{$data->user->location->state ?? ""}}, {{$data->user->location->country ?? ""}} 
								</div>

								<p>{{$data->review->description}}</p>
								<div class="picture-review">
									<ul id="lightgalleryphoto" style="padding-left: 0">
										@if($data->review->ListImageReview)
											@foreach($data->review->ListImageReview as $val)
												<li class="list-picture" data-responsive="" data-src="images/pizza.jpg">
													<a href="javascript:;" class="lightbox">
														<img width="210" height="145" src="{{$val['url']}}" class="pic" >
													</a>       
												</li>
											@endforeach
										@endif
									</ul>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<div class="clear"></div>
				</div>
				</div>
			</div>

	</div>
</div>
<div id="photo-popup" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true"> 
	<div class="modal-dialog" style="max-width: 700px;width: 100%;">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="fas fa-times-circle"></i></button>
				<h3>Images of Kimberly S</h3>
			</div>
			<div class="modal-body">
				<div class="has-photo">
					<ul id="has-photo">
					    			
		    			<li class="" data-responsive="" data-src="images/pizza.jpg">
                            <a href="images/pizza.jpg" class="lightbox">
                                
                                <img width="210" height="145" src="images/pizza.jpg" class="pic" >
                            </a>       
                        </li>
		    			<li class="" data-responsive="" data-src="images/pizza.jpg">
                            <a href="images/pizza.jpg" class="lightbox">
                                
                                <img width="210" height="145" src="images/pizza.jpg" class="pic" >
                            </a>       
                        </li>
		    			<li class="" data-responsive="" data-src="images/pizza.jpg">
                            <a href="images/pizza.jpg" class="lightbox">
                                
                                <img width="210" height="145" src="images/pizza.jpg" class="pic" >
                            </a>       
                        </li>
		    			<li class="" data-responsive="" data-src="images/pizza.jpg">
                            <a href="images/pizza.jpg" class="lightbox">
                                
                                <img width="210" height="145" src="images/pizza.jpg" class="pic" >
                            </a>       
                        </li>
		    			
		    		</ul>
				</div>
				<div class="no-photo hidden">
					<img src="images/no-photo.png" alt="">
					<p class="bold">Don't have image review</p>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bold" data-dismiss="modal">Back</button>
			</div>
		</div>

	</div>
</div>
<input type="hidden" name="show-photo" value="{{route('show-photo')}}">
@endsection
@section('script')
<script src="lightbox/js/lightgallery-all.min.js"></script>
<script type="text/javascript">
	$("#lightgalleryphoto").lightGallery();
	$("#has-photo").lightGallery();
	$('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '0d',
        autoclose: true,
        todayHighlight: true,
      });

  $("#state_profile").change(function(){
    var name_state = $(this).val();

    var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('ajaxCity') }}",
          method:"POST",
          data:{name_state:name_state, _token:_token},
          success:function(data){ 
            console.log(data)
            $('#city_profile1').html(data);
          }
        });

    /*$.get("tasteadmin/staff/restaurant-dish/"+ name_state,function(data){
      $("#id_city").html('<option value="0"  selected >Select City</option>'+data);
    });*/       
  });
</script>
	<script type="text/javascript" src="js/fSelect.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('.test1').fSelect();
			$('.timepic').timepicker({
		        timeFormat: 'H:mm',
		        interval: 30,
		        // minTime: '10',
		        // maxTime: '8:00pm',
		        // defaultTime: '12',
		        // startTime: '10:00',
		        dynamic: false,
		        dropdown: true,
		        scrollbar: true,
		        zindex: 9999999
		    });
		});
	</script>
	<script type="text/javascript">
		$(document).on('change','.choose-method',function(){
			var method = $(this).val();
			if(method == "open"){
				$(this).closest('.uptime').find('.show_time').removeClass('hidden');
			}
			if(method == "close"){
				$(this).closest('.uptime').find('.show_time').addClass('hidden');
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
		$('#image_restaurant').click(function(e) {

			var previews = document.getElementById('previews');
			if (previews.hasChildNodes()) {
				alert('You Can Only Choose An Image For This Item');
				e.preventDefault();
			}			
		});
		var images = function(input, imgPreview) {
			if (input.files) {
				var arr = [];
				var filesAmount = input.files.length;
				for (i = 0; i < filesAmount; i++) {
					var reader = new FileReader();
					reader.onload = function(event) {
						$('<div class="dt-close" style="position:relative;"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').append("<img class='thumb' src='"+event.target.result+"'"+"style='width:100%;'>").append('<div class="deletetimg tsm"><i class="fas fa-times-circle"></i></div>').appendTo(imgPreview);
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