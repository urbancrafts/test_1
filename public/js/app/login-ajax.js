jQuery(document).ready(function(){

    jQuery("#login-form").live("submit", function(e){
        e.preventDefault();
  
        var action = jQuery(this).attr("action");
        var loginId = jQuery("#login-email").val();
        var pass = jQuery("#login-pass").val();
        
        var urlPath = jQuery("#login-url-path").val();
        
        if(jQuery.trim(jQuery("#login-email").val()) == "" || jQuery.trim(jQuery("#login-pass").val()) == ""){
            jQuery("#login-alert").css('display', 'block');
            jQuery("#login-alert").html(" Enter your login details");

        }else{
        
            jQuery.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            type: "POST",
            dataType: "json",
            url: action,
            data: {"loginId": loginId, "pass": pass},
            beforeSend:function(){
                jQuery('.login-status').html(" Attempting to login");
            },
            complete:function(){
                
            },
            error:function(){
                jQuery("#login-alert").css('display', 'block');
                jQuery('#login-alert').html("Please check your internet connection");
                
            },
            success:function(data){
                if(data.success == true){
                    jQuery('.login-status').css('color', 'green');
                    jQuery('.login-status').html('Logged in successful.');
                window.location = urlPath;
                }else if(data.success == false){
                    jQuery("#login-alert").css('display', 'block');
                    jQuery('#login-alert').html(data.message);	
                        }else{
                    jQuery("#login-alert").css('display', 'block');
                    jQuery('#login-alert').html(data);
                                  }
            }
          });

        }

});



jQuery("#register-form").live("submit", function(e){
  e.preventDefault();
  var action = jQuery(this).attr("action");
  var name = jQuery("#name").val();
  var phone = jQuery("#phone").val();
  var email = jQuery("#email").val();
  var age = jQuery("#age").val();
  var pass = jQuery("#passwd").val();
  var cpass = jQuery("#cpasswd").val();
  
  var urlPath = jQuery("#register-url-path").val();
  
  if(jQuery.trim(jQuery("#name").val()) == ""){
      jQuery("#register-alert").css('display', 'block');
      jQuery("#register-alert").html(" Name field is required!");
  }else if(jQuery.trim(jQuery("#phone").val()) == ""){
    jQuery("#register-alert").css('display', 'block');
    jQuery("#register-alert").html(" Phone number is required!");
  }else if(!Number(jQuery("#phone").val())){
    jQuery("#register-alert").css('display', 'block');
    jQuery("#register-alert").html(" phone field accepts numeric data only!");
  }else if(jQuery.trim(jQuery("#email").val()) == ""){
    jQuery("#register-alert").css('display', 'block');
    jQuery("#register-alert").html(" Email field is required!");
  }else if(jQuery.trim(jQuery("#age").val()) == ""){
    jQuery("#register-alert").css('display', 'block');
    jQuery("#register-alert").html(" Enter your age!");
  }else if(jQuery.trim(jQuery("#passwd").val()) == ""){
    jQuery("#register-alert").css('display', 'block');
    jQuery("#register-alert").html(" Enter your password!");
  }else if(jQuery.trim(jQuery("#cpasswd").val()) != jQuery.trim(jQuery("#passwd").val())){
    jQuery("#register-alert").css('display', 'block');
    jQuery("#register-alert").html(" Confirmed password does not match with password entry");
  }else{
  
      jQuery.ajax({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
      type: "POST",
      dataType: "json",
      url: action,
      data: {"loginId": loginId, "pass": pass},
      beforeSend:function(){
          jQuery('.register-status').html(" Processing data...");
      },
      complete:function(){
          
      },
      error:function(){
          jQuery("#register-alert").css('display', 'block');
          jQuery('#register-alert').html("Please check your internet connection");
          
      },
      success:function(data){
          if(data.success == true){
              jQuery('.register-status').css('color', 'green');
              jQuery('.register-status').html(name+' registered successful.');
          window.location = urlPath+"/profile/"+data.uid;
          }else if(data.success == false){
              jQuery("#register-alert").css('display', 'block');
              jQuery('#register-alert').html(data.message);	
                  }else{
              jQuery("#register-alert").css('display', 'block');
              jQuery('#register-alert').html(data);
                            }
      }
    });

  }

});



