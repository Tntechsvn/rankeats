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
				<div class="tab-content">
					<div>
						<h3 class="title m-b-20">My Reviews</h3>
						<div class="clear"></div>
						@foreach($list_reviews as $data)
						<div class="row m-b-20">
							<div class="col-lg-1">
								<div class="avata">
									<img src="@if($data->user->url_avatar != null){{asset('').'storage/'.$data->user->url_avatar}}@else{{'images/avatar-default.png'}}@endif" alt="" style="width: 70px;">
								</div>
							</div>
							<div class="col-lg-11">
								<div class="content-right p-b-20">
								<h4>{{$data->user->name}}</h4>
								<span class="review-date">{{$data -> created_at}}</span>
								<div class="star-view clear p-b-10">
									@for($i = 1;$i <= $data->review_rating->where('review_id','=',$data->id)->first()->rate;$i++)
									<i class="fas fa-star star-rate"></i>
									@endfor
									<span class="bold p-l-20">Review business <a href="{{$data->business->permalink()}}">{{$data->business->name}}</a></span>
								</div>
								
								<p>{{$data->description}}</p>
							</div>
							</div>
						</div>
						@endforeach
						{!!$list_reviews -> appends(request()->except('page')) -> links()!!}
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
	<script type="text/javascript" src="js/fSelect.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.test').fSelect();
		});
	</script>
@stop