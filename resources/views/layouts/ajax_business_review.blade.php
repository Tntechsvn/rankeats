

@foreach($list_reviews as $data)
	<div class="list-review">
		<p>
    		<i class="fas fa-user"></i>
    		<span class="bold">Name :</span>
    		<span class="bold" style="color: #0073bb">{{$data->user->name}}</span>
    	</p>

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
	<a href="javascript:;" class="btn btn-danger" style="color: #fff;">Voted</a>
	{{-- <a href="javascript:;" data-toggle="modal" data-target="#vote_review" class="btn btn-primary" style="color: #fff;">Write Review</a> --}}
</div>