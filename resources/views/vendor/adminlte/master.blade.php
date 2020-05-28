<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'Admin RankEat'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    @if(! config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('public/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @include('adminlte::plugins', ['type' => 'css'])
    <!--icheck-->
    <link rel="stylesheet" href="{{ asset('public/vendor/plugins/iCheck/flat/blue.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/vendor/select2/css/select2.min.css')}}">
     <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/vendor/daterangepicker/daterangepicker.css')}}">
    @yield('adminlte_css_pre')

    <link rel="stylesheet" href="{{ asset('public/vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendor/adminlte/dist/css/adminlte.min.css') }}">

    @yield('adminlte_css')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('public/vendor/css/style.css')}}">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAIK0i2mitUaJvprxOUeROA4GXeBpw7wE&libraries=places&language=EN&region=US"></script>
</head>
<body class="@yield('classes_body')" @yield('body_data')>

@yield('body')

@if(! config('adminlte.enabled_laravel_mix'))
<script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('public/vendor/plugins/iCheck/icheck.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('public/vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('public/vendor/select2/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('public/vendor/moment/moment.min.js')}}"></script>
<script src="{{ asset('public/vendor/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('public/vendor/daterangepicker/daterangepicker.js')}}"></script>



<!-- AdminLTE App -->
<script src="{{ asset('public/vendor/adminlte/dist/js/adminlte.min.js')}}"></script>
@include('adminlte::plugins', ['type' => 'js'])
@include('notifycation.notifycation')
@yield('adminlte_js')
@else
<script src="{{ asset('public/js/app.js') }}"></script>
@endif

</body>
</html>
