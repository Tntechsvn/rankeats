@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="{{$user->UrlAvatarUser}}" class="img-circle" width="200" height="200" alt="{{$user->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{$user->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-5 col-xs-12 menu-sidebar">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 col-lg-9 col-sm-7 col-xs-12 content-search content-right-profile">
				{{-- <p>{{$target_user->count_review()}}</p> --}}
				<div class="page-title-small">
					<h1>Recent Reviews by {{$user->name}}</h1>
				</div>

				<div class="col-white myprofile-review">
					
					@if($list_reviews->total() >0)
				    	@foreach($list_reviews as $data)
							<div class="list-review">
								<div class="info review-gr">
									<div class="content-right p-b-20">
										<h4><a href="{{$data->business->permalink()}}" class="" style="font-size: 18px;">{{$data->business->name ?? ""}}</a></h4>
									
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
										<div class="review-address">
											@php
												if($data->business->locations){
													$location = $data->business->locations->first();
												}else{
													$location = null;
												}
											@endphp 
											<i class="fas fa-map-marker-alt"></i> @if($location){{$location->address ?? ""}}@endif, @if($location){{$location->city ?? ""}}@endif, @if($location){{$location->state ?? ""}}@endif, @if($location){{$location->country ?? ""}}@endif 
										</div>

										<p>{{$data->review->description}}</p>
										<div class="picture-review">
											<ul class="col-30 lightgalleryphoto" style="padding-left: 0">
												@if($data->review->ListImageReview)
													@foreach($data->review->ListImageReview as $val)
														<li class="list-picture" data-responsive="" data-src="{{$val['url']}}">
															<a href="javascript:;" class="lightbox">
																<img width="210" height="145" src="{{$val['url']}}" class="pic" >
															</a>       
														</li>
													@endforeach
												@endif
											</ul>
										</div>
									</div>
								</div>

							</div>
						@endforeach
					@else
						<div class="col-note">{{$user->name}} haven’t wrote any reviews yet!</div>
					@endif
				</div>

				<div class="col-profile-bottom">
					<div class="page-title-small">
						<h1>Recent Bookmarks by {{$user->name}}</h1>
					</div>

					<div class="col-desc "> 
						@if(count($data_business) > 0)
							@foreach($data_business as $data)			
							<div class="food-main">
									<div class="imbx">
										<a href="{{$data->permalink()}}"><img class="" src="{{$data->UrlAvatarBusiness}}" alt="" style="width: 100%;"></a>
									</div>					
									<div class="imbx-detail">
										<div class="pr-dtl">
											<h4><a href="{{$data->permalink()}}">{{$data->name}}</a></h4>
											<ul class="star-rate">
												@php
													$val =  (int) substr(strrchr($data->RateBusiness,'.'),1);
													for($x=1;$x<=$data->RateBusiness;$x++) {
														echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
													}
													if (strpos($data->RateBusiness,'.') && $val != 0) {
														echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
														$x++;
													}
													while ($x<=5) {
														echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
														$x++;
													}
												@endphp
											</ul>
											<div class="pr-dtail">
												<ul class="p-t-15">
													<li>$$$.</li>
													@foreach($data->business_category as $val)
													<li>{{$val->category_name}}</li>
													@endforeach
												</ul>
											</div>
										</div>
										<div class="pr-dtlr">
											<p>{{$data->business_phone}}</p>
											<p>{{$data->total_vote}} <i>reviews</i></p>
										</div>
										<p>{{$data->locations->first()->address ?? ''}}</p>
										@php
											$str = $data->description; //Tạo chuỗi
											$str = strip_tags($str);
											if(strlen($str)>100) { //Đếm kí tự chuỗi $str, 100 ở đây là chiều dài bạn cần quy định
												$strCut = substr($str, 0, 50); //Cắt 100 kí tự đầu
												$str = substr($strCut, 0, strrpos($strCut, ' ')); //Tránh trường hợp cắt dang dở như "nội d... Read More"
												$so = strlen($str);
												$str1 = substr($data->description, $so, 100000000);
												$str = $str.' <a href="javascript:;" class="m-l-10 readmore">read more</a><span class="hidden show_readmore">'.$str1.'</span>';
											}
										@endphp
										<p class="description">{!!$str!!}</p>
									</div>					
								</div>
							@endforeach
						@else
							<h4 style="text-align: center;">You not yet add any bookmark</h4>
						@endif
					</div>

				</div>

			</div><!--row-->
		</div>
		<!--col-md-9--> 

	</div>
	<!--container--> 

</div>
@endsection
@section('script')
	
	<script type="text/javascript">
		$('.lightgalleryphoto').lightGallery();

		$(document).on('click','.readmore',function(){
			$(this).addClass('hidden');
			$(this).closest('.description').find('.show_readmore').removeClass('hidden');
		});

		
	</script>
@endsection