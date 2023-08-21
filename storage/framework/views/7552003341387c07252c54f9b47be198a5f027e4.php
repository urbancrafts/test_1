

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- core:css -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/core.css')); ?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  
  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/iconfont.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/flag-icon.min.css')); ?>">
  <!-- endinject -->
  <!-- Layout styles -->  
  

<link rel="stylesheet" href="<?php echo e(asset('assets/css/dropzone.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/dropify.min.css')); ?>">

  <!-- End layout styles -->

  <!-- endinject -->
  <!-- Layout styles -->  
  

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
  padding: 5px;
  font-size: 20px;
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



  function loadResortModal(id,name){
  $("#modal-elemet").show();
  $("#modal-elemet").html("\r\n<div class=\'modal-content \'><div class=\'modal-header\'><span class=\'close\'>&times;<\/span><h2>"+name+" Resort Image Uploads<\/h2><\/div><div class=\'modal-body\'> <form id=\'resort-image-upload-form\' action=\'<?php echo e(action('App\Http\Controllers\AjaxRequestController@resort_image_upload')); ?>\' method=\'post\' enctype=\'multipart form-data\'>  <input type=\'hidden\' id=\'resort\' name=\'resort\' value=\'"+id+"\' /> <div class=\'col-xs-12 image-container image-container-bi\' id=\'add-property-image-container\'><div><p>Images <span class=\'dim-size\'>Supported Formats JPG, JPEG, PNG 600 X 400 PX (Max 10 MB)<\/span><\/p><div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' name=\'images\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title2\' value=\'title2\'><input type=\'hidden\' name=\'main_image\' id=\'main-image2\' value=\'false\'><span class=\'help-block form-error\'>This is a required field<\/span><\/div>\r\n  <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title3\' value=\'title3\'><input type=\'hidden\' name=\'main_image\' id=\'main-image3\' value=\'false\'><\/div>\r\n <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title4\' value=\'title4\'><input type=\'hidden\' name=\'main_image\' id=\'main-image4\' value=\'false\'><\/div>\r\n <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title5\' value=\'title5\'><input type=\'hidden\' name=\'main_image\' id=\'main-image5\' value=\'false\'><\/div>\r\n <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title6\' value=\'title6\'><input type=\'hidden\' name=\'main_image\' id=\'main-image6\' value=\'false\'><\/div>\r\n <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title7\' value=\'title7\'><input type=\'hidden\' name=\'main_image\' id=\'main-image7\' value=\'false\'><\/div>\r\n <\/div><\/div>\r\n <div class=\'box-footer clearfix\'><button type=\'submit\' class=\'pull-right btn btn-default\' id=\'sendEmail\'>Submit<i class=\'fa fa-arrow-circle-right\'><\/i><\/button><\/div><span class=\'alert alert-danger blog-alert-danger\' style=\'display: none\'><\/span><span class=\'alert alert-success blog-alert-success\' style=\'display: none\'><\/span> <\/form> <\/div> <div class=\'modal-footer\'><\/div><\/div>");
}




  $('form#resort-form').on('submit', function(e){
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
}else if($.trim($('#price').val()) == ""){
     $('#price').css('border', 'solid 1px red');
     $('.resort-price-error').show();
     $('.resort-price-error').html('(*Rwquired)');  
}else if(!Number($('#price').val())){
    $('#price').css('border', 'solid 1px red');
     $('.resort-price-error').show();
     $('.resort-price-error').html('(*numeric value required)');  
}else if($.trim($('#location').val()) == ""){
  $('#location').css('border', 'solid 1px red');
  $('.resort-location-error').show();
  $('.resort-location-error').html('*Required');
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
             window.location = "<?php echo e(url('')); ?>/admin/edit_resort_img/"+data.data.id;           
             //location.reload();
             //loadResortModal(data.data.id,data.data.name);
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

$("#resort_feature_form").on('submit', function(e){
e.preventDefault();

var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#resort-feature').val()) == ""){
     $('#resort-feature').css('border', 'solid 1px red');
     $('.resort-feature-error').show();
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
             $(".blog-alert-success1").show();
             $('.blog-alert-danger1').hide();
             $(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
         $(".blog-alert-success1").hide();
         $(".blog-alert-danger1").show();
         $(".blog-alert-danger1").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
             $("#sendEmail").prop('disabled', true);
             $(".blog-alert-success1").show();
             $(".blog-alert-success1").html(data.message);
             location.reload();
             //loadResortModal(data.data.id,data.data.name);
            }else if(data.success == false){
              $(".blog-alert-success1").hide();
              $(".blog-alert-danger1").show();
              $(".blog-alert-danger1").html(data.message);
            }else{
              $(".blog-alert-success1").hide();
              $(".blog-alert-danger1").show();
              $(".blog-alert-danger1").html(data);
            }
              
         }
         });

}

});

});

