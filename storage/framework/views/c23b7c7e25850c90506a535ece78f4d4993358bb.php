

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->



    </head>
    <body class="blog wp-embed-responsive has-post-thumbnail foxuries-footer-builder elementor-default">
	<?php echo $__env->make('inc.header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
        <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
        <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php if(count($blogs) > 0): ?>
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article id="post-<?php echo e($blog->id); ?>" class="post-29 post type-post status-publish format-standard has-post-thumbnail hentry category-apartment category-vacation tag-accommodation tag-apartment tag-hotel tag-reservation tag-resort tag-travel">
        <header class="entry-header">
        <div class="entry-meta">
        <span class="posted-on">On <a href="#" rel="bookmark"><time class="entry-date published" datetime="<?php echo e($blog->created_at); ?>"><?php echo e($blog->created_at); ?></time></a></span> <span class="post-author">Posted by <a href="#" rel="author"><?php echo e($blog->name); ?></a></span> </div>
        </header>
        <?php if($blog->media != ""): ?>
        <img width="1000" height="565" src="<?php echo e(asset('storage/img/users/'.$blog->user_id.'/blog/'.$blog->media)); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /> 
        <?php endif; ?>
        <div class="entry-content">
           <?php echo $blog->cnt; ?>

        </div>
        
       
        <section id="comments" class="comments-area" aria-label="Post Comments">
        <div class="comment-list-wrap">
        <h2 class="comments-title">
        <?php echo e(count($comments)); ?> Comments </h2>
        
        <ol class="comment-list">

        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
        <li class="comment even thread-even depth-1 parent" id="comment-2">
            <div class="comment-body">
            <div class="comment-meta commentmetadata">
            <div class="comment-author vcard">
            <?php if($comment->uid == $users[0]->id): ?>
            <?php if($users[0]->img != ""): ?>
            <img alt='' src='<?php echo e(asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->img)); ?>' srcset='<?php echo e(asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->img)); ?> 2x' class='avatar avatar-128 photo' height='128' width='128' /> 
            <?php else: ?>
            <img alt='' src='<?php echo e(asset('storage/img/users/default.png')); ?>' srcset='<?php echo e(asset('storage/img/users/default.png')); ?> 2x' class='avatar avatar-128 photo' height='128' width='128' /> 
            <?php endif; ?>
            <?php endif; ?>
            <cite class="fn"><?php echo e($comment->name); ?></cite> </div>
            <a href="index.html#comment-2" class="comment-date">
            <time datetime="<?php echo e($comment->created_at); ?>"><?php echo e($comment->created_at); ?></time> </a>
            </div>
            <div id="div-comment-2" class="comment-content">
            <div class="comment-text">
            <p><?php echo e($comment->cnt); ?></p>
            </div>
            
            </div>
            </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
       

        </ol>

        </div>
       
        </section>
        </article>

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
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/pages/blog-detail.blade.php ENDPATH**/ ?>