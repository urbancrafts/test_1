


<?php $__env->startSection('content'); ?>

</head>
<body class="blog wp-embed-responsive has-post-thumbnail foxuries-footer-builder elementor-default">
  <?php echo $__env->make('inc.header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  
   
 
    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    
    <?php if(count($blogs) > 0): ?>
    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <article id="post-29" class="post-29 post type-post status-publish format-standard has-post-thumbnail hentry category-apartment category-vacation tag-accommodation tag-apartment tag-hotel tag-reservation tag-resort tag-travel">
 
      <?php if($blog->media != ""): ?>
      <img width="1000" height="565" src="<?php echo e(asset('storage/img/users/'.$blog->user_id.'/blog/'.$blog->media)); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /> 
      <?php endif; ?>
      <header class="entry-header">
      <h2 class="alpha entry-title">
      <a href="<?php echo e(url('blog/'.$blog->id)); ?>" rel="bookmark"><?php echo e($blog->title); ?></a></h2> 
      <div class="entry-meta">
      <span class="posted-on">On <a href="<?php echo e(url('blog/'.$blog->id)); ?>" rel="bookmark"><time class="entry-date published" datetime="<?php echo e($blog->created_at); ?>"><?php echo e($blog->created_at); ?></time></a></span> <span class="post-author">Posted by <a href="#" rel="author"><?php echo e($blog->name); ?></a></span><span class="categories-link">In <a href="#" rel="category tag"><?php echo e($blog->category); ?></a></span> </div>
      </header>
      <div class="entry-content">
        <?php echo $blog->cnt; ?>

    <p><span class="more-link-wrap"> <a href="<?php echo e(url('blog/'.$blog->id)); ?>" class="more-link">Read More </a></span></p>
      </div> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <?php else: ?>
        <h3>There's no blog post created for this category yet.</h3>
    <?php endif; ?>
    

    
   
    </main>
    </div>
    <div id="secondary" class="widget-area" role="complementary">
    <div id="recent-posts-2" class="widget widget_recent_entries"> <span class="gamma widget-title">Recent Posts</span> <ul>
    
      <?php $__currentLoopData = $blogs2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
      <li>
        <div class="recent-posts-thumbnail">
        <a href="<?php echo e(url('blog/'.$blog2->id)); ?>">
        <?php if($blog2->media != ""): ?>
         <img width="75" height="65" src="<?php echo e(asset('storage/img/users/'.$blog2->user_id.'/blog/'.$blog2->media)); ?>" class="attachment-foxuries-recent-post size-foxuries-recent-post wp-post-image" alt="" /> </a>
        <?php endif; ?>
        </div>
        <div class="recent-posts-info">
        <a class="post-title" href="<?php echo e(url('blog/'.$blog2->id)); ?>"><span><?php echo e($blog2->title); ?></span></a>
        <span class="post-comments"></span> </div>
        </li>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      

    
    </ul>
    </div>
   </div>
    </div>
    </div>
  
 
    <?php echo $__env->make('inc.footer1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="<?php echo e(asset('wp-content/cache/min/1/802f9abd09c8534008aa9a699e0f5ce7.js')); ?>" data-minify="1" defer></script>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SONY\Desktop\beach_comber\resources\views/pages/blog.blade.php ENDPATH**/ ?>