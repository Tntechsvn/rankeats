@extends('layouts_home.master')
@section('content')
<div id="main" class="setting-page">
  <div class="container ">
    <div class="small-header">
      <h1 class="m-t-30">Settings</h1>
    </div>
    <div class="col-md-10 col-md-offset-1 col-submit">
      <div class="site-tabs-bar">
        <div class="site-tabs">
          <ul class="nav nav-tabs">
            <li class=""><a class="active" data-target="#tab-info" data-toggle="tab">Update Your Info</a></li>
            <li><a data-target="#tab-picture" data-toggle="tab">Upload Profile Picture</a></li>
            <li><a data-target="#tab-password" data-toggle="tab">Update Password</a></li>
          </ul>
        </div>
      </div>
      <div class="tab-content">
        <div class="tab-pane active" id="tab-info">
          <div id="output-info" class="output-message"></div>
          <form action="" id="fromInfo" method="post" >
            {{csrf_field()}}
            <div class="form-group">
              <label for="inputUsername">Username (Cannot be changed)</label>
              <input type="text" class="form-control" disabled="disabled" id="inputUsername" value="{{Auth::user()->name}}"/>
            </div>
           
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" name="firstname"  placeholder="First Name" value="{{Auth::user()->first_name}}">
                <span class="bg-danger color-palette">{{$errors -> first('firstname')}}</span>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" name="lastname"  placeholder="Last Name" value="{{Auth::user()->last_name}}">
                <span class="bg-danger color-palette">{{$errors -> first('lastname')}}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="inputBirthday">Address </label>
              <div class="form-group">
                <select class="form-control select2" name="state" id="state_profile">
                  <option value=""disabled selected="selected">Select State</option>
                  @foreach($state as $data)
                  <option value="{{$data->name}}" 
                      @if(Auth::user()->address != null)
                        @if(Auth::user()->location->state == $data->name){{'selected'}}@endif
                      @endif
                      >{{$data->name}}
                  </option>
                  @endforeach
                </select>
                <span class="bg-danger color-palette">{{$errors -> first('state')}}</span>
              </div>
              <div class="form-group">
                <select class="form-control select2" name="city" id="city_profile" style="width: 100%;">
                  <option  value="" disabled selected >Select City</option>
                  @if(Auth::user()->address != null)
                    @if(Auth::user()->location->city != null)
                      <option  value="{{Auth::user()->location->city}}" disabled selected >{{Auth::user()->location->city}}</option>
                    @endif
                  @endif"
                </select>
                <span class="bg-danger color-palette">{{$errors -> first('city')}}</span>
                
              </div>
              <div class="form-group">
                <input type="text" class="form-control " name="address"  placeholder="Address" value="@if(Auth::user()->address != null){{Auth::user()->location->address}}@endif">
                <span class="bg-danger color-palette">{{$errors -> first('address')}}</span>
              </div>
              <div class="form-group">
                <input type="text" class="form-control " name="zipcode" placeholder="Zip Code" value="@if(Auth::user()->address != null){{Auth::user()->location->code}}@endif">
                <span class="bg-danger color-palette">{{$errors -> first('zipcode')}}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail">Email</label>
              <input type="email" class="form-control" name="email" id="inputEmail" value="{{Auth::user()->email}}" placeholder="Enter a valid email address"/>
              <span class="text-danger">{{$errors -> first('email')}}</span>
            </div>
            <div class="form-group">
              <label for="inputAbout">About</label>
              <textarea name="user_title" class="form-control input-lg" cols="40" rows="5" placeholder="Tell us a little bit about yourself">{{Auth::user()->user_title}}</textarea>
            </div>
            <button type="submit" class="btn btn-custom btn-lg pull-right" id="submitInfo">Update</button>
          </form>

        </div>

        <div class="tab-pane" id="tab-picture"> 
          <div class="output-message"></div>
          <form id="profilepicInfo" class="info-forms" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <div id="preview-avatar-old" class="pull-left">
                <img src="{{Auth::user()->UrlAvatarUser}}" width="100" height="100" class="avatar_small"> 
              </div>
              <div id="preview-avatar" class="pull-left"></div>
              <div class="input-group">
                <label for="inputPic" class="m-l-10">Maximum 500Kb or 500px x 500px in size</label>
                <br>
                <div class="fileUpload btn btn-custom"> 
                  <span id="fileContainer"><i class="fa fa-camera"></i> Select</span>
                  <input type="file" name="inputPic" id="inputPic" class="upload" />
                </div>
              </div>
              <button type="submit" class="btn btn-custom btn-lg pull-right" id="submitimg">Update</button>
            </div>
          </form>

        </div>

        <div class="tab-pane" id="tab-password">
          <div class="output-message"></div>
          <form action="" id="formPassword" method="post" >
            {{csrf_field()}}
            <div class="form-group">
              <label for="inputOldPassword">Current Password</label>
              <input type="password" class="form-control" name="old_password" id="inputOldPassword" placeholder="Please provide your current password" />
              @if(session('err_old_password'))
              <span class="text-danger"> {!!session('err_old_password')!!}</span>
              @endif

            </div>
            <!--/ form-group -->
            <div class="form-group">
              <label for="inputNewPassword">New Password</label>
              <input type="password" class="form-control" name="password" id="inputNewPassword" placeholder="Please provide the new password" />
              <span class="text-danger"> {!!$errors -> first('password')!!}</span>
            </div>
            <div class="form-group">
              <label for="inputConfirmPassword">Conform Password</label>
              <input type="password" class="form-control" name="re_password" id="inputConfirmPassword" placeholder="Retype the above password" />
              <span class="text-danger"> {!!$errors -> first('re_password')!!}</span>
            </div>
            <button type="submit" class="btn btn-custom btn-lg pull-right" id="submitPassword">Update</button>
          </form>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  $("#state_profile").change(function(){
    var name_state = $(this).val();

    var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('ajaxCity') }}",
          method:"POST",
          data:{name_state:name_state, _token:_token},
          success:function(data){ 
            console.log(data)
            $('#city_profile').html(data);
          }
        });

    /*$.get("tasteadmin/staff/restaurant-dish/"+ name_state,function(data){
      $("#id_city").html('<option value="0"  selected >Select City</option>'+data);
    });*/       
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    $('#inputPic').click(function(e) {

      var previews = document.getElementById('preview-avatar');
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
            $('<div class="dt-close" style="position:relative;"><input type="hidden" name="image[]" value='+event.target.result+'  /></div>').append("<img class='thumb' src='"+event.target.result+"'"+"style='width:100%;'>").append('<div class="deletetimg tsm"><i class="fas fa-times-circle"></i></div>').appendTo(imgPreview);
          }
          reader.readAsDataURL(input.files[i]);
        }
      }
    };

    $('#inputPic').on('change', function() {

      images(this, '#preview-avatar');
      $('#preview-avatar-old').addClass('hidden');
    });
    /*clear the file list when image is clicked*/
    $(document).on('click','.deletetimg',function(){
      if(confirm("You want to delete it?"))
      {
        $(this).parent().remove();
        $("#inputPic").val(null);/* xóa tên của file trong input*/
        $('#preview-avatar-old').removeClass('hidden');
      }
      else
        return false;
    }); 
  });
