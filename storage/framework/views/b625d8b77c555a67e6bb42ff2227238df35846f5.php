<!DOCTYPE HTML>
<html lang="<?php echo e(config('app.locale')); ?>">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<title><?php echo e(config('app.name', 'PIGNUS')); ?></title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>" media="all" />
		<!-- Slick nav CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/slicknav.min.css')); ?>" media="all" />
		<!-- Iconfont CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/icofont.css')); ?>" media="all" />
		<!-- Slick CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/slick.css')); ?>">

		<link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
		<!-- Owl carousel CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/owl.carousel.css')); ?>">
		<!-- Popup CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/magnific-popup.css')); ?>">
		<!-- Switcher CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/switcher-style.css')); ?>">
		<!-- Animate CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/animate.min.css')); ?>">
		<!-- Main style CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>" media="all" />
		<!-- Responsive CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/responsive.css')); ?>" media="all" />
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="<?php echo e(asset('img/icon/favicon.ico')); ?>" />
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<link rel="stylesheet" href="<?php echo e(asset('modal/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('modal/css/modals.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('modal/css/normalize.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('modal/css/form/all-type-forms.css')); ?>">

        
		<script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
		<script src="<?php echo e(asset('modal/js/vendor/modernizr-2.8.3.min.js')); ?>"></script>
		<script type="text/javascript">
		jQuery(document).ready(function() {
    
	/************ Login ajax script **************/
	jQuery('.login').submit(function(e){
		e.preventDefault();
		var action = jQuery('.login').attr("action");
		var u = jQuery("#username").val();
		var p = jQuery("#password").val();
		var status = jQuery("#login-status");
        
		var eve = "login";
		if( jQuery.trim(jQuery('#username').val())=="" || jQuery.trim(jQuery('#password').val())=="" ){
			status.html("<img src='"+action+"public/images/icons/alert.png' /> Please enter your login details!");
		}else{
			
			status.html("<img src='"+action+"public/images/loaders/loading.gif' /> &nbsp; Processing please wait...");
			jQuery.ajax({
			    type: "POST",
				dataType: "html",
				url: action+"login/loginUser",
				data: {"action": eve, "u": u, "p": p},
				beforeSend:function(){
				   status.html("<img src='"+action+"public/images/loaders/loading.gif' /> &nbsp; Loging in...");
				},
				complete:function(){
				    
				},
				error:function(){
					status.html("<img src='"+action+"public/images/icons/ic_connections.png' /> Please check your internet connection");
					
				},
				success:function(data){
				      if(data == "empty_fields"){
						status.html("<img src='"+action+"public/images/icons/alert.png' /> Please enter your login details!");
						
						
					}else if(data == "invalid_login"){
						status.html("<img src='"+action+"public/images/icons/alert.png' /> Invalid login combination!");
						
							  }else if(data == "disabled"){
							  status.html("<img src='"+action+"public/images/icons/alert.png' /> Your account has been temporarily disabled by the admin.");
							  status.append("<br />Contact our admin for help.");
							  	 }else if(data == "login_successful"){
									  window.location = action+"login";
									  }
				    
					
					
				}
			  });
			}
		
		
		
		});
		
	

jQuery('#model-login-form').submit(function(e){
		e.preventDefault();
		var action = jQuery('#model-login-form').attr("action");
		var u = jQuery("#username").val();
		var p = jQuery("#password").val();
		var status = jQuery("#login-status");
        
		var eve = "login";
		if( jQuery.trim(jQuery('#username').val())=="" || jQuery.trim(jQuery('#password').val())=="" ){
			status.html("<img src='"+action+"public/images/icons/alert.png' /> Please enter your login details!");
		}else{
			
			status.html("<img src='"+action+"public/images/loaders/loading.gif' /> &nbsp; Processing please wait...");
			jQuery.ajax({
			    type: "POST",
				dataType: "html",
				url: action+"login/loginUser",
				data: {"action": eve, "u": u, "p": p},
				beforeSend:function(){
				   status.html("<img src='"+action+"public/images/loaders/loading.gif' /> &nbsp; Loging in...");
				},
				complete:function(){
				    
				},
				error:function(){
					status.html("<img src='"+action+"public/images/icons/ic_connections.png' /> Please check your internet connection");
					
				},
				success:function(data){
				      if(data == "empty_fields"){
						status.html("<img src='"+action+"public/images/icons/alert.png' /> Please enter your login details!");
						
						
					}else if(data == "invalid_login"){
						status.html("<img src='"+action+"public/images/icons/alert.png' /> Invalid login combination!");
						
							  }else if(data == "disabled"){
							  status.html("<img src='"+action+"public/images/icons/alert.png' /> Your account has been temporarily disabled by the admin.");
							  status.append("<br />Contact our admin for help.");
							  	 }else if(data == "login_successful"){
									  location.reload();
									  }
				    
					
					
				}
			  });
			}
		
		
		
		});


jQuery('.comment-form').submit(function(e){
		e.preventDefault();
		var action = jQuery('.comment-form').attr("action");
		var fname = jQuery("#fname").val();
		var lname = jQuery("#lname").val();
		var email = jQuery("#email").val();
		var uname = jQuery("#uname").val();
		var country= jQuery("#country").val();
		var mem = jQuery("#mem-type").val();
		var address = jQuery("#address").val();
		var pass = jQuery("#pass").val();
		var cpass = jQuery("#cpass").val();
		
		var status = jQuery("#signup-status");
        
		var eve = "signup";
		if( jQuery.trim(jQuery('#fname').val())==""){
			
			jQuery("#required_fname").html("*Required");
			
			status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
		}else if( jQuery.trim(jQuery('#lname').val())=="" ){
			
			jQuery("#required_fname").html("");
			jQuery("#required_lname").html("*Required");
			status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
			}else if( jQuery.trim(jQuery('#email').val())==""){
			jQuery("#required_fname").html("");
			jQuery("#required_lname").html("");
			
			jQuery("#required_email").html("*Required");
			status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
			}else if(jQuery.trim(jQuery('#uname').val())==""){
				jQuery("#required_fname").html("");
			    jQuery("#required_lname").html("");
			    jQuery("#required_email").html("");
				jQuery("#required_uname").html("*Required");
				status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
				}else if(jQuery.trim(jQuery('#country').val())==""){
					jQuery("#required_fname").html("");
			        jQuery("#required_lname").html("");
			        jQuery("#required_email").html("");
				    jQuery("#required_uname").html("");
					jQuery("#required_country").html("*Required");
					status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
					}else if(jQuery.trim(jQuery('#mem-type').val())==""){
						jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("");
				        jQuery("#required_uname").html("");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("*Required");
					status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
					}else if(jQuery.trim(jQuery('#pass').val())==""){
					    jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("");
				        jQuery("#required_uname").html("");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("");
					    jQuery("#required_pass").html("*Required");
					status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
					}else if(jQuery.trim(jQuery('#cpass').val())==""){
						jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("");
				        jQuery("#required_uname").html("");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("");
					    jQuery("#required_pass").html("");
						jQuery("#required_cpass").html("*Required");
					status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");	
					}else if(jQuery.trim(jQuery('#cpass').val()).length < 5 || jQuery.trim(jQuery('#cpass').val()).length > 40){
						jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("");
				        jQuery("#required_uname").html("");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("");
					    jQuery("#required_pass").html("");
						jQuery("#required_cpass").html("*Password required 6 to 40 characters");
						}else if( jQuery.trim(jQuery('#cpass').val()) != jQuery.trim(jQuery('#pass').val())){
						status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
						jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("");
				        jQuery("#required_uname").html("");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("");
					    jQuery("#required_pass").html("");
						jQuery("#required_cpass").html("*Password not matched");
						status.html("<img src='"+action+"public/images/icons/alert.png' /> Fields with * are required!");
						}else{
							
						jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("");
				        jQuery("#required_uname").html("");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("");
					    jQuery("#required_pass").html("");
						jQuery("#required_cpass").html("");
			
			status.html("<img src='"+action+"public/images/loaders/loading.gif' /> &nbsp; Processing please wait...");
			jQuery.ajax({
			    type: "POST",
				dataType: "html",
				url: action+"login/signupUser",
				data: {"action": eve, "fname": fname, "lname": lname, "email": email, "uname": uname, "country": country, "mem": mem, "address": address, "pass": pass},
				beforeSend:function(){
				   status.html("<img src='"+action+"public/images/loaders/loading.gif' /> &nbsp; Checking info...");
				},
				complete:function(){
				    
				},
				error:function(){
					status.html("<img src='"+action+"public/images/icons/ic_connections.png' /> Please check your internet connection");
					
				},
				success:function(data){
					if(data == "invalid_email"){
						jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("*Invalid email format");
				        jQuery("#required_uname").html("");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("");
					    jQuery("#required_pass").html("");
						jQuery("#required_cpass").html("");
					}else if(data == "email_used"){
						jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("*Email already used");
				        jQuery("#required_uname").html("");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("");
					    jQuery("#required_pass").html("");
						jQuery("#required_cpass").html("");
						
						
					}else if(data == "user_exist"){
						jQuery("#required_fname").html("");
			            jQuery("#required_lname").html("");
			            jQuery("#required_email").html("");
				        jQuery("#required_uname").html("*Username already exists");
					    jQuery("#required_country").html("");
						jQuery("#required_mem").html("");
					    jQuery("#required_pass").html("");
						jQuery("#required_cpass").html("");
						
							  }else if(data == "signup_success"){
							  window.location = action+"login";
							  	 }else{
									  status.html(data);
									  }
				    
					
					
				}
			  });
			}
		
		
		
		});

				
jQuery('#uname').on("blur", function(e){
	var elem = jQuery(this).val();
	var action = jQuery('#commentform').attr("action");
	var status = jQuery("#signup-status");
	var eve = "loadUsername";
	jQuery.ajax({
			    type: "POST",
				dataType: "html",
				url: action+"login/checkUsername",
				data: {"action": eve, "uname": elem},
				beforeSend:function(){
				   status.html("<img src='"+action+"public/images/loaders/loading.gif' /> &nbsp; Checking info...");
				},
				complete:function(){
				    
				},
				error:function(){
					status.html("<img src='"+action+"public/images/icons/ic_connections.png' /> Please check your internet connection");
					
				},
				success:function(data){
				      jQuery("#required_uname").html(data);
					  status.html("");
					
				}
			  });
	});


	jQuery("#model-request-form").submit(function(e){
			e.preventDefault();
			var action = jQuery(this).attr("action");
			var name = jQuery("#name").val();
		    var email = jQuery("#email").val();
		    var phone = jQuery("#phone").val();
		    var services = jQuery("#services").val();
			var subService = jQuery("#sub-services").val();
			var note = jQuery("#note").val();
			
			if(jQuery.trim(jQuery("#name").val()) == "" ){
			jQuery(".require-name").css('color', 'red');	
            jQuery(".require-name").html(" Enter your name");

			}else if(jQuery.trim(jQuery("#email").val()) == ""){
			jQuery(".require-email").css('color', 'red');	
			jQuery(".require-email").html("Enter your email address");
				
			}else if(jQuery.trim(jQuery("#phone").val()) == ""){
			jQuery(".require-phone").css('color', 'red');	
			jQuery(".require-phone").html(" Enter your phone number");

			}else if(!Number(jQuery("#phone").val())){
			jQuery(".require-phone").css('color', 'red');	
			jQuery(".require-phone").html(" Phone number requires numeric input only!");

			}else if(jQuery.trim(jQuery("#services").val()) == "" ){
				jQuery(".require-phone").css('color', 'red');
				jQuery(".require-phone").html(" Select a Service");
				
			}else{
			
				jQuery.ajax({
				headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                 },
			    type: "POST",
				dataType: "json",
				url: action,
				data: {"name": name, "email": email, "phone": phone, "service": services, "subService": subService, "note": note},
				beforeSend:function(){
					jQuery('#request-status').html(" Sending data...");
				},
				complete:function(){
				    
				},
				error:function(){
					jQuery('#request-status').html("Please check your internet connection");
					
				},
				success:function(data){
					if(data.success == true){
					jQuery('#request-status').css('color', 'green');
					jQuery('#request-status').html(data.message);	
					}else if(data.success == false){
						jQuery('#request-status').css('color', 'red');
						jQuery('#request-status').html(data.message);	
		
					}else{
						jQuery('#request-status').css('color', 'red');
						jQuery('#request-status').html(data);
									  }
				}
			  });

			}

	});
	
	
	    /********************************************
		jQuery("#services").readystatechange(function(e){
          var service = jQuery(this).val();
		  jQuery.ajax({
				headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                 },
			    type: "POST",
				dataType: "json",
				url: <?php echo e(action('App\Http\Controllers\PagesController@loadSubService')); ?>,
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
					jQuery('#sub-services').append("<option value='"+data.data+"'>"+data.data+"</option>");	
					}else if(data.success == false){
						jQuery('#request-status').html(data.message);	
		
					}else{
						jQuery('#request-status').html(data);
									  }	
				}  
		     });
		});
**************************************************/
	
});
		</script>

	</head>
	<body data-spy="scroll" data-target=".header" data-offset="50">
		<?php echo $__env->yieldContent('content'); ?>
	</body>
</html><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/layouts/app1.blade.php ENDPATH**/ ?>