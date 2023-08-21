

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
                    <h1>Our Blog</h1>
                    
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- blog section start -->
<section class="blog-area blog-page" id="blog">
    <div class="container">
        <div class="row">

            <?php if( count($blogs) > 0): ?>

            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="single-post">
                    <div class="post-thumbnail">
                        <?php if($blog->blog_img != ""): ?>
                        <a href="<?php echo e(url('blog/'.$blog->id)); ?>"><img src="<?php echo e(asset('img/blog/'.$blog->blog_img)); ?>" alt="blog"></a>       
                        <?php endif; ?>
                        
                    </div>
                    <div class="post-details">
                        <div class="post-author">
                            <a href="blog-detail.html"><i class="icofont icofont-user"></i><?php echo e($blog->poster_name); ?></a>
                            
                            <a href="blog-detail.html"><i class="icofont icofont-calendar"></i><?php echo e($blog->created_at); ?></a>
                        </div>
                        <h4 class="post-title"><a href="#"><?php echo e($blog->title); ?></a></h4>
                        <p><?php echo e($blog->cnt); ?></p>
                    </div>
                </div>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                
            <?php else: ?>
            <h4>There're no blog contents create yet.</h4>    
            <?php endif; ?>

            
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                
            </div>
        </div>
    </div>
</section><!-- blog section end -->
  
  
  
  <!-- google map area end -->

  <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/pages/blog.blade.php ENDPATH**/ ?>