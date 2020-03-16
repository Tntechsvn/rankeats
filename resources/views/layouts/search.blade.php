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
						<a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a>
					</div>					
				</div>
				@endforeach
				{!!$list_cate -> appends(request()->except('page')) -> links()!!}
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
						<a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a>
					</div>					
				</div>
				@endforeach
				{!!$list_cate -> appends(request()->except('page')) -> links()!!}
			</div>
			
		</div>
		<div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 m-t-30">
			<div class="map_img">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3709.807695902279!2d105.83079121539541!3d21.59342827363624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1584071260154!5m2!1svi!2s" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			</div>
		</div>
		<!--container--> 

		<div id="voteModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="listdish-popup" aria-hidden="true"> 
			<div class="modal-dialog">

			<!-- Modal content-->
				<form action="search_submit" method="get" accept-charset="utf-8">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
							<div class="avata-popup " style="width: 100%;text-align: center;">
								<div class="avata" style="background-image: url('images/avatar.jpg');"></div>
								<p class="bold">tuan</p>
							</div>
						</div>
						<div class="modal-body">
							<p>Would you like to write a review for this EAT?</p>
							<div class="popup-star">
								<label class="customstar star-1">							
									<input type="radio" name="rate_star" value="1">
									<span class="starimg" ></span>
								</label>
								<label class="customstar star-2">							
									<input type="radio" name="rate_star" value="2">
									<span class="starimg" ></span>
								</label>
								<label class="customstar star-3">							
									<input type="radio" name="rate_star" value="3">
									<span class="starimg" ></span>
								</label>
								<label class="customstar star-4">							
									<input type="radio" name="rate_star" value="4">
									<span class="starimg" ></span>
								</label>
								<label class="customstar star-5">							
									<input type="radio" name="rate_star" value="5">
									<span class="starimg "></span>
								</label>
							</div>
							<div class="form-group reviewBox">
								<textarea class="form-control" placeholder="Write Your Review"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<div class="firstWindow" style="width: 100%">
								<button type="button" class="btn btn-primary yesforvote" style="width: 100%">Submit</button>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>


		
	</div>
</div>

@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click','.starimg',function(){
				$(this).closest('.popup-star').find('.starimg').addClass('checkstar');
				$(this).closest('.customstar').nextAll().find('.starimg').removeClass('checkstar');
			});
		});
	</script>
@stop