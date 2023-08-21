

<?php $__env->startSection('content'); ?>
<?php if(count($infos) > 0): ?>

<?php $__currentLoopData = $infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Site Info')); ?></div>

                <div class="card-body">
                    
                    <form method="POST" action="<?php echo e(action('App\Http\Controllers\PagesController@updateInfo')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Phone')); ?></label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" value="<?php echo e($info->phone); ?>" required autocomplete="phone" autofocus>

                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Phone')); ?></label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="mobile" value="<?php echo e($info->mobile); ?>" required autocomplete="mobile" autofocus>

                                <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e($info->email); ?>" required autocomplete="email">

                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Address" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Address')); ?></label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address" required autocomplete="address"><?php echo e($info->address); ?></textarea>

                                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facebook" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Facebook')); ?></label>

                            <div class="col-md-6">
                                <input id="facebook" type="text" class="form-control" name="facebook" value="<?php echo e($info->facebook); ?>" >

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="twitter" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Twitter')); ?></label>

                            <div class="col-md-6">
                                <input id="twitter" type="text" class="form-control" name="twitter" value="<?php echo e($info->twitter); ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="linkedin" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Linkedin')); ?></label>

                            <div class="col-md-6">
                                <input id="linkedin" type="text" class="form-control" name="linkedin" value="<?php echo e($info->linkedin); ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instagram" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Instagram')); ?></label>

                            <div class="col-md-6">
                                <input id="instagram" type="text" class="form-control" name="instagram" value="<?php echo e($info->instagram); ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="youtube" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Youtube')); ?></label>

                            <div class="col-md-6">
                                <input id="youtube" type="text" class="form-control " name="youtube" value="<?php echo e($info->youtube); ?>" >

                                
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Logo')); ?></label>

                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control" name="logo">
                                <?php if($info->logo != ""): ?>
                                    <img src="<?php echo e(asset('storage/img/logo/'.$info->logo)); ?>" width="100" />
                                <?php endif; ?>
                               
                            </div>

                            <label for="icon" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Icon')); ?></label>

                            <div class="col-md-6">
                                <input id="icon" type="file" class="form-control" name="icon">
                                <?php if($info->icon != ""): ?>
                                    <img src="<?php echo e(asset('storage/img/icon/'.$info->icon)); ?>" width="100" />
                                <?php endif; ?>
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="client" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Client Capacity')); ?></label>

                            <div class="col-md-6">
                                <input id="client" type="number" class="form-control " name="client" value="<?php echo e($info->client_capacity); ?>" >

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="project" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Projects Done')); ?></label>

                            <div class="col-md-6">
                                <input id="project" type="number" class="form-control " name="project" value="<?php echo e($info->project_done); ?>" >

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="award" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Award won')); ?></label>

                            <div class="col-md-6">
                                <input id="award" type="number" class="form-control " name="award" value="<?php echo e($info->awards); ?>" >

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="countries" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Countries Reached')); ?></label>

                            <div class="col-md-6">
                                <input id="countries" type="number" class="form-control " name="countries" value="<?php echo e($info->countries_reached); ?>" >

                                
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Update Info')); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/home/info.blade.php ENDPATH**/ ?>