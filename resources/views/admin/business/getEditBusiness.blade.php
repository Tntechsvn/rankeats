@extends('adminlte::page')

@section('adminlte_css')
<link href="{{asset('public/css/all.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/css/fSelect.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/css/style.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/css/jquery.timepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('public/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
@stop

@section('title', 'Rankeats')
@section('content_header')
    <h1>Edit Businesses</h1>
    <p>Manage edit  businesses</p>
@stop
@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!--/.col (right) ------------------------------------------------------------------------------------------>
          <div class="col-md-12">
            <div class="tab-content" style="margin-right: -15px;">
          <div>
            <form class="" action="{{route('postEditBusiness',['id_business'=>$info_business->id])}}" method="post" accept-charset="utf-8">
              @csrf
              <div class="form-group">
                <label>Business Picture</label>
                <div class="form-group"  style="text-align: center;">
                  <div  class="dt-imgs">
                    <div class="dt-close" style="position:relative;">
                      <div id="previews" class="preview-img" style="width: 250px;">@if($info_business ->url_img != null)<img class='thumb' src="{{asset('').'public//storage/'.$info_business ->url_img}}" style='width:100%;'><div class="deletethumb tsm"><i class="fas fa-times-circle"></i></div>@endif</div>
                    </div>
                  </div>
                </div>
                <label for="image_restaurant" class="choose_img">
                  <span style="padding: 5px 20px;border: 1px solid #e1e1e1;border-radius: 5px;"><i class="fas fa-paperclip"></i> Choose image...</span>
                  <input id="image_restaurant" class="hidden" type="file" value="" accept="image/*">
                </label>

              </div>
              <div class="form-group">
                <label>Name</label>
                <div class="input-group" >
                  <input type="text" class="form-control " value="{{$info_business->name}}" readonly="readonly">
                  <span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="">Email</label>               
                <div class="input-group" >
                  <input type="email" class="form-control " name="email" value="{{$info_business->email}}">
                  <span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="">Phone Number</label>                
                <div class="input-group">
                  <input type="phone" class="form-control " name="phone" value="{{$info_business->phone}}">
                  <span class="bg-danger color-palette">{{$errors -> first('phone')}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for=""><p>Website</p></label>                
                <div class="input-group">
                  <input type="text" class="form-control " name="website" value="{{$info_business->website}}">
                  <span class="bg-danger color-palette">{{$errors -> first('website')}}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="">Add Business Opening</label>                
                @php
                  $date = date("Y-m-d",strtotime($info_business->day_opening))
                @endphp
                <div class="input-group">
                  <input type="text" class="form-control datepicker" name="day_opening" placeholder="YYYY/mm/dd" value="{{$date}}">
                  <span class="bg-danger color-palette">{{$errors -> first('name')}}</span>
                </div>
              </div>
              <!-- location new -->
              <div id="add-location">
                @if(count($info_business->locations) == 0)
                  <div class="locationedit location-address">
                    <div class="form-group">
                      <p>Address</p>
                      <div class="input-group" style="width: 100%">
                        <input type="text" class="form-control address" name="address1" value="">
                        <span class="bg-danger color-palette">{{$errors -> first('address')}}</span>
                      </div>
                    </div>
                    <div class="state_city" style="display: flex;justify-content: space-between;">
                      <div class="form-group" style="width: 30%">
                      
                        <div class="input-group" style="width: 100%">
                          <p>State</p>
                            <select class="form-control state_profile"  name="state1"  id="state_profile">
                                     <option value="" selected="selected">Select State</option>
                                     @foreach($state as $data)
                                     <option value="{{$data->name}}">{{$data->name}}</option>
                                     @endforeach
                                  </select>
                                  <span class="bg-danger color-palette">{{$errors -> first('state')}}</span>
                        </div>
                      </div>
                      <div class="form-group" style="width: 30%">
                        <div class="input-group" style="width: 100%">
                          <p>City</p>
                          <select class="form-control city_profile" id="city_profile1" name="city1" style="width: 100%;">
                                    <option value="" selected="selected">Select City</option>
                                </select>
                                <span class="bg-danger color-palette">{{$errors -> first('city')}}</span>
                        </div>
                      </div>
                      <div class="form-group" style="width: 30%">
                        <div class="input-group" style="width: 100%">
                          <p>Zipcode</p>
                          <input type="text" class="form-control zipcode_profile" name="zipcode1" value="">
                          <span class="bg-danger color-palette">{{$errors -> first('zipcode')}}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <?php $i = 1 ;
                    foreach($info_business->locations as $val){
                  ?>
                  
                    
                    <div class="locationedit location-address">
                      <div class="form-group">
                        <p>Address</p>
                        <div class="input-group" style="width: 100%">
                          <input type="text" class="form-control address" name="address{{$i}}" value="{{$val->address}}">
                        </div>
                      </div>
                      <div class="state_city" style="display: flex;justify-content: space-between;">
                        <div class="form-group" style="width: 30%">               
                          <div class="input-group" style="width: 100%">
                            <p>State</p>
                            <select class="form-control choose-state state_profile"  name="state{{$i}}" >
                              <option value="" selected="selected">Select State</option>
                              @foreach($state as $data)
                              <option value="{{$data->name}}" 
                                @if($val->state == $data->name){{'selected'}}@endif
                                >{{$data->name}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group" style="width: 30%">
                          <div class="input-group" style="width: 100%">
                            <p>City</p>
                            <select class="form-control choose-city city_profile" name="city{{$i}}" style="width: 80%;">
                              <option value="" selected="selected">Select City</option>
                              @if($val->city != null)
                              <option  value="{{$val->city}}" selected >{{$val->city}}</option>
                              @endif                         
                            </select>
                          </div>
                        </div>
                        <div class="form-group" style="width: 30%">
                          <div class="input-group" style="width: 100%">
                            <p>Zipcode</p>
                            <input type="text" class="form-control zipcode_profile" name="zipcode{{$i}}" value="{{$val->code}}">
                            <span class="bg-danger color-palette">{{$errors -> first('zipcode')}}</span>
                          </div>
                        </div>
                      </div>
                      @if( $i != 1)
                      <a href="javascript:;" title="" class="delete_location">Delete</a>
                      @endif  
                    </div>
                              
                  <?php
                    $i++;
                    }
                  ?>
                @endif                
              </div>
              <div id="add-location-button" class="p-b-20">
                <button class="btn btn-success addlocation">Add Location</button>
                @php
                  if(count($info_business->locations) == 0){
                    $number_location = 1;
                  }else{
                    $number_location = count($info_business->locations);
                  }
                @endphp
                <input type="hidden" name="number_location" value="{{$number_location}}">
              </div>
              <!-- end add location -->
              <div class="form-group">
                <label>Time open - close</label>
                    
                <div class="row">
                  @php 
                    $days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
                  @endphp
                  @for($i=0;$i<=6;$i++)
                    @php
                    $open_from = '';
                    $open_till ='';
                      foreach($info_business->business_hour as $val){
                        if($val -> business_days == $days[$i]){
                          $open_from = $val->open_from;
                          $open_till = $val->open_till;
                        }
                      }
                      
                    @endphp
                  <div class="col-lg-6 uptime" style="margin-bottom: 10px;">
                    <span class="bold" style="display: inline-block;width: 45px;">{{$days[$i]}}</span>
                    <select class="choose-method" name="">

                      <option value="open">Open</option>
                      <option value="close" @foreach($info_business->business_hour as $val)
                          @if($val -> business_days == $days[$i])
                            @if($val ->open_from == null && $val ->open_till == null){{'selected'}}@endif
                          @endif
                        @endforeach>Close</option>
                      
                    </select>
                    <div class="show_time @foreach($info_business->business_hour as $val)
                          @if($val -> business_days == $days[$i])
                            @if($val ->open_from == null && $val ->open_till == null){{'hidden'}}@endif
                          @endif
                        @endforeach" style="margin-top: 10px;padding-left: 50px;">
                      <input class="timepic time-open choose-time" type="text" value="{{$open_from}}" name="time_open[{{$days[$i]}}][]" autocomplete="off" />
                      -
                      <input class="timepic time-close choose-time" type="text" value="{{$open_till}}"
                        name="time_close[{{$days[$i]}}][]" autocomplete="off" />
                    </div>
                  </div>
                  @endfor
                </div>
              </div>
              
              <div class="form-group">
                <a href="{{$info_business->permalink()}}" class="btn btn-primary" style="color: #fff">Visit Business Page</a>
                <button type="submit" class="btn btn-primary" style="color: #fff" >Save</button>
                @php
                  if($info_business->activated_on != null){
                   $back = route('getListApprovedBusinesses');
                  }else{
                    $back = route('getListPendingBusiness');
                  }
                @endphp
                <a href="{{$back}}" class="btn btn-primary" style="color: #fff">Cancel</a>
              </div>
              
            </form>
            <div class="clone locationedit location-address">
              <div class="form-group">
                <p>Address</p>
                <div class="input-group" style="width: 100%">
                  <input type="text" class="form-control address" name="address" value="" data-parsley-require>
                </div>
              </div>
              <div class="state_city" style="display: flex;justify-content: space-between;">
                <div class="form-group" style="width: 30%">
                
                  <div class="input-group" style="width: 100%">
                    <p>State</p>
                    <select class="form-control state_profile choose-state"  name="state" >
                             <option value="" selected="selected">Select State</option>
                             @foreach($state as $data)
                             <option value="{{$data->name}}">{{$data->name}}</option>
                             @endforeach
                          </select>
                  </div>
                </div>
                <div class="form-group" style="width: 30%">
                  <div class="input-group" style="width: 100%">
                    <p>City</p>
                     <select class="form-control city_profile choose-city" name="city" style="width: 100%;">
                              <option value="" selected="selected">Select City</option>                          
                          </select>
                  </div>
                </div>
                <div class="form-group" style="width: 30%">
                  <div class="input-group" style="width: 100%">
                    <p>Zipcode</p>
                    <input type="text" class="form-control zipcode_profile " name="zipcode" value="">
                  </div>
                </div>
              </div>
              <a href="javascript:;" title="" class="delete_location">Delete</a>
            </div>
          </div>
        </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@stop
@section('adminlte_js')
<script type="text/javascript" src="{{asset('public/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('public/js/parsley.min.js')}}"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
<script src="{{asset('public/js/all.js')}}"></script>
<script src="{{asset('public/js/ajax.js')}}"></script>

<script type="text/javascript">
select_city();
  function renameLocation(){
    $('#add-location').find('.locationedit').each(function(i){
      console.log(i);
      $(this).find('.state_profile').attr('name','state'+(i+1));
      $(this).find('.city_profile').attr('name','city'+(i+1));
      $(this).find('.zipcode_profile').attr('name','zipcode'+(i+1));
      $(this).find('.address').attr('name','address'+(i+1));
    });
  }

  $(document).on('click','.addlocation',function(e){
    e.preventDefault();
    var number_location = $('#add-location-button').find('input[name=number_location]').val();
    var clone = $('.content').find('.locationedit.clone').clone().removeClass('clone');
    $('#add-location').append(clone);
    select_city();
    renameLocation();
    $('#add-location-button').find('input[name=number_location]').val(parseInt(number_location)+1);
  });

  $(document).on('click','.delete_location',function(){
    $(this).closest('.locationedit').remove();
    select_city();
    renameLocation();
    var number_location = $('#add-location-button').find('input[name=number_location]').val();
    $('#add-location-button').find('input[name=number_location]').val(parseInt(number_location)-1);
  });


  $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '0d',
        autoclose: true,
        todayHighlight: true,
      });

  $("#state_profile").change(function(){
    var name_state = $(this).val();
    var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('ajaxCity') }}",
          method:"POST",
          data:{name_state:name_state, _token:_token},
          success:function(data){ 
            console.log(data)
            $('#city_profile1').html(data);
          }
        });
      
  });
