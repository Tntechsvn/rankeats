@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="{{Auth::user()->UrlAvatarUser}}" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container  content-profile">
		<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-5 col-xs-12 menu-sidebar">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 col-lg-9 col-sm-7 col-xs-12 content-search content-right-profile">
				<h3 class="title">My Bookmarks</h3>
				<div class="clear"></div>
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
							<p>{{$data->location->address}}</p>
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
				{!!$data_business -> appends(request()->except('page')) -> links()!!}
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
	<script type="text/javascript">
		$(document).on('click','.readmore',function(){
			$(this).addClass('hidden');
			$(this).closest('.description').find('.show_readmore').removeClass('hidden');
		});
	</script>
@stop