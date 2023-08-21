<!-- team section start -->
<section class="team-area ptb-90" id="team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>Meet Our Team<span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <?php if( count($users) > 0): ?>

           <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="col-lg-3 col-sm-6">
            <div class="single-team-member">
                <div class="team-member-img">
                    <img src="<?php echo e(asset('storage/'.$user->email.'/'.$user->img)); ?>" alt="team">
                    <div class="team-member-icon">
                        <div class="display-table">
                            <div class="display-tablecell">
                                <a href="<?php echo e($user->facebook); ?>"><i class="icofont icofont-social-facebook"></i></a>
                                <a href="<?php echo e($user->twitter); ?>"><i class="icofont icofont-social-twitter"></i></a>
                                <a href="<?php echo e($user->linkedin); ?>"><i class="icofont icofont-brand-linkedin"></i></a>
                                <a href="<?php echo e($user->instagram); ?>"><i class="icofont icofont-social-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-member-info">
                    <a href="#"><h4><?php echo e($user->name); ?></h4></a>
                    <p><?php echo e($user->profession); ?></p>
                </div>
            </div>
        </div>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

            <?php endif; ?>
            
            
        </div>
    </div>
</section><!-- team section end --><?php /**PATH C:\xampp\htdocs\pignus_v1\resources\views/pages/index-team-field.blade.php ENDPATH**/ ?>