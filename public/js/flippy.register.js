// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{	
	"use strict";
    $('#formRegister').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitRegister').attr('disabled', '');
        $("#output-register").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Working.. Please wait..</div>');
		
        $(this).ajaxSubmit({
        target: '#output-register',
        success:  registerSuccess //call function after success
        });
    });

$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});	
	
});
 
function registerSuccess()
{	
	"use strict"; 
    $('#submitRegister').removeAttr('disabled'); //enable submit button
   
}

	