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
					<input class="submit_addbusiness btn btn-primary" type="submit" style="width: 150px;" name="submit" value="Add Business">

				</form>

			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
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
@stop