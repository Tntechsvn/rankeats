@extends('layouts_home.master')
@section('content')

<div id="main" class="">
	<div class="banner">
		<img src="images/promo.jpg" alt="" class="fade">
	</div>
	<div class="container container-main">
		<div class="col-sm-8 col-xs-8  col-md-8 col-lg-8 inner-content  p-b-20" >
			<div style="background-color: #fff;" class=" p-l-15 p-r-15">
				<div class="p-t-30 p-b-30 top-content-res">
					<h1 class="big-title">{{$info_business->name}}</h1>
					@if($info_business->activated_on)<button>Verified<i class="far fa-check-square"></i></button> @endif
					<div>
						<a class="check-bookmark" href="javascript:;" data-id="{{$info_business->id}}" data-user="{{Auth::id()}}">
							@if($bookmark)
							<i class="fas fa-bookmark"></i> bookmark
							@else
							<i class="far fa-bookmark"></i> bookmark
							@endif
						</a>
						
					</div>
				</div>
				<div class="location-res">
					<p>
						<i class="fa fa-star star-rate" aria-hidden="true"></i>
						<i class="fa fa-star star-rate" aria-hidden="true"></i>
						<i class="fa fa-star star-rate" aria-hidden="true"></i>
						<i class="fa fa-star star-rate" aria-hidden="true"></i>
						<i class="fa fa-star star-rate" aria-hidden="true"></i>
						({{$info_business->rate_business()}})
					</p>
					<p>
						<i class="fas fa-map-marker-alt"></i>
						{{$info_business->location-> address}}
					</p>
					<p style="color: #95bbdb;" class="bold">
						<i class="fas fa-building"></i>
						@foreach($info_business->business_category as $val)
							{{$val->category_name.','}}
						@endforeach
					</p>
				</div>
				<div class="res-menu">
					<h3 class="title m-b-20 m-t-30">Menu</h3>
					<div class="clear"></div>	
					<div class="row m-b-30">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-b-10">
							<h4 class="p-b-10"><i class="fas fa-caret-right"></i> com xa xiu </h4>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-b-10">
							<h4 class="p-b-10"><i class="fas fa-caret-right"></i> com xa xiu</h4>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
						</div>
						<div class="clear"></div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-b-10">
							<h4 class="p-b-10"><i class="fas fa-caret-right"></i> com xa xiu</h4>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-b-10">
							<h4 class="p-b-10"><i class="fas fa-caret-right"></i> com xa xiu</h4>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
						</div>
						<div class="clear"></div>
					</div>
					<button class="load-more">Load More</button>
				</div>
				
				<div class="reiview">
					<h3 class="title m-b-20 m-t-30">Reviews</h3>
					<div class="clear"></div>	
					@foreach($list_reviews as $data)
						<div class="row m-b-20">
							<div class="col-lg-1">
								<div class="avata">
									<img src="@if($data->user->url_avatar != null){{asset('').'storage/'.$data->user->url_avatar}}@else{{'images/avatar-default.png'}}@endif" alt="" style="width: 70px;">
								</div>
							</div>
							<div class="col-lg-11">
								<div class="content-right p-b-20">
								<h4>{{$data->user->name}}</h4>
								<span class="review-date">{{$data -> created_at}}</span>
								<div class="star-view clear p-b-10">
									@for($i = 1;$i <= $data->review_rating->where('review_id','=',$data->id)->first()->rate;$i++)
									<i class="fas fa-star star-rate"></i>
									@endfor
									<span class="bold p-l-20">Review business {{$data->business->name}}</span>
								</div>
								
								<p>{{$data->description}}</p>
							</div>
							</div>
						</div>
						@endforeach
						{!!$list_reviews -> appends(request()->except('page')) -> links()!!}
					
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
		<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 inner-sidebar">
			<div class="right-sidebar" style="background-color: #fff;padding: 30px 15px 0px;">
				<h3 class="title m-b-20">List Restaurent Featured</h3>
				<div class="clear"></div>	
				<div class="row m-b-20 p-t-20">
					<div class="col-lg-4">
						<div class="avata" >
							<img src="images/avatar-default.png" alt="" style="width: 100%;">
						</div>
					</div>
					<div class="col-lg-8">
						<div class="content-right p-b-20">
							<h4>name reviews</h4>
							<div class="star-view clear p-b-10">
								<i class="fas fa-star star-rate"></i>
								<i class="fas fa-star star-rate"></i>
								<i class="fas fa-star star-rate"></i>
								<i class="fas fa-star star-rate"></i>
								<i class="fas fa-star star-rate"></i>
							</div>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et lorem sit amet justo consequat porttitor. Fusce ut ultrices nunc. Suspendisse ut porta libero, quis venenatis nisi. Phasellus pellentesque, est at fermentum rutrum, ante purus suscipit arcu, sit amet sollicitudin nibh lorem vitae odio.</p>
						</div>
					</div>
				</div>
				<div class="row m-b-20">
					<div class="col-lg-4">
						<div class="avata" >
							<img src="images/avatar-default.png" alt="" style="width: 100%;">
						</div>
					</div>
					<div class="col-lg-8">
						<div class="content-right p-b-20">
							<h4>name reviews</h4>
							<div class="star-view clear p-b-10">
								<i class="fas fa-star star-rate"></i>
								<i class="fas fa-star star-rate"></i>
								<i class="fas fa-star star-rate"></i>
								<i class="fas fa-star star-rate"></i>
								<i class="fas fa-star star-rate"></i>
							</div>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et lorem sit amet justo consequat porttitor. Fusce ut ultrices nunc. Suspendisse ut porta libero, quis venenatis nisi. Phasellus pellentesque, est at fermentum rutrum, ante purus suscipit arcu, sit amet sollicitudin nibh lorem vitae odio.</p>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!--container--> 



		
	</div>
</div>

@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			// $(document).on('click','.starimg',function(){
			// 	$(this).closest('.popup-star').find('.starimg').addClass('checkstar');
			// 	$(this).closest('.customstar').nextAll().find('.starimg').removeClass('checkstar');
			// });


			$(document).on('click','.check-bookmark',function(){
				var $this = $(this);
				var user = $(this).data('user');
				var id_business = $(this).data('id');

				var url = "{{route('ajax-bookmark')}}";

				$.ajax({
					headers: {
			          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        },
			        type:'POST',
			        url: url,
			        data: {
			        	business: id_business,
			        	user: user
			        },

			        success:function(res){
			        	if(res.success == true){
			        		if(res.book==true){
			        			$this.find('.fa-bookmark').attr('data-prefix','fas');
			        		}else{
			        			$this.find('.fa-bookmark').attr('data-prefix','far');
			        		}
			        	}else{
			        		alert('error');
			        	}
			        }
				});
			});
		});
	</script>
@stop