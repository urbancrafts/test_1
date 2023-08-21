<!doctype html>
<html lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title><?php echo e($settings[0]->site_name); ?></title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A400%2C600%2C700%7CNanum%20Myeongjo%3A400%2C800%7CRoboto%3A400%2C700%7CNanum%20Myeongjo%3A800&amp;subset=latin%2Clatin-ext&amp;display=swap" />
<meta property="og:image" content=" ">
<meta property="og:description" content=" ">



<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}

.hotel-booking-search{
  border-radius: 20px;
}

fieldset.reservation-avail-field{
  border: inset 1px rgb(20, 2, 68) !important;
  background:rgb(127, 188, 250);
  border-radius: 20px;
}

fieldset.reservation-avail-field legend{
  background:  rgb(20, 2, 68);
  color: #fff;
  width: auto;
  padding: 3px;
  padding-left: 5px;
  padding-right: 5px;
  font-size: 20px;
  font-style: oblique;
  border-radius: 20px;
}


legend.account-type-header{
  background:steelblue;
  color: #fff;
  width: auto;
  padding: 3px;
  
  font-size: 16px;
  font-style: oblique;
}

div.terms-element{
  display:none;
  height: 100px;
  max-height: 200px;
  overflow-y: auto;
  background: #fff;
}
.alert{
  height:auto !important;
}

a.menu-mobile-nav-button .foxuries-icon-bars{
  
  font-weight: bold !important;
  font-size: 20px !important;
  color: #4c90c7;
  
}
a.menu-mobile-nav-button{
  font-weight: bold !important;
  
  font-size: 20px;
  color: #4c90c7;
}
a.menu-mobile-nav-button:hover{
  text-decoration:unset;
}
a.menu-mobile-nav-button{
  border: solid 3px #4c90c7;
  padding: 5px;
  border-radius: 10px;
}
</style>

<style>

  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 10000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  
  /* Modal Content/Box */
  
  
  /* The Close Button */
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  
  /* Modal Header */
  .modal-header2 {
    padding: 2px 16px;
    background-color: #4c90c7;
    color: white;
  }
  
  /* Modal Body */
  .modal-body2 {padding: 2px 16px;}
  
  /* Modal Footer */
  .modal-footer2 {
    padding: 2px 16px;
    background-color: #4c90c7;
    color: white;
  }
  
  /* Modal Content */
  .modal-content2 {
    z-index: 10000;
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    animation-name: animatetop;
    animation-duration: 0.4s
  }
  
  /* Add Animation */
  @keyframes  animatetop {
    from {top: -300px; opacity: 0}
    to {top: 0; opacity: 1}
  }
  
  </style>

