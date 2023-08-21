

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->

    
		<?php echo $__env->make('inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('inc.dashboard-side-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reservation ID:
        <small>#<?php echo e($reservations[0]->id); ?></small>
      </h1>
      
    </section>

    
    
    
<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-book"></i> <?php echo e($reservations[0]->name); ?>

          <small class="pull-right">Date: <?php echo e($reservations[0]->created_at); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Contact
        <address>
          <strong><?php echo e($reservations[0]->phone); ?></strong><br>
          <?php echo e($reservations[0]->email); ?>

         
        </address>
      </div>
      <!-- /.col -->
      
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
        <b>ID No:</b> <?php echo e($reservations[0]->id_no); ?><br>
        <b>Payment:</b> <?php if($reservations[0]->paid == 1): ?>
         yes   
        <?php else: ?> 
         no
        <?php endif; ?><br>
        <b>Member:</b> <?php echo e($reservations[0]->member); ?>

      </div>

      <div class="col-sm-4 invoice-col">
        <b>Adult:</b> <?php echo e($reservations[0]->adults); ?><br>
        <b>Children:</b> <?php echo e($reservations[0]->children); ?><br/>
        <b>Approved:</b> 
        <?php if($reservations[0]->approved == 1): ?>
            yes
            <?php else: ?>
            no
        <?php endif; ?>
        
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Type</th>
            <th>Name</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th>Amount</th>
            <th>Discount</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><?php echo e($reservations[0]->type); ?></td>
            <td>
           <?php if(count($resort_bookings) > 0): ?>
             <?php echo e($resort_bookings[0]->name); ?>  
           <?php endif; ?>
           <?php if(count($room_bookings) > 0): ?>
               <?php echo e($room_bookings[0]->room_no); ?>

           <?php endif; ?>
            </td>
            <td><?php echo e($reservations[0]->checkin); ?></td>
            <td><?php echo e($reservations[0]->checkout); ?></td>
            <td><?php echo e($reservations[0]->curr); ?><?php echo e($reservations[0]->price); ?></td>
            <td><?php if($reservations[0]->discount == ""): ?>0 <?php else: ?><?php echo e($reservations[0]->discount); ?><?php endif; ?>
            
            </td>
            <td>

                <?php if(count($resort_bookings) > 0): ?>
                 <?php if($resort_bookings[0]->available == 0): ?>
                     booked
                     <?php else: ?>
                     unbooked
                 <?php endif; ?>
           <?php elseif(count($room_bookings) > 0): ?>
              <?php if($room_bookings[0]->available == 0): ?>
                  booked
              <?php else: ?>
                 unbooked 
              <?php endif; ?>
           <?php endif; ?>

            </td>
          </tr>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">

        
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due <?php echo e($reservations[0]->checkout); ?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td><?php echo e($reservations[0]->curr); ?><?php echo e($reservations[0]->price); ?></td>
            </tr>
            <tr>
              <th>Tax:</th>
              <td><?php echo e($reservations[0]->curr); ?>0</td>
            </tr>
            <tr>
              <th>Discount:</th>
              <td><?php echo e($reservations[0]->curr); ?><?php if($reservations[0]->discount == ""): ?>0 <?php else: ?><?php echo e($reservations[0]->discount); ?><?php endif; ?>
              </td>
            </tr>
            <tr>
              <th>Total:</th>
              <td><?php echo e($reservations[0]->curr); ?><?php echo e($reservations[0]->price); ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="<?php echo e(url('admin/print_reservation/'.$reservations[0]->id)); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        
        <?php if(count($transactions) > 0): ?>
    <a href="<?php echo e(url('admin/transaction/'.$transactions[0]->id)); ?>" class="btn fa fa-money" title="Click to see payment record"> See payment transaction record</a> 
    <?php endif; ?>

        <a href="#" onclick="updateReservationState('<?php echo e($reservations[0]->id); ?>')" class="btn pull-right" title="Update Room/Resort Availability Status"> Update State</a>
        
        
      </div>
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>

  





        <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <script src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo e(asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
        <!-- Select2 -->
        <script src="<?php echo e(asset('bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
        <!-- InputMask -->
        <script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
        <script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>
        
        <script src="<?php echo e(asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>



        <!-- date-range-picker -->
        <script src="<?php echo e(asset('bower_components/moment/min/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
        <!-- bootstrap datepicker -->
        <script src="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
        <!-- bootstrap color picker -->
        <script src="<?php echo e(asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')); ?>"></script>
        <!-- bootstrap time picker -->
        <script src="<?php echo e(asset('plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
        <!-- SlimScroll -->
        <script src="<?php echo e(asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?php echo e(asset('plugins/iCheck/icheck.min.js')); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo e(asset('bower_components/fastclick/lib/fastclick.js')); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>
		
  




<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()
  
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )
  
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })
  
      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      })
  
      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()
  
      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })
    })
  </script>

<script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>

</body>
</html>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/reservation.blade.php ENDPATH**/ ?>