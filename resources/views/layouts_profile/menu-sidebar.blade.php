<ul class="nav">
	{{--<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>Bussiness Reviews (0) </a>
	</li>--}}
	<li class="{{ Route::currentRouteNamed('eat_reviews') ? 'active' : '' }}">
		<a href="{{route('eat_reviews')}}"><i class="fa fa-comments"></i>EAT Reviews ({{Auth::user()->reviews->count()}}) </a>
	</li>
	{{--<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>Business Ranks (0) </a>
	</li>
	<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>EAT Ranks (0) </a>
	</li>--}}
	<li class="{{ Route::currentRouteNamed('bookmark') ? 'active' : '' }}">
		<a href="{{route('bookmark')}}"><i class="fa fa-bookmark"></i>Bookmarks ({{Auth::user()->bookmark->count()}})</a>
	</li>
	@if(Auth::user()->check_role_business())
		@if(!Auth::user()->check_business() && Auth::user()->check_role_business())
		<li class="{{ Route::currentRouteNamed('add_business') ? 'active' : '' }}">
			<a href="{{route('add_business')}}"><i class="fas fa-plus-circle"></i>Add Business</a>
		</li>
		@else
		<li class="">
			<a class="dropdown"  href="javascript:;"><i class="fas fa-plus-circle"></i>Business Management <span class="caret" style="float: right;margin-top: 8px;"></span></a>
			<ul class="nav menudropdown">
				<li class="{{ Route::currentRouteNamed('info-management') ? 'active' : '' }}"><a class="" href="{{route('info-management')}}"><i class="fas fa-caret-right"></i> Info Restaurant</a></li>
				<li class="{{ Route::currentRouteNamed('menu-management') ? 'active' : '' }}"><a class="" href="{{route('menu-management')}}"><i class="fas fa-caret-right"></i> Menu</a></li>
				<li class="{{ Route::currentRouteNamed('review-management') ? 'active' : '' }}"><a class="" href="{{route('review-management')}}"><i class="fas fa-caret-right"></i> Reviews</a></li>
				<li class="{{ Route::currentRouteNamed('create_advertise') ? 'active' : '' }}"><a class="" href="{{route('create_advertise')}}"><i class="fas fa-caret-right"></i> Advertisement</a></li>
			</ul>
		</li>
		@endif
	@endif
</ul>