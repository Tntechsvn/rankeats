// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{	
	"use strict";
    $('#formContact').on('submit', function(e)
    {	
        e.preventDefault();
        $('#sendMail').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output-mail").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Sending mail.. Please wait..</div>');
		
        $(this).ajaxSubmit({
        target: '#output-mail',
        success:  mailSuccess //call function after success
        });
    });
	
$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});
	
});
 
function mailSuccess()
{	
	"use strict";  
    $('#sendMail').removeAttr('disabled'); //enable submit button
   
}

