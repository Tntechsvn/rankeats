@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="{{Auth::user()->UrlAvatarUser}}" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-3">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 content-right-profile">

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

					<div class="col-desc "> 
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