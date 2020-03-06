// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{	
	"use strict";
    $('#formLogin').on('submit', function(e)
    {	
        e.preventDefault();
        $('#submitLogin').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output-login").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Login you on.. Please wait..</div>');
		
        $(this).ajaxSubmit({
        target: '#output-login',
        success:  loginSuccess //call function after success
        });
    });
	
$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});
	
});
 
function loginSuccess()
{	
	"use strict";  
    $('#submitLogin').removeAttr('disabled'); //enable submit button
   
}

