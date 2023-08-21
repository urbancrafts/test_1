<!-- blog section start -->
<section class="blog-area ptb-90" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>Our Latest Blog<span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if( count($blogs) > 0): ?>

            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="single-post">
                    <div class="post-thumbnail">
                        <a href="<?php echo e(url('blog/'.$blog->id)); ?>"><img src="<?php echo e(asset('img/blog/'.$blog->blog_img)); ?>" alt="blog"></a>
                    </div>
                    <div class="post-details">
                        <div class="post-author">
                            <a href="#"><i class="icofont icofont-user"></i><?php echo e($blog->poster_name); ?></a>
                            
                            <a href="#"><i class="icofont icofont-calendar"></i><?php echo e($blog->created_at); ?></a>
                        </div>
                        <h4 class="post-title"><a href="blog.html"><?php echo e($blog->title); ?></a></h4>
                    <?php echo e($blog->cnt); ?>

                    </div>
                </div>
            </div>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

            <?php endif; ?>

        </div>
    </div>
</section><!-- blog section end --><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/pages/index-blog-field.blade.php ENDPATH**/ ?>