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
