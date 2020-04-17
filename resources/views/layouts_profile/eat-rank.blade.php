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
						<h3 class="title m-b-20">Eat Ranks</h3>
						<div class="clear"></div>
						<table style="width: 100%" class="table-full">
							<thead class="head-table">
								<tr>
									<td width="20%">Business Name</td>
									<td width="16%">Eat</td>
									<td colspan="2" width="16%">
										<div style="width: 100%;line-height: 30px;border-bottom: 1px solid #e1e1e1;">Rank</div>
										<div style="width: 50%;float: left;line-height: 30px;border-right: 1px solid #e1e1e1;">{{$info_business->location->city ?? ''}}</div>
										<div style="width: 50%;float: left;line-height: 30px;">{{$info_business->location->state ?? ''}}</div>
									</td>
								</tr>
							</thead>
							<tbody class="content-table">
								@if($info_business)
								@foreach($info_business->business_category as $val)
									<tr>
										<td>{{$info_business->name}}</td>
										<td>{{$val->category_name}}</td>
										<td width="8%">{{$val->RankEatState}}</div>
										<td width="8%">{{$val->RankEatCity}}</div>
									</tr>
								@endforeach
								
								@endif
								
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