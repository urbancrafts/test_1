@extends('layouts.app')

      @section('content')
		<!-- Page loader -->
<style>
.share-fb{
  color: blue !important;
}
.share-twitter{
  color: skyblue !important;
}
.share-whatsapp{
  color: teal !important;
}

.jng-forms>.uploadFile {
      height: 100% !important;
  }
  
  .file-input-button {
      background-position: center;
      background-size    : cover;
  }
  
  .image-container {
         padding: 0;
  }
  
  .file-input-button {
      background-position: center;
      background-size    : cover;
  }
  
  .image-container div {
      padding      : 0 10px 0 0;
      margin-bottom: 10px;
      height       : auto;
      cursor       : pointer;
  }
  
  .image-container div:last-child {
      /*  padding-right: 0; */
  }
  
  .image-container input[type=file] {
      z-index : 10;
      opacity : 0;
      border  : none !important;
      margin  : 0 !important;
      padding : 0;
      height  : 100px;
      width   : 100%;
      cursor  : pointer;
      position: absolute;
  }
  
  .image-container .error-file-size,
  .image-container .error-file-weight {
      bottom: -39px;
  }
  
  .flat.image-container .error-file-size {
      top             : 0 !important;
      left            : 0;
      background-color: rgba(242, 242, 242, .8);
      border          : 1px dashed;
      width           : calc(100% - 10px);
      height          : 100%;
      z-index         : -1;
      margin          : 0;
      padding         : 10px 5px !important;
  }
  
  .category.image-container .error-file-size {
      bottom: -25px;
  }
  
  input[type=file]:focus {
      outline: none !important;
  }
  
  .feature-list {
      display: inline;
  }
  
  .feature-list li {
      display: inline-block;
  }
  
  .image-container .file-input-button {
      /* position        : absolute;*/
      top             : 0;
      z-index         : 1;
      border          : 2px dashed #ccc;
      padding         : 0;
      height          : 100px;
      /*width         : 100% !important;*/
      width           : calc(100% - 10px) !important;
      margin-right    : 0;
      background-color: #f2f2f2;
      cursor          : pointer;
  }
  
  .image-container.file-input-div-admin {
      /*width: 100% !important;*/
  }
  
  .image-container .file-input-button .fa-plus-circle {
      position        : relative;
      top             : 40px;
      color           : #02acfa;
      background-color: #FFFFFF;
      padding         : 1px 2px 0;
      border-radius   : 50%;
      font-size       : 19px;
  }
  
  .image-container .file-input-button .fa-times-circle {
      font-size: 26px;
      transform: translate(-50%, -50%);
      position : absolute;
      top      : 50%;
      left     : 50%;
      color    : red;
  
  }
  
  .all-images.modal-dialog.modal-md {
      transform: translate(-50%, -50%) !important;
      position : absolute;
      /* top   : 50%; */
      left     : 50% !important;
  }
  .see-all-photos-modal .modal-content{
      padding:30px;
  }
  .image-container .help-block {
      position               : absolute;
      /* padding             : 2px 5px; */
      /*  top                : 6px; */
      margin                 : 0;
      background-color       : rgba(256, 256, 256, .8);
      font-size              : 12px !important;
      color                  : #a94442;
      font-weight            : 500;
  }
  
  .existing-images-wrap {
      padding: 0;
  }
  
  .existing-images-wrap>div {
      padding: 0 8px 8px 0;
  }
  
  /*flat file input buttons*/
  
  .flat.image-container div {
      height: 75px;
  }
  
  .flat.image-container div:nth-child(3n) {
      padding-right: 0;
  }
  
  .flat.image-container input[type=file] {
      height: 75px;
  }
  
  .flat.image-container .file-input-button {
      height: 75px;
      top   : 0;
  }
  
  .flat.image-container .file-input-button .fa-plus-circle,
  .flat.image-container .file-input-button .fa-times-circle {
      top: 28px;
  }
  
  /*category file input buttons*/
  
  .category.image-container div {
      position: relative;
      padding : 0;
      margin  : 0;
      height  : 120px;
      cursor  : pointer;
      width   : 100% !important;
  }
  
  .category.image-container input[type=file] {
      height: 120px;
  }
  
  .category.image-container .file-input-button {
      height: 120px;
      top   : -120px;
  }
  
  .category.image-container .file-input-button .fa-plus-circle,
  .category.image-container .file-input-button .fa-times-circle {
      top: 50px;
  }
  
  /*old need to replace*/
  
  .file-input-div {
      position: relative;
      border  : 1px solid #4b5867;
  }
  
  .file-input-div input {
      opacity      : 0;
      width        : 100% !important;
      height       : 122px;
      margin-bottom: 0 !important;
      padding      : 0;
      top          : 0 !important;
  }
  
  .file-input-div h5 {
      position  : absolute;
      top       : 46%;
      width     : 100%;
      text-align: center;
      z-index   : 0;
      margin    : 0;
      padding   : 0;
      left      : 0 !important;
  }
  
  
  #btn-property-image-add,
  #btn-property-image-edit {
      position        : absolute;
      top             : 0;
      float           : left !important;
      margin          : 0 !important;
      color           : white !important;
      border          : 1px solid #02acfa !important;
      background-color: #02acfa;
      border-radius   : 0;
  }
