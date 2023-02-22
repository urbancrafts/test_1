@extends('layouts.app')

      @section('content')
		<!-- Page loader -->

  
    <style type="text/css">
      p, body, td, input, select, button { font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 14px; }
      body { padding: 0px; margin: 0px; background-color: #ffffff; }
      
      .space { margin: 10px 0px 10px 0px; }
      
      .main { padding: 10px; margin-top: 10px; }
  </style>

  <!-- DayPilot library -->
  <script src="{{ asset('dashboard_calendar/js/daypilot/daypilot-all.min.js')}}"></script>

  <link type="text/css" rel="stylesheet" href="{{ asset('dashboard_calendar/icons/style.css')}}" />

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
          background-image: url("data:image/svg+xml,%3Csvg width='10' height='10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 0.5 1.5 L 5 6.5 L 9.5 1.5' style='fill:none;stroke:%23999999;stroke-width:2;stroke-linejoin:round;stroke-linecap:butt' /%3E%3C/svg%3E");
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

    <script src="{{ asset('datepicker/jquery-ui.js') }}"></script>
    
    <link href="{{ asset('datepicker/jquery-ui.css') }}" rel="stylesheet">
    <script src="{{ asset('datepicker/booking-form.js') }}"></script>
    


    <link rel="stylesheet" href="{{asset('plugins_2/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('plugins_2/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins_2/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins_2/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{asset('plugins_2/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('plugins_2/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{asset('plugins_2/dropzone/min/dropzone.min.css')}}">

  <link rel="stylesheet" href="{{asset('plugins_2/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins_2/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <script type="text/javascript">
      jQuery(document).ready(function(){
      

       
jQuery("form#service-booking-form").on("submit", function(e){
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

}else if(jQuery.trim(jQuery('#duration').val()) == "" ){
  jQuery('#duration').css('border', 'solid 1px red');
  jQuery('.resort-duration-error').show();
  jQuery('.resort-duration-error').html('(*Required)');

}else if(!Number(jQuery('#duration').val())){
  jQuery('#duration').css('border', 'solid 1px red');
  jQuery('.resort-duration-error').show();
  jQuery('.resort-duration-error').html('(*Numeric value required for this field such as: 1, 2, 3, 4, etc.)');

}else if(jQuery.trim(jQuery('#start-date').val()) == "" ){
  jQuery('#check_in_date_602ae1e0dd259').css('border', 'solid 1px red');
  jQuery('.resort-checkin-error').show();
  jQuery('.resort-checkin-error').html('(*Required)');

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
              //servicePaymentModal(data.data.id, data.data.service_id, data.data.curr, data.data.price, data.data.name, data.data.type, data.message);
              //window.location = "{{ url('payment/service_booking') }}/"+data.data.id;
            location.reload();
            }else if(data.success == false){
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data.message);
            }else{
              jQuery(".alert-success").hide();
              jQuery(".alert-danger").show();
              jQuery(".alert-danger").html(data);
            }
              
         }
         });

}

});

      
      });
      </script>

  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      
      @include('inc.header2')
  
    @include('inc.dashboard-side-bar2')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$services[0]->title}}
        <small>Service Bookings</small>
      </h1>
      
    </section>

    



 <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <div class="row">


      

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
      

    
    <div class="col-xs-12">
      

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$services[0]->title}} Booked List</h3> 
        </div>
        <!-- /.box-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Type</th>
              <th>Booked Date </th>
              <th>Duration</th>
              <th>Member</th>
              <th>Price</th>
              <th>Approved</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($bookings as $booking)
            <tr>
              <td>{{$booking->name}}</td>
              <td>{{$booking->phone}}
              </td>
              <td>{{$booking->type}}</td>
              <td>{{$booking->booked_date}}</td>
              <td>{{$booking->duration}} / hours</td>
              <td>{{$booking->member}}</td>
              <td>{{$booking->curr}}{{$booking->price}}</td>
              
              <td>@if ($booking->approved == 1)
                  yes
                @else
                no
                
                <a href="#" onclick="updateBooking('{{$booking->id}}')" class="btn btn-special" title="Set Resort/Room Availability To (Booked) By Updating This Reservation">Update</a>
                
              @endif
            |
            <a href="{{url('admin/service_booking/'.$booking->id)}}" class="btn btn-special" title="View this reservation"><i class="fa fa-eye"></i>View</a>
            </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Type</th>
                <th>Booked Date </th>
                <th>Duration</th>
                <th>Member</th>
                <th>Price</th>
                <th>Approved</th>
                </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
</section>




  

  

    <!-- /.content -->
  </div>





        @include('inc.footer')

        

        <script src="{{asset('plugins_2/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins_2/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins_2/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('plugins_2/select2/js/select2.full.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins_2/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins_2/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins_2/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins_2/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins_2/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins_2/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins_2/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins_2/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins_2/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins_2/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<script src="{{asset('plugins_2/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins_2/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins_2/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins_2/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('dist_2/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist_2/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist_2/js/demo.js')}}"></script>


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
                 
                  const capacities = [
                      {name: "1", id: 1},
                      
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
                  //updateRoom(sub_id, name, capacity, status);
                  //await DayPilot.Http.post("backend_room_update.php", room);
                  //dp.rows.update(room);
              }},
          { text: "Delete", onClick: async (args) => {
                  const id = args.source.id;
                  const name = args.source.name;
                  const str = confirm('Do you really want to delete '+name+'?');
                  if(str == true){
                  //deleteRoom(id, name);
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
      //const {data} = await DayPilot.Http.post("{{ action('App\Http\Controllers\ReservationController@admin_room_reservation_resize') }}", {id: params.id, start: params.newStart, end: params.newEnd});
      
      //dp.message("Resized");

  };

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
      const resort_id = "{{$resorts[0]->shelter_id}}";
     
      //const {data: result} = await DayPilot.Http.post("backend_reservation_create.php", e);

      createRoomReservation(resort_id, start, end, sub_room_id, customer, e);
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
          {name: "Text", id: "text"},
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

  loadResort();
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
      
      const resort_id = "{{$resorts[0]->shelter_id}}";
     
      //dp.events.load("{{ action('App\Http\Controllers\ReservationController@load_admin_room_reservation') }}");
    loadResortReservation(resort_id);


  }

  async function loadResort() {
        const resort_id = "{{$resorts[0]->id}}";
        
      //const {data} = loadRoomData(resort_id, room_id);
      //const {data} = await DayPilot.Http.get("{{ action('App\Http\Controllers\ResortController@sub_room') }}", { resort_id: resort_id, room_id: room_id });
      //dp.resources = data;
      //dp.update();

      loadResortData(resort_id);
      
  }

  elements.filter.addEventListener("change", (e) => {
    loadResort();
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

  
  

</script>
</body>
</html>

		@endsection