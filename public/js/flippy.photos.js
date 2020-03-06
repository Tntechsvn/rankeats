// JavaScript Document

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

//Delete	
$('span.btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('div').data('id');
    $('#modelDelete').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {
    var id = $('#modelDelete').data('id');
	var dataString = 'id='+ id ;
    $('[data-id=' + id + ']').remove();
    $('#modelDelete').modal('hide');
	//ajax
	$.ajax({
type: "POST",
url: "delete_photo.php",
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

$('.gallery').each(function() { // the containers for all your galleries
	"use strict";
    $(this).magnificPopup({
		mainClass: 'mfp-with-zoom',
		zoom: {
    enabled: true, // By default it's false, so don't forget to enable it

    duration: 300, // duration of the effect, in milliseconds
    easing: 'ease-in-out', // CSS transition easing function

    // The "opener" function should return the element from which popup will be zoomed in
    // and to which popup will be scaled down
    // By defailt it looks for an image tag:
    opener: function(openerElement) {
      // openerElement is the element on which popup was initialized, in this case its <a> tag
      // you don't need to add "opener" option if this code matches your needs, it's defailt one.
      return openerElement.is('img') ? openerElement : openerElement.find('img');
    }
  },
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled:true
        }
    });
});


$('#display-posts').infinitescroll({
		
		navSelector  : '#page-nav',    // selector for the paged navigation 
      	nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      	itemSelector : '.col-gallery',     //
		loading: {
          				finishedMsg: 'End of photos.',
          				img: 'templates/'+ siteTempalte +'/images/loader.gif'
	}
	}, function(newElements, data, url){
		
	"use strict";	
		//Delete
$("span.btnDelete").unbind( "click" );
$("#btnDelteYes").unbind( "click" );		
$('span.btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('div').data('id');
    $('#modelDelete').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {
    var id = $('#modelDelete').data('id');
	var dataString = 'id='+ id ;
    $('[data-id=' + id + ']').remove();
    $('#modelDelete').modal('hide');
	//ajax
	$.ajax({
type: "POST",
url: "delete_photo.php",
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


