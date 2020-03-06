@extends('layouts_home.master')
@section('content')
  <div id="main">
    <div class="container container-main">

      <div class="small-header">
        <h1>Settings</h1>
      </div>

      <div class="col-md-10 col-md-offset-1 col-submit">
        <div class="site-tabs-bar">
          <div class="site-tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a data-target="#tab-info" data-toggle="tab">Update Your Info</a></li>
              <li><a data-target="#tab-picture" data-toggle="tab">Upload Profile Picture</a></li>
              <li><a data-target="#tab-password" data-toggle="tab">Update Password</a></li>
            </ul>
          </div>
        </div>
        <div class="tab-content">
          <div class="tab-pane active" id="tab-info"> 

            <div id="output-info"></div>
            <form action="update_info.php" id="fromInfo" method="post" >
              <div class="form-group">
              <label for="inputUsername">Username (Cannot be changed)</label>
                <input type="text" class="form-control input-lg" disabled="disabled" name="inputUsername" id="inputUsername" value="hungpro"/>
              </div>
              <!--/ form-group -->

              <!--<div class="form-group">
              <label for="inputGender">Gender</label>
              <select class="form-control input-lg" name="inputGender" id="inputGender">


              <option value="">Chose</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>


              </select>
              </div>-->
              <!--/ form-group -->

              <!--<div class="form-group">
              <label for="inputBirthday">Birthday</label>
              <input type="text" class="form-control input-lg" name="inputBirthday" id="inputBirthday" value="" placeholder="yyyy-mm-dd" />
              </div>-->
              <!--/ form-group -->
              <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="text" class="form-control input-lg" name="inputEmail" id="inputEmail" value="tuanhungk7c@gmail.com" placeholder="Enter a valid email address"/>
              </div>
              <!--/ form-group -->
              <div class="form-group">
                <label for="inputStates">State</label>
                <select class="form-control select2 input-lg" id="business_state" name="business_state">
                  <option value="">Select State</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputCity">City</label>
                <select class="form-control input-lg" id="inputCity" name="inputCity">
                  <option value="">Select City</option>
                </select>            
              </div>
              <div class="form-group">
                <label for="inputCountry">Country</label>
                <input type="text" class="form-control input-lg" name="inputCountry" id="inputCountry" value="United States" readonly placeholder="Let us know your inputCountry"/>
              </div>
              <!--/ form-group -->
              <div class="form-group">
                <label for="inputAbout">About</label>
                <textarea name="inputAbout" class="form-control input-lg" cols="40" rows="5" placeholder="Tell us little bit inputAbout your self "></textarea>
              </div>
              <!--/ form-group -->

              <button type="submit" class="btn btn-custom btn-lg pull-right" id="submitInfo">Update</button>
            </form>

          </div>
        <div class="tab-pane" id="tab-picture"> 

        <div id="output-profile-pic"></div>
        <form id="profilepicInfo" class="info-forms" action="update_profile_pic.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div id="preview-avatar" class="pull-left"> <img src="templates/origin/images/avatar.jpg" width="100" height="100" class="avatar_small"> </div>
            <div class="input-group">
              <label for="inputPic">Maximum 500Kb or 500px x 500px in size</label>
              <br>
              <div class="fileUpload btn btn-custom"> <span id="fileContainer"><i class="fa fa-camera"></i> Select</span>
                <input type="file" name="inputPic" id="inputPic" class="upload" />
              </div>
            </div>
          </div>
        </form>

        </div>
        <div class="tab-pane" id="tab-password">

          <div id="output-password"></div>
          <form action="update_password.php" id="formPassword" method="post" >
            <div class="form-group">
              <label for="inputOldPassword">Current Password</label>
              <input type="password" class="form-control input-lg" name="inputOldPassword" id="inputOldPassword" placeholder="Please provide your current password" />
            </div>
            <!--/ form-group -->
            <div class="form-group">
              <label for="inputNewPassword">New Password</label>
              <input type="password" class="form-control input-lg" name="inputNewPassword" id="inputNewPassword" placeholder="Please provide the new password" />
            </div>
            <!--/ form-group -->
            <div class="form-group">
              <label for="inputConfirmPassword">Conform Password</label>
              <input type="password" class="form-control input-lg" name="inputConfirmPassword" id="inputConfirmPassword" placeholder="Retype the above password" />
            </div>
            <!--/ form-group -->

            <button type="submit" class="btn btn-custom btn-lg pull-right" id="submitPassword">Update</button>
          </form>

        </div>
        </div>
      </div>
    <!--col-md-9--> 
      <div class="clearfix"></div>

    </div>
  </div>
@endsection