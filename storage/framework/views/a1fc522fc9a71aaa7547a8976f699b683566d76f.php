

<?php $__env->startSection('content'); ?>


<?php if(count($requests) > 0): ?>

    <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
                    
            </div>
            <div class="col-md-8 col-sm-8">
         <h4> <a href="<?php echo e(url('dashboard/service_request/'.$request->id)); ?>"> <?php echo e($request->service); ?> </a></h4> 
       <small> <?php echo e($request->name); ?>  -  <a href="mailto:<?php echo e($request->email); ?>"> <?php echo e($request->email); ?> </a> | <a href="<?php echo e(url('dashboard/delect_request/'.$request->id)); ?>"> Delete </a>
    - <?php echo e($request->created_at); ?> - <a href="<?php echo e(url('dashboard/service_request')); ?>"> <---Go Back </a>
    </small>
       <p><?php echo e($request->note); ?></p>        
        </div>
            
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/read-request.blade.php ENDPATH**/ ?>