</script>
<script type="text/javascript">
  
  {{-- info --}}
  $(document).on('click','#submitInfo',function(e){
    e.preventDefault();
    var form = $(this).closest('form');
    var output = $(this).closest('#tab-info').find('.output-message');
    var url = "{{route('postEditUserFrondEnd')}}";
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'POST',
      url: url,
      data: form.serialize(),
      success:function(res){
        if(res.success == true){
          output.addClass('output-success').html(res.message);
        }else{
          output.addClass('output-error').html(res.message);
        }
      }
    });
  });
  {{-- end info --}}

  {{-- image --}}
  $(document).on('click','#submitimg',function(e){
    e.preventDefault();
    var form = $(this).closest('form');
    var output = $(this).closest('#tab-picture').find('.output-message');
    var url = "{{route('postEditUserImgFrondEnd')}}";
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'POST',
      url: url,
      data: form.serialize(),
      success:function(res){
        if(res.success == true){
          output.addClass('output-success').html(res.message);
        }else{
          output.addClass('output-error').html(res.message);
        }
      }
    });
  });
  {{-- end image --}} 

  {{-- password --}}
  $(document).on('click','#submitPassword',function(e){
    e.preventDefault();
    var form = $(this).closest('form');
    var output = $(this).closest('#tab-password').find('.output-message');
    var url = "{{route('postEditUserPassFrondEnd')}}";
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:'POST',
      url: url,
      data: form.serialize(),
      success:function(res){
        if(res.success == true){
          output.addClass('output-success').html(res.message);
        }else{
          output.addClass('output-error').html(res.message);
        }
      }
    });
  });
  {{-- end password --}}
</script>
@endsection