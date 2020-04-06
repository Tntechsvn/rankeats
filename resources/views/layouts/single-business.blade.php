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
					@if($info_business->activated_on)<label class="verify">Verified <i class="far fa-check-square"></i></label> @endif
					<div>
						<a class="check-bookmark" href="javascript:;" data-id="{{$info_business->id}}" data-user="{{Auth::id()}}">
							@if($info_business->is_bookmarked())
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
									<td>{{$info_business->RankBusinessCity}}</td>
									<td>{{$info_business->RankBusinessState}}</td>
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
										<td>{{$val->RankEatCity}}</td>
										<td>{{$val->RankEatState}}</td>
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
							{!!$info_business->location->state!!}
							{!!$info_business->location->city!!}
							
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
						    <li><a href="#businessinfo" data-toggle="tab" class="btn active"><i class="fas fa-info-circle"></i> Business Info</a></li>
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
					    	@if($list_reviews->total() >0)
				    			@foreach($list_reviews as $data)
				    			<div class="list-review">
				    				<p>
							    		<i class="fas fa-user"></i>
							    		<span class="bold">Name :</span>
							    		<span class="bold" style="color: #0073bb">{{$data->user->name}}</span>
							    	</p>
							    	<p>
							    		<i class="fas fa-user"></i>
							    		<span class="bold">EAT :</span>
							    		<span>
							    			{{$info_business->business_category->pluck('category_name')->implode(', ')}}
										</span>
							    	</p>
							    	<div >
							    		<label class="m-r-30"><i class="fas fa-globe-americas" style="color: "></i> Country: {{$data->business->location->country}} (12)</label>
							    		<label class="m-r-30"><i class="fas fa-city"></i> City: {{$data->business->location->city}} (12)</label>
							    		<label><i class="fas fa-city"></i> State: {{$data->business->location->state}} (12)</label>
							    	</div>

							    	<p>{{$data->review->description}}</p>

							    	
							    	<div class="star-view clear p-b-10">
							    		<ul class="star-rate">
								    		@php
									    		$star_review = $data->rate;
												$val =  (int) substr(strrchr($star_review,'.'),1);
												for($x=1;$x<=$star_review;$x++) {
													echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
												}
												if (strpos($star_review,'.') && $val != 0) {
													echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
													$x++;
												}
												while ($x<=5) {
													echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
													$x++;
												}
											@endphp
										</ul>
									</div>
				    			</div>						    	

								@endforeach								
				    		@endif
				    		<div style="text-align: right;">
				    			@if(Auth::check())
				    			@if(Auth::user()->check_vote($info_business->id))
						    		<a  href="javascript:;" @if(!Auth::check()) data-target="#loginModal" @endif class="btn btn-warning @if(Auth::check()) vote_now @endif" data-toggle="modal" data-id="{{$info_business->id}}">Vote</a>
						    	@else
						    		<a  href="javascript:;"  class="btn btn-warning">Voted</a>
						    	@endif

						    	@endif
						    		{{-- <a href="javascript:;" data-toggle="modal" data-target="#vote_review" class="btn btn-primary" style="color: #fff;">Write Review</a> --}}
						    	</div>
				    		@if(Auth::check())
				    		<!-- Knight modan review-->
				    		<div id="voteModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="listdish-popup" aria-hidden="true"> 
				    			<div class="modal-dialog">

				    				<!-- Modal content-->
				    				<form action="{{route('postReviewFrontEnd')}}" method="post" accept-charset="utf-8">
				    					@csrf
				    					<input type="hidden" name="business_id" value="">
				    					<div class="modal-content">
				    						<div class="modal-header">
				    							<div class="avata-popup " style="width: 100%;text-align: center;">
				    								<img src="{{Auth::user()->UrlAvatarUser}}" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}">
				    								<p class="bold">{{Auth::user()->name}}</p>
				    							</div>
				    						</div>
				    						<div class="modal-body">
				    							<p>Would you like to write a review for this EAT?</p>
				    							<div class="okverify hidden">
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

				    						</div>
				    						<div class="modal-footer" style="text-align: center;">
				    							<div class="verify">
				    								<a href="javascript:;" class="btn btn-primary noverify" style="width: 80px;">NO</a>
				    								<a href="javascript:;" class="btn btn-primary yesverify" style="width: 80px;">YES</a>
				    							</div>
				    							<div class="firstWindow hidden" style="width: 100%">
				    								<button type="submit" class="btn btn-primary yesforvote" style="width: 100%">Submit</button>
				    							</div>
				    						</div>
				    					</div>
				    				</form>

				    			</div>
				    		</div>
				    		@endif
				    		<div id="loginModal" class="modal fade in" role="dialog" tabindex="-1" aria-labelledby="popup" aria-hidden="true">
				    			<div class="modal-dialog">

				    				<!-- Modal content-->
				    				<div class="modal-content">
				    					<div class="modal-header">
				    						<button type="button" class="close" data-dismiss="modal">&times;</button>
				    						<h4 class="modal-title">&nbsp;</h4>
				    					</div>
				    					<div class="modal-body">
				    						<p>Must be logged in to Add EAT, <a href="{{route('sign_in')}}">Login Here</a></p>
				    					</div>
				    					<div class="modal-footer">
				    						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				    					</div>
				    				</div>

				    			</div>
				    		</div>
				    		<input type="hidden" name="vote-ajax" value="{{route('vote_ajax')}}">
				    		<!-- end Knight modan review-->
					    </div>
					    <div class="tab-pane" id="eatrank">
					    	@if($list_review_eats->total() >0)
				    			@foreach($list_review_eats as $data)
				    			<div class="list-review">
				    				<p>
							    		<i class="fas fa-user"></i>
							    		<span class="bold">Name :</span>
							    		<span class="bold" style="color: #0073bb">{{$data->user->name}}</span>
							    	</p>
							    	<p>
							    		<i class="fas fa-user"></i>
							    		<span class="bold">EAT :</span>
							    		<span>
							    			{{$data->category->category_name}}
										</span>
							    	</p>
							    	<div>
							    		<label class="m-r-30"><i class="fas fa-city"></i> City: {{$data->business->location->city}} (12)</label>
							    		<label><i class="fas fa-city"></i> State: {{$data->business->location->state}} (12)</label>
							    	</div>

							    	<p>{{$data->review->description}}</p>

							    	
							    		<ul class="star-rate">
								    		@php
									    		$star_review = $data->rate;
												$val =  (int) substr(strrchr($star_review,'.'),1);
												for($x=1;$x<=$star_review;$x++) {
													echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
												}
												if (strpos($star_review,'.') && $val != 0) {
													echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
													$x++;
												}
												while ($x<=5) {
													echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
													$x++;
												}
											@endphp
										</ul>
				    			</div>
								@endforeach								
				    		@endif
				    		<div class="p-t-15" style="text-align: right;">
				    			@if(Auth::check())
					    			@if(Auth::user()->check_vote_eat($info_business->id))
					    			<a href="javascript:;" data-toggle="modal" data-target="#vote_review" class="btn btn-success" style="color: #fff;">Vote</a>
					    			@else
					    			<a href="javascript:;" class="btn btn-danger" style="color: #fff;">Voted</a>
					    			@endif
				    			@endif
				    			{{-- <a href="javascript:;" data-toggle="modal" data-target="#vote_review" class="btn btn-primary" style="color: #fff;">Write Review</a> --}}
				    		</div>
					    </div>
					    <div class="tab-pane" id="picture">
					    	<div class="">
					    		<ul id="lightgalleryphoto">
					    			
					    			<li class="" data-responsive="" data-src="images/pizza.jpg">
	                                    <a href="images/pizza.jpg" class="lightbox">
	                                        
	                                        <img width="210" height="145" src="images/pizza.jpg" class="pic" >
	                                    </a>       
	                                </li>
					    			<li class="" data-responsive="" data-src="images/pizza.jpg">
	                                    <a href="images/pizza.jpg" class="lightbox">
	                                        
	                                        <img width="210" height="145" src="images/pizza.jpg" class="pic" >
	                                    </a>       
	                                </li>
					    			<li class="" data-responsive="" data-src="images/pizza.jpg">
	                                    <a href="images/pizza.jpg" class="lightbox">
	                                        
	                                        <img width="210" height="145" src="images/pizza.jpg" class="pic" >
	                                    </a>       
	                                </li>
					    			<li class="" data-responsive="" data-src="images/pizza.jpg">
	                                    <a href="images/pizza.jpg" class="lightbox">
	                                        
	                                        <img width="210" height="145" src="images/pizza.jpg" class="pic" >
	                                    </a>       
	                                </li>
					    			<li class="" data-responsive="" data-src="images/pizza.jpg">
	                                    <a href="images/pizza.jpg" class="lightbox">
	                                        
	                                        <img width="210" height="145" src="images/pizza.jpg" class="pic" >
	                                    </a>       
	                                </li>
					    			<li class="" data-responsive="" data-src="images/pizza.jpg">
	                                    <a href="images/pizza.jpg" class="lightbox">
	                                        
	                                        <img width="210" height="145" src="images/pizza.jpg" class="pic" >
	                                    </a>       
	                                </li>
					    			<li class="" data-responsive="" data-src="images/pizza.jpg">
	                                    <a href="images/pizza.jpg" class="lightbox">
	                                        
	                                        <img width="210" height="145" src="images/pizza.jpg" class="pic" >
	                                    </a>       
	                                </li>
					    			<li class="" data-responsive="" data-src="images/pizza.jpg">
	                                    <a href="images/pizza.jpg" class="lightbox">
	                                        
	                                        <img width="210" height="145" src="images/pizza.jpg" class="pic" >
	                                    </a>       
	                                </li>
					    		</ul>
					    	</div>
					    </div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>



		
	</div>
