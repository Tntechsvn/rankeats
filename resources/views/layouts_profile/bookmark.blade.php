@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
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
				
				<div class="food-main">
					<div class="imbx">
						<img class="" src="images/map_main.png" alt="" style="width: 100%;">
					</div>					
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>name</h4>
							<ul>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
							</ul>
							<p>10k <i>reviews</i></p>
							<div class="">
								<ul class="p-t-15">
									<li>$$$.</li>
									<li>category</li>
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>phone</p>
							<p>location</p>
						</div>

						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.<a href="javascript:;">read more</a></p>
						{{-- <a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a> --}}
					</div>					
				</div>
				<div class="food-main">
					<div class="imbx">
						<img class="" src="images/map_main.png" alt="" style="width: 100%;">
					</div>					
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>name</h4>
							<ul>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
							</ul>
							<p>10k <i>reviews</i></p>
							<div class="">
								<ul class="p-t-15">
									<li>$$$.</li>
									<li>category</li>
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>phone</p>
							<p>location</p>
						</div>

						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.<a href="javascript:;">read more</a></p>
						{{-- <a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a> --}}
					</div>					
				</div>
				<div class="food-main">
					<div class="imbx">
						<img class="" src="images/map_main.png" alt="" style="width: 100%;">
					</div>					
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>name</h4>
							<ul>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
							</ul>
							<p>10k <i>reviews</i></p>
							<div class="">
								<ul class="p-t-15">
									<li>$$$.</li>
									<li>category</li>
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>phone</p>
							<p>location</p>
						</div>

						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.<a href="javascript:;">read more</a></p>
						{{-- <a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a> --}}
					</div>					
				</div>
				<div class="food-main">
					<div class="imbx">
						<img class="" src="images/map_main.png" alt="" style="width: 100%;">
					</div>					
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>name</h4>
							<ul>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
							</ul>
							<p>10k <i>reviews</i></p>
							<div class="">
								<ul class="p-t-15">
									<li>$$$.</li>
									<li>category</li>
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>phone</p>
							<p>location</p>
						</div>

						<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.<a href="javascript:;">read more</a></p>
						{{-- <a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a> --}}
					</div>					
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
	
@stop