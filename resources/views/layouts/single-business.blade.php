@extends('layouts_home.master')
@section('content')

<div id="main" class="">
	<div class="banner">
		<img src="images/promo.jpg" alt="" class="fade">
	</div>
	<div class="container" style="background-color: #fff;">
		<div class="inner-content p-b-20" >
			<div  class="">
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
					<div class="businessrank" style="float: left;">
						<h3 class="title m-b-20">Business Rank: 50</h3>
						<div class="clear"></div>
						<table>
							<thead>
								<tr>
									<th>{{$info_business->location->city}}</th>
									<th>{{$info_business->location->state}}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>16</td>
									<td>23</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="eatrank" style="float: left;margin-left: 50px">
						<h3 class="title m-b-20">EATS Rank</h3>
						<div class="clear"></div>
						<table>
							<thead>
								<tr>
									<th>Eat Name</th>
									<th>{{$info_business->location->city}}</th>
									<th>{{$info_business->location->state}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($info_business->business_category as $val)
									<tr>
										<td>{{$val->category_name}}</td>
										<td>16</td>
										<td>23</td>
									</tr>
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="res-menu">
					<h3 class="title m-b-20 m-t-30">Map & Hours</h3>
					<div class="clear"></div>	
					
					<div class="col-lg-6 map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2948.0280704153997!2d-71.05816368426183!3d42.3632410428928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e3708f2d8f5e8b%3A0x76e5ba9980db682e!2s63%20Salem%20St%2C%20Boston%2C%20MA%2002113%2C%20Hoa%20K%E1%BB%B3!5e0!3m2!1svi!2s!4v1585540921075!5m2!1svi!2s" width="800" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						<div class="m-t-20">
							đại từ thái nguyên
							ngọc cô vít
						</div>
					</div>
					<div class="col-lg-6 hours">
						<div>
							<p><span class="bold">Mon</span> 11:30 am - 9:30 pm</p>
							<p><span class="bold">Tue</span> 11:30 am - 9:30 pm</p>
							<p><span class="bold">Wed</span> 11:30 am - 9:30 pm</p>
							<p><span class="bold">Thu</span> 11:30 am - 9:30 pm</p>
							<p><span class="bold">Fri</span> 11:30 am - 9:30 pm</p>
							<p><span class="bold">Sat</span> 11:30 am - 9:30 pm</p>
							<p><span class="bold">Sun</span> 11:30 am - 9:30 pm</p>
						</div>
					</div>
				</div>
				
				<div class="reiview description">
					<h3 class="title m-b-20 m-t-30">Description</h3>
					<div class="clear"></div>	
					
					<p>{{$info_business->description}}</p>
					<div class="tap-pane">
						<ul class="nav nav-tabs" style="border-bottom: none;">
						    <li><a href="#businessinfo" data-toggle="tab" class="btn active"><i class="fas fa-info"></i> Business Info</a></li>
						    <li><a href="#businessreview" data-toggle="tab" class="btn "><i class="fas fa-star"></i> Business Reviews</a></li>
						    <li><a href="#eatrank" data-toggle="tab" class="btn "><i class="fas fa-star"></i> Eat Ranks/Review</a></li>
						    <li><a href="#picture" data-toggle="tab" class="btn "><i class="fas fa-images"></i> Picture</a></li>
						  </ul>
					</div>
					<div class="tab-content">
					    <div class="tab-pane active" id="businessinfo">
					    	<p>
					    		<i class="fas fa-user"></i>
					    		<span class="bold">Owner / Manager :</span>
					    		<span class="bold" style="color: #0073bb">{{$info_business->name}}</span>
					    	</p>
					    	<p>
					    		<i class="fas fa-phone-alt"></i>
					    		<span class="bold">Phone Number :</span>
					    		<span>{{$info_business->phone}}</span>
					    	</p>
					    	<p>
					    		<i class="fas fa-clock"></i>
					    		<span class="bold">Business Opening :</span>
					    		<span>20/3/2020</span>
					    	</p>
					    	<p>
					    		<i class="fas fa-shipping-fast"></i>
					    		<span class="bold">Delivery</span>
					    	</p>
						</div>
					    <div class="tab-pane" id="businessreview">

					    </div>
					    <div class="tab-pane" id="eatrank">
					    	@if($list_reviews->total() >0)
				    			@foreach($list_reviews as $data)
							    	<p>
							    		<i class="fas fa-user"></i>
							    		<span class="bold">Name :</span>
							    		<span class="bold" style="color: #0073bb">{{$data->user->name}}</span>
							    	</p>
							    	<p>
							    		<i class="fas fa-user"></i>
							    		<span class="bold">EAT :</span>
							    		<span>
							    			@foreach($info_business->business_category as $val)
												{{$val->category_name.','}}
											@endforeach
										</span>
							    	</p>
							    	<div >
							    		<label class="m-r-30"><i class="fas fa-globe-americas" style="color: "></i> Country: {{$info_business->location->country}} (12)</label>
							    		<label class="m-r-30"><i class="fas fa-city"></i> City: {{$info_business->location->city}} (12)</label>
							    		<label><i class="fas fa-city"></i> State: {{$info_business->location->state}} (12)</label>
							    	</div>

							    	<p>{{$info_business->description}}</p>
							    	<div class="star-view clear p-b-10">
							    		
												
										@for($i = 1;$i <= $data->review_rating->where('review_id','=',$data->id)->first()->rate;$i++)
											<i class="fas fa-star star-rate"></i>
										@endfor
							    		

							    		
									</div>

								@endforeach
				    		@endif
					    </div>
					    <div class="tab-pane" id="picture">Liên Hệ</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>



		
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