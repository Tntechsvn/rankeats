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
    @foreach($category as $data)
    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 col-box wow fadeInUp animated featuredeats" style="visibility: visible; animation-name: fadeInUp;" >
      <div class="grid" data-toggle="modal" data-target="#myModal"> <a class="over-label" data-id="14" href="javascript:;" >{{$data->category_name}}</a> <a><img class="img-responsive" src="@if($data->url_img != null){{asset('').'/storage/'.$data->url_img}}@else{{'images/Spaghetti.jpg'}}@endif" width="500" height="300" alt="{{$data->category_name}}"> </a>
        <input type="hidden" name="category_name"  value="{{$data->category_name}}" />

      </div>
    </div>
    
    @endforeach
    <div class="modal fade in" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enter the area you want to search for the best {{$data->category_name}}</h4>
          </div>
          <div class="modal-body">
            <form method="get" action="{{route('search')}}" class="form-inline">
              <input type="hidden" name="keyword"  value="" />
              <div class="form-group">
                <input type="text" class="form-control location_search" id="location_search_cate" style="border-radius: 0px;" placeholder="City or State">
                <input  type="hidden" id="city_search_cate" name="city" value="@if(isset($city)){{$city}}@endif">
                <input  type="hidden" id="state_search_cate" name="state" value="@if(isset($state)){{$state}}@endif">
                <button type="submit" class="btn btn-custom" style="border-radius: 0px;">Search Results</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection