@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- core:css -->
  <link rel="stylesheet" href="{{asset('assets/css/core.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  
  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('assets/css/iconfont.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/flag-icon.min.css')}}">
  <!-- endinject -->
  <!-- Layout styles -->  
  

<link rel="stylesheet" href="{{asset('assets/css/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/dropify.min.css')}}">

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

<link rel="stylesheet" href="{{ asset('plugins_2/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('plugins_2/toastr/toastr.min.css')}}">



<script type="text/javascript">
$(document).ready(function(){


var site_url = "{{ url('') }}";//full site domain url

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 9000
  });



  



});



function removeImg(resort, key){

var str = confirm("Press Ok to delete this image or Cancle to decline");

if(str == true){
  $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "{{ action('App\Http\Controllers\ResortController@remove_resort_img') }}",
         data: {'resort': resort, 'key_num': key}, 
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
          $(".upload-error").html("<img src='{{ asset('icons/ic_connections.png') }}' /> Please check your internet connection or refresh your browser");
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

    
		@include('inc.header2')

    @include('inc.business-sidebar')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Business Account
        <small>Resort owner: {{$resorts2[0]->name}}</small>
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
    <a class="nav-link " href="{{url('auth/business/resorts/edit_resort/'.$resorts2[0]->id)}}">Edit form</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  active " href="{{url('auth/business/resorts/edit_resort_img/'.$resorts2[0]->id)}}">Images</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{url('auth/business/resorts/edit_resort_features/'.$resorts2[0]->id)}}">Features</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="{{url('auth/business/resorts/create_room/'.$resorts2[0]->id)}}">Rooms</a>
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

          <form id="img-form" method="post" action="{{ action('App\Http\Controllers\ResortController@update_resort_img') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="resort" id="resort" value="{{$resorts2[0]->id}}">

            <div class="row firstBankDel mt-4" id="first_bank">
                <div class="col-xl-4">
                    <div class="card mb-0">
                        <div class="card-header">
                         
                            Image (620x540) - (1920x1640) pixels <span class="loader"></span>
                        </div>
                        <div class="card-body">
                            <input type="file" id="myDropify" class="border" name="img_1"/>
                        </div>
                    </div>
                </div>
                

                                                

                 @if($resorts2[0]->images)
                  @foreach($resortImg as $key => $pimg)
                  <div class="col-xl-4 mb-4" id="img_element_{{$key}}">
                      <div class="card mb-0">
                          <div class="card-header">
                              <div class="d-flex justify-content-between">
                                  <div>
                                      Image {{$key + 1}}
                                  </div>
                                  <div>
                                      <button onclick="removeImg('{{$resorts2[0]->id}}', '{{$key}}')" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash"></i></button>
                                  </div>
                              </div>
                              
                          </div>
                          <div class="card-body">
                              <img src="{{$pimg}}"  style="width: 100%; height: 195px; object-fit: contain;">  
                          </div>
                      </div>
                  </div> 
                  @endforeach
                  @endif
              </div>
            </form>



          
            <div class="mt-5 text-center">
            <a href="{{url('auth/business/resorts/edit_resort_features/'.$resorts2[0]->id)}}" class="btn btn-primary rounded-0 pt-3 pb-3" type="submit">SAVE AND CONTINUE</a>
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





        @include('inc.footer')

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

  $('#myDropify').dropify();

  var _URL = window.URL || window.webkitURL;

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 9000
  });

  $("#img-form").on('change', '#myDropify', function(e){
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
                  formData.append('resort', $('#resort').val());
                  formData.append('img_1', file);
                  //$("#width").text(imgwidth);
                  //$("#height").text(imgheight);
                  if(imgheight <= minheight || imgwidth <= minwidth){
                  $("#myDropify").css('border', 'solid 1px red');
                  Toast.fire({
                  icon: 'error',
                  title: "Image dimention too low ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels), minimum requirement (Width:"+ minwidth +" pixels & Height:"+ minheight + " pixels)."
                  });
                  
                  }else if(imgheight > maxheight || imgwidth > maxwidth){
                  $("#myDropify").css('border', 'solid 1px red');
                  Toast.fire({
                  icon: 'error',
                  title: "Image dimention too high ( Width:"+ imgwidth +" pixels & Height:"+ imgheight + " pixels), maximum requirement (Width:"+ maxwidth +" pixels & Height:"+ maxheight + " pixels)."
                  });
                  }else if(imgheight > imgwidth){
                  $("#myDropify").css('border', 'solid 1px red');
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