@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container  content-profile">
		<div class="row">
			<div class="col-md-3">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 content-search">
				<h3 class="title">My Bookmarks</h3>
				<div class="clear"></div>	
				@foreach($data_business as $data)			
				<div class="food-main">
					<div class="imbx">
						<img class="" src="@if($data['url_img']){{asset('').'storage/'.$data['url_img']}}@else{{'images/map_main.png'}}@endif" alt="" style="width: 100%;">
					</div>					
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>{{$data['business_name']}}</h4>
							<ul>
								@for($i = 1;$i <= $data['rate'];$i++)
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								@endfor
							</ul>
							<p>{{$data['total_vote']}} <i>reviews</i></p>
							<div class="pr-dtail">
								<ul class="p-t-15">
									<li>$$$.</li>
									@foreach($data['category_business'] as $cate)
									<li>{{$cate}}</li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>{{$data['business_phone']}}</p>
							<p>{{$data['location']}}</p>
						</div>

						<p>{{$data['description']}}<a href="javascript:;">read more</a></p>
					</div>					
				</div>
				@endforeach				
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
	
@stop