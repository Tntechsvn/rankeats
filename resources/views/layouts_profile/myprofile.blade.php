@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'templates/origin/images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container container-main">
		<div class="row">
			<div class="col-md-3">

				<div class="profile-usermenu">
					<ul class="nav">
						<li>
							<a href="reviewed-by-42-hungpro"><i class="fa fa-comments"></i>Bussiness Reviews (0) </a>
						</li>
						<li>
							<a href="reviewed-by-42-hungpro"><i class="fa fa-comments"></i>EAT Reviews (0) </a>
						</li>
						<li>
							<a href="reviewed-by-42-hungpro"><i class="fa fa-comments"></i>Business Ranks (0) </a>
						</li>
						<li>
							<a href="reviewed-by-42-hungpro"><i class="fa fa-comments"></i>EAT Ranks (0) </a>
						</li>
						<li>
							<a href="bookmarks-by-42-hungpro"><i class="fa fa-bookmark"></i>Bookmarks (0)</a>
						</li>
					</ul>
				</div>
				<div class="user-description">
					<h1>About {{Auth::user()->name}}</h1>
					<p></p>
				</div>
			</div>

			<div class="col-md-9">

				<div class="page-title-small">
					<h1>Recent Reviews by {{Auth::user()->name}}</h1>
				</div>

				<div class="col-white">
					<div class="col-note">{{Auth::user()->name}} haven’t wrote any reviews yet!</div>
				</div>

				<div class="col-profile-bottom">
					<div class="page-title-small">
						<h1>Recent Bookmarks by {{Auth::user()->name}}</h1>
					</div>

					<div class="col-desc row"> 
						<div class="col-note">{{Auth::user()->name}} haven’t bookmarked any business listings yet!.</div>
					</div>

				</div>

			</div><!--row-->
		</div>
		<!--col-md-9--> 

	</div>
	<!--container--> 

</div>
@endsection