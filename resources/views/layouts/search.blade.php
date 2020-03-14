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
				<div class="food-main">
					<div class="imbx">
						<img class="" src="images/map_main.png" alt="" style="width: 100%;">
					</div>
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>1.Neptune Oyster</h4>
							<ul>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
							</ul>
							<p>4723 <i>reviews</i></p>
							<div class="pr-dtail">
								<ul class="p-t-15">
									<li>$$$.</li>
									<li>,Desserts</li>
									<li>,Gelato</li>
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>(617) 742-3474</p>
							<p>63 salem St</p>
							<p>North End</p>
						</div>

						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam <a href="javascript:;">read more</a></p>
						<a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a>
					</div>
				</div>
			</div>
			<div class="results-all">
				<h3 class="title">All Results</h3>
				<div class="food-main">
					<div class="imbx">
						<img class="" src="images/map_main.png" alt="" style="width: 100%;">
					</div>
					<div class="imbx-detail">
						<div class="pr-dtl">
							<h4>1.Neptune Oyster</h4>
							<ul>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
								<li><i class="fa fa-star star-rate" aria-hidden="true"></i></li>
							</ul>
							<p>4723 <i>reviews</i></p>
							<div class="pr-dtail">
								<ul>
									<li>$$$.</li>
									<li>,Desserts</li>
									<li>,Gelato</li>
								</ul>
							</div>
						</div>
						<div class="pr-dtlr">
							<p>(617) 742-3474</p>
							<p>63 salem St</p>
							<p>North End</p>
						</div>

						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam <a href="javascript:;">read more</a></p>
						<a href="javascript:;" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a>
					</div>
				</div>
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

		<nav id="page-nav"><a href="data_search.php?page=2&amp;term=&amp;city="></a></nav> 
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
		<div id="eatModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<form action="submit_eat.php" method="POST">
					<input type="hidden" name="item_id" value="" />
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add EAT</h4>
						</div>
						<div class="modal-body">
							<a href="#"  data-target="#loginModal" data-toggle="modal" style="color:#fff;" class="btn btn-primary rankerBtn">Ranker</a>&nbsp;<a href="http://rankeats.com/register"  class="btn btn-primary" style="color:#fff;">Owner/Manager </a>
							<div class="rankerShow" style="display:none;">
								<div class="form-group">
									<label for="eat_item">EAT</label>
									<input type="text" class="form-control input-lg" name="eat_item" id="eat_item" placeholder="Item" value="" readonly />
								</div>
								<div class="form-group">
									<label for="eat_location">Location</label>
									<input type="text" class="form-control input-lg" name="eat_location" id="eat_location" placeholder="Location" value="" readonly />
								</div>
								<div class="form-group">
									<label for="business_name">Business Name</label>
									<input type="text" class="form-control input-lg" name="business_name" id="business_name" placeholder="Business Name" required />
								</div>
								<div class="form-group">
									<label for="address">Address</label>
									<input type="text" class="form-control input-lg" name="address" id="address" placeholder="Address" required  />
								</div>
								<div class="form-group">
									<label for="zip_code">Zip Code</label>
									<input type="text" class="form-control input-lg" name="zip_code" id="zip_code" placeholder="Zip Code" required  />
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div id="loginModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">&nbsp;</h4>
					</div>
					<div class="modal-body">
						<p>Must be logged in to Add EAT, <a href="http://rankeats.com/login">Login Here</a></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('click','.starimg',function(){
				$(this).addClass('checkstar');
				$(this).closest('.popup-star').find('.starimg').addClass('checkstar');
				$(this).closest('.customstar').nextAll().find('.starimg').removeClass('checkstar');
			});
		});
	</script>
@stop