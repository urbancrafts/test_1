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
  
  
  

      $('form#new-service-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var formdata = new FormData(this);//create an instance for the form input fields
if($.trim($('#category').val()) == ""){
  $('#category').css('border', 'solid 1px red');
  $('.category-error').show();
  $('.category-error').html('*Select Category');
}else if($.trim($('#name').val()) == ""){
     $('#name').css('border', 'solid 1px red');
     $('.service-name-error').show();
     $('.service-name-error').html("*Required"); 
}else if($.trim($('#price').val()) =="" ){
  $('#price').css('border', 'solid 1px red'); 
  $('.service-price-error').show();
  $('.service-price-error').html('*Required');  
}else if(!Number($('#price').val())){
     $('#price').css('border', 'solid 1px red');
     $('.service-price-error').show()
     $('.service-price-error').html('*Price field accepts numbers only');  
}else if($.trim($('#location').val()) == ""){
    $('#location').css('border', 'solid 1px red');
    $('.service-location-error').show();
    $('.service-location-error').html("*Required");
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
             window.location = "{{ url('') }}/admin/service_manager/edit_service_img/"+data.data.id;
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

});
  
  
  
  
$("#service_category_form").on("submit", function(e){
  e.preventDefault();

var action = $(this).attr('action');
//var category = jQuery("#boat_category").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var formdata = new FormData(this);//create an instance for the form input fields

  if($.trim($('#service_category').val()) == ""){
    $('#service_category').css('border', 'solid 1px red');
     $('.service-category-error').show(); 
     $('.service-category-error').html("*Required"); 
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
             //window.location = "{{ url('') }}/admin/resort_manager/edit_resort_img/"+resort;
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

  });
  
  });
  

  function deleteService(id,name){
  var str = confirm('Do you really want to delete '+name+'?');
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "{{ action('App\Http\Controllers\ServiceController@delete_service') }}",
         data: {"id":id},
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

  @include('inc.header2')

  @include('inc.dashboard-side-bar2')

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
  
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" id="blog-body">
         
       @if(Auth::user()->user_type == "admin")
          <div class="card card-info">
            <div class="card-header">
              
              <h3 class="card-title"><i class="fa fa-server"></i> Create Service Categories</h3>
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
              <form id="service_category_form" action="{{ action('App\Http\Controllers\ServiceController@create_categories') }}" method="post" enctype="multipart/form-data">
                
                
                <div class="form-group">
                    <span style="color: red; display: none" class="service-category-error">(*Required)</span>
                  <input type="text" class="form-control" id="service_category" name="service_category" onfocus="elementFocus(this.id, 'service-category-error')" placeholder="Enter Service Category">
                </div>
               
                
                <div class="card-footer clearfix">
                  <button type="submit" class="pull-right btn btn-default" >Create
                    <i class="fa fa-arrow-circle-right"></i></button>
                </div>
               
              </form>
            </div>
  
            <div class="form-group">
              <fieldset class="resort-features">
                <legend>Categories</legend>
                @if(count($serviceCategories) > 0)
                @foreach ($serviceCategories as $category)
        <label>{{$category->category}}<a href="#" class="fas fa-trash" onclick="deleteCategory('{{$category->id}}','{{$category->category}}')" title="Delete {{$category->category}}"></a></label>       
                @endforeach
                @endif
                
                
              </fieldset>
             </div>
            
          </div>
  
          @endif
  
            <div class="card card-info">
                <div class="card-header">
                  
                  <h3 class="card-title"><i class="fa fa-server"></i> New Service</h3>
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
                  <form id="new-service-form" action="{{ action('App\Http\Controllers\ServiceController@create_new_service') }}" method="post" enctype="multipart/form-data">
                   <input type="hidden" id="uid" name="uid" value="{{Auth::user()->id}}" />
                   
  
                   <div class="form-group">
                    <label>Select Category:</label>
                        <span style="color: red;" class="category-error">*</span>
                      <select id="category" name="category" class="form-control" onfocus="elementFocus(this.id, 'category-error')">
                        <option value="" selected disabled>--Selet Service Category--</option>
                        @foreach ($serviceCategories as $category)
                        <option value="{{$category->category}}">{{$category->category}}</option>
                        @endforeach
                      </select>
                       
                    </div>
                   
                   
                   
  
                   <div class="form-group">
                    <label>Name:</label>
                        <span style="color: red;" class="service-name-error">*</span>
                      <input type="text" class="form-control" id="name" name="name" onfocus="elementFocus(this.id, 'service-name-error')" placeholder="Enter your service name/business name">
                    </div>
  
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Currency:</label>
                          <select type='hidden' id='curr' name='curr' class="form-control">
                            <option value="NGN">NGN - ₦</option>
                            <option value="USD">USD - $</option>
                            <option value="EUR">EUR - €</option>
                            <option value="GBP">GBP - £</option>
                            
                          </select>
                          
                        </div>
                      </div>
                      <div class="col-sm-6">
                    <div class="form-group">
                      <label>Price/hour:</label>
                        <span style="color: red;" class="service-price-error">*</span>
                        <input type="number" class="form-control" id="price" name="price" onfocus="elementFocus(this.id, 'service-price-error')" placeholder="price">
                      </div>
                      </div>
                    </div>
                      
                    <div class="row">
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Google Location:</label>
                        <span style="color: red;" class="service-location-error">*</span>
                        <input type="text" class="form-control pac-target-input valid" id="location" name="location" onfocus="elementFocus(this.id, 'service-location-error')" data-validation="required" placeholder="Enter a location" autocomplete="off">
                       
                    </div>
                      </div>
  
                      <div class="col-sm-6">
                      <div class="form-group">
                        <label>Youtube Link:</label>
                        <span style="color: red; display: none" class="service-youtube-error">(*Required)</span>
                        <input type="url" class="form-control pac-target-input valid" id="youtube" name="youtube" placeholder="Enter youtube video link" autocomplete="off">
                       
                    </div>
                    </div>
  
                    </div>
  
  
  
                    <div class="row">
                      <div class="col-sm-6">
                    <div class="form-group">
                      <label>Address:</label>
                        <span style="color: red; display: none" class="boat-address-error">(*Required)</span>
                      <textarea id="address" name="address" placeholder="Location address"
                                style="width: 100%; height: 70px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                      </div>
  
                      <div class="col-sm-6">
                    <div class="form-group">
                      <label>Description:</label>
                        <span style="color: red; display: none" class="boat-desc-error">(*Required)</span>
                    <textarea id="desc" name="desc" placeholder="Boat description"
                                style="width: 100%; height: 70px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                      </div>
  
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
                  <table id="example1" class="products-list product-list-in-box">
                    <thead>
                      <tr>
                        <td>Service</td>
                      </tr>
                    </thead>
                    <tbody>
                 @foreach ($services as $service)
                 @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin" || $service->created_by == Auth::user()->id)
                     
                 <tr class="item" >
                  <td width='500'>
                  <div class="product-img">
                    <img src="{{$service->img_1}}" >
                  </div>
                  <div class="product-info">
                    <a href="{{ url('service/service/'.$service->id) }}" class="product-title">{{$service->title}}
                      
                      
                      <span class="badge badge-warning float-right">
                          {{$service->curr}}{{$service->price}}
                        </span>
                       
                      </a>
                    <span class="product-description">
                          {{$service->location}}
                        </span>
                       
                        <a href="#" class="fa fa-trash del-btn" onclick="deleteService('{{$service->id}}','{{$service->title}}')" title="Delete {{$service->title}}">Delete</a> | 
                        <a href="{{ url('admin/service_manager/edit_service/'.$service->id) }}" class="fa fa-edit edit-btn" title="Edit {{$service->title}}">Edit</a> | 
                        <a href="{{url('admin/service_manager/bookings/'.$service->id)}}" class="fa fa-book book-btn" title="Book {{$service->title}}">Bookings</a>
                         
                  </div>
                </td>
              </tr>
                @endif
                 @endforeach
                    
  
                </tbody>
                <tfoot class="card-footer text-center">
                  <tr>
                    <td>Service</td>
                  </tr>
                </tfoot>
              </table>
                </div>
                <!-- /.box-body -->
               
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





        @include('inc.footer')
		
        <script src="{{asset('request_upload/main.js')}}"></script>
        
        <script src="{{asset('request_upload/image-upload.js')}}"></script>
        <script>
          
          new ImageUploadOperations();

      </script>
	



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

<script src="{{asset('plugins_2/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins_2/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins_2/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins_2/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins_2/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('dist_2/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist_2/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist_2/js/demo.js')}}"></script>

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

		@endsection