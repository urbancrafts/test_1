

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('News Letter')); ?></div>

                <div class="card-body">
    
<form action="<?php echo e(action('App\Http\Controllers\PagesController@SendNewsLetter')); ?>" method="POST">
   <?php echo csrf_field(); ?>
    <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Enter title" />
    <input type="hidden" class="form-control" name="poster" value="<?php echo e(Auth::user()->name); ?>" />
    <input type="hidden" class="form-control" name="sender" value="<?php echo e(Auth::user()->email); ?>" />
    
</div>
<div class="form-group">
    <label> Content</label>
    <textarea class="form-control" name="content" placeholder="Enter your content here"></textarea>
    
</div>

<button type="submit" class="btn btn-primary">Send</button>
<br />
<input type="checkbox" id="select-all" onselect="selectAll(this.id)">Select All
<?php if(count($newsLetters) > 0): ?>

    <?php $__currentLoopData = $newsLetters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cnt cnt-body">
           
            <?php if($news->active == 0): ?>
    <input type="checkbox" disabled value="">
            <?php else: ?>
    <input type="checkbox" id="news-email" name="news-email" value="<?php echo e($news->email); ?>">
            <?php endif; ?>
            
         <a href="mailto:<?php echo e($news->email); ?>"> <?php echo e($news->email); ?> </a>
         
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

</form>
</div>
</div>
</div>
</div>
</div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/news-letter.blade.php ENDPATH**/ ?>