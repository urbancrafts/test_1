

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

      fieldset.resort-features .line-thick{
        border: solid 1px black;
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
  
  
  
$('form#create-room-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#name').val()) == ""){
     $('#name').css('border', 'solid 1px red');
     $('.resort-name-error').show();
     $('.resort-name-error').html('*Required');
}else if($.trim($('#price').val()) =="" ){
     $('#price').css('border', 'solid 1px red');
     $('.resort-price-error').show();
     $('.resort-price-error').html('*Required');  
}else if(!Number($('#price').val())){
     $('#price').css('border', 'solid 1px red');
     $('.resort-price-error').show();
     $('.resort-price-error').html('*Price field accepts numeric value only');  
}else if($.trim($('#qnty').val()) == ""){
  $('#qnty').css('border', 'solid 1px red');
  $('.resort-qnty-error').show();
  $('.resort-qnty-error').html('*Required');  
}else if($.trim($('#capacity').val()) == ""){
  $('#capacity').css('border', 'solid 1px red');
  $('.resort-capacity-error').show();
  $('.resort-capacity-error').html('*Required');  
}else if($.trim($('#desc').val()) == ""){
  $('#desc').css('border', 'solid 1px red');
  $('.resort-desc-error').show();
  $('.resort-desc-error').html('*Required');
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
             $("#sendEmail").prop('disabled', true);
             $('#sendEmail').html("<img src='<?php echo e(asset('loaders/AjaxLoader.gif')); ?>' />");
             //$(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
          $(".alert-warning").css('display', 'block');
          $(".alert-danger").css('display', 'none');
          $(".upload-error").html("<img src='<?php echo e(asset('icons/ic_connections.png')); ?>' /> Please check your internet connection or refresh your browser");
          $("#sendEmail").prop('disabled', false);
          $('#sendEmail').html("Submit");
         },
         success:function(data){
            if(data.success == true){
             $(".alert-success").css('display', 'block');
             $(".alert-danger").css('display', 'none');
             $(".alert-warning").css('display', 'none');
             $(".upload-success").html(data.message);
             $("#sendEmail").prop('disabled', false);
             $('#sendEmail').html("Submit");
             window.location = "<?php echo e(url('')); ?>/admin/resort_manager/edit_room_img/"+data.data.shelter_id+"/"+data.data.id;
            
             //loadResortModal(data.data.id,data.data.name);
            }else if(data.success == false){
              $(".alert-danger").css('display', 'block');
              $(".alert-success").css('display', 'none');
              $(".alert-warning").css('display', 'none');
              $(".upload-error").html(data.message);
            }else{
             $(".alert-danger").css('display', 'block');
             $(".alert-success").css('display', 'none');
             $(".alert-warning").css('display', 'none');
             $(".upload-error").html(data);
            }
              
         }
         });

}

});


  
  
  });
  
  

  function deleteRoom(resort,id,name){
  var str = confirm('Do you really want to delete '+name+'?');
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ResortController@delete_room')); ?>",
         data: {"resort":resort, "uid":id},
         beforeSend:function(){  
         },
         complete:function(){  
         },
         error:function(){
         },
         success:function(data){
            if(data.success == true){
              location.reload();
            }else if(data.success == false){
              alert(data.message);
            }else{
              alert(data);
            }
              
         }
         }); 
  }
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
        Resort
        <small>Edit <?php echo e($resorts2[0]->name); ?></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->

        <div class="col-md-12 grid-margin">

        
          <div class="tabSide">
            <div class="card card-body p-0" style="border: 2px solid #E51924; border-radius: 0px">
                <ul class="nav nav-pills nav-justified">
  <li class="nav-item">
    <a class="nav-link " href="<?php echo e(url('admin/resort_manager/resort/'.$resorts2[0]->id)); ?>">Edit form</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="<?php echo e(url('admin/resort_manager/edit_resort_img/'.$resorts2[0]->id)); ?>">Images</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="<?php echo e(url('admin/resort_manager/edit_resort_features/'.$resorts2[0]->id)); ?>">Features</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="<?php echo e(url('admin/resort_manager/create_room/'.$resorts2[0]->id)); ?>">Rooms</a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link " href="https://localhost/backend/administrator/product_manager/edit_pricing/122">Product Pricing</a>
  </li>
   -->
