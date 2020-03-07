// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{	
	"use strict";
    $('#formBusiness').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitBusiness').attr('disabled', ''); // disable upload button
        $("#output-business").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Submitting.. Please wait..</div>');
		$(this).ajaxSubmit({
        target: '#output-business',
        success:  businessSuccess //call function after success
        });
    });
	
    $('#inputCategory').on("change",function () {
        var categoryId = $(this).find('option:selected').val();
        $.ajax({
            url: "update_subcategory.php",
            type: "POST",
            data: "categoryId="+categoryId,
            success: function (response) {
                console.log(response);
                $("#inputSubcategory").html(response);
            },
        });
    });
	
	
$('.star-rates').raty({
	readOnly: true,
	score: function() {
    return $(this).attr('data-score');

  }
});	 
	
});
 
function businessSuccess()
{		
	"use strict"; 
    $('#submitBusiness').removeAttr('disabled'); //enable submit button
   
}


	