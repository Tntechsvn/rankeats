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
$('a.btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('div').data('id');
    $('#modelDelete').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {
    var id = $('#modelDelete').data('id');
	var dataString = 'id='+ id ;
    $('[data-id=' + id + ']').parent().parent().remove();
    $('#modelDelete').modal('hide');
	//ajax
	$.ajax({
type: "POST",
url: "delete_business.php",
data: dataString,
cache: false,
success: function(html)
{
$("#output").html(html);
}
});
});

});

$('#display-posts').infinitescroll({
		
		navSelector  : '#page-nav',    // selector for the paged navigation 
      	nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      	itemSelector : '.col-long-biz',     //
		loading: {
          				finishedMsg: 'End of your business listings.',
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
		
$("span.btnDelete").unbind( "click" );
$("#btnDelteYes").unbind( "click" );	
$('a.btnDelete').on('click', function (e) {
    e.preventDefault();
    var id = $(this).closest('div').data('id');
    $('#modelDelete').data('id', id).modal('show');
});

$('#btnDelteYes').click(function () {
    var id = $('#modelDelete').data('id');
	var dataString = 'id='+ id ;
    $('[data-id=' + id + ']').parent().parent().remove();
    $('#modelDelete').modal('hide');
	//ajax
	$.ajax({
type: "POST",
url: "delete_business.php",
data: dataString,
cache: false,
success: function(html)
{
$("#output").html(html);
}
});
});	
	});	