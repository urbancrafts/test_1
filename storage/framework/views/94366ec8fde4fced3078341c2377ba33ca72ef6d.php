

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
    
    <style type="text/css">
      p, body, td, input, select, button { font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 14px; }
      body { padding: 0px; margin: 0px; background-color: #ffffff; }
      
      .space { margin: 10px 0px 10px 0px; }
      
      .main { padding: 10px; margin-top: 10px; }
  </style>

  <!-- DayPilot library -->
  <script src="<?php echo e(asset('dashboard_calendar/js/date/booking_calendar.js')); ?>"></script>

  <link type="text/css" rel="stylesheet" href="<?php echo e(asset('dashboard_calendar/icons/style.css')); ?>" />

  <style type="text/css">
      select {
          padding: 5px;
      }

      .toolbar {
          margin: 10px 0px;
      }

      .toolbar button {
          padding: 5px 15px;
      }

      .icon {
          font-size: 14px;
          text-align: center;
          line-height: 14px;
          vertical-align: middle;

          cursor: pointer;
      }

      .toolbar-separator {
          width: 1px;
          height: 28px;
          /*content: '&nbsp;';*/
          display: inline-block;
          box-sizing: border-box;
          background-color: #ccc;
          margin-bottom: -8px;
          margin-left: 15px;
          margin-right: 15px;
      }

      .scheduler_default_rowheader_inner
      {
          border-right: 1px solid #ccc;
      }
      .scheduler_default_rowheadercol2
      {
          background: White;
      }
      .scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
      {
          top: 2px;
          bottom: 2px;
          left: 2px;
          background-color: transparent;
          border-left: 5px solid #38761d; /* green */
          border-right: 0px none;
      }
      .status_dirty.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
      {
          border-left: 5px solid #cc0000; /* red */
      }
      .status_cleanup.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
      {
          border-left: 5px solid #e69138; /* orange */
      }

      .area-menu {
          background-image: url();
          background-repeat: no-repeat;
          background-position: center center;
          border: 1px solid #ccc;
          background-color: #fff;
          border-radius: 3px;
          opacity: 0.8;
          cursor: pointer;
      }

      .area-menu:hover {
          opacity: 1;
      }

  </style>

    <script src="<?php echo e(asset('datepicker/jquery-ui.js')); ?>"></script>
    
    <link href="<?php echo e(asset('datepicker/jquery-ui.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('datepicker/booking-form.js')); ?>"></script>
    


    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')); ?>">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/bs-stepper/css/bs-stepper.min.css')); ?>">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/dropzone/min/dropzone.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
    <script type="text/javascript">
    
    const dp = new DayPilot.Scheduler("dp");

      jQuery(document).ready(function(){
      

        jQuery("form#reservation-form").on("submit", function(e){
  e.preventDefault();
var action = jQuery(this).attr('action');
var formdata = new FormData(this);//create an instance for the form input fields

if(jQuery.trim(jQuery('#name').val()) == ""){
  jQuery('#name').css('border', 'solid 1px red');
  jQuery('.resort-name-error').show();

}else if(jQuery.trim(jQuery('#phone').val()) == ""){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.resort-phone-error').show();
  jQuery('.resort-phone-error').html('(*Required)');
}else if(!Number(jQuery('#phone').val())){
  jQuery('#phone').css('border', 'solid 1px red');
  jQuery('.resort-phone-error').show();
  jQuery('.resort-phone-error').html('(phone field requires numeric data only)');
}else if(jQuery.trim(jQuery('#email').val()) == ""){
  jQuery('#email').css('border', 'solid 1px red');
  jQuery('.resort-email-error').show();
  jQuery('.resort-email-error').html('(*Required)');

}else if(jQuery.trim(jQuery('#start-date').val()) == "" ){
  jQuery('#check_in_date_602ae1e0dd259').css('border', 'solid 1px red');
  jQuery('.resort-checkin-error').show();
  jQuery('.resort-checkin-error').html('(*Required)');

}else if(jQuery.trim(jQuery('#end-date').val()) == ""){
  jQuery('#check_out_date_602ae1e0dd259').css('border', 'solid 1px red');
  jQuery('.resort-checkout-error').show();
  jQuery('.resort-checkout-error').html('(*Required)');

}else if(jQuery.trim(jQuery("#adults").val()) =="" ){
  jQuery('#adults').css('border', 'solid 1px red');
  jQuery('.resort-adult-error').show();
  jQuery('.resort-adult-error').html('(*Select Number Of Adults)');
}else if(jQuery.trim(jQuery('#children').val()) == ""){
  jQuery('#children').css('border', 'solid 1px red');
  jQuery('.resort-children-error').show();
  jQuery('.resort-children-error').html('(*Select Number Of Children)');

}else{
     jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: action,
         data: formdata,
         cache: false,
         contentType: false,
         processData: false,
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".load").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              jQuery("#reserv-btn").prop('disabled', true);
              jQuery(".alert-danger").hide();
              jQuery(".alert-success").css('display', 'block !important');
              jQuery(".alert-success").html(data.message);
              //reservationPaymentModal(data.data.id, data.data.shelter_id, data.data.room_id, data.data.curr, data.data.price, data.data.name, data.data.type);
              //window.location = "<?php echo e(url('payment/reservations')); ?>/"+data.data.id;
              location.reload();
            }else if(data.success == false){
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data.data);
            }else{
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data);
            }
              
         }
         });

}


});

