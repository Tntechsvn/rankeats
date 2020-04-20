

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
	<div class="funny funny-{{$data->review->id}}">

		<div class="hungry">
			<img src="images/hungry.png" alt="">
			<button class="funnyy @if($data->review->is_reacted() && $data->review->is_reacted_type() == 1) active @endif" data-type="1" data-review="{{$data->review->id}}">Hungry</button>
		</div>
		<div class="useful">
			<img src="images/useful.png" alt="">
			<button class="funnyy @if($data->review->is_reacted() && $data->review->is_reacted_type() == 2) active @endif" data-type="2" data-review="{{$data->review->id}}">Useful</button>
		</div>
		<div class="cool">
			<img src="images/cool.png" alt="">
			<button class="funnyy @if($data->review->is_reacted() && $data->review->is_reacted_type() == 3) active @endif" data-type="3" data-review="{{$data->review->id}}">Cool</button>
		</div>
	</div>
@endforeach	

{!!$list_reviews -> appends(request()->except('page')) -> links()!!}
<div class="p-t-15" style="text-align: right;">
	<a href="javascript:;" class="btn vote unvote" style="color: #fff;">Voted</a>
</div>