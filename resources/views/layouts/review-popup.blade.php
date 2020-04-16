

@foreach($reviews as $review)
<div class="row m-b-20">
	<div class="col-lg-2">
		<div class="avata">
			<img src="{{($review->user->url_avatar) ? asset('').'storage/'.($review->user->url_avatar) : 'images/avatar-default.png'}}" alt=""  style="width: 80px;height: 80px;object-fit: cover;border-radius: 50%;">
		</div>
	</div>
	<div class="col-lg-10" style="margin-left: -15px;">
		<div class="content-right p-b-20">
		<h4>{{$review->user->name ?? ""}}</h4>
		<span class="review-date">{{$review -> created_at}}</span>
		<div class="star-view clear p-b-10">
			@for($i = 1;$i <= $review->rate;$i++)
			<i class="fas fa-star star-rate"></i>
			@endfor
			<span class="bold p-l-20">Review business {{$review->business->name}}</span>
		</div>
		
		<p>{{$review->description}}</p>
	</div>
	</div>
</div>
@endforeach