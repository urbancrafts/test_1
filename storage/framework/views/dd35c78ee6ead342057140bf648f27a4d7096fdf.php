      

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPxcQlAZ_LWl4EZtHU27zTv3CFpCaSQ_A&libraries=places&callback=initAutocomplete" async defer></script>
<style type="text/css">

</style>
<script type="text/javascript">
  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type  {!HTMLInputElement} */(document.getElementById('location')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
	
	
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    
  }

  
    </script>

<script type="text/javascript">
jQuery(document).ready(function(){

	jQuery("#location").focus(function(){
		jQuery(this).css('border', 'none');
	})

	jQuery("#check-avail-form").on("submit", function(e){
      e.preventDefault();
	  var action = jQuery(this).attr('action');
	  var location = jQuery("#location").val();
	  var search_option = jQuery("input[type=radio][name=search-option]:checked").val();

	  if(jQuery.trim(jQuery("#location").val()) == ""){
		jQuery("#location").css('border', 'solid 1px red');
        jQuery(".alert-danger").css('display', 'block');
        jQuery(".alert-success").css('display', 'none');
        jQuery(".alert-warning").css('display', 'none');
        jQuery(".upload-error").html("Please select your prefered location");
	  }else{
		jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
           type: "POST",
         dataType: "json",
         url: action,
         data: {"location": location, "search-option": search_option},
         beforeSend:function(){
			jQuery("#search-btn").prop('disabled', true);
			jQuery('#search-btn').html("<img src='<?php echo e(asset('loaders/AjaxLoader.gif')); ?>' />");
             //$(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             //$(".load").hide();
			 
         },
         error:function(){
			jQuery(".alert-warning").css('display', 'block');
			jQuery(".alert-danger").css('display', 'none');
			jQuery(".upload-error").html("<img src='<?php echo e(asset('icons/ic_connections.png')); ?>' /> Please check your internet connection or refresh your browser");
			jQuery("#search-btn").prop('disabled', false);
			jQuery('#search-btn').html("Search");
         },
         success:function(data){
            if(data.success == true){
				jQuery("#search-btn").prop('disabled', false);
				jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'none');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery("#load_search_result").html('');
                for(var i = 0; i < data.data.length; i++){
					if(data.data[i].img_1 != null){
						if(search_option == "Resort"){
							jQuery("#load_search_result").append("\r\n<li id=\'room-"+data.data[i].id+"\' class=\'hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view\'><div class=\'summary entry-summary\'><div class=\'media\'><a href=\'<?php echo e(url('resorts/resort')); ?>/"+data.data[i].id+"\'><img src=\'"+data.data[i].img_1+"\' width=\'500\' height=\'575\' alt=\'\'><\/a><\/div><div class=\'room-caption\'><div class=\'title\'><h4><a href=\'<?php echo e(url('resorts/resort')); ?>/"+data.data[i].id+"\'>"+data.data[i].name+"<\/a><\/h4><\/div><div class=\'room-meta\'><span class=\'room-type\'><span><a href=\'#\'>"+data.data[i].location+"<\/a><\/span><\/span><\/div><div class=\'price\'><span class=\'title-price\'>Price<\/span><span class=\'price_value price_min\'>"+data.data[i].curr+data.data[i].price+"<\/span><span class=\'unit\'>"+data.data[i].duration+"<\/span><\/div><a href=\'<?php echo e(url('resorts/resort')); ?>/"+data.data[i].id+"\' class=\'room-button\'><i class=\'foxuries-icon-long-arrow-right\'><\/i><span>See details<\/span><\/a> <\/div><\/div><\/li>\r\n");
						}else if(search_option == "Boat"){
							jQuery("#load_search_result").append("\r\n<li id=\'room-"+data.data[i].id+"\' class=\'hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view\'><div class=\'summary entry-summary\'><div class=\'media\'><a href=\'<?php echo e(url('boats/boat')); ?>/"+data.data[i].id+"\'><img src=\'"+data.data[i].img_1+"\' width=\'500\' height=\'575\' alt=\'\'><\/a><\/div><div class=\'room-caption\'><div class=\'title\'><h4><a href=\'<?php echo e(url('boats/boat')); ?>/"+data.data[i].id+"\'>"+data.data[i].title+"<\/a><\/h4><\/div><div class=\'room-meta\'><span class=\'room-type\'><span><a href=\'#\'>"+data.data[i].location+"<\/a><\/span><\/span><\/div><div class=\'price\'><span class=\'title-price\'>Price<\/span><span class=\'price_value price_min\'>"+data.data[i].curr+data.data[i].price+"<\/span><span class=\'unit\'>"+data.data[i].duration+"<\/span><\/div><a href=\'<?php echo e(url('boats/boat')); ?>/"+data.data[i].id+"\' class=\'room-button\'><i class=\'foxuries-icon-long-arrow-right\'><\/i><span>See details<\/span><\/a> <\/div><\/div><\/li>\r\n");
						}else if(search_option == "Others"){
							jQuery("#load_search_result").append("\r\n<li id=\'room-"+data.data[i].id+"\' class=\'hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view\'><div class=\'summary entry-summary\'><div class=\'media\'><a href=\'<?php echo e(url('services/service')); ?>/"+data.data[i].id+"\'><img src=\'"+data.data[i].img_1+"\' width=\'500\' height=\'575\' alt=\'\'><\/a><\/div><div class=\'room-caption\'><div class=\'title\'><h4><a href=\'<?php echo e(url('services/service')); ?>/"+data.data[i].id+"\'>"+data.data[i].title+"<\/a><\/h4><\/div><div class=\'room-meta\'><span class=\'room-type\'><span><a href=\'#\'>"+data.data[i].location+"<\/a><\/span><\/span><\/div><div class=\'price\'><span class=\'title-price\'>Price<\/span><span class=\'price_value price_min\'>"+data.data[i].curr+data.data[i].price+"<\/span><span class=\'unit\'>"+data.data[i].duration+"<\/span><\/div><a href=\'<?php echo e(url('services/service')); ?>/"+data.data[i].id+"\' class=\'room-button\'><i class=\'foxuries-icon-long-arrow-right\'><\/i><span>See details<\/span><\/a> <\/div><\/div><\/li>\r\n");
						}
					}else{
						jQuery(".alert-danger").css('display', 'block');	
						jQuery(".upload-error").html("There's no service with an uploaded image at the moment");
					}
				}
			
            }else if(data.success == false){
				jQuery("#search-btn").prop('disabled', false);
				jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'block');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery(".upload-error").html(data.data);
            }else{
				jQuery("#search-btn").prop('disabled', false);
				jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'block');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery(".upload-error").html(data);
            }
              
         }
         });

	  }
	});

