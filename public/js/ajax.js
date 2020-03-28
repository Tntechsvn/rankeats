
$(function () {
	function before_ajax() {
	    $('body').prepend('<div class="loading"><div class="spinner">\
	              <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>\
	            </div></div>');
  	}
  	function after_ajax() {
    	$('body').find('.loading').remove();
  	}
  	$(document).ajaxStart(function(){
    	before_ajax();
   	});

  	$(document).ajaxComplete(function(){
     	after_ajax();
   	});
});

// sign-in
$(document).on('click','.signin-popup',function(e){
	e.preventDefault();
	var parsley = $(this).closest('form').parsley();
	if(parsley.isValid() != true){
        parsley.validate();
        return false;
    }
  if (grecaptcha === undefined) {
    swal('Recaptcha not defined');
    return; 
  }

  var response = grecaptcha.getResponse();

  if (!response) {
    swal('Coud not get recaptcha response'); 
    return; 
  }
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
        	password: password,
          recaptcha: response
        },
        success:function(res){
        	if(res.success == true){
        		swal(res.message);
        		window.location.reload();
        	}else{
        		swal(res.message);
        	}
        }
	});
});


$(document).on('click','.vote_now',function(){
  
  var url = $('input[name=vote-ajax]').val();
  var business = $(this).data('id');
  var modal_target = $('#voteModal');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      business: business
    },
    success:function(res){
      if(res.success == true){
          modal_target.find('input[name=business_id]').val(business);
          modal_target.show();
      }else{
        swal({
          title: res.message,
          timer: 2000
        });
      }
    }
  });
});

