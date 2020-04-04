<!doctype html>
<html lang="">
<head>
<meta charset="utf-8">
<title>Rank Eats</title>
<base href="{{asset('/public/')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>

<link href="https://fonts.googleapis.com/css?family=Lato|Raleway" rel="stylesheet">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/all.css" rel="stylesheet" type="text/css">
<link href="css/fSelect.css" rel="stylesheet" type="text/css">
<link href="css/sweetalert.css" rel="stylesheet" type="text/css">

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/jquery.timepicker.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/parsley.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">

<link href="lightbox/css/lightgallery.css" rel="stylesheet">
<link href="lightbox/css/custom-style-lightbox.css" rel="stylesheet">
{{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}

<!-- jQuery library -->

<script src="js/jquery.min.js"></script>


<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="js/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script src="js/parsley.min.js"></script> 
</head>

<body>

<div id="wrap">
  @include('layouts_home.header')
  @yield('content')
  @include('layouts_home.footer')
 

</div>
<!--wrap--> 

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

<script src="vendor/bootstrap/js/bootstrap.min.js"></script>


<script type="text/javascript" src="js/sweetalert.min.js"></script>   
{{-- <script src="js/wow.min.js"></script>  --}}
{{-- <script src="js/jquery.raty.js"></script> --}}
{{-- <script src="js/jquery.form.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
{{-- <script src="js/flippy.captcha.js"></script>  --}}
{{-- <script src="js/flippy.origin.js"></script> --}}
 
{{-- <script src="js/flippy.home.js"></script> --}}
<script src="js/all.js"></script>
<script src="js/ajax.js"></script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
<!-- <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> -->
@yield('script')
<script type="text/javascript">
  
  $(document).on('click','.dropdown',function(){
    $(this).closest('li').find('.menudropdown').slideToggle();
  });
  $(document).ready(function(){
    $('li.active').closest('.menudropdown').attr('style','display:block;')

  
    $(document).on('click','.close',function(){
      $(this).closest('.modal').hide();
    });
    
    
    $(document).on('click','.button-menu',function(){
      $(this).toggleClass('active');
     $('.menu-desktop').toggleClass('abc');
    });

  });
</script>
<script>
  $(document).ready(function(){

    $('#location_items').keyup(function(){ 
      var query = $(this).val();
      if(query != '')
      {
        var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('fetchCategory') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#categoryList').fadeIn();  
            $('#categoryList').html(data);
          }
        });
      }
    });

    $(document).on('click', '.category_name', function(e){
      $('#list_id').remove();
      $('#location_items').val($(this).text());  
      $('#categoryList').fadeOut();
    });
  });
</script>
<script>
  $(document).ready(function(){

    $('#location_search').keyup(function(){ 
      var query = $(this).val();
      if(query != '')
      {
        var _token = "{{ csrf_token() }}";
        $.ajax({
          url:"{{ route('fetchCityState') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#LocationList').fadeIn();  
            $('#LocationList').html(data);
          }
        });
      }
    });

    $(document).on('click', '.location_name', function(e){
      $('#location_search').val($(this).text());  
      $('#LocationList').fadeOut();
    });
  });
</script>
</body>
</html> 