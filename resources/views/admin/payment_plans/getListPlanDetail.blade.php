@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
<h1>Payment Plans</h1>
<p>Update payment plans</p>
@stop

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">Pay to Home</h3>
					</div>
					<!-- form start -->
					<form role="form" action="{{route('postPaymentPlan')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						@php
							$pay_to_home = $plan_details->where('pd_plan_id',1)->get();
						@endphp
						<div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								@foreach($pay_to_home as $val)
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="{{$val ->pd_days}}" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="{{$val ->pd_cost}}" class="form-group">
								</div>
								@endforeach
							</div>
						</div>
						<!-- /.card-body -->

						<div class="card-footer">
							<input type="hidden" name="plan_id" value="1">
							<button type="submit" id="submitActive" class="btn btn-primary pull-right">Update Pay to Home</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">Pay to Search EATS - City</h3>
					</div>
					<!-- form start -->
					<form role="form" action="{{route('postPaymentPlan')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						@php
							$pay_to_home = $plan_details->where('pd_plan_id',2)->get();
						@endphp
						<div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								@foreach($pay_to_home as $val)
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="{{$val ->pd_days}}" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="{{$val ->pd_cost}}" class="form-group">
								</div>
								@endforeach
							</div>
						</div>
						<!-- <div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="30" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="10.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="180" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="49.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="364" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="199.99" class="form-group">
								</div>
						
							</div>
						</div> -->
						<!-- /.card-body -->

						<div class="card-footer">
							<input type="hidden" name="plan_id" value="2">
							<button type="submit" id="submitActive" class="btn btn-primary pull-right">Pay to Search EATS - City</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">Pay to Search EATS - County</h3>
					</div>
					<!-- form start -->
					<form role="form" action="{{route('postPaymentPlan')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						@php
							$pay_to_home = $plan_details->where('pd_plan_id',3)->get();
						@endphp
						<div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								@foreach($pay_to_home as $val)
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="{{$val ->pd_days}}" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="{{$val ->pd_cost}}" class="form-group">
								</div>
								@endforeach
							</div>
						</div>
						<!-- <div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="30" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="10.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="180" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="49.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="364" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="199.99" class="form-group">
								</div>
						
							</div>
						</div> -->
						<!-- /.card-body -->

						<div class="card-footer">
							<input type="hidden" name="plan_id" value="3">
							<button type="submit" id="submitActive" class="btn btn-primary pull-right">Pay to Search EATS - County</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">Pay to Search EATS - State</h3>
					</div>
					<!-- form start -->
					<form role="form" action="{{route('postPaymentPlan')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						@php
							$pay_to_home = $plan_details->where('pd_plan_id',4)->get();
						@endphp
						<div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								@foreach($pay_to_home as $val)
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="{{$val ->pd_days}}" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="{{$val ->pd_cost}}" class="form-group">
								</div>
								@endforeach
							</div>
						</div>
						<!-- <div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="30" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="10.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="180" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="49.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="364" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="199.99" class="form-group">
								</div>
						
							</div>
						</div> -->
						<!-- /.card-body -->

						<div class="card-footer">
							<input type="hidden" name="plan_id" value="4">
							<button type="submit" id="submitActive" class="btn btn-primary pull-right">Pay to Search EATS - State</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">Pay to Search Feature - City</h3>
					</div>
					<!-- form start -->
					<form role="form" action="{{route('postPaymentPlan')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						@php
							$pay_to_home = $plan_details->where('pd_plan_id',5)->get();
						@endphp
						<div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								@foreach($pay_to_home as $val)
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="{{$val ->pd_days}}" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="{{$val ->pd_cost}}" class="form-group">
								</div>
								@endforeach
							</div>
						</div>
						<!-- <div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="30" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="10.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="180" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="49.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="364" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="199.99" class="form-group">
								</div>
						
							</div>
						</div> -->
						<!-- /.card-body -->

						<div class="card-footer">
							<input type="hidden" name="plan_id" value="5">
							<button type="submit" id="submitActive" class="btn btn-primary pull-right">Pay to Search Feature - City</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">Pay to Search Feature - County</h3>
					</div>
					<!-- form start -->
					<form role="form" action="{{route('postPaymentPlan')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						@php
							$pay_to_home = $plan_details->where('pd_plan_id',6)->get();
						@endphp
						<div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								@foreach($pay_to_home as $val)
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="{{$val ->pd_days}}" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="{{$val ->pd_cost}}" class="form-group">
								</div>
								@endforeach
							</div>
						</div>
						<!-- <div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="30" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="10.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="180" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="49.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="364" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="199.99" class="form-group">
								</div>
						
							</div>
						</div> -->
						<!-- /.card-body -->

						<div class="card-footer">
							<input type="hidden" name="plan_id" value="6">
							<button type="submit" id="submitActive" class="btn btn-primary pull-right">Pay to Search Feature - County</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- left column -->
			<div class="col-md-6">
				<!-- general form elements -->
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">Pay to Search Feature - State</h3>
					</div>
					<!-- form start -->
					<form role="form" action="{{route('postPaymentPlan')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						@php
							$pay_to_home = $plan_details->where('pd_plan_id',7)->get();
						@endphp
						<div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								@foreach($pay_to_home as $val)
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="{{$val ->pd_days}}" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="{{$val ->pd_cost}}" class="form-group">
								</div>
								@endforeach
							</div>
						</div>
						<!-- <div class="card-body">
							<div class="form-group">
								<label for="inputPPemail">Activation Rates</label>
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="30" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="10.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="180" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="49.99" class="form-group">
								</div>
						
								<div class="addmore">
									Days <input type="text" name="paytohome[days][]" value="364" class="form-group ">
									Cost <input type="text" name="paytohome[price][]" value="199.99" class="form-group">
								</div>
						
							</div>
						</div> -->
						<!-- /.card-body -->

						<div class="card-footer">
							<input type="hidden" name="plan_id" value="7">
							<button type="submit" id="submitActive" class="btn btn-primary pull-right">Pay to Search Feature - State</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@stop
