// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{	
	"use strict";
    $('#fromInfo').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitInfo').attr('disabled', ''); // disable upload button
        $("#output-info").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Updating.. Please wait..</div>');
		$(this).ajaxSubmit({
        target: '#output-info',
        success:  infoSuccess //call function after success
        });
    });
	
	$('#formPassword').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitPassword').attr('disabled', ''); // disable upload button
        $("#output-password").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Updating.. Please wait..</div>');
		$(this).ajaxSubmit({
        target: '#output-password',
        success:  passwordSuccess //call function after success
        });
    });
	
	$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});
	
	
$('#inputPic').on('change', function()
{

var picFile = $(this).val(); 
$('#fileContainer').html('<i class="fa fa-camera"></i> ' + picFile);	
	
$("#preview-avatar").html('');
$("#output-profile-pic").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Uploading. Please wait...</div>');

$("#profilepicInfo").ajaxForm(
{
    dataType:'json',
    success:function(json){
       $('#preview-avatar').html(json.img),
       $('#output-profile-pic').html(json.msg);
	   $('#fileContainer').html('<i class="fa fa-camera"></i> Select');
    }
}).submit();

});
	
	
});
 
function infoSuccess()
{		
	"use strict"; 
    $('#submitInfo').removeAttr('disabled'); //enable submit button
   
}

function passwordSuccess()
{		
	"use strict"; 
    $('#submitPassword').removeAttr('disabled'); //enable submit button
   
}

$(function(){
	"use strict"; 
    $('#inputBirthday').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3y'
})
})




	