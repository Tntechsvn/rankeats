@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
    <h1>Countries</h1><a href="{{route('getListCountry')}}" class="btn btn-primary">add new</a>
    <p>Manage business countries</p>
    <div class="card-header">    	
    	<div class="card-tools">
    		<form action="{{route('getEditCountry',['country_id'=>$edit_country->id])}}" method="get">
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
                <h3 class="card-title">Edit Country</h3>               
                
              </div>
              <!-- form start -->
              <form role="form" action="{{route('postEditCountry',['country_id'=>$edit_country->id])}}" method="post" enctype="multipart/form-data">
              	{{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Country Code</label>
                    <input type="text" class="form-control" name="code" placeholder="Enter country code" value="{{$edit_country->code}}">
                    <span class="errors">{{$errors -> first('code')}}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Country</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter country name" value="{{$edit_country->name}}">
                    <span class="errors">{{$errors -> first('name')}}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone Code</label>
                    <input type="text" class="form-control" name="phonecode" placeholder="Enter country phone code" value="{{$edit_country->phonecode}}">
                    <span class="errors">{{$errors -> first('phonecode')}}</span>
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
              				<th>Country Code</th>              				
              				<th>Country Name</th>
                      <th>Phone Code</th>
              				<th>Created At</th>
              			</tr>
              		</thead>
              		<tbody>              			
              			@if(count($data_countries) > 0)
              			@foreach($data_countries as $data)
              				    				
              			<tr>
              				<td>
              					<div class="icheck-primary">
              						<input type="checkbox" value="" class="check" id="check{{$data->id}}" data-row-id="{{$data->id}}">
              						<label for="check{{$data->id}}"></label>
              					</div>
              				</td>
              				<td><a href="">{{$data -> code}}</a></td>
              				<td>{{$data -> name}}</td>
                      <td>{{$data -> phonecode}}</td>
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
                	{!!$data_countries -> appends(request()->except('page')) -> links()!!}
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