<link rel="stylesheet" href="<?php echo e(asset('bootstrap/dist/css/bootstrap.min.css')); ?>">
<link rel='stylesheet' id='wp-block-library-css' href='<?php echo e(asset('includes/css/dist/block-library/style.min91d5.css?ver=5.4')); ?>' type='text/css' media='all' />
<link rel='stylesheet' id='wp-block-library-theme-css' href='<?php echo e(asset('includes/css/dist/block-library/theme.min91d5.css?ver=5.4')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='foxuries-gutenberg-blocks-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/themes/foxuries/assets/css/base/gutenberg-blocks-645d8711bafe5d30873d53bd9a972412.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='contact-form-7-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/contact-form-7/includes/css/styles-8d51f093d63769d88aff41e47af89f33.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='rs-plugin-settings-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/revslider/public/assets/css/rs6-ed0f6bde70671e5670253136ea38eac8.css')); ?>' type='text/css' media='all' />
<link rel="stylesheet" href="<?php echo e(asset('font-awesome/css/font-awesome.min.css')); ?>">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo e(asset('Ionicons/css/ionicons.min.css')); ?>">
<style id='rs-plugin-settings-inline-css' type='text/css'>
#rs-demo-id {}
</style>
<link data-minify="1" rel='stylesheet' id='wphb-extra-css-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/wp-hotel-booking/includes/plugins/wp-hotel-booking-extra/assets/css/site-a8dd80736fa014265999ba88fbceda2e.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='wp-hotel-booking-libaries-style-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/wp-hotel-booking/assets/css/libraries-fa7cd54863a6ba5c6f3690cd948199c7.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='magnific-popup-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/wp-hotel-booking-booking-room/inc/libraries/magnific-popup/magnific-popup-6cc85405e947dbef65db998a1d8c5116.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='foxuries-style-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/themes/foxuries/style-0c6710214ef44ed640423e16e62f582a.css')); ?>' type='text/css' media='all' />
<link rel='stylesheet' id='elementor-frontend-css' href='<?php echo e(asset('content/plugins/elementor/assets/css/frontend.min339e.css?ver=2.9.9')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='elementor-post-296-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/uploads/elementor/css/post-296-ba1b58223507053f243dead7abd544ae.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='elementor-icons-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min-08b2c584d2119f6ff9089be6c417bdf3.css')); ?>' type='text/css' media='all' />
<link rel='stylesheet' id='elementor-animations-css' href='<?php echo e(asset('content/plugins/elementor/assets/lib/animations/animations.min339e.css?ver=2.9.9')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='elementor-global-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/uploads/elementor/css/global-5de351040f3ee353d4702c0689e7dd38.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='elementor-post-73-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/uploads/elementor/css/post-73-ba29c981c1d6d539a0a585c598a21104.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='foxuries-elementor-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/themes/foxuries/assets/css/base/elementor-62e2cf67e7e500286ce39b485811ce2c.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='foxuries-child-style-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/themes/demo-child/style-318b9c895908060d187d69487a970de5.css')); ?>' type='text/css' media='all' />
<link rel='stylesheet' id='elementor-icons-shared-0-css' href='<?php echo e(asset('content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.minb683.css?ver=5.12.0')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='elementor-icons-fa-brands-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min-d0b0ebdbb31f2aeff05fe97f2c192848.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='elementor-icons-fa-solid-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min-9759b6d2cf304b16321ec730759d5051.css')); ?>' type='text/css' media='all' />
<link data-minify="1" rel='stylesheet' id='elementor-icons-fa-regular-css' href='<?php echo e(asset('content/cache/min/1/foxuries/wp-content/plugins/elementor/assets/lib/font-awesome/css/regular.min-042f3573138574cf4ee426ef0f455a6d.css')); ?>' type='text/css' media='all' />












<link data-minify="1" rel='stylesheet' id='elementor-post-569-css' href='<?php echo e(asset('wp-content/cache/min/1/foxuries/wp-content/uploads/elementor/css/post-569-7a6b7602fb2396b40b024c43352a7e8e.css')); ?>' type='text/css' media='all' />
<link rel="stylesheet" href="<?php echo e(asset('modal/modal/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('modal/modal/css/modals.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('modal/modal/css/normalize.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('modal/modal/css/form/all-type-forms.css')); ?>">

     
		
<script type="text/javascript">
  var hotel_settings = {
    ajax            : 'https://demo.inspithemes.com/foxuries/wp-admin/admin-ajax.php',
    settings        : {"review_rating_required":"1"},
    upload_base_url : 'https://demothemedh.b-cdn.net/foxuries/wp-content/uploads',
    meta_key        : {
      prefix: '_hb_'
    },
    nonce           : '1ce51b652b',
    timezone        : '1613423006',
    min_booking_date: 1			}
</script>
<script type="text/javascript">
  var hotel_settings = {
    ajax            : 'https://demo.inspithemes.com/foxuries/wp-admin/admin-ajax.php',
    settings        : {"review_rating_required":"1"},
    upload_base_url : 'https://demothemedh.b-cdn.net/foxuries/wp-content/uploads',
    meta_key        : {
      prefix: '_hb_'
    },
    nonce           : '1ce51b652b',
    timezone        : '1613423006',
    min_booking_date: 1			}
</script>


<script type='text/javascript' src='<?php echo e(asset('includes/js/jquery/jquery4a5f.js?ver=1.12.4-wp')); ?>'></script>

<script src="<?php echo e(asset('modal/modal/js/vendor/modernizr-2.8.3.min.js')); ?>"></script>

<script src="<?php echo e(asset('js/app/login-ajax_2.js')); ?>"></script>



