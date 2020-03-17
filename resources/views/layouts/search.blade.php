@extends('layouts_home.master')
@section('content')

<div id="main" class="">
	<div class="banner">
		<img src="images/promo.jpg" alt="" class="fade">
	</div>
	<div class="container container-main">

		<div class="col-sm-12 col-xs-12 " style="margin-top:30px;text-align: center;">
			@include('layouts.form-search')
		</div>

		<div class="col-sm-12 col-xs-12  col-md-8 col-lg-8 content-search p-t-20 p-b-20" style="margin-top:30px;">
			<div class="results-sponsored">
				<h3 class="title">Sponsored Results</h3>
				@foreach($data_business_sponsored as $data)
				<div class="food-main">
					<div class="imbx">
						<img class="" src="@if($data['url_img']){{asset('').'storage/'.$data['url_img']}}@else{{'images/map_main.png'}}@endif" alt="" style="width: 100%;">
					</div>					
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>{{$data['business_name']}}</h4>
							<ul>
								@for($i = 1;$i <= $data['rate'];$i++)
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								@endfor
							</ul>
							<p>{{$data['total_vote']}} <i>reviews</i></p>
							<div class="pr-dtail">
								<ul class="p-t-15">
									<li>$$$.</li>
									@foreach($data['category_business'] as $cate)
									<li>{{$cate}}</li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>{{$data['business_phone']}}</p>
							<p>{{$data['location']}}</p>
						</div>

						<p>{{$data['description']}}<a href="javascript:;">read more</a></p>
						<a href="#" data-target="#voteModalSponsored{{$data['id']}}" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a>
						@if(Auth::check())
						<!-- Knight-->
						<div id="voteModalSponsored{{$data['id']}}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="listdish-popup" aria-hidden="true"> 
							<div class="modal-dialog">

								<!-- Modal content-->
								<form action="{{route('postReviewFrontEnd')}}" method="post" accept-charset="utf-8">
									@csrf
									<input type="hidden" name="business_id" value="{{$data['id']}}">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
											<div class="avata-popup " style="width: 100%;text-align: center;">
												<img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}">
												<p class="bold">{{Auth::user()->name}}</p>
											</div>
										</div>
										<div class="modal-body">
											<p>Would you like to write a review for this EAT?</p>
											<div class="popup-star">
												<label class="customstar star-1">							
													<input type="radio" name="rate" value="1" checked="checked">

													<span class="starimg checkstar" ></span>
												</label>
												<label class="customstar star-2">							
													<input type="radio" name="rate" value="2">
													<span class="starimg" ></span>
												</label>
												<label class="customstar star-3">							
													<input type="radio" name="rate" value="3">
													<span class="starimg" ></span>
												</label>
												<label class="customstar star-4">							
													<input type="radio" name="rate" value="4">
													<span class="starimg" ></span>
												</label>
												<label class="customstar star-5">							
													<input type="radio" name="rate" value="5">
													<span class="starimg "></span>
												</label>
											</div>
											<div class="form-group reviewBox">
												<textarea class="form-control" placeholder="Write Your Review" name="description"></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<div class="firstWindow" style="width: 100%">
												<button type="submit" class="btn btn-primary yesforvote" style="width: 100%">Submit</button>
											</div>
										</div>
									</div>
								</form>

							</div>
						</div>
						@endif

					</div>					
				</div>
				@endforeach
			</div>
			<div class="results-all">
				<h3 class="title">All Results</h3>
				@foreach($data_business as $data)
				<div class="food-main">
					<div class="imbx">
						<img class="" src="@if($data['url_img']){{asset('').'storage/'.$data['url_img']}}@else{{'images/map_main.png'}}@endif" alt="" style="width: 100%;">
					</div>					
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>{{$data['business_name']}}</h4>
							<ul>
								@for($i = 1;$i <= $data['rate'];$i++)
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								@endfor
							</ul>
							<p>{{$data['total_vote']}} <i>reviews</i></p>
							<div class="pr-dtail">
								<ul class="p-t-15">
									<li>$$$.</li>
									@foreach($data['category_business'] as $cate)
									<li>{{$cate}}</li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>{{$data['business_phone']}}</p>
							<p>{{$data['location']}}</p>
						</div>

						<p>{{$data['description']}}<a href="javascript:;">read more</a></p>
						<a href="#" data-target="#voteModal{{$data['id']}}" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a>
					</div>					
				</div>
				@if(Auth::check())
				<!-- Knight-->
				<div id="voteModal{{$data['id']}}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="listdish-popup" aria-hidden="true"> 
					<div class="modal-dialog">

						<!-- Modal content-->
						<form action="{{route('postReviewFrontEnd')}}" method="post" accept-charset="utf-8">
							@csrf
							<input type="hidden" name="business_id" value="{{$data['id']}}">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
									<div class="avata-popup " style="width: 100%;text-align: center;">
										<img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}">
										<p class="bold">{{Auth::user()->name}}</p>
									</div>
								</div>
								<div class="modal-body">
									<p>Would you like to write a review for this EAT?</p>
									<div class="popup-star">
										<label class="customstar star-1">							
											<input type="radio" name="rate" value="1" checked="checked">
											<span class="starimg checkstar" ></span>
										</label>
										<label class="customstar star-2">							
											<input type="radio" name="rate" value="2">
											<span class="starimg" ></span>
										</label>
										<label class="customstar star-3">							
											<input type="radio" name="rate" value="3">
											<span class="starimg" ></span>
										</label>
										<label class="customstar star-4">							
											<input type="radio" name="rate" value="4">
											<span class="starimg" ></span>
										</label>
										<label class="customstar star-5">							
											<input type="radio" name="rate" value="5">
											<span class="starimg "></span>
										</label>
									</div>
									<div class="form-group reviewBox">
										<textarea class="form-control" placeholder="Write Your Review" name="description"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<div class="firstWindow" style="width: 100%">
										<button type="submit" class="btn btn-primary yesforvote" style="width: 100%">Submit</button>
									</div>
								</div>
							</div>
						</form>

					</div>
				</div>
				@endif
				@endforeach
				{!!$list_cate -> appends(request()->except('page')) -> links()!!}
			</div>
		</div>
		<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 m-t-30">
			<div class="map_img">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3709.807695902279!2d105.83079121539541!3d21.59342827363624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1584071260154!5m2!1svi!2s" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			</div>
			{{-- <div><h4>Is the EAT for a business you’re looking for missing?</h4>
				<div class="underMap" style="margin-top:10px;"><a data-target="#loginModal" data-toggle="modal" style="color:#fff;" class="btn btn-primary" >Add EAT </a></div>
			</div> --}}
		</div>
		<!--container--> 


		
	</div>
</div>
<input type="hidden" name="user" value="{{Auth::user()->id ?? ""}}">
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.starimg',function(){
			$(this).addClass('checkstar');
			$(this).closest('.popup-star').find('.starimg').addClass('checkstar');
			$(this).closest('.customstar').nextAll().find('.starimg').removeClass('checkstar');

		});

		$(document).on('click','.vote_now', function(){
			var user = $('input[name=user]').val();
			console.log(user);
			if(user == ""){
				$(this).closest('body').find('#login-dp').addClass('show');
			}
		});
	});
</script>
@stop