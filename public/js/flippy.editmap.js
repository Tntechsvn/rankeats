// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function() {
	"use strict";
$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});


  $('#submitMap').click(function(e) {
	 e.preventDefault(); 
	 var position = marker.getPosition();
	 
	
    $.ajax({
           type: "POST",
           url: "update_map.php",
          data: {
        	lat: position.lat(),
        	lng: position.lng(),
			id : businessId
      		},
           success: function(data)
           {
                $('#output').html(data);
           }
         });
  
  
  });


});