<style type="text/css">
  p, body, td, input, select, button { font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 14px; }
  body { padding: 0px; margin: 0px; background-color: #ffffff; }
  
  .space { margin: 10px 0px 10px 0px; }
  
  .main { padding: 10px; margin-top: 10px; }
</style>

<!-- DayPilot library -->
<script src="<?php echo e(asset('dashboard_calendar/js/daypilot/daypilot-all.min.js')); ?>"></script>

<link type="text/css" rel="stylesheet" href="<?php echo e(asset('dashboard_calendar/icons/style.css')); ?>" />

<style type="text/css">
  select {
      padding: 5px;
  }

  .toolbar {
      margin: 10px 0px;
  }

  .toolbar button {
      padding: 5px 15px;
  }

  .icon {
      font-size: 14px;
      text-align: center;
      line-height: 14px;
      vertical-align: middle;

      cursor: pointer;
  }

  .toolbar-separator {
      width: 1px;
      height: 28px;
      /*content: '&nbsp;';*/
      display: inline-block;
      box-sizing: border-box;
      background-color: #ccc;
      margin-bottom: -8px;
      margin-left: 15px;
      margin-right: 15px;
  }

  .scheduler_default_rowheader_inner
  {
      border-right: 1px solid #ccc;
  }
  .scheduler_default_rowheadercol2
  {
      background: White;
  }
  .scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
  {
      top: 2px;
      bottom: 2px;
      left: 2px;
      background-color: transparent;
      border-left: 5px solid #38761d; /* green */
      border-right: 0px none;
  }
  .status_dirty.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
  {
      border-left: 5px solid #cc0000; /* red */
  }
  .status_cleanup.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
  {
      border-left: 5px solid #e69138; /* orange */
  }

  .area-menu {
      background-image: url("data:image/svg+xml,%3Csvg width='10' height='10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 0.5 1.5 L 5 6.5 L 9.5 1.5' style='fill:none;stroke:%23999999;stroke-width:2;stroke-linejoin:round;stroke-linecap:butt' /%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: center center;
      border: 1px solid #ccc;
      background-color: #fff;
      border-radius: 3px;
      opacity: 0.8;
      cursor: pointer;
  }

  .area-menu:hover {
      opacity: 1;
  }

</style>


<script type="text/javascript">
var modal = document.getElementById('modal-elemet');
var span = document.getElementsByClassName('close');

span.onclick = function(){
  modal.style.display = "none";
}

window.onclick = function(event){
  if(event.target == modal){
    modal.style.display = "none"; 
  }
}
</script>
<script type="text/javascript">

jQuery(document).ready(function(){
       
	   jQuery("#check-resort").change(function(e){
         var resort = jQuery(this).val();
		 if(jQuery.trim(jQuery(this).val()) == ""){
         alert('Please select a resort');
		 }else{
         jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
           type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@load_resort_rooms')); ?>",
         data: {"resort": resort},
         beforeSend:function(){
             jQuery(".check-resort-error").hide();
             jQuery(".check-resort-success").show();
             jQuery(".check-resort-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".check-resort-success").hide();
         },
         error:function(){
         jQuery(".check-resort-success").hide();
         jQuery(".check-resort-error").show();
         jQuery(".check-resort-error").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
             jQuery("#check-room").html(data.data);
            }else if(data.success == false){
              jQuery(".check-resort-success").hide();
              jQuery(".check-resort-error").show();
              jQuery(".check-resort-error").html(data.message);
              jQuery("#check-room").html(data.data);
            }else{
              jQuery(".check-resort-success").hide();
              jQuery(".check-resort-error").show();
              jQuery(".check-resort-error").html(data);
            }
              
         }
         });
		 }

	   });

	
    
	indexBlogLoader();

	function indexBlogLoader(){
          $action = "callRoomLoader";
         jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
           type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@load_index_blog')); ?>",
         data: {"action": $action},
         beforeSend:function(){
             jQuery("#blog-index-loader").html("<div class='load'><img src='<?php echo e(asset('loaders/bx_loader.gif')); ?>' /> Loading...</div>");
         },
         complete:function(){
             jQuery(".load").remove();
         },
         error:function(){
         jQuery("#blog-index-loader").html("<div class='errLoading'><img src='<?php echo e(asset('icons/ic_connections.png')); ?>' />Please check your internet connection</div>");
         },
         success:function(data){
            if(data.success == true){
				jQuery("#blog-index-loader").append(data.data);
            }else if(data.success == false){
				jQuery("#blog-index-loader").append(data.data);
            }else{
				jQuery("#blog-index-loader").append(data);
            }
              
         }
         });
         
       }



    cartCounter();
  function cartCounter(){
  var action = "loadCart";

    jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
          type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@count_cart_item')); ?>",
         data: {"actionEvent": action},
         beforeSend:function(){
          //jQuery('#load-shop').html("<div class='load'><img src='<?php echo e(asset('loaders/AjaxLoader.gif')); ?>' /></div>");
             //$(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             //jQuery(".load").hide();
         },
         error:function(){
      jQuery(".alert-warning").css('display', 'block');
			jQuery(".alert-danger").css('display', 'none');
			jQuery(".upload-error").html("<img src='<?php echo e(asset('icons/ic_connections.png')); ?>' /> Please check your internet connection or refresh your browser");
			//jQuery("#search-btn").prop('disabled', false);
			//jQuery('#search-btn').html("Search");
         },
         success:function(data){
            if(data.success == true){
             //jQuery("#load").html(data.data);

             	//jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				//jQuery(".alert-danger").css('display', 'none');
				//jQuery(".alert-success").css('display', 'block');
				//jQuery(".alert-warning").css('display', 'none');
        
        jQuery(".cart-counter").html(data.data.length);
        //jQuery(".upload-success").html(data.message);

            }else if(data.success == false){
              //jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				//jQuery(".alert-danger").css('display', 'block');
				//jQuery(".alert-success").css('display', 'none');
				//jQuery(".alert-warning").css('display', 'none');
				//jQuery(".upload-error").html(data.message);
            }else{
				//jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				//jQuery(".alert-danger").css('display', 'block');
				//jQuery(".alert-success").css('display', 'none');
				//jQuery(".alert-warning").css('display', 'none');
				//jQuery(".upload-error").html(data);
            }
              
         }
         });


}





