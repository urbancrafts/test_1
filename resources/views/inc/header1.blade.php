<script>

  (function(d, s, id) {	
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=575965129147402";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  </script>
  
<header id="masthead" class="site-header header-1" role="banner">
  <div class="header-container header-sticky">
  <div class="header-main d-flex align-items-center">
  <div class="header-left d-flex align-items-center justify-content-between">
  <div class="site-branding">
    
    <a href="{{ url('/') }}" class="custom-logo-link" rel="home"><img src="{{ asset('storage/img/site_logo/'.$settings[0]->logo) }}" alt="Logo" /></a>
    
 </div>
 
 
 
 

  <a href="#" class="menu-mobile-nav-button">
  <span class="toggle-text screen-reader-text">Menu</span>
  Menu <i class="foxuries-icon-bars"></i>
  </a>
  
  </div>
  <div class="header-center desktop-hide-down">
  <nav class="main-navigation" role="navigation" aria-label="Primary Navigation">
  <div class="primary-navigation"><ul id="menu-foxuries-main-menu" class="menu">
    <li id="menu-item-120" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608 {{ request()->is('*/') ? 'current-menu-item' : '' }}">
    
    <a href="{{ url('/') }}">Home</a>    
  </li>

  <li id="menu-item-121" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121 {{ request()->is('resorts*') ? 'current-menu-item' : '' }}"><a href="{{ url('/resorts') }}">Resorts</a></li>

  <li id="menu-item-122" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608 {{ request()->is('boats*') ? 'current-menu-item' : '' }}"><a href="{{ url('/boats') }}">Boats</a>
  </li>

  <li id="menu-item-121" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121 {{ request()->is('services*') ? 'current-menu-item' : '' }}"><a href="{{ url('/services') }}">Services</a></li>

  <li id="menu-item-121" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121 {{ request()->is('shop*') ? 'current-menu-item' : '' }}"><a href="{{ url('/shop') }}">Shop</a></li>

  <li id="menu-item-325" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-325 {{ request()->is('pages*') ? 'current-menu-item' : '' }}"><a href="#">Pages</a>
    <ul class="sub-menu">
      <li id="menu-item-557" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557 {{ request()->is('pages/about_us*') ? 'current-menu-item' : '' }}"><a href="{{ url('/pages/about_us') }}">About us</a></li>
      <li id="menu-item-557" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557 {{ request()->is('pages/blogs*') ? 'current-menu-item' : '' }}"><a href="{{ url('/pages/blogs') }}">Blogs</a></li>
      <li id="menu-item-557" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557 {{ request()->is('pages/contact*') ? 'current-menu-item' : '' }}"><a href="{{ url('/pages/contact') }}">Contact Us</a></li>
    </ul>
    </li>

  
  <li id="menu-item-557" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557"><a href="">Book a ride</a></li>
  
  </ul></div> </nav>
  </div>
  <div class="header-right header-group-action desktop-hide-down">
  <div class="phone-number">
    <a href="{{url('shop/cart')}}" class="cart-icon-link">
      <i class="ion ion-bag" style="font-size: 26px; font-weight: bold">
        <span class="badge badge-warning navbar-badge cart-counter" style="position: absolute; margin-left:-12px; background:crimson; color:snow">0</span>
      </i>
      
    </a>
  </div>
  <div class="booking-action-wrap">
  <div class="inner">
    @auth
    @if (Auth::user()->user_type == "admin" && Auth::user()->role == 1)
    <a href="{{ url('/admin_dashboard') }}/{{ Auth::user()->id }}" class="appao-btn mg-t button alt button-booking "><i class="fa fa-dashboard"></i> Dashbaord</a>   
    @else
    <a href="{{ url('/member_dashboard') }}/{{ Auth::user()->id }}" class="appao-btn mg-t button alt button-booking "><i class="fa fa-dashboard"></i> Dashbaord</a>   
    @endif
     
            @else
            <a class="appao-btn zoomInDown mg-t button alt button-booking" href="#" data-toggle="modal" data-target="#zoomInDown1">Sign In</a>
            @endauth
    
  
  </div>
  </div>
  </div>
  </div>
  </div>
  </header>