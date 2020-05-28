@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if($user->url_avatar != null){{asset('').'public/storage/'.$user->url_avatar}}@else{{asset('public/images/avatar.jpg')}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container content-profile">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-5 col-xs-12 menu-sidebar">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 col-lg-9 col-sm-7 col-xs-12 content-search content-right-profile">
				<div class="tab-content" style="margin-right: -15px;">
					<div>
						<h3 class="title m-b-20">My EATS</h3>
						<a href="javascript:;" class="addeat" data-toggle="modal" data-target="#addeat">ADD EATS</a>
						<div class="clear"></div>
						@foreach($info_business as $business)
						<table class="m-t-15 table-full" style="width: 100%;">
							<thead class="head-table">
								<tr>
									<td width="15%">EAT</td>
									<td width="10%">Review</td>
									<td width="10%">Business</td>
									<td width="35%">Email</td>
									<td width="20%" colspan="2">
										<div style="width: 100%;line-height: 30px;border-bottom: 1px solid #e1e1e1;">Rank</div>
										<div style="width: 50%;float: left;line-height: 30px;border-right: 1px solid #e1e1e1;">{{$business->locations->first()->city ?? ''}}</div>
										<div style="width: 50%;float: left;line-height: 30px;">{{$business->locations->first()->state ?? ''}}</div>
									</td>
									<td width="10%">Action</td>
								</tr>
							</thead>
							<tbody class="content-table">
								@if(count($business->business_category) > 0)
									@foreach($business->business_category as $val)
										<tr>
											<td>{{$val->category_name}}</td>
											<td>{{$val->review_rating()->where('id_rate_from','=',$business->id)->count()}}</td>
											<td>{{$business->name}}</td>
											<td>{{$business->email}}</td>
											<td>{{$val->RankEatState}}</td>
											<td>{{$val->RankEatCity}}</td>									
											<td><a class=" del_lang" data-id="{{$val->id }}" data-business="{{$business->id}}" onclick="delLangFunction()"><i class="fas fa-trash"></i></a></td>
										</tr>
									@endforeach
								@else
								<tr>
									<td>No eat</td>
									<td></td>
									<td>{{$business->name}}</td>
									<td>{{$business->email}}</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								@endif
							</tbody>
						</table>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

{{-- modal --}}

<div id="addeat" class="modal fade in" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<div class="modal-content">
	  	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="fas fa-times-circle"></i></button>
			<h3 class="modal-title">ADD EATS</h3>
	  	</div>
	  	<form action="{{route('createBusinessCategory')}}" method="post" accept-charset="utf-8" data-parsley-validate>
	  		<div class="modal-body">
				@csrf
				<div class="form-group">
					Select Business
		            <select class="test" name="business" data-parsley-required id="business">
		            	<option value="" selected="selected" >select business</option>
		            	@foreach($info_business as $business)
	                	<option value="{{$business->id ?? ''}}"  >{{$business->name ?? 'Select Business'}}</option>
	                	@endforeach
		            </select>
	          	</div>
				<div class="form-group">
					Select eats
		            <select class="test" required multiple="multiple"  name="category_type[]" data-parsley-required id="category_type">
		            </select>
	          	</div>
		  	</div>
		  	<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button class="btn btn-primary" name="submit">Submit</button>
		  	</div>

	  	</form>
	</div>
  </div>
</div>
@endsection
@section('script')
<script>
  function delLangFunction() {
    var r = confirm("You want to delete eat business?");
    if (r == true) {
      $(document).on('click', '.del_lang',function(e){
        var arr = [];
        arr.push($(this).data('id'));
        var selected_values = arr.join(",");
        var business_id = $(this).data('business');
        var link = "{{route('deleteEatBusiness')}}";
        $.ajax({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'post',
          url: link,
          data: {
          		list_id:selected_values,
          		business_id:business_id
      		},
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
</script>

	<script type="text/javascript" src="{{asset('public/js/fSelect.js')}}"></script>
	<script type="text/javascript">
		$('.test').fSelect();
		$(document).ready(function(){
			$('#addeat').find('form').parsley();
		});
	</script>
	<script type="text/javascript">
		$("#business").change(function(){
		var business_id = $(this).val();

		var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('ajaxEatBusiness') }}",
          method:"POST",
          data:{business_id:business_id,_token:_token},
          success:function(data){
           	$('#category_type').html(data);
            $('#category_type').fSelect('destroy').fSelect('create');
          }
        });				
	});
	</script>
@stop