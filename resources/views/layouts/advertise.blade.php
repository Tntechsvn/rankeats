@extends('layouts_home.master')
@section('content')

<div id="main">

  <div class="container container-main">
    <div class="col-md-12">
      <div class="col-md-6">
        <div class="row pull-panels">
          <div class="panel panel-default">
            <div class="panel-heading panel-heading-1">
              <h1 class="panel-title">Pay to Home EATS</h1>
            </div>
            <div class="panel-body">
              <p>At the top of the home page you can add a pic of your business to a 3 pic rotation which will be seen by everyone when they visit us. The name of your business, along with the City and State, will also appear in the lower right of the pic which will link to your business home page. </p>
              <form id="activeForm" action="update_payment_active.php" method="post">
                <div class="col-md-6">
                  <select name="plan" class="form-control planvalue">
                    <option value="38">30 days - $10.99</option>
                    <option value="39">180 days - $49.99</option>
                    <option value="40">364 days - $199.99</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <button type="button" class="btn btn-primary btn-lg seletedplan" data-toggle="modal" data-plan="Pay to Home" data-target="#loginModal">Advertise</button>
                </div>
              </form>
            </div>
          </div>
        <!--/.Panel --> 
        </div>
      <!--pull-panels--> 
      </div>
      <div class="col-md-6">
      <div class="row pull-panels">
      <div class="panel panel-default">
      <div class="panel-heading panel-heading-1">
      <h1 class="panel-title">Search EATS – City </h1>
      </div>
      <div class="panel-body">
      <div id="output-active"></div>
      <p>At the top of the search results page for the City and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business.</p>
      <form id="activeForm" action="update_payment_active.php" method="post">
      <div class="col-md-6">
      <select name="plan" class="form-control planvalue">
      <option value="62">30 days - $10.99</option>
      <option value="63">180 days - $49.99</option>
      <option value="64">364 days - $199.99</option>

      </select>
      </div>
      <div class="col-md-6">
      <button type="button" class="btn btn-primary btn-lg seletedplan" data-toggle="modal" data-plan="Search EATS – City" data-target="#loginModal">Advertise</button>
      </div>
      </form>
      </div>
      </div>
      <!--/.Panel --> 
      </div>
      <!--pull-panels--> 
      </div>

    </div>
    <div class="col-md-12">
    <div class="col-md-6">
    <div class="row pull-panels">
    <div class="panel panel-default">
    <div class="panel-heading panel-heading-1">
    <h1 class="panel-title">Search EATS – County </h1>
    </div>
    <div class="panel-body">
    <div id="output-active"></div>
    <p>At the top of the search results page for the County and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business home page if clicked on. </p>
    <form id="activeForm" action="update_payment_active.php" method="post">
    <div class="col-md-6">
    <select name="plan" class="form-control planvalue">
    <option value="44">30 days - $10.99</option>
    <option value="45">180 days - $49.99</option>
    <option value="46">364 days - $199.99</option>

    </select>
    </div>
    <div class="col-md-6">
    <button type="button" class="btn btn-primary btn-lg seletedplan" data-toggle="modal" data-plan="Search EATS – County " data-target="#loginModal">Advertise</button>
    </div>
    </form>
    </div>
    </div>
    <!--/.Panel --> 
    </div>
    <!--pull-panels--> 
    </div>
    <div class="col-md-6">
    <div class="row pull-panels">
    <div class="panel panel-default">
    <div class="panel-heading panel-heading-1">
    <h1 class="panel-title">Search EATS – State </h1>
    </div>
    <div class="panel-body">
    <div id="output-active"></div>
    <p>At the top of the search results page for the State and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business home page if clicked on. </p>
    <form id="activeForm" action="update_payment_active.php" method="post">
    <div class="col-md-6">
    <select name="plan" class="form-control planvalue">
    <option value="47">30 days - $10.99</option>
    <option value="48">180 days - $49.99</option>
    <option value="49">364 days - $199.99</option>

    </select>
    </div>
    <div class="col-md-6">
    <button type="button" class="btn btn-primary btn-lg seletedplan" data-toggle="modal" data-plan="Search EATS – State " data-target="#loginModal">Advertise</button>
    </div>
    </form>
    </div>
    </div>
    <!--/.Panel --> 
    </div>
    <!--pull-panels--> 
    </div>

    </div>
    <div class="col-md-12">
    <div class="col-md-6">
    <div class="row pull-panels">
    <div class="panel panel-default">
    <div class="panel-heading panel-heading-1">
    <h1 class="panel-title">Search Feature EATS – City </h1>
    </div>
    <div class="panel-body">
    <div id="output-active"></div>
    <p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your City for the EATS you choose!</p>
    <form id="activeForm" action="update_payment_active.php" method="post">
    <div class="col-md-6">
    <select name="plan" class="form-control planvalue">
    <option value="53">30 days - $10.99</option>
    <option value="54">180 days - $49.99</option>
    <option value="55">364 days - $199.99</option>

    </select>
    </div>
    <div class="col-md-6">
    <button type="button" class="btn btn-primary btn-lg seletedplan" data-toggle="modal" data-plan="Search Feature EATS – City " data-target="#loginModal">Advertise</button>
    </div>
    </form>
    </div>
    </div>
    <!--/.Panel --> 
    </div>
    <!--pull-panels--> 
    </div>
    <div class="col-md-6">
    <div class="row pull-panels">
    <div class="panel panel-default">
    <div class="panel-heading panel-heading-1">
    <h1 class="panel-title">Search Feature EATS – County </h1>
    </div>
    <div class="panel-body">
    <div id="output-active"></div>
    <p>a.	Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your County for the EATS you choose!</p>
    <form id="activeForm" action="update_payment_active.php" method="post">
    <div class="col-md-6">
    <select name="plan" class="form-control planvalue">
    <option value="50">30 days - $10.99</option>
    <option value="51">180 days - $49.99</option>
    <option value="52">364 days - $199.99</option>

    </select>
    </div>
    <div class="col-md-6">
    <button type="button" class="btn btn-primary btn-lg seletedplan" data-toggle="modal" data-plan="Search Feature EATS – County" data-target="#loginModal">Advertise</button>
    </div>
    </form>
    </div>
    </div>
    <!--/.Panel --> 
    </div>
    <!--pull-panels--> 
    </div>

    </div>
    <div class="col-md-12">
    <div class="col-md-6">
    <div class="row pull-panels">
    <div class="panel panel-default">
    <div class="panel-heading panel-heading-1">
    <h1 class="panel-title">Search Feature EATS – State </h1>
    </div>
    <div class="panel-body">
    <div id="output-active"></div>
    <p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your State for the EATS you choose! </p>
    <form id="activeForm" action="update_payment_active.php" method="post">
    <div class="col-md-6">
    <select name="plan" class="form-control planvalue">
    <option value="56">30 days - $10.99</option>
    <option value="57">180 days - $49.99</option>
    <option value="58">364 days - $199.99</option>

    </select>
    </div>
    <div class="col-md-6">
    <button type="button" class="btn btn-primary btn-lg seletedplan" data-toggle="modal" data-plan="Search Feature EATS – State" data-target="#loginModal">Advertise</button>
    </div>
    </form>
    </div>
    </div>
    <!--/.Panel --> 
    </div>
    <!--pull-panels--> 
    </div>


    </div>


  </div>

</div><!--main-->
 
<div id="myModal" class="modal fade" role="dialog">
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
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">&nbsp;</h4>
	  </div>
	  <div class="modal-body">
		<p>Must be logged in to advertise</p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	</div>
    
  </div>
</div>

@endsection