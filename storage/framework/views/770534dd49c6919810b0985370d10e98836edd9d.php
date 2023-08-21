

<?php $__env->startSection('content'); ?>
<?php if(count($services) > 0): ?>

    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Update Service')); ?></div>

                <div class="card-body">
    
<form action="<?php echo e(action('App\Http\Controllers\PagesController@updateService')); ?>" method="POST" enctype="multipart/form-data">
   <?php echo csrf_field(); ?>
    <div class="form-group">
    <label>Service Name</label>
    <input type="text" class="form-control" name="service-name" value="<?php echo e($service->name); ?>" placeholder="Enter Service name" />
    <input type="hidden" class="form-control" name="service-id" value="<?php echo e($service->id); ?>" />
    
</div>
<div class="form-group">
    <label>About Service</label>
    <textarea class="form-control" name="content" placeholder="Enter a brief info about the service here">
        <?php echo e($service->content); ?>

    </textarea>
    
</div>

<div class="form-group">
    <input type="file" name="serv-img" id="serv-img" />
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>
</div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/edit-service.blade.php ENDPATH**/ ?>