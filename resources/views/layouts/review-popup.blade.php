

@foreach($info_business->review_rating()->where('type_rate','=',1)->get() as $data)
<div class="row m-b-20">
	<div class="col-lg-2">
		<div class="avata">
			<img src="images/avatar-default.png" alt="" style="width: 80px;">
		</div>
	</div>
	<div class="col-lg-10" style="margin-left: -15px;">
		<div class="content-right p-b-20">
		<h4>{{$data->user->name ?? ""}}</h4>
		<span class="review-date">{{$data -> created_at}}</span>
		<div class="star-view clear p-b-10">
			@for($i = 1;$i <= $data->rate;$i++)
			<i class="fas fa-star star-rate"></i>
			@endfor
			<span class="bold p-l-20">Review business {{$data->business->name}}</span>
		</div>
		
		<p>{{$data->description}}</p>
	</div>
	</div>
</div>
@endforeach