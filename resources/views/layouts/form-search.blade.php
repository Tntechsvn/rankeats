<form method="get" action="{{route('search')}}" style="display: inline-block;">
	<div class="">
	  <div class="input-group syl-cus">
	    <!-- <input type="hidden"  name="city" value="all" id="city"> -->
	    <div class="input_dish">
	      <input type="text" class="form-control input-lg location_items" id="location_items" name="keyword" placeholder="Steak, Pizza, Salmon….">
	    </div>
	    
	    <div class="input_state">
	      <input type="text" class="form-control input-lg location_search" id="location_search" name="location_search" placeholder="City or State">
	      <input  type="hidden" id="address_search" name="address" >
	      <input  type="hidden" id="city_search" name="city" >
	      <input  type="hidden" id="state_search" name="state">
	      <input  type="hidden" id="country_search" name="country">
	    </div>
	    <span class="input-group-btn">
	      <button type="submit" class="btn btn-custom input-lg"><span class="glyphicon glyphicon-search"></span><span class="text-search">Search</span></button>
	    </span> 
	    <div style="clear: both;"></div>
	  </div>
	</div>
</form>
@section('script')
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
@endsection