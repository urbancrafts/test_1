jQuery(document).ready(function(){
    jQuery.ajaxSetup({
        headers:
        { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') }
    });

    jQuery("form#resort-image-upload-form").live("submit", function(e){
        e.preventDefault();
        
        var action = jQuery(this).attr('action');
        var formdata = new FormData(this);//create form instance

       if(jQuery.trim(jQuery('#resort-img1').val()) == ""){

        jQuery('#resort-img1').css('border', 'solid 1px red');
        jQuery('.resort-media-error').show();
        jQuery('.resort-media-error').html('*Browse for an image file | Max(1.5MB)');

       }else{
        jQuery.ajax({
               type: "POST",
               dataType: "json",
               url: action,
               data: formdata,
               cache: false,
               contentType: false,
               processData: false,
               beforeSend:function(){
                jQuery(".blog-alert-success").show();
                jQuery('.blog-alert-danger').hide();
                jQuery(".blog-alert-success").html("<div class='load'>Loading...</div>");
               },
               complete:function(){
                jQuery(".alert").hide();
               },
               error:function(){
                jQuery(".blog-alert-success").hide();
                jQuery(".blog-alert-danger").show();
                jQuery(".blog-alert-danger").html("Please check your internet connection");
               },
               success:function(data){
                  if(data.success == true){
                    jQuery("#sendEmail").prop('disabled', true);
                    jQuery(".blog-alert-success").show();
                    jQuery(".blog-alert-success").html(data.message);
                  }else if(data.success == false){
                    jQuery(".blog-alert-success").hide();
                    jQuery(".blog-alert-danger").show();
                    jQuery(".blog-alert-danger").html(data.message);
                  }else{
                    jQuery(".blog-alert-success").hide();
                    jQuery(".blog-alert-danger").show();
                    jQuery(".blog-alert-danger").html(data);
                  }
                    
               }
               });
      
       }
      });
      

});