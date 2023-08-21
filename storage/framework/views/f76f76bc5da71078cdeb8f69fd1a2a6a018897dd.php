

<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Create Service')); ?></div>

                <div class="card-body">
    
<form action="<?php echo e(action('App\Http\Controllers\PagesController@postService')); ?>" method="POST" enctype="multipart/form-data">
   <?php echo csrf_field(); ?>
    <div class="form-group">
    <label>Service Name</label>
    <input type="text" class="form-control" name="service-name" placeholder="Enter Service name" />
    <input type="hidden" class="form-control" name="user" value="<?php echo e(Auth::user()->email); ?>" />
    
</div>
<div class="form-group">
    <label>About Service</label>
    <textarea class="form-control" name="content" placeholder="Enter a brief info about the service here"></textarea>
    
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


<?php if(count($services) > 0): ?>

    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
                    <img style="width: 100%" src="<?php echo e(asset('storage/img/services/'.$service->tag)); ?>" />
            </div>
            <div class="col-md-4 col-sm-4">
         <h4><a href="<?php echo e(url('dashboard/services/'.$service->id)); ?>"> <?php echo e($service->name); ?> </a></h4>
         <?php echo e($service->content); ?> 
       <small> <?php echo e($service->user); ?> 
        <?php if($service->user == Auth::user()->email): ?>
        <a href="<?php echo e(url('dashboard/edit_service/'.$service->id)); ?>" class="btn btn-default"> Edit </a> | <a href="<?php echo e(url('dashboard/delete_service/'.$service->id)); ?>" class="btn btn-danger"> Delete </a></small>
        <?php endif; ?>        
    </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/services.blade.php ENDPATH**/ ?>