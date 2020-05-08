@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if($user->url_avatar != null){{asset('').'storage/'.$user->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{$user->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{$user->name}}</h1> <p>0 Reviews</p></div></div>
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
				<div class="tab-content" style="margin-right: -15px;">
					<div>
						<h3 class="title m-b-20">EAT Reviews</h3>
						<div class="clear"></div>
					@if($list_review_eats->total() >0)
				    	@foreach($list_review_eats as $data)
						<div class="list-review">
							<div class="review-gr">
								<h4 class="m-b-10"><a href="{{$data->business->permalink()}}">{{$data->business->name}}</a></h4>
								<div class="star-view clear p-b-10">
											<ul class="">
											@php
												$val =  (int) substr(strrchr($data->rate,'.'),1);
												for($x=1;$x<=$data->rate;$x++) {
													echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
												}
												if (strpos($data->rate,'.') && $val != 0) {
													echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
													$x++;
												}
												while ($x<=5) {
													echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
													$x++;
												}
											@endphp
											
										</ul>
										<span class="review-date" style="padding-left: 10px;">{{date('m-d-Y', strtotime($data->created_at))}}</span>
										</div>
								<p><i class="fas fa-utensils"></i>{{$data->business->business_category->pluck('category_name')->implode(', ')}}</p>
								<p><i class="fas fa-map-marker-alt"></i>{{$data->business->locations->first()->address ?? ''}}</p>
								@if($data->review->ListImageReview)
									<ul class="lightgalleryphoto col-30">
										@foreach($data->review->ListImageReview as $val)
									    	<li class="" data-responsive="" data-src="{{$val['url']}}">
			                                    <a href="{{$val['url']}}" class="lightbox">
			                                        <img width="210" height="145" src="{{$val['url']}}" class="pic" >
			                                    </a>       
			                                </li>
										@endforeach
							    	</ul>
								@endif
								<p>{{$data->review->description}}</p>
								
								{{-- <div class="edit">
									<a href="javascript:;" ><i class="fas fa-pencil-alt"></i></a>
									<a href="javascript:;" ><i class="fas fa-scroll"></i></a>
								</div> --}}
							</div>
							

						</div>
						@endforeach
					@else
					<h4 style="text-align: center;">You not yet add any Eat review.</h4>
					@endif
						<div style="text-align: center;">
							{!!$list_review_eats -> appends(request()->except('page')) -> links()!!}
						</div>
						
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
		$('.lightgalleryphoto').lightGallery();
	</script>
@stop