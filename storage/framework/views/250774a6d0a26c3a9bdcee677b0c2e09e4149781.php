

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    
    
		<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('inc.dashboard-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Notification
        <small><?php echo e($notifications[0]->note_type); ?></small>
      </h1>
     
    </section>

    <!-- Main content -->
    

    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <?php if(count($notifications) > 0): ?>
             
            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
            <!-- timeline time label -->
            
              
                  
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <?php if($notification->note_type == "Payment Transaction"): ?>
              <i class="fa fa-money bg-blue"></i>
              <?php elseif($notification->note_type == "Membership Subscription"): ?>
              <i class="fa fa-user bg-aqua"></i>
              <?php elseif($notification->note_type == "Blog Comment"): ?>
              <i class="fa fa-comments bg-yellow"></i>
              <?php elseif($notification->note_type == "Welcome"): ?> 
              <i class="fa fa-users bg-blue"></i>
              <?php endif; ?>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo e($notification->created_at); ?></span>
                 
                <h3 class="timeline-header"><?php echo e($notification->note_type); ?></h3>

                <div class="timeline-body">
                  <?php echo $notification->msg; ?>

                </div>
                
              </div>
            </li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php else: ?>
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                

                <h3 class="timeline-header">No Notification</h3>

                <div class="timeline-body">
                  You do not have any notification at this time
                </div>
                
              </div>
            </li>
            <?php endif; ?>
            
            
            
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

     

    </section>


    <!-- /.content -->
  </div>




        <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('bower_components/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- Morris.js charts -->
<script src="<?php echo e(asset('bower_components/raphael/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/morris.js/morris.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo e(asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('bower_components/jquery-knob/dist/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('bower_components/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<!-- datepicker -->
<script src="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo e(asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo e(asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('bower_components/fastclick/lib/fastclick.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('dist/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>

</body>
</html>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/notifications.blade.php ENDPATH**/ ?>