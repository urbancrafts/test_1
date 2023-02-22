@extends('layouts.app')

</head>
<body class="hold-transition skin-blue sidebar-mini" onload="window.print();">
<div class="wrapper">

      @section('content')
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
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
            <td>{{$reservations[0]->curr}}{{$reservations[0]->discount}}</td>
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
              <td>{{$reservations[0]->curr}}{{$reservations[0]->discount}}</td>
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
      
    </div>
  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>

  





        @include('inc.footer')

      </body>
      </html>
      
          @endsection
