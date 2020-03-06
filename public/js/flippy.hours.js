// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{	
	"use strict";
   $('#formHours').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitHours').attr('disabled', ''); // disable upload button
        $("#output-hours").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Submitting.. Please wait..</div>');
	    $(this).ajaxSubmit({
        target: '#output-hours',
        success:  hoursSuccess //call function after success
        });
    });
	
$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});

$('a.btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('div').data('id');
    $('#modelDelete').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {
    var id = $('#modelDelete').data('id');
	var dataString = 'id='+ id ;
    $('[data-id=' + id + ']').parent().remove();
    $('#modelDelete').modal('hide');
	//ajax
	$.ajax({
type: "POST",
url: "delete_hours.php",
data: dataString,
cache: false,
success: function(html)
{
//$(".fav-count").html(html);
$("#output").html(html);
}
});
//ajax ends
});
	
});
 
function hoursSuccess()
{	
	"use strict";  
    $('#submitHours').removeAttr('disabled'); //enable submit button
   
}
