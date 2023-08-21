<!-- google map area end -->

<div id="zoomInDown1" class="modal modal-adminpro-general modal-zoomInDown fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="modal-login-form-inner">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="basic-login-inner modal-basic-inner">
                                <h3>Make a service request</h3>
                                
                                <form id="model-request-form" action="<?php echo e(action('App\Http\Controllers\PagesController@postServiceRequest')); ?>" method="POST">
                                
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="login2">Name:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" id="name" class="form-control" placeholder="Full Name" name="name"   />
                                                <span class="require-name"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="login2">Email:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="email" id="email" class="form-control" placeholder="Email Address" name="email" />
                                                <span class="require-email"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="login2">Phone No:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" id="phone" class="form-control" placeholder="Phone Number" name="phone" />
                                                <span class="require-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group-inner">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="login2">Service:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select id="services" name="services" >
                                                    <option value="" disabled selected>Select a service</option>
                                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <option value="<?php echo e($service->id); ?>"><?php echo e($service->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <select id="sub-services" name="subService">
                                                    <option value="" disabled selected></option>
                                                </select>
                                                <span class="require-service"></span>
                                            </div>


                                            <div class="col-lg-4">
                                                <label class="login2">Note(Message):</label>
                                            </div>
                                            <div class="col-lg-8">
                                        
                                        <textarea id="note" name="note" ></textarea>
                                                
                                                <span class="require-note"></span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="login-btn-inner">
                                        
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-8">
                                                <div class="login-horizental">
                                                    <button class=" button alt" type="submit">Post Request</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            
                                            <span id="request-status"></span>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-8">

                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- footer section start -->
<footer class="footer" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-form">
                    <h4>Get in Touch</h4>
                    <p class="form-message"></p>
                    <form id="contact-form" action="<?php echo e(action('App\Http\Controllers\PagesController@makeContact')); ?>" method="POST">
                        <input type="text" name="name" placeholder="Enter Your Name" required>
                        <input type="email" name="email" placeholder="Enter Your Email" required>
                        <input type="text" name="subject" placeholder="Your Subject" required>
                        <textarea placeholder="Messege" name="message" required></textarea>
                        <button type="submit" name="submit">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-address">
                    <?php if(count($infos) > 0): ?>
				
				    <?php $__currentLoopData = $infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h4>Address</h4>
                    <p><?php echo e($info->address); ?></p>
                    <ul>
                        <li>
                            <div class="contact-address-icon">
                                <i class="icofont icofont-headphone-alt"></i>
                            </div>
                            <div class="contact-address-info">
                                <a href="callto:#"><?php echo e($info->phone); ?></a>
                                <a href="callto:#"><?php echo e($info->mobile); ?></a>
                            </div>
                        </li>
                        <li>
                            <div class="contact-address-icon">
                                <i class="icofont icofont-envelope"></i>
                            </div>
                            <div class="contact-address-info">
                                <a href="mailto:<?php echo e($info->email); ?>"><?php echo e($info->email); ?></a>
                            </div>
                        </li>
                        <li>
                            
                        </li>
                    </ul>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php endif; ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="subscribe-form">
                    <form action="<?php echo e(action('App\Http\Controllers\PagesController@newsLetter')); ?>" method="POST">
                        <input type="text" placeholder="Your email address here">
                        <button type="submit">Subcribe</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright-area">
                    <ul>
                        <li><a href="#"><i class="icofont icofont-social-facebook"></i></a></li>
                        <li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
                        <li><a href="#"><i class="icofont icofont-brand-linkedin"></i></a></li>
                        <li><a href="#"><i class="icofont icofont-social-pinterest"></i></a></li>
                        <li><a href="#"><i class="icofont icofont-social-google-plus"></i></a></li>
                    </ul>
                    <p>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright <script>document.write(new Date().getFullYear());</script> All rights reserved <?php echo e(config('app.name', 'Laravel')); ?> | 
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      <?php if(Route::has('login')): ?>
        
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(url('/home')); ?>">Home</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>">Admin Login</a>
            <?php endif; ?>
            <?php endif; ?>
</p>
                </div>
            </div>
        </div>
    </div>
</footer><!-- footer section end -->
<a href="#" class="scrollToTop">
    <i class="icofont icofont-arrow-up"></i>
</a>
<div class="switcher-area" id="switch-style">
    <div class="display-table">
        <div class="display-tablecell">
            <a class="switch-button" id="toggle-switcher"><i class="icofont icofont-wheel"></i></a>
            <div class="switched-options">
                <div class="config-title">Pages</div>
                <ul>
                    <li><a href="<?php echo e(url('/')); ?>">Home Page</a></li>
                    <li><a href="<?php echo e(url('/services')); ?>">Services</a></li>
                    <li><a href="<?php echo e(url('/blog')); ?>">Blod</a></li>
                </ul>
                
            
        </div>
    </div>
</div>
<!-- jquery main JS -->
<script src="<?php echo e(asset('modal/js/bootstrap.min.js')); ?>"></script>
<!-- meanmenu JS
    ============================================ -->

<script src="<?php echo e(asset('modal/js/modal-active.js')); ?>"></script>

<script src="<?php echo e(asset('modal/js/main.js')); ?>"></script>

<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<!-- Bootstrap JS -->
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<!-- Slick nav JS -->
<script src="<?php echo e(asset('js/jquery.slicknav.min.js')); ?>"></script>
<!-- Slick JS -->
<script src="<?php echo e(asset('js/slick.min.js')); ?>"></script>
<!-- owl carousel JS -->
<script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
<!-- Popup JS -->
<script src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script>
<!-- Counter JS -->
<script src="<?php echo e(asset('js/jquery.counterup.min.js')); ?>"></script>
<!-- Counterup waypoints JS -->
<script src="<?php echo e(asset('js/waypoints.min.js')); ?>"></script>
<!-- YTPlayer JS -->
<script src="<?php echo e(asset('js/jquery.mb.YTPlayer.min.js')); ?>"></script>
<!-- jQuery Easing JS -->
<script src="<?php echo e(asset('js/jquery.easing.1.3.js')); ?>"></script>
<!-- Gmap JS -->
<script src="<?php echo e(asset('js/gmap3.min.js')); ?>"></script>
<!-- Google map api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnKyOpsNq-vWYtrwayN3BkF3b4k3O9A_A"></script>
<!-- Custom map JS -->
<script src="<?php echo e(asset('js/custom-map.js')); ?>"></script>
<!-- WOW JS -->
<script src="<?php echo e(asset('js/wow-1.3.0.min.js')); ?>"></script>
<!-- Switcher JS -->
<script src="<?php echo e(asset('js/switcher.js')); ?>"></script>
<!-- main JS -->
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
<?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/inc/footer.blade.php ENDPATH**/ ?>