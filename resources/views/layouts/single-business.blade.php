@extends('layouts_home.master')
@section('content')

<div id="main" class="">
	<div class="banner" style="background-image: url('images/promo.jpg');">
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
						<div id="map" style="height: 300px;"></div>
						<div>{{$info_business->location->address}},{{$info_business->location->city}},{{$info_business->location->state}}</div>
					</div>
					<div class="col-lg-6 hours">
						<div>
							@php 
								$days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
							@endphp

							@for($i=0;$i<=6;$i++)
								@php
									$open_from = '';
									$open_till ='';

									foreach($info_business->business_hour as $val){
										if($val -> business_days == $days[$i]){
											$open_from = $val->open_from ?? 'close';
											$open_till = $val->open_till ?? 'close';
										}
									}

								@endphp
								<p><span class="bold">{{$days[$i]}}</span> {{$open_from}} - {{$open_till}}</p>
							@endfor
							
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
					    		@php
									$day_opening = date("Y-m-d",strtotime($info_business->day_opening))
								@endphp
					    		<span>{{$day_opening}}</span>
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
							    		<span class="bold" style="color: #0073bb">{{$data->user->name ?? ""}}</span>
							    	</p>
							    	@if($data->review->ListImageReview)
								    	@foreach($data->review->ListImageReview as $val)
								    	<img src="{{$val['url']}}" width="210px" height="145px;">
								    	@endforeach
							    	@endif

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
				    			<div class="funny funny-{{$data->review->id}}">

				    				<div class="hungry">
				    					<img src="images/hungry.png" alt="">
				    					<button class="funnyy @if($data->review->is_reacted() && $data->review->is_reacted_type() == 1) active @endif" data-type="1" data-review="{{$data->review->id}}">Hungry</button>
				    				</div>
				    				<div class="useful">
				    					<img src="images/useful.png" alt="">
				    					<button class="funnyy @if($data->review->is_reacted() && $data->review->is_reacted_type() == 2) active @endif" data-type="2" data-review="{{$data->review->id}}">Useful</button>
				    				</div>
				    				<div class="cool">
				    					<img src="images/cool.png" alt="">
				    					<button class="funnyy @if($data->review->is_reacted() && $data->review->is_reacted_type() == 3) active @endif" data-type="3" data-review="{{$data->review->id}}">Cool</button>
				    				</div>
				    			</div>
								@endforeach	
								{!!$list_reviews -> appends(request()->except('page')) -> links()!!}							
				    		@endif
				    		<div style="text-align: right;">
				    			@if(Auth::check())
					    			@if(Auth::user()->check_vote($info_business->id))
							    		<a style="color: #fff;" href="javascript:;" class="btn vote vote_now" data-toggle="modal" data-id="{{$info_business->id}}" data-name="{{$info_business->name}}">Vote</a>
							    	@else
							    		<a  href="javascript:;"  class="btn unvote vote" style="color: #fff;" data-id="{{$info_business->id}}" data-name="{{$info_business->name}}" >My vote</a>
							    	@endif
						    	@else

				    				<a href="javascript:;" data-toggle="modal" data-target="#loginModal" class="btn btn-warning" style="color: #fff;">Vote</a>
				    			@endif
						    		{{-- <a href="javascript:;" data-toggle="modal" data-target="#vote_review" class="btn btn-primary" style="color: #fff;">Write Review</a> --}}
						    	</div>
				    		

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
							    	@if($data->review->ListImageReview)
								    	@foreach($data->review->ListImageReview as $val)
								    	<img src="{{$val['url']}}" width="210px" height="145px;">
								    	@endforeach
							    	@endif

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
					    			<a href="javascript:;" data-toggle="modal" data-target="#vote_review" class="btn vote" style="color: #fff;" >Vote</a>
					    			@else
					    			<a href="javascript:;" data-target="#vote_review" data-toggle="modal" class="btn vote" style="color: #fff;background-color: #b7b7b7;">My vote</a>
					    			@endif
				    			@else
				    				<a href="javascript:;" data-toggle="modal" data-target="#loginModal" class="btn btn-warning" style="color: #fff;">Vote</a>
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
		<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="far fa-times-circle"></i></button>
		<h3 class="modal-title bold">EAT Rank / Reviews</h3>
	  </div>
	  <div class="modal-body">
		<form class="" action="" method="post">
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
					<div class="form-group choose-img">
						<div class="form-group"  style="text-align: center;">
							<div  class="dt-imgs">
								<div class="dt-close" style="position:relative;">
									<div id="previews-eat" class="preview-img" style="width: 250px;position: relative;"></div>
								</div>
							</div>
						</div>
						<label for="image_eat" class="choose_img" style="width: 100%;">
							<span style="padding: 5px 20px;border: 1px solid #e1e1e1;border-radius: 5px;display: block;"><i class="fas fa-paperclip"></i> Choose image...</span>
							<input id="image_eat" class="hidden" type="file" value="" accept="image/*" multiple>
						</label>
					</div>
					<div class="form-group reviewBox">
						<textarea class="form-control" placeholder="Write Your Review" name="description" style="height: 150px;"></textarea>
					</div>

				    <div>
				    	<button class=" btn btn-default" data-dismiss="modal">Cancel</button>
				    	<button class="btn btn-primary submit_votereview" type="submit" name="submit">Submit</button>
				    </div>
				</div>
			</div>
		</form>
	  </div>
	</div>
    
  </div>