jQuery('.bank-transfer').on('checked', function(){
jQuery('#service-paypal-payment-form').hide();
jQuery('#service-paystack-payment-form').hide();
jQuery('#service-bank-payment-form').show();
});

jQuery('.paypal').on('checked', function(){
jQuery('#service-paypal-payment-form').show();
jQuery('#service-paystack-payment-form').hide();
jQuery('#service-bank-payment-form').hide();
});

jQuery('.paystack').on('checked', function(){
jQuery('#service-paypal-payment-form').hide();
jQuery('#service-paystack-payment-form').show();
jQuery('#service-bank-payment-form').hide();
});

       
jQuery('#name').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-name-error').hide();
});

jQuery('#phone').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-phone-error').hide();
});

jQuery('#email').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-email-error').hide();
});

jQuery('#check_in_date_602ae1e0dd259').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-checkin-error').hide();
});

jQuery('#check_out_date_602ae1e0dd259').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-checkout-error').hide();
});

jQuery('#adults').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-adults-error').hide();
});

jQuery('#children').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-children-error').hide();
});

jQuery('#duration').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-duration-error').hide();
});

jQuery('#qnty').on('focus', function(e){
  jQuery(this).css('border', 'solid 1px gray');
  jQuery('.resort-qnty-error').hide();
});

jQuery('#adults').on('blur', function(e){
  if(!Number(jQuery(this).val())){
    jQuery(this).css('border', 'solid 1px red');
    jQuery(this).css('color', 'red');
    jQuery('.resort-adults-error').show();
    jQuery('.resort-adults-error').html("Can't accept a none numeric value");
  }else if(jQuery(this).val() < 1){
    jQuery(this).css('border', 'solid 1px red');
    jQuery(this).css('color', 'red');
    jQuery('.resort-adults-error').show();
    jQuery('.resort-adults-error').html("Can't accept less than 1 adult");
  }else if(jQuery(this).val() > 100){
    jQuery(this).css('border', 'solid 1px red');
    jQuery(this).css('color', 'red');
    jQuery('.resort-adults-error').show();
    jQuery('.resort-adults-error').html("Can't accept more than 100 adults");
  }else{
    jQuery(this).css('border', 'solid 1px gray');
    jQuery(this).css('color', '#000');
    jQuery('.resort-adults-error').hide();
  }
  
});

