// JavaScript Document


		

function stripeResponseHandler(status, response) {
	"use strict";
    if (response.error) {
        //enable the submit button
        $('#submitStripe').removeAttr("disabled");
        //display the errors on the form
        $(".payment-status").html(response.error.message);
    } else {
        var form$ = $("#formStripe");
        //get token id
        var token = response['id'];
        //insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        //submit form to the server
        $.ajax({
                type:'POST',
                url:"submit_stripe.php",
                data:$('#formStripe').serialize()+'&card_submit=1',
                beforeSend: function(){
					$(".payment-status").html('<div class="notice notice-success"><i class="fa fa-spinner fa-spin"></i> Processing payment. Please wait.</div>');
                    $('#submitStripe').prop('disabled', true);
				
                },success:function(msg){$(".payment-status").html(msg); }
				
		});
    }
}  

$(document).ready(function()
{	
	"use strict";

$("#formStripe").submit(function(event) {
        //disable the submit button to prevent repeated clicks
        $('#submitStripe').attr("disabled", "disabled");
        
        //create single-use token to charge the user
        Stripe.createToken({
            number: $('#cardNumber').val(),
            cvc: $('#cardCVC').val(),
            exp_month: $('#expMonth').val(),
            exp_year: $('#expYear').val()
        }, stripeResponseHandler);
        
        //submit from callback
        return false;
    });

	
    $('#formCheckout').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitCheckout').attr('disabled', ''); // disable upload button
        $("#output-checkout").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Working.. Please wait..</div>');
		$(this).ajaxSubmit({
        target: '#output-checkout',
        success:  checkoutSuccess //call function after success
        });
    });
	

});


function checkoutSuccess()
{		
	"use strict"; 
    $('#submitCheckout').removeAttr('disabled'); //enable submit button
   
}

	