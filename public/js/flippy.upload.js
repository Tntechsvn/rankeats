// JavaScript Document

new WOW().init();
$(function() {
	"use strict";
$.fn.raty.defaults.path = 'templates/'+ siteTempalte +'/images';
});

$(document).ready(function()
{	
	"use strict";
    $('#formGallery').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitGallery').attr('disabled', ''); // disable upload button
        $("#output-gallery").html('<div class="notice notice-info"><i class="fa fa-spinner fa-spin"></i> Uploading.. Please wait..</div>');
		        $(this).ajaxSubmit({
        target: '#output-gallery',
        success:  uploadSuccess //call function after success
        });
    });
	
$('.star-rates').raty({
	readOnly: true,
  score: function() {
    return $(this).attr('data-score');

  }
});
	
});
 
function uploadSuccess()
{	
	"use strict";  
    $('#submitGallery').removeAttr('disabled'); //enable submit button
   
}

function handleFileSelect(evt) {
	"use strict";
	
	$('#preview-images').html('');
	
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="preview-thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('preview-images').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('inputPhotos').addEventListener('change', handleFileSelect, false);