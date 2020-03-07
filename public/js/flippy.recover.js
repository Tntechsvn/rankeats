// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{	
	"use strict";
    $('#formRecover').on('submit', function(e)
    {	
        e.preventDefault();
        $('#submitRecover').attr('disabled', ''); // disable upload button
        $("#output-recover").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Working.. Please wait..</div>');
		
        $(this).ajaxSubmit({
        target: '#output-recover',
        success:  recoverSuccess //call function after success
        });
    });
	
$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});
	
});
 
function recoverSuccess()
{	
	"use strict";  
    $('#submitRecover').removeAttr('disabled'); //enable submit button
   
}