/************************************************************************
jQuery("#location").on('keyup', function(e){

 if(e.keyCode == 40 || e.keyCode == 38 || e.keyCode == 13){
         jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
           type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@load_resort_location_search')); ?>",
         data: {"location": jQuery(this).val()},
         beforeSend:function(){
             jQuery(".check-resort-success").show();
             jQuery(".check-resort-error").hide();
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
             jQuery("#check-resort").html(data.data);
            }else if(data.success == false){
			  jQuery("#check-resort").html(data.data);
              jQuery(".check-resort-success").hide();
              jQuery(".check-resort-error").show();
              jQuery(".check-resort-error").html(data.message);
            }else{
              jQuery(".check-resort-success").hide();
              jQuery(".check-resort-error").show();
              jQuery(".check-resort-error").html(data);
            }
              
         }
         });

		
 } 

	   });
**********************************************************************/

});
</script>
	</head>

	<body onload="initAutocomplete()" class="home page-template page-template-template-homepage page-template-template-homepage-php page page-id-73 wp-embed-responsive foxuries-full-width-content foxuries-footer-builder elementor-default elementor-kit-75 elementor-page elementor-page-73">
		
		<div id="page" class="hfeed site">
			<?php echo $__env->make('inc.header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
		<?php echo $__env->make('pages.index-service-field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('pages.index-check-reservation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="elementor-element elementor-element-6c8828c elementor-section-stretched elementor-reverse-tablet elementor-reverse-mobile elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="6c8828c" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-row">
			<div class="elementor-element elementor-element-b8f7b1d elementor-hidden-phone elementor-column elementor-col-33 elementor-top-column" data-id="b8f7b1d" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-dae716a animated-fast elementor-invisible elementor-widget elementor-widget-image" data-id="dae716a" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-right&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="image.default">
			<div class="elementor-widget-container">
			<div class="elementor-image">
			<img width="290" height="620" src="<?php echo e(asset('img/index-img/h1_img.jpg')); ?>" class="attachment-full size-full" alt="" srcset="<?php echo e(asset('img/index-img/h1_img.jpg')); ?> 290w, <?php echo e(asset('img/index-img/h1_img.jpg')); ?> 140w" sizes="(max-width: 290px) 100vw, 290px" /> </div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-70af532 elementor-hidden-phone elementor-column elementor-col-33 elementor-top-column" data-id="70af532" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-6bac523 animated-fast elementor-invisible elementor-widget elementor-widget-image" data-id="6bac523" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-left&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="image.default">
			<div class="elementor-widget-container">
			<div class="elementor-image">
			<img width="290" height="290" src="<?php echo e(asset('img/index-img/h1_img1.jpg')); ?>" class="attachment-full size-full" alt="" srcset="<?php echo e(asset('img/index-img/h1_img1.jpg')); ?> 290w, <?php echo e(asset('img/index-img/h1_img1.jpg')); ?> 150w" sizes="(max-width: 290px) 100vw, 290px" /> </div>
			</div>
			</div>
			<div class="elementor-element elementor-element-2893bd2 animated-fast elementor-invisible elementor-widget elementor-widget-image" data-id="2893bd2" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-left&quot;,&quot;_animation_delay&quot;:200,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="image.default">
			<div class="elementor-widget-container">
			<div class="elementor-image">
			<img width="290" height="290" src="<?php echo e(asset('img/index-img/h1_img2.jpg')); ?>" class="attachment-full size-full" alt="" srcset="<?php echo e(asset('img/index-img/h1_img2.jpg')); ?> 290w, <?php echo e(asset('img/index-img/h1_img2.jpg')); ?> 150w" sizes="(max-width: 290px) 100vw, 290px" /> </div>
			</div>
			 </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-b1be3c2 elementor-column elementor-col-33 elementor-top-column" data-id="b1be3c2" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-4c0e6db animated-fast elementor-view-default elementor-invisible elementor-widget elementor-widget-icon" data-id="4c0e6db" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="icon.default">
			<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-decor"></i> </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-b43f40a animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="b43f40a" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
			
			</div>
			<div class="elementor-element elementor-element-c9041e4 animated-fast elementor-invisible elementor-widget elementor-widget-heading" data-id="c9041e4" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">What we do</h2> </div>
			</div>
			<div class="elementor-element elementor-element-a2a05bc animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="a2a05bc" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix">
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($content->name == "what_we_do"): ?>
						<?php echo $content->value; ?>

					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-9107017 elementor-align-center elementor-button-secondary animated-fast elementor-invisible elementor-widget elementor-widget-button" data-id="9107017" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-scale-up&quot;,&quot;_animation_delay&quot;:200,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="button.default">
			<div class="elementor-widget-container">
			<div class="elementor-button-wrapper">
			<a href="<?php echo e(url('about_us')); ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
			<span class="elementor-button-content-wrapper">
			<span class="elementor-button-icon elementor-align-icon-left">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-long-arrow-right"></i> </span>
			<span class="elementor-button-text">Read More</span>
			</span>
			</a>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-aff71bf elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="aff71bf" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-row">
			<div class="elementor-element elementor-element-0549fd6 elementor-column elementor-col-100 elementor-top-column" data-id="0549fd6" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-ae3e640 animated-fast elementor-view-default elementor-invisible elementor-widget elementor-widget-icon" data-id="ae3e640" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="icon.default">
			<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-decor"></i> </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-b1aabe3 animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="b1aabe3" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>Exclusive Offers</span></div>
			</div>
			</div>
			<div class="elementor-element elementor-element-c20951b animated-fast elementor-invisible elementor-widget elementor-widget-heading" data-id="c20951b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Special Modules</h2> </div>
			</div>
			<div class="elementor-element elementor-element-f160510 elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="f160510" data-element_type="section">
			<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-row">
			<div class="elementor-element elementor-element-f0e3dd8 animated-hover-box animated-fast elementor-invisible elementor-column elementor-col-33 elementor-inner-column" data-id="f0e3dd8" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;opal-move-up&quot;,&quot;animation_tablet&quot;:&quot;none&quot;,&quot;animation_mobile&quot;:&quot;none&quot;}">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-9fd79a7 elementor-view-stacked elementor-shape-circle elementor-widget elementor-widget-icon" data-id="9fd79a7" data-element_type="widget" data-widget_type="icon.default">
			<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-meal"></i> </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-4ba35d3 elementor-widget elementor-widget-text-editor" data-id="4ba35d3" data-element_type="widget" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>Stay health</span></div>
			</div>
			</div>
			<div class="elementor-element elementor-element-a4fe3f3 elementor-widget elementor-widget-heading" data-id="a4fe3f3" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h3 class="elementor-heading-title elementor-size-default">Enjoy the best sea food delicates at discount prices</h3> </div>
			</div>
			<div class="elementor-element elementor-element-8113372 elementor-align-center elementor-widget elementor-widget-button" data-id="8113372" data-element_type="widget" data-widget_type="button.default">
			<div class="elementor-widget-container">
			<div class="elementor-button-wrapper">
			<a href="<?php echo e(url('blog/category/kitchen')); ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
			<span class="elementor-button-content-wrapper">
			<span class="elementor-button-icon elementor-align-icon-left">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-long-arrow-right"></i> </span>
			<span class="elementor-button-text">Learn more</span>
			</span>
			</a>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-bb20ff7 animated-hover-box animated-fast elementor-invisible elementor-column elementor-col-33 elementor-inner-column" data-id="bb20ff7" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;opal-move-up&quot;,&quot;animation_delay&quot;:150,&quot;animation_tablet&quot;:&quot;none&quot;,&quot;animation_mobile&quot;:&quot;none&quot;}">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-3d7e788 elementor-view-stacked elementor-shape-circle elementor-widget elementor-widget-icon" data-id="3d7e788" data-element_type="widget" data-widget_type="icon.default">
			<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="fas fa-volleyball-ball"></i> </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-59131c1 elementor-widget elementor-widget-text-editor" data-id="59131c1" data-element_type="widget" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix">Keep fit</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-e9411a2 elementor-widget elementor-widget-heading" data-id="e9411a2" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h3 class="elementor-heading-title elementor-size-default">Be a part of our beach sports and other beach weekly/weekend activities by becoming a member. </h3> </div>
			</div>
			<div class="elementor-element elementor-element-61dffc2 elementor-align-center elementor-widget elementor-widget-button" data-id="61dffc2" data-element_type="widget" data-widget_type="button.default">
			<div class="elementor-widget-container">
			<div class="elementor-button-wrapper">
			<a href="<?php echo e(url('blog/category/beach_sports')); ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
			<span class="elementor-button-content-wrapper">
			<span class="elementor-button-icon elementor-align-icon-left">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-long-arrow-right"></i> </span>
			<span class="elementor-button-text">See more</span>
			</span>
			</a>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-6a9a5f0 animated-hover-box animated-fast elementor-invisible elementor-column elementor-col-33 elementor-inner-column" data-id="6a9a5f0" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;opal-move-up&quot;,&quot;animation_delay&quot;:300,&quot;animation_tablet&quot;:&quot;none&quot;,&quot;animation_mobile&quot;:&quot;none&quot;}">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-db7c199 elementor-view-stacked elementor-shape-circle elementor-widget elementor-widget-icon" data-id="db7c199" data-element_type="widget" data-widget_type="icon.default">
			<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="fas fa-users"></i> </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-d9de5e8 elementor-widget elementor-widget-text-editor" data-id="d9de5e8" data-element_type="widget" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix">
				
					
				<?php echo e($settings[0]->memb_discount); ?>% Discount For
				
				Members</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-1ba1229 elementor-widget elementor-widget-heading" data-id="1ba1229" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h3 class="elementor-heading-title elementor-size-default">Join
				
					<?php echo e($settings[0]->site_name); ?>

				
				Club Today</h3> </div>
			</div>
			<div class="elementor-element elementor-element-ff0cdca elementor-align-center elementor-widget elementor-widget-button" data-id="ff0cdca" data-element_type="widget" data-widget_type="button.default">
			<div class="elementor-widget-container">
			<div class="elementor-button-wrapper">
			<a href="<?php echo e(url('register/signup_members')); ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
			<span class="elementor-button-content-wrapper">
			<span class="elementor-button-icon elementor-align-icon-left">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-long-arrow-right"></i> </span>
			<span class="elementor-button-text">Signup now</span>
			</span>
			</a>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			
         <?php echo $__env->make('pages.index-room-show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                
			<div class="elementor-element elementor-element-ed1a96b elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="ed1a96b" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-background-overlay"></div>
			<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-row">
			<div class="elementor-element elementor-element-2671636 elementor-column elementor-col-100 elementor-top-column" data-id="2671636" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-1c6f8f7 animated-fast elementor-view-default elementor-invisible elementor-widget elementor-widget-icon" data-id="1c6f8f7" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="icon.default">
			<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-decor"></i> </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-2c0daad animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="2c0daad" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>Why you should choose us</span></div>
			</div>
			</div>
			<div class="elementor-element elementor-element-cd31dc7 animated-fast elementor-invisible elementor-widget elementor-widget-heading" data-id="cd31dc7" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Top reasons why you should choose us</h2> </div>
			</div>
			
			<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($content->name == "why_you_should_choose_us"): ?>
					<?php echo $content->value; ?>

				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			
	
			<div class="elementor-element elementor-element-818e3d2 elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="818e3d2" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-row">
			<div class="elementor-element elementor-element-6fffb8d elementor-column elementor-col-100 elementor-top-column" data-id="6fffb8d" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-836ff2d animated-fast elementor-view-default elementor-invisible elementor-widget elementor-widget-icon" data-id="836ff2d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="icon.default">
			<div class="elementor-widget-container">
			<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-decor"></i> </div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-0e1209c animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="0e1209c" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>SERVICES</span></div>
			</div>
			</div>
			<div class="elementor-element elementor-element-5c25a1a animated-fast elementor-invisible elementor-widget elementor-widget-heading" data-id="5c25a1a" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-move-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Extra Services</h2> </div>
			</div>
			<div class="elementor-element elementor-element-cf0eb35 elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="cf0eb35" data-element_type="section">
			<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-row">
			<div class="elementor-element elementor-element-78628a9 animated-fast elementor-invisible elementor-column elementor-col-25 elementor-inner-column" data-id="78628a9" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;opal-move-up&quot;,&quot;animation_tablet&quot;:&quot;none&quot;,&quot;animation_mobile&quot;:&quot;none&quot;}">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-eed5085 elementor-widget elementor-widget-heading" data-id="eed5085" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">1.</h2> </div>
			</div>
			<div class="elementor-element elementor-element-279c1ce elementor-widget elementor-widget-heading" data-id="279c1ce" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h4 class="elementor-heading-title elementor-size-default">Beach Tourism​</h4> </div>
			</div>
			<div class="elementor-element elementor-element-651eaed elementor-widget elementor-widget-text-editor" data-id="651eaed" data-element_type="widget" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($content->name == "beach_tourism"): ?>
					<?php echo $content->value; ?>

				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			</span></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-8a97aa9 animated-fast elementor-invisible elementor-column elementor-col-25 elementor-inner-column" data-id="8a97aa9" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;opal-move-up&quot;,&quot;animation_delay&quot;:100,&quot;animation_tablet&quot;:&quot;none&quot;,&quot;animation_mobile&quot;:&quot;none&quot;}">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-87ca500 elementor-widget elementor-widget-heading" data-id="87ca500" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">2.</h2> </div>
			</div>
			<div class="elementor-element elementor-element-50ff22b elementor-widget elementor-widget-heading" data-id="50ff22b" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Boat & Yacht Cruise</h2> </div>
			</div>
			<div class="elementor-element elementor-element-2ed567f elementor-widget elementor-widget-text-editor" data-id="2ed567f" data-element_type="widget" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($content->name == "boat_and_yacht_cruise"): ?>
					<?php echo $content->value; ?>

				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			</span></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-e5e1882 animated-fast elementor-invisible elementor-column elementor-col-25 elementor-inner-column" data-id="e5e1882" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;opal-move-up&quot;,&quot;animation_delay&quot;:200,&quot;animation_tablet&quot;:&quot;none&quot;,&quot;animation_mobile&quot;:&quot;none&quot;}">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-1601265 elementor-widget elementor-widget-heading" data-id="1601265" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">3.</h2> </div>
			</div>
			<div class="elementor-element elementor-element-c37d766 elementor-widget elementor-widget-heading" data-id="c37d766" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Beach Hangout</h2> </div>
			</div>
			<div class="elementor-element elementor-element-e0ec886 elementor-widget elementor-widget-text-editor" data-id="e0ec886" data-element_type="widget" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($content->name == "beach_hangout"): ?>
					<?php echo $content->value; ?>

				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			</span></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-697c882 animated-fast elementor-invisible elementor-column elementor-col-25 elementor-inner-column" data-id="697c882" data-element_type="column" data-settings="{&quot;animation&quot;:&quot;opal-move-up&quot;,&quot;animation_delay&quot;:300,&quot;animation_tablet&quot;:&quot;none&quot;,&quot;animation_mobile&quot;:&quot;none&quot;}">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-6f810d3 elementor-widget elementor-widget-heading" data-id="6f810d3" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">4.</h2> </div>
			</div>
			<div class="elementor-element elementor-element-4013388 elementor-widget elementor-widget-heading" data-id="4013388" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h2 class="elementor-heading-title elementor-size-default">Beach Sports​</h2> </div>
			</div>
			<div class="elementor-element elementor-element-a8444f0 elementor-widget elementor-widget-text-editor" data-id="a8444f0" data-element_type="widget" data-widget_type="text-editor.default">
			<div class="elementor-widget-container">
			<div class="elementor-text-editor elementor-clearfix"><span>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($content->name == "beach_sports"): ?>
					<?php echo $content->value; ?>

				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			</span></div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			
			

			<div class="elementor-element elementor-element-c06aa86 elementor-section-stretched elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="c06aa86" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-container elementor-column-gap-no">
			<div class="elementor-row">
			<div class="elementor-element elementor-element-3370b57 elementor-column elementor-col-33 elementor-top-column" data-id="3370b57" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-96908ee elementor-widget elementor-widget-heading" data-id="96908ee" data-element_type="widget" data-widget_type="heading.default">
			<div class="elementor-widget-container">
			<h3 class="elementor-heading-title elementor-size-default">Be Our Guest and <br> Make Every Stay Memorable</h3> </div>
			</div>
			<div class="elementor-element elementor-element-1d4afcb elementor-align-left elementor-mobile-align-center elementor-widget elementor-widget-button" data-id="1d4afcb" data-element_type="widget" data-widget_type="button.default">
			<div class="elementor-widget-container">
			<div class="elementor-button-wrapper">
			<a href="<?php echo e(url('about_us')); ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
			<span class="elementor-button-content-wrapper">
			<span class="elementor-button-icon elementor-align-icon-left">
			<i aria-hidden="true" class="foxuries-icon- foxuries-icon-long-arrow-right"></i> </span>
			<span class="elementor-button-text">Learn more</span>
			</span>
			</a>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-955e2b9 elementor-column elementor-col-33 elementor-top-column" data-id="955e2b9" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-60b75d7 animated-fast elementor-invisible elementor-widget elementor-widget-image" data-id="60b75d7" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-scale-up&quot;,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="image.default">
			<div class="elementor-widget-container">
			<div class="elementor-image">
			<img width="260" height="135" src="<?php echo e(asset('wp-content/uploads/2020/03/h1_text-hello.png')); ?>" class="attachment-full size-full" alt="" /> </div>
			</div>
			</div>
			<div class="elementor-element elementor-element-3618d85 elementor-widget__width-initial elementor-absolute elementor-widget-mobile__width-initial elementor-widget elementor-widget-image" data-id="3618d85" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="image.default">
			<div class="elementor-widget-container">
			<div class="elementor-image">
			<img width="464" height="216" src="<?php echo e(asset('wp-content/uploads/2020/03/h1_shape-people.png')); ?>" class="attachment-full size-full" alt="" srcset="<?php echo e(asset('wp-content/uploads/2020/03/h1_shape-people.png')); ?> 464w, <?php echo e(asset('wp-content/uploads/2020/03/h1_shape-people.png')); ?> 300w" sizes="(max-width: 464px) 100vw, 464px" /> </div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="elementor-element elementor-element-cce268c elementor-hidden-phone elementor-column elementor-col-33 elementor-top-column" data-id="cce268c" data-element_type="column">
			<div class="elementor-column-wrap  elementor-element-populated">
			<div class="elementor-widget-wrap">
			<div class="elementor-element elementor-element-0097ba3 animated-fast elementor-invisible elementor-widget elementor-widget-image" data-id="0097ba3" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;opal-scale-up&quot;,&quot;_animation_delay&quot;:200,&quot;_animation_tablet&quot;:&quot;none&quot;,&quot;_animation_mobile&quot;:&quot;none&quot;}" data-widget_type="image.default">
			<div class="elementor-widget-container">
			<div class="elementor-image">
			<img width="280" height="156" src="<?php echo e(asset('wp-content/uploads/2020/03/h1_text-summer.png')); ?>" class="attachment-full size-full" alt="" /> </div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			
            <?php echo $__env->make('pages.index-blog-field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		    </div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</main>
			</div>
			</div>
			</div>
			



		<?php echo $__env->make('inc.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<script src="<?php echo e(asset('wp-content/cache/min/1/26ca0b884dacc351c317d05fa6222447.js')); ?>" data-minify="1" defer></script>
		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/pages/index.blade.php ENDPATH**/ ?>