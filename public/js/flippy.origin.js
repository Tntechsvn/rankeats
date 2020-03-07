// JavaScript Document

$('#btn-search').click(function(e) {
	"use strict";
	e.preventDefault();
    $('.search-bar').slideToggle();    
});


$(document).ready(function()
{	
	"use strict";
    $('#formNavLogin').on('submit', function(e)
    {	
        e.preventDefault();
        $('#navLogin').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output-nav-login").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Login you on.. Please wait..</div>');
		
        $(this).ajaxSubmit({
        target: '#output-nav-login',
        success:  navloginSuccess //call function after success
        });
    });
	
	$('.select_city').select2({
		placeholder: 'Select City',
		ajax: {
		  url: './ajax.php?custom=city',
		  dataType: 'json',
		  method:"POST",
		  delay: 250,
		  processResults: function (data) {
			return {
			  results: data
			};
		  },
		  cache: true
		}
	});
	$(document).on("click",".seletedplan",function(e){
		$(".planinfo").val($(".planvalue option:selected").val());
		$(".planname").val($(this).data("plan"));
		if($(this).data("plan") === "Pay to Home"){
			$(".ifpaytohome").hide();
			$("#location_items").find("input").attr("required",false);
		}else{
			$(".ifpaytohome").show();
			$("#location_items").find("input").attr("required",true);
		}
	});
	$(document).on("change","#formRegister input[name='type']",function(e){
		if($(this).val() == "ranker"){
			$("#checkLbl").html("Receive emails for updates on items you voted for or reviewed");
		}else if($(this).val() == "business"){
			$("#checkLbl").html("Receive emails on your items that are voted for or reviewed");
		}
		
	});

	$(document).on("change","input[name='availability']",function(e){
		if($(this).val() == "date"){
			$("#date_available").show();
		}else{
			$("#date_available").hide();
		}
	});
	$(document).on("keyup","#inputBizname",function(e){
		var bzname = $(this).val();
		if(bzname>3){
			$.ajax({
			  url: "./ajax.php?custom=business",
			  dataType: 'json',
			  method:"POST",
			  data:$("#formBusiness").serialize(),
			}).done(function() {
			  
			});
		}
	});
	$.ajax({
	  url: "./ajax.php",
	  method:"POST",
	  data:{requesttype:"getstates"},
	}).done(function(data) {
		    $.each(data, function(index,val){
				$('#business_state').append($('<option>').val(val.code).text(val.name));
			});
	});
	$(document).on("change","#business_state",function(e){
		$.ajax({
		  url: "./ajax.php",
		  method:"POST",
		  data:{requesttype:"getcities",region:$(this).val()},
		}).done(function(data) {$('#inputCity').html("<option value=''>Select City</option>");
				$.each(data, function(index,val){
					$('#inputCity').append($('<option>').val(val.city_id).text(val.city));
				});
		});
	});

	$( "#location_items" ).autocomplete({
		source: function( request, response ) {
		$.ajax({
			url: "./ajax.php",
			type: 'post',
			dataType: "json",
			data: {
				search: request.term
			},
			success: function( data ) {
				response($.map(data, function (item) {
					return {
						label: item.category_name,
						value: item.category_id
					};
				}));
			}
		});
            
		},
		select: function (event, ui) {
		   // Set selection
		   $('#location_items').val(ui.item.label); // display the selected text
		   $('#searcheat_id').val(ui.item.value); // save selected id to input
		   return false;
		},
		open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function() {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		}
	});
    $("#business_pic").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
    //autocomplete
    $(".location_search").autocomplete({
        source: "ajax.php",
        minLength: 3
    });  
    $("#location_items1").autocomplete({
        source: "ajax.php",
        minLength: 3
    });  

	$(document).on("click",".cancelvote",function(e){
		$(".reviewBox").hide();
		$(".firstWindow").show();
		$(".secondWindow").hide();
	});
	$(document).on("click",".rankerBtn",function(e){
		$(".rankerShow").slideDown();
	});
	$(document).on("click",".yesforvote",function(e){
		$(".reviewBox").slideDown();
		$(".firstWindow").hide();
		$(".secondWindow").show();
	});
	$(document).on("click",".addplus",function(e){
		var c = $("#business_locations").val();
		$("#business_locations").val(++c);
	});
	$(document).on("click",".addminus",function(e){
		var c = $("#business_locations").val();
		if(c>1)
		$("#business_locations").val(--c);
	});
	
	$('.select_state').select2({
		placeholder: 'Select State',
		ajax: {
		  url: './ajax.php?custom=state',
		  dataType: 'json',
		  method:"POST",
		  delay: 250,
		  processResults: function (data) {
			return {
			  results: data
			};
		  },
		  cache: true
		}
	});

});


function navloginSuccess()
{	
	"use strict";  
    $('#navLogin').removeAttr('disabled'); //enable submit button
   
}
