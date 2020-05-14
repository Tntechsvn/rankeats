@extends('layouts_home.master')
@section('content')
<div id="main" class="main-bg">
  

<div class="promo">
      <div class="front-search">
        @include('layouts.form-search')
      </div>
  <div class="flexslider">
    <ul class="slides">
      <li>
        <a href="javascript:;" title="">
          <img src="images/default.jpg"  style="width: 100%;object-fit: cover;height: 400px;" />
          <h1>Find The Best, Eat The Best</h1>
        </a>
      </li>
      @if(count($ads_active_home))
          @foreach($ads_active_home as $ad)
            <li>
              <a href="{{$ad->business->permalink()}}" title="" >
                <img src="{{$ad->image_url ?? "images/oyster.png"}}"  style="width: 100%;object-fit: cover;height: 400px;" alt="">
                <h1>{{$ad->business->name}}</h1>
              </a>
            </li>
        @endforeach
      @endif
    </ul>
  </div>
  {{-- <div class="container">
    <div class="front-search">
      
      <div class="banner-image">
      @if(count($ads_active_home))
        @foreach($ads_active_home as $ad)
        <div>
          <a href="{{$ad->business->permalink()}}">
            <img src="{{$ad->image_url ?? "images/oyster.png"}}" alt="">
            <span>{{$ad->business->name}}</span>
          </a>
        </div>
        @endforeach
      @else
        <h1>Find The Best, Eat The Best</h1>
      @endif
      </div>
      @include('layouts.form-search')
    </div>
  </div> --}}


    
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
      <div class="grid" data-toggle="modal"> 
        <a class="over-label" data-id="14" href="javascript:;" >{{$data->category_name}}</a> 
        <a><img class="img-responsive" src="@if($data->url_img != null){{asset('').'storage/'.$data->url_img}}@else{{'images/default.jpg'}}@endif" width="500" height="300" alt="{{$data->category_name}}"> </a>
        <input type="hidden" name="category_name"  value="{{$data->category_name}}" />

      </div>
    </div>
    
    @endforeach
    <div class="modal fade in" id="myModal" role="dialog">
      <div class="modal-dialog" style="max-width: 500px;width: 100%;">
        <div class="modal-content">
          <div class="modal-header" style="padding: 25px;">
            <button type="button" class="close" data-dismiss="modal" style="position: absolute;"><i class="fas fa-times-circle"></i></button>
            
          </div>
          <div class="modal-body">
            <h4 class="modal-title p-b-20" style="text-align: center;">Enter the area you want to search for the best <span class="search-name"></span></h4>
            <form method="get" action="{{route('search')}}" class="form-inline">
              <input type="hidden" name="keyword"  value="" />
              <div class="input_hidden1">
                  <input type="hidden" name="city" id="city_searech_cate" value="@if(isset($city)){{$city}}@endif">
                  <input type="hidden" name="state" id="state_searech_cate" value="@if(isset($state_search)){{$state_search}}@endif">
                </div>
              <div class="form-group">
                <div style="position: relative;float: left;">
                    <input type="text" class="form-control location_search" id="location_search_cate" style="border-radius: 0px;width: 340px;" placeholder="City or State">
                    <div id="LocationListcate" class="scroll_search" style="top: 32px;"></div>
                </div>
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

@section('script')

<script type="text/javascript" src="js/jquery.flexslider.js"></script>
  <script type="text/javascript">
    $(document).on('click','.featuredeats',function(){
      var search_name = $(this).find('input[name=category_name]').val();
      var modal = $('#myModal');
      modal.find('input[name=keyword]').val(search_name);
      modal.find('.search-name').html(search_name);
      modal.modal('show');
    });
  </script>
  <script>
  $(document).ready(function(){

$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});


    $('#location_search_cate').keyup(function(){ 
      var val = $(this).val();
      if(val == ""){
        $('#LocationListcate').fadeOut(); 
      }
      $('#city_searech_cate').val('');
      $('#state_searech_cate').val('');
      var query = $(this).val();
      if(query != '')
      {
        var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('fetchCityState') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#LocationListcate').fadeIn();  
            $('#LocationListcate').html(data);
          }
        });
      }
    }).focusout(function(){
      $('#LocationListcate').fadeOut();  
    });

    $(document).on('click', '.location_name', function(e){
      $('#city_searech_cate').remove();
      $('#state_searech_cate').remove();
      $('#location_search_cate').val($(this).text());  
      $('#LocationListcate').fadeOut();

      var arr = [];
      var arr2 = [];

      arr.push($(this).data('city'));
      var selected_values = arr.join(",");

      arr2.push($(this).data('state'));
      var selected_values2 = arr2.join(",");

      $( ".input_hidden1" ).append( '<input type="hidden" name="city" id="city_searech_cate" value="'+selected_values+'">' );
      $( ".input_hidden1" ).append( '<input type="hidden" name="state" id="state_searech_cate" value="'+selected_values2+'">' );

    });
  });
</script>
@stop