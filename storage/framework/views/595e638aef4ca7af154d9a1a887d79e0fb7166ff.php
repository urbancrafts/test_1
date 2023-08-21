

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
        <style id='foxuries-style-inline-css' type='text/css'>
            div.foxuries-yacht{
              background-image: url(<?php echo e(asset('storage/img/bg/yacht_2.jpg')); ?>);
            }
            </style>
	</head>
  <body class="archive post-type-archive post-type-archive-hb_room wp-embed-responsive has-post-thumbnail foxuries-footer-builder elementor-default"> 
		<?php echo $__env->make('inc.header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
        <div class="foxuries-yacht foxuries-breadcrumb">
            <h1 class="breadcrumb-heading">
            Yacht	</h1>
            
        
          </div>



          

    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <ul class="rooms tp-hotel-booking hb-catalog-column-3">
    <?php if(count($services) > 0): ?>
    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
    <li id="room-<?php echo e($service->id); ?>" class="hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view">
    <div class="summary entry-summary">
    <div class="media">
    <a href="<?php echo e(url('service/'.$service->id)); ?>">
        <?php if($service->img != ""): ?>
        <img src="<?php echo e(asset('storage/img/services/'.$service->img)); ?>" width="500" height="575" alt="" /> </a>
        <?php endif; ?>
    
    </div>
    <div class="room-caption">
    <div class="title">
    <h4>
    <a href="<?php echo e(url('service/'.$service->id)); ?>"><?php echo e($service->title); ?></a>
    </h4>
    </div>
    <div class="room-meta"><span class="room-type"><span><a href="#"><?php echo e($service->about); ?></a></span></span></div>
    <?php if($service->price != ""): ?>
    <div class="price">
    <span class="title-price">Price</span>
    <span class="price_value price_min"><?php echo e($service->curr); ?><?php echo e($service->price); ?></span>
    <span class="unit"><?php echo e($service->duration); ?></span>
    </div>
    <?php endif; ?>
    <div class="rating">
    <div itemprop="reviewRating" itemscope itemtype="" class="star-rating" title="">
    <span style="width:80%"></span>
    </div>
    </div>
    <a href="<?php echo e(url('service/'.$service->id)); ?>" class="room-button"><i class="foxuries-icon-long-arrow-right"></i><span>See details</span></a> </div>
    </div>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php else: ?>

    <li><h2 align="center">There's no data created for yachts yet.</h2></li>
        
    <?php endif; ?>

    </ul>

  <?php if(count($services) > 9): ?>
    <nav class="rooms-pagination">
    <ul class='page-numbers'>
    <li><span aria-current="page" class="page-numbers current">1</span></li>
    <li><a class="page-numbers" href="<?php echo e(url('yacht?page')); ?>">2</a></li>
    <li><a class="next page-numbers" href="<?php echo e(url('yacht?page')); ?>">Next</a></li>
    </ul>
    </nav>
    <?php endif; ?>


    </div>
    </div>
    <?php echo $__env->make('inc.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('wp-content/cache/min/1/26ca0b884dacc351c317d05fa6222447.js')); ?>" data-minify="1" defer></script>
		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/pages/yacht.blade.php ENDPATH**/ ?>