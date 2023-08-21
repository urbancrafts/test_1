

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
    </head>
    <body class="page-template page-template-elementor_header_footer page page-id-569 wp-embed-responsive foxuries-full-width-content foxuries-footer-builder elementor-default elementor-template-full-width elementor-kit-75 elementor-page elementor-page-569">    
		<?php echo $__env->make('inc.header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<div id="page" class="hfeed site">



            
            <div class="foxuries-breadcrumb">
                
                
            </div>
                <div id="content" class="site-content" tabindex="-1">
                <div class="col-full">
                <div data-elementor-type="wp-page" data-elementor-id="569" class="elementor elementor-569" data-elementor-settings="[]">
                <div class="elementor-inner">
                <div class="elementor-section-wrap">
                <div class="elementor-element elementor-element-498ac01 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="498ac01" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-background-overlay"></div>
                <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-row">
                <div class="elementor-element elementor-element-e634fa2 elementor-column elementor-col-50 elementor-top-column" data-id="e634fa2" data-element_type="column">
                <div class="elementor-column-wrap  elementor-element-populated">
                <div class="elementor-widget-wrap">
                <div class="elementor-element elementor-element-023f373 elementor-widget elementor-widget-heading" data-id="023f373" data-element_type="widget" data-widget_type="heading.default">
                <div class="elementor-widget-container">
                <h1 class="elementor-heading-title elementor-size-default">
                
                    <?php echo e($settings[0]->site_name); ?>

                  
                </h1> </div>
                </div>
                <div class="elementor-element elementor-element-82dee8c elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="82dee8c" data-element_type="widget" data-widget_type="text-editor.default">
                <div class="elementor-widget-container">
                <div class="elementor-text-editor elementor-clearfix">
                <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($content->name == "membership_signup"): ?>
                    <?php echo e($content->value); ?>

                <?php endif; ?>                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
                </div>
                </div>
                
                
                </div>
                </div>
                </div>
                
                <div class="elementor-element elementor-element-2205447 elementor-column elementor-col-50 elementor-top-column" data-id="2205447" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-column-wrap  elementor-element-populated">
                <div class="elementor-widget-wrap">
                <div class="elementor-element elementor-element-c940480 elementor-widget elementor-widget-heading" data-id="c940480" data-element_type="widget" data-widget_type="heading.default">
                 <div class="elementor-widget-container">
                <h1 class="elementor-heading-title elementor-size-default">Membership Signup</h1> </div>
                </div>
                
                <div class="elementor-element elementor-element-46d032b elementor-widget elementor-widget-foxuries-contactform" data-id="46d032b" data-element_type="widget" data-widget_type="foxuries-contactform.default">
                <div class="elementor-widget-container">
                <div role="form" class="wpcf7" id="wpcf7-f5-p569-o1" lang="en-US" dir="ltr">
                <div class="screen-reader-response" role="alert" aria-live="polite"></div>
                <form action="<?php echo e(action('App\Http\Controllers\API\RegisterController@register')); ?>" method="post" class="wpcf7-form init" id="mem_signup">
                
                
                    <div><span class="wpcf7-form-control-wrap your-name">
                    <select id="title" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required">
                    <option value="Mr." selected>Mr.</option>
                    <option value="Miss.">Miss.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Dr.">Dr.</option>
                    
                    </select>
                    </span></div> 
                <div><span class="wpcf7-form-control-wrap your-name"><input type="text" name="name" id="name"  size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" placeholder="Your name" /></span></div>
                <div class="row">
                <div class="column-6"><span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" id="email" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" placeholder="Email" /></span></div>
                <div class="column-6"><span class="wpcf7-form-control-wrap phone-number"><input type="tel" name="phone" id="phone" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" placeholder="phone number" /></span></div>
                </div>
                <div><span class="wpcf7-form-control-wrap your-subject"><input type="password" name="password" id="pass"  size="40" class="wpcf7-form-control wpcf7-text" placeholder="Password" /></span></div>
                <div><span class="wpcf7-form-control-wrap your-subject"><input type="password" name="cpassword" id="cpass"  size="40" class="wpcf7-form-control wpcf7-text" placeholder="Confirm password" /></span></div>
                
                <div><span class="wpcf7-form-control-wrap your-name">
                    <select id="user_type" name="user_type" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required">
                    <option value="member" selected>Club Member</option>
                    <option value="resort_owner">Resort Owner</option>
                    <option value="boat_owner">Boat Owner</option>
                    <option value="other_services">Other Services</option>
                    </select>
                    </span></div>
                <div><span><input type="checkbox" id="terms" style="right:80px !important;"  />Check this box to read and agree with our terms and conditions</span></div>
                <div class="terms-element">
                 <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if($content->name == "membership_terms"): ?>
                      <?php echo $content->value; ?>

                      <?php endif; ?>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                </div>
                <div><button type="submit" class=" button alt btn req-btn" id="register-btn"><i class="foxuries-icon-long-arrow-right"></i><span>Signup</span></button></div><br />
               <div> <span class="alert alert-danger register-error" style="display: none"></span><span class="alert alert-success register-success" style="display: none"></span></div>
            </form>
        
        </div> </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="elementor-element elementor-element-63fa781 elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="63fa781" data-element_type="section" data-settings="{&quot;stretch_section&quot;:&quot;section-stretched&quot;}">
                <div class="elementor-container elementor-column-gap-no">
                <div class="elementor-row">
                <div class="elementor-element elementor-element-502d148 elementor-column elementor-col-100 elementor-top-column" data-id="502d148" data-element_type="column">
                <div class="elementor-column-wrap  elementor-element-populated">
                
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                
    
    
            <?php echo $__env->make('inc.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <script src="<?php echo e(asset('wp-content/cache/min/1/26ca0b884dacc351c317d05fa6222447.js')); ?>" data-minify="1" defer></script>
            <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/auth/signup.blade.php ENDPATH**/ ?>