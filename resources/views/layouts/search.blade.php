@extends('layouts_home.master')
@section('content')
  
<div id="main" class="main-bg">
   <div class="col-sm-12 col-xs-12  col-md-8 col-lg-8  col-box wow fadeInUp" style="margin-top:30px;">
  	<div class="food-main">
		<div class="imbx">
			<img class="img-responsive" src="templates/origin/images/map_main.png" alt="">
		</div>
		<div class="imbx-detail">
			<div class="pr-dtl">
				<h4>1.Neptune Oyster</h4>
				<ul>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
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
			<a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a>
		</div>
	</div>

  	<div class="food-main">
		<div class="imbx">
			<img class="img-responsive" src="templates/origin/images/map_main.png" alt="">
		</div>
		<div class="imbx-detail">
			<div class="pr-dtl">
				<h4>1.Neptune Oyster</h4>
				<ul>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>
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
			<a href="#" data-target="#voteModal" class="btn btn-warning vote_now" data-toggle="modal" >Vote</a>
		</div>
	</div>

   
  </div>
    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp">
  <div class="map_img">
        <img src="templates/origin/images/map_main.png" alt="MAP IMAGE" class="details_image">
      </div><br /><br />
	  <div><h4>Is the EAT for a business you’re looking for missing?</h4>
	  <div class="underMap" style="margin-top:10px;"><a data-target="#loginModal" data-toggle="modal" style="color:#fff;" class="btn btn-primary" >Add EAT </a></div>
	  </div>
  </div>
  <!--container--> 

<nav id="page-nav"><a href="data_search.php?page=2&amp;term=&amp;city="></a></nav>
<div id="voteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">&nbsp;</h4>
	  </div>
	  <div class="modal-body">
		<p>Would you like to write a review for this EAT?</p>
		<div class="form-group reviewBox" style="display:none;">
			<textarea class="form-control" placeholder="Write Your Review"></textarea>
            </div>
	  </div>
	  <div class="modal-footer">
		<div class="firstWindow">
		<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
		<button type="button" class="btn btn-primary yesforvote">Yes</button>
		</div>
		<div class="secondWindow" style="display:none;">
		<button type="button" class="btn btn-primary cancelvote" data-dismiss="modal">Cancel</button>
		<button type="button" class="btn btn-primary">Submit</button>
		</div>
	  </div>
	</div>
    
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

@endsection