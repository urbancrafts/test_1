@extends('layouts.app')

      @section('content')
		<!-- Page loader -->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    
    
		@include('inc.header')

    @include('inc.dashboard-side-bar')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Notification
        <small>{{$notifications[0]->note_type}}</small>
      </h1>
     
    </section>

    <!-- Main content -->
    

    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    {{$notifications[0]->created_at}}
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              @if($notifications[0]->note_type == "Payment Transaction")
              <i class="fa fa-money bg-blue"></i>
              @elseif($notifications[0]->note_type == "Membership Subscription")
              <i class="fa fa-user bg-aqua"></i>
              @elseif($notifications[0]->note_type == "Blog Comment")
              <i class="fa fa-comments bg-yellow"></i>
              @elseif($notifications[0]->note_type == "Welcome") 
              <i class="fa fa-users bg-blue"></i>
              @endif

              <div class="timeline-item">
                

                <h3 class="timeline-header">{{$notifications[0]->note_type}}</h3>

                <div class="timeline-body">
                  {!!$notifications[0]->msg!!}
                </div>
                
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
           
            
            
            
            
           
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

     

    </section>


    <!-- /.content -->
  </div>




        @include('inc.footer')
		
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

</body>
</html>

		@endsection