jQuery('#children').on('blur', function(e){
  if(jQuery.trim(jQuery(this).val()) != "" && !Number(jQuery(this).val())){
    jQuery(this).css('border', 'solid 1px red');
    jQuery(this).css('color', 'red');
    jQuery('.resort-children-error').show();
    jQuery('.resort-children-error').html("Can't accept a none numeric value");
  }else if(jQuery(this).val() > 100){
    jQuery(this).css('border', 'solid 1px red');
    jQuery(this).css('color', 'red');
    jQuery('.resort-children-error').show();
    jQuery('.resort-children-error').html("Can't accept more than 100 children");
  }else{
    jQuery(this).css('border', 'solid 1px gray');
    jQuery(this).css('color', '#000');
    jQuery('.resort-children-error').hide();
  }
  
});



jQuery("form#reservation-form").on("submit", function(e){
  e.preventDefault();
var action = jQuery(this).attr('action');
var formdata = new FormData(this);//create an instance for the form input fields

if(jQuery.trim(jQuery('#name').val()) == ""){
  jQuery('#name').css('border', 'solid 1px red');
  jQuery('.resort-name-error').show();

}else if(jQuery.trim(jQuery('#phone').val()) == ""){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.resort-phone-error').show();

}else if(!Number(jQuery('#phone').val())){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.resort-phone-error').show();
  jQuery('.resort-phone-error').html('(phone field requires numeric data only)');
}else if(jQuery.trim(jQuery('#email').val()) == ""){
  jQuery('#email').css('border', 'solid 1px red');
  jQuery('.resort-email-error').show();
  jQuery('.resort-email-error').html('(*Required)');

}else if(jQuery.trim(jQuery('#check_in_date_602ae1e0dd259').val()) == "" ){
  jQuery('#check_in_date_602ae1e0dd259').css('border', 'solid 1px red');
  jQuery('.resort-checkin-error').show();
  jQuery('.resort-checkin-error').html('(*Required)');

}else if(jQuery.trim(jQuery('#check_out_date_602ae1e0dd259').val()) == ""){
  jQuery('#check_out_date_602ae1e0dd259').css('border', 'solid 1px red');
  jQuery('.resort-checkout-error').show();
  jQuery('.resort-checkout-error').html('(*Required)');

}else if(jQuery.trim(jQuery("#adults").val()) =="" ){
  jQuery('#adults').css('border', 'solid 1px red');
  jQuery('.resort-adults-error').show();
  jQuery('.resort-adults-error').html('(*Enter Number Of Adults)');
}else if(!Number(jQuery("#adults").val())){
    jQuery("#adults").css('border', 'solid 1px red');
    jQuery("#adults").css('color', 'red');
    jQuery('.resort-adults-error').show();
    jQuery('.resort-adults-error').html("Can't accept a none numeric value");
  }else if(jQuery("#adults").val() < 1){
    jQuery("#adults").css('border', 'solid 1px red');
    jQuery("#adults").css('color', 'red');
    jQuery('.resort-adults-error').show();
    jQuery('.resort-adults-error').html("Can't accept less than 1 adult");
  }else if(jQuery("#adults").val() > 100){
    jQuery("#adults").css('border', 'solid 1px red');
    jQuery("#adults").css('color', 'red');
    jQuery('.resort-adults-error').show();
    jQuery('.resort-adults-error').html("Can't accept more than 100 adults");

}else if(jQuery.trim(jQuery('#children').val()) != "" && !Number(jQuery('#children').val())){
    jQuery('#children').css('border', 'solid 1px red');
    jQuery('#children').css('color', 'red');
    jQuery('.resort-children-error').show();
    jQuery('.resort-children-error').html("Can't accept a none numeric value");
  }else if(jQuery('#children').val() > 100){
    jQuery('#children').css('border', 'solid 1px red');
    jQuery('#children').css('color', 'red');
    jQuery('.resort-children-error').show();
    jQuery('.resort-children-error').html("Can't accept more than 100 children");
    }else{
     jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: action,
         data: formdata,
         cache: false,
         contentType: false,
         processData: false,
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".load").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              jQuery("#reserv-btn").prop('disabled', true);
              jQuery(".alert-danger").hide();
              jQuery(".alert-success").css('display', 'block !important');
              jQuery(".alert-success").html(data.message);
              //reservationPaymentModal(data.data.id, data.data.shelter_id, data.data.room_id, data.data.curr, data.data.price, data.data.name, data.data.type);
              window.location = "<?php echo e(url('payment/reservations')); ?>/"+data.data.id;
            }else if(data.success == false){
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data.data);
            }else{
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data);
            }
              
         }
         });

}

});





