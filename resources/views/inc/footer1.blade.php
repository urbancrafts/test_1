
@include('auth.sign-in')

<footer id="colophon" class="site-footer" role="contentinfo">
  <div data-elementor-type="page" data-elementor-id="296" class="elementor elementor-296" data-elementor-settings="[]">
  <div class="elementor-inner">
  <div class="elementor-section-wrap">
  <div class="elementor-element elementor-element-1b3910b elementor-section-stretched elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="1b3910b" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;,&quot;background_background&quot;:&quot;classic&quot;}">
  <div class="elementor-container elementor-column-gap-no">
  <div class="elementor-row">
  <div class="elementor-element elementor-element-e9b9a7b elementor-column elementor-col-100 elementor-top-column" data-id="e9b9a7b" data-element_type="column">
  <div class="elementor-column-wrap  elementor-element-populated">
  <div class="elementor-widget-wrap">
  <div class="elementor-element elementor-element-7640842 elementor-widget__width-initial elementor-widget elementor-widget-heading" data-id="7640842" data-element_type="widget" data-widget_type="heading.default">
  <div class="elementor-widget-container">
  <h2 class="elementor-heading-title elementor-size-default">News Letters</h2> </div>
  </div>
  <div class="elementor-element elementor-element-9ef61d2 elementor-widget elementor-widget-opal-mailchmip" data-id="9ef61d2" data-element_type="widget" data-widget_type="opal-mailchmip.default">
  <div class="elementor-widget-container">
  <div class="form-style">
<form id="news-letter-form" action="{{ action('App\Http\Controllers\AjaxRequestController@news_letter_sub') }}" class="mc4wp-form mc4wp-form-293" method="post" data-id="293" data-name="Foxuries Mailchimp"><div class="mc4wp-form-fields">
    
  <p>
  <input type="email" id="news-email" name="email" placeholder="Your email address" />
  </p>
  <p>
  <button class="button alt btn req-btn" id="new-letter-btn" type="submit"><i class="foxuries-icon-long-arrow-right"></i>Subscribe Now</button>
  </p><span class="alert alert-danger news-letter-error" style="display: none"></span><span class="alert alert-success news-letter-success" style="display: none"></span></div></form></div> </div>
  </div>
  <div class="elementor-element elementor-element-13557fb elementor-widget elementor-widget-divider" data-id="13557fb" data-element_type="widget" data-widget_type="divider.default">
  <div class="elementor-widget-container">
  <div class="elementor-divider">
  <span class="elementor-divider-separator">
  </span>
  </div>
  </div>
  </div>
  <div class="elementor-element elementor-element-e9962a3 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="e9962a3" data-element_type="section">
  <div class="elementor-container elementor-column-gap-no">
  <div class="elementor-row">
  <div class="elementor-element elementor-element-f6ad2bf elementor-column elementor-col-25 elementor-inner-column" data-id="f6ad2bf" data-element_type="column">
  <div class="elementor-column-wrap  elementor-element-populated">
  <div class="elementor-widget-wrap">
  <div class="elementor-element elementor-element-6fdc141 elementor-widget elementor-widget-image" data-id="6fdc141" data-element_type="widget" data-widget_type="image.default">
  <div class="elementor-widget-container">
  <div class="elementor-image">
  
    
    <div class="container social_feeds">
      
      
      <div class="pull-right facebook_feeds"><div class="fb-like-box" data-href="{{$settings[0]->facebook}}" data-width="400" data-height="500" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div></div>
      <span class="clearfix"></span>
      </div><div class="container bt_sec">