/**********************************************************************
jQuery('#addroom').on("click", async (ev) => {
      ev.preventDefault();

      const capacities = [
          {name: "1", id: 1},
          {name: "2", id: 2},
          {name: "4", id: 4},
      ];

      const form = [
          {name: "Room Name", id: "name"},
          {name: "Capacity", id: "capacity", options: capacities}
      ];

      const data = {
          capacity: 2
      };

      const modal = await DayPilot.Modal.form(form, data);
      if (modal.canceled) {
          return;
      }

      const room = modal.result.name;
    


      jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ResortController@sub_room_create')); ?>",
         data: {resort_id: resort_id, room_id: room_id, room},
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".load").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              room.id = data.data.id;
              room.status = data.data.status;
              dp.resources.push(room);
              dp.update();
              jQuery("#reserv-btn").prop('disabled', true);
              jQuery(".alert-danger").hide();
              jQuery(".alert-success").css('display', 'block !important');
              jQuery(".alert-success").html(data.message);
              //reservationPaymentModal(data.data.id, data.data.shelter_id, data.data.room_id, data.data.curr, data.data.price, data.data.name, data.data.type);
              //window.location = "<?php echo e(url('payment/reservations')); ?>/"+data.data.id;
              location.reload();
            }else if(data.success == false){
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data.data);
            }else{
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data);
            }
              
         }
         });

      

  });
************************************************************************/

      
      });

function createRoom(resort_id, room_id, room, capacity){
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ResortController@sub_room_create')); ?>",
         data: {resort_id: resort_id, room_id: room_id, room: room, capacity: capacity},
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".load").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
           if(data.success == true){
          dp.resources.push(data.data);
          dp.update();
         jQuery(".alert-danger").hide();
         jQuery(".alert-success").show();
         jQuery(".alert-success").html(data.message);
           }else{
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html(data.message);
           }
         }
         });
}

function updateRoom(sub_id, name, capacity, status){

  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ResortController@sub_room_update')); ?>",
         data: {room_id: sub_id, name: name, capacity: capacity, status: status},
         cache: false,
         
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
          dp.rows.update(data);
          
             //alert(data.data[0]);
         }
         });

}

function deleteRoom(sub_id, name){
  
  
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ResortController@sub_room_delete')); ?>",
         data: {room_id: sub_id},
         cache: false,
         
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
          dp.rows.remove(data);
          
             //alert(data.data[0]);
         }
         });
      

}

function loadRoomData(resort_id, room_id){
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ResortController@sub_room')); ?>",
         data: {resort_id: resort_id, room_id: room_id},
         cache: false,
         
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
          dp.resources = data;
          dp.update();
          
             //alert(data.data[0]);
         }
         });
}


function loadRoomReservation(resort_id, room_id){
  
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ReservationController@load_admin_room_reservation')); ?>",
         data: {resort_id: resort_id, room_id: room_id},
         cache: false,
         
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
          //dp.events.add(data[4]);
          //dp.events.load(data);
          for(var i = 0; i < data.length; i++){
            dp.events.add(data[i]);
          }
          
           
             //alert(data.data[0]);
         }
         });
}


