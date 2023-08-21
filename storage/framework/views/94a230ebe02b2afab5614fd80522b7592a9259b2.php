

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Site Content')); ?></div>

                <div class="card-body">
    
<form action="<?php echo e(action('App\Http\Controllers\PagesController@updateContent')); ?>" method="POST">
   <?php echo csrf_field(); ?>
    <div class="form-group">
    <label>Field</label>
    <select id="cnt-name" name="cnt-name">
        <?php if(count($contents) > 0): ?>

        <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <option value="<?php echo e($content->name); ?>"><?php echo e($content->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>
    </select>

</div>
<div class="form-group">
    <label>Content</label>
    <textarea class="form-control" name="content" placeholder="Enter content here"></textarea>
    
</div>


<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/content.blade.php ENDPATH**/ ?>