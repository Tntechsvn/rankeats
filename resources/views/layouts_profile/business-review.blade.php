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
						<h3 class="title m-b-20">Business Reviews</h3>
						<div class="clear"></div>
							
						<div class="list-review">
							<div class="review-gr">
								<h4 class="m-b-10">neptuyn</h4>
								<p><i class="fas fa-calendar-alt"></i>25/3/2020</p>
								<p><i class="fas fa-map-marker-alt"></i>new york</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc rutrum finibus lorem vitae elementum. Etiam in turpis id sapien commodo finibus in non neque. Curabitur vel sodales mi. </p>
								
								<div class="edit">
									<a href="" ><i class="fas fa-pencil-alt"></i></a>
									<a href="" ><i class="fas fa-scroll"></i></a>
								</div>
							</div>
							

						</div>

						{{-- {!!$list_reviews -> appends(request()->except('page')) -> links()!!} --}}
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
		
	</script>
@stop