

<?php $__env->startSection('content'); ?>
<?php if(count($users) > 0): ?>
<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <?php if($user->img != ""): ?>
                        <img src="<?php echo e(asset('storage/img/users/'.$user->email.'/'.$user->img)); ?>" width="150" >
                    <?php endif; ?>
                    <?php echo e($user->name); ?>

                </div>

                <div class="card-body">
                    
                    <form method="POST" action="<?php echo e(action('App\Http\Controllers\PagesController@updateProfile')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="profession" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Profession/Role')); ?></label>

                            <div class="col-md-6">
                                <input id="profession" type="text" class="form-control" name="profession" value="<?php echo e($user->profession); ?>" >

                                
                            </div>
                        </div>

                        

                        

                        

                        <div class="form-group row">
                            <label for="facebook" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Facebook')); ?></label>

                            <div class="col-md-6">
                                <input id="facebook" type="text" class="form-control" name="facebook" value="<?php echo e($user->facebook); ?>" >

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="twitter" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Twitter')); ?></label>

                            <div class="col-md-6">
                                <input id="twitter" type="text" class="form-control" name="twitter" value="<?php echo e($user->twitter); ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="linkedin" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Linkedin')); ?></label>

                            <div class="col-md-6">
                                <input id="linkedin" type="text" class="form-control" name="linkedin" value="<?php echo e($user->linkedin); ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instagram" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Instagram')); ?></label>

                            <div class="col-md-6">
                                <input id="instagram" type="text" class="form-control" name="instagram" value="<?php echo e($user->instagram); ?>">

                            </div>
                        </div>

                        


                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Photo')); ?></label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">
                                
                               
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update Profile')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/profile.blade.php ENDPATH**/ ?>