</style>
<script type="text/javascript">
$(document).ready(function(){


  $(function () {
        $(".image-container-bi").on("change", ".uploadFile", function () {
          var objFile = $(this);
          var files = !!this.files ? this.files : [];
          if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    
          if (/^image/.test(files[0].type)) {
            // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
    
            reader.onloadend = function () {
              // set image data as background of div
              var fileSize = files[0].size;
              objFile.siblings(".error-file-size").hide();
              if (fileSize / (1024 * 1024) > 10) {
                resetImage(objFile);
                objFile
                  .siblings(".error-file-size")
                  .text("Banner Image must be under 10MB ")
                  .show();
              } else {
                objFile
                  .next(".file-input-button")
                  .css("background-image", "url(" + this.result + ")");
                objFile
                  .next(".file-input-button")
                  .find(".fa-plus-circle")
                  .addClass("fa-times-circle");
                objFile
                  .next(".file-input-button")
                  .find(".fa-plus-circle")
                  .removeClass("fa-plus-circle");
              }
            };
    
            var img = new Image();
            img.onload = function () {
              if (this.width < 600 || this.height < 400) {
                resetImage(objFile);
                objFile
                  .siblings(".error-file-size")
                  .text("Image dimension should be above 600px x 400px ")
                  .show();
              }
            };
            var _URL = window.URL || window.webkitURL;
            img.src = _URL.createObjectURL(files[0]);
          }
        });
    
        $(".image-container-bi").on("click", ".uploadFile", function (e) {
          var objFile = $(this);
          var files = !!this.files ? this.files : [];
          if (!files.length || !window.FileReader) {
            // do selection
          } else {
            e.preventDefault();
            resetImage(objFile);
          }
        });
      });
 
       $total_record = {{count($users)}};
			 $record_per_page = 9;
			 $numer_of_page = ($total_record / $record_per_page);
			 $current_page = 1;
			 $start = Math.ceil($current_page * $record_per_page) - $record_per_page;
       loadHomeBlog($record_per_page, $start);

  function loadHomeBlog($record_per_page, $start){

    $action = "loadHomeBlogs";
			   $.ajax({
				headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 },
				 type: "POST",
			   dataType: "json",
			   url: "{{ action('App\Http\Controllers\AjaxRequestController@load_home_blog') }}",
			   data: {"record_per_page": $record_per_page, "start": $start, "action": $action},
			   beforeSend:function(){
				   $("#load-home-blog").append("<div class='load'><img src='{{ asset('loaders/loader.gif')}}'/ > Loading...</div>");
			   },
			   complete:function(){
				   $(".load").remove();
			   },
			   error:function(){
			   $("#load-home-blog").append("<div class='errLoading'><img src='{{asset('icons/ic_connections.png')}}'/ > Please check your internet connection</div>");
			   },
			   success:function(data){
				   if(data.success == true){
					$("#load-home-blog").append(data.data);
				     
					
				  }else if(data.success == false){
					$("#load-home-blog").append(data.message);
				  }else{
					$("#load-home-blog").append(data);
				  }
					
			   }
			   });

  }

  $current_page = 2;
			 $(window).scroll(function(){
			 if($(window).scrollTop()+window.innerHeight == $(document).height()){
			 $start = ($current_page * $record_per_page) - $record_per_page;
			  if($current_page <= $numer_of_page){
          loadHomeBlog($record_per_page, $start);
			   
			  }
			 }
			 });
			 
			 
			 setInterval(function(){
			 
			 },130000);
			 
			 setInterval(function(){
			 
			 },120000);
	  

});

