@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
    <h1>CMS</h1>
    <p>Manage your CMS</p>
    <div class="card-header">    	
    	<div class="card-tools">
    		<form action="{{route('getListPage')}}" method="get">
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
              				<th>Page Title</th>              				
              				<th>Ordinarily</th>
              				<th>Created At</th>
              				<th>Manage</th>
              			</tr>
              		</thead>
              		<tbody>              			
              			@if(count($data_pages) > 0)
              			@foreach($data_pages as $data)
              			<tr>
              				<td><a href="{{route('getEditPage',$data->slug)}}">{{$data -> page_title}}</a></td>
              				<td>{{$data-> ordinarily}}</td>
              				<td>{{$data -> created_at}}</td>
              				<td>
              					<button class="btn btn-danger del_page" onclick="deletePageFunction()" data-id="{{$data->id}}"><i class="far fa-trash-alt"></i> Delete</button>
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
                	{!!$data_pages -> appends(request()->except('page')) -> links()!!}
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
				WRN_PROFILE_DELETE = "Are You Sure You Want To Delete "+(arr.length > 1 ? "these" : "this") + " row?";
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
							alert('You Cannot Delete This Page');
						}
					}
				});
			}
		});
	});
</script>
<script type="text/javascript">
	function deletePageFunction(){
		var r = confirm("You want to delete page?");
		if (r == true) {
			$(document).on('click', '.del_page',function(e){
				var arr = [];
				arr.push($(this).data('id'));
				var selected_values = arr.join(",");

				var link = "{{route('deletePages')}}";
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
							alert("Delete Success!");
							window.location.reload();
						}else{
							alert("You Cannot Delete This Page");
							window.location.reload();
						}
					}
				});
			});
		}
	}

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