jQuery("form#service-booking-form").on("submit", function(e){
  e.preventDefault();
var action = jQuery(this).attr('action');
var formdata = new FormData(this);//create an instance for the form input fields

if(jQuery.trim(jQuery('#name').val()) == ""){
  jQuery('#name').css('border', 'solid 1px red');
  jQuery('.resort-name-error').show();

}else if(jQuery.trim(jQuery('#phone').val()) == ""){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.resort-phone-error').show();

}else if(!Number(jQuery('#phone').val())){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.resort-phone-error').show();
  jQuery('.resort-phone-error').html('(phone field requires numeric data only)');
}else if(jQuery.trim(jQuery('#email').val()) == ""){
  jQuery('#email').css('border', 'solid 1px red');
  jQuery('.resort-email-error').show();
  jQuery('.resort-email-error').html('(*Required)');

}else if(jQuery.trim(jQuery('#duration').val()) == "" ){
  jQuery('#duration').css('border', 'solid 1px red');
  jQuery('.resort-duration-error').show();
  jQuery('.resort-duration-error').html('(*Required)');

}else if(!Number(jQuery('#duration').val()) || jQuery('#duration').val() < 1){
  jQuery('#duration').css('border', 'solid 1px red');
  jQuery('.resort-duration-error').show();
  jQuery('.resort-duration-error').html('(*Cannot accept less than 1 nor none integer value.)');

}else if(jQuery.trim(jQuery('#check_in_date_602ae1e0dd259').val()) == "" ){
  jQuery('#check_in_date_602ae1e0dd259').css('border', 'solid 1px red');
  jQuery('.resort-checkin-error').show();
  jQuery('.resort-checkin-error').html('(*Required)');

}else{
     jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: action,
         data: formdata,
         cache: false,
         contentType: false,
         processData: false,
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".load").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              jQuery("#reserv-btn").prop('disabled', true);
              jQuery(".alert-danger").hide();
              jQuery(".alert-success").css('display', 'block !important');
              jQuery(".alert-success").html(data.message);
              //servicePaymentModal(data.data.id, data.data.service_id, data.data.curr, data.data.price, data.data.name, data.data.type, data.message);
              window.location = "<?php echo e(url('payment/service_booking')); ?>/"+data.data.id;
            }else if(data.success == false){
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data.data);
            }else{
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data);
            }
              
         }
         });

}

});



jQuery("form#news-letter-form").on("submit", function(e){
  e.preventDefault();
var action = jQuery(this).attr('action');
var formdata = new FormData(this);//create an instance for the form input fields

if(jQuery.trim(jQuery('#news-email').val()) == ""){
  jQuery('#news-email').css('border', 'solid 1px red');
  jQuery('.news-letter-error').show();
  jQuery('.news-letter-error').html('Enter your email address');
}else{
     jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: action,
         data: formdata,
         cache: false,
         contentType: false,
         processData: false,
         beforeSend:function(){
             jQuery(".news-letter-success").show();
             jQuery('.news-letter-error').hide();
             jQuery(".news-letter-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".load").hide();
         },
         error:function(){
         jQuery(".news-letter-success").hide();
         jQuery(".news-letter-error").show();
         jQuery(".news-letter-error").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              jQuery("#new-letter-btn").prop('disabled', true);
              jQuery(".news-letter-error").hide();
              jQuery(".news-letter-success").show();
              jQuery(".news-letter-success").html(data.message);
             
            }else if(data.success == false){
              jQuery(".news-letter-success").hide();
              jQuery(".news-letter-error").show();
              jQuery(".news-letter-error").html(data.data);
            }else{
              jQuery(".news-letter-success").hide();
              jQuery(".news-letter-error").show();
              jQuery(".news-letter-error").html(data);
            }
              
         }
         });

}

});


                   
                   
                   
                   setInterval(function(){
                   
                   },130000);
                   
                   setInterval(function(){
                   
                   },120000);

});
</script>