function makeComment(elem, id){
  var field = $("#"+elem);
  
    $(field).keypress(function(e){
      
     if(e.keyCode == 13){
       
      if($.trim(field.val()) == ""){
      alert('comment box cannot empty');
      }else{
       $.ajax({
				headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 },
				 type: "POST",
			   dataType: "json",
			   url: "{{ action('App\Http\Controllers\AjaxRequestController@post_blog_comment') }}",
			   data: {"comment": field.val(), "blog-id": id},
			   beforeSend:function(){
				   $("#blog_comment_"+id).append("<div class='load'><img src='{{ asset('loaders/loader.gif')}}'/ > Loading...</div>");
			   },
			   complete:function(){
				   $(".load").remove();
			   },
			   error:function(){
			 
			   },
			   success:function(data){
				   if(data.success == true){
         
					$("#blog_comment_"+id).html(data.data);
				  field.val("");
					
				  }else if(data.success == false){
					$("#blog_comment_"+id).append(data.data);
				  }else{
					$("#blog_comment_"+id).append(data);
				  }
					
			   }
			   });

        }
     }
    });
}
</script>

  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    
		@include('inc.header2')

    @include('inc.dashboard-side-bar2')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
    @include('inc.messages')

  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      @if ($myselfs[0]->user_type == "member" && $myselfs[0]->dues == 0)
          
      <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        {{Auth::user()->name}}, pay your membership fee to become an active member on this platform, to do so click <a href="{{ url('admin/member_subscription') }}">subscribe</a>.
      </div>
          
      @endif
      

      <!-- Small boxes (Stat box) -->
      @if (Auth::user()->role ==1 || Auth::user()->user_type == "admin")
      
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count($reservations) + count($bookings)}}</h3>

              <p>New Bookings</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="{{ url('admin/reservations') }}" class="small-box-footer">See info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        

        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{count($orders)}}</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('admin/shop_orders') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{count($transactions)}}</h3>

              <p>Transactions</p>
            </div>
            <div class="icon">
              <i class="fa fa-bar-chart"></i>
            </div>
            <a href="{{ url('admin/transactions') }}" class="small-box-footer">See info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{count($visited)}}</h3>

              <p>Visitors</p>
            </div>
            <div class="icon">
              <i class="fa fa-eye"></i>
            </div>
            <a href="{{ url('admin/site_visitors')}}" class="small-box-footer">See info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      
      @endif

     

      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" id="blog-body">
         
            <div class="card card-info">
                <div class="card-header">
                  
                  <h3 class="card-title"><i class="fa fa-commenting"></i> Blog</h3>
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
                  <form id="blog-form" action="{{ action('App\Http\Controllers\AjaxRequestController@make_blog_post') }}" method="post" enctype="multipart/form-data">
                   <input type="hidden" id="uid" name="uid" value="{{Auth::user()->id}}" />
                   <input type="hidden" id="poster-name" name="poster-name" value="{{Auth::user()->name}}" />
                   @if(Auth::user()->user_type == "admin")
                   <div class="form-group">
                     <select name="category" id="category" class="form-control">
                      <option selected disabled>Select Blog Category</option>
                      <option value="kitchen">Kitchen</option>
                      <option value="beach_hangout">Beach Hangout</option>
                      <option value="beach_sports">Beach Sports</option>
                      <option value="beach_tourism">Beach Tourism</option>
                      <option value="beach_therapy">Beach Therapy</option>
                      <option value="boat_and_yacht_cruise">Boat and Yacht Cruise</option>
                     </select>
                   </div>
                   @endif
                   <div class="form-group">
                      <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div>
                      <textarea class="textarea" id="blog-content" name="blog-content" placeholder="Content"
                                style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>


                    <div class="col-xs-12 image-container image-container-bi" id="add-property-image-container">

                      <div>
                          <p>Images <span class="dim-size">Supported Formats JPG, JPEG, PNG 600 X 400 PX (Max 10 MB)</span></p>
                           <div class="col-xs-12 col-sm-4 col-md-2">
                              <input type="file" id="img-1" class="uploadFile" accept="image/x-png, image/jpeg, image/jpg" name="blog-file" data-validation-allowing="jpg, png, jpeg">
                              <div class="file-input-button text-center img-1" style="background-image: url(&quot;&quot;);">
                                  <i class="fa fa-2x fa-plus-circle" aria-hidden="true"></i>
      
                              </div>
      
                              <h5 class="error-file-size" style="display: none"></h5>
                              
                              <span class="help-block form-error" style="display: none">This is a required field</span>
                           </div>
                          
                          
                          
                      </div>
      
                  </div>

                    

                    <div class="card-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default" id="sendEmail">Post
                        <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                   <span class="alert alert-danger blog-alert-danger" style="display: none"></span><span class="alert alert-success blog-alert-success" style="display: none"></span>
                  </form>
                </div>
                
              </div>

        
              

          
        


              <div class="row" id="load-home-blog">
                
               
                

              </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        

        
        
        <div class="col-md-4">
          <!-- USERS LIST -->
          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">Latest Members</h3>

              <div class="card-tools float-right">
                <span class="badge badge-danger">{{count($members)}} New Members</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body no-padding">
              <ul class="users-list clearfix">
                @if (count($members) > 0)
                
                @foreach ($members as $member)
                <li>
                  @if ($member->img != "")
                  <img src="{{asset('storage/img/users/'.$member->id.'/profile/'.$member->img)}}" alt="{{$member->name}}">
                       
                   @else
                   <img src="{{asset('storage/img/users/default.png')}}" alt="{{$member->name}}">   
                   @endif
                  
                  
                  <a class="users-list-name" href="{{ url('users/profile/'.$member->id)}}">{{$member->name}}</a>
                  <span class="users-list-date">{{$member->create_at}}</span>
                </li> 
                @endforeach

                @else

                @endif
                
                
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="card-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View All Users</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->


          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">List of services</h3>

              <div class="card-tools float-right">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <ul class="products-list product-list-in-box">
            
             <li class="item">
              
              <div class="product-info">
                
                <a href="{{ url('resorts') }}" class="product-title">Resort Reservation
                </a>
                
              </div>
            </li>

            <li class="item">
              <div class="product-info">
            <a href="{{ url('boat') }}" class="product-title">Boat Booking
            </a>
          </div>
        </li>
        
        <li class="item">
          <div class="product-info">
            <a href="#" class="product-title">Beach Sports
            </a>
          </div>
        </li>
        <li class="item">
          <div class="product-info">
            <a href="#" class="product-title">Boat & Yacht Party
            </a>
          </div>
        </li>  
                

                
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="card-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View More</a>
            </div>
            <!-- /.box-footer -->
          </div>


        </div>


       

        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>





        @include('inc.footer')

        <script src="{{asset('request_upload/main.js')}}"></script>
        
        <script src="{{asset('request_upload/image-upload.js')}}"></script>
        <script>
          
          new ImageUploadOperations();

      </script>

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