</script>
  <script type="text/javascript" src="{{asset('public/js/fSelect.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.test1').fSelect();
      $('.timepic').timepicker({
            timeFormat: 'H:mm',
            interval: 30,
            // minTime: '10',
            // maxTime: '8:00pm',
            // defaultTime: '12',
            // startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true,
            zindex: 9999999
        });
    });
  </script>
  <script type="text/javascript">
    $(document).on('change','.choose-method',function(){
      var method = $(this).val();
      if(method == "open"){
        $(this).closest('.uptime').find('.show_time').removeClass('hidden');
      }
      if(method == "close"){
        $(this).closest('.uptime').find('.show_time').addClass('hidden');
      }
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#image_restaurant').click(function(e) {

      var previews = document.getElementById('previews');
      if (previews.hasChildNodes()) {
        alert('You Can Only Choose An Image For This Item');
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
            $('<div class="dt-close" style="position:relative;"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').append("<img class='thumb' src='"+event.target.result+"'"+"style='width:100%;'>").append('<div class="deletethumb tsm"><i class="fas fa-times-circle"></i></div>').appendTo(imgPreview);
          }
          reader.readAsDataURL(input.files[i]);
        }
      }
    };

    $('#image_restaurant').on('change', function() {
      images(this, '#previews');
    });
    /*clear the file list when image is clicked*/
    $(document).on('click','.deletethumb',function(){
      if(confirm("You want to delete it?"))
      {
        $(this).closest('#previews').html('');
        $("#image_restaurant").val(null);/* xóa tên của file trong input*/
      }
      else
        return false;
    });
  });
  </script>
@stop