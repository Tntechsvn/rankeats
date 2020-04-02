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
						<div class="clear"></div>
						<table style="width: 100%">
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
@endsection
@section('script')
	<script type="text/javascript">
		
	</script>
@stop