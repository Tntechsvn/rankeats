<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="{{route('index')}}"><img src="images/logo.png" class="logo" alt="Rank Eats"></a> </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" id="btn-search"><i class="fa fa-search"></i></a></li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu dropdown-right">
              <li>
                <div class="row">
                  <div class="col-md-12">
                    <form method="post" action="">
                      <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2">Username</label>
                        <input type="text" class="form-control" name="inputUsername" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                        <input type="password" class="form-control" name="inputPassword" placeholder="Password">
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="logged">
                          keep me logged-in </label>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-custom btn-block">Sign in</button>
                      </div>
                      <div class="help-block text-right"><a href="{{route('forgot_password')}}">Forget Password ?</a></div>
                    </form>
                  </div>
                  <div class="bottom text-center"> New here ? <a href="{{route('register')}}"><b>Join Us</b></a> </div>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.container-fluid --> 
</nav>