// JavaScript Document

$('#display-posts').infinitescroll({
		
		navSelector  : '#page-nav',    // selector for the paged navigation 
      	nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      	itemSelector : '.col-box',     //
		loading: {
          				finishedMsg: 'End of business listings.',
          				img: 'templates/'+ siteTempalte +'/images/loader.gif'
	}
	}, function(newElements, data, url){
		"use strict";
		$('.star-rates').raty({
		readOnly: true,
  		score: function() {
   		 return $(this).attr('data-score');

  		}
		});
		$('.star-rates').raty('reload');	
	});	

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{
"use strict";
$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});
});