jQuery("#services").change(function(e){
    var service = jQuery(this).val();
    var path = "";
    jQuery.ajax({
          headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
           },
          type: "POST",
          dataType: "json",
          url: path,
          data: {"service": service},
          beforeSend:function(){
             jQuery('#request-status').html("Loading data...");
          },
          complete:function(){
              
          },
          error:function(){
              jQuery('#request-status').html("Please check your internet connection");
              
          },
          success:function(data){
              if(data.success == true){
              jQuery('#sub-services').html(data.data);	
              }else if(data.success == false){
                  jQuery('#request-status').html(data.message);	
  
              }else{
                  jQuery('#request-status').html(data);
                                }	
          }  
       });
  });





});


jQuery(document).ready(function(){
    var elem = jQuery('.home-parallax-2 div');
    if (elem.length) {
      jQuery('body').append('    <div class=\"rd-parallax rd-parallax-1\">\r\n                                                              <div class=\"rd-parallax-layer top-z-index\" data-offset=\"0\" data-speed=\"0.1\" data-type=\"media\" data-fade=\"false\" data-direction=\"normal\"><div class=\"text-layout text-left\"><h3>The world\'s sexiest selection!<\/h3>\r\n<h2>Turn your fantasies into reality<\/h2>\r\n<p class=\"btn-wrap\"><a class=\"btn btn-default btn-md\" href=\"index.php?id_category=93&amp;controller=category\">Shop now<\/a><\/p><\/div><\/div>\r\n                                                            <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0.3\" data-type=\"media\" data-fade=\"false\" data-url=\"/prestashop_62339_v1/img/cms/home-parallax-2.jpg\" data-direction=\"normal\"><\/div>\r\n                        <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0\" data-type=\"html\" data-fade=\"false\" data-direction=\"normal\"><div class=\"parallax-main-layout\"><\/div><\/div>\r\n    <\/div>\r\n  ');
      var wrapper = jQuery('.rd-parallax-1');
      elem.before(wrapper);
      jQuery('.rd-parallax-1 .parallax-main-layout').replaceWith(elem);
      win = jQuery(window);
              }
  });

  jQuery(document).ready(function(){
    var elem = jQuery('.home-parallax-1 div');
    if (elem.length) {
      jQuery('body').append('    <div class=\"rd-parallax rd-parallax-2\">\r\n                                                              <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0.3\" data-type=\"media\" data-fade=\"false\" data-url=\"/prestashop_62339_v1/img/cms/parallax-home-1.jpg\" data-direction=\"normal\"><\/div>\r\n                                                            <div class=\"rd-parallax-layer top-z-index\" data-offset=\"0\" data-speed=\"0.1\" data-type=\"media\" data-fade=\"false\" data-direction=\"normal\"><div class=\"text-layout center\"><h3>A Variety of glamorous lingerie<\/h3>\r\n<h2>Choose from an exclusive collection of intimate apparel<\/h2>\r\n<p class=\"btn-wrap\"><a class=\"btn btn-secondary-3 btn-md\" href=\"index.php?id_category=91&amp;controller=category\">Shop now<\/a><\/p><\/div><\/div>\r\n                        <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0\" data-type=\"html\" data-fade=\"false\" data-direction=\"normal\"><div class=\"parallax-main-layout\"><\/div><\/div>\r\n    <\/div>\r\n  ');
      var wrapper = jQuery('.rd-parallax-2');
      elem.before(wrapper);
      jQuery('.rd-parallax-2 .parallax-main-layout').replaceWith(elem);
      win = jQuery(window);
              }
  });

  jQuery(document).ready( function(){
    jQuery(window).on('load', function(){
      jQuery.RDParallax();
      jQuery('.rd-parallax-layer video').each(function(){
        jQuery(this)[0].play();
      });
    });
  });