function createRoomReservation(resort_id, room_id, start, end, sub_room_id, customer, e){
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ReservationController@admin_room_reservation_create')); ?>",
         data: {resort_id: resort_id, room_id: room_id, start: start, end: end, sub_room_id: sub_room_id, customer: customer},
         cache: false,
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
           if(data.success == true){
      e.id = data.data[0].id;
      e.paid = data.data[0].paid;
      e.status = data.data[0].status;
      dp.events.add(e);
         jQuery(".alert-danger").hide();
         jQuery(".alert-success").show();
         jQuery(".alert-success").html(data.message);
           }else{
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html(data.message);
           }
          //dp.events.load(data.data);
          
             //alert(data.data[0]);
         }
         });
}


function updateRoomReservation(id, name, start, end, resource, status, paid, bubble, e){
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ReservationController@admin_room_reservation_update')); ?>",
         data: {id: id, name: name, start: start, end: end, sub_room_id: resource, status: status, paid: paid, bubble: bubble},
         cache: false,
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
           
      
         dp.events.update(e);
         
          //dp.events.load(data.data);
          
             //alert(data.data[0]);
         }
         });
}

function resizeRoomReservation(id, start, end){
  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ReservationController@admin_room_reservation_resize')); ?>",
         data: {id: id, start: start, end: end},
         cache: false,
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
           
          dp.message("Resized");
         //dp.events.update(e);
         
          //dp.events.load(data.data);
          
             //alert(data.data[0]);
         }
         });
}

function moveRoomReservation(id, newStart, newEnd, newResource){

  jQuery.ajax({
          headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ReservationController@admin_room_reservation_move')); ?>",
         data: {id: id, new_start: newStart, new_end: newEnd, new_sub_room_id: newResource},
         cache: false,
         beforeSend:function(){
             jQuery(".alert-success").show();
             jQuery('.alert-danger').hide();
             jQuery(".alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             jQuery(".alert").hide();
         },
         error:function(){
         jQuery(".alert-success").hide();
         jQuery(".alert-danger").show();
         jQuery(".alert-danger").html("Please check your internet connection");
         },
         success:function(data){
           
          dp.message(data.message);
          //dp.events.load(data.data);
          
             //alert(data.data[0]);
         }
         });

}
      </script>

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
        Booking Table
        <small><?php echo e($services[0]->title); ?></small>
      </h1>
      
    </section>

    



 <!-- Main content -->
 <section class="content">
  <div class="container-fluid">

    <div class="row">



      <div class="col-md-12 grid-margin">

        
        <div class="tabSide">
          <div class="card card-body p-0" style="border: 2px solid #E51924; border-radius: 0px">
          
            <ul class="nav nav-pills nav-justified">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('admin/service_manager/edit_service/'.$services[0]->id)); ?>">Edit form</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="<?php echo e(url('admin/service_manager/edit_service_img/'.$services[0]->id)); ?>">Images</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo e(url('admin/service_manager/bookings/'.$services[0]->id)); ?>">Bookings</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link " href="https://localhost/backend/administrator/product_manager/edit_pricing/122">Product Pricing</a>
              </li>
               -->
            </ul>    
            
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="sticky-top mb-3">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Calendar</h4>
            </div>
            <div class="card-body">
              <!-- the events -->
              <div id="external-events">
                <div style="width:220px; float:left;">
                  <div id="nav"></div>
              </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <span class="alert alert-danger blog-alert-danger1" style="display: none"></span><span class="alert alert-success blog-alert-success1" style="display: none"></span>
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-calendar"></i>
              Booking calendar
            </h3>
  
            <div class="float-right card-tools">
                      
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
  
            </div>
          </div>
          <div class="card-body p-0">
            <!-- THE CALENDAR -->
            <div >

              <div class="toolbar">
      
                  Room filter:
                  <select id="filter">
                      <option value="0">All</option>
                      <option value="1">Single</option>
                      <option value="2">Double</option>
                      <option value="4">Family</option>
                  </select>
      
                  &nbsp;&nbsp;
      
                  <button id="addroom">Add Room</button>
      
                  <div class="toolbar-separator"></div>
      
                  Time range:
                  <select id="timerange">
                      <option value="week">Week</option>
                      <option value="month" selected>Month</option>
                  </select>
                  <div class="toolbar-separator"></div>
                  <label for="autocellwidth"><input type="checkbox" id="autocellwidth">Auto Cell Width</label>
      
              </div>
      
              <div id="dp"></div>
      
          </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->





      

      


      
    </div>
    <!-- /.row -->

  </div>
  
  </section>




  

    <!-- /.content -->
  </div>





        <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <script src="<?php echo e(asset('plugins_2/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('plugins_2/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('plugins_2/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins_2/select2/js/select2.full.min.js')); ?>"></script>
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
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
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
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
<script>
  $(function () {
    //Add text editor
    $('#editor1').summernote()
  })
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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




