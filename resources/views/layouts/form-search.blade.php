<form method="get" action="{{route('search')}}" style="display: inline-block;">
	<div class="">
	  <div class="input-group syl-cus">
	    <!-- <input type="hidden"  name="city" value="all" id="city"> -->
	    <div class="input_dish">
	      <input type="text" class="form-control input-lg location_items" id="location_items" name="keyword" placeholder="Steak, Pizza, Salmon…." value="@if(isset($keyword)){{$keyword}}@endif">
	    </div>
	    
	    <div class="input_state">
	      <input type="text" class="form-control input-lg location_search" id="location_search" placeholder="@if(isset($city) && $city !=''){{$city.','.$state}}@else{{'City or State'}}@endif">
	      <input  type="hidden" id="city_search" name="city" value="@if(isset($city)){{$city}}@endif">
	      <input  type="hidden" id="state_search" name="state" value="@if(isset($state)){{$state}}@endif">
	    </div>
	    <span class="input-group-btn">
	      <button type="submit" class="btn btn-custom input-lg" style="border-radius: 0;"><span class="glyphicon glyphicon-search"></span><span class="text-search">Search</span></button>
	    </span> 
	    <div style="clear: both;"></div>
	  </div>
	</div>
</form>
