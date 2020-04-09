@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
<h1>Edit User</h1>
@stop

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-7">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<a class="btn btn-primary" href="@if($user->role_id == 2){{route('getListReviewers')}}@elseif($user->role_id == 3){{route('getListBusinessOwners')}}@endif">back</a>
						<h3 class="card-title">Edit user</h3>               

					</div>
					<!-- form start -->
					<form  action="{{route('postEditUser',$user ->id)}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="card-body">
							<div class="col-md-12">				
								<div class="form-group">
									<label for="">Image User</label>
									<div  class="dt-imgs">										
										<div class="dt-close">
											<div id="previews">@if($user->url_avatar !=null)<div class="gallerythumb">
												<img class="thumb" src="{{asset('').'storage/'.$user->url_avatar}}" class="pic" >
												<div class="deletethumb tsm"><i class="fas fa-times-circle"></i></div>
												<input type="hidden" name="id_img[]" value="{{$user->url_avatar}}">
											</div>@endif</div>
										</div>
									</div>
								</div>
								<div class="abc">
									<div class="btn btn-default btn-file" style="background-color: #ffffff;">
										<i class="fa fa-paperclip"></i>  Attachment
										<input type="file" id="avatar" name="avatar" >
									</div> <span class="max">Max. 32MB</span>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Username (Cannot be changed)</label>
								<input type="text" class="form-control" name="name" placeholder="Enter eat" value="{{$user->name}}" disabled="disabled">
								<span class="errors">{{$errors -> first('name')}}</span>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">First Name</label>
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control" name="firstname"  placeholder="First Name" value="{{$user->first_name}}">
									<span class="bg-danger color-palette">{{$errors -> first('firstname')}}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Last Name</label>
								<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
									<input type="text" class="form-control" name="lastname"  placeholder="Last Name" value="{{$user->last_name}}">
									<span class="bg-danger color-palette">{{$errors -> first('lastname')}}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$user->email}}">
								<span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
							</div>
							<div class="form-group">
								<label for="inputBirthday">Address </label>
								<div class="form-group">
									<select class="form-control select2" name="state" id="state_profile">
										<option value=""disabled selected="selected">Select State</option>
										@foreach($state_cstr as $data)
										<option value="{{$data->name}}" 
											@if($user->address != null)
											@if($user->location->state == $data->name){{'selected'}}@endif
											@endif"
											>{{$data->name}}
										</option>
										@endforeach
									</select>
									<span class="bg-danger color-palette">{{$errors -> first('state')}}</span>
								</div>
								<div class="form-group">
									<select class="form-control select2" name="city" id="city_profile" style="width: 100%;">
										<option  value="" disabled selected >Select City</option>
										@if($user->address != null)
										@if($user->location->city != null)
										<option  value="{{$user->location->city}}" disabled selected >{{$user->location->city}}</option>
										@endif
										@endif"
									</select>
									<span class="bg-danger color-palette">{{$errors -> first('city')}}</span>

								</div>
								<div class="form-group">
									<input type="text" class="form-control " name="address"  placeholder="Address" value="@if($user->address != null){{$user->location->address}}@endif">
									<span class="bg-danger color-palette">{{$errors -> first('address')}}</span>
								</div>
								<div class="form-group">
									<input type="text" class="form-control " name="zipcode" placeholder="Zip Code" value="@if($user->address != null){{$user->location->code}}@endif">
									<span class="bg-danger color-palette">{{$errors -> first('zipcode')}}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Date Created</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
									</div>
									@php
										$date = date("d-m-Y",strtotime($user->created_at))
										
									@endphp
									<input type="text" name="created_at" class="form-control" data-inputmask-alias="datetime"data-inputmask-inputformat="dd-mm-yyyy" data-mask value="{{$date}}">
								</div>
							</div>
							<div class="form-group">
								<label>About</label>
								<textarea class="form-control" name="user_title" rows="3" placeholder="Enter ...">{{$user->user_title}}</textarea>
								<span class="errors">{{$errors -> first('user_title')}}</span>
							</div>
							<div class="form-group">
								<label>New Password</label>
								<input type="text" class="form-control" name="password" placeholder="Enter new password" value="">
								<span class="errors">{{$errors -> first('password')}}</span>
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="text" class="form-control" name="re_password" placeholder="Enter confirm password" value="">
								<span class="errors">{{$errors -> first('re_password')}}</span>
							</div>
						</div>
						<!-- /.card-body -->

						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Edit</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>
</section>
@stop
@section('adminlte_js')
<script type="text/javascript">
  $("#state_profile").change(function(){
    var name_state = $(this).val();

    var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('ajaxCity') }}",
          method:"POST",
          data:{name_state:name_state, _token:_token},
          success:function(data){ 
            console.log(data)
            $('#city_profile').html(data);
          }
        });

    /*$.get("tasteadmin/staff/restaurant-dish/"+ name_state,function(data){
      $("#id_city").html('<option value="0"  selected >Select City</option>'+data);
    });*/       
  });
</script>

<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', initialize);
  function initialize(){
    var search = document.getElementById('search');
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

<script>
  $(function () {
	$('.select2').select2()
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
   
    //Money Euro
    $('[data-mask]').inputmask()
  })
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#avatar').click(function(e) {
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
						$('<div class="dt-close"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').append("<img class='thumb' src='"+event.target.result+"'"+"style=''>").append('<div class="deletethumb tsm"><i class="fas fa-times-circle"></i></div>').appendTo(imgPreview);;
					}
					reader.readAsDataURL(input.files[i]);
				}
			}
		};

		$('#avatar').on('change', function() {
			images(this, '#previews');
		});
            //clear the file list when image is clicked
            $('body').on('click','.deletethumb',function(){
            	if(confirm("Do You Want To Delete Photos?"))
            	{
            		$(this).parent().remove();
					$("#avatar").val(null); //xóa tên của file trong input
				}
				else
					return false;
			});
        });
    </script>

@stop