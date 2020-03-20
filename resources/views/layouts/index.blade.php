@extends('layouts_home.master')
@section('content')
<div id="main" class="main-bg">
  

<div class="promo">
  <div class="container">
    <div class="front-search">
      <h1>Find The Best, Eat The Best</h1>
      @include('layouts.form-search')
    </div>
  </div>
</div>

<!-- for map div -->
<div class="container-fluid col-top map-business">
  <div class="container">
    <div class="col-md-6 text-center">
      <h2 style="line-height: 2; margin: 44px;">Finding the top EATS in your area or an area you are visiting just got easier. People, such as yourself, vote on the best EATS anywhere in the country. Who has the best EATS in your area? </h2>
    </div>
    <div class="col-md-6 text-center">
      <div class="map_img">
        <img src="images/map.jpg" alt="MAP IMAGE" class="details_image">
      </div>
    </div>
  </div>
</div>


<div class="container-fluid col-top map-business">
    <div class="container">
        <div class="col-md-6 text-center">
            <div class="map_img">
              <img src="images/business.png" alt="MAP IMAGE" class="details_image">
            </div>
          </div>
      <div class="col-md-6 text-center">
        <h2 style="line-height: 2; margin: 44px;">Business owners, do you have the best pizza in your city, county or state? fries? burgers? Whatever it is, we have it here, and you can see first-hand where your EATS rank in the eyes of your customers in your area! Take the info along with their reviews of your EATS and use them to improve or change your EATS and go up in rank bringing more customers to your door.</h2>
      </div>
    </div>
  </div>


<div class="container-fluid col-center howitwork">
  <div class="container col-how">
    <h2 class="wow bounceIn">How It Works</h2>
    <div class="col-sm-6 col-xs-12 col-md-3 col-lg-3 col-h-info wow bounceInLeft"> <i class="fa fa-search fa-4x"></i>
      <h3>Search Eats</h3>
      <p>Simply search for the best Eats in an area of your choice.</p>
    </div>
    <div class="col-sm-6 col-xs-12 col-md-3 col-lg-3 col-h-info wow bounceInDown"> <i class="fas fa-utensils fa-4x"></i>
      <h3>Enjoy!</h3>
    </div>
    <div class="clear hidden-lg hidden-xs hidden-md"></div>
    <div class="col-sm-6 col-xs-12 col-md-3 col-lg-3 col-h-info wow bounceInUp"> <i class="fa fa-check-circle fa-4x"></i>
      <h3>Vote</h3>
      <p>Vote for your favorite Eats in an area.</p>
    </div>
    
    <div class="col-sm-6 col-xs-12 col-md-3 col-lg-3 col-h-info wow bounceInRight"> <i class="fa fa-comments fa-4x"></i>
      <h3>Review</h3>
      <p>Write a review for the Eats or business in an area.</p>
    </div>
    
  </div>
<!--container col-how--> 
</div>
<!--container-fluid col-center-->



