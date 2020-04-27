@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="{{$user->UrlAvatarUser}}" class="img-circle" width="200" height="200" alt="{{$user->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{$user->name}}</h1> <p>0 Reviews</p></div></div>
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
						<h3 class="title m-b-20">Business Ranks</h3>
						<div class="clear"></div>
						@if(count($list_vote_business) > 0)
						<table style="width: 100%" class="table-full">
							<thead class="head-table">
								<tr>
									<td width="20%">Business Name</td>
									<td width="20%">Date</td>
									<td width="20%">City</td>
									<td width="20%">State</td>
									<td colspan="2" width="20%">
										<div style="width: 100%;line-height: 30px;border-bottom: 1px solid #e1e1e1;">Rank</div>
										<div style="width: 50%;float: left;line-height: 30px;border-right: 1px solid #e1e1e1;">City</div>
										<div style="width: 50%;float: left;line-height: 30px;">State</div>
									</td>
								</tr>
							</thead>
							<tbody class="content-table">
								@foreach($list_vote_business as $data)
								@if($data->business)
								<tr>
									<td><a href="{{$data->business->permalink()}}">{{$data->business->name ?? ''}}</a></td>
									<td>{{$data->created_at}}</td>
									<td>{{$data->business->location->city ?? ''}}</td>
									<td>{{$data->business->location->state ?? ''}}</td>
									<td width="10%">{{$data->business->RankBusinessCity ?? ''}}</td>
									<td width="10%">{{$data->business->RankBusinessState ?? ''}}</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
						@else
						<h4 style="text-align: center;">You not yet vote any Business.</h4>
						@endif
						
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