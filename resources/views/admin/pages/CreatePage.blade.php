@extends('adminlte::page')
@section('adminlte_css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@stop
@section('title', 'Rankeats')

@section('content_header')
<h1>Pages</h1>
<p>Manage your pages</p>
@stop

@section('content')
@php
	if(isset($info_page)){
		$route = route('postEditPage',['id_page'=>$info_page->slug]);
		$check_edit = true;
	}else{
		$route = route('postCreatePage');
		$check_edit = false;
	}
@endphp
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<!-- /.col -->
			<div class="col-md-12">
				<div class="card card-primary card-outline">
					<form method="post" action="{{$route}}">
						@csrf
						<div class="card-header">
							<h3 class="card-title">@if($check_edit){{'Edit Pages'}}@else{{'Create New Pages'}}@endif</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="form-group">
								<span>Page Title:</span>
								<input class="form-control" name="page_title" placeholder="page title" value="@if($check_edit){{$info_page->page_title}}@endif">
								<span class="bg-gradient-danger">{{$errors -> first('page_title')}}</span>
							</div>
							<div class="form-group">
								<span>Page Content:</span>
								<textarea id="compose-textarea" class="form-control" style="height: 300px" name="page_content">@if($check_edit){!!$info_page->page_content!!}@endif</textarea>
								<span class="bg-gradient-danger">{{$errors -> first('page_content')}}</span>
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<div class="float-right">
								<button type="submit" class="btn btn-primary">Send</button>
							</div>
						</div>
						<!-- /.card-footer -->
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop
@section('adminlte_js')
<script src="{{asset('vendor/summernote/summernote-bs4.min.js')}}"></script>
<!-- Page Script -->
<script>
	$(function () {
    //Add text editor
    $('#compose-textarea').summernote()
})
</script>
@stop