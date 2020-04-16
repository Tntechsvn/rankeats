@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
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
						<table class="m-t-15 table-full" style="width: 100%;">
							<thead class="head-table">
								<tr>
									<td width="15%">EAT</td>
									<td width="15%">Review</td>
									<td width="40%">Email</td>
									<td width="20%" colspan="2">
										<div style="width: 100%;line-height: 30px;border-bottom: 1px solid #e1e1e1;">Rank</div>
										<div style="width: 50%;float: left;line-height: 30px;border-right: 1px solid #e1e1e1;">{{$info_business->location->city}}</div>
										<div style="width: 50%;float: left;line-height: 30px;">{{$info_business->location->state}}</div>
									</td>
									<td width="10%">Action</td>
								</tr>
							</thead>
							<tbody class="content-table">								
								@foreach($info_business->business_category as $val)
								<tr>
									<td>{{$val->category_name}}</td>
									<td>{{$val->review_rating()->where('id_rate_from','=',$info_business->id)->count()}}</td>
									<td>{{$info_business->email}}</td>
									<td>{{$val->RankEatState}}</td>
									<td>{{$val->RankEatCity}}</td>
									<td><i class="fas fa-trash"></i></td>
								</tr>
								@endforeach
							</tbody>
						</table>
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
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">ADD EATS</h4>
	  	</div>
	  	<form action="{{route('createBusinessCategory')}}" method="post" accept-charset="utf-8" data-parsley-validate>
	  		<div class="modal-body">
				@csrf
				<div class="form-group">
					Select Business
		            <select class="test" name="business" data-parsley-required>
	                	<option value="{{$info_business->id}}" selected="selected" >{{$info_business->name}}</option>
		            </select>
	          	</div>
				<div class="form-group">
					Select eats
		            <select class="test" required multiple="multiple"  name="category_type[]" data-parsley-required>
		            	@foreach($category as $data_cate)
		            		<option value="{{$data_cate->id}}"
		            			@foreach($info_business->business_category as $val)
		            				@if($val-> id == $data_cate-> id){{'selected'}}@endif

	            				@endforeach
							>{{$data_cate->category_name}}</option>

		            	@endforeach
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
	<script type="text/javascript" src="js/fSelect.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#addeat').find('form').parsley();
			$('.test').fSelect();
		});
	</script>
@stop