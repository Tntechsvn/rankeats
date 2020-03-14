@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
    <h1>Pending Businesses</h1>
    <p>Manage pending businesses</p>
    <div class="card-header">    	
    	<div class="card-tools">
    		<form action="{{route('getListPendingBusiness')}}" method="get">
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
              				<th>Business Name</th>
              				<th>Email</th>
              				<th>Location</th>
              				<th>Created At</th>
              				<th>Manage</th>
              			</tr>
              		</thead>
              		<tbody>              			
              			@if(count($list_business) > 0)
              			@foreach($list_business as $data)
              				    				
              			<tr>
              				<td>
              					<div class="icheck-primary">
              						<input type="checkbox" value="" class="check" id="check{{$data->id}}" data-row-id="{{$data->id}}">
              						<label for="check{{$data->id}}"></label>
              					</div>
              				</td>
              				@if($data->url_img != null)	              				
              				<td class="mailbox-subject"><img src="{{'http://localhost/rankeats/public/storage/'.$data->url_avatar}}" style="width: 100px;"></td>
              				@else
              				<td class="mailbox-subject">
              					<img src="http://localhost/rankeats/public/vendor/adminlte/dist/img/AdminLTELogo.png" style="width: 100px;">
              				</td>
              				@endif
              				<td><a href="{{route('getEditBusiness',$data->id)}}">{{$data -> name}}</a></td>
              				<td>{{$data -> email}}</td>              				
              				<td>{{$data -> location->address}}</td>  
              				<td>{{$data -> created_at}}</td>
              				<td>
                        <a href="{{route('approvedBusinesses',$data->id)}}"><button class="btn btn-primary btnApprove" title="" data-original-title="Approve this business?">A</button></a>
              					<button class="btn btn-success btnEdit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></button>
              					<a class="btn btn-info btnInfo btn-admin" data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="View details" aria-describedby="tooltip826906"><i class="fa fa-eye"></i></a>
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
                	{!!$list_business -> appends(request()->except('page')) -> links()!!}
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
				alert("Vui Lòng Chọn Mục Muốn Xóa.");
				return;
			} else {
				WRN_PROFILE_DELETE = "Bạn Có Chắc Muốn Xóa"+(arr.length > 1 ? "these" : "this") + " row?";
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
							alert('Xóa Danh Mục Nhà Hàng Thành Công');
						}else{
							alert('Bạn Không Thể Xóa Danh Mục Này');
						}
					}
				});
			}
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