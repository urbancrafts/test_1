@extends('layouts.app')

@section('content')
		<!-- Page loader -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('assets/css/core.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flag-icon.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/dropify.min.css')}}">


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

  <link rel="stylesheet" href="{{ asset('plugins_2/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins_2/toastr/toastr.min.css')}}">  
  
  <script>
$(document).ready(function(){

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 9000
  });

$('form#settings-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var formdata = new FormData(this);//create an instance for the form input fields
if($.trim($('#curr').val()) == ""){
  $('#curr').css('border', 'solid 1px red');
  $('.resort-curr-error').show();

}else if($.trim($('#tel').val()) == ""){
  $('#tel').css('border', 'solid 1px red');
  $('.resort-tel-error').show();

}else if(!Number($('#tel').val())){
  $('#tel').css('border', 'solid 1px red');
  $('.resort-tel-error').show();
  $('.resort-tel-error').html('(mobile field requires numeric data only)');
}else if($.trim($('#mobile').val()) == ""){
  $('#mobile').css('border', 'solid 1px red');
  $('.resort-mobile-error').show();
  $('.resort-mobile-error').html('(*Required)');

}else if(!Number($('#mobile').val())){
  $('#mobile').css('border', 'solid 1px red');
  $('.resort-mobile-error').show();
  $('.resort-mobile-error').html('(mobile field requires numeric data only)');
}else if($.trim($('#email').val()) == "" ){
  $('#email').css('border', 'solid 1px red');
  $('.resort-email-error').show();
  $('.resort-email-error').html('(*Required)');

}else if($.trim($('#address').val()) == ""){
  $('#address').css('border', 'solid 1px red');
  $('.resort-address-error').show();
  $('.resort-address-error').html('(*Required)');

}else if($.trim($("#discount").val()) !="" && !Number($("#discount").val())){
  $('#discount').css('border', 'solid 1px red');
  $('.resort-discount-error').show();
  $('.resort-discount-error').html('(discount field requires numeric data only)');
}else if($.trim($('#site_name').val()) == ""){
  $('#site-name').css('border', 'solid 1px red');
  $('.resort-sname-error').show();
  $('.resort-sname-error').html('(*Required)');

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
          Toast.fire({
          icon: 'info',
          title: 'Request processing...'
          });
         },
         complete:function(){
             //$(".load").hide();
         },
         
         success:function(data){
            if(data.status == true){
              $("#sendEmail").prop('disabled', true);
              Toast.fire({
              icon: 'success',
              title: data.message
              });
              
            }else if(data.status == false){
              Toast.fire({
              icon: 'error',
              title: data.message
              });
            }else{
              Toast.fire({
              icon: 'error',
              title: data
              });
            }
              
         },

         error:function(jqXHR, exception){
if(jqXHR.status === 0){
Toast.fire({
icon: 'warning',
title: 'Please check your internet connection.'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Please check your internet connection.');	

}else if(jqXHR.status == 404){
Toast.fire({
icon: 'info',
title: 'Request route not found.'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Request route not found.');
}else if(jqXHR.status == 500){
Toast.fire({
icon: 'error',
title: 'Internal Server Error [500]'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Internal Server Error [500]');

}else if(jqXHR.status == 422){
var errors = jqXHR.responseJSON;
// $.each(json.responseJSON, function (key, value) {
//     $('.'+key+'-error').html(value);
// });
Toast.fire({
icon: 'error',
title: errors.data.errors
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html(errors.data.errors);

}else if(exception === 'parsererror'){
Toast.fire({
icon: 'info',
title: 'Requested JSON parse failed'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Requested JSON parse failed');

}else if(exception === 'timeout'){
Toast.fire({
icon: 'info',
title: 'Request time out'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Time out error');

}else if(exception === 'abort'){
Toast.fire({
icon: 'info',
title: 'Ajax request aborted'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Ajax request aborted');

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

  @include('inc.admin-sidebar')
    
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
        <div class="col-md-12 grid-margin">

          <form id="img-form" method="post" action="{{ action('App\Http\Controllers\AdminController@upload_site_logo') }}" enctype="multipart/form-data">
            @csrf
            

            <div class="row firstBankDel mt-4" id="first_bank">
                <div class="col-xl-4">
                    <div class="card mb-0">
                        <div class="card-header">
                         
                            Browse For Site Logo <span class="loader"></span>
                        </div>
                        <div class="card-body">
                            <input type="file" id="siteLogo" class="border" name="logo" value=""/>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                  <div class="card mb-0">
                      <div class="card-header">
                       
                          Browse For Site Icon <span class="loader"></span>
                      </div>
                      <div class="card-body">
                          <input type="file" id="siteIcon" class="border" name="icon"/>
                      </div>
                  </div>
              </div>
                

                                          
              </div>
            </form>

        </div>
      </div>

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
                    @if ($settings->logo != "")
                        <img src="{{$settings->logo}}" width="150" height="90" />
                    @endif
                    @if ($settings->icon != "")
                        <img src="{{$settings->icon}}" width="150" height="90" />
                    @endif


                    


                  <form id="settings-form" action="{{ action('App\Http\Controllers\AdminController@update_settings') }}" method="post" enctype="multipart/form-data">
                   
                   
                
                   <div class="form-group">
                        <span style="color: red; display: none" class="resort-curr-error">(*Required)</span>
                      <input type="text" class="form-control" id="curr" name="curr" value="{{$settings->curr}}" placeholder="Currency" >
                    </div>
                    
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-leng-error">(*Required)</span>
                      <input type="text" class="form-control" id="lang" name="lang" value="{{$settings->language}}" placeholder="Language" >
                    </div>
                    <div class="form-group">
                        <span style="color: red; display: none" class="resort-tel-error">(*Required)</span>
                        <input type="number" class="form-control" id="tel" name="tel" value="{{$settings->tel}}" placeholder="Tel" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-mobile-error"></span>
                        <input type="number" class="form-control" id="mobile" name="mobile" value="{{$settings->mobile}}" placeholder="Mobile number" >
                      </div>
                      
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-email-error"></span>
                        <input type="email" class="form-control" id="email" name="email" value="{{$settings->email}}" placeholder="Email address" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-address-error"></span>
                        <textarea class="form-control" id="address" name="address" placeholder="Office address">{{$settings->address}}</textarea>
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-payment-error"></span>
                        <select id="payment_type" name="payment_type" class="form-control">
                            @if ($settings->payment_type != "")
                            <option value="{{$settings->payment_type}}">{{$settings->payment_type}}</option>
                                
                            @else
                            <option disabled selected>payment type</option>
                            @endif
                            @if ($settings->payment_type == "mobile")
                            <option value="web">web</option>  
                            @endif
                            @if ($settings->payment_type == "web")
                            <option value="mobile">mobile</option> 
                            @endif
                            
                            
                        </select>
                      </div>
                        
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-discount-error"></span>
                        <input type="number" class="form-control" id="discount" name="discount" value="{{$settings->memb_discount}}" placeholder="Members discount by percent(%)" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-discount-error"></span>
                        <input type="number" class="form-control" id="credit" name="credit" value="{{$settings->memb_debt_capacity}}" placeholder="Members credit limit" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-mem-fee-error"></span>
                        <input type="number" class="form-control" id="mem_fee" name="mem_fee" value="{{$settings->membership_fee}}" placeholder="Membership fee" >
                      </div>

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-fb-error"></span>
                        <input type="text" class="form-control" id="fb" name="fb" value="{{$settings->facebook}}" placeholder="Facebook pages" >
                      </div>
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-insta-error"></span>
                        <input type="text" class="form-control" id="insta" name="insta" value="{{$settings->instagram}}" placeholder="Instagram page" >
                      </div>
                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-twitter-error"></span>
                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{$settings->twitter}}" placeholder="Twitter handle" >
                      </div>
                       
                      

                      <div class="form-group">
                        <span style="color: red; display: none" class="resort-sname-error"></span>
                        <input type="text" class="form-control" id="site_name" name="site_name" value="{{$settings->site_name}}" placeholder="Site name" >
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

<script src="{{asset('assets/js/dropzone.min.js')}}"></script>
  <script src="{{asset('assets/js/dropify.min.js')}}"></script>
  
  
  <script src="{{asset('assets/js/feather.min.js')}}"></script>
  
  
  <script src="{{asset('assets/js/dropzone.js')}}"></script>
  
<!-- SweetAlert2 -->
<script src="{{ asset('plugins_2/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins_2/toastr/toastr.min.js')}}"></script>
<!-- AdminLTE App -->

<!-- AdminLTE App -->
<script src="{{asset('dist_2/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist_2/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist_2/js/demo.js')}}"></script>

<script>
  

  $(function() {
  'use strict';

  $('#siteLogo').dropify();
  $('#siteIcon').dropify();

  var _URL = window.URL || window.webkitURL;

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 9000
  });

  $("#img-form").on('change', '#siteLogo', function(e){
    var file = $(this)[0].files[0];
    var formElem = $("#img-form");

          var img = new Image();
           var imgwidth = 0;
           var imgheight = 0;

           var minheight = 620;
           var minwidth = 620;

           var maxwidth = 1920;
           var maxheight = 1920;

           img.src = _URL.createObjectURL(file);
           img.onload = function() {
                  imgwidth = this.width;
                  imgheight = this.height;
 
                  //var formData = new FormData();
                  var formData = new FormData();
                  
                  formData.append('logo', file);
                  //$("#width").text(imgwidth);
                  //$("#height").text(imgheight);
                  if(imgheight <= minheight || imgwidth <= minwidth){
                  $("#siteLogo").css('border', 'solid 1px red');
                  Toast.fire({
                  icon: 'error',
                  title: "Image dimention too low ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels), minimum requirement (Width:"+ minwidth +" pixels & Height:"+ minheight + " pixels)."
                  });
                  
                  }else if(imgheight > maxheight || imgwidth > maxwidth){
                  $("#siteLogo").css('border', 'solid 1px red');
                  Toast.fire({
                  icon: 'error',
                  title: "Image dimention too high ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels), maximum requirement (Width:"+ maxwidth +" pixels & Height:"+ maxheight + " pixels)."
                  });
                  }else if(imgheight > imgwidth){
                  $("#siteLogo").css('border', 'solid 1px red');
                  Toast.fire({
                  icon: 'error',
                  title: "Image dimention must be equal ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels), uploaded."
                  });
                    
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
             
          Toast.fire({
          icon: 'info',
          title: 'Request processing...'
          });
         },
         complete:function(){
             //$(".loader").hide();
         },
        
         success:function(data){
            if(data.status == true){
             
             Toast.fire({
             icon: 'success',
             title: data.message
             });
             location.reload();
             
            }else if(data.status == false){
              Toast.fire({
             icon: 'error',
             title: data.message
             });
            }else{
              Toast.fire({
             icon: 'error',
             title: data
             });
            }
              
         },


error:function(jqXHR, exception){
if(jqXHR.status === 0){
Toast.fire({
icon: 'warning',
title: 'Please check your internet connection.'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Please check your internet connection.');	

}else if(jqXHR.status == 404){
Toast.fire({
icon: 'info',
title: 'Request route not found.'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Request route not found.');
}else if(jqXHR.status == 500){
Toast.fire({
icon: 'error',
title: 'Internal Server Error [500]'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Internal Server Error [500]');

}else if(jqXHR.status == 422){
var errors = jqXHR.responseJSON;
// $.each(json.responseJSON, function (key, value) {
//     $('.'+key+'-error').html(value);
// });
Toast.fire({
icon: 'error',
title: errors.data.errors
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html(errors.data.errors);

}else if(exception === 'parsererror'){
Toast.fire({
icon: 'info',
title: 'Requested JSON parse failed'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Requested JSON parse failed');

}else if(exception === 'timeout'){
Toast.fire({
icon: 'info',
title: 'Request time out'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Time out error');

}else if(exception === 'abort'){
Toast.fire({
icon: 'info',
title: 'Ajax request aborted'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Ajax request aborted');

}

}

         }); 
                  }
           };
           img.onerror = function() {
            $("#myDropify").css('border', 'solid 1px red');
            Toast.fire({
             icon: 'error',
             title: "invalid file type: " + file.type
             });
             
            }



  });


  $("#img-form").on('change', '#siteIcon', function(e){
    var file = $(this)[0].files[0];
    var formElem = $("#img-form");

          var img = new Image();
           var imgwidth = 0;
           var imgheight = 0;

           var minheight = 620;
           var minwidth = 620;

           var maxwidth = 1920;
           var maxheight = 1920;

           img.src = _URL.createObjectURL(file);
           img.onload = function() {
                  imgwidth = this.width;
                  imgheight = this.height;
 
                  //var formData = new FormData();
                  var formData = new FormData();
                  
                  formData.append('icon', file);
                  //$("#width").text(imgwidth);
                  //$("#height").text(imgheight);
                  if(imgheight <= minheight || imgwidth <= minwidth){
                  $("#siteIcon").css('border', 'solid 1px red');
                  Toast.fire({
                  icon: 'error',
                  title: "Image dimention too low ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels), minimum requirement (Width:"+ minwidth +" pixels & Height:"+ minheight + " pixels)."
                  });
                  
                  }else if(imgheight > maxheight || imgwidth > maxwidth){
                  $("#siteIcon").css('border', 'solid 1px red');
                  Toast.fire({
                  icon: 'error',
                  title: "Image dimention too high ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels), maximum requirement (Width:"+ maxwidth +" pixels & Height:"+ maxheight + " pixels)."
                  });
                  }else if(imgheight > imgwidth){
                  $("#siteIcon").css('border', 'solid 1px red');
                  Toast.fire({
                  icon: 'error',
                  title: "Image dimention must be equal ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels), uploaded."
                  });
                    
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
             
          Toast.fire({
          icon: 'info',
          title: 'Request processing...'
          });
         },
         complete:function(){
             //$(".loader").hide();
         },
        
         success:function(data){
            if(data.status == true){
             
             Toast.fire({
             icon: 'success',
             title: data.message
             });
             location.reload();
             
            }else if(data.status == false){
              Toast.fire({
             icon: 'error',
             title: data.message
             });
            }else{
              Toast.fire({
             icon: 'error',
             title: data
             });
            }
              
         },


error:function(jqXHR, exception){
if(jqXHR.status === 0){
Toast.fire({
icon: 'warning',
title: 'Please check your internet connection.'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Please check your internet connection.');	

}else if(jqXHR.status == 404){
Toast.fire({
icon: 'info',
title: 'Request route not found.'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Request route not found.');
}else if(jqXHR.status == 500){
Toast.fire({
icon: 'error',
title: 'Internal Server Error [500]'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Internal Server Error [500]');

}else if(jqXHR.status == 422){
var errors = jqXHR.responseJSON;
// $.each(json.responseJSON, function (key, value) {
//     $('.'+key+'-error').html(value);
// });
Toast.fire({
icon: 'error',
title: errors.data.errors
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html(errors.data.errors);

}else if(exception === 'parsererror'){
Toast.fire({
icon: 'info',
title: 'Requested JSON parse failed'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Requested JSON parse failed');

}else if(exception === 'timeout'){
Toast.fire({
icon: 'info',
title: 'Request time out'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Time out error');

}else if(exception === 'abort'){
Toast.fire({
icon: 'info',
title: 'Ajax request aborted'
});
// jQuery(".login-status").hide();
// jQuery(".login-alert-error").fadeIn('slow');
// jQuery('.login-alert-error').html('Ajax request aborted');

}

}

         }); 
                  }
           };
           img.onerror = function() {
            $("#myDropify").css('border', 'solid 1px red');
            Toast.fire({
             icon: 'error',
             title: "invalid file type: " + file.type
             });
             
            }



  });


});
</script>

</body>
</html>
		@endsection
