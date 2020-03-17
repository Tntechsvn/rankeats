<ul class="nav">
	<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>Bussiness Reviews (0) </a>
	</li>
	<li>
		<a href="{{route('eat_reviews')}}"><i class="fa fa-comments"></i>EAT Reviews (0) </a>
	</li>
	<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>Business Ranks (0) </a>
	</li>
	<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>EAT Ranks (0) </a>
	</li>
	<li>
		<a href="{{route('bookmark')}}"><i class="fa fa-bookmark"></i>Bookmarks (0)</a>
	</li>
	@if(Auth::user()->check_role_business())
		@if(!Auth::user()->check_business() && Auth::user()->check_role_business())
		<li>
			<a href="{{route('add_business')}}"><i class="fas fa-plus-circle"></i>Add Business</a>
		</li>
		@else
		<li>
			<a href="javascript:;"><i class="fas fa-plus-circle"></i>Business Management</a>
			<ul class="nav nav-tabs">
				<li class=""><a class="{{ Route::currentRouteNamed('info-management') ? 'active' : '' }}" href="{{route('info-management')}}">Info Restaurant</a></li>
				<li class=""><a class="{{ Route::currentRouteNamed('menu-management') ? 'active' : '' }}" href="{{route('menu-management')}}">Menu</a></li>
				<li class=""><a class="{{ Route::currentRouteNamed('review-management') ? 'active' : '' }}" href="{{route('review-management')}}">Reviews</a></li>
				<li class=""><a class="{{ Route::currentRouteNamed('create_advertise') ? 'active' : '' }}" href="{{route('create_advertise')}}">Advertisement</a></li>
			</ul>
		</li>
		@endif
	@endif
</ul>