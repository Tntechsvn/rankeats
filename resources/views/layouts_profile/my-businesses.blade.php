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
			<div class="col-md-3">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9">
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
											<div id="previews" class="preview-img" style="width: 250px;">@if($info_business ->url_img != null)<img class='thumb' src="{{asset('').'storage/'.$info_business ->url_img}}" style='width:100%;'><div class="deletetimg tsm"><i class="fas fa-times-circle"></i></div>@endif</div>
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
									<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
								</div>
							</div>
							<div class="form-group">
								<p>Address</p>
								<div class="input-group" style="width: 100%">
									<input type="text" class="form-control " name="address" value="{{$info_business->location->address}}">
									<span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
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
								<i class="fas fa-star"></i> Reviews: <a href="javascript" data-toggle="modal" data-target="#review-popup">{{$info_business->review()->count()}} reviews </a>
							</div>
							<div class="form-group">
								<span>Time open - close</span>
										
								<div class="row">
									@php 
										$days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
									@endphp
									@for($i=0;$i<=6;$i++)
									<div class="col-lg-6 uptime" style="margin-bottom: 10px;">
										<span class="bold" style="display: inline-block;width: 45px;">{{$days[$i]}}</span>
										<select class="choose-method" name="">
											<option value="open">Open</option>
											<option value="close" selected>Close</option>
										</select>
										<div class="show_time hidden" style="margin-top: 10px;padding-left: 50px;">
											<input class="timepic time-open choose-time" type="text" value="" name="time_open_{{$days[$i]}}" autocomplete="off" />
											-
											<input class="timepic time-close choose-time" type="text" value="" name="time_close_{{$days[$i]}}" autocomplete="off" />
										</div>
									</div>
									@endfor
								</div>
							</div>
							<div class="form-group">
								<a data-toggle="modal" data-target="#sentmail-popup" href="javascript:;" class="btn btn-success" style="color: #fff">Email followwer</a>
								<a href="javascript:;" class="btn btn-primary" style="color: #fff">Visit Business Page</a>
								<button type="submit" class="btn btn-primary" style="color: #fff" > Success</button>
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
		<form action="#" method="post" accept-charset="utf-8">
			@csrf
			<input type="hidden" name="title" value="">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
					<h2 style="text-align: center;">Sent message to follwers</h2>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input class="form-control" type="text" name="" value="" placeholder="Subject">
					</div>
					<div class="form-group">
						<textarea class="form-control" name="" placeholder="Message"></textarea>
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
	<div class="modal-dialog" style="max-width: 700px;width: 100%;">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
					<h3 class="title m-b-20">Review business</h3>
				</div>
				<div class="modal-body">
					<div id="reviewforbusiness" class="tab-pane">
					
					@foreach($info_business->review_rating()->where('type_rate','=',1)->get() as $data)
					<div class="row m-b-20">
						<div class="col-lg-2">
							<div class="avata">
								<img src="images/avatar-default.png" alt="" style="width: 80px;">
							</div>
						</div>
						<div class="col-lg-10" style="margin-left: -15px;">
							<div class="content-right p-b-20">
							<h4>{{$data->user->name}}</h4>
							<span class="review-date">{{$data -> created_at}}</span>
							<div class="star-view clear p-b-10">
								@for($i = 1;$i <= $data->rate;$i++)
								<i class="fas fa-star star-rate"></i>
								@endfor
								<span class="bold p-l-20">Review business {{$data->business->name}}</span>
							</div>
							
							<p>{{$data->description}}</p>
						</div>
						</div>
					</div>
					@endforeach
				</div>
				</div>
			</div>

	</div>
</div>


@endsection
@section('script')
<script type="text/javascript">
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