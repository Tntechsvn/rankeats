
// sign-in
$(document).on('click','.signin-popup',function(e){
	e.preventDefault();
	var email = $(this).closest('form').find('input[name=email]').val();
	var password = $(this).closest('form').find('input[name=password]').val();
	var url = $('input[name=login]').val();
	$.ajax({
		headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url: url,
        data: {
        	email: email,
        	password: password
        },
        success:function(res){
        	if(res.success == true){
        		alert('thanh cong');
        	}else{
        		alert('error');
        	}
        }
	});
});