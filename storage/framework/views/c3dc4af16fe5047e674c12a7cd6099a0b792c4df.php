

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Create Blog')); ?></div>

                <div class="card-body">
    
<form action="<?php echo e(action('App\Http\Controllers\PagesController@postBlog')); ?>" method="POST" enctype="multipart/form-data">
   <?php echo csrf_field(); ?>
    <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Enter blog title" />
    <input type="hidden" class="form-control" name="poster" value="<?php echo e(Auth::user()->name); ?>" />
    <input type="hidden" class="form-control" name="poster_id" value="<?php echo e(Auth::user()->id); ?>" />
</div>
<div class="form-group">
    <label>Blog Content</label>
    <textarea class="form-control" name="content" placeholder="Enter your content here"></textarea>
    
</div>

<div class="form-group">
    <input type="file" name="blog-img" id="blog-img" />
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>
<br />

<?php if(count($blogs) > 0): ?>

    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="well cnt cnt-body">
            <div class="row center">
            <div class="col-md-4 col-sm-4">
             <img style="width: 100%" src="<?php echo e(asset('storage/img/blog/'.$blog->blog_img)); ?>" />
            </div>
            <div class="col-md-4 col-sm-4">
                <h4><?php echo e($blog->title); ?></h4>
                <?php echo e($blog->cnt); ?> 
                <small><?php echo e($blog->created_at); ?>  |  <a href="<?php echo e(url('dashoard/delete_blog/'.$blog->id)); ?>"> Delete </a></small>
            </div>

            </div>
         
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
       
   <?php else: ?>
       <p>No blog post found</p>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/dashboard.blade.php ENDPATH**/ ?>