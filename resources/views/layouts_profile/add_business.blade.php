@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container  content-profile">
		<div class="row">
			<div class="col-md-3">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9">

				<form class="form_addbusiness" action="{{route('postCreateBusiness')}}" method="post" accept-charset="utf-8">
					@csrf
					<div class="form-group">
						<label>Name Business</label>
						<div class="input-group"> 
							<span class="input-group-addon"><i class="fas fa-user"></i></span>
							<input type="text" class="form-control input-lg" name="name"placeholder="Business Name">
						</div>
                     	<span class="text-danger"> * {!!$errors -> first('name')!!}</span>
						
					</div>

					<div class="form-group">
						<label>Email</label>
						<div class="input-group"> 
							<span class="input-group-addon"><i class="fas fa-envelope"></i></span>
							<input type="email" class="form-control input-lg" name="email"placeholder="Business email">
						</div>
                     	<span class="text-danger"> {!!$errors -> first('email')!!}</span>
						
					</div>

					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" class="form-control input-lg" name="phone"  placeholder="Business phone">
                     	<span class="text-danger"> * {!!$errors -> first('phone')!!}</span>
						
					</div>

					<div class="form-group">
						<label>Location</label>
						<input type="text" name="search" id="location_res" class="form-control"  />
						<input  type="hidden" id="longitude" name="longitude">
						<input  type="hidden" id="latitude" name="latitude" >
						<input  type="hidden" id="address" name="address" >
						<input  type="hidden" id="city" name="city" >
						<input  type="hidden" id="state" name="state">
						<input  type="hidden" id="country" name="country">
						<span class="text-danger"> * {!!$errors -> first('search')!!}</span>
              
					</div>

					<div class="form-group">
						<label>Category Business</label>
						<select class="test" multiple="multiple"  name="category_id[]">
							<optgroup>
								@foreach($category as $data_cate)
									<option value="{{$data_cate->id}}">{{$data_cate->category_name}}</option>
								@endforeach
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
							<input id="image_restaurant" class="hidden" type="file"  value="" accept="image/*">
						</label>
						
					</div>

					<div class="form-group">
						<label>Descriptions</label>
						<textarea name="description"></textarea>
						
					</div>
					<input class="submit_addbusiness btn btn-primary" type="submit" style="width: 150px;" name="submit" value="Add Business">

				</form>

			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', initialize);
  function initialize(){
    var search = document.getElementById('location_res');
    var autocomplete = new google.maps.places.Autocomplete(search);
    google.maps.event.addListener(autocomplete, 'place_changed', function(){
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      document.getElementById('address').value = place.formatted_address;
      document.getElementById('longitude').value = place.geometry.location.lng();
      document.getElementById('latitude').value = place.geometry.location.lat();
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
      document.getElementById('city').value = city;
      document.getElementById('state').value = state;
      document.getElementById('country').value = country;     
    });
  };
</script>

<script type="text/javascript" src="js/fSelect.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.test').fSelect();
		$('#image_restaurant').click(function(e) {

			var previews = document.getElementById('previews');
			if (previews.hasChildNodes()) {
				alert('Bạn Chỉ Có Thể Chọn Một Ảnh Cho Mục Này');
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
			if(confirm("Bạn Muốn Xóa Ảnh Này?"))
			{
				$(this).parent().remove();
				$("#image_restaurant").val(null);/* xóa tên của file trong input*/
			}
			else
				return false;
		});
	});	
</script>
@endsection