<div class="pull-left copyrite">
<span class="glyphicon glyphicon-copyright-mark"></span> {{$settings[0]->site_name}} &reg; <?php echo date('Y');?></div>
<div class="pull-right bt_links">
</div>
<span class="clearfix"></span>
</div>
  


  </div>
  </div>
  </div>
  <div class="elementor-element elementor-element-eb47a1d elementor-shape-rounded elementor-widget elementor-widget-social-icons" data-id="eb47a1d" data-element_type="widget" data-widget_type="social-icons.default">
  <div class="elementor-widget-container">
  <div class="elementor-social-icons-wrapper">
  <a class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-95df83c" href="https://www.facebook.com/Beach-Combers-Club-108994794741419" target="_blank">
  <span class="elementor-screen-only">Facebook</span>
  <i class="fab fa-facebook"></i> </a>
  <a class="elementor-icon elementor-social-icon elementor-social-icon-linkedin elementor-repeater-item-03c21e7" href="https://www.linkedin.com/" target="_blank">
  <span class="elementor-screen-only">Linkedin</span>
  <i class="fab fa-linkedin"></i> </a>
  <a class="elementor-icon elementor-social-icon elementor-social-icon-twitter elementor-repeater-item-e076752" href="https://twitter.com/" target="_blank">
  <span class="elementor-screen-only">Twitter</span>
  <i class="fab fa-twitter"></i> </a>
  <a class="elementor-icon elementor-social-icon elementor-social-icon-youtube elementor-repeater-item-aa72c75" href="https://www.youtube.com/" target="_blank">
  <span class="elementor-screen-only">Youtube</span>
  <i class="fab fa-youtube"></i> </a>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <div class="elementor-element elementor-element-f52e3a7 elementor-column elementor-col-25 elementor-inner-column" data-id="f52e3a7" data-element_type="column">
  <div class="elementor-column-wrap  elementor-element-populated">
  <div class="elementor-widget-wrap">
  <div class="elementor-element elementor-element-034b981 elementor-widget elementor-widget-text-editor" data-id="034b981" data-element_type="widget" data-widget_type="text-editor.default">
  <div class="elementor-widget-container">
  <div class="elementor-text-editor elementor-clearfix">ADDRESS</div>
  </div>
  </div>
  <div class="elementor-element elementor-element-d755e5f elementor-widget elementor-widget-text-editor" data-id="d755e5f" data-element_type="widget" data-widget_type="text-editor.default">
  <div class="elementor-widget-container">
  <div class="elementor-text-editor elementor-clearfix">{{$settings[0]->address}}</div>
  </div>
  </div>
  </div>
  </div>
  </div>
  
  
  </div>
  </div>
  </div>
  <div class="elementor-element elementor-element-6ad1717 elementor-widget elementor-widget-divider" data-id="6ad1717" data-element_type="widget" data-widget_type="divider.default">
  <div class="elementor-widget-container">
  <div class="elementor-divider">
  <span class="elementor-divider-separator">
  </span>
  </div>
  </div>
  </div>
  <div class="elementor-element elementor-element-ef71c4d elementor-widget elementor-widget-text-editor" data-id="ef71c4d" data-element_type="widget" data-widget_type="text-editor.default">
  <div class="elementor-widget-container">
  <div class="elementor-text-editor elementor-clearfix">Copyright © <?php echo date('Y'); ?>. All Rights Reserved {{$settings[0]->site_name}}.</div>
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
  </footer>
  </div>
 
  

  <div class="foxuries-mobile-nav">
    
    @auth
    @if (Auth::user()->user_type == "admin" && Auth::user()->role == 1)
    <a href="{{ url('/admin_dashboard') }}/{{ Auth::user()->id }}" class="appao-btn mg-t button alt button-booking "><i class="fa fa-dashboard"></i> Dashbaord</a>   
    @else
    <a href="{{ url('/member_dashboard') }}/{{ Auth::user()->id }}" class="appao-btn mg-t button alt button-booking "><i class="fa fa-dashboard"></i> Dashbaord</a>   
    @endif
     
            @else
            <a class="appao-btn zoomInDown mg-t button alt button-booking" href="#" data-toggle="modal" data-target="#zoomInDown1">Sign In</a>
            @endauth

            
  
  <a href="#" class="mobile-nav-close"><i class="foxuries-icon-times"></i></a>
  <nav class="mobile-navigation" aria-label="Mobile Navigation">
   
  <div class="handheld-navigation">
