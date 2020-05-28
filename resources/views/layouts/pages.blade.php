@extends('layouts_home.master')
@section('content')

<div id="main">
	<div class="banner" style="background-image: url('{{asset('public/images/promo.jpg')}}');">
		<img src="{{asset('public/images/promo.jpg')}}" alt="" class="fade">
	</div>
	<div class="container">
		<div class="col-md-8">
			<div class="single recent">
				<h1 class="side-title">{{$info_page -> page_title}}</h1>
				<p class="page-text">{!!$info_page -> page_content!!}</p>

			</div>
		</div>
		<!--col-md-8-->  
		<div class="col-md-4"> 
			<div class="single recent">
				<h3 class="side-title">Featured</h3>
				<a class="pull-link" href="javascript:;"><span class="fa fa-arrow-right"></span> See All Featured</a>

			</div>
		</div>
	</div>

</div>

@endsection