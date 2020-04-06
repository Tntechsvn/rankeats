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
			<div class="col-md-3">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9">
				<div class="tab-content" style="margin-right: -15px;">
					<div>
						<h3 class="title m-b-20">My EATS</h3>
						<a href="javascript:;" class="addeat" data-toggle="modal" data-target="#addeat">ADD EATS</a>
						<div class="clear"></div>
						<table class="m-t-15" style="width: 100%;">
							<thead class="head-table">
								<tr>
									<td width="15%">EAT</td>
									<td width="15%">Review</td>
									<td width="40%">Email</td>
									<td width="20%" colspan="2">
										<div style="width: 100%;line-height: 30px;border-bottom: 1px solid #e1e1e1;">Rank</div>
										<div style="width: 50%;float: left;line-height: 30px;border-right: 1px solid #e1e1e1;">City</div>
										<div style="width: 50%;float: left;line-height: 30px;">State</div>
									</td>
									<td width="10%">Action</td>
								</tr>
							</thead>
							<tbody class="content-table">
								<tr>
									<td>Pizza</td>
									<td>500 review</td>
									<td>Eat@adsda</td>
									<td>10</td>
									<td>24</div>
									<td><i class="fas fa-trash"></i></div>
								</tr>
								
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
	  <div class="modal-body">
		<form action="" method="post" accept-charset="utf-8" data-parsley-validate>
			<div class="form-group">
				Select Business
	            <select class="test " required multiple="multiple"  name="business[]" data-parsley-required>
                	<option value="">Business1</option>
                	<option value="">Business2</option>
                	<option value="">Business3</option>
	            </select>
          	</div>
			<div class="form-group">
				Select eats
	            <select class="test " required multiple="multiple"  name="eat[]" data-parsley-required>
                	<option value="">pizza</option>
                	<option value="">hotpot</option>
                	<option value="">humbeger</option>
	            </select>
          	</div>
			<div class="form-group">
				<input type="text" name="asdsda" data-parsley-required>
          	</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<button class="btn btn-primary" name="submit">Submit</button>
	  </div>
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