<div class="container-fluid col-top">
    <div class="container col-bottom-reviews">
      <h3 class="wow bounceIn">Feature Eats</h3>
      <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp animated featuredeats" style="visibility: visible; animation-name: fadeInUp;" data-toggle="modal" data-target="#myModal1">
        <div class="grid"> <a class="over-label" data-id="10" href="javascript:;">Fried Chicken</a> <a><img class="img-responsive" src="images/fried_chicken.jpg" width="500" height="300" alt="Fried Chicken"> </a>
          <!--<h3><a>Fried chicken</a></h3>-->
        </div>
      </div>
      
      <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp animated featuredeats" style="visibility: visible; animation-name: fadeInUp;" data-toggle="modal" data-target="#myModal2">
        <div class="grid"> <a class="over-label" data-id="7" href="javascript:;">Pizza</a> <a><img class="img-responsive" src="images/pizza.jpg" width="500" height="300" alt="Pizza"> </a>
          <!--<h3><a>Pizza</a></h3>-->
        </div>
      </div>

      <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp animated featuredeats" style="visibility: visible; animation-name: fadeInUp;" data-toggle="modal" data-target="#myModal3">
        <div class="grid"> <a class="over-label" data-id="11" href="javascript:;">Burgers</a> <a><img class="img-responsive" src="images/burger.jpg" width="500" height="300" alt="Burgers"> </a>
          <!--<h3><a>Burgers</a></h3>-->
        </div>
      </div>

      <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp animated featuredeats" style="visibility: visible; animation-name: fadeInUp;" data-toggle="modal" data-target="#myModal4">
        <div class="grid"> <a class="over-label" data-id="12" href="javascript:;">Steaks</a> <a><img class="img-responsive" src="images/steaks.jpg" width="500" height="300" alt="Steaks"> </a>
          <!--<h3><a>Steaks</a></h3>-->
        </div>
      </div>

      <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp animated featuredeats" style="visibility: visible; animation-name: fadeInUp;" data-toggle="modal" data-target="#myModal5">
        <div class="grid"> <a class="over-label" data-id="13" href="javascript:;">Salmon</a> <a><img class="img-responsive" src="images/Salmon.jpg" width="500" height="300" alt="Salmon"> </a>
          <!--<h3><a>Salmon</a></h3>-->
        </div>
      </div>

        <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp animated featuredeats" style="visibility: visible; animation-name: fadeInUp;" >
          <div class="grid" data-toggle="modal" data-target="#myModal6"> <a class="over-label" data-id="14" href="javascript:;" >Spaghetti</a> <a><img class="img-responsive" src="images/Spaghetti.jpg" width="500" height="300" alt="Spaghetti"> </a>
           
          </div>
        </div>
    <div class="modal fade in" id="myModal6" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter the area you want to search for the best Spaghetti</h4>
      </div>
      <div class="modal-body">
        <form method="get" action="search.php" class="form-inline">
          <input type="hidden" class="location_items" name="location_items">
          <input type="hidden" name="eat"  value="Spaghetti" />
          <div class="form-group">
            <input type="text" class="form-control location_search" name="location_search" style="border-radius: 0px;" placeholder="City or State">
            <button type="submit" class="btn btn-custom" style="border-radius: 0px;">Search Results</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<div class="modal fade in" id="myModal1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Enter the area you want to search for the best Fried chicken</h4>
    </div>
    <div class="modal-body">
      <form method="get" action="search.php" class="form-inline">
      <input type="hidden" class="location_items" name="location_items">
      <input type="hidden" name="eat"  value="Fried chicken" />
      <div class="form-group">
        <input type="text" class="form-control location_search" name="location_search" style="border-radius: 0px;" placeholder="City or State">
        <button type="submit" class="btn btn-custom" style="border-radius: 0px;">Search Results</button>
      </div>
      </form>
    </div>
    </div>
  </div>
</div>


<!--container-fluid col-center-->
<div class="modal fade in" id="myModal2" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Enter the area you want to search for the best Pizza</h4>
    </div>
    <div class="modal-body">
      <form method="get" action="search.php" class="form-inline">
      <input type="hidden" class="location_items" name="location_items">
      <input type="hidden" name="eat"  value="Pizza" />
      <div class="form-group">
        <input type="text" class="form-control location_search" name="location_search" style="border-radius: 0px;" placeholder="City or State">
        <button type="submit" class="btn btn-custom" style="border-radius: 0px;">Search Results</button>
      </div>
      </form>
    </div>
    </div>
  </div>
</div>

<div class="modal fade in" id="myModal3" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Enter the area you want to search for the best Burgers</h4>
    </div>
    <div class="modal-body">
      <form method="get" action="search.php" class="form-inline">
      <input type="hidden" class="location_items" name="location_items">
      <input type="hidden" name="eat"  value="Burgers" />
      <div class="form-group">
        <input type="text" class="form-control location_search" name="location_search" style="border-radius: 0px;" placeholder="City or State">
        <button type="submit" class="btn btn-custom" style="border-radius: 0px;">Search Results</button>
      </div>
      </form>
    </div>
    </div>
  </div>
</div>


<div class="modal fade in" id="myModal4" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Enter the area you want to search for the best Steaks</h4>
    </div>
    <div class="modal-body">
      <form method="get" action="search.php" class="form-inline">
      <input type="hidden" class="location_items" name="location_items">
      <input type="hidden" name="eat"  value="Steaks" />
      <div class="form-group">
        <input type="text" class="form-control location_search" name="location_search" style="border-radius: 0px;" placeholder="City or State">
        <button type="submit" class="btn btn-custom" style="border-radius: 0px;">Search Results</button>
      </div>
      </form>
    </div>
    </div>
  </div>
</div>

<div class="modal fade in" id="myModal5" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Enter the area you want to search for the best Salmon</h4>
    </div>
    <div class="modal-body">
      <form method="get" action="search.php" class="form-inline">
      <input type="hidden" class="location_items" name="location_items">
      <input type="hidden" name="eat" value="Salmon" />
      <div class="form-group">
        <input type="text" class="form-control location_search" name="location_search" style="border-radius: 0px;" placeholder="City or State">
        <button type="submit" class="btn btn-custom" style="border-radius: 0px;">Search Results</button>
      </div>
      </form>
    </div>
    </div>
  </div>
</div>

</div>
@endsection