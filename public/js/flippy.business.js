// JavaScript Document
new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(function(){
"use strict";	
$('#rate-biz').raty({readOnly: true, score: ratingAvg});
});

$(function() {
"use strict";	
$('#rate-biz-2').raty({
score: 0,
click: function(score, evt) {
	$('#rate-msg').load("rate.php?id="+businessId+"&score="+score+"&uniq="+uniqueId);
	$('#rate-msg').fadeOut(10000);
		}
	});
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

$('[data-toggle="tooltip"]').tooltip(); 

$('#formReview').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitReview').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output-review").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Submitting.. Please wait..</div>');
		
        $(this).ajaxSubmit({
        target: '#output-review',
        success:  reviewSuccess //call function after success
        });
    });
	
});

function reviewSuccess()
{	
	 "use strict";
    $('#submitReview').removeAttr('disabled'); //enable submit button
   
}

$('.gallery').each(function() { // the containers for all your galleries
    "use strict";
    $(this).magnificPopup({
        mainClass: 'mfp-with-zoom',
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function

            opener: function(openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        },
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});

$(function() {
    "use strict";
    $("#bookmarks").click(function() {
        var id = $(this).data("id");
        var name = $(this).data("name");
        var dataString = 'id=' + id;
        var parent = $(this);

        if (name === 'bookmarks') {
            $(this).fadeIn(200).html;
            $.ajax({
                type: "POST",
                url: "save_bookmarks.php",
                data: dataString,
                cache: false,

                success: function(html) {
                    parent.html(html);
                }
            });
        }
        return false;
    });
});


$(function() {
	"use strict";
    $(".vote").click(function() {
        var id = $(this).data("id");
        var name = $(this).data("name");
        var dataString = "id=" + id;
        var parent = $(this);
        if (name === "vote-1") {
            $(this).fadeIn(200).html;
            $.ajax({
                type: "POST",
                url: "vote_1.php",
                data: dataString,
                cache: false,
				dataType:'json',
                success: function(json) {
            		parent.html(json.btn),
					parent.parent().parent().find(".vote-msg").html(json.msg);
                }
            });
        } else if (name === "vote-2") {
            $(this).fadeIn(200).html;
            $.ajax({
                type: "POST",
                url: "vote_2.php",
                data: dataString,
                cache: false,
				dataType:'json',
                success: function(json) {
                    parent.html(json.btn),
					parent.parent().parent().find(".vote-msg").html(json.msg);
                }
            });
        } else if (name === "vote-3") {
            $(this).fadeIn(200).html;
            $.ajax({
                type: "POST",
                url: "vote_3.php",
                data: dataString,
                cache: false,
				dataType:'json',
                success: function(json) {
                    parent.html(json.btn),
					parent.parent().parent().find(".vote-msg").html(json.msg);
                }
            });
        } 
        return false;
    });
});

$('#display-reviews').infinitescroll({
		
		navSelector  : '#page-nav',    // selector for the paged navigation 
      	nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      	itemSelector : '.review-box',     //
		loading: {
          				finishedMsg: 'End of reviews.',
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

function popup(e){ "use strict"; var t=700;var n=400;var r=(screen.width-t)/2;var i=(screen.height-n)/2;var s="width="+t+", height="+n;s+=", top="+i+", left="+r;s+=", directories=no";s+=", location=no";s+=", menubar=no";s+=", resizable=no";s+=", scrollbars=no";s+=", status=no";s+=", toolbar=no";newwin=window.open(e,"windowname5",s);if(window.focus){newwin.focus()}return false}

