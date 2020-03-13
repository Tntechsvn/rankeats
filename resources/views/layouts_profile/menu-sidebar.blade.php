<ul class="nav">
	<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>Bussiness Reviews (0) </a>
	</li>
	<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>EAT Reviews (0) </a>
	</li>
	<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>Business Ranks (0) </a>
	</li>
	<li>
		<a href="javascript:;"><i class="fa fa-comments"></i>EAT Ranks (0) </a>
	</li>
	<li>
		<a href="javascript:;"><i class="fa fa-bookmark"></i>Bookmarks (0)</a>
	</li>
	@if(!Auth::user()->check_business() && Auth::user()->check_role_business())
	<li>
		<a href="{{route('add_business')}}"><i class="fas fa-plus-circle"></i>Add Business</a>
	</li>
	@endif
</ul>