@extends('layouts.app')

@section('content')



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
  padding: 10px;
  overflow-x: auto;
}

fieldset.resort-features legend {
  background:#333;
  color: lightgray;
  font-weight: bold;
  border-radius: 10px;
  padding: 5px;
  font-size: 20px;
  text-align: center;
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

ul.master-order{
  display: flex; 
  justify-content: space-between ;
  flex-wrap: wrap;
  flex-direction: row;
}
ul.master-order li{
  list-style:none;
 
}

ul.master-order li ul{
  position:relative;
  right: 40px;
  
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

  

  $("input[name='feature[]']").on("change", function(){//a readstatechange event to be called when check and uncheck terms & conditions checkbox
      if(this.checked){
     var data_id = $(this).attr('data-target-id');
     $("#slave-order-id-"+data_id).css('display', 'block');
     $("#feature_price_"+data_id).prop('disabled', false);
     $("#feature_duration_"+data_id).prop('disabled', false);

// var feature_name = $(this.checked).val();
// var feature_price = $("#feature_price_"+data_id).val();
// var feature_duration = $("#feature_duration_"+data_id).val();

      }else{
      var data_id = $(this).attr('data-target-id');
     $("#slave-order-id-"+data_id).css('display', 'none');
     $("#feature_price_"+data_id).prop('disabled', true);
     $("#feature_duration_"+data_id).prop('disabled', true);
      }
});  

 
$("#feature-form").on('submit', function(e){
e.preventDefault();

var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var resort_id = $("#resort").val();

var data_id = $("input[name='feature[]']:checked").attr('data-target-id'); 
var feature_name = $("input[name='feature[]']:checked").val();
var feature_price = $("#feature_price_"+data_id).val();
var feature_duration = $("#feature_duration_"+data_id).val();
var formdata = new FormData(this);//create an instance for the form input fields


// const params = {
//   feature: "{\"name\": 	\""+feature_name+"\",\"price\":	\""+feature_price+"\",\"duration\":	\""+feature_duration+"\"}"
//    };

// JSON.stringify(params)

if($.trim($("input[name='feature[]']:checked").val()) == "" ){
Toast.fire({
icon: 'error',
title: 'You have to check one of those items'
});
}else if($("input[name='feature[]']:checked") && $.trim($("input[name='feature_price[]']").val()) == "" || $.trim($("input[name='feature_duration[]']").val()) == ""){
     $("#feature_price_"+data_id).css('border', 'solid 1px red');
     $("#feature_duration_"+data_id).css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'You have to enter price and duration for '+feature_name
     });
     
}else{
     $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         //contentType: 'application/json',
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
             
         },
         
         success:function(data){
            if(data.status == true){
              Toast.fire({
              icon: 'success',
              title: data.message
              });
             
             $(".btn-primary").prop('disabled', false);
             $('.btn-primary').html("SAVE AND CONTINUE");
             window.location = site_url+"/auth/business/resorts/create_room/"+resort_id;
            
             //loadResortModal(data.data.id,data.data.name);
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
title: errors.message
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

function removeFeatures(resort,id,name){
  var site_url = "{{ url('') }}";//full site domain url

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 9000
  });
  $query = confirm("Click Ok to remove "+name+" or Cancle to decline");
  if($query == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "{{ action('App\Http\Controllers\ResortController@remove_resort_user_feature') }}",
         data: {'resort': resort, 'feature_id': id}, 
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
             //$("#sendEmail").prop('disabled', true);
          Toast.fire({
          icon: 'success',
          title: data.message
          });
             
             location.reload();
             //loadResortModal(data.data.id,data.data.name);
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
title: errors.message
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

  }else{
    
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
    <a class="nav-link " href="{{url('auth/business/resorts/edit_resort_img/'.$resorts2[0]->id)}}">Images</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="{{url('auth/business/resorts/edit_resort_features/'.$resorts2[0]->id)}}">Features</a>
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


          <form id="feature-form" method="post" action="{{ action('App\Http\Controllers\ResortController@update_resort_features') }}">
            <input hidden id="resort" name="resort" value="{{$resorts2[0]->id}}" />
            <div class="form-group">
              <fieldset class="resort-features">
                <legend>Resort features</legend>
                @if(count($admin_features) > 0)

                <ul class="master-order">
                @foreach ($admin_features as $key => $admin_feature)
                
                    @if (@isset($features[$key]))
                     
                       @if ($features[$key]->features != $admin_feature)
                         
                       
                    <li class="parent-list"> 
                      <label>
                        <a href="#" class="fas fa-trash" onclick="removeFeatures('{{$resorts2[0]->id}}','{{$features[$key]->id}}','{{$features[$key]->features}}')" title="Delete {{$features[$key]->features}}"></a>
                      <input type="checkbox" name="feature[]" id="feature"  class="minimal" data-target-id="{{$admin_feature->id}}" value="{{$features[$key]->features}}" /> {{$features[$key]->features}} </label>&nbsp;
                      <ul id="slave-order-id-{{$admin_feature->id}}" class="slave-order" style="display: none">
                      <li class="child-list">
                      <input type="number" name="feature_price[]" id="feature_price_{{$admin_feature->id}}" placeholder="Price" style="width: 120px;" value="{{$features[$key]->price}}" disabled />
                      </li>
                      <li class="child-list">
                        <input type="number" name="feature_duration[]" id="feature_duration_{{$admin_feature->id}}" placeholder="duration(1/hr)" value="{{$features[$key]->duration}}" style="width: 120px;" disabled />
                      </li>
                      </ul>  
                    </li>  

                    @endif

                      @else

                    <li class="parent-list"> 
                        <label>
                        <input type="checkbox" name="feature[]" id="feature"  class="minimal" data-target-id="{{$admin_feature->id}}" value="{{$admin_feature->feature}}" /> {{$admin_feature->feature}}</label> &nbsp;
                        <ul id="slave-order-id-{{$admin_feature->id}}" class="slave-order" style="display: none">
                        <li class="child-list">
                        <input type="number" name="feature_price[]" id="feature_price_{{$admin_feature->id}}" placeholder="Price" style="width: 120px;" value="" disabled />
                        </li>
                        <li class="child-list">
                          <input type="number" name="feature_duration[]" id="feature_duration_{{$admin_feature->id}}" placeholder="duration(1/hr)" style="width: 120px;" disabled />
                        </li>
                        </ul>  
                      </li>  

                    @endif
                   
                @endforeach
                </ul>
                @endif


               
              </fieldset>
             </div>


             <div class="mt-5 text-center">
              <button class="btn btn-primary rounded-0 pt-3 pb-3" type="submit">SAVE AND CONTINUE</button>
            </div>

          </form>



         

        

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
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
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


<!-- SweetAlert2 -->
<script src="{{ asset('plugins_2/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins_2/toastr/toastr.min.js')}}"></script>

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


    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox();

  });
</script>

</body>
</html>
		@endsection