<!-- about section start -->
<section class="about-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>About <?php echo e(config('app.name', 'Laravel')); ?><span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    <p>See a brief info about us and who we are.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($content->value); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
    </div>
</section><!-- about section end --><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/pages/index-about-field.blade.php ENDPATH**/ ?>