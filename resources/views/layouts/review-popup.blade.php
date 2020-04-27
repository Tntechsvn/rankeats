
@foreach( $reviews as $data)
	<div class="list-review m-b-20">
		<div class="avata">
			<img src="{{$data->user->UrlAvatarUser}}" alt="" >
			<div class="photo-img">
				<a href="javascript:;" class="show-photo" data-id="{{$data->user->id}}" data-name="{{$data->user->name}}"><i class="fas fa-camera-retro"></i> {{$data->user->count_photo()}} photo</a>
				
			</div>
			
		</div>
		<div class="info">
			<div class="content-right p-b-20">
				<h4 class="p-b-10"><a href="{{route('user.profile',$data->user->id)}}" class="">{{$data->user->name ?? ""}}</a> {{$data->business->location->city ?? ""}}, {{$data->business->location->state ?? ""}}</h4>
			
				<div class="star-view clear p-b-10">
					<ul class="">
						@php
							$val =  (int) substr(strrchr($data->rate,'.'),1);
							for($x=1;$x<=$data->rate;$x++) {
								echo '<li><i class="fas fa-star star-icon " aria-hidden="true"></i></li>';
							}
							if (strpos($data->rate,'.') && $val != 0) {
								echo '<li><i class="fas fa-star-half-alt star-icon " aria-hidden="true"></i></li>';
								$x++;
							}
							while ($x<=5) {
								echo '<li><i class="far fa-star star-icon " aria-hidden="true"></i></li>';
								$x++;
							}
						@endphp
						
					</ul>
					<span class="review-date">{{date('m-d-Y', strtotime($data->created_at))}}</span>
				</div>
				{{-- <div class="review-address">
					<i class="fas fa-map-marker-alt"></i> {{$data->business->location->address ?? ""}}, {{$data->business->location->city ?? ""}}, {{$data->business->location->state ?? ""}}, {{$data->business->location->country ?? ""}} 
				</div> --}}

				<p>{{$data->review->description}}</p>
				<div class="picture-review">
					<ul class="" style="padding-left: 0">
						@if($data->review->ListImageReview)
							@foreach($data->review->ListImageReview as $val)
								<li class="list-picture" data-responsive="" data-src="{{$val['url']}}">
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