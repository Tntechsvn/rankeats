@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
    <h1>Eats</h1>
    <p>Manage your website business eats</p>
    <div class="card-header">    	
    	<div class="card-tools">
    		<form action="{{route('getListEats')}}" method="get">
	    		<div class="input-group input-group-sm" style="width: 150px;">
	    			
	    				<input type="text" name="keyword" value="@if($keyword){{$keyword}}@endif" class="form-control float-right" placeholder="Search">
	    				<div class="input-group-append">
	    					<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
	    				</div>
	    		</div>
    		</form>
    	</div>
    </div>
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
                <h3 class="card-title">Add New Eats</h3>               
                
              </div>
              <!-- form start -->
              <form role="form" action="{{route('postCreateEats')}}" method="post" enctype="multipart/form-data">
              	{{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Eat</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Enter the EAT's name">
                    <span class="text-danger">{{$errors -> first('category_name')}}</span>
                  </div>
                  <div class="form-group">
                  	<label>Eat Description</label>
                  	<textarea class="form-control" name="description" rows="3" placeholder="Enter the description of the EAT's"></textarea>
                  	<span class="text-danger">{{$errors -> first('description')}}</span>
                  </div>
                  <div class="form-group">
                    <label for="">Image Eat</label>
                    <div class="form-group"  style="text-align: center;">
                    	<div  class="dt-imgs">
                    		<div class="dt-close">
                    			<div id="previews"></div>
                    		</div>
                    	</div>
                    </div>
                    <div class="abc">
                    	<div class="btn btn-default btn-file" style="background-color: #ffffff;">
                    		<i class="fa fa-paperclip"></i> Attachment
                    		<input type="file" id="avatar" name="avatar" >
                    	</div><!-- <span class="max">Max. 32MB</span> -->
                    </div>	
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
          <!--/.col (right) ------------------------------------------------------------------------------------------>
          <div class="col-md-7">
            <div class="card">
              <div class="card-header">
              		<!-- Check all button -->
                	<button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
              		<div class="btn-group">
              			<button type="button" class="btn btn-default btn-sm delete">
              				<i class="far fa-trash-alt"></i>
              			</button>
              		</div>

                <div class="card-tools">
                	{{$start}}-{{$record}}/{{$total_record}}
                	<div class="btn-group float-right">
                		<button type="button" class="btn btn-default btn-sm left" <?php if(!isset($_GET['page'])){echo "disabled";}?>>
                			<i class="fa fa-chevron-left "></i>
                		</button>
                		<button type="button" class="btn btn-default btn-sm right" <?php if(isset($_GET['page']) && $_GET['page'] > 0){if($_GET['page'] >= ceil($total_record/10)){echo "disabled";}}?>>
                			<i class="fa fa-chevron-right "></i>
                		</button>
                	</div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0  mailbox-messages">
              	<table class="table table-hover ">
              		<thead>
              			<tr>
              				<th></th>
              				<th>Eat</th>              				
              				<th>Image Eat</th>
              				<th>Created At</th>
              			</tr>
              		</thead>
              		<tbody>              			
              			@if(count($data_category) > 0)
              			@foreach($data_category as $data)
              				    				
              			<tr>
              				<td>
              					<div class="icheck-primary">
              						<input type="checkbox" value="" class="check" id="check{{$data->id}}" data-row-id="{{$data->id}}">
              						<label for="check{{$data->id}}"></label>
              					</div>
              				</td>
              				<td><a href="{{route('getEditEats',$data->id)}}">{{$data -> category_name}}</a></td>
              				<img src="" alt="">
              				
              				@if($data->url_img != null)	              				
              				<td class="mailbox-subject"><img src="{{asset('').'storage/'.$data->url_img}}" style="width: 100px;"></td>
              				@else
              				<td class="mailbox-subject">
              					<img src="" style="width: 100px;">
              				</td>
              				@endif
              				<td>{{$data -> created_at}}</td>
              			</tr>
              			@endforeach
              			@else
              			<tr>
              				<td><span class="tag tag-success">No Data</span></td>
              			</tr>
              			@endif              			
              		</tbody>
              	</table>
              </div>
              
            </div>
            <!-- /.card -->
            <!-- /.card-body -->
              <div class="card-header">
                <div class="card-tools">                	
                	{!!$data_category -> appends(request()->except('page')) -> links()!!}
                </div>
              </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@stop
@section('adminlte_js')
<script>
	$(function () {
    	 //Enable check and uncheck all functionality
		    $('.checkbox-toggle').click(function () {
		      var clicks = $(this).data('clicks')
		      if (clicks) {
		        //Uncheck all checkboxes
		        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
		        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
		      } else {
		        //Check all checkboxes
		        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
		        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
		      }
		      $(this).data('clicks', !clicks)
		    })

		//multi delete
		$(".delete").click(function(){
			var arr = [];
			$(".check:checked").each(function() {
				arr.push($(this).data('row-id'));
			});
			if(arr.length <= 0 ) {
				alert("Please select the item you want to delete.");
				return;
			} else {
				WRN_PROFILE_DELETE = "Are You Sure You Want To Delete"+(arr.length > 1 ? "these" : "this") + " row?";
			}
			var checked = confirm(WRN_PROFILE_DELETE);
			if(checked == true) {
				var selected_values = arr.join(",");
				var link = "";
				$.ajax({
					headers:{
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type:'post',
					url: link,
					data: 'list_id='+selected_values,
					success:function(data){
						console.log(data);
						if(data == "Success"){
							window.location.reload();
							alert('Delete Success');
						}else{
							alert('Delete errors');
						}
					}
				});
			}
		});
	});
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
						$('<div class="dt-close"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').append("<img class='thumb' src='"+event.target.result+"'"+"style=''>").append('<div class="deletethumb tsm"></div>').appendTo(imgPreview);;
					}
					reader.readAsDataURL(input.files[i]);
				}
			}
		};

		$('#avatar').on('change', function() {
			images(this, '#previews');
		});
            /*clear the file list when image is clicked*/
            $('body').on('click','.deletethumb',function(){
            	if(confirm("Do you want to delete this image?"))
            	{
            		$(this).parent().remove();
					$("#avatar").val(null);/* xóa tên của file trong input*/
				}
				else
					return false;
			});
        });
    </script>
