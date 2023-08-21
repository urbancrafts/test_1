

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->



    </head>
    <body class="blog wp-embed-responsive has-post-thumbnail foxuries-footer-builder elementor-default">
	<?php echo $__env->make('inc.header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
        <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
        <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            
        <?php if(count($users) > 0): ?>
      
       <?php echo e($users[0]->name); ?>  

        <?php endif; ?>
       
        
       

        </main>
        </div>
        
        

        </div>
        </div>

<?php echo $__env->make('inc.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('wp-content/cache/min/1/802f9abd09c8534008aa9a699e0f5ce7.js')); ?>" data-minify="1" defer></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/pages/user_activation.blade.php ENDPATH**/ ?>