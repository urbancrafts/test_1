@extends('layouts.app')

      @section('content')
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
        /** @type {!HTMLInputElement} */(document.getElementById('location')),
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
    $("#modal-elemet").html("\r\n<div class=\'modal-content \'><div class=\'modal-header\'><span class=\'close\'>&times;<\/span><h2>"+name+" Resort Image Uploads<\/h2><\/div><div class=\'modal-body\'> <form id=\'resort-image-upload-form\' action=\'{{ action('App\Http\Controllers\AjaxRequestController@resort_image_upload') }}\' method=\'post\' enctype=\'multipart form-data\'>  <input type=\'hidden\' id=\'resort\' name=\'resort\' value=\'"+id+"\' /> <div class=\'col-xs-12 image-container image-container-bi\' id=\'add-property-image-container\'><div><p>Images <span class=\'dim-size\'>Supported Formats JPG, JPEG, PNG 600 X 400 PX (Max 10 MB)<\/span><\/p><div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' name=\'images\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title2\' value=\'title2\'><input type=\'hidden\' name=\'main_image\' id=\'main-image2\' value=\'false\'><span class=\'help-block form-error\'>This is a required field<\/span><\/div>\r\n  <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title3\' value=\'title3\'><input type=\'hidden\' name=\'main_image\' id=\'main-image3\' value=\'false\'><\/div>\r\n <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title4\' value=\'title4\'><input type=\'hidden\' name=\'main_image\' id=\'main-image4\' value=\'false\'><\/div>\r\n <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title5\' value=\'title5\'><input type=\'hidden\' name=\'main_image\' id=\'main-image5\' value=\'false\'><\/div>\r\n <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title6\' value=\'title6\'><input type=\'hidden\' name=\'main_image\' id=\'main-image6\' value=\'false\'><\/div>\r\n <div class=\'col-xs-12 col-sm-4 col-md-2\'><input type=\'file\' class=\'uploadFile\' name=\'images\' accept=\'image\/x-png, image\/jpeg, image\/jpg\' data-validation-allowing=\'jpg, png, jpeg\'><div class=\'file-input-button text-center\' style=\'background-image: url(&quot;&quot;);\'><i class=\'fa fa-2x fa-plus-circle\' aria-hidden=\'true\'><\/i><\/div><h5 class=\'error-file-size\' style=\'display: none\'><\/h5><input type=\'hidden\' name=\'titles\' id=\'title7\' value=\'title7\'><input type=\'hidden\' name=\'main_image\' id=\'main-image7\' value=\'false\'><\/div>\r\n <\/div><\/div>\r\n <div class=\'box-footer clearfix\'><button type=\'submit\' class=\'pull-right btn btn-default\' id=\'sendEmail\'>Submit<i class=\'fa fa-arrow-circle-right\'><\/i><\/button><\/div><span class=\'alert alert-danger blog-alert-danger\' style=\'display: none\'><\/span><span class=\'alert alert-success blog-alert-success\' style=\'display: none\'><\/span> <\/form> <\/div> <div class=\'modal-footer\'><\/div><\/div>");
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
  }else if($.trim($('#price').val()) != "" && !Number($('#price').val())){
       $('#price').css('border', 'solid 1px red');
       $('.resort-price-error').show();
       $('.resort-price-error').html('(*Price field accepts numeric value only)');  
  }else if($.trim($('#location').val()) == ""){
    $('#location').css('border', 'solid 1px red');
    $('.resort-location-error').show();
  }else if($.trim($('#address').val()) == ""){
    $('#address').css('border', 'solid 1px red');
    $('.resort-address-error').show();
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


$('form#update-resort-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var resort = $('#resort').val();
var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#name').val()) == ""){
     $('#name').css('border', 'solid 1px red');
     $('.resort-name-error').show();
     $('.resort-name-error').html('*Required');
}else if($.trim($('#price').val()) == "" ){
     $('#price').css('border', 'solid 1px red');
     $('.resort-price-error').show();
     $('.resort-price-error').html('*Required');  
}else if(!Number($('#price').val())){
  $('#price').css('border', 'solid 1px red');
  $('.resort-price-error').show();
  $('.resort-price-error').html('*Price field can only accept numbers');  
}else if($.trim($('#location').val()) == ""){
    $('#location').css('border', 'solid 1px red');
    $('.resort-location-error').show();
    $('.resort-location-error').html("*Required");
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
             $('#sendEmail').html("<img src='{{ asset('loaders/AjaxLoader.gif') }}' />");
             //$(".blog-alert-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
          $(".alert-warning").css('display', 'block');
          $(".alert-danger").css('display', 'none');
          $(".upload-error").html("<img src='{{ asset('icons/ic_connections.png') }}' /> Please check your internet connection or refresh your browser");
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
             window.location = "{{ url('') }}/admin/resort_manager/edit_resort_img/"+resort;
            
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
  
  

  

  </script>

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
        Resort
        <small>Edit {{$resorts2[0]->name}}</small>
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
    <a class="nav-link active" href="{{url('admin/resort_manager/resort/'.$resorts2[0]->id)}}">Edit form</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{url('admin/resort_manager/edit_resort_img/'.$resorts2[0]->id)}}">Images</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{url('admin/resort_manager/edit_resort_features/'.$resorts2[0]->id)}}">Features</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{url('admin/resort_manager/create_room/'.$resorts2[0]->id)}}">Rooms</a>
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
                  
    
                  <h3 class="card-title"><i class="fa fa-home"></i> {{$resorts2[0]->name}}</h3>
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
                  <form id="update-resort-form" action="{{ action('App\Http\Controllers\ResortController@update_resort_input') }}" method="post" enctype="multipart/form-data">
                   
                   <input type='hidden' id='resort' name='resort' value='{{$resorts2[0]->id}}' />
                    
                   

                   
                   <div class="form-group">
                    <label>Resort Name:</label>
                        <span style="color: red;" class="resort-name-error">*</span>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Resort name" value="{{$resorts2[0]->name}}">
                    </div>


                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Currency:</label>
                          <select id='curr' name='curr' class="form-control">
                            <option value="NGN">NGN - ₦</option>
                            <option value="USD">USD - $</option>
                            <option value="EUR">EUR - €</option>
                            <option value="GBP">GBP - £</option>
                            
                          </select>
                          
                        </div>
                      </div>
                      <div class="col-sm-6">
                    <div class="form-group">
                      <label>Resort Price:</label>
                        <span style="color: red;" class="resort-price-error">*</span>
                        <input type="number" class="form-control" id="price" name="price" placeholder="price" value="{{$resorts2[0]->price}}">
                      </div>
                      </div>
                    </div>

                    


                    <div class="row">
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Google Location:</label>
                        <span style="color: red;" class="resort-location-error">*</span>
                        <input type="text" class="form-control pac-target-input valid" id="location" name="location" value="{{$resorts2[0]->location}}" data-validation="required" placeholder="Enter a location" autocomplete="off">
                       
                    </div>
                      </div>

                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Youtube Link:</label>
                        <span style="color: red; display: none" class="resort-youtube-error">(*Required)</span>
                        <input type="url" class="form-control pac-target-input valid" id="youtube" name="youtube" value="{{$resorts2[0]->youtube}}" placeholder="Enter youtube video link" autocomplete="off">
                       
                    </div>
                    </div>

                    </div>



                    <div class="row">
                      <div class="col-sm-6">
                    <div class="form-group">
                      <label>Resort Address:</label>
                        <span style="color: red; display: none" class="resort-address-error">(*Required)</span>
                      <textarea id="address" name="address" placeholder="Resort address"
                                style="width: 100%; height: 70px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$resorts2[0]->address}}</textarea>
                    </div>
                      </div>

                      <div class="col-sm-6">
                    <div class="form-group">
                      <label>Resort Description:</label>
                        <span style="color: red; display: none" class="resort-desc-error">(*Required)</span>
                    <textarea id="desc" name="desc" placeholder="Enter description"
                                style="width: 100%; height: 70px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$resorts2[0]->descr}}</textarea>
                    </div>
                      </div>

                      </div>


                    
                     

                    
                    

                    <div class="box-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default" id="sendEmail">Update
                        <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                   
                  </form>
                </div>
                
              </div>


          <!-- quick email widget -->
          

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        
        

        
    </div>
      <!-- /.row (main row) -->


      </div>

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
<!-- AdminLTE App -->


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