</div>

{{-- modal --}}
<div id="vote_review" class="modal fade in" role="dialog">
  <div class="modal-dialog" style="max-width: 500px;width: 100%;">

    <!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title bold">EAT Rank/Reviews</h4>
	  </div>
	  <div class="modal-body">
		<form class="" action="{{route('voteReviewEat_ajax')}}" method="post">
			@csrf
			<input type="hidden" name="business" value="{{$info_business->id}}">
			<div class="form-group">
				Choose eat
				<select class="test choose_dish" multiple="multiple"  name="Category_type[]">
					<optgroup>
						@foreach($info_business->business_category as $menu)
							<option value="{{$menu->id}}">{{$menu->category_name}}</option>
						@endforeach
					</optgroup>
				</select>
				<span class="errors e-dish"></span>
			</div>
			<div class="tap-pane">
				<ul class="nav nav-tabs" style="border-bottom: none;">
					<li><a href="#vote" data-toggle="tab" class="btn active vote-tab"><i class="fas fa-thumbs-up"></i> Vote</a></li>
					<li><a href="#write" data-toggle="tab" class="btn write-tab"><i class="fas fa-star"></i> Write Reviews</a></li>
				</ul>
			</div>
			<div class="tab-content" style="overflow: unset;">
			    <div class="tab-pane active" id="vote">
			    	<p>Which area(s) dose "business name" have the best "Eat item"?</p>
			    	{{-- <div class="form-group">
			    		Country
		    			<input type="text" class="form-control" name="location_country" value="" >
			    	</div> --}}
			    	<div class="form-group">
			    		State
		    			<select class="test state"  name="state">
			             	 <option value="" selected="selected">Select State</option>
			              	@foreach($state as $data)
		                	<option value="{{$data->id}}">{{$data->name}}</option>
			              	@endforeach
		            	</select>
		            	<span class="errors e-state"></span>
			    	</div>
			    	<div class="form-group">
			    		City
		    			<select class="city" name="city">
			                <option value="" selected="selected">Select City</option>
			            </select>
			            <span class="errors e-city"></span>
			    	</div>
			    	
			    	<div>
				    	<button class="btn btn-primary done-vote" type="submit">Done</button>
				    </div>

				</div>
			    <div class="tab-pane" id="write">
			    	<div class="popup-star" style="text-align: center;">
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
						<textarea class="form-control" placeholder="Write Your Review" name="description" style="height: 150px;"></textarea>
					</div>

				    <div>
				    	<button class=" btn btn-default" data-dismiss="modal">Cancel</button>
				    	<button class="btn btn-primary" type="submit" name="submit">Submit</button>
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
	<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
	<script src="lightbox/js/lightgallery-all.min.js"></script>
	<script type="text/javascript" src="js/fSelect.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click','.starimg',function(){
				$(this).closest('.popup-star').find('.starimg').addClass('checkstar');
				$(this).closest('.customstar').nextAll().find('.starimg').removeClass('checkstar');
			});
			$('.test').fSelect();
			$("#lightgalleryphoto").lightGallery();

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


			$(document).on('click','.done-vote',function(e){
				e.preventDefault();
				var form = $(this).closest('form');
				var choose_dish = form.find('.choose_dish').val();
				var choose_state = form.find('.state').val();
				var choose_city = form.find('.city').val();
				if(choose_dish == null){
					form.find('.e-dish').html("error");
					return false;
				}
				if(choose_state == ""){
					form.find('.e-state').html("error");
					return false;
				}
				if(choose_city == ""){
					form.find('.e-city').html("error");
					return false;
				}
				form.find('.vote-tab').removeClass('active');
				form.find('#vote').removeClass('active');
				form.find('.write-tab').addClass('active');
				form.find('#write').addClass('active');
			});


		});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.starimg',function(){
			$(this).addClass('checkstar');
			$(this).closest('.popup-star').find('.starimg').addClass('checkstar');
			$(this).closest('.customstar').nextAll().find('.starimg').removeClass('checkstar');

		});

		// $(document).on('click','.vote_now', function(){
		// 	var user = $('input[name=user]').val();
		// 	var modal_login = $('#loginModal');
		// 	console.log(user);
		// 	if(user == ""){
		// 		modal_login.show();
		// 	}
		// });
	});

	// show form add eat

	$(document).on('click','.rankerBtn',function(){
		var modal = $('#eatModal');
		modal.find('.rankerShow').addClass('show');
	});

	$(document).on('click','.noverify',function(){
		$('#voteModal').hide();
	});
	$(document).on('click','.yesverify',function(){
		$(this).closest('form').find('.okverify').removeClass('hidden');
		$(this).closest('.modal-footer').find('.verify').addClass('hidden');
		$(this).closest('.modal-footer').find('.firstWindow').removeClass('hidden');
	});

</script>
@stop