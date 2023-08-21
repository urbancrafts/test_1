

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
    <style id='foxuries-style-inline-css' type='text/css'>
      div.foxuries-shop{
        
        background-image: url(<?php echo e(asset('storage/img/bg/banner2.png')); ?>);
      }


      a.room-button{
        padding: 5px;
        background:deeppink;
        color:white;
      }
      </style>
  <script type="text/javascript">
  jQuery(document).ready(function(){

    jQuery("#shop-category").on("change", function(e){
     
      if(jQuery.trim(jQuery(this).val()) == ""){
         alert('Please select a resort');
		 }else{
         jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
           type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@load_shop_category')); ?>",
         data: {"shopCat": jQuery(this).val()},
         beforeSend:function(){
          jQuery('#load-shop').html("<div class='load'><img src='<?php echo e(asset('loaders/AjaxLoader.gif')); ?>' /></div>");
             //$(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".load").hide();
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
				jQuery(".alert-danger").css('display', 'none');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
        
                for(var i = 0; i < data.data.length; i++){
					if(data.data[i].img_1 != null){
            jQuery("#load-shop").append("\r\n<li id=\'room-"+data.data[i].id+"\' class=\'hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view\'><div class=\'summary entry-summary\'><div class=\'media\'><a href=\'<?php echo e(url('shop')); ?>/"+data.data[i].category+"/"+data.data[i].id+"\'><img src=\'"+data.data[i].img_1+"\' width=\'500\' height=\'575\' alt=\'\'><\/a><\/div><div class=\'room-caption\'><div class=\'title\'><h4><a href=\'<?php echo e(url('shop')); ?>/"+data.data[i].category+"/"+data.data[i].id+"\'>"+data.data[i].item_name+"<\/a><\/h4><\/div><div class=\'room-meta\'><span class=\'room-type\'><span><a href=\'#\'>"+data.data[i].location+"<\/a><\/span><\/span><\/div><div class=\'price\'><span class=\'title-price\'>Price<\/span><span class=\'price_value price_min\'>"+data.data[i].curr+data.data[i].price+"<\/span><span class=\'unit\'>"+data.data[i].discount_percent+"% discount<\/span><\/div><a href=\'#content\'  id=\'cart-button_"+data.data[i].id+"\' data-id=\'"+data.data[i].id+"\' class=\'room-button\' onClick=\'addToCart(this.id)\'><i class=\'ion ion-bag\'><\/i><span>Add to cart<\/span><\/a> <\/div><\/div><\/li>\r\n");
						
					}else{
            jQuery('#load-shop').hide();
						jQuery(".alert-danger").css('display', 'block');	
						jQuery(".upload-error").html("There's no service with an uploaded image at the moment");
					}
				}

            }else if(data.success == false){
              //jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'block');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery(".upload-error").html(data.message);
            }else{
				//jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'block');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery(".upload-error").html(data);
            }
              
         }
         });
		 }

    });




    $total_record = <?php echo e(count($shops)); ?>;
         $record_per_page = 9;
         $numer_of_page = ($total_record / $record_per_page);
         $current_page = 1;
         $start = Math.ceil($current_page * $record_per_page) - $record_per_page;
         loadHomeBlog($record_per_page, $start);
  
    function loadHomeBlog($record_per_page, $start){
      
      $action = "loadShopData";
      jQuery.ajax({
          headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
         },
           type: "POST",
           dataType: "json",
           url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@load_shop_data')); ?>",
           data: {"record_per_page": $record_per_page, "start": $start, "action": $action},
           beforeSend:function(){
			//jQuery("#search-btn").prop('disabled', true);
			jQuery('#load-shop').html("<div class='load'><img src='<?php echo e(asset('loaders/AjaxLoader.gif')); ?>' /></div>");
             //$(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
            jQuery(".load").hide();
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
				//jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'none');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
        
                for(var i = 0; i < data.data.length; i++){
					if(data.data[i].img_1 != null){
            //jQuery("#services-loader").append("\r\n<li id=\'room-"+data.data[i].id+"\' class=\'hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view\'><div class=\'summary entry-summary\'><div class=\'media\'><a href=\'<?php echo e(url('services/service')); ?>/"+data.data[i].id+"\'><img src=\'"+data.data[i].img_1+"\' width=\'500\' height=\'575\' alt=\'\'><\/a><\/div><div class=\'room-caption\'><div class=\'title\'><h4><a href=\'<?php echo e(url('services/service')); ?>/"+data.data[i].id+"\'>"+data.data[i].title+"<\/a><\/h4><\/div><div class=\'room-meta\'><span class=\'room-type\'><span><a href=\'#\'>"+data.data[i].location+"<\/a><\/span><\/span><\/div><div class=\'price\'><span class=\'title-price\'>Price<\/span><span class=\'price_value price_min\'>"+data.data[i].curr+data.data[i].price+"<\/span><span class=\'unit\'>"+data.data[i].duration+"<\/span><\/div><a href=\'<?php echo e(url('services/service')); ?>/"+data.data[i].id+"\' class=\'room-button\'><i class=\'foxuries-icon-long-arrow-right\'><\/i><span>See details<\/span><\/a> <\/div><\/div><\/li>\r\n");
              jQuery("#load-shop").append("\r\n<li id=\'room-"+data.data[i].id+"\' class=\'hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view\'><div class=\'summary entry-summary\'><div class=\'media\'><a href=\'<?php echo e(url('shop')); ?>/"+data.data[i].category+"/"+data.data[i].id+"\'><img src=\'"+data.data[i].img_1+"\' width=\'500\' height=\'575\' alt=\'\'><\/a><\/div><div class=\'room-caption\'><div class=\'title\'><h4><a href=\'<?php echo e(url('shop')); ?>/"+data.data[i].category+"/"+data.data[i].id+"\'>"+data.data[i].item_name+"<\/a><\/h4><\/div><div class=\'room-meta\'><span class=\'room-type\'><span><a href=\'#\'>"+data.data[i].location+"<\/a><\/span><\/span><\/div><div class=\'price\'><span class=\'title-price\'>Price<\/span><span class=\'price_value price_min\'>"+data.data[i].curr+data.data[i].price+"<\/span><span class=\'unit\'>"+data.data[i].discount_percent+"% discount<\/span><\/div><a href=\'#content\'  id=\'cart-button_"+data.data[i].id+"\' data-id=\'"+data.data[i].id+"\' class=\'room-button\' onClick=\'addToCart(this.id)\'><i class=\'ion ion-bag\'><\/i><span>Add to cart<\/span><\/a> <\/div><\/div><\/li>\r\n");
					}else{
            jQuery('#load-shop').hide();
						jQuery(".alert-danger").css('display', 'block');	
						jQuery(".upload-error").html("There's no service with an uploaded image at the moment");
					}
				}
			
            }else if(data.success == false){
				//jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'block');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery(".upload-error").html(data.message);
            }else{
				//jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'block');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery(".upload-error").html(data);
            }
              
         }
           });
  
    }
  
    $current_page = 2;
    jQuery(window).scroll(function(){
         if(jQuery(window).scrollTop()+window.innerHeight == jQuery(document).height()){
         $start = ($current_page * $record_per_page) - $record_per_page;
          if($current_page <= $numer_of_page){
            loadHomeBlog($record_per_page, $start);
           
          }
         }
         });
         
         
         setInterval(function(){
         
         },130000);
         
         setInterval(function(){
         
         },120000);


      
  });


  function addToCart(id){
  var elem = jQuery('#'+id).attr('data-id');
  
  if(elem == "" || !Number(elem)){
  alert('Invalid request ID');
  }else{

    jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
           type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@add_to_cart')); ?>",
         data: {"pid": elem, "qnty": 1},
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
				jQuery(".alert-danger").css('display', 'none');
				jQuery(".alert-success").css('display', 'block');
				jQuery(".alert-warning").css('display', 'none');
        
        jQuery(".cart-counter").html(data.data.length);
        jQuery(".upload-success").html(data.message);

            }else if(data.success == false){
              //jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'block');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery(".upload-error").html(data.message);
            }else{
				//jQuery("#search-btn").prop('disabled', false);
				//jQuery('#search-btn').html("Search");
				jQuery(".alert-danger").css('display', 'block');
				jQuery(".alert-success").css('display', 'none');
				jQuery(".alert-warning").css('display', 'none');
				jQuery(".upload-error").html(data);
            }
              
         }
         });

  }

}




  </script>
  </head>
  <body class="page-template-default page page-id-518 wp-embed-responsive foxuries-full-width-content foxuries-footer-builder elementor-default elementor-kit-75 elementor-page elementor-page-518">  
	
    <?php echo $__env->make('inc.header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="foxuries-shop foxuries-breadcrumb">
      <h1 class="breadcrumb-heading">
      Shop	</h1>
      
  <select id="shop-category" name="shop-category" style="width: 40%;">
    <option disabled selected>Shop category</option>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($category->category); ?>"><?php echo e($category->category); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
    
    </div>

    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    
    <div class="alert alert-warning alert-dismissible" style="display: none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
      <span class="upload-error"></span>
    </div>

    <div class="alert alert-danger alert-dismissible" style="display: none">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-ban"></i> Alert!</h5>
      <span class="upload-error"></span>
    </div>

    <div class="alert alert-success alert-dismissible" style="display: none">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-check"></i> Alert!</h5>
      <span class="upload-success"></span>
    </div>


    <ul class="rooms tp-hotel-booking hb-catalog-column-3" id="load-shop">
    
    </ul>

    </div>
    </div>
    <?php echo $__env->make('inc.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('wp-content/cache/min/1/26ca0b884dacc351c317d05fa6222447.js')); ?>" data-minify="1" defer></script>
		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SONY\Desktop\beach_comber\resources\views/pages/shop.blade.php ENDPATH**/ ?>