<style type="text/css">
.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
</style>

<meta name="<?php echo e($settings[0]->site_name); ?>" content="" />

<link rel="icon" href="<?php echo e(asset('storage/img/site_icon/'.$settings[0]->icon)); ?>" sizes="32x32" />
<link rel="icon" href="<?php echo e(asset('storage/img/site_icon/'.$settings[0]->icon)); ?>" sizes="192x192" />

<link rel="apple-touch-icon" href="<?php echo e(asset('storage/img/site_icon/'.$settings[0]->icon)); ?>" />

<meta name="msapplication-TileImage" content="<?php echo e(asset('storage/img/site_icon/'.$settings[0]->icon)); ?>" />

<script type="text/javascript">
function setREVStartSize(e){			
			try {								
				var pw = document.getElementById(e.c).parentNode.offsetWidth,
					newh;
				pw = pw===0 || isNaN(pw) ? window.innerWidth : pw;
				e.tabw = e.tabw===undefined ? 0 : parseInt(e.tabw);
				e.thumbw = e.thumbw===undefined ? 0 : parseInt(e.thumbw);
				e.tabh = e.tabh===undefined ? 0 : parseInt(e.tabh);
				e.thumbh = e.thumbh===undefined ? 0 : parseInt(e.thumbh);
				e.tabhide = e.tabhide===undefined ? 0 : parseInt(e.tabhide);
				e.thumbhide = e.thumbhide===undefined ? 0 : parseInt(e.thumbhide);
				e.mh = e.mh===undefined || e.mh=="" || e.mh==="auto" ? 0 : parseInt(e.mh,0);		
				if(e.layout==="fullscreen" || e.l==="fullscreen") 						
					newh = Math.max(e.mh,window.innerHeight);				
				else{					
					e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
					for (var i in e.rl) if (e.gw[i]===undefined || e.gw[i]===0) e.gw[i] = e.gw[i-1];					
					e.gh = e.el===undefined || e.el==="" || (Array.isArray(e.el) && e.el.length==0)? e.gh : e.el;
					e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
					for (var i in e.rl) if (e.gh[i]===undefined || e.gh[i]===0) e.gh[i] = e.gh[i-1];
										
					var nl = new Array(e.rl.length),
						ix = 0,						
						sl;					
					e.tabw = e.tabhide>=pw ? 0 : e.tabw;
					e.thumbw = e.thumbhide>=pw ? 0 : e.thumbw;
					e.tabh = e.tabhide>=pw ? 0 : e.tabh;
					e.thumbh = e.thumbhide>=pw ? 0 : e.thumbh;					
					for (var i in e.rl) nl[i] = e.rl[i]<window.innerWidth ? 0 : e.rl[i];
					sl = nl[0];									
					for (var i in nl) if (sl>nl[i] && nl[i]>0) { sl = nl[i]; ix=i;}															
					var m = pw>(e.gw[ix]+e.tabw+e.thumbw) ? 1 : (pw-(e.tabw+e.thumbw)) / (e.gw[ix]);					

					newh =  (e.type==="carousel" && e.justify==="true" ? e.gh[ix] : (e.gh[ix] * m)) + (e.tabh + e.thumbh);
				}			
				
				if(window.rs_init_css===undefined) window.rs_init_css = document.head.appendChild(document.createElement("style"));					
				document.getElementById(e.c).height = newh;
				window.rs_init_css.innerHTML += "#"+e.c+"_wrapper { height: "+newh+"px }";				
			} catch(e){
				console.log("Failure at Presize of Slider:" + e)
			}					   
		  };
</script>

		
  <?php echo $__env->yieldContent('content'); ?>
  
	</body>
</html><?php /**PATH C:\Users\SONY\Desktop\beach_comber\resources\views/layouts/app1.blade.php ENDPATH**/ ?>