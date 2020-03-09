@extends('layouts_home.master')
@section('content')
<div id="main">


  <div class="container container-main">

    <div class="small-header">
      <h1>Submit Your Business</h1>
    </div>

    <div class="col-md-10 col-md-offset-1 col-submit">
      <form id="formBusiness" class="forms" action="submit_business.php?id=4869321583725660" enctype="multipart/form-data" method="post">
        <div class="site-tabs-bar">
          <div class="site-tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a data-target="#tab-details" data-toggle="tab">Business Location</a></li>
            </ul>
          </div>
        </div>
        <div class="tab-content">

          <ul class="show-note">
            <li>You will be redirected to the checkout once you submit below form.</li>
            <li>Once your payment is complete you will be able to add more photos and business opening times.</li>
          </ul>

          <div class="tab-pane active" id="tab-details"> 
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="business_locations">Locations</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="fa fa-info"></span></span>
                    <input type="number" class="form-control input-lg" name="business_locations" id="business_locations" min="1" placeholder="Locations" value="1">
                  </div>
                  <a href="#" class="btn btn-primary addplus" style="
                  color: #fff;
                  margin-right: 5px;
                  font-size: 13px;
                  font-weight: bold;
                  ">+</a>
                  <a href="#" class="btn btn-primary  addminus" style="
                  color: #fff;
                  margin-right: 5px;
                  font-size: 13px;
                  font-weight: bold;
                  ">-</a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="State">State</label>
                  <div class="input-group"> <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                    <select class="form-control select2 input-lg" id="business_state" name="business_state">
                      <option value="">Select State</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputCity">City</label>
                  <div class="input-group"> <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                    <select class="form-control input-lg" id="inputCity" name="inputCity">
                      <option value="">Select City</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputLineOne">Address</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
                    <input type="text" class="form-control input-lg" name="inputLineOne" id="inputLineOne" placeholder="Address">
                  </div>
                </div>


                <div class="form-group">
                  <label for="zipCode">Zip Code</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
                    <input type="text" class="form-control input-lg" name="zip_code" id="zipCode" placeholder="Zip Code">
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
        <!--Business Details---->
        <hr>
        <div class="site-tabs-bar">
          <div class="site-tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a data-target="#tab-details" data-toggle="tab">Business Details</a></li>
            </ul>
          </div>
        </div>
        <div class="tab-content">


          <div class="tab-pane active" id="tab-details"> 
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputBizname">Business Name</label>
                  <div class="input-group"> 
                    <span class="input-group-addon"><span class="fa fa-info"></span></span>
                    <input type="text" class="form-control input-lg" name="inputBizname" id="inputBizname" placeholder="Business Name">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Owner Manager Details---->
        <hr>
        <div class="site-tabs-bar">
          <div class="site-tabs">
            <ul class="nav nav-tabs">
              <li class="active"><a data-target="#tab-details" data-toggle="tab">Owner/Manager Details</a></li>
            </ul>
          </div>
        </div>
        <div class="tab-content">


          <div class="tab-pane active" id="tab-details"> 
            <div class="row">
              <div class="col-md-6">

              <div class="form-group">
                <label for="firstName">First Name</label>
                <div class="input-group"> 
                  <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
                  <input type="text" class="form-control input-lg" name="firstname" id="firstName" placeholder="First Name">
                </div>
              </div>
              <div class="form-group">
                <label for="lastName">Last Name</label>
                <div class="input-group"> 
                  <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
                  <input type="text" class="form-control input-lg" name="lastname" id="lastName" placeholder="Last Name">
                </div>
              </div>

              <div class="form-group">
                <label for="lastName"><input type="radio" name="personrole" value="owner" /> Owner</label>
                <label for="lastName"><input type="radio" name="personrole" value="manager" /> Manager</label>
                <label for="lastName"><input type="radio" name="personrole" value="other" /> Other</label>
                <input type="hidden" name="otherrole" class="form-control input-sm" />
              </div>
              <div class="form-group">
                <label for="inputPhone">Phone</label>
                <div class="input-group"> 
                  <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                 <input type="text" class="form-control input-lg" name="inputPhone" id="inputPhone" placeholder="Phone Number">
                </div>
              </div>
              </div>

            </div>
            <button type="submit" id="submitBusiness" class="btn btn-lg btn-custom pull-right">Submit</button>
            <a href="http://rankeats.com" class="btn btn-lg btn-default pull-right" style="margin:0px 10px;">Cancel</a>
          </div>
        </div>

      </form>
    </div>
    <!--col-md-9--> 
    <div class="clearfix"></div>

  </div>
</div>
@endsection