@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
<h1>Key Google Map Settings</h1>
<p>Update key google map settings</p>
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
							<h3 class="card-title">Key Google Map Settings</h3>
						</div>
						<!-- form start -->
						<form role="form" action="{{route('postMapSetting')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}

							<div class="card-body">
								<div class="form-group">
									<label for="inputPPemail">Paypal Secret</label>
									<div class="input-group">
										<input type="text" id="inputPPemail" name="keymap" class="form-control" placeholder="Your Key Map" value="{{{$c->keymap}}}">
									</div>
									<span class="text-danger">{{$errors -> first('keymap')}}</span>
								</div>
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<button type="submit" id="submitActive" class="btn btn-primary pull-right">Update Key Google Map</button>
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
