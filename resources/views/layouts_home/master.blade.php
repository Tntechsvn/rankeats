<!doctype html>
<html lang="">
<head>
<meta charset="utf-8">
<title>Rank Eats</title>
<base href="{{asset('/public/')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>

<link href="https://fonts.googleapis.com/css?family=Lato|Raleway" rel="stylesheet">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/all.css" rel="stylesheet" type="text/css">
<link href="css/fSelect.css" rel="stylesheet" type="text/css">

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAIK0i2mitUaJvprxOUeROA4GXeBpw7wE&libraries=places&language=EN&region=US"></script>
</head>

<body>

<div id="wrap">
  @include('layouts_home.header')
  @yield('content')
  @include('layouts_home.footer')
 

</div>
<!--wrap--> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
{{-- <script src="js/wow.min.js"></script>  --}}
{{-- <script src="js/jquery.raty.js"></script> --}}
{{-- <script src="js/jquery.form.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
{{-- <script src="js/flippy.captcha.js"></script>  --}}
{{-- <script src="js/flippy.origin.js"></script> --}}
 
{{-- <script src="js/flippy.home.js"></script> --}}
<script src="js/all.js"></script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
<!-- <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> -->
@yield('script')
<script type="text/javascript">
  google.maps.event.addDomListener(window, 'load', initialize);
  function initialize(){
    var search = document.getElementById('location_search');
    var autocomplete = new google.maps.places.Autocomplete(search);
    google.maps.event.addListener(autocomplete, 'place_changed', function(){
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      document.getElementById('address_search').value = place.formatted_address;
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
      document.getElementById('city_search').value = city;
      document.getElementById('state_search').value = state;
      document.getElementById('country_search').value = country;     
    });
  };
</script>


</body>
</html> 