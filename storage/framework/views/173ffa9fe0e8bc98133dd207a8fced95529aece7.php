

<?php $__env->startSection('content'); ?>
<!-- Page loader -->

<style>

a.book-btn, a.del-btn, a.edit-btn{
  border: solid 1px steelblue;
  border-radius: 5px;
  padding: 2px;
}

  fieldset.resort-features{
    border: solid 2px steelblue;
    border-radius: 10px;
  }
  
  fieldset.resort-features legend {
    background:#333;
    color: lightgray;
    width: 160px;
    font-weight: bold;
    border-radius: 10px;
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
  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPxcQlAZ_LWl4EZtHU27zTv3CFpCaSQ_A&libraries=places&callback=initAutocomplete" async defer></script>
  <script type="text/javascript">
    function initAutocomplete() {
      // Create the autocomplete object, restricting the search to geographical
      // location types.
      autocomplete = new google.maps.places.Autocomplete(
          /** @type  {!HTMLInputElement} */(document.getElementById('location')),
          {types: ['geocode']});
  
      // When the user selects an address from the dropdown, populate the address
      // fields in the form.
      autocomplete.addListener('place_changed', fillInAddress);
    }
  
    function fillInAddress() {
      // Get the place details from the autocomplete object.
      var place = autocomplete.getPlace();
  
    }
      </script>
  
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
  
  
  
      $('form#service-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var formdata = new FormData(this);//create an instance for the form input fields
if($.trim($('#category').val()) == ""){
  $('#category').css('border', 'solid 1px red');
  $('.resort-category-error').show();
}else if($.trim($('#name').val()) == ""){
     $('#name').css('border', 'solid 1px red');
     $('.resort-name-error').show(); 
}else if($.trim($('#price').val()) !="" && !Number($('#price').val())){
     $('#price').css('border', 'solid 1px red');
     $('.resort-price-error').show();
     $('.resort-price-error').html('(*Price field accepts numeric value only)');  
}else if($.trim($('#location').val()) == ""){
    $('#location').css('border', 'solid 1px red');
    $('.resort-location-error').show();
  }else if($.trim($('#desc').val()) == ""){
  $('#desc').css('border', 'solid 1px red');
  $('.resort-desc-error').show();
}else if($.trim($('#img-1').val()) == ""){
    $('.img-1').css('border-color', 'red');
    $('.form-error').show();
  }else{
     $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: action,
         data: formdata,
         cache: false,
         contentType: false,
         processData: false,
         beforeSend:function(){
             $(".blog-alert-success").show();
             $('.blog-alert-danger').hide();
             $(".blog-alert-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
         $(".blog-alert-success").hide();
         $(".blog-alert-danger").show();
         $(".blog-alert-danger").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              $("#sendEmail").prop('disabled', true);
              $(".blog-alert-success").show();
              $(".blog-alert-success").html(data.message);
              location.reload();
            }else if(data.success == false){
              $(".blog-alert-success").hide();
              $(".blog-alert-danger").show();
              $(".blog-alert-danger").html(data.message);
            }else{
              $(".blog-alert-success").hide();
              $(".blog-alert-danger").show();
              $(".blog-alert-danger").html(data);
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

  <?php echo $__env->make('inc.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->make('inc.dashboard-side-bar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>Services</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" id="blog-body">
         
            <div class="card card-info">
                <div class="card-header">
                 
    
                  <h3 class="card-title"> <i class="fa fa-home"></i> Create Service</h3>
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
                  <form id="service-form" action="<?php echo e(action('App\Http\Controllers\AjaxRequestController@post_service')); ?>" method="post" enctype="multipart/form-data">
                   
                   <input type='hidden' id='curr' name='curr' value='<?php echo e($settings[0]->curr); ?>' />
                   <div class="form-group">
                    <span style="color: red; display: none" class="resort-category-error">(*Required)</span>
                  <select id="category" name="category" class="form-control">
                      <option disabled selected>Select service category</option>
                      <option value="Boat">Boat</option>
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
                        <span style="color: red; display: none" class="resort-location-error">(*Required)</span>
                        <input type="text" class="form-control pac-target-input valid" id="location" name="location" data-validation="required" placeholder="Enter a location" autocomplete="off">
                       
                    </div>

                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-desc-error">(*Required)</span>
                    <textarea id="desc" name="desc" placeholder="Enter info about service"
                                style="width: 100%; height: 70px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    
                    
                    
                    <div class="col-xs-12 image-container image-container-bi" id="add-property-image-container">

                      <div class="row">
                          <p>Images <span class="dim-size">Supported Formats JPG, JPEG, PNG 600 X 400 PX (Max 10 MB)</span></p>
                           <div class="col-xs-12 col-sm-4 col-md-2">
                              <input type="file" id="img-1" class="uploadFile" accept="image/x-png, image/jpeg, image/jpg" name="img_1" data-validation-allowing="jpg, png, jpeg">
                              <div class="file-input-button text-center img-1" style="background-image: url(&quot;&quot;);">
                                  <i class="fa fa-2x fa-plus-circle" aria-hidden="true"></i>
      
                              </div>
      
                              <h5 class="error-file-size" style="display: none"></h5>
                              
                              <span class="help-block form-error" style="display: none">This is a required field</span>
                           </div>
                          <div class="col-xs-12 col-sm-4 col-md-2">
                              <input type="file" class="uploadFile" name="img_2" accept="image/x-png, image/jpeg, image/jpg" data-validation-allowing="jpg, png, jpeg">
                              <div class="file-input-button text-center" style="background-image: url(&quot;&quot;);">
                                  <i class="fa fa-2x fa-plus-circle" aria-hidden="true"></i>
                              </div>
                              <h5 class="error-file-size" style="display: none"></h5>
                              
                          </div>
                          <div class="col-xs-12 col-sm-4 col-md-2">
                              <input type="file" class="uploadFile" name="img_3" accept="image/x-png, image/jpeg, image/jpg" data-validation-allowing="jpg, png, jpeg">
                              <div class="file-input-button text-center" style="background-image: url(&quot;&quot;);">
                                  <i class="fa fa-2x fa-plus-circle" aria-hidden="true"></i>
                              </div>
                              <h5 class="error-file-size" style="display: none"></h5>
                              
                          </div>
                          <div class="col-xs-12 col-sm-4 col-md-2">
                              <input type="file" class="uploadFile" name="img_4" accept="image/x-png, image/jpeg, image/jpg" data-validation-allowing="jpg, png, jpeg">
                              <div class="file-input-button text-center" style="background-image: url(&quot;&quot;);">
                                  <i class="fa fa-2x fa-plus-circle" aria-hidden="true"></i>
                              </div>
                              <h5 class="error-file-size" style="display: none"></h5>
                              
                          </div>
                          
                          
                      </div>
      
                  </div>
                    
                    

                    <div class="card-footer clearfix">
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

            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                  <h3 class="card-title">List of Services</h3>
    
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
                 <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 
                 
                 <li class="item">
                   
                  <div class="product-img">
                    <img src="<?php echo e(asset('storage/img/services/'.$service->img)); ?>" alt="<?php echo e($service->title); ?>">
                  </div>
                  <div class="product-info">
                    <a href="#" class="product-title"><?php echo e($service->title); ?>

                      <span class="badge badge-warning float-right">
                      
                          <?php echo e($service->category); ?>

                      
                      </span></a>
                    <span class="product-description">
                          <?php echo e($service->about); ?>

                        </span>
                        <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin" || $service->created_by == Auth::user()->id): ?>
                     <a href="#" class="fa fa-trash del-btn" onclick="deleteService('<?php echo e($service->id); ?>','<?php echo e($service->title); ?>')" title="Delete <?php echo e($service->title); ?>">Delete</a> | 
                     <a href="<?php echo e(url('admin/book_service/'.$service->id)); ?>" class="fa fa-book book-btn" title="Book <?php echo e($service->title); ?>">Booking</a> 
                     <?php endif; ?>
                  </div>
                </li>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    

                    
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

      </div>
    </section>

    

    <!-- /.content -->
  </div>





        <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
        <script src="<?php echo e(asset('request_upload/main.js')); ?>"></script>
        
        <script src="<?php echo e(asset('request_upload/image-upload.js')); ?>"></script>
        <script>
          
          new ImageUploadOperations();

      </script>
	



<!-- jQuery -->
<script src="<?php echo e(asset('plugins_2/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('plugins_2/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('plugins_2/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
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



<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist_2/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('dist_2/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist_2/js/demo.js')); ?>"></script>

</body>
</html>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/services.blade.php ENDPATH**/ ?>