@extends('layouts.app')


      @section('content')

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
      <small>#{{$transaction[0]->id}}</small>
    </h1>
    
  </section>

  
  

<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-book"></i> {{$transaction[0]->name}}
        <small class="pull-right">Date: {{$transaction[0]->created_at}}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      Contact
      <address>
        <strong>{{$transaction[0]->phone}}</strong><br>
        {{$transaction[0]->email}}
       
      </address>
    </div>
    <!-- /.col -->
    
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      @if($transaction[0]->type == "resort")
      <b>Transaction:</b> Reservation<br>
      <b>Service type:</b> Resort<br>
      <b>Resort Name:</b> {{$shelter[0]->name}}<br>
      <b>Member:</b> {{$reservations[0]->member}}<br>
      <b>ID No:</b> {{$reservations[0]->id_no}}
      @elseif($transaction[0]->type == "room")
      <b>Transaction:</b> Reservation<br>
      <b>Service type:</b> Room<br>
      <b>Room ID:</b> {{$room[0]->room_no}}<br>
      <b>Resort:</b> {{$shelter[0]->name}}<br>
      <b>Member:</b> {{$reservations[0]->member}}<br>
      <b>ID No:</b> {{$reservations[0]->id_no}}
      @elseif($transaction[0]->type == "Boat" || $transaction[0]->type == "Yacht")
      <b>Transaction:</b> Booking<br>
      <b>Service type:</b> {{$transaction[0]->type}}<br>
      <b>Service title:</b> {{$service[0]->title}}<br>
      <b>Member:</b> {{$booking[0]->member}}<br>
      <b>ID No:</b> {{$booking[0]->id_no}}
      
      @elseif($transaction[0]->type == "Membership")
      <b>Transaction:</b> Subscription<br>
      <b>Service type:</b> {{$transaction[0]->type}}<br>
      @endif
    </div>
    
    <div class="col-sm-4 invoice-col">
      @if($transaction[0]->type == "resort" || $transaction[0]->type == "room")
      <b>Adult:</b> {{$reservations[0]->adults}}<br>
      <b>Children:</b> {{$reservations[0]->children}}<br>
      <b>Checkin:</b> {{$reservations[0]->checkin}}<br>
      <b>Checkout:</b> {{$reservations[0]->checkout}}<br>
      <b>Reservation Date:</b> {{$reservations[0]->created_at}}<br>
      <b>Approved:</b> 
      @if ($reservations[0]->approved == 1)
          yes
          @else
          no
      @endif
     @elseif($transaction[0]->type == "Boat" || $transaction[0]->type == "Yacht") 
     <b>Service Date:</b> {{$booking[0]->booked_date}}<br>
     <b>Duration:</b> {{$booking[0]->duration}}<br>
     <b>Booked Date:</b> {{$booking[0]->created_at}}<br>
     <b>Approved:</b> 
     @if ($booking[0]->approved == 1)
         yes
         @else
         no
     @endif
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
          <td>{{$transaction[0]->ref_id}}</td>
          <td>
            {{$transaction[0]->gateway}}
          </td>
          <td>{{$transaction[0]->curr}}</td>
          <td>{{$transaction[0]->amount}}</td>
          @if($transaction[0]->type == "resort" || $transaction[0]->type == "room")
          <td>{{$reservations[0]->discount}}</td>
          @elseif($transaction[0]->type == "Boat" || $transaction[0]->type == "Yacht")
          <td>{{$booking[0]->discount}}</td>
          @endif
          <td>{{$transaction[0]->status}}</td>
          
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
            <td>{{$transaction[0]->curr}}{{$transaction[0]->amount}}</td>
          </tr>
          <tr>
            <th>Tax:</th>
            <td>{{$transaction[0]->curr}}0</td>
          </tr>
          @if($transaction[0]->type == "resort" || $transaction[0]->type == "room")
          <tr>
            <th>Discount:</th>
            <td>{{$reservations[0]->curr}}{{$reservations[0]->discount}}</td>
          </tr>
          @elseif($transaction[0]->type == "Boat" || $transaction[0]->type == "Yacht")
          <tr>
            <th>Discount:</th>
            <td>{{$booking[0]->curr}}{{$booking[0]->discount}}</td>
          </tr>
          @endif
          <tr>
            <th>Total:</th>
            <td>{{$transaction[0]->curr}}{{$transaction[0]->amount}}</td>
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
      <a href="{{url('admin/print_transaction/'.$transaction[0]->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
      
      
      
      
    </div>
  </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>
</div>

  





        @include('inc.footer')

      </body>
      </html>
      
          @endsection
