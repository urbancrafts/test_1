@extends('layouts.app')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

      @section('content')
		<!-- Page loader -->

    
		@include('inc.header')

    @include('inc.dashboard-side-bar')

<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reservation ID:
        <small>#{{$reservations[0]->id}}</small>
      </h1>
      
    </section>

    
    
    
<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-book"></i> {{$reservations[0]->name}}
          <small class="pull-right">Date: {{$reservations[0]->created_at}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Contact
        <address>
          <strong>{{$reservations[0]->phone}}</strong><br>
          {{$reservations[0]->email}}
         
        </address>
      </div>
      <!-- /.col -->
      
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        
        <b>ID No:</b> {{$reservations[0]->id_no}}<br>
        <b>Payment:</b> @if ($reservations[0]->paid == 1)
         yes   
        @else 
         no
        @endif<br>
        <b>Member:</b> {{$reservations[0]->member}}
      </div>

      <div class="col-sm-4 invoice-col">
        <b>Adult:</b> {{$reservations[0]->adults}}<br>
        <b>Children:</b> {{$reservations[0]->children}}<br/>
        <b>Approved:</b> 
        @if ($reservations[0]->approved == 1)
            yes
            @else
            no
        @endif
        
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
            <td>{{$reservations[0]->type}}</td>
            <td>
           @if (count($resort_bookings) > 0)
             {{$resort_bookings[0]->name}}  
           @endif
           @if (count($room_bookings) > 0)
               {{$room_bookings[0]->room_no}}
           @endif
            </td>
            <td>{{$reservations[0]->checkin}}</td>
            <td>{{$reservations[0]->checkout}}</td>
            <td>{{$reservations[0]->curr}}{{$reservations[0]->price}}</td>
            <td>@if($reservations[0]->discount == "")0 @else{{$reservations[0]->discount}}@endif
            
            </td>
            <td>

                @if (count($resort_bookings) > 0)
                 @if ($resort_bookings[0]->available == 0)
                     booked
                     @else
                     unbooked
                 @endif
           @elseif (count($room_bookings) > 0)
              @if ($room_bookings[0]->available == 0)
                  booked
              @else
                 unbooked 
              @endif
           @endif

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
        <p class="lead">Amount Due {{$reservations[0]->checkout}}</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>{{$reservations[0]->curr}}{{$reservations[0]->price}}</td>
            </tr>
            <tr>
              <th>Tax:</th>
              <td>{{$reservations[0]->curr}}0</td>
            </tr>
            <tr>
              <th>Discount:</th>
              <td>{{$reservations[0]->curr}}@if($reservations[0]->discount == "")0 @else{{$reservations[0]->discount}}@endif
              </td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>{{$reservations[0]->curr}}{{$reservations[0]->price}}</td>
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
        <a href="{{url('admin/print_reservation/'.$reservations[0]->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        
        @if (count($transactions) > 0)
    <a href="{{url('admin/transaction/'.$transactions[0]->id)}}" class="btn fa fa-money" title="Click to see payment record"> See payment transaction record</a> 
    @endif

        <a href="#" onclick="updateReservationState('{{$reservations[0]->id}}')" class="btn pull-right" title="Update Room/Resort Availability Status"> Update State</a>
        
        
      </div>
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>

  





        @include('inc.footer')

        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Select2 -->
        <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
        <!-- InputMask -->
        <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
        <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
        <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
        
        <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>



        <!-- date-range-picker -->
        <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <!-- bootstrap datepicker -->
        <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <!-- bootstrap color picker -->
        <script src="{{asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
        <!-- bootstrap time picker -->
        <script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
        <!-- SlimScroll -->
        <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- iCheck 1.0.1 -->
        <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('dist/js/demo.js')}}"></script>
		
  




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

		@endsection