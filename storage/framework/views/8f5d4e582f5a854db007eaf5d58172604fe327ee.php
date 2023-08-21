

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
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <img src="<?php echo e(asset('storage/img/services/'.$service->tag)); ?>" alt="feature">
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                      <h2>
                          <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php echo e($service->name); ?>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                      <p></p>
                  </div>
              </div>
          </div>
          <?php if(count($subServices) > 0): ?>
          <?php $__currentLoopData = $subServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="row flexbox-center">
              <div class="col-lg-6">
                  <div class="single-showcase-box">
                      <h4><?php echo e($service->name); ?></h4>
                      <p></p>
                      <a href="<?php echo e($service->url); ?>" class="appao-btn appao-btn2">Go to</a>
                  </div>
              </div>
              <div class="col-lg-6">
                  
              </div>
          </div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       <?php else: ?>
       <div class="row flexbox-center">
        <div class="col-lg-6">
            <div class="single-showcase-box">
                
                <p>Sorry, no service list created under this service yet.</p>
                
            </div>
        </div>
        <div class="col-lg-6">
            
        </div>
    </div>
       

   <?php endif; ?>
 

          
      </div>
  </section><!-- showcase section end -->
  
  
  
  
  
  <!-- google map area end -->

  <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/pages/service.blade.php ENDPATH**/ ?>