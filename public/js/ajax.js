
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

$(document).on('click','.cancel_form',function(e){
    var form = $(this).closest('form');
    form.find('#preview-images').html('');
    form[0].reset();
  });

window.select_city = function(){
  $(".choose-state").change(function(){
      var name_state = $(this).val();
      var url = $('input[name=ajaxcitystate]').val();
      var city = $(this).closest('.location-address').find('.choose-city');
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: "POST",
            data:{name_state:name_state},
            success:function(data){
              city.html(data);
            }
          });       
    });
}

    $(document).on('click','.button-number-location-plus',function(e){
      e.preventDefault();
      var value = $(this).closest('form').find('.number-location').val();
      if(value == ""){
        $(this).closest('form').find('.number-location').val(1);
      }else{
        $(this).closest('form').find('.number-location').val(parseInt(value)+1);
      }
    });

    $(document).on('click','.button-number-location-minus',function(e){
      e.preventDefault();
      var value = $(this).closest('form').find('.number-location').val();
      if(value == "" || value == 1){
        $(this).closest('form').find('.number-location').val(1);
      }else{
        $(this).closest('form').find('.number-location').val(parseInt(value)-1);
      }
      
    });
  function change_location(){
    var form = $('#register_business');
    var target = form.find('.location');
    var val = form.find('.number-location').val();
    target.html('');
    if(val > 1){
      var i = 1;
      for(i = 1; i <= val; i++){
        var clone = form.closest('.register-form').find('.clone.location-address').clone().removeClass('clone');
        clone.find('h4').html('Business Location -'+i);
        clone.find('.choose-zipcode').attr('name','zipcode'+i);
        clone.find('.choose-state').attr('name','state'+i);
        clone.find('.choose-city').attr('name','city'+i);
        clone.find('.choose-address').attr('name','address'+i);
        target.append(clone);
      }
    }else{
      var clone = form.closest('.register-form').find('.clone.location-address').clone().removeClass('clone');
      clone.find('h4').html('Business Location');
      clone.find('.choose-zipcode').attr('name','zipcode1');
      clone.find('.choose-state').attr('name','state1');
      clone.find('.choose-city').attr('name','city1');
      clone.find('.choose-address').attr('name','address1');
      target.append(clone);
    }
    select_city();
  }
  $(document).on('change','.number-location',function(){
    change_location();
  });
  $(document).on('click','.button-number-location-minus',function(){
    change_location();
  });
  $(document).on('click','.button-number-location-plus',function(){
    change_location();
  });

// sign-in
$(document).on('click','.signin-popup',function(e){
	e.preventDefault();
  var form = $(this).closest('form');
	var parsley = $(this).closest('form').parsley();
	if(parsley.isValid() != true){
        parsley.validate();
        return false;
    }
  if (grecaptcha === undefined) {
    form.find('.e-capcha').html('Recaptcha not defined');
    return; 
  }

  var response = grecaptcha.getResponse();

  if (!response) {
    form.find('.e-capcha').html('Coud not get recaptcha response');
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
            grecaptcha.reset();
            swal({
                title: res.message,
                timer: 2000
            });
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
          window.location.reload();
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

// $(document).on('click','.submit_votereview',function(e){
//   e.preventDefault();
//   var form = $(this).closest('form');
//   var parsley = form.parsley();
//   if(parsley.isValid() != true){
//       parsley.validate();
//       return false;
//   }
//   var target = $('#eatrank');
//   var modal = $('#vote_review');
//   var url = $('input[name=voteReviewEat_ajax]').val();
//   $.ajax({
//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     },
//     type:'POST',
//     url: url,
//     data: form.serialize(),
//     success:function(res){
//       if(res.success == true){
//           $('#eatrank').removeClass('nothasvote');
//           modal.modal('hide');
//           target.html(res.data);
//           swal({
//             title: res.message,
//             timer: 2000
//           });
//       }else{
//         swal({
//           title: res.message,
//           timer: 2000
//         });
//       }
//     }
//   });
// })




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
  var id = $(this).data('id');
  var name = $(this).data('name');
  var category_id = $(this).data('category-search');
  target = $('#review-popup');
  target.find('#reviewforbusiness').html("");
  target.find('.no-results').addClass("hidden");
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type:'POST',
    url: url,
    data: {
      id: id,
      category_id: category_id
    },
    success:function(res){
      target.find('.modal-header h3 span').html(name);
      target.attr('data-id',id);
      if(res.success == true){
          after_ajax();
          target.modal('show');
          target.find('#reviewforbusiness').html(res.data);
      }else{
        after_ajax();
        target.modal('show');
        target.find('.no-results').removeClass('hidden').html(res.message+" "+name);
      }
    }
  });
});

// photo popup

$(document).on('click','.show-photo',function(){
  var modal = $('#photo-popup');
  var url = $('input[name=show-photo]').val();
  var user_id = $(this).data('id');
  var name = $(this).data('name');
  modal.find('#has-photo').html("");
  modal.find('.no-photo').addClass("hidden");

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
          modal.find('#has-photo').html(res.data);
          modal.find('.modal-header h3').html('Images of '+name);
          modal.modal('show');
          $('.lightgalleryphoto').lightGallery();
      }else{
        modal.find('.no-photo').removeClass('hidden');
        modal.modal('show');
        
      }
    }
  });
});

// add eat search page

$(document).on('click','.submit_addeat_search', function(e){
  e.preventDefault();
  var modal = $(this).closest('#eatModal');
  var form = $(this).closest('form');
  var parsley = $(this).closest('form').parsley();
  if(parsley.isValid() != true){
      parsley.validate();
      return false;
  }
  var url = form.attr('action');
  $.ajax({
    type: 'POST',
    url: url,
    data: form.serialize(),
    success:function(res){
      if(res.state == 'error'){
        swal({
          title: res.message,
          timer: 3000
        });
      }else{
        swal({
          title: res.message,
          timer: 3000
        });
        modal.modal('hide');
      }
    }
  });
});


// login here

$(document).on('click','.login-here',function(e){
  e.preventDefault();
  var link = $(this).data('link');
  var login_url = $(this).attr('href');
  if (typeof(Storage) !== "undefined") {
    sessionStorage.setItem('link',link);
    window.location.href = login_url;
  }
  
});
