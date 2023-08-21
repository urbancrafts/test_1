      

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
	    <div id="preloader"></div>
		<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- hero area start -->
		<section class="hero-area" id="home">
			<div class="hero-area-slider">
				<?php if(count($services) > 0): ?>
				
				    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
                    <div class="hero-area-single-slide">
						<div class="container">
							<div class="row">
								<div class="col-lg-7">
									<div class="hero-area-content">
										<h1><?php echo e($service->name); ?></h1>
										<p><?php echo e($service->content); ?></p>
										<a href="<?php echo e(url('services/'.$service->id)); ?>" class="appao-btn">Go To</a>
									</div>
								</div>
								<div class="col-lg-5">
									<div class="hand-mockup text-lg-left text-center">
										<img src="<?php echo e(asset('storage/img/services/'.$service->tag)); ?>" alt="Slide 1" />
									</div>
								</div>
	
						   </div>
						</div>
					</div>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php endif; ?>
				

							
							

			</div>
		</section><!-- hero area end -->
		<?php echo $__env->make('pages.index-about-field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('pages.index-service-field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- video section start -->
		<section class="video-area ptb-90">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
					    <div class="video-popup">
							<a href="https://www.youtube.com/watch?v=RZXnugbhw_4" class="popup-youtube"><i class="icofont icofont-ui-play"></i></a>
							<h1>View our youtube</h1>
						</div>
					</div>
				</div>
			</div>
		</section><!-- video section end -->
		
		<?php echo $__env->make('pages.index-testimonial-field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<?php echo $__env->make('pages.index-counter-field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<?php echo $__env->make('pages.index-team-field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
		<?php echo $__env->make('pages.index-blog-field', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- google map area start -->
		
		<?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/pages/index.blade.php ENDPATH**/ ?>