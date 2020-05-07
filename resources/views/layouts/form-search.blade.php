<form method="get" action="{{route('search')}}" style="display: inline-block;" >
	<div class="">
		<div class="input-group syl-cus">
			<div class="input_dish">
				<input autocomplete="off" required type="text" class="form-control input-lg location_items" id="location_items" name="keyword" placeholder="Steak, Pizza, Salmon…." value="@if(isset($keyword)){{$keyword}}@endif">
				<!-- <input type="hidden"  name="city" value="all" id="city"> -->				
				<div id="categoryList" class="scroll_search"></div>
			</div>

			<div class="input_state">
				<input autocomplete="off"  type="text" class="form-control input-lg location_items" id="location_search" placeholder="City or State" value="@if(isset($text_city_state)){{$text_city_state}}@endif">
				<!-- <input type="hidden"  name="city" value="all" id="city"> -->				
				<div id="LocationList" class="scroll_search"></div>
				<div class="input_hidden">
					<input type="hidden" name="city" id="city_searech" value="@if(isset($city)){{$city}}@endif">
      				<input type="hidden" name="state" id="state_searech" value="@if(isset($state_search)){{$state_search}}@endif">
				</div>
			</div>
			<span class="input-group-btn">
				<button type="submit" class="btn btn-custom input-lg" style="border-radius: 0;"><span class="glyphicon glyphicon-search"></span><span class="text-search">Search</span></button>
			</span> 
			<div style="clear: both;"></div>
		</div>
	</div>
</form>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Please enter the keyword to search for EAT");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})
</script>