</ul>            </div>
          </div>


          <div class="alert alert-warning alert-dismissible" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
            <span class="upload-error"></span>
          </div>
  
          <div class="alert alert-danger alert-dismissible" style="display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            <span class="upload-error"></span>
          </div>
  
          <div class="alert alert-success alert-dismissible" style="display: none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            <span class="upload-success"></span>
          </div>
  


        </div>

        

        <section class="col-lg-7 connectedSortable" id="blog-body">
         
            <div class="card card-info">
                <div class="card-header">
                  
    
                  <h3 class="card-title"><i class="fa fa-hotel"></i> Create Room/Suit Categories</h3>
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
                  <form id="create-room-form" action="<?php echo e(action('App\Http\Controllers\ResortController@upload_rooms_info')); ?>" method="post" enctype="multipart/form-data">
                   
                   <input type='hidden' id='resort' name='resort' value='<?php echo e($resorts2[0]->id); ?>' />
                   <input type='hidden' id='location' name='location' value='<?php echo e($resorts2[0]->location); ?>' />
                   
                    <div class="form-group">
                      <label>Room Title</label>
                        <span style="color: red;" class="resort-name-error">*</span>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Title(Room/Suit)" >
                    </div>


                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Currency</label>
                          <select type='hidden' id='curr' name='curr' class="form-control">
                            <?php if( $resorts2[0]->curr == 'NGN'): ?>
                            <option value="<?php echo e($resorts2[0]->curr); ?>" selected><?php echo e($resorts2[0]->curr); ?> - ₦</option>
                            <option value="USD">USD - $</option>
                            <option value="EUR">EUR - €</option>
                            <option value="GBP">GBP - £</option>
                            <?php elseif($resorts2[0]->curr == 'USD'): ?>
                            <option value="<?php echo e($resorts2[0]->curr); ?>" selected><?php echo e($resorts2[0]->curr); ?> - $</option>
                            <option value="NGN">NGN - ₦</option>
                            <option value="EUR">EUR - €</option>
                            <option value="GBP">GBP - £</option>
                            <?php elseif($resorts2[0]->curr == 'EUR'): ?>
                            <option value="<?php echo e($resorts2[0]->curr); ?>" selected><?php echo e($resorts2[0]->curr); ?> - €</option>
                            <option value="NGN">NGN - ₦</option>
                            <option value="USD">USD - $</option>
                            <option value="GBP">GBP - £</option>
                            <?php elseif($resorts2[0]->curr == 'GBP'): ?>
                            <option value="<?php echo e($resorts2[0]->curr); ?>" selected><?php echo e($resorts2[0]->curr); ?> - £</option>
                            <option value="NGN">NGN - ₦</option>
                            <option value="USD">USD - $</option>
                            <option value="EUR">EUR - €</option>
                            <?php endif; ?>
                          </select>
                          
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Room Price</label>
                          <span style="color: red;" class="resort-price-error">*</span>
                          <input type="number" class="form-control" id="price" name="price" placeholder="price">
                        </div>
                      </div>
                    </div>

                    
                    <div class="row">
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Total Number Available</label>
                        <span style="color: red;" class="resort-qnty-error">*</span>
                        <input type="number" class="form-control" id="qnty" name="qnty" placeholder="Number of Rooms/Suits(Example: 6)" min="1">
                      </div>
                      </div>
                       
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Room Capacity</label>
                        <span style="color: red;" class="resort-capacity-error">*</span>
                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Room/Suit Capacity(Example: 3)" min="1">
                      </div>
                      </div>

                    </div>
                
                    <div class="form-group">
                      <label>Room Description</label>
                        <span style="color: red;" class="resort-desc-error">*</span>
                    <textarea id="desc" name="desc" placeholder="Enter description"
                                style="width: 100%; height: 70px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    
                    
                    
                    
                    
                    

                    <div class="card-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default" id="sendEmail">Submit
                        <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                   
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
                  <h3 class="card-title">List Of Rooms/Suits</h3>
    
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
                  <table id="example1" class="products-list product-list-in-box">
                    <thead>
                      <tr>
                        <td>Rooms</td>
                      </tr>
                    </thead>
                    <tbody>
                      
                 <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin" || $room->created_by == Auth::user()->id): ?>
                 <tr class="item" >
                  <td width='500'>
                  <div class="product-img">
                    <img src="<?php echo e($room->img_1); ?>" alt="<?php echo e($room->room_no); ?>">
                  </div>
                  <div class="product-info">
                    <a href="<?php echo e(url('admin/room/'.$room->shelter_id.'/'.$room->id)); ?>" class="product-title"><?php echo e($room->room_no); ?>

                      
                      <?php if($room->amount != ""): ?>
                      <span class="badge badge-warning float-right">
                          <?php echo e($room->curr); ?><?php echo e($room->amount); ?>

                        </span>
                      <?php endif; ?>  
                      </a>
                    <span class="product-description">
                          <?php echo e($room->location); ?>

                        </span>
                        
                     <a href="#" class="fa fa-trash del-btn" onclick="deleteRoom('<?php echo e($room->shelter_id); ?>','<?php echo e($room->id); ?>','<?php echo e($room->room_no); ?>')" title="Delete <?php echo e($room->room_no); ?>">Delete</a> | 
                     <a href="<?php echo e(url('admin/resort_manager/room/'.$room->shelter_id.'/'.$room->id)); ?>" class="fa fa-edit edit-btn" title="Edit <?php echo e($room->room_no); ?>">Edit</a> | 
                     <a href="<?php echo e(url('admin/resort_manager/book_room/'.$room->shelter_id.'/'.$room->id)); ?>" class="fa fa-calendar book-btn" title="<?php echo e($room->room_no); ?> bookings">Bookings</a>
                     
                  </div>
                </td>
              </tr>
                <?php endif; ?>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                </tbody>

                <tfoot class="card-footer text-center">
                  <tr>
                    <td>Rooms</td>
                  </tr>
                </tfoot>
              </table>
                </div>
                <!-- /.box-body -->
                
                <!-- /.box-footer -->
              </div>

        
              <div class="modal" id="modal-elemet">
        
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
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      //"buttons": ["copy", "csv", "excel", "pdf", "print"]
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

</body>
</html>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/create_room.blade.php ENDPATH**/ ?>