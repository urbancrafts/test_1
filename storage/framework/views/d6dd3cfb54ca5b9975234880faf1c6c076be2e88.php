

<?php $__env->startSection('content'); ?>
<?php if(count($services) > 0): ?>

    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($service->user == Auth::user()->email): ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e($service->name); ?> <?php echo e(__('SubService Form')); ?></div>

                <div class="card-body">
    
<form action="<?php echo e(action('App\Http\Controllers\PagesController@postSubService')); ?>" method="POST">
   <?php echo csrf_field(); ?>
    <div class="form-group">
    <label>SubService Name</label>
    <input type="text" class="form-control" name="service-name" placeholder="Enter Service name" />
    <input type="hidden" class="form-control" name="service-id" value="<?php echo e($service->id); ?>" />
    
</div>
<div class="form-group">
    <label>Portfolio URL(link)</label>
    <input type="text" class="form-control" name="service-link" placeholder="Enter your service link such as(http://...)" />
    
</div>


<button type="submit" class="btn btn-primary">Create</button>
</form>
</div>
</div>
</div>
</div>
</div>
<?php endif; ?>

<?php if(count($subServices) > 0): ?>

    <?php $__currentLoopData = $subServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
            
            </div>
            <div class="col-md-4 col-sm-4">
         <h4><a href="<?php echo e($subService->url); ?>"> <?php echo e($subService->name); ?> </a></h4>
       <small> <?php echo e($subService->url); ?> 
        <?php if($service->user == Auth::user()->email): ?>
         <a href="<?php echo e(url('dashboard/delete_sub_service/'.$subService->id)); ?>" class="btn btn-danger"> Delete </a></small>
        <?php endif; ?>        
    </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/sub-service.blade.php ENDPATH**/ ?>