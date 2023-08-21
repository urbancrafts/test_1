

</head>
<body class="hold-transition skin-blue sidebar-mini" onload="window.print();">
<div class="wrapper">

      <?php $__env->startSection('content'); ?>
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
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
            <td><?php echo e($reservations[0]->curr); ?><?php echo e($reservations[0]->discount); ?></td>
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
              <td><?php echo e($reservations[0]->curr); ?><?php echo e($reservations[0]->discount); ?></td>
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
      
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>

  





        <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      </body>
      </html>
      
          <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/print_reservation.blade.php ENDPATH**/ ?>