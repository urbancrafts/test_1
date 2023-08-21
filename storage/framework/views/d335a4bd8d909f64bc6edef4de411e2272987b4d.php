

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
	    <div id="preloader"></div>
	<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- breadcrumb area start -->
<section class="hero-area breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero-area-content">
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h1><?php echo e($blog->title); ?></h1>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- blog section start -->
<section class="blog-detail" id="blog">
    <div class="container">
        <div class="row">

            <div class="col-lg-8">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="blog-details">
                    <img src="<?php echo e(asset('img/blog/'.$blog->blog_img)); ?>" alt="blog-details">
                    <div class="post-author">
                        <a href="#"><i class="icofont icofont-user"></i><?php echo e($blog->poster_name); ?></a>
                        
                        <a href="#"><i class="icofont icofont-calendar"></i><?php echo e($blog->created_at); ?></a>
                    </div>
                    <?php echo e($blog->cnt); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="blog-reply">
                    <h4>Leave a Reply</h4>
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="replyname" placeholder="Enter Your Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="replyemail" placeholder="Enter Your Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Messege" name="message"></textarea>
                                <button type="submit" name="replysubmit">Post Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="widget">
                        <form action="#">
                            <input type="text" name="search" placeholder="Search here">
                            <button type="submit">Go</button>
                        </form>
                    </div>
                    <div class="widget">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Networking</a></li>
                            <li><a href="#">Security</a></li>
                            <li><a href="#">Software</a></li>
                        </ul>
                    </div>
                    <div class="widget">
                        <h4>Latest posts</h4>
                        <ul>
                            <li><a href="#">Savings now offers checking account</a></li>
                            <li><a href="#">Facebook begins Stories on desktop</a></li>
                            <li><a href="#">Nintendo compatible NES30 Arcade now</a></li>
                        </ul>
                    </div>
                    <div class="widget widget-tags">
                        <h4>Tags</h4>
                        <a href="#">Business</a>
                        <a href="#">Networking</a>
                        <a href="#">Latest</a>
                        <a href="#">Popular</a>
                        <a href="#">Security</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- blog section end -->

<?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/pages/blog-detail.blade.php ENDPATH**/ ?>