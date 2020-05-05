@extends('adminlte::page')

@section('title', 'Rankeats')
@section('adminlte_css')
<link rel="stylesheet" href="{{asset('lightbox/lightgallery.css')}}">
<link href ="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel = "stylesheet" crossorigin="anonymous">
@stop

@section('content_header')
	<h1>Advertisements</h1>
@stop

@section('content')

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
	                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
	                	<li class="nav-item">
	                		<a class="nav-link active" id="ads_pending" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Pending Ads</a>
	                	</li>
	                	<li class="nav-item">
	                		<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Active Ads</a>
	                	</li>
	                	<li class="nav-item">
	                		<a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Expired Ads</a>
	                	</li>
	                </ul>
	                <div class="tab-content" id="custom-tabs-one-tabContent">
	                	<div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="ads_pending">
	                		<h3>Pending Pay to Home</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_pending_home as $ad)
							    			@include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_pending_home)
						    		<div id="note">Could not find any Pending Pay to Home</div>
						    	@endif
						    </div>
						    <h3>Pending Pay to Search EATS</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_pending_search as $ad)
						    			    @include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_pending_search)
						    		<div id="note">Could not find any Pending Pay to Search EATS<</div>
						    	@endif
						    </div>
						    <h3>Pending Pay to Feature EATS</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_pending_feature as $ad)
						    			    @include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_pending_feature)
						    		<div id="note">Could not find any Pending Pay to Feature EATS<</div>
						    	@endif
						    </div>
	                	</div>
	                	<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
	                		<h3>Active Pay to Home</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_active_home as $ad)
						    			    @include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_active_home)
						    		<div id="note">Could not find any Active Pay to Home</div>
						    	@endif
						    </div>
						    <h3>Active Pay to Search EATS</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_active_search as $ad)
						    			    @include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_active_search)
						    		<div id="note">Could not find any Active Pay to Search EATS<</div>
						    	@endif
						    </div>
						    <h3>Active Pay to Feature EATS</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_active_feature as $ad)
						    			    @include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_active_feature)
						    		<div id="note">Could not find any Active Pay to Feature EATS<</div>
						    	@endif
						    </div>
	                	</div>
	                	<div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
	                		<h3>Expired Pay to Home</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_expired_home as $ad)
						    			    @include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_expired_home)
						    		<div id="note">Could not find any Expired Pay to Home</div>
						    	@endif
						    </div>
						    <h3>Expired Pay to Search EATS</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_expired_search as $ad)
						    			    @include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_expired_search)
						    		<div id="note">Could not find any Expired Pay to Search EATS<</div>
						    	@endif
						    </div>
						    <h3>Expired Pay to Feature EATS</h3>
						    <div class="panel-body panel-full">
						    	<table class="table table-bordered" id="table">
						    		<thead>
						    			<tr>
						    				<th>#</th>
						    				<th>Transaction Date</th>
						    				<th>User</th>
						    				<th>Business Name</th>
						    				<th>City</th>
						    				<th>State</th>
						    				<th>Duration</th>
						    				<th>Pic</th>
						    				<th>Status</th>
						    				<th>Manage</th>
						    			</tr>
						    		</thead>
						    		<tbody id="show-content">
						    			@foreach ($ads_expired_feature as $ad)
						    			    @include('admin.content-ad', [$ad])
						    			@endforeach
						    		</tbody>
						    	</table>
						    	@if(!$ads_expired_feature)
						    		<div id="note">Could not find any Expired Pay to Feature EATS<</div>
						    	@endif
						    </div>
	                	</div>
	                </div>
				</div>
			</div>
		</div>
		
	</section>

@stop
@section('adminlte_js')
<script src = "https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" crossorigin="anonymous"></script>
<!-- Ekko Lightbox -->
<script src="{{asset('lightbox/lightgallery.min.js')}}"></script>
<script>
	$(document).on("click", '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
		$(this).ekkoLightbox();
	});
</script>
<script>
	function approveFunction() {
    var r = confirm("You want to approve advertisements?");
    if (r == true) {
      $(document).on('click', '.btnApprove',function(e){
        var arr = [];
        arr.push($(this).data('approve'));
        var selected_values = arr.join(",");

        var link = "{{route('approvedAdv')}}";
        $.ajax({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'post',
          url: link,
          data: 'list_id='+selected_values,
          success:function(data){
            console.log(data);
            if(data.success){
              window.location.reload();
              alert(data.message);
            }else{
              alert(data.message);
            }
          }
        });
      });
    }
  }

  function delLangFunction() {
    var r = confirm("You want to delete advertisements?");
    if (r == true) {
      $(document).on('click', '.del_lang',function(e){
        var arr = [];
        arr.push($(this).data('id'));
        var selected_values = arr.join(",");

        var link = "{{route('deleteAdv')}}";
        $.ajax({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'post',
          url: link,
          data: 'list_id='+selected_values,
          success:function(data){
            console.log(data);
            if(data.success){
              window.location.reload();
              alert(data.message);
            }else{
              alert(data.message);
            }
          }
        });
      });
    }
  }
</script>
@stop