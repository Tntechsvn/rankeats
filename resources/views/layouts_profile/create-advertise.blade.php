@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container container-main content-profile">
		<div class="row">
			<div class="col-md-3">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 content-search">
				<h3 class="title">Create Advertisement</h3>
				<div class="create-advertise">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="row pull-panels">
								<div class="panel panel-default">
									<div class="panel-heading panel-heading-1">
										<h1 class="panel-title">Pay to Home EATS</h1>
									</div>
									<div class="panel-body">
										<p>At the top of the home page you can add a pic of your business to a 3 pic rotation which will be seen by everyone when they visit us. The name of your business, along with the City and State, will also appear in the lower right of the pic which will link to your business home page. </p>
										<form action="{{route('payment_plan_advertisement')}}" method="post">
											@csrf

											@php
											$pay_to_home = $plan_details->where('pd_plan_id',1)->get();
											@endphp
											<div class="col-md-6">
												<select name="plan_detail_id" class="form-control planvalue">
													@foreach($pay_to_home as $val)
													<option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</button>
											</div>
										</form>
									</div>
								</div>
								<!--/.Panel --> 
							</div>
							<!--pull-panels--> 
						</div>
						<div class="col-md-6">
							<div class="row pull-panels">
								<div class="panel panel-default">
									<div class="panel-heading panel-heading-1">
										<h1 class="panel-title">Search EATS – City </h1>
									</div>
									<div class="panel-body">
										<p>At the top of the search results page for the City and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business.</p>
										<form action="{{route('payment_plan_advertisement')}}" method="post">
											@csrf
											@php
											$pay_to_home = $plan_details->where('pd_plan_id',2)->get();
											@endphp
											<div class="col-md-6">
												<select name="plan_detail_id" class="form-control planvalue">
													@foreach($pay_to_home as $val)
													<option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-lg seletedplan">Advertise</button>
											</div>
										</form>
									</div>
								</div>
								<!--/.Panel --> 
							</div>
							<!--pull-panels--> 
						</div>

					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="row pull-panels">
								<div class="panel panel-default">
									<div class="panel-heading panel-heading-1">
										<h1 class="panel-title">Search EATS – County </h1>
									</div>
									<div class="panel-body">
										<p>At the top of the search results page for the County and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business home page if clicked on. </p>
										<form action="{{route('payment_plan_advertisement')}}" method="post">
											@csrf
											@php
											$pay_to_home = $plan_details->where('pd_plan_id',3)->get();
											@endphp
											<div class="col-md-6">
												<select name="plan_detail_id" class="form-control planvalue">
													@foreach($pay_to_home as $val)
													<option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</button>
											</div>
										</form>
									</div>
								</div>
								<!--/.Panel --> 
							</div>
							<!--pull-panels--> 
						</div>
						<div class="col-md-6">
							<div class="row pull-panels">
								<div class="panel panel-default">
									<div class="panel-heading panel-heading-1">
										<h1 class="panel-title">Search EATS – State </h1>
									</div>
									<div class="panel-body">
										<p>At the top of the search results page for the State and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business home page if clicked on. </p>
										<form action="{{route('payment_plan_advertisement')}}" method="post">
											@csrf
											@php
											$pay_to_home = $plan_details->where('pd_plan_id',4)->get();
											@endphp
											<div class="col-md-6">
												<select name="plan_detail_id" class="form-control planvalue">
													@foreach($pay_to_home as $val)
													<option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</button>
											</div>
										</form>
									</div>
								</div>
								<!--/.Panel --> 
							</div>
							<!--pull-panels--> 
						</div>

					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="row pull-panels">
								<div class="panel panel-default">
									<div class="panel-heading panel-heading-1">
										<h1 class="panel-title">Search Feature EATS – City </h1>
									</div>
									<div class="panel-body">
										<p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your City for the EATS you choose!</p>
										<form action="{{route('payment_plan_advertisement')}}" method="post">
											@csrf
											@php
											$pay_to_home = $plan_details->where('pd_plan_id',5)->get();
											@endphp
											<div class="col-md-6">
												<select name="plan_detail_id" class="form-control planvalue">
													@foreach($pay_to_home as $val)
													<option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</button>
											</div>
										</form>
									</div>
								</div>
								<!--/.Panel --> 
							</div>
							<!--pull-panels--> 
						</div>
						<div class="col-md-6">
							<div class="row pull-panels">
								<div class="panel panel-default">
									<div class="panel-heading panel-heading-1">
										<h1 class="panel-title">Search Feature EATS – County </h1>
									</div>
									<div class="panel-body">
										<p>a.	Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your County for the EATS you choose!</p>
										<form action="{{route('payment_plan_advertisement')}}" method="post">
											@csrf
											@php
											$pay_to_home = $plan_details->where('pd_plan_id',6)->get();
											@endphp
											<div class="col-md-6">
												<select name="plan_detail_id" class="form-control planvalue">
													@foreach($pay_to_home as $val)
													<option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</button>
											</div>
										</form>
									</div>
								</div>
								<!--/.Panel --> 
							</div>
							<!--pull-panels--> 
						</div>

					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="row pull-panels">
								<div class="panel panel-default">
									<div class="panel-heading panel-heading-1">
										<h1 class="panel-title">Search Feature EATS – State </h1>
									</div>
									<div class="panel-body">
										<p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your State for the EATS you choose! </p>
										<form action="{{route('payment_plan_advertisement')}}" method="post">
											@csrf
											@php
											$pay_to_home = $plan_details->where('pd_plan_id',7)->get();
											@endphp
											<div class="col-md-6">
												<select name="plan_detail_id" class="form-control planvalue">
													@foreach($pay_to_home as $val)
													<option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</button>
											</div>
										</form>
									</div>
								</div>
								<!--/.Panel --> 
							</div>
							<!--pull-panels--> 
						</div>

					</div>
				</div>
				<h3 class="title">Business Advertisement</h3>
				<div class="business-advertise">
					@foreach($advertisement as $data)
					<div class="col-lg-12 m-b-20">
						<div class="col-lg-3">
							<div class="img">
								<img src="images/pizza.jpg" alt="" style="width: 100%">
							</div>
						</div>
						<div class="col-lg-9">
							<div class="in4">
								<h4>{{$data->plan_detail->plan_detail->name}}</h4>
								<p class="name-city "><i class="fas fa-info-circle"></i>title</p>
								<p class="day-city"><i class="fas fa-calendar-alt"></i>{{$data->plan_detail->pd_days}} day</p>
								<p class="expiration-city"><i class="fas fa-calendar-times"></i> expiration-date: {{$data->expiration_date}}</p>
								<p class="price-city"><i class="fas fa-dollar-sign"></i>Price: ${{$data->plan_detail->pd_cost}}</p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')

@stop