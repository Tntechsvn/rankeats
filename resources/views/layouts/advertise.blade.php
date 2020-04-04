@extends('layouts_home.master')
@section('content')
<div id="main">
  <div class="container" style="padding: 30px 0;">
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
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <select name="plan_detail_id" class="form-control planvalue">
                        @foreach($pay_to_home as $val)
                        <option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
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
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <select name="plan_detail_id" class="form-control planvalue">
                        @foreach($pay_to_home as $val)
                        <option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
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
          {{--<div class="col-md-6">
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
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <select name="plan_detail_id" class="form-control planvalue">
                        @foreach($pay_to_home as $val)
                        <option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
                    </div>
                    <div class="clear"></div>
                  </div>
                </div>
              </div>
              <!--/.Panel --> 
            </div>
            <!--pull-panels--> 
          </div>--}}
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
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <select name="plan_detail_id" class="form-control planvalue">
                        @foreach($pay_to_home as $val)
                        <option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
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
                    <h1 class="plan-title">Search Feature EATS – City </h1>
                  </div>
                  <div class="plan-body">
                    <p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your City for the EATS you choose!</p>

                    @php
                    $pay_to_home = $plan_details->where('pd_plan_id',5)->get();
                    @endphp
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <select name="plan_detail_id" class="form-control planvalue">
                        @foreach($pay_to_home as $val)
                        <option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
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
          {{--<div class="col-md-6">
            <div class="row ">
              <div class="parent-plan">
                <div style="border: 1px solid #dedede;">
                  <div class="">
                    <h1 class="plan-title">Search Feature EATS – County </h1>
                  </div>
                  <div class="plan-body">
                    <p>a. Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your County for the EATS you choose!</p>

                    @php
                    $pay_to_home = $plan_details->where('pd_plan_id',6)->get();
                    @endphp
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <select name="plan_detail_id" class="form-control planvalue">
                        @foreach($pay_to_home as $val)
                        <option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <a data-toggle="modal" data-target="#adver-pop" type="submit" class="btn btn-primary btn-lg seletedplan" >Advertise</a>
                    </div>
                    <div class="clear"></div>
                  </div>
                </div>
              </div>
              <!--/.Panel --> 
            </div>
            <!--pull-panels--> 
          </div>--}}
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
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <select name="plan_detail_id" class="form-control planvalue">
                        @foreach($pay_to_home as $val)
                        <option value="{{$val ->id}}">{{$val ->pd_days}} days - ${{$val ->pd_cost}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 col-xs-6">
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


  </div>

</div><!--main-->
 
<div id="myModal" class="modal fade in" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<form action="submit_advertise.php" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
		 <div class="input-group"> <span class="input-group-addon"><span class="fa fa-info"></span></span>
		 			<input type="text" class="form-control input-lg" name="business_name" value="" id="business_name" placeholder="Business Name" required>
		 		 
		  
		</div>
	  </div>
        <div class="form-group">
		 <div class="input-group"> <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
			<select name="city" class="form-control select_city">
			   
			</select>
		</div>
	  </div>
        <div class="form-group">
		 <div class="input-group"> <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
			<select name="state" class="form-control select_state">
			   
			</select>
		</div>
	  </div>       
	  <div class="form-group ifpaytohome" >
		 <div class="input-group"> <span class="input-group-addon"><span class="fa fa-spoon"></span></span>
			<input type="text" class="form-control input-lg" name="location_items" value="" id="location_items" placeholder="EAT" >
		</div>
	  </div>
       <div class="form-group">
		 <label><input type="radio" name="availability" value="now" required /> Now</label>
		 <label><input type="radio" name="availability" value="date" required /> Date</label>
		  <input type="date" class="form-control input-lg" name="date_available" style="display:none;" id="date_available" >
		</div>
        <div class="form-group">
		<label>Please provide a picture of your EATS at your business</label>
		 <div class="input-group"> <span class="input-group-addon"><span class="fa fa-upload"></span></span>
		  <input type="file" class="form-control input-lg" name="business_pic" id="business_pic"  required>
		</div>
		  <div id="imagePreview"></div>
	  </div>
 	  </div>
      <div class="modal-footer">
		<input type="hidden" name="planname" value="" class="planname" />
		<input type="hidden" name="planinfo" value="" class="planinfo" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" >Submit</button>
      </div>
      </div>
    </div>
	</form>
  </div>
</div>
@if(!Auth())
<div id="loginModal" class="modal fade in" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">&nbsp;</h4>
	  </div>
	  <div class="modal-body">
		<p>Must be logged in to advertise <a href="{{route('sign_in')}}">Login Here</a></p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	</div>
    
  </div>
</div>
@endif

@auth
<div id="adver-pop" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true"> 
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{route('submit.payment')}}" method="post" accept-charset="utf-8" data-parsley-validate>
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
            <input class="form-control" type="hidden" name="pd_id" value="">
          </div>
          <div class="form-group">
            <select class="test state"  name="state" required>
              <option value="" selected="selected">Select State</option>
              @foreach($state as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <select class="city" name="city" required>
                <option value="" selected="selected">Select City</option>
            </select>
          </div>

          <div class="form-group">
            <input type="radio" id="adv-now" name="custom-date" value=""><label for="adv-now">Now</label>
            <input type="radio" id="adv-date" name="custom-date" value="customdate"><label for="adv-date">Date</label>

            <input class="form-control hidden datepicker" type="text" name="custom-datetime" value="" placeholder="dd/mm/YYYY">
          </div> 
         

          <div class="form-group">
            <p>Please provide a picture of your EATS a your business</p>
            <input class="inputPic" type="file" name="image" accept="image/*" required>
            
          </div>
          <div style="width: 100%;float: left;">
            <div id="preview-images" class="pull-left"></div>
          </div>
          <div class="form-group">
            <label for="check-paypal">
              <input id="check-paypal" type="radio" name="paypal" value="paypal" required>
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
@endauth

@endsection

@section('script')
<script type="text/javascript" src="js/fSelect.js"></script>
  <script type="text/javascript">

    $(document).ready(function(){
      $('.test').fSelect();

      $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '0d',
        autoclose: true,
        todayHighlight: true,
      });


      $(document).on('input','#adv-date',function(){
        $(this).closest('.form-group').find('.datepicker').removeClass('hidden');
      });
      $(document).on('input','#adv-now',function(){
        $(this).closest('.form-group').find('.datepicker').addClass('hidden');
        var date = new Date();
        $(this).val(date);
      });
      
    });
      
  </script>
  @if(session('SweetAlert'))
  <script type="text/javascript">
     swal("{{session('SweetAlert')}}");
  </script>
  @endif
  <script type="text/javascript">
    
    $(document).on('click','.seletedplan',function(){
      var modal = $('#adver-pop');
      var title = $(this).closest('.parent-plan').find('.plan-title').html();
      var value = $(this).closest('.plan-body').find('.planvalue').val();
      var text_val = $(this).closest('.plan-body').find('.planvalue option:selected').text();
      modal.find('.modal-header h2').html(title); 
      modal.find('input[name=title]').val(title);
      modal.find('input[name=pd_id]').val(value);
      modal.find('input[name=show-val]').val(text_val);
    });


  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      $('.inputPic').click(function(e) {

        var previews = document.getElementById('preview-images');
        if (previews.hasChildNodes()) {
          alert('Bạn Chỉ Có Thể Chọn Một Ảnh Cho Mục Này');
          e.preventDefault();
        }     
      });
      var images = function(input, imgPreview) {
        if (input.files) {
          var arr = [];
          var filesAmount = input.files.length;
          for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function(event) {
              $('<div class="dt-close" style="position:relative;"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').append("<img class='thumb' src='"+event.target.result+"'"+"style='width:100%;'>").append('<div class="deletetimg tsm"><i class="fas fa-times-circle"></i></div>').appendTo(imgPreview);
            }
            reader.readAsDataURL(input.files[i]);
          }
        }
      };

      $('.inputPic').on('change', function() {

        images(this, '#preview-images');
        // $('#preview-avatar-old').addClass('hidden');
      });
      /*clear the file list when image is clicked*/
      $(document).on('click','.deletetimg',function(){
        if(confirm("Bạn Muốn Xóa Ảnh Này?"))
        {
          $(this).parent().remove();
          $(".inputPic").val(null);/* xóa tên của file trong input*/
          // $('#preview-avatar-old').removeClass('hidden');
        }
        else
          return false;
      }); 
    });
  </script>

@stop
@php session()->forget('SweetAlert'); @endphp