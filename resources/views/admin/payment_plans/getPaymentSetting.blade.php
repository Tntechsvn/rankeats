@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
<h1>Payment Settings</h1>
<p>Update payment gateway settings</p>
@stop

@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<div class="col-md-9">
					<!-- general form elements -->
					<div class="card ">
						<div class="card-header">
							<h3 class="card-title">PayPal Settings</h3>
						</div>
						<!-- form start -->
						<form role="form" action="{{route('postPaymentSetting')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}

							<div class="card-body">
								<div class="form-group">
									<label for="inputPPemail">Sandbox</label>
									<input type="checkbox" name="mode" value="sandbox" {{($c->settings->mode == 'sandbox')?'checked':''}}>
								</div>
								<div class="form-group">
									<label for="inputPPemail">Paypal Client Id</label>
									<div class="input-group">
										<input type="text" id="inputPPemail" name="client_id" class="form-control" placeholder="Your PayPal email address (this is the account where the payments will go to)" value="{{$c->client_id}}">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPPemail">Paypal Secret</label>
									<div class="input-group">
										<input type="text" id="inputPPemail" name="secret" class="form-control" placeholder="Your PayPal email address (this is the account where the payments will go to)" value="{{{$c->secret}}}">
									</div>
								</div>
								<div class="form-group">
									<label for="inputCCode">Currency Code</label>

									<select class="form-control" name="inputCCode" id="inputCCode">
										<option value="USD" selected="selected" >USD - U.S. Dollar</option>
									</select>

								</div>
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<button type="submit" id="submitActive" class="btn btn-primary pull-right">Update PayPal Settings</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@stop