function deleteFeatures(fid,feature){
  $query = confirm("Do you want to remove "+feature+" from the list?");
  if($query == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ResortController@remove_resort_feature')); ?>",
         data: {'feature_id': fid, 'feature_name': feature}, 
         beforeSend:function(){
             $(".blog-alert-success1").show();
             $('.blog-alert-danger1').hide();
             $(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
         $(".blog-alert-success1").hide();
         $(".blog-alert-danger1").show();
         $(".blog-alert-danger1").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
             $("#sendEmail").prop('disabled', true);
             $(".blog-alert-success1").show();
             $(".blog-alert-success1").html(data.message);
             location.reload();
             //loadResortModal(data.data.id,data.data.name);
            }else if(data.success == false){
              $(".blog-alert-success1").hide();
              $(".blog-alert-danger1").show();
              $(".blog-alert-danger1").html(data.message);
            }else{
              $(".blog-alert-success1").hide();
              $(".blog-alert-danger1").show();
              $(".blog-alert-danger1").html(data);
            }
              
         }
         });

  }else{
    
  }
}

function removeImg(service, key){

var str = confirm("Press Ok to delete this image or Cancle to decline");

if(str == true){
  $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\ServiceController@remove_service_img')); ?>",
         data: {'service': service, 'key_num': key}, 
         beforeSend:function(){
             //$(".blog-alert-success1").show();
             //$('.blog-alert-danger1').hide();
             //$(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             //$(".load").hide();
         },
         error:function(){
          $(".alert-warning").css('display', 'block');
          $(".alert-danger").css('display', 'none');
          $(".upload-error").html("<img src='<?php echo e(asset('icons/ic_connections.png')); ?>' /> Please check your internet connection or refresh your browser");
         },
         success:function(data){
            if(data.success == true){
             //$("#sendEmail").prop('disabled', true);
             $(".alert-success").css('display', 'block');
             $(".alert-danger").css('display', 'none');
             $(".alert-warning").css('display', 'none');
             $(".upload-success").html(data.message);
             $("#img_element_"+key).hide();
             //location.reload();
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

}
</script>


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">   
		<!-- Page loader -->

    
		<?php echo $__env->make('inc.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('inc.dashboard-side-bar2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Services
        <small>Edit <?php echo e($services[0]->title); ?></small>
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
                    <a class="nav-link" href="<?php echo e(url('admin/service_manager/edit_service/'.$services[0]->id)); ?>">Edit form</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="<?php echo e(url('admin/service_manager/edit_service_img/'.$services[0]->id)); ?>">Images</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="<?php echo e(url('admin/service_manager/bookings/'.$services[0]->id)); ?>">Bookings</a>
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

          <form id="img-form" method="post" action="<?php echo e(action('App\Http\Controllers\ServiceController@update_service_img')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="service" id="service" value="<?php echo e($services[0]->id); ?>">

            <div class="row firstBankDel mt-4" id="first_bank">
                <div class="col-xl-4">
                    <div class="card mb-0">
                        <div class="card-header">
                          Min(620x540) - Max(1920x1640) pixels  <span class="loader"></span>
                        </div>
                        <div class="card-body">
                            <input type="file" id="myDropify" class="border" name="img_1"/>
                        </div>
                    </div>
                </div>
                

                                                

                 <?php if($services[0]->images): ?>
                  <?php $__currentLoopData = $serviceImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pimg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-xl-4 mb-4" id="img_element_<?php echo e($key); ?>">
                      <div class="card mb-0">
                          <div class="card-header">
                              <div class="d-flex justify-content-between">
                                  <div>
                                      Image <?php echo e($key + 1); ?>

                                  </div>
                                  <div>
                                      <button onclick="removeImg('<?php echo e($services[0]->id); ?>', '<?php echo e($key); ?>')" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash"></i></button>
                                  </div>
                              </div>
                              
                          </div>
                          <div class="card-body">
                              <img src="<?php echo e($pimg); ?>"  style="width: 100%; height: 195px; object-fit: contain;">  
                          </div>
                      </div>
                  </div> 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
              </div>
            </form>



          
            <div class="mt-5 text-center">
            <a href="<?php echo e(url('admin/service_manager/bookings/'.$services[0]->id)); ?>" class="btn btn-primary rounded-0 pt-3 pb-3" type="submit">SAVE AND CONTINUE</a>
            </div>
          

        

    </div>
        
        
        

       
      </div>
      <!-- /.row (main row) -->

      </div>
    </section>

    <div class="modal" id="modal-elemet">
        
    </div>

    <!-- /.content -->
  </div>





        <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <script>
          var elem = document.documentElement;
          function openFullscreen() {
            if (elem.requestFullscreen) {
              elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) { /* Safari */
              elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE11 */
              elem.msRequestFullscreen();
            }
            document.getElementById('fullScreen').style.display = "none";
            document.getElementById('closeFullScreen').style.display = "inline";
          }
          
          function closeFullscreen() {
            if (document.exitFullscreen) {
              document.exitFullscreen();
            } else if (document.webkitExitFullscreen) { /* Safari */
              document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE11 */
              document.msExitFullscreen();
            }
            document.getElementById('fullScreen').style.display = "inline";
            document.getElementById('closeFullScreen').style.display = "none";
          }
          </script>  



  
  

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

<script src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/dropify.min.js')); ?>"></script>
  
  
  <script src="<?php echo e(asset('assets/js/feather.min.js')); ?>"></script>
  
  
  <script src="<?php echo e(asset('assets/js/dropzone.js')); ?>"></script>
  

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
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
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

  $(function() {
  'use strict';

  $('#myDropify').dropify();

  var _URL = window.URL || window.webkitURL;

  $("#img-form").on('change', '#myDropify', function(e){
    var file = $(this)[0].files[0];
    var formElem = $("#img-form");

          var img = new Image();
           var imgwidth = 0;
           var imgheight = 0;
           
           var minheight = 540;
           var minwidth = 620;

           var maxwidth = 1920;
           var maxheight = 1640;

           img.src = _URL.createObjectURL(file);
           img.onload = function() {
                  imgwidth = this.width;
                  imgheight = this.height;
 
                  //var formData = new FormData();
                  var formData = new FormData();
                  formData.append('service', $('#service').val());
                  formData.append('img_1', file);
                  //$("#width").text(imgwidth);
                  //$("#height").text(imgheight);
                  if(imgheight <= minheight || imgwidth <= minwidth){
                  $(".alert-danger").css('display', 'block');
                  $(".upload-error").html("Image should not be less than (Width:"+ minwidth +" pixels & Height:"+ minheight + " pixels) in dimenssion but ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels) selected");
                  }else if(imgheight > imgwidth || imgheight == imgwidth){
                    $(".alert-danger").css('display', 'block');
                  $(".upload-error").html("Image height should not be higher nor equal to width. ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels) selected");
                  }else if(imgwidth > maxwidth || imgheight > maxheight){
                  $(".alert-danger").css('display', 'block');
                  $(".upload-error").html("Image should not exceed this dimenssion (Width:"+ maxwidth + " pixels &  Height:"+ maxheight +" pixels) max");
                  //$(".upload-error").html("Height:"+ imgheight + " Width:"+ imgwidth);     
                  }else{
                    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: formElem.attr('action'),
         data: formData,
         cache: false,
         contentType: false,
         processData: false,
         beforeSend:function(){
             
             $(".loader").html("<img src='<?php echo e(asset('loaders/AjaxLoader.gif')); ?>' />");
         },
         complete:function(){
             $(".loader").hide();
         },
         error:function(){
          $(".alert-warning").css('display', 'block');
          $(".alert-danger").css('display', 'none');
          $(".upload-error").html("<img src='<?php echo e(asset('icons/ic_connections.png')); ?>' /> Please check your internet connection or refresh your browser");
         },
         success:function(data){
            if(data.success == true){
             //$("#sendEmail").prop('disabled', true);
             $(".alert-success").css('display', 'block');
             $(".alert-danger").css('display', 'none');
             $(".alert-warning").css('display', 'none');
             $(".upload-success").html(data.message);
             location.reload();
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
           };
           img.onerror = function() {
             $(".alert-danger").css('display', 'block');
             $(".alert-success").css('display', 'none');
             $(".alert-warning").css('display', 'none');
             $(".upload-error").html("invalid file type: " + file.type);
                 //$("#response").text();
            }



  });

});
</script>

</body>
</html>
		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/edit_service_img.blade.php ENDPATH**/ ?>