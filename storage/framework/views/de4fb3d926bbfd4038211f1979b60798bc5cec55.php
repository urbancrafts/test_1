

<?php $__env->startSection('content'); ?>
  <!-- Page loader -->
  <div id="preloader"></div>
  <?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  
  <!-- feature section start -->
<section class="feature-area ptb-90" id="feature">
    <div class="container">
        <div class="row flexbox-center">
            <div class="col-lg-4">
                <div class="single-feature-box text-lg-right text-center">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature-box text-center">
                    <img src="<?php echo e(asset('img/slider/erp1.jpg')); ?>" alt="feature">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature-box text-lg-left text-center">
                    
                </div>
            </div>
        </div>
    </div>
</section><!-- feature section end -->
<!-- showcase section start -->
<section class="showcase-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>Services<span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    <p>Check out the list of our services below.</p>
                </div>
            </div>
        </div>
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
               <?php if($service->id == 1): ?>
               <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <h4><?php echo e($service->name); ?></h4>
                        <p><?php echo e($service->content); ?> </p>
                        
                        <a href="<?php echo e(url('services/'.$service->id)); ?>" class="appao-btn appao-btn2">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <img src="<?php echo e(asset('img/slider/'.$service->tag)); ?>" alt="showcase">
                    </div>
                </div>
            </div>
               <?php endif; ?>
            <?php if($service->id == 2): ?>
            
            <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <img src="<?php echo e(asset('img/slider/'.$service->tag)); ?>" alt="showcase">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <h4><?php echo e($service->name); ?></h4>
                        <p><?php echo e($service->content); ?> </p>
                        <a href="<?php echo e(url('services/'.$service->id)); ?>" class="appao-btn appao-btn2">Read More</a>
                    </div>
                </div>
            </div>

            <?php endif; ?>
            
            <?php if($service->id == 3): ?>

            <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <h4><?php echo e($service->name); ?></h4>
                        <p><?php echo e($service->content); ?> </p>
                        <a href="<?php echo e(url('services/'.$service->id)); ?>" class="appao-btn appao-btn2">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <img src="<?php echo e(asset('img/slider/'.$service->tag)); ?>" alt="showcase">
                    </div>
                </div>
            </div>
                
            <?php endif; ?>

            <?php if($service->id == 4): ?>

            <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <img src="<?php echo e(asset('img/slider/'.$service->tag)); ?>" alt="showcase">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <h4><?php echo e($service->name); ?></h4>
                        <p><?php echo e($service->content); ?> </p>
                        <a href="<?php echo e(url('services/'.$service->id)); ?>" class="appao-btn appao-btn2">Read More</a>
                    </div>
                </div>
            </div>

            <?php endif; ?>


            <?php if($service->id == 5): ?>

            <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <h4><?php echo e($service->name); ?></h4>
                        <p><?php echo e($service->content); ?> </p>
                        <a href="<?php echo e(url('services/'.$service->id)); ?>" class="appao-btn appao-btn2">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <img src="<?php echo e(asset('img/slider/'.$service->tag)); ?>" alt="showcase">
                    </div>
                </div>
            </div>

            <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
       
    </div>
</section><!-- showcase section end -->
  
  
  
  
  <!-- google map area end -->

  <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/pages/services.blade.php ENDPATH**/ ?>