<ul class="nav">
	<li class="{{ Route::currentRouteNamed('business_review') ? 'active' : '' }}">
		<a href="{{route('business_review')}}"><i class="fa fa-comments"></i>Bussiness Reviews (0) </a>
	</li>
	<li class="{{ Route::currentRouteNamed('eat_reviews') ? 'active' : '' }}">
		<a href="{{route('eat_reviews')}}"><i class="fa fa-comments"></i>EAT Reviews ({{Auth::user()->reviews->count()}}) </a>
	</li>
	<li class="{{ Route::currentRouteNamed('business_rank') ? 'active' : '' }}">
		<a href="{{route('business_rank')}}"><i class="fa fa-comments"></i>Business Ranks (0) </a>
	</li>
	<li class="{{ Route::currentRouteNamed('eat_rank') ? 'active' : '' }}">
		<a href="{{route('eat_rank')}}"><i class="fa fa-comments"></i>EAT Ranks (0) </a>
	</li>
	<li class="{{ Route::currentRouteNamed('bookmark') ? 'active' : '' }}">
		<a href="{{route('bookmark')}}"><i class="fa fa-bookmark"></i>Bookmarks ({{Auth::user()->bookmark->count()}})</a>
	</li>
	@if(Auth::user()->check_role_business())
		@if(!Auth::user()->check_business() && Auth::user()->check_role_business())
		<li class="{{ Route::currentRouteNamed('add_business') ? 'active' : '' }}"><a class="" href="{{route('add_business')}}"><i class="fas fa-caret-right"></i> Add Business</a></li>
		@else
		<li class="">
			<a class="dropdown"  href="javascript:;"><i class="fas fa-plus-circle"></i>My Business<span class="caret" style="float: right;margin-top: 8px;"></span></a>
			<ul class="nav menudropdown">
				<li class="{{ Route::currentRouteNamed('my_businesses') ? 'active' : '' }}"><a class="" href="{{route('my_businesses')}}"><i class="fas fa-caret-right"></i>My Business</a></li>
				{{-- <li class="{{ Route::currentRouteNamed('menu-management') ? 'active' : '' }}"><a class="" href="{{route('menu-management')}}"><i class="fas fa-caret-right"></i> Menu</a></li> --}}
				{{-- <li class="{{ Route::currentRouteNamed('review-management') ? 'active' : '' }}"><a class="" href="{{route('review-management')}}"><i class="fas fa-caret-right"></i> Reviews</a></li> --}}
				<li class="{{ Route::currentRouteNamed('create_advertise') ? 'active' : '' }}"><a class="" href="{{route('create_advertise')}}"><i class="fas fa-caret-right"></i> Advertisement</a></li>
			</ul>
		</li>
		@endif
	@endif
	<li class="{{ Route::currentRouteNamed('my_eat') ? 'active' : '' }}">
		<a href="{{route('my_eat')}}"><i class="fas fa-plus-circle"></i>My EATS</a>
	</li>
</ul>