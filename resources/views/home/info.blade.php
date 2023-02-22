@extends('layouts.app')
@section('content')
		<!-- Page loader -->

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
        Admin
        <small>Site Settings</small>
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
                  
    
                  <h3 class="card-title"> <i class="fa fa-gear"></i>Update site settings</h3>
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
                    @if ($settings[0]->logo != "")
                        <img src="{{asset('storage/img/site_logo/'.$settings[0]->logo)}}" width="150" height="90" />
                    @endif
                    @if ($settings[0]->icon != "")
                        <img src="{{asset('storage/img/site_icon/'.$settings[0]->icon)}}" width="150" height="90" />
                    @endif
                  <form id="settings-form" action="{{ action('App\Http\Controllers\AjaxRequestController@update_settings') }}" method="post" enctype="multipart/form-data">
                   
                   
                
                   <div class="form-group">
                        <span style="color: red; display: none" class="resort-curr-error">(*Required)</span>
                      <input type="text" class="form-control" id="curr" name="curr" value="{{$settings[0]->curr}}" placeholder="Currency" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-logo-error">(*Required)</span>
                      <input type="file" class="form-control" id="logo" name="logo"  title="browse for site logo" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-icon-error">(*Required)</span>
                      <input type="file" class="form-control" id="icon" name="icon"  title="browse for site icon" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-leng-error">(*Required)</span>
                      <input type="text" class="form-control" id="lang" name="lang" value="{{$settings[0]->language}}" placeholder="Language" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-tel-error">(*Required)</span>
                        <input type="number" class="form-control" id="tel" name="tel" value="{{$settings[0]->tel}}" placeholder="Tel" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-mobile-error"></span>
                        <input type="number" class="form-control" id="mobile" name="mobile" value="{{$settings[0]->mobile}}" placeholder="Mobile number" >
                      </div>
                      
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-email-error"></span>
                        <input type="email" class="form-control" id="email" name="email" value="{{$settings[0]->email}}" placeholder="Email address" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-address-error"></span>
                        <textarea class="form-control" id="address" name="address" placeholder="Office address">{{$settings[0]->address}}</textarea>
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-payment-error"></span>
                        <select id="payment-type" name="payment-type" class="form-control">
                            @if ($settings[0]->payment_type != "")
                            <option value="{{$settings[0]->payment_type}}">{{$settings[0]->payment_type}}</option>
                                
                            @else
                            <option disabled selected>payment type</option>
                            @endif
                            @if ($settings[0]->payment_type == "mobile")
                            <option value="web">web</option>  
                            @endif
                            @if ($settings[0]->payment_type == "web")
                            <option value="mobile">mobile</option> 
                            @endif
                            
                            
                        </select>
                      </div>
                        
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-discount-error"></span>
                        <input type="number" class="form-control" id="discount" name="discount" value="{{$settings[0]->memb_discount}}" placeholder="Members discount by percent(%)" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-discount-error"></span>
                        <input type="number" class="form-control" id="credit" name="credit" value="{{$settings[0]->memb_debt_capacity}}" placeholder="Members credit limit" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-mem-fee-error"></span>
                        <input type="number" class="form-control" id="mem_fee" name="mem_fee" value="{{$settings[0]->membership_fee}}" placeholder="Membership fee" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-fb-error"></span>
                        <input type="text" class="form-control" id="fb" name="fb" value="{{$settings[0]->facebook}}" placeholder="Facebook pages" >
                      </div>
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-insta-error"></span>
                        <input type="text" class="form-control" id="insta" name="insta" value="{{$settings[0]->instagram}}" placeholder="Instagram page" >
                      </div>
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-twitter-error"></span>
                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{$settings[0]->twitter}}" placeholder="Twitter handle" >
                      </div>
                       
                      

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-sname-error"></span>
                        <input type="text" class="form-control" id="site-name" name="site-name" value="{{$settings[0]->site_name}}" placeholder="Site name" >
                      </div>
                      <div class="form-group">
                      @if ($settings[0]->status == 1)
                      <input type="radio" name="status" id="status" value="1"  checked><label>On</label> <input type="radio" name="status" id="status" value="0"><label>Off</label>   
                      @elseif($settings[0]->status == 0)  
                      <input type="radio" name="status" id="status" value="1" ><label>On</label> <input type="radio" name="status" id="status" value="0" checked><label>Off</label>      
                      @endif
                      </div>
                    <div class="card-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default" id="sendEmail">Update
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
        
        
        

        
      </div>
      <!-- /.row (main row) -->

    </section>

    

    <!-- /.content -->
  </div>


@include('inc.footer')

<!-- jQuery -->
<script src="{{asset('plugins_2/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins_2/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins_2/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
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



<!-- AdminLTE App -->
<script src="{{asset('dist_2/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist_2/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist_2/js/demo.js')}}"></script>

</body>
</html>
		@endsection
