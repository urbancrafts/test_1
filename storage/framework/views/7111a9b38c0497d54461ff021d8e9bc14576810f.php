

<?php $__env->startSection('content'); ?>

<?php if(count($messages) > 0): ?>

    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cnt cnt-body">
            <div class="row center">
                <div class="col-md-4 col-sm-4">
                    
            </div>
            <div class="col-md-4 col-sm-4">
         <h4> <a href="<?php echo e(url('dashboard/messages/'.$message->id)); ?>"> <?php echo e($message->subject); ?> </a></h4> 
       <small> <?php echo e($message->name); ?>  | <a href="mailto:<?php echo e($message->email); ?>"> <?php echo e($message->email); ?> </a> | <a href="<?php echo e(url('dashboard/delect_messages/'.$message->id)); ?>"> Delete </a></small>
            </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/messages.blade.php ENDPATH**/ ?>