<script type="text/javascript">
  const nav = new DayPilot.Navigator("nav");
  nav.selectMode = "month";
  nav.showMonths = 3;
  nav.skipMonths = 3;
  nav.onTimeRangeSelected = function(args) {
      loadTimeline(args.start);
      dp.update();
      loadReservations();
  };
  nav.init();

</script>

<script>
  

  dp.allowEventOverlap = false;

  dp.days = dp.startDate.daysInMonth();
  loadTimeline(DayPilot.Date.today().firstDayOfMonth());

  dp.eventDeleteHandling = "Update";

  dp.timeHeaders = [
      { groupBy: "Month", format: "MMMM yyyy" },
      { groupBy: "Day", format: "d" }
  ];

  dp.eventHeight = 80;
  dp.cellWidth = 60;

  dp.rowHeaderColumns = [
      {title: "Room", display: "name", sort: "name"},
      {title: "Capacity", display: "capacity", sort: "capacity"},
      {title: "Status", display: "status", sort: "status"}
  ];

  dp.separators = [
      { location: DayPilot.Date.now(), color: "red" }
  ];

  dp.contextMenuResource = new DayPilot.Menu({
    
      items: [
          { text: "Edit...", onClick: async (args) => {
                 const room_capacity = 0;
                  const capacities = [
                      {name: "", id: room_capacity},
                      
                  ];

                  const statuses = [
                      {name: "Ready", id: "Ready"},
                      {name: "Cleanup", id: "Cleanup"},
                      {name: "Dirty", id: "Dirty"},
                  ];

                  const form = [
                      {name: "Room Number", id: "name"},
                      {name: "Capacity", id: "capacity", options: capacities},
                      {name: "Status", id: "status", options: statuses}
                  ];

                  const data = args.source.data;

                  const modal = await DayPilot.Modal.form(form, data);
                  if (modal.canceled) {
                      return;
                  }

                  const room = modal.result;
                  const sub_id = modal.result.id;
                  const name = modal.result.name;
                  const capacity = modal.result.capacity;
                  const status = modal.result.status;
                  updateRoom(sub_id, name, capacity, status);
                  //await DayPilot.Http.post("backend_room_update.php", room);
                  //dp.rows.update(room);
              }},
          { text: "Delete", onClick: async (args) => {
                  const id = args.source.id;
                  const name = args.source.name;
                  const str = confirm('Do you really want to delete '+name+'?');
                  if(str == true){
                  deleteRoom(id, name);
                  }
                  //await DayPilot.Http.post("backend_room_delete.php", {id: id});
                  //dp.rows.remove(id);
              }
          }
      ]
  });

  dp.onBeforeRowHeaderRender = (args) => {
      const beds = (count) => {
          return count + " person" + (count > 1 ? "s" : "");
      };

      args.row.columns[1].html = beds(args.row.data.capacity);
      switch (args.row.data.status) {
          case "Dirty":
              args.row.cssClass = "status_dirty";
              break;
          case "Cleanup":
              args.row.cssClass = "status_cleanup";
              break;
      }

      args.row.columns[0].areas = [
          {right: 3, top: 3, width: 16, height: 16, cssClass: "area-menu", action: "ContextMenu", visibility: "Hover"}
      ];

  };

  // http://api.daypilot.org/daypilot-scheduler-oneventmoved/
  dp.onEventMoved = async (args) => {
    /**************************************
      const params = {
          id: args.e.id(),
          newStart: args.newStart,
          newEnd: args.newEnd,
          newResource: args.newResource
      };
  ******************************************/
          const id = args.e.id();
          const newStart = args.newStart;
          const newEnd = args.newEnd;
          const newResource = args.newResource;

      //const {data} = await DayPilot.Http.post("backend_reservation_move.php", params);
      
      moveRoomReservation(id, newStart, newEnd, newResource);

      //dp.message(data.message);

  };

  // http://api.daypilot.org/daypilot-scheduler-oneventresized/
  dp.onEventResized = async (args) => {
      /**************************************
      const params = {
          id: args.e.id(),
          newStart: args.newStart,
          newEnd: args.newEnd
      };
    ****************************************/
      
      //const id = params.id;
      //const start = params.newStart;
      //const end = params.newEnd;

          const id = args.e.id();
          const newStart = args.newStart;
          const newEnd = args.newEnd;
      resizeRoomReservation(id, newStart, newEnd);
      //const {data} = await DayPilot.Http.post("<?php echo e(action('App\Http\Controllers\ReservationController@admin_room_reservation_resize')); ?>", {id: params.id, start: params.newStart, end: params.newEnd});
      
      //dp.message("Resized");

  };

  dp.eventDeleteHandling = "Update";

  dp.onEventDeleted = async (args) => {
      await DayPilot.Http.post("backend_reservation_delete.php", {id: args.e.id()});
      dp.message("Deleted.");
  };

  // event creating
  // http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
  dp.onTimeRangeSelected = async (args) => {

      const rooms = dp.resources.map((item) => {
          return {
              name: item.name,
              id: item.id
          };
      });

      const form = [
          {name: "Customer", id: "text"},
          {name: "Start", id: "start", dateFormat: "MM/dd/yyyy HH:mm tt"},
          {name: "End", id: "end", dateFormat: "MM/dd/yyyy HH:mm tt"},
          {name: "Room", id: "resource", options: rooms},
      ];

      const data = {
          start: args.start,
          end: args.end,
          resource: args.resource
      };

      const modal = await DayPilot.Modal.form(form, data);

      dp.clearSelection();
      if (modal.canceled) {
          return;
      }
      const e = modal.result;
      const start = modal.result.start;
      const end = modal.result.end;
      const sub_room_id = modal.result.resource;
      const customer = modal.result.text;
      const resort_id = 1;
      const room_id =  1;
      //const {data: result} = await DayPilot.Http.post("backend_reservation_create.php", e);

      createRoomReservation(resort_id, room_id, start, end, sub_room_id, customer, e);
      //e.id = result.id;
      //e.paid = result.paid;
      //e.status = result.status;
      //dp.events.add(e);

  };

  dp.onEventClick = async (args) => {
      const rooms = dp.resources.map((item) => {
          return {
              name: item.name,
              id: item.id
          };
      });

      const statuses = [
          {name: "New", id: "New"},
          {name: "Confirmed", id: "Confirmed"},
          {name: "Arrived", id: "Arrived"},
          {name: "CheckedOut", id: "CheckedOut"}
      ];

      const paidoptions = [
          {name: "0%", id: 0},
          {name: "50%", id: 50},
          {name: "100%", id: 100},
      ]

      const form = [
          {name: "Customer", id: "text"},
          {name: "Start", id: "start", dateFormat: "MM/dd/yyyy h:mm tt"},
          {name: "End", id: "end", dateFormat: "MM/dd/yyyy h:mm tt"},
          {name: "Room", id: "resource", options: rooms},
          {name: "Status", id: "status", options: statuses},
          {name: "Paid", id: "paid", options: paidoptions},
      ];

      const data = args.e.data;

      const modal = await DayPilot.Modal.form(form, data);

      dp.clearSelection();
      if (modal.canceled) {
          return;
      }
      const e = modal.result;

      const id = modal.result.id;
      const name = modal.result.text;
      const start = modal.result.start;
      const end = modal.result.end;
      const resource = modal.result.resource;
      const status = modal.result.status;
      const paid = modal.result.paid;
      const bubble = modal.result.bubbleHtml;

      updateRoomReservation(id, name, start, end, resource, status, paid, bubble, e);

      //await DayPilot.Http.post("backend_reservation_update.php", e);
      //dp.events.update(e);
  };

  dp.onBeforeEventRender = (args) => {
      const start = new DayPilot.Date(args.data.start);
      const end = new DayPilot.Date(args.data.end);
      const resort_id = 1;
      const room_id =  1;

      const today = DayPilot.Date.today();
      const now = new DayPilot.Date();

      args.data.html = DayPilot.Util.escapeHtml(args.data.text) + " (" + start.toString("M/d/yyyy") + " - " + end.toString("M/d/yyyy") + ")";

      switch (args.data.status) {
          case "New":
              const in2days = today.addDays(1);

              if (start < in2days) {
                  args.data.barColor = '#cc0000';
                  args.data.toolTip = 'Expired (not confirmed in time)';
              }
              else {
                  args.data.barColor = '#e69138';
                  args.data.toolTip = 'New';
              }
              break;
          case "Confirmed":
              const arrivalDeadline = today.addHours(18);

              if (start < today || (start.getDatePart() === today.getDatePart() && now > arrivalDeadline)) { // must arrive before 6 pm
                  args.data.barColor = "#cc4125";  // red
                  args.data.toolTip = 'Late arrival';
              }
              else {
                  args.data.barColor = "#38761d";
                  args.data.toolTip = "Confirmed";
              }
              break;
          case 'Arrived': // arrived
              const checkoutDeadline = today.addHours(10);

              if (end < today || (end.getDatePart() === today.getDatePart() && now > checkoutDeadline)) { // must checkout before 10 am
                  args.data.barColor = "#cc4125";  // red
                  args.data.toolTip = "Late checkout";
              }
              else
              {
                  args.data.barColor = "#1691f4";  // blue
                  args.data.toolTip = "Arrived";
              }
              break;
          case 'CheckedOut': // checked out
              args.data.barColor = "gray";
              args.data.toolTip = "Checked out";
              break;
          default:
              args.data.toolTip = "Unexpected state";
              break;
      }

      args.data.html = "<div>" + args.data.html + "<br /><span style='color:gray'>" + args.data.toolTip + "</span></div>";

      const paid = args.data.paid;
      const paidColor = "#aaaaaa";

      args.data.areas = [
          { bottom: 10, right: 4, html: "<div style='color:" + paidColor + "; font-size: 8pt;'>Paid: " + paid + "%</div>", v: "Visible"},
          { left: 4, bottom: 8, right: 4, height: 2, html: "<div style='background-color:" + paidColor + "; height: 100%; width:" + paid + "%'></div>", v: "Visible" }
      ];

  };


  dp.init();

  const elements = {
      filter: document.querySelector("#filter"),
      timerange: document.querySelector("#timerange"),
      autocellwidth: document.querySelector("#autocellwidth"),
      addroom: document.querySelector("#addroom"),
  };

  loadRooms();
  loadReservations();

  function loadTimeline(date) {
      dp.scale = "Manual";
      dp.timeline = [];
      const start = date.getDatePart().addHours(12);

      for (let i = 0; i < dp.days; i++) {
          dp.timeline.push({start: start.addDays(i), end: start.addDays(i+1)});
      }
  }

  function loadReservations() {
      
      const resort_id = 1;
      const room_id =  1;
      //dp.events.load("<?php echo e(action('App\Http\Controllers\ReservationController@load_admin_room_reservation')); ?>");
    loadRoomReservation(resort_id, room_id);


  }

  async function loadRooms() {
        const resort_id = 1;
        const room_id =  1;
      //const {data} = loadRoomData(resort_id, room_id);
      //const {data} = await DayPilot.Http.get("<?php echo e(action('App\Http\Controllers\ResortController@sub_room')); ?>", { resort_id: resort_id, room_id: room_id });
      //dp.resources = data;
      //dp.update();

      loadRoomData(resort_id, room_id);
      
  }

  elements.filter.addEventListener("change", (e) => {
      loadRooms();
  });

  elements.timerange.addEventListener("change", () => {
      switch (this.value) {
          case "week":
              dp.days = 7;
              nav.selectMode = "Week";
              nav.select(nav.selectionDay);
              break;
          case "month":
              dp.days = dp.startDate.daysInMonth();
              nav.selectMode = "Month";
              nav.select(nav.selectionDay);
              break;
      }
  });

  elements.autocellwidth.addEventListener("click", () => {
      dp.cellWidth = 60;  // reset for "Fixed" mode
      dp.cellWidthSpec = this.checked ? "Auto" : "Fixed";
      dp.update();
  });

  
  elements.addroom.addEventListener("click", async (ev) => {
        ev.preventDefault();
        const room_capacity = 1;
        const capacities = [
            {name: "", id: room_capacity},
            
        ];

        const form = [
            {name: "Room Number", id: "name"},
            {name: "Capacity", id: "capacity", options: capacities}
        ];

        const data = {
            capacity: room_capacity
        };

        const modal = await DayPilot.Modal.form(form, data);
        if (modal.canceled) {
            return;
        }

        const room = modal.result;
        const resort_id = 1;
        const room_id =  1;
        const name = modal.result.name;
        const capacity = modal.result.capacity;

        createRoom(resort_id, room_id, name, capacity);
        
        //room.id = result.id;
        //room.status = result.status;
        
    });

</script>

</body>
</html>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/service_bookings.blade.php ENDPATH**/ ?>