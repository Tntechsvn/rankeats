
$(function () {
	function before_ajax() {
	    $('body').prepend('<div class="loading"><div class="spinner">\
	              <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>\
	            </div></div>');
  	}
  	function after_ajax() {
    	$('body').find('.loading').remove();
  	}
  	// $(document).ajaxStart(function(){
   //  	before_ajax();
   // 	});

  	// $(document).ajaxComplete(function(){
   //   	after_ajax();
   // 	});
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


$(document).on('click','.unvote_submit',function(e){
  e.preventDefault();
  var modall = $(this).closest('#un_vote');
  var url = modall.find('input[name=unvoted]').val();
  var business_id = modall.find('input[name=business_id]').val();
  var city_id = modall.find('input[name=city_id]').val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      business_id: business_id,
      city_id: city_id
    },
    success:function(res){
      modall.modal('hide');
      var vote_id = '.vote-'+business_id;
      $('#main').find(vote_id).removeClass('btn-danger').addClass('btn-success').html('Vote');
      swal({
        title: res.message,
        timer: 2000
      });;
    }
  });
});


$(document).on('click','.vote_now',function(){
  var $this = $(this);
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
          modal_target.modal('show');
          var vote_id = '.vote-'+business;
          $('#main').find(vote_id).removeClass('btn-success').addClass('btn-danger').html('Voted');
          $this.html('Voted');
          $this.removeClass('btn-success').removeClass('vote_now').addClass('btn-danger');
      }else{
        // swal({
        //   title: res.message,
        //   timer: 2000
        // });;
        var unvote_modal = $('#un_vote');
        unvote_modal.find('.message').html(res.message);
        unvote_modal.find('input[name=business_id]').val(res.business_id);
        unvote_modal.find('input[name=city_id]').val(res.city_id);
        unvote_modal.modal('show');
      }
    }
  });
});

// review search page

$(document).on('click','.yesforvote',function(e){
  e.preventDefault();
  var url = $('input[name=postReviewFrontEnd]').val();
  var form = $(this).closest('form');
  var target = $('#businessreview');
  var modal = $(this).closest('#voteModal');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: form.serialize(),
    success:function(res){
      if(res.success == true){
          modal.modal('hide');
          target.html(res.data);

          swal({
            title: res.message,
            timer: 2000
          });
      }else{
        swal({
          title: res.message,
          timer: 2000
        });
      }
    }
  });
});


// end

$(document).on('change','select[name=state]', function(){
  var val = $(this).val();
  var form = $(this).closest('form');
  // var val = 1;
  form.find('select.city').html('');
  var url = $('input[name=ajaxcitystate]').val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      id: val
    },
    success:function(res){
      if(res.success == true){
          form.find('select.city').html(res.data);
          form.find('select.city').fSelect('reload');
      }else{
        
      }
    }
  });
});


// vote+review single

$(document).on('click','.submit_votereview',function(e){
  e.preventDefault();
  var form = $(this).closest('form');
  var target = $('#eatrank');
  var modal = $('#vote_review');
  var url = $('input[name=voteReviewEat_ajax]').val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: form.serialize(),
    success:function(res){
      if(res.success == true){
          modal.modal('hide');
          target.html(res.data);
          swal({
            title: res.message,
            timer: 2000
          });
      }else{
        swal({
          title: res.message,
          timer: 2000
        });
      }
    }
  });
})
