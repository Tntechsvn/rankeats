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
			<div class="col-md-3 col-lg-3 col-sm-5 col-xs-12">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 col-lg-9 col-sm-7 col-xs-12 content-search">
				
					<div id="infobusiness" class="tab-pane active" style="padding: 20px 0;">
						<form class="form_addbusiness" action="{{route('postEditBusiness',['id_business'=>$info_business->id])}}" method="post" accept-charset="utf-8">
							@csrf
							<div class="form-group">
								<label>Name Business</label>
								<input type="text"  value="{{$info_business->name}}" readonly="readonly">

							</div>

							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" value="{{$info_business->email}}">
								<span class="text-danger"> {!!$errors -> first('email')!!}</span>

							</div>

							<div class="form-group">
								<label>Phone Number</label>
								<input type="text" name="phone" value="{{$info_business->phone}}">
								<span class="text-danger"> {!!$errors -> first('phone')!!}</span>

							</div>

							<div class="form-group">						
								<label>Location</label>
								<input type="text" name="search" id="location_res_edit" class="form-control" value="@if($info_business->location_id != null){{$info_business->location->address}}@endif" />
								<input  type="hidden" id="longitude_edit" name="longitude" value="@if($info_business->location_id != null){{$info_business->location->longitude}}@endif">
								<input  type="hidden" id="latitude_edit" name="latitude" value="@if($info_business->location_id != null){{$info_business->location->latitude}}@endif">
								<input  type="hidden" id="address_edit" name="address" value="@if($info_business->location_id != null){{$info_business->location->address}}@endif">
								<input  type="hidden" id="city_edit" name="city" value="@if($info_business->location_id != null){{$info_business->location->city}}@endif">
								<input  type="hidden" id="state_edit" name="state" value="@if($info_business->location_id != null){{$info_business->location->state}}@endif">
								<input  type="hidden" id="country_edit" name="country" value="@if($info_business->location_id != null){{$info_business->location->country}}@endif">
								<span class="text-danger"> {!!$errors -> first('search')!!}</span>
							</div>

							<div class="form-group">
								<label>Restaurant Type</label>
								<select class="test" multiple="multiple"  name="category_id[]">
									<optgroup>
										@foreach( $category as $cate)
										<option value="{{$cate->id}}" <?php 
										foreach($info_business->business_category as $cate_id)
											if($cate_id-> id == $cate-> id){ echo 'selected';}

										?> >{{ $cate->category_name}}</option>
										@endforeach	
									</optgroup>
								</select>
								<span class="text-danger"> {!!$errors -> first('category_id')!!}</span>
								<span class="errors"></span>
							</div>		
							<div class="form-group">
								<label>Restaurant Image</label>
								<div class="form-group"  style="text-align: center;">
									<div  class="dt-imgs">
										<div class="dt-close" style="position:relative;">
											<div id="previews" class="preview-img" style="width: 250px;">@if($info_business ->url_img != null)<img class='thumb' src="{{asset('').'storage/'.$info_business ->url_img}}" style='width:100%;'><div class="deletetimg tsm"><i class="fas fa-times-circle"></i></div>@endif</div>
										</div>
									</div>
								</div>
								<label for="image_restaurant" class="choose_img"><span><i class="fas fa-paperclip"></i> Choose image...</span>
									<input id="image_restaurant" class="hidden" type="file" value="" accept="image/*">
								</label>

							</div>

							<div class="form-group">
								<label>Descriptions</label>
								<textarea name="description">{{$info_business -> description}}</textarea>

							</div>
							<input class="submit_addbusiness btn btn-primary" type="submit" style="width: 150px;" name="submit" value="Update">
						</form>
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
<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', initialize);
  function initialize(){
    var search = document.getElementById('location_res_edit');
    var autocomplete = new google.maps.places.Autocomplete(search);
    google.maps.event.addListener(autocomplete, 'place_changed', function(){
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      document.getElementById('address_edit').value = place.formatted_address;
      document.getElementById('longitude_edit').value = place.geometry.location.lng();
      document.getElementById('latitude_edit').value = place.geometry.location.lat();
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
      document.getElementById('city_edit').value = city;
      document.getElementById('state_edit').value = state;
      document.getElementById('country_edit').value = country;     
    });
  };
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