@extends('layouts.app')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

      @section('content')
		<!-- Page loader -->

    
		@include('inc.header')

    @include('inc.dashboard-side-bar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>Services</small>
      </h1>
      
    </section>
    @include('inc.messages')
    <!-- Main content -->
    <section class="content">
     
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" id="blog-body">
         
            <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-home"></i>
    
                  <h3 class="box-title">Create Service</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                      <i class="fa fa-times"></i></button>
                  </div>
                  <!-- /. tools -->
                </div>
                <div class="box-body">
                  <form id="service-form" action="{{ action('App\Http\Controllers\AjaxRequestController@post_service') }}" method="post" enctype="multipart/form-data">
                   
                   <input type='hidden' id='curr' name='curr' value='{{$settings[0]->curr}}' />
                   <div class="form-group">
                    <span style="color: red; display: none" class="resort-category-error">(*Required)</span>
                  <select id="category" name="category" class="form-control">
                      <option disabled selected>Select service category</option>
                      <option value="Resort">Resort</option>
                      <option value="Boat Cruise">Boat Cruise</option>
                      <option value="Club Activity">Club Activity</option>
                      <option value="Others">Others</option>
                  </select>
                </div> 
                   <div class="form-group">
                        <span style="color: red; display: none" class="resort-name-error">(*Required)</span>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Service title" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-price-error"></span>
                        <input type="number" class="form-control" id="price" name="price" placeholder="price" >
                      </div>

                
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-desc-error">(*Required)</span>
                    <textarea id="desc" name="desc" placeholder="Enter info about service"
                                style="width: 100%; height: 70px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    
                    
                    <div class='form-group'><span style='color: red; display: none' class='resort-media-error'></span><input type='file' title='Browse for media file' id='resort-img1' name='img_1' /></div>
                    <div class='form-group'><input type='file' title='Browse for media file' id='resort-img2' name='img_2' /></div>
                    
                    

                    <div class="box-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default" id="sendEmail">Submit
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
        
        
        

        <section class="col-lg-5 connectedSortable">

            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Gallery</h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                 @foreach ($galleries as $gallery)
                 <li class="item">
                  <div class="product-img">
                    <img src="{{asset('storage/img/gallery/'.$gallery->file_1)}}" alt="{{$service->title}}">
                  </div>
                  <div class="product-info">
                    <a href="#" class="product-title">{{$gallery->category}}
                      </a>
                    <span class="product-description">
                          {{$gallery->cnt}}
                        </span>
                        @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin")
                     <a href="#" class="fa fa-trash" onclick="deleteGallery('{{$gallery->id}}')" title="Delete {{$gallery->category}}"></a>
                      @endif
                  </div>
                </li>
                 @endforeach
                    

                    
                  </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Products</a>
                </div>
                <!-- /.box-footer -->
              </div>

        


        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

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