<ul id="menu-foxuries-main-menu-1" class="menu">
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608 {{ request()->is('*/') ? 'current-menu-item' : '' }}">
<a href="{{ url('/') }}">Home</a>
  </li>

  <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608 {{ request()->is('resorts*') ? 'current-menu-item' : '' }}">
    <a href="{{ url('/resorts') }}">Resorts</a></li>
    
    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608 {{ request()->is('boats*') ? 'current-menu-item' : '' }}">
      <a href="{{ url('/boats') }}">Boats</a></li>
      
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608 {{ request()->is('services*') ? 'current-menu-item' : '' }}">
        <a href="{{ url('/services') }}">Services</a></li>

    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-608 {{ request()->is('shop*') ? 'current-menu-item' : '' }}">
        <a href="{{ url('/shop') }}">Shop</a></li>

        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home page_item page-item-73 current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-120 {{ request()->is('pages*') ? 'current-menu-item' : '' }}">
          <a href="#">Pages</a>
          <ul class="sub-menu">
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557 {{ request()->is('pages/about_us') ? 'current-menu-item' : '' }}">
              <a href="{{ url('pages/about_us') }}">About Us</a></li>
              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557 {{ request()->is('pages/blogs*') ? 'current-menu-item' : '' }}">
                <a href="{{ url('pages/blogs') }}">Blogs</a></li>
              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557 {{ request()->is('pages/contact') ? 'current-menu-item' : '' }}">
                <a href="{{ url('pages/contact') }}">Contact Us</a></li>
          </ul>
        </li>

        

  <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-557">
    <a href="">Book a Ride</a></li>

  </ul></div> </nav>


  <div class="foxuries-social">
    <ul>
    
    </ul>
    </div>
    <div class="phone-number-mobile">
      <a href="{{url('shop/cart')}}" class="cart-icon-link">
        <i class="ion ion-bag" style="font-size: 26px; font-weight: bold">
          <span class="badge badge-warning navbar-badge cart-counter" style="position: absolute; margin-left:-12px; background:crimson; color:snow">0</span>
        </i>
        
      </a>
    </div>

  
  
  
  </div>
  <div class="foxuries-overlay"></div>
  
  
  
  
  <link data-minify="1" rel="stylesheet" property="stylesheet" id="rs-icon-set-fa-icon-css" href="{{ asset('wp-content/cache/min/1/foxuries/wp-content/plugins/revslider/public/assets/fonts/font-awesome/css/font-awesome-0dcb085a38fb6e51ece3d95f068d1109.css') }}" type="text/css" media="all" />
  <script src="{{ asset('modal/modal/js/bootstrap.min.js') }}"></script>
<!-- meanmenu JS
    ============================================ -->

