@extends('layouts_home.master')
@section('content')
<div id="main">
	<div class="container profile-header">
		<div class="profile-header-inner">

			<div class="col-md-3 profile-pic-lg"><img src="@if(Auth::user()->url_avatar != null){{asset('').'storage/'.Auth::user()->url_avatar}}@else{{'images/avatar.jpg'}}@endif" class="img-circle" width="200" height="200" alt="{{Auth::user()->name}}"></div>
			<div class="col-md-8 profile-info"><div class="profile-info-inner"><h1>{{Auth::user()->name}}</h1> <p>0 Reviews</p></div></div>
		</div>
	</div>

	<div class="container container-main content-profile">
		<div class="row">
			<div class="col-md-3">

				<div class="profile-usermenu">
					@include('layouts_profile.menu-sidebar')
				</div>
			</div>

			<div class="col-md-9 content-search">
				<h3 class="title">Create Advertisement</h3>
				<div class="create-advertise">
					<div class="col-md-12">
				      <div class="col-md-6">
				        <div class="row pull-panels">
				          <div class="panel panel-default">
				            <div class="panel-heading panel-heading-1">
				              <h1 class="panel-title">Pay to Home EATS</h1>
				            </div>
				            <div class="panel-body">
				              <p>At the top of the home page you can add a pic of your business to a 3 pic rotation which will be seen by everyone when they visit us. The name of your business, along with the City and State, will also appear in the lower right of the pic which will link to your business home page. </p>
				              <form action="update_payment_active.php" method="post">
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
								      <p>At the top of the search results page for the City and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business.</p>
								      <form action="update_payment_active.php" method="post">
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
				              <p>At the top of the search results page for the County and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business home page if clicked on. </p>
				              <form action="update_payment_active.php" method="post">
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
				              <p>At the top of the search results page for the State and EATS you choose you can add a pic of your business. The name of your business along with the City and State will also appear in the lower right of the pic which will link to your business home page if clicked on. </p>
				              <form action="update_payment_active.php" method="post">
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
				              <p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your City for the EATS you choose!</p>
				              <form action="update_payment_active.php" method="post">
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
				              <p>a.	Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your County for the EATS you choose!</p>
				              <form action="update_payment_active.php" method="post">
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
				              <p>Add your business to the top of the search results under the “Featured Listings” and be the first to be seen in your State for the EATS you choose! </p>
				              <form action="update_payment_active.php" method="post">
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
				<h3 class="title">Business Advertisement</h3>
				<div class="business-advertise">
					<div class="col-lg-12 m-b-20">
						<div class="col-lg-3">
							<div class="img">
								<img src="images/pizza.jpg" alt="" style="width: 100%">
							</div>
						</div>
						<div class="col-lg-9">
							<div class="in4">
								<h4>Pay to home eat</h4>
								<p class="name-city "><i class="fas fa-info-circle"></i>title</p>
								<p class="day-city"><i class="fas fa-calendar-alt"></i>30 day</p>
								<p class="expiration-city"><i class="fas fa-calendar-times"></i> expiration-date: 12/04/2020</p>
								<p class="price-city"><i class="fas fa-dollar-sign"></i>Price: $3.99</p>
							</div>
						</div>
					</div>

					<div class="col-lg-12 m-b-20">
						<div class="col-lg-3">
							<div class="img">
								<img src="images/pizza.jpg" alt="" style="width: 100%">
							</div>
						</div>
						<div class="col-lg-9">
							<div class="in4">
								<h4>Pay to home eat</h4>
								<p class="name-city "><i class="fas fa-info-circle"></i>title</p>
								<p class="day-city "><i class="fas fa-calendar-alt"></i>30 day</p>
								<p class="expiration-city "><i class="fas fa-calendar-times"></i> expiration-date: 12/04/2020</p>
								<p class="price-city "><i class="fas fa-dollar-sign"></i>Price: $3.99</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
@section('script')
	
@stop