@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
<h1>Edit Eats</h1>
@stop

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-5">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<a style="float: right;" class="btn btn-primary" href="{{route('getListEats')}}">back</a>
						<h3 class="card-title">Edit Eats</h3>               

					</div>
					<!-- form start -->
					<form role="form" action="{{route('postEditEats',$data_eat ->id)}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="card-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Eat</label>
								<input type="text" class="form-control" name="category_name" placeholder="Enter eat" value="{{$data_eat->category_name}}">
								<span class="errors">{{$errors -> first('category_name')}}</span>
							</div>
							<div class="form-group">
								<label>Eat Description</label>
								<textarea class="form-control" name="description" rows="3" placeholder="Enter ...">{{$data_eat->description}}</textarea>
								<span class="errors">{{$errors -> first('description')}}</span>
							</div>
							<div class="form-group">

								<label for="">Image Eat</label>
								<div  class="dt-imgs">										
									<div class="dt-close">
										<div id="previews">@if($data_eat->url_img !=null)<div class="gallerythumb">
											<img class="thumb" src="{{'http://localhost/rankeats/public/storage/'.$data_eat->url_img}}" class="pic" >
											<div class="deletethumb tsm"><i class="fas fa-times-circle"></i></div>
											<input type="hidden" name="id_img[]" value="{{$data_eat->url_img}}">
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
						<!-- /.card-body -->

						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Add</button>
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
            	if(confirm("You want to delete it?"))
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