

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
        <small>User account</small>
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
                  
    
                  <h3 class="card-title"><i class="fa fa-user"></i> Create admin user</h3>
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
                  <form id="user-form" action="<?php echo e(action('App\Http\Controllers\AjaxRequestController@create_user')); ?>" method="post" enctype="multipart/form-data">
                   
                   
                
                   <div class="form-group">
                        <span style="color: red; display: none" class="resort-name-error">(*Required)</span>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-email-error">(*Required)</span>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email address" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-phone-error"></span>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone number" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-phone-error"></span>
                        <select id="admin-type" name="admin-type" class="form-control">
                          <option value="2">Admin</option>
                          <option value="1">Super Admin</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-pass-error"></span>
                      <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-cpass-error"></span>
                      <input type="password" class="form-control" id="cpass" name="cpass" placeholder="Confirm password" >
                    </div>

                    
                                    

                    <div class="card-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default" id="sendEmail">Create
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
        
        
        

        <section class="col-lg-5 connectedSortable">

            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                  <h3 class="card-title">List Of Users</h3>
    
                  <div class="card-tools float-right">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                  <table id="example1" class="products-list product-list-in-box">
                    <thead>
                      <tr>
                        <td>Names</td>
                      </tr>
                    </thead>
                    <tbody>
                 <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <tr class="item" >
                   <td width='500'>
                     <?php if($user->img == ""): ?>
                     <div class="product-img">
                        <img src="<?php echo e(asset('storage/img/users/default.png')); ?>" alt="<?php echo e($user->name); ?>">
                      </div>     
                     <?php else: ?>
                     <div class="product-img">
                        <img src="<?php echo e(asset('storage/img/users/'.$user->id.'/profile/'.$user->img)); ?>" alt="<?php echo e($user->name); ?>">
                      </div>     
                     <?php endif; ?>
                  
                  <div class="product-info">
                    <a href="<?php echo e(url('users/profile/'.$user->id)); ?>" class="product-title"><?php echo e($user->name); ?>

                        <span class="badge badge-warning float-right">
                            <?php echo e($user->user_type); ?>

                        </span></a>
                    <span class="product-description">
                          <?php echo e($user->email); ?>

                        </span>
                        <?php if(Auth::user()->id == $user->admin || Auth::user()->role == 1 && $user->user_type == "member" || Auth::user()->role == 1 && $user->user_type == "resort_owner" || Auth::user()->role == 1 && $user->user_type == "boat_owner"): ?>
                     <a href="#" class="fa fa-trash" onClick="deleteUser('<?php echo e($user->id); ?>','<?php echo e($user->name); ?>')" title="Delete <?php echo e($user->name); ?>"></a>
                      <?php endif; ?>
                  </div>
                   </td>
                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </tbody>
                <tfoot class="card-footer text-center">
                  <tr>
                    <td>Names</td>
                  </tr>
                </tfoot>
              </table>
                </div>
                <!-- /.box-body -->
               
                <!-- /.box-footer -->
              </div>

        


        </section>
        <!-- right col -->
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


<script src="<?php echo e(asset('plugins_2/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins_2/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist_2/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('dist_2/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist_2/js/demo.js')); ?>"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>

		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/users.blade.php ENDPATH**/ ?>