<script src="{{ asset('modal/modal/js/modal-active.js') }}"></script>


  <script type='text/javascript'>
  "use strict";var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||!1,descriptor.configurable=!0,"value"in descriptor&&(descriptor.writable=!0),Object.defineProperty(target,descriptor.key,descriptor)}}return function(Constructor,protoProps,staticProps){return protoProps&&defineProperties(Constructor.prototype,protoProps),staticProps&&defineProperties(Constructor,staticProps),Constructor}}();function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor))throw new TypeError("Cannot call a class as a function")}var RocketBrowserCompatibilityChecker=function(){function RocketBrowserCompatibilityChecker(options){_classCallCheck(this,RocketBrowserCompatibilityChecker),this.passiveSupported=!1,this._checkPassiveOption(this),this.options=!!this.passiveSupported&&options}return _createClass(RocketBrowserCompatibilityChecker,[{key:"_checkPassiveOption",value:function(self){try{var options={get passive(){return!(self.passiveSupported=!0)}};window.addEventListener("test",null,options),window.removeEventListener("test",null,options)}catch(err){self.passiveSupported=!1}}},{key:"initRequestIdleCallback",value:function(){!1 in window&&(window.requestIdleCallback=function(cb){var start=Date.now();return setTimeout(function(){cb({didTimeout:!1,timeRemaining:function(){return Math.max(0,50-(Date.now()-start))}})},1)}),!1 in window&&(window.cancelIdleCallback=function(id){return clearTimeout(id)})}},{key:"isDataSaverModeOn",value:function(){return"connection"in navigator&&!0===navigator.connection.saveData}},{key:"supportsLinkPrefetch",value:function(){var elem=document.createElement("link");return elem.relList&&elem.relList.supports&&elem.relList.supports("prefetch")&&window.IntersectionObserver&&"isIntersecting"in IntersectionObserverEntry.prototype}},{key:"isSlowConnection",value:function(){return"connection"in navigator&&"effectiveType"in navigator.connection&&("2g"===navigator.connection.effectiveType||"slow-2g"===navigator.connection.effectiveType)}}]),RocketBrowserCompatibilityChecker}();
  </script>
  <script type='text/javascript'>
  (function() {
  "use strict";var e=function(){function n(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}return function(e,t,r){return t&&n(e.prototype,t),r&&n(e,r),e}}();function n(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var t=function(){function r(e,t){n(this,r),this.attrName="data-rocketlazyloadscript",this.browser=t,this.options=this.browser.options,this.triggerEvents=e,this.userEventListener=this.triggerListener.bind(this)}return e(r,[{key:"init",value:function(){this._addEventListener(this)}},{key:"reset",value:function(){this._removeEventListener(this)}},{key:"_addEventListener",value:function(t){this.triggerEvents.forEach(function(e){return window.addEventListener(e,t.userEventListener,t.options)})}},{key:"_removeEventListener",value:function(t){this.triggerEvents.forEach(function(e){return window.removeEventListener(e,t.userEventListener,t.options)})}},{key:"_loadScriptSrc",value:function(){var r=this,e=document.querySelectorAll("script["+this.attrName+"]");0!==e.length&&Array.prototype.slice.call(e).forEach(function(e){var t=e.getAttribute(r.attrName);e.setAttribute("src",t),e.removeAttribute(r.attrName)}),this.reset()}},{key:"triggerListener",value:function(){this._loadScriptSrc(),this._removeEventListener(this)}}],[{key:"run",value:function(){RocketBrowserCompatibilityChecker&&new r(["keydown","mouseover","touchmove","touchstart"],new RocketBrowserCompatibilityChecker({passive:!0})).init()}}]),r}();t.run();
  }());
  </script>
  <script type='text/javascript'>
  /* <![CDATA[ */
  //var RocketPreloadLinksConfig = {"excludeUris":"\/foxuries(\/(.+\/)?feed\/?.+\/?|\/(?:.+\/)?embed\/|\/(index\\.php\/)?wp\\-json(\/.*|$))|\/wp-admin\/|\/logout\/|\/wp-login.php","usesTrailingSlash":"1","imageExt":"jpg|jpeg|gif|png|tiff|bmp|webp|avif","fileExt":"jpg|jpeg|gif|png|tiff|bmp|webp|avif|php|pdf|html|htm","siteUrl":"https:\/\/demo.inspithemes.com\/foxuries","onHoverDelay":"100","rateThrottle":"3"};
  /* ]]> */
  </script>
  <script type='text/javascript'>
  (function() {
  "use strict";var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e=function(){function i(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}}();function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var t=function(){function n(e,t){i(this,n),this.browser=e,this.config=t,this.options=this.browser.options,this.prefetched=new Set,this.eventTime=null,this.threshold=1111,this.numOnHover=0}return e(n,[{key:"init",value:function(){!this.browser.supportsLinkPrefetch()||this.browser.isDataSaverModeOn()||this.browser.isSlowConnection()||(this.regex={excludeUris:RegExp(this.config.excludeUris,"i"),images:RegExp(".("+this.config.imageExt+")$","i"),fileExt:RegExp(".("+this.config.fileExt+")$","i")},this._initListeners(this))}},{key:"_initListeners",value:function(e){-1<this.config.onHoverDelay&&document.addEventListener("mouseover",e.listener.bind(e),e.listenerOptions),document.addEventListener("mousedown",e.listener.bind(e),e.listenerOptions),document.addEventListener("touchstart",e.listener.bind(e),e.listenerOptions)}},{key:"listener",value:function(e){var t=e.target.closest("a"),n=this._prepareUrl(t);if(null!==n)switch(e.type){case"mousedown":case"touchstart":this._addPrefetchLink(n);break;case"mouseover":this._earlyPrefetch(t,n,"mouseout")}}},{key:"_earlyPrefetch",value:function(t,e,n){var i=this,r=setTimeout(function(){if(r=null,0===i.numOnHover)setTimeout(function(){return i.numOnHover=0},1e3);else if(i.numOnHover>i.config.rateThrottle)return;i.numOnHover++,i._addPrefetchLink(e)},this.config.onHoverDelay);t.addEventListener(n,function e(){t.removeEventListener(n,e,{passive:!0}),null!==r&&(clearTimeout(r),r=null)},{passive:!0})}},{key:"_addPrefetchLink",value:function(i){return this.prefetched.add(i.href),new Promise(function(e,t){var n=document.createElement("link");n.rel="prefetch",n.href=i.href,n.onload=e,n.onerror=t,document.head.appendChild(n)}).catch(function(){})}},{key:"_prepareUrl",value:function(e){if(null===e||"object"!==(void 0===e?"undefined":r(e))||!1 in e||-1===["http:","https:"].indexOf(e.protocol))return null;var t=e.href.substring(0,this.config.siteUrl.length),n=this._getPathname(e.href,t),i={original:e.href,protocol:e.protocol,origin:t,pathname:n,href:t+n};return this._isLinkOk(i)?i:null}},{key:"_getPathname",value:function(e,t){var n=t?e.substring(this.config.siteUrl.length):e;return n.startsWith("https://demo.inspithemes.com/")||(n="/"+n),this._shouldAddTrailingSlash(n)?n+"/":n}},{key:"_shouldAddTrailingSlash",value:function(e){return this.config.usesTrailingSlash&&!e.endsWith("https://demo.inspithemes.com/")&&!this.regex.fileExt.test(e)}},{key:"_isLinkOk",value:function(e){return null!==e&&"object"===(void 0===e?"undefined":r(e))&&(!this.prefetched.has(e.href)&&e.origin===this.config.siteUrl&&-1===e.href.indexOf("?")&&-1===e.href.indexOf("#")&&!this.regex.excludeUris.test(e.href)&&!this.regex.images.test(e.href))}}],[{key:"run",value:function(){"undefined"!=typeof RocketPreloadLinksConfig&&new n(new RocketBrowserCompatibilityChecker({capture:!0,passive:!0}),RocketPreloadLinksConfig).init()}}]),n}();t.run();
  }());
  </script>
  <script type='text/javascript'>
  var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","downloadImage":"Download image"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"version":"2.9.9","urls":{"assets":"{{ asset('/') }}"},"settings":{"page":[],"general":{"elementor_stretched_section_container":"body","elementor_global_image_lightbox":"yes","elementor_lightbox_enable_counter":"yes","elementor_lightbox_enable_fullscreen":"yes","elementor_lightbox_enable_zoom":"yes","elementor_lightbox_enable_share":"yes","elementor_lightbox_title_src":"title","elementor_lightbox_description_src":"description"},"editorPreferences":[]},"post":{"id":73,"title":"{{ config('app.name', 'Laravel') }}","excerpt":"","featuredImage":false}};
  </script>
  

  
  