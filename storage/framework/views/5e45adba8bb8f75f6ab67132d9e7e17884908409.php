<script>

  (function(d, s, id) {	
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=575965129147402";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  </script>
  
  <header id="masthead" class="site-header header-2" role="banner">
    <div class="inner header-sticky">
    <div class="header-container">
    <div class="header-main d-flex align-items-center justify-content-between">
    <div class="header-left d-flex align-items-center justify-content-between">
    <div class="site-branding">
    <a href="<?php echo e(url('/')); ?>" class="custom-logo-link" rel="home"><img src="<?php echo e(asset('storage/img/site_logo/'.$settings[0]->logo)); ?>" alt="Logo" /></a> </div>
    
    <a href="#" class="menu-mobile-nav-button">
    <span class="toggle-text screen-reader-text">Menu</span>
    Menu <i class="foxuries-icon-bars"></i>
    </a>
    </div>
    <div class="header-center desktop-hide-down">
    <nav class="main-navigation" role="navigation" aria-label="Primary Navigation">
    <div class="primary-navigation">

      <ul id="menu-foxuries-main-menu" class="menu">
        <li id="menu-item-120" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608">
        
        <a href="<?php echo e(url('/')); ?>">Home</a>    
      </li>
    
      <li id="menu-item-121" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121"><a href="<?php echo e(url('/resorts')); ?>">Resorts</a></li>
    
      <li id="menu-item-122" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608"><a href="<?php echo e(url('/boat')); ?>">Boats</a>
      </li>
    
    
      <li id="menu-item-121" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121"><a href="<?php echo e(url('/shop')); ?>">Shop</a></li>
    
      <li id="menu-item-557" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557"><a href="<?php echo e(url('/about_us')); ?>">About us</a></li>
      <li id="menu-item-557" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557"><a href="<?php echo e(url('/contact')); ?>">Contact</a></li>
      
      </ul>
    
    </div> </nav>
    </div>
    <div class="header-right desktop-hide-down header-group-action">
      <?php if(auth()->guard()->check()): ?>
      <?php if(Auth::user()->user_type == "admin" && Auth::user()->role == 1): ?>
      <a href="<?php echo e(url('/admin_dashboard')); ?>/<?php echo e(Auth::user()->id); ?>" class="appao-btn mg-t button alt button-booking "><i class="fa fa-dashboard"></i> Dashbaord</a>   
      <?php else: ?>
      <a href="<?php echo e(url('/member_dashboard')); ?>/<?php echo e(Auth::user()->id); ?>" class="appao-btn mg-t button alt button-booking "><i class="fa fa-dashboard"></i> Dashbaord</a>   
      <?php endif; ?>
       
              <?php else: ?>
              <a class="appao-btn zoomInDown mg-t button alt button-booking" href="#" data-toggle="modal" data-target="#zoomInDown1">Sign In</a>
              <?php endif; ?>
    </div>
    </div>
    </div>
    </div>
    </header><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/inc/index-header.blade.php ENDPATH**/ ?>