<script type="text/javascript">
	/*paginate ********************** //*/

	$(".left").click(function(){
		var pg = @if(isset($_GET['page'])){{$_GET['page']}}@else{{'1'}}@endif;
		var kw = $('#keyword').val();
		if(kw != ''){
			var key = '&keyword=' +(kw);
		}else{
			var key = "";
		}
		if(pg == 1){
			var str_page = "?page=1";
		}else{
			if(pg >= 2){
				var str_page = "?page=" + (pg - 1);
			}else{
				var str_page = "";
			}
		}
		var current_link = <?php echo "'".strtok($_SERVER["REQUEST_URI"],'?')."'";?>;
		window.location.href = current_link + str_page + key;
	});

	$(".right").click(function(){
		var pg = @if(isset($_GET['page'])){{$_GET['page']}}@else{{'1'}}@endif;
		var kw = $('#keyword').val();
		if(kw != ''){
			var key = '&keyword=' +(kw);
		}else{
			var key = "";
		}
		var page_paginate = <?php $page_paginate = ceil($total_record/10); echo $page_paginate; ?>;
		if((pg + 1)>page_paginate){
			var str_page = "?page=" + (pg);
			
		}else{
			var str_page = "?page=" + (pg + 1);
		}


		var current_link = <?php echo "'".strtok($_SERVER["REQUEST_URI"],'?')."'";?>;
		window.location.href = current_link + str_page + key;
	});
</script>
@stop