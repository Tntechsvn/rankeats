@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="{{Auth::user()->UrlAvatarUser}}" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container container-main content-profile">
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
							<a href="{{$data->permalink()}}"><img class="" src="{{$data->UrlAvatarBusiness}}" alt="" style="width: 100%;"></a>
						</div>					
						<div class="imbx-detail">
							<div class="pr-dtl">
								<h4><a href="{{$data->permalink()}}">{{$data->name}}</a></h4>
								<ul class="star-rate">
									@php
										$val =  (int) substr(strrchr($data->RateBusiness,'.'),1);
										for($x=1;$x<=$data->RateBusiness;$x++) {
											echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
										}
										if (strpos($data->RateBusiness,'.') && $val != 0) {
											echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
										while ($x<=5) {
											echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
											$x++;
										}
									@endphp
								</ul>
								<div class="pr-dtail">
									<ul class="p-t-15">
										<li>$$$.</li>
										@foreach($data->business_category as $val)
										<li>{{$val->category_name}}</li>
										@endforeach
									</ul>
								</div>
							</div>
							<div class="pr-dtlr">
								<p>{{$data->business_phone}}</p>
								<p>{{$data->total_vote}} <i>reviews</i></p>
							</div>
							<p>{{$data->location->address}}</p>
							<p>{{$data->description}}<a href="javascript:;" class="m-l-10">read more</a></p>
						</div>					
					</div>
				@endforeach
				{!!$data_business -> appends(request()->except('page')) -> links()!!}
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
	
@stop