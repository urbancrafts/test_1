jQuery(document).ready(function(){
     
  var site_url = "http://127.0.0.1:8000";//full site domain url


// var changeElementBorderStyle = function(elem){
//   jQuery('elem).css('border', 'solid 1px gray');
// }



//  function changeElementBorderStyle(elem){
//   jQuery(elem).css('border', 'solid 1px gray');
//  }

  jQuery("#login-email").on('focus', function(){
       jQuery('.alert').hide();
  });

  jQuery("#login-password").on('focus', function(){
       jQuery('.alert').hide();   
  });

  jQuery("#recover-link").on('click', function(){
    jQuery("#model-request-form").hide().animate({'right': '200px'}, 1000, 'linear');
    jQuery("#mem_signup").hide().animate({'right': '200px'}, 1000, 'linear');
    jQuery("#recover-form").show().animate({'left': '200px'}, 1000, 'linear');

  });

  jQuery("#sign-in-link").on('click', function(){
    jQuery("#model-request-form").show().animate({'left': '200px'}, 1000, 'linear');
    jQuery("#recover-form").hide().animate({'right': '200px'}, 1000, 'linear');
    jQuery("#mem_signup").hide().animate({'right': '200px'}, 1000, 'linear');
  });

  jQuery("#login-recocer-link").on('click', function(){
    jQuery("#model-request-form").show().animate({'left': '200px'}, 1000, 'linear');
    jQuery("#recover-form").hide().animate({'right': '200px'}, 1000, 'linear');
    jQuery("#mem_signup").hide().animate({'right': '200px'}, 1000, 'linear');
  });

  jQuery("#signup-link").on('click', function(){
    jQuery("#model-request-form").hide().animate({'right': '200px'}, 1000, 'linear');
    jQuery("#recover-form").hide().animate({'right': '200px'}, 1000, 'linear');
    jQuery("#mem_signup").show().animate({'left': '200px'}, 1000, 'linear');

  });

    jQuery("#model-request-form").on("submit", function(e){//event handler for login form
        e.preventDefault();
  
        var action = jQuery(this).attr("action");
        var loginId = jQuery("#login-email").val();
        var pass = jQuery("#login-password").val();
        
        var urlPath = site_url;
        
        if(jQuery.trim(jQuery("#login-email").val()) == "" || jQuery.trim(jQuery("#login-password").val()) == ""){
          jQuery(".login-alert-error").show();
            jQuery(".login-alert-error").html(" Enter your email address and password!");

        }else{
        
            jQuery.ajax({
            headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
             },
            type: "POST",
            dataType: "json",
            url: action,
            data: {"email": loginId, "password": pass},
            beforeSend:function(){
              jQuery(".login-alert-error").hide();
              jQuery('.login-status').show();
                jQuery('.login-status').html(" Attempting to login...");
            },
            complete:function(){
                
            },
           
            success:function(data){
              
              if(data.status == true){
                jQuery("#sendEmail").prop('disabled', true);
                jQuery(".login-status").show();
                jQuery(".login-status").html(data.message);
                if(data.data.values.user_type == "Customer" ){//check if session user_type is customer
                 window.location = site_url+"/auth/customer/dashboard";//redirect to customer page
                 }else if(data.data.values.user_type == "Business" && data.data.values.is_business_verified == 0){//check if session user_type is business and is not verified
                   window.location = site_url+"/auth/business/business_verification_form";//redirect to business verification page
                 }else if(data.data.values.user_type == "Business" && data.data.values.is_business_verified == 1){//check if session user_type is business and is verified
                   window.location = site_url+"/auth/business/dashboard";//redirect to business dashboard page
                 }else if(data.data.values.user_type == "Admin"){//check if session user_type is admin
                   window.location = site_url+"/auth/admin/dashboard";//redirect to admin page
                 }else{
                   window.reload();
                 }
               }else if(data.status == false){
                 jQuery(".login-status").hide();
                 jQuery(".login-alert-error").show();
                 jQuery(".login-alert-error").html(data.message);
               }else{
                 jQuery(".login-status").hide();
                 jQuery(".login-alert-error").show();
                 jQuery(".login-alert-error").html(data);
               }

            },

            error:function(jqXHR, exception){

              if(jqXHR.status === 0){
                jQuery(".login-status").hide();
                jQuery(".login-alert-error").fadeIn('slow');
                jQuery('.login-alert-error').html('Please check your internet connection.');	
               
              }else if(jqXHR.status == 404){
                jQuery(".login-status").hide();
                jQuery(".login-alert-error").fadeIn('slow');
                jQuery('.login-alert-error').html('Request route not found.');
              }else if(jqXHR.status == 500){
                jQuery(".login-status").hide();
                jQuery(".login-alert-error").fadeIn('slow');
                jQuery('.login-alert-error').html('Internal Server Error [500]');
                
              }else if(jqXHR.status == 400){
                var errors = jqXHR.responseJSON;
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html(errors.message);

              }else if(jqXHR.status == 401){
                var data = jqXHR.responseJSON;
                jQuery(".login-status").hide();
                jQuery(".login-alert-error").fadeIn('slow');
                jQuery('.login-alert-error').html(data.message);
              //  jQuery('.login-status').show();
              //  jQuery('.login-status').html(data.message);
            
            jQuery("#model-request-form").hide();
            jQuery('#otp-form').show();
            jQuery('#otp-form').html("\r\n<h3>Confirm OTP Code<\/h3><input type=\'hidden\' id=\'site_url\' value=\'"+site_url+"\'><input type=\'hidden\' id=\'type\' name=\'type\' value=\'email_verification\'><input type=\'hidden\' id=\'user_id\' name=\'user_id\' value=\'"+data.data.values.id+"\'><div><span class=\'wpcf7-form-control-wrap otp-code\'><input type=\'text\' id=\'otp_code\' class=\'wpcf7-form-control wpcf7-text wpcf7-validates-as-required\' placeholder=\'OTP Code\' name=\'otp_code\'><\/span><\/div> <div class=\'row\'><div class=\'col-lg-8\'> <div class=\'login-horizental\'><button class=\'button alt btn req-btn\' type=\'submit\'>Verify<\/button><\/div><\/div><\/div>\r\n");  
              }else if(jqXHR.status == 422){
                var errors = jqXHR.responseJSON;
          // $.each(json.responseJSON, function (key, value) {
          //     $('.'+key+'-error').html(value);
          // });
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html(errors.data.errors);
          
              }else if(exception === 'parsererror'){
                jQuery(".login-status").hide();
                jQuery(".login-alert-error").fadeIn('slow');
                jQuery('.login-alert-error').html('Requested JSON parse failed');
                
              }else if(exception === 'timeout'){
                jQuery(".login-status").hide();
                jQuery(".login-alert-error").fadeIn('slow');
                jQuery('.login-alert-error').html('Time out error');
                
              }else if(exception === 'abort'){
                jQuery(".login-status").hide();
                jQuery(".login-alert-error").fadeIn('slow');
                jQuery('.login-alert-error').html('Ajax request aborted');
                
              }
                
            }

          });

        }

});


jQuery("#first_name").on('focus', function(e){
  jQuery(this).css('border', 'solid 0px');
});
jQuery("#last_name").on('focus', function(e){
  jQuery(this).css('border', 'solid 0px');
});

jQuery("#phone").on('focus', function(e){
  jQuery(this).css('border', 'solid 0px');
});

jQuery("#email").on('focus', function(e){
  jQuery(this).css('border', 'solid 0px');
});

jQuery("#email-forgot").on('focus', function(e){
  jQuery(this).css('border', 'solid 0px');
});

jQuery("#pass").on('focus', function(e){
  jQuery(this).css('border', 'solid 0px');
});
jQuery("#cpass").on('focus', function(e){
  jQuery(this).css('border', 'solid 0px');
});

jQuery("#otp_code").on('focus', function(e){
  jQuery(this).css('border', 'solid 0px');
});

jQuery("#terms").on("change", function(){//a readstatechange event to be called when check and uncheck terms & conditions checkbox
      if(this.checked){
  //jQuery(".terms-element").show().animate({height: '200px'}, "slow");
      jQuery("#register-btn").prop('disabled', false);
      }else{
        //jQuery(".terms-element").hide().animate({height: '-200px'}, "slow");
        jQuery("#register-btn").prop('disabled', true);
      }
});

jQuery("#mem_signup").on("submit", function(e){//create a submit event for the user registration modal sub login form
  e.preventDefault();

  //create jquery form local variables for escort signup form fields
  var action = jQuery(this).attr("action");
  var first_name = jQuery("#first_name").val();
  var last_name = jQuery("#last_name").val();
  var phone = jQuery("#phone").val();
  var email =  jQuery(this).find("#email").val();
  var pass = jQuery("#pass").val();
  var cpass = jQuery("#cpass").val();
  var account_type = jQuery("#account_type").val();
  

  
  if(jQuery.trim(jQuery("#first_name").val()) == ""){//check if name field is empty
      jQuery("#first_name").css('border', 'solid 1px #c03826');
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery(".login-alert-error").html("Enter your first name!");
  }else if(jQuery.trim(jQuery("#last_name").val()) == ""){//check if name field is empty
    jQuery("#last_name").css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html("Enter your last name!");
  }else if(jQuery.trim(email) == ""){//check if email field is empty
    jQuery(email).css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html(" Enter your email address!");
  }else if(jQuery.trim(jQuery("#phone").val()) == ""){//check if phone field is empty
    jQuery("#phone").css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html(" Enter your phone number!");
  }else if(!Number(jQuery("#phone").val())){//check if phone field entry is not numeric
    jQuery("#phone").css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html("Phone number must be numeric!");
  
  }else if(jQuery.trim(jQuery("#pass").val()) == "" || jQuery.trim(jQuery("#pass").val()).length < 6){//check if password field is empty or data length is less than six(6)
    jQuery("#pass").css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html("Password must not be less than six(6) characters!");
  }else if(jQuery.trim(jQuery("#cpass").val()) == ""){//check if confirm password field is empty
    jQuery("#cpass").css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html(" Confirm your password");
  }else if(jQuery.trim(jQuery("#cpass").val()) != jQuery("#pass").val()){//check if confirm password entry matches with password
    jQuery("#cpass").css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html(" Confirmed password does not match with password entry");
  }else if(!jQuery("#terms").prop("checked")){//check if terms & condition checkbox is not checked
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html(" Read and agree with our terms by checking the box");
  }else{
      //else call the ajax function
      jQuery.ajax({
      headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
      type: "POST",
      dataType: "json",
      url: action,
      data: {"first_name": first_name, "last_name": last_name, "phone": phone, "email": email, "password": pass, "password_confirmation": cpass, "user_type": account_type},
      beforeSend:function(){
          //jQuery(".register-error").hide();
          //jQuery(".login-status").show();
          //jQuery('.login-status').html("<class=Processing data...");
          //jQuery("#register-btn").prop('disabled', true);
          //jQuery("#register-btn").html('<div class="loader"> </div>')
      },
      complete:function(){
          
      },
      
      success:function(data){
          if(data.status == true){
            //jQuery('#register-btn').prop('disabled', true);
            //jQuery(".register-error").hide();
            //jQuery(".register-success").fadeIn('slow');
            jQuery('.login-status').show();
            jQuery('.login-status').html(data.message);
            
            jQuery("#mem_signup").hide();
            jQuery('#otp-form').show();
            jQuery('#otp-form').html("\r\n<h3>Confirm OTP Code<\/h3><input type=\'hidden\' id=\'site_url\' value=\'"+site_url+"\'><input type=\'hidden\' id=\'type\' name=\'type\' value=\'email_verification\'><input type=\'hidden\' id=\'user_id\' name=\'user_id\' value=\'"+data.data.user.id+"\'><div><span class=\'wpcf7-form-control-wrap otp-code\'><input type=\'text\' id=\'otp_code\' class=\'wpcf7-form-control wpcf7-text wpcf7-validates-as-required\' placeholder=\'OTP Code\' name=\'otp_code\'><\/span><\/div> <div class=\'row\'><div class=\'col-lg-8\'> <div class=\'login-horizental\'><button class=\'button alt btn req-btn\' type=\'submit\'>Verify<\/button><\/div><\/div><\/div>\r\n");
              
          }else if(data.status == false){
            jQuery(".login-status").hide();
            jQuery(".login-alert-error").fadeIn('slow');
            jQuery('.login-alert-error').html(data.message);	
                  }else{
              jQuery(".login-status").hide();
              jQuery(".login-alert-error").fadeIn('slow');
              jQuery('.login-alert-error').html(data);
                            }
      },


      error:function(jqXHR, exception){

        if(jqXHR.status === 0){
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html('Please check your internet connection.');	
         
        }else if(jqXHR.status == 404){
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html('Request route not found.');
        }else if(jqXHR.status == 500){
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html('Internal Server Error [500]');
          
        }else if(jqXHR.status == 422){
          var errors = jqXHR.responseJSON;
    // $.each(json.responseJSON, function (key, value) {
    //     $('.'+key+'-error').html(value);
    // });
    jQuery(".login-status").hide();
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery('.login-alert-error').html(errors.data.errors);
    
        }else if(exception === 'parsererror'){
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html('Requested JSON parse failed');
          
        }else if(exception === 'timeout'){
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html('Time out error');
          
        }else if(exception === 'abort'){
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html('Ajax request aborted');
          
        }
          
      }
         

    });

  }

});

jQuery("#otp-form").on("submit", function(e){
e.preventDefault();
var action = jQuery(this).attr("action");
var urlPath = jQuery("#site_url").val();
var user_id = jQuery("#user_id").val();
var otp_code = jQuery("#otp_code").val();
var type = jQuery('#type').val();
//var formdata = new FormData(this);

if(jQuery.trim(jQuery("#otp_code").val()) == ""){
  jQuery("#otp_code").css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html(" Enter the OTP code sent to your mail");
}else{
  jQuery.ajax({
    headers: {
'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
 },
   type: "POST",
   dataType: "json",
   url: action,
   data: {"user_id": user_id, "otp_code": otp_code, 'type': type},
   beforeSend:function(){
       jQuery(".login-status").show();
       jQuery('.login-alert-error').hide();
       jQuery(".login-status").html("<div class='load'>Loading...</div>");
   },
   complete:function(){
       jQuery(".load").hide();
   },
   
   success:function(data){
      if(data.status == true){
       jQuery("#sendEmail").prop('disabled', true);
       jQuery(".login-status").show();
       jQuery(".login-status").html(data.message);
       if(data.data.values.user_type == "Customer" ){//check if session user_type is customer
        window.location = site_url+"/auth/customer/dashboard";//redirect to customer dashboard
        }else if(data.data.values.user_type == "Business" && data.data.values.is_business_verified == 0){//check if session user_type is business and is not verified
          window.location = site_url+"/auth/business/business_verification_form";//redirect to business verification page
        }else if(data.data.values.user_type == "Business" && data.data.values.is_business_verified == 1){//check if session user_type is business and is verified
          window.location = site_url+"/auth/business/dashboard";//redirect to business dashboard page
        }else if(data.data.values.user_type == "Admin"){//check if session user_type is admin
          window.location = site_url+"/auth/admin/dashboard";//redirect to admin page
        }else{
          window.reload();
        }
      }else if(data.status == false){
        jQuery(".login-status").hide();
        jQuery(".login-alert-error").show();
        jQuery(".login-alert-error").html(data.message);
      }else{
        jQuery(".login-status").hide();
        jQuery(".login-alert-error").show();
        jQuery(".login-alert-error").html(data);
      }
        
   },

   error:function(jqXHR, exception){

    if(jqXHR.status === 0){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Please check your internet connection.');	
     
    }else if(jqXHR.status == 404){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Request route not found.');
    }else if(jqXHR.status == 500){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Internal Server Error [500]');
      
    }else if(jqXHR.status == 400){
      var errors = jqXHR.responseJSON;
jQuery(".login-status").hide();
jQuery(".login-alert-error").fadeIn('slow');
jQuery('.login-alert-error').html(errors.data.errors);
    }else if(jqXHR.status == 422){
      var errors = jqXHR.responseJSON;
// $.each(json.responseJSON, function (key, value) {
//     $('.'+key+'-error').html(value);
// });
jQuery(".login-status").hide();
jQuery(".login-alert-error").fadeIn('slow');
jQuery('.login-alert-error').html(errors.data.errors);

    }else if(exception === 'parsererror'){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Requested JSON parse failed');
      
    }else if(exception === 'timeout'){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Time out error');
      
    }else if(exception === 'abort'){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Ajax request aborted');
      
    }
      
  }

   });

  }

});


jQuery("#recover-form").on("submit", function(e){
e.preventDefault();

var action = jQuery(this).attr("action");
  
var email = jQuery("#email").val();
  
if(jQuery.trim(jQuery("#email").val()) == ""){
  jQuery("#email").css('border', 'solid 1px #c03826');
    jQuery(".login-alert-error").fadeIn('slow');
    jQuery(".login-alert-error").html("Enter your email address");
}else{
    jQuery.ajax({
    headers: {
    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
     },
    type: "POST",
    dataType: "json",
    url: action,
    data: {"email": email},
    beforeSend:function(){
      jQuery(".login-status").show();
      jQuery('.login-alert-error').hide();
      jQuery(".login-status").html("<div class='load'>Loading...</div>");
    },
    complete:function(){
      jQuery(".load").hide();
    },
   
    success:function(data){
      if(data.status == true){
        //jQuery('#register-btn').prop('disabled', true);
        //jQuery(".register-error").hide();
        //jQuery(".register-success").fadeIn('slow');
        jQuery('.login-status').show();
        jQuery('.login-status').html(data.message);
        
        jQuery("#recover-form").hide();
        jQuery('#otp-form').show();
        jQuery('#otp-form').html("\r\n<h3>Confirm OTP Code<\/h3><input type=\'hidden\' id=\'site_url\' name=\'site_url\' value=\'"+site_url+"\'><input type=\'hidden\' id=\'type\' name=\'type\' value=\'forgot_password\'><input type=\'hidden\' id=\'user_id\' name=\'user_id\' value=\'"+data.data.user.id+"\'><div><span class=\'wpcf7-form-control-wrap otp-code\'><input type=\'text\' id=\'otp_code\' class=\'wpcf7-form-control wpcf7-text wpcf7-validates-as-required\' placeholder=\'OTP Code\' name=\'otp_code\'><\/span><\/div> <div class=\'row\'><div class=\'col-lg-8\'> <div class=\'login-horizental\'><button class=\'button alt btn req-btn\' type=\'submit\'>Verify<\/button><\/div><\/div><\/div>\r\n");
          
      }else if(data.status == false){
        jQuery(".login-status").hide();
        jQuery(".login-alert-error").fadeIn('slow');
        jQuery('.login-alert-error').html(data.message);	
              }else{
          jQuery(".login-status").hide();
          jQuery(".login-alert-error").fadeIn('slow');
          jQuery('.login-alert-error').html(data);
                        }
  },


  error:function(jqXHR, exception){

    if(jqXHR.status === 0){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Please check your internet connection.');	
     
    }else if(jqXHR.status == 404){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Request route not found.');
    }else if(jqXHR.status == 500){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Internal Server Error [500]');
      
    }else if(jqXHR.status == 422){
      var errors = jqXHR.responseJSON;
// $.each(json.responseJSON, function (key, value) {
//     $('.'+key+'-error').html(value);
// });
jQuery(".login-status").hide();
jQuery(".login-alert-error").fadeIn('slow');
jQuery('.login-alert-error').html(errors.data.errors);

    }else if(exception === 'parsererror'){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Requested JSON parse failed');
      
    }else if(exception === 'timeout'){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Time out error');
      
    }else if(exception === 'abort'){
      jQuery(".login-status").hide();
      jQuery(".login-alert-error").fadeIn('slow');
      jQuery('.login-alert-error').html('Ajax request aborted');
      
    }
      
  }
  });

}


});


  

  });



  

  