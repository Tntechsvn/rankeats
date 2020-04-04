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
						<h3 class="title m-b-20">Business Ranks</h3>
						<div class="clear"></div>
						<table style="width: 100%">
							<thead class="head-table">
								<tr>
									<td width="20%">Business Name</td>
									<td width="20%">Date</td>
									<td width="20%">City</td>
									<td width="20%">State</td>
									<td colspan="2" width="20%">
										<div style="width: 100%;line-height: 30px;border-bottom: 1px solid #e1e1e1;">Rank</div>
										<div style="width: 50%;float: left;line-height: 30px;border-right: 1px solid #e1e1e1;">{{$info_business->location->city}}</div>
										<div style="width: 50%;float: left;line-height: 30px;">{{$info_business->location->state}}</div>
									</td>
								</tr>
							</thead>
							<tbody class="content-table">
								<tr>
									<td>{{$info_business->name}}</td>
									<td>Date</td>
									<td>{{$info_business->location->city}}</td>
									<td>{{$info_business->location->state}}</td>
									<td width="10%">{{$info_business->RankBusinessCity}}</td>
									<td width="10%">{{$info_business->RankBusinessState}}</td>
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