</div>



@if(Auth::check())
<!-- Knight modan review-->
<div id="voteModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="listdish-popup" aria-hidden="false"> 
	<div class="modal-dialog">

		<!-- Modal content-->
		<form action="" method="post" accept-charset="utf-8">
			@csrf
			<input type="hidden" name="business_id" value="">
			<div class="modal-content">
				<div style="padding: 15px;border-bottom: 1px solid #e5e5e5;">
					<div class="avata-popup " style="width: 100%;text-align: center;">
						<img src="{{Auth::user()->UrlAvatarUser}}" class="img-circle" style="object-fit: cover;" width="200" height="200" alt="{{Auth::user()->name}}">
						<p class="bold">{{Auth::user()->name}}</p>
					</div>
				</div>
				<div class="modal-body">
					<p style="text-align: center;">Would you like to write a review for this Business?</p>
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
						<div class="form-group choose-img">
						<div class="form-group"  style="text-align: center;">
							<div  class="dt-imgs">
								<div class="dt-close" style="position:relative;">
									<div id="previews-business" class="preview-img" style="width: 250px;position: relative;"></div>
								</div>
							</div>
						</div>
						<label for="image_business" class="choose_img" style="width: 100%;">
							<span style="padding: 5px 20px;border: 1px solid #e1e1e1;border-radius: 5px;display: block;"><i class="fas fa-paperclip"></i> Choose image...</span>
							<input id="image_business" class="hidden" type="file" value="" accept="image/*" multiple>
						</label>
					</div>
						<div class="form-group reviewBox">
							<textarea class="form-control" placeholder="Write Your Review" name="description"></textarea>
							<span class="e-lang" style="color: red;font-size: 11px;"></span>
						</div>
					</div>

				</div>
				<div class="modal-footer" style="text-align: center;">
					<div class="verify">
						<a href="javascript:;" data-dismiss="modal" class="btn btn-primary noverify" style="width: 80px;">NO</a>
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
				<button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="fas fa-times-circle"></i></button>
				<h4 class="modal-title">&nbsp;</h4>
			</div>
			<div class="modal-body">
				<p>Must be logged in to Vote, <a href="{{route('sign_in')}}">Login Here</a></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>

	</div>
</div>
<div id="un_vote" class="modal fade in" role="dialog" tabindex="-1" aria-labelledby="popup" aria-hidden="true">
	<div class="modal-dialog">
		<input type="hidden" name="business_id" value="">
		<input type="hidden" name="city_id" value="">
		<input type="hidden" name="unvoted" value="{{route('ajax_unvoted')}}">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<p class="message">You voted for business21; 0/1 votes remain.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button type="submit" class="btn btn-success unvote_submit">Yes</button>
			</div>
		</div>

	</div>
</div>
<input type="hidden" name="vote-ajax" value="{{route('vote_ajax')}}">
<input type="hidden" name="voteReviewEat_ajax" value="{{route('voteReviewEat_ajax')}}">
<input type="hidden" name="postReviewFrontEnd" value="{{route('postReviewFrontEnd')}}">
<input type="hidden" name="reaction_review" value="{{route('reaction_review')}}">
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
			        		swal({
					          title: res.message,
					          timer: 2000
					        });
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
<!--knight test map-->
<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      
							
		var address_business = '{{$info_business->location->address}}'+','+'{{$info_business->location->city}}'+','+'{{$info_business->location->state}}';
      var map;
      var service;
      var infowindow;

      function initMap() {
        var usa = new google.maps.LatLng(37.09024, -95.712891);

        infowindow = new google.maps.InfoWindow();

        map = new google.maps.Map(
            document.getElementById('map'), {center: usa, zoom: 15});

        var request = {
          query: address_business,
          fields: ['name', 'geometry'],
        };

        service = new google.maps.places.PlacesService(map);

        service.findPlaceFromQuery(request, function(results, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
              createMarker(results[i]);
            }

            map.setCenter(results[0].geometry.location);
          }
        });
      }

      function createMarker(place) {
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
    </script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAIK0i2mitUaJvprxOUeROA4GXeBpw7wE&libraries=places&callback=initMap" async defer></script>

 	<script type="text/javascript">
		$(document).ready(function() {
			var images = function(input, imgPreview) {
				if (input.files) {
					var arr = [];
					var filesAmount = input.files.length;
					for (i = 0; i < filesAmount; i++) {
						var reader = new FileReader();
						reader.onload = function(event) {
							$('<div class="dt-close" style="position:relative;"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').appendTo(imgPreview);
						}
						reader.readAsDataURL(input.files[i]);
					}
				}
			};

			$('#image_business').on('change', function() {
				images(this, '#previews-business');
			});
			$('#image_eat').on('change', function() {
				images(this, '#previews-eat');
			});
			/*clear the file list when image is clicked*/
			// $(document).on('click','.deletetimg',function(){
			// 	if(confirm("You want to delete it?"))
			// 	{
			// 		$(this).closest('#previews').html('');
			// 		$("#image_restaurant").val(null);/* xóa tên của file trong input*/
			// 	}
			// 	else
			// 		return false;
			// });
		});
	</script>
@stop