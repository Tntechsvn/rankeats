
@foreach( $reviews as $data)
	{{--@dump($data)--}}
	<div class="list-review m-b-20">
		<div class="avata">
			<img src="{{$data->user->UrlAvatarUser}}" alt="" >
			<div class="photo-img">
				<a href="javascript:;" class="show-photo" data-id="{{$data->user->id}}"><i class="fas fa-camera-retro"></i> 20 photo</a>
				
			</div>
			
		</div>
		<div class="info">
			<div class="content-right p-b-20">
				<h4>{{$data->user->name ?? ""}}</h4>
			
				<div class="star-view clear p-b-10">
					@for($i = 1;$i <= 5;$i++)
					<i class="fas fa-star star-rate"></i>
					@endfor
					<span class="review-date">{{date('m-d-Y', strtotime($data->created_at))}}</span>
				</div>
				<div class="review-address">
					<i class="fas fa-map-marker-alt"></i> {{$data->user->location->address ?? ""}}, {{$data->user->location->city ?? ""}}, {{$data->user->location->state ?? ""}}, {{$data->user->location->country ?? ""}} 
				</div>

				<p>{{$data->review->description}}</p>
				<div class="picture-review">
					<ul id="lightgalleryphoto" style="padding-left: 0">
						@if($data->review->ListImageReview)
							@foreach($data->review->ListImageReview as $val)
								<li class="list-picture" data-responsive="" data-src="images/pizza.jpg">
									<a href="javascript:;" class="lightbox">
										<img width="210" height="145" src="{{$val['url']}}" class="pic" >
									</a>       
								</li>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
@endforeach



{{-- {!!$reviews -> appends(request()->except('page')) -> links()!!} --}}