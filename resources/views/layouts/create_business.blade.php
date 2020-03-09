@extends('layouts_home.master')
@section('content')
<div id="main">


  <div class="container container-main">

    <div class="small-header">
      <h1>Submit Your Business</h1>
    </div>

    <div class="col-md-10 col-md-offset-1 col-submit">
      <form id="formBusiness" class="forms" action="{{route('postCreateBusiness')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="site-tabs-bar">
          <div class="site-tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a data-target="#tab-details" data-toggle="tab">Business Location</a></li>
            </ul>
          </div>
        </div>
        <div class="tab-content">

          <ul class="show-note">
            <li>You will be redirected to the checkout once you submit below form.</li>
            <li>Once your payment is complete you will be able to add more photos and business opening times.</li>
          </ul>

          <div class="tab-pane active" id="tab-details"> 
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputLineOne">Address</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
                    <input type="text" name="search" id="search" class="form-control"  />
                    <input  type="hidden" id="longitude" name="longitude">
                    <input  type="hidden" id="latitude" name="latitude" >
                    <input  type="hidden" id="address" name="address" >
                    <input  type="hidden" id="city" name="city" >
                    <input  type="hidden" id="state" name="state">
                    <input  type="hidden" id="country" name="country">
                  </div>
                  <span class="text-danger"> * {!!$errors -> first('search')!!}</span>
                </div>
            </div>



          </div>
        </div>
        <!--Business Details---->
        <hr>
        <div class="site-tabs-bar">
          <div class="site-tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a data-target="#tab-details" data-toggle="tab">Business Details</a></li>
            </ul>
          </div>
        </div>
        <div class="tab-content">


          <div class="tab-pane active" id="tab-details"> 
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputBizname">Business Name</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="fa fa-info"></span></span>
                    <input type="text" class="form-control input-lg" name="name"placeholder="Business Name">
                     <span class="text-danger"> * {!!$errors -> first('name')!!}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputBizname">Business Email</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="fa fa-info"></span></span>
                    <input type="email" class="form-control input-lg" name="email"placeholder="Business email">
                     <span class="text-danger"> * {!!$errors -> first('email')!!}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputBizname">Business phone</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="fa fa-info"></span></span>
                    <input type="text" class="form-control input-lg" name="phone"  placeholder="Business phone">
                     <span class="text-danger"> * {!!$errors -> first('phone')!!}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Owner Manager Details---->
        <hr>
        <div class="site-tabs-bar">
          <div class="site-tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a data-target="#tab-details" data-toggle="tab">Category Restaurant</a></li>
            </ul>
          </div>
        </div>
        <div class="tab-content">


          <div class="tab-pane active" id="tab-details"> 
            <div class="row">
              <div class="col-md-6">
                <select multiple name="category_id[]" id="">
                  @foreach($category as $data_cate)
                    <option value="{{$data_cate->id}}">{{$data_cate->category_name}}</option>
                  @endforeach
                </select>
                 <span class="text-danger"> * {!!$errors -> first('category_id')!!}</span>
              
              </div>

            </div>
            <button type="submit" id="submitBusiness" class="btn btn-lg btn-custom pull-right">Submit</button>
            <a href="http://rankeats.com" class="btn btn-lg btn-default pull-right" style="margin:0px 10px;">Cancel</a>
          </div>
        </div>

      </form>
    </div>
    <!--col-md-9--> 
    <div class="clearfix"></div>

  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', initialize);
  function initialize(){
    var search = document.getElementById('search');
    var autocomplete = new google.maps.places.Autocomplete(search);
    google.maps.event.addListener(autocomplete, 'place_changed', function(){
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      document.getElementById('address').value = place.formatted_address;
      document.getElementById('longitude').value = place.geometry.location.lng();
      document.getElementById('latitude').value = place.geometry.location.lat();
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        switch (addressType) {
          case 'locality':
          var city = place.address_components[i].long_name;
          break;
          case 'administrative_area_level_1':
          var state = place.address_components[i].long_name;
          break;
          case 'country':
          var country = place.address_components[i].long_name;
          break;
        }
      }
      document.getElementById('city').value = city;
      document.getElementById('state').value = state;
      document.getElementById('country').value = country;     
    });
  };
</script>
@endsection