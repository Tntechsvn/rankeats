
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
function before_ajax() {
    $('body').prepend('<div class="loading"><div class="spinner">\
                <i class="fas fa-spinner fa-spin fa-3x fa-fw"></i>\
              </div></div>');
  }
  function after_ajax() {
    $('body').find('.loading').remove();
  }
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
  var category_id = modall.find('input[name=category_id]').val();
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      business_id: business_id,
      category_id:category_id,
    },
    success:function(res){
      modall.modal('hide');
      var vote_id = '.vote-'+business_id+'-'+res.city_id;
      $('#main').find(vote_id).removeClass('unvote').addClass('vote_now').html('Vote');
      $('#businessreview').find('.unvote').removeClass('unvote').addClass('vote_now').html('Vote');
      swal({
        title: res.message,
        timer: 4000
      });;
    }
  });
});

$(document).on('click','.unvote',function(){
  var business_id = $(this).data('id');
  var category_id = $(this).data('category_id');

  var business_name = $(this).data('name');
  var modal = $('#un_vote');
  modal.find('input[name=business_id]').val(business_id);
  modal.find('input[name=category_id]').val(category_id);
  modal.find('.message').html('You voted for '+business_name+', do you want to change your vote? 0/1 votes remain.');
  modal.modal('show');
});

$(document).on('click','.vote_now',function(){
  var $this = $(this);
  var url = $('input[name=vote-ajax]').val();
  var business = $(this).data('id');
  var category_id = $(this).data('category_id');
  var modal_target = $('#voteModal');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      business: business,
      category_id:category_id,
    },
    success:function(res){
      if(res.success == true){
          modal_target.find('input[name=business_id]').val(business);
          modal_target.modal('show');
          var vote_id = '.vote-'+res.id_voted +'-'+res.city_id;
          $('#main').find(vote_id).removeClass('unvote').addClass('vote_now').html('Vote');
          $this.html('My Vote');
          $this.addClass('unvote').removeClass('vote_now');
      }else{
        
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
        modal.find('.e-lang').html("*"+res.message);
        // swal({
        //   title: res.message,
        // });
      }
    }
  });
});


// end

/*$(document).on('change','select[name=state]', function(){
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
});*/


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


// reaction review

$(document).on('click','.funnyy',function(){
  var $this = $(this);
  var url = $('input[name=reaction_review]').val();
  var review_id = $(this).data('review');
  var type = $(this).data('type');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      review_id: review_id,
      type: type
    },
    success:function(res){
      if(res.success == true){
        $this.closest('.funny').find('.active').removeClass('active').addClass('funnyy');
        $this.addClass('active').removeClass('funnyy');
      }else{
        swal({
          title: res.message,
          timer: 2000
        });
      }
    }
  });
});

// review popup

$(document).on('click','.review-popup',function(){
  before_ajax();
  var url = $('input[name=review_search]').val();
  id = $(this).data('id');
  target = $('#review-popup');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      id: id
    },
    success:function(res){
      if(res.success == true){
          after_ajax();
          target.modal('show');
          target.find('#reviewforbusiness').html(res.data);
      }else{
        after_ajax();
        target.modal('show');
        target.find('.no-results').removeClass('hidden').html(res.message);
      }
    }
  });
});

// photo popup

$(document).on('click','.show-photo',function(){
  var modal = $('#photo-popup');
  var url = $('input[name=show-photo]').val();
  var user_id = $(this).data('id');
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      user_id: user_id
    },
    success:function(res){
      if(res.success == true){
          modal.modal('show');
      }else{
        modal.find('.no-photo').removeClass('hidden');
        console.log(res.id);
        modal.modal('show');
        
      }
    }
  });
});
