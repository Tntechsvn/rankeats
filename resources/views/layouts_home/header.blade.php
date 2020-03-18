<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header" style="text-align: center;">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="{{route('index')}}" style="display: inline-block;height: auto;"><img src="images/logo.png" class="logo" alt="Rank Eats"></a> </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <ul class="nav navbar-nav navbar-right">
            @if(Auth::user())
            <li class="dropdown user user-menu">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">{{Auth::user()->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">

                  <p style="text-transform: capitalize;">
                    {{Auth::user()->full_name}}
                  </p>
                </li>

                <li>
                  <a href="{{route('myprofile')}}" class="btn btn-default btn-flat" ><i class="far fa-user-circle"></i> My Profile</a>
                </li>
                <li >
                  <a href="{{route('mysetting')}}" class="btn btn-default btn-flat" ><i class="fas fa-tools"></i> My Setting</a>
                </li>
                <li>
                  <a href="#" class="btn btn-default btn-flat" ><i class="fas fa-money-check-alt"></i> My Payments</a>
                </li>
                <li class="user-footer">
                  <a href="{{route('getLogout')}}" class="btn btn-default btn-flat" onclick="return confirm('Do you want to logout?');"><i class="fas fa-sign-out-alt"></i> logout</a>
                </li>
              </ul>
            </li>
            @else
            <li><a href="#" id="btn-search"><i class="fa fa-search"></i></a></li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
              <ul id="login-dp" class="dropdown-menu dropdown-right">
                <li>
                  <div class="row">
                    <div class="col-md-12">
                      <form action="{{route('postLogin')}}" method="post" enctype="multipart/form-data" >
                        {{csrf_field()}}
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputEmail2">username</label>
                          <input type="text" class="form-control" name="email" placeholder="username" data-parsley-required>
                          <span class="bg-danger color-palette">{{$errors -> first('email')}}</span>
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="password" data-parsley-required>
                          <span class="bg-danger color-palette">{{$errors -> first('password')}}</span>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="logged">
                          keep me logged-in </label>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-custom btn-block signin-popup">Sign in</button>
                        </div>
                        <div class="help-block text-right"><a href="{{route('forgot_password')}}">Forget Password ?</a></div>
                      </form>
                    </div>
                    <div class="bottom text-center"> New here ? <a href="{{route('sign_up')}}"><b>Join Us</b></a> </div>
                  </div>
                </li>
              </ul>
            </li>
            @endif

          </ul>
        </div>
        <!-- /.navbar-collapse --> 
      </div>
      <!-- /.container --> 
    </div>
    <!-- /.container-fluid --> 
  </nav>
  