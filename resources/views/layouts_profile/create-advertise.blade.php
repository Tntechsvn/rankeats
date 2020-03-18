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
					<div class="col-md-6">
						<div class="row ">
							<div class="parent-plan">
								<div style="border: 1px solid #dedede;">
									<div>
										<h1 class="plan-title">Pay to Home EATS</h1>
									</div>
									<div class="plan-body">
										<p>At the top of the home page you can add a pic of your business to a 3 pic rotation which will be seen by everyone when they visit us. The name of your business, along with the City and State, will also appear in the lower right of the pic which will link to your business home page. </p>
										

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
											<a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
								
							</div>
							<!--/.Panel --> 
						</div>
						<!--pull-panels--> 
					</div>
					<div class="col-md-6">
						<div class="row ">
							<div class="parent-plan">
								<div style="border: 1px solid #dedede;">
									<div class="">
										<h1 class="plan-title">Search EATS – City </h1>
									</div>
									<div class="plan-body">
										<p>At the top of the search results page for the City and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business.</p>
		
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
											<a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<!--/.Panel --> 
						</div>
						<!--pull-panels--> 
					</div>
					<div class="clear"></div>
					<span class="line"></span>
					<div class="col-md-6">
						<div class="row ">
							<div class="parent-plan">
								<div style="border: 1px solid #dedede;">
									<div class="">
										<h1 class="plan-title">Search EATS – County </h1>
									</div>
									<div class="plan-body">
										<p>At the top of the search results page for the County and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business home page if clicked on. </p>
			
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
											<a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<!--/.Panel --> 
						</div>
						<!--pull-panels--> 
					</div>
					<div class="col-md-6">
						<div class="row ">
							<div class="parent-plan">
								<div style="border: 1px solid #dedede;">
									<div class="">
										<h1 class="plan-title">Search EATS – State </h1>
									</div>
									<div class="plan-body">
										<p>At the top of the search results page for the State and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business home page if clicked on. </p>

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
											<a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<!--/.Panel --> 
						</div>
						<!--pull-panels--> 
					</div>
					<div class="clear"></div>
					<span class="line"></span>
					<div class="col-md-6">
						<div class="row ">
							<div class="parent-plan">
								<div style="border: 1px solid #dedede;">
									<div class="">
										<h1 class="plan-title">Search Feature EATS – City </h1>
									</div>
									<div class="plan-body">
										<p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your City for the EATS you choose!</p>

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
											<a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<!--/.Panel --> 
						</div>
						<!--pull-panels--> 
					</div>
					<div class="col-md-6">
						<div class="row ">
							<div class="parent-plan">
								<div style="border: 1px solid #dedede;">
									<div class="">
										<h1 class="plan-title">Search Feature EATS – County </h1>
									</div>
									<div class="plan-body">
										<p>a.	Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your County for the EATS you choose!</p>

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
											<a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<!--/.Panel --> 
						</div>
						<!--pull-panels--> 
					</div>
					<div class="clear"></div>
					<span class="line"></span>
					<div class="col-md-6">
						<div class="row ">
							<div class="parent-plan">
								<div style="border: 1px solid #dedede;">
									<div class="">
										<h1 class="plan-title">Search Feature EATS – State </h1>
									</div>
									<div class="plan-body">
										<p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your State for the EATS you choose! </p>

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
											<a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<!--/.Panel --> 
						</div>
						<!--pull-panels--> 
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

{{-- modal popup--}}
<div id="adver-pop" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true"> 
	<div class="modal-dialog">

		<!-- Modal content-->
		<form action="#" method="post" accept-charset="utf-8">
			@csrf
			<input type="hidden" name="title" value="">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
					<h2>play home</h2>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input class="form-control" type="text" name="name" value="{{Auth::user()->name}}" readonly>
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="show-val" value="" readonly>
						<input class="form-control" type="hidden" name="price" value="">
					</div>
					<div class="form-group">
						<p>Please provide a picture of your EATS a your business</p>
						<input type="file" name="" accept="image/*">
					</div>
					<div class="form-group">
						<p>Please provide a picture of your EATS a your business</p>
						<label for="check-paypal">
							<input id="check-paypal" type="radio" name="paypal" value="">
							<img src="images/paypal.png" alt="" width="100px">
						</label>
						
					</div>
				</div>
				<div class="modal-footer">
					<div class="firstWindow" style="width: 100%">
						<button type="submit" class="btn btn-primary " style="width: 100%">Payment</button>
					</div>
				</div>
			</div>
		</form>

	</div>
</div>


@endsection
@section('script')
	<script type="text/javascript">
		
		$(document).on('click','.seletedplan',function(){
			var modal = $('#adver-pop');
			var title = $(this).closest('.parent-plan').find('.plan-title').html();
			var value = $(this).closest('.plan-body').find('.planvalue').val();
			var text_val = $(this).closest('.plan-body').find('.planvalue option:selected').text();
			modal.find('.modal-header h2').html(title); 
			modal.find('input[name=title]').val(title);
			modal.find('input[name=price]').val(value);
			modal.find('input[name=show-val]').val(text_val);
		});


	</script>

@stop