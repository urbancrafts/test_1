@extends('layouts.app')

@section('content')

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

//alert('working...');



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
          Toast.fire({
          icon: 'error',
          title: 'Enter the facility name, Example: Swimming pool, Gym, Spar etc.'
          });
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
             
         },
         
         success:function(data){
            if(data.status == true){
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
          icon: 'info',
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

function deleteFeatures(fid,feature){
  var site_url = "{{ url('') }}";//full site domain url

  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 9000
    });

  $query = confirm("Do you want to remove "+feature+" from the list?");
  if($query == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "DELETE",
         dataType: "json",
         url: site_url+"/auth/admin/business/resorts/remove_resort_feature/"+fid,
        //  data: {'feature_id': fid}, 
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

    @include('inc.admin-sidebar')




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Account
        <small>Resort features</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" id="blog-body">
         
       @if(Auth::user()->user_type == "Admin")
          <div class="card card-info">
            <div class="card-header">
              
              <h3 class="card-title"><i class="fa fa-home"></i> Create Resort Feature</h3>
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
              <form id="resort_feature_form" action="{{ action('App\Http\Controllers\AdminResortController@create_resort_feature') }}" method="post" enctype="multipart/form-data">
                
                
                <div class="form-group">
                    <span style="color: red; display: none" class="resort-feature-error">(*Required)</span>
                  <input type="text" class="form-control" id="resort-feature" name="resort_feature" placeholder="Enter Resort Feature">
                </div>
               
                
                <div class="card-footer clearfix">
                  <button type="submit" class="pull-right btn btn-default" >Create
                    <i class="fa fa-arrow-circle-right"></i></button>
                </div>
               <span class="alert alert-danger blog-alert-danger1" style="display: none"></span><span class="alert alert-success blog-alert-success1" style="display: none"></span>
              </form>
            </div>

            <div class="form-group">
              <fieldset class="resort-features">
                <legend>Resort features</legend>
                @if(count($features) > 0)
                @foreach ($features as $feature)
        <label>{{$feature->feature}}<a href="#" class="fas fa-trash" onclick="deleteFeatures('{{$feature->id}}','{{$feature->feature}}')" title="Delete {{$feature->feature}}"></a></label>       
                @endforeach
                @endif
                
                
              </fieldset>
             </div>
            
          </div>

          @endif

            
          <!-- quick email widget -->
          

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        
        

        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

      </div>
    </section>

    <div class="modal" id="modal-elemet">
        
    </div>

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