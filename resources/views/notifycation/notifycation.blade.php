<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script>
  toastr.options.closeButton = true;
</script>

@if(Session::has('success'))
<script>
  toastr.success("{{ Session::get('success') }}");
</script>
<?php Session::forget('success');?>
@endif

@if(Session::has('info'))
<script>
  toastr.info("{{ Session::get('info') }}");
</script>
<?php Session::forget('info');?>
@endif

@if(Session::has('warning'))
<script>
  toastr.warning("{{ Session::get('warning') }}");
</script>
<?php Session::forget('warning');?>
@endif

@if(Session::has('error'))
<script>
  toastr.error("{{ Session::get('error') }}");
  <?php Session::forget('error');?>
</script>
@endif