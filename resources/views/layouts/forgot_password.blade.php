@extends('layouts_home.master')
@section('content')
<div id="main">
  <div class="container container-main">
    <div class="small-header">
      <h1>Recover Your Login</h1>
    </div>
    <div class="row login">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
        <form id="formRecover" class="forms" action="send_recovery.php" method="post">
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="inputRecovery" id="inputRecovery" placeholder="Email">
          </div>
           <div class="form-group">
            <button type="submit" id="submitRecover"class="btn btn-custom btn-lg btn-block">Recover</button>
          </div>
          <div class="form-group last-row">
            <a href="{{route('login')}}" class="pull-right">Back to login</a> </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection