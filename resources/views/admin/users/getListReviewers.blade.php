@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
    <h1>Reviewers</h1>
    <p>Manage Reviewers</p>
    <div class="card-header">  	
    	<a data-toggle="modal" data-target="#sentmail-popup" href="javascript:;" class="btn btn-success" style="color: #fff">Email All Reviewers</a>
    	<div class="card-tools">
    		<form action="{{route('getListReviewers')}}" method="get">
	    		<div class="input-group input-group-sm" style="width: 150px;">
	    			<input type="text" name="keyword" id="keyword" value="@if($keyword){{$keyword}}@endif" class="form-control float-right" placeholder="Search">

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
      	<!-- sent-email -->
      	<div id="sentmail-popup" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true"> 
      		<div class="modal-dialog">

      			<!-- Modal content-->
      			<form action="{{route('SendEmailAllReviewers')}}" method="post" accept-charset="utf-8">
      				@csrf
      				<input type="hidden" name="title" value="">
      				<div class="modal-content">
      					<div class="modal-header">
      						<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
      						<h2 style="text-align: center;">Sent message to all reviewers</h2>
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
      							<button type="submit" class="btn btn-primary " >send</button>
      						</div>
      					</div>
      				</div>
      			</form>

      		</div>
      	</div>
      	<!-- end sent-email -->
        <div class="row">
          <!--/.col (right) ------------------------------------------------------------------------------------------>
          <div class="col-md-12">
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
              				<th>Profile Photo</th>              				
              				<th>Username</th>
              				<th>Email</th>
              				<th>Created At</th>
              				<th>Manage</th>
              			</tr>
              		</thead>
              		<tbody>              			
              			@if(count($list_reviewers) > 0)
              			@foreach($list_reviewers as $data)
              				    				
              			<tr>
              				<td>
              					<div class="icheck-primary">
              						<input type="checkbox" value="" class="check" id="check{{$data->id}}" data-row-id="{{$data->id}}">
              						<label for="check{{$data->id}}"></label>
              					</div>
              				</td>
              				@if($data->url_avatar != null)	              				
              				<td class="mailbox-subject"><img src="{{asset('').'storage/'.$data->url_avatar}}" style="width: 100px;"></td>
              				@else
              				<td class="mailbox-subject">
              					<img src="{{asset('').'vendor/adminlte/dist/img/AdminLTELogo.png'}}" style="width: 100px;">
              				</td>
              				@endif
              				<td><a href="{{route('getEditUser',$data->id)}}">{{$data -> name}}</a></td>
              				<td>{{$data -> email}}</td>              				
              				<td>{{$data -> created_at}}</td>
              				<td>
              					<a  href="{{route('getEditUser',$data->id)}}" class="btn btn-success btnEdit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
              					<a class="btn btn-info btnInfo btn-admin" data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="View details" aria-describedby="tooltip826906"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-danger del_user" data-id="{{$data->id }}" onclick="delUserFunction()"><i class="far fa-trash-alt" style="color: #fff;"></i></a>
              				</td>
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
                	{!!$list_reviewers -> appends(request()->except('page')) -> links()!!}
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
  function delUserFunction() {
    var r = confirm("You want to delete user?");
    if (r == true) {
      $(document).on('click', '.del_user',function(e){
        var arr = [];
        arr.push($(this).data('id'));
        var selected_values = arr.join(",");

        var link = "{{route('deleteUser')}}";
        $.ajax({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'post',
          url: link,
          data: 'list_id='+selected_values,
          success:function(data){
            console.log(data);
            if(data.success){
              window.location.reload();
              alert(data.message);
            }else{
              alert(data.message);
            }
          }
        });
      });
    }
  }

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
				var link = "{{route('deleteUser')}}";
				$.ajax({
					headers:{
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type:'post',
					url: link,
					data: 'list_id='+selected_values,
					success:function(data){
						console.log(data);
						if(data.success){
							window.location.reload();
							alert(data.message);
						}else{
							alert(data.message);
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
            	if(confirm("You want to delete it?"))
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