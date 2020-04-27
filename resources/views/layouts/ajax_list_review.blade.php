

@foreach($list_review_eats as $data)
	<div class="list-review">
		<p>
    		<i class="fas fa-user"></i>
    		<span class="bold">Name :</span>
    		<span class="bold" style="color: #0073bb">{{$data->user->name}}</span>
    	</p>
    	<p>
    		<i class="fas fa-user"></i>
    		<span class="bold">EAT :</span>
    		<span>
    			{{$data->category->category_name}}
			</span>
    	</p>
    	<div>
    		<label class="m-r-30"><i class="fas fa-city"></i> City: {{$data->business->location->city}} (12)</label>
    		<label><i class="fas fa-city"></i> State: {{$data->business->location->state}} (12)</label>
    	</div>

    	<p>{{$data->review->description}}</p>

    	
    		<ul class="star-rate">
	    		@php
		    		$star_review = $data->rate;
					$val =  (int) substr(strrchr($star_review,'.'),1);
					for($x=1;$x<=$star_review;$x++) {
						echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
					}
					if (strpos($star_review,'.') && $val != 0) {
						echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
						$x++;
					}
					while ($x<=5) {
						echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
						$x++;
					}
				@endphp
			</ul>
	</div>
	@endforeach	
	<div class="p-t-15" style="text-align: right;">
		<a href="javascript:;" data-target="#vote_review" data-toggle="modal" class="btn vote" style="color: #fff;background-color: #b7b7b7;">My vote</a>
	</div>