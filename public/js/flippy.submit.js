// JavaScript Document

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
	
	
	$("#formHours select").prop('disabled', true);
	$("#formHours #submitHours").prop('disabled', true);
	$("#formGallery input").prop('disabled', true);
	$("#formGallery #submitGallery").prop('disabled', true);
	
	
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
	
});
 
function businessSuccess()
{		
	"use strict"; 
    $('#submitBusiness').removeAttr('disabled'); //enable submit button
   
}

function hoursSuccess()
{	
	"use strict";  
    $('#submitHours').removeAttr('disabled'); //enable submit button
   
}

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
	
if (document.getElementById('inputPhotos') !==null) {	
  document.getElementById('inputPhotos').addEventListener('change', handleFileSelect, false);
}

	