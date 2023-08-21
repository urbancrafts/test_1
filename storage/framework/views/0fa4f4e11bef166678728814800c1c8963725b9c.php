


      <?php $__env->startSection('content'); ?>

    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="window.print();">
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Transaction Invoice
      <small>#<?php echo e($transaction[0]->id); ?></small>
    </h1>
    
  </section>

  
  

<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-book"></i> <?php echo e($transaction[0]->name); ?>

        <small class="pull-right">Date: <?php echo e($transaction[0]->created_at); ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      Contact
      <address>
        <strong><?php echo e($transaction[0]->phone); ?></strong><br>
        <?php echo e($transaction[0]->email); ?>

       
      </address>
    </div>
    <!-- /.col -->
    
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <?php if($transaction[0]->type == "resort"): ?>
      <b>Transaction:</b> Reservation<br>
      <b>Service type:</b> Resort<br>
      <b>Resort Name:</b> <?php echo e($shelter[0]->name); ?><br>
      <b>Member:</b> <?php echo e($reservations[0]->member); ?><br>
      <b>ID No:</b> <?php echo e($reservations[0]->id_no); ?>

      <?php elseif($transaction[0]->type == "room"): ?>
      <b>Transaction:</b> Reservation<br>
      <b>Service type:</b> Room<br>
      <b>Room ID:</b> <?php echo e($room[0]->room_no); ?><br>
      <b>Resort:</b> <?php echo e($shelter[0]->name); ?><br>
      <b>Member:</b> <?php echo e($reservations[0]->member); ?><br>
      <b>ID No:</b> <?php echo e($reservations[0]->id_no); ?>

      <?php elseif($transaction[0]->type == "Boat" || $transaction[0]->type == "Yacht"): ?>
      <b>Transaction:</b> Booking<br>
      <b>Service type:</b> <?php echo e($transaction[0]->type); ?><br>
      <b>Service title:</b> <?php echo e($service[0]->title); ?><br>
      <b>Member:</b> <?php echo e($booking[0]->member); ?><br>
      <b>ID No:</b> <?php echo e($booking[0]->id_no); ?>

      
      <?php elseif($transaction[0]->type == "Membership"): ?>
      <b>Transaction:</b> Subscription<br>
      <b>Service type:</b> <?php echo e($transaction[0]->type); ?><br>
      <?php endif; ?>
    </div>
    
    <div class="col-sm-4 invoice-col">
      <?php if($transaction[0]->type == "resort" || $transaction[0]->type == "room"): ?>
      <b>Adult:</b> <?php echo e($reservations[0]->adults); ?><br>
      <b>Children:</b> <?php echo e($reservations[0]->children); ?><br>
      <b>Checkin:</b> <?php echo e($reservations[0]->checkin); ?><br>
      <b>Checkout:</b> <?php echo e($reservations[0]->checkout); ?><br>
      <b>Reservation Date:</b> <?php echo e($reservations[0]->created_at); ?><br>
      <b>Approved:</b> 
      <?php if($reservations[0]->approved == 1): ?>
          yes
          <?php else: ?>
          no
      <?php endif; ?>
     <?php elseif($transaction[0]->type == "Boat" || $transaction[0]->type == "Yacht"): ?> 
     <b>Service Date:</b> <?php echo e($booking[0]->booked_date); ?><br>
     <b>Duration:</b> <?php echo e($booking[0]->duration); ?><br>
     <b>Booked Date:</b> <?php echo e($booking[0]->created_at); ?><br>
     <b>Approved:</b> 
     <?php if($booking[0]->approved == 1): ?>
         yes
         <?php else: ?>
         no
     <?php endif; ?>
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
          <th>Ref ID</th>
          <th>Gateway</th>
          <th>Currency</th>
          <th>Amount</th>
          <th>Discount</th>
          <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td><?php echo e($transaction[0]->ref_id); ?></td>
          <td>
            <?php echo e($transaction[0]->gateway); ?>

          </td>
          <td><?php echo e($transaction[0]->curr); ?></td>
          <td><?php echo e($transaction[0]->amount); ?></td>
          <?php if($transaction[0]->type == "resort" || $transaction[0]->type == "room"): ?>
          <td><?php echo e($reservations[0]->discount); ?></td>
          <?php elseif($transaction[0]->type == "Boat" || $transaction[0]->type == "Yacht"): ?>
          <td><?php echo e($booking[0]->discount); ?></td>
          <?php endif; ?>
          <td><?php echo e($transaction[0]->status); ?></td>
          
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
     

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td><?php echo e($transaction[0]->curr); ?><?php echo e($transaction[0]->amount); ?></td>
          </tr>
          <tr>
            <th>Tax:</th>
            <td><?php echo e($transaction[0]->curr); ?>0</td>
          </tr>
          <?php if($transaction[0]->type == "resort" || $transaction[0]->type == "room"): ?>
          <tr>
            <th>Discount:</th>
            <td><?php echo e($reservations[0]->curr); ?><?php echo e($reservations[0]->discount); ?></td>
          </tr>
          <?php elseif($transaction[0]->type == "Boat" || $transaction[0]->type == "Yacht"): ?>
          <tr>
            <th>Discount:</th>
            <td><?php echo e($booking[0]->curr); ?><?php echo e($booking[0]->discount); ?></td>
          </tr>
          <?php endif; ?>
          <tr>
            <th>Total:</th>
            <td><?php echo e($transaction[0]->curr); ?><?php echo e($transaction[0]->amount); ?></td>
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
      <a href="<?php echo e(url('admin/print_transaction/'.$transaction[0]->id)); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
      
      
      
      
    </div>
  </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>
</div>

  





        <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      </body>
      </html>
      
          <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/print_transaction.blade.php ENDPATH**/ ?>