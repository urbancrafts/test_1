
<?php $__env->startSection('content'); ?>
		<!-- Page loader -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

      
  <?php echo $__env->make('inc.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->make('inc.dashboard-side-bar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>Site Settings</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
     
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" id="blog-body">
         
            <div class="card card-info">
                <div class="card-header">
                  
    
                  <h3 class="card-title"> <i class="fa fa-gear"></i>Update site settings</h3>
                  <!-- tools box -->
                  <div class="float-right card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <!-- /. tools -->
                </div>
                <div class="card-body">
                    <?php if($settings[0]->logo != ""): ?>
                        <img src="<?php echo e(asset('storage/img/site_logo/'.$settings[0]->logo)); ?>" width="150" height="90" />
                    <?php endif; ?>
                    <?php if($settings[0]->icon != ""): ?>
                        <img src="<?php echo e(asset('storage/img/site_icon/'.$settings[0]->icon)); ?>" width="150" height="90" />
                    <?php endif; ?>
                  <form id="settings-form" action="<?php echo e(action('App\Http\Controllers\AjaxRequestController@update_settings')); ?>" method="post" enctype="multipart/form-data">
                   
                   
                
                   <div class="form-group">
                        <span style="color: red; display: none" class="resort-curr-error">(*Required)</span>
                      <input type="text" class="form-control" id="curr" name="curr" value="<?php echo e($settings[0]->curr); ?>" placeholder="Currency" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-logo-error">(*Required)</span>
                      <input type="file" class="form-control" id="logo" name="logo"  title="browse for site logo" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-icon-error">(*Required)</span>
                      <input type="file" class="form-control" id="icon" name="icon"  title="browse for site icon" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-leng-error">(*Required)</span>
                      <input type="text" class="form-control" id="lang" name="lang" value="<?php echo e($settings[0]->language); ?>" placeholder="Language" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-tel-error">(*Required)</span>
                        <input type="number" class="form-control" id="tel" name="tel" value="<?php echo e($settings[0]->tel); ?>" placeholder="Tel" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-mobile-error"></span>
                        <input type="number" class="form-control" id="mobile" name="mobile" value="<?php echo e($settings[0]->mobile); ?>" placeholder="Mobile number" >
                      </div>
                      
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-email-error"></span>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo e($settings[0]->email); ?>" placeholder="Email address" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-address-error"></span>
                        <textarea class="form-control" id="address" name="address" placeholder="Office address"><?php echo e($settings[0]->address); ?></textarea>
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-payment-error"></span>
                        <select id="payment-type" name="payment-type" class="form-control">
                            <?php if($settings[0]->payment_type != ""): ?>
                            <option value="<?php echo e($settings[0]->payment_type); ?>"><?php echo e($settings[0]->payment_type); ?></option>
                                
                            <?php else: ?>
                            <option disabled selected>payment type</option>
                            <?php endif; ?>
                            <?php if($settings[0]->payment_type == "mobile"): ?>
                            <option value="web">web</option>  
                            <?php endif; ?>
                            <?php if($settings[0]->payment_type == "web"): ?>
                            <option value="mobile">mobile</option> 
                            <?php endif; ?>
                            
                            
                        </select>
                      </div>
                        
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-discount-error"></span>
                        <input type="number" class="form-control" id="discount" name="discount" value="<?php echo e($settings[0]->memb_discount); ?>" placeholder="Members discount by percent(%)" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-discount-error"></span>
                        <input type="number" class="form-control" id="credit" name="credit" value="<?php echo e($settings[0]->memb_debt_capacity); ?>" placeholder="Members credit limit" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-mem-fee-error"></span>
                        <input type="number" class="form-control" id="mem_fee" name="mem_fee" value="<?php echo e($settings[0]->membership_fee); ?>" placeholder="Membership fee" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-fb-error"></span>
                        <input type="text" class="form-control" id="fb" name="fb" value="<?php echo e($settings[0]->facebook); ?>" placeholder="Facebook pages" >
                      </div>
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-insta-error"></span>
                        <input type="text" class="form-control" id="insta" name="insta" value="<?php echo e($settings[0]->instagram); ?>" placeholder="Instagram page" >
                      </div>
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-twitter-error"></span>
                        <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo e($settings[0]->twitter); ?>" placeholder="Twitter handle" >
                      </div>
                       
                      

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-sname-error"></span>
                        <input type="text" class="form-control" id="site-name" name="site-name" value="<?php echo e($settings[0]->site_name); ?>" placeholder="Site name" >
                      </div>
                      <div class="form-group">
                      <?php if($settings[0]->status == 1): ?>
                      <input type="radio" name="status" id="status" value="1"  checked><label>On</label> <input type="radio" name="status" id="status" value="0"><label>Off</label>   
                      <?php elseif($settings[0]->status == 0): ?>  
                      <input type="radio" name="status" id="status" value="1" ><label>On</label> <input type="radio" name="status" id="status" value="0" checked><label>Off</label>      
                      <?php endif; ?>
                      </div>
                    <div class="card-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default" id="sendEmail">Update
                        <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                   <span class="alert alert-danger blog-alert-danger" style="display: none"></span><span class="alert alert-success blog-alert-success" style="display: none"></span>
                  </form>
                </div>
                
              </div>


          <!-- quick email widget -->
          

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        
        

        
      </div>
      <!-- /.row (main row) -->

    </section>

    

    <!-- /.content -->
  </div>


<?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- jQuery -->
<script src="<?php echo e(asset('plugins_2/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('plugins_2/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('plugins_2/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('plugins_2/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('plugins_2/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(asset('plugins_2/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('plugins_2/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('plugins_2/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('plugins_2/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('plugins_2/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('plugins_2/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>



<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist_2/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('dist_2/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist_2/js/demo.js')); ?>"></script>

</body>
</html>
		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SONY\Desktop\beach_comber\resources\views/home/info.blade.php ENDPATH**/ ?>