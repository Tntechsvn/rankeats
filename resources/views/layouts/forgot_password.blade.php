@extends('layouts_home.master')
@section('content')
<div id="main">
  <div class="container p-t-30">
    <div class="small-header">
      <h1>Forgot Password</h1>
    </div>
    <div class="row login">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 well">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif
        <form id="formRecover" class="forms" method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit" id="submitRecover"class="btn btn-custom btn-lg btn-block">Recover</button>
          </div>
          <div class="form-group last-row">
            <a href="{{route('sign_in')}}" class="pull-right">Back to login</a> </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection