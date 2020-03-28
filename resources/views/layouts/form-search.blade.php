<form method="get" action="{{route('search')}}" style="display: inline-block;">
	<div class="">
		<div class="input-group syl-cus">
			<div class="input_dish">
				<input autocomplete="off" type="text" class="form-control input-lg location_items" id="location_items" name="keyword" placeholder="Steak, Pizza, Salmon…." value="@if(isset($keyword)){{$keyword}}@endif">
				<!-- <input type="hidden"  name="city" value="all" id="city"> -->				
				<div id="categoryList"></div>
			</div>

			<div class="input_dish">
				<input autocomplete="off" type="text" class="form-control input-lg location_items" id="location_search" name="state" placeholder="City or State" value="">
				<!-- <input type="hidden"  name="city" value="all" id="city"> -->				
				<div id="LocationList"></div>
			</div>
			<span class="input-group-btn">
				<button type="submit" class="btn btn-custom input-lg" style="border-radius: 0;"><span class="glyphicon glyphicon-search"></span><span class="text-search">Search</span></button>
			</span> 
			<div style="clear: both;"></div>
		</div>
	</div>
</form>
