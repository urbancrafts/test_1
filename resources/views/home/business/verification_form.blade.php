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

<link rel="stylesheet" href="{{ asset('plugins_2/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('plugins_2/toastr/toastr.min.css')}}">
<!-- Theme style -->

<script type="text/javascript">
$(document).ready(function(){
  var site_url = "{{ url('') }}";//full site domain url
  

  var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 9000
    });
 


  load_country_list();

    function load_country_list(){
        var action = site_url+"/countries";
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            type: "GET",
            dataType: "json",
            url: action,
            beforeSend:function(){
              Toast.fire({
              icon: 'info',
              title: 'Request processing...'
               });
              
                // jQuery('.status').html(" Attempting to fetch LGA data...");
            },
            complete:function(){
                
            },
            success:function(data){
                if(data.status == true){

              Toast.fire({
              icon: 'success',
              title: data.message
               });
                //   array.forEach(elements => as element{
                    
                //   });

                for(var i =0; i < data.data.values.length; i++){
                    $('#country').append("<option value='"+data.data.values[i].id+"'>"+data.data.values[i].name+"</option>");
                    // var opt = ;
                }
                    
                    //console.log(opt);
                    //jQuery('.status').html(" ");
                    
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

    $("#country").on("change", function(e){//event handler for login form
      
        var country_id = $(this).val();
        var action = site_url+"/countries/populate_states_by_country/"+country_id;
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            type: "GET",
            dataType: "json",
            url: action,
            //data: {"lga_id": lga},
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

                //   array.forEach(elements => as element{
                    
                //   });
                $('#state').html(" ");
                for(var i =0; i < data.data.values.length; i++){
                    
                    $('#state').append("<option value='"+data.data.values[i].id+"'>"+data.data.values[i].name+"</option>");
                    // var opt = ;
                }
                    
                    //console.log(opt);
                    // jQuery('.status').html(" ");
                    
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
            title: errors.data.message
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

    });


    $("#state").on("change", function(e){//event handler for login form
      
      var state_id = $(this).val();
        var action = site_url+"/countries/populate_cities_by_state/"+state_id;
      $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
          type: "GET",
          dataType: "json",
          url: action,
          // data: {"ward_id": ward_id},
          beforeSend:function(){
            Toast.fire({
              icon: 'info',
              title: 'Request processing...'
               });
              // jQuery('.status').html(" Attempting to fetch LGA data...");
          },
          complete:function(){
              
          },
         
          success:function(data){
              if(data.status == true){

              //   array.forEach(elements => as element{
                  
              //   });
              $('#city').html(" ");
              for(var i =0; i < data.data.values.length; i++){
                  
                  $('#city').append("<option value='"+data.data.values[i].id+"'>"+data.data.values[i].name+"</option>");
                  // var opt = ;
              }
                  
                  //console.log(opt);
                  // jQuery('.status').html(" ");
                  
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

  });

  




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
 
   

$('form#business-verification-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#owner_first_name').val()) == ""){
     $('#owner_first_name').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Enter the first name of the registerer'
      });
     
}else if($.trim($('#owner_last_name').val()) == ""){
     $('#owner_last_name').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Enter the last name of the registerer'
      });
}else if($.trim($('#business_name').val()) == ""){
     $('#business_name').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Enter your registered business name'
      });
    }else if($.trim($('#category').val()) == ""){
     $('#category').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Select your category from the category list'
      });
}else if($.trim($('#email').val()) == ""){
     $('#email').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Enter business email address'
      });
    }else if($.trim($('#phone').val()) == ""){
     $('#phone').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Select business phone number'
      });
}else if($.trim($('#country').val()) == ""){
     $('#country').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Select the country where your business was registered'
      });
    }else if($.trim($('#state').val()) == ""){
     $('#state').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Select state'
      });
    }else if($.trim($('#city').val()) == ""){
     $('#city').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Select city'
      });
    }else if($.trim($('#address').val()) == ""){
     $('#address').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Enter business address'
      });
    }else if($.trim($('#reg_number').val()) == ""){
     $('#reg_number').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Enter business registration number'
      });
    }else if($.trim($('#document').val()) == ""){
     $('#document-field').css('border', 'solid 1px red');
     Toast.fire({
     icon: 'error',
     title: 'Business document is required'
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
             //$(".alert").hide();
         },
         
         success:function(data){
            if(data.status == true){
              Toast.fire({
              icon: 'success',
              title: data.message
              });
            window.location = site_url+'/auth/business/dashboard';
            }else if(data.status == false){
              Toast.fire({
              icon: 'error',
              title: data.message
              });
            }else{
              Toast.fire({
              icon: 'success',
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
    
		
    @if (count($businesses) > 0)

    @include('inc.header2')

  @include('inc.business-sidebar')

    @endif



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
      <h1>
        Business
        <small>Verification form</small>
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

     
      

      

     

      
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable" id="blog-body">
         
            <div class="card card-info">
                <div class="card-header">
                  
                  
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
                  <form id="business-verification-form" action="{{ action('App\Http\Controllers\BusinessController@upload_business_verification') }}" method="post" enctype="multipart/form-data">
                  
                   
                   <div class="row">
                    <div class="col-sm-6">
                   <div class="form-group">
                      <input type="text" class="form-control" id="owner_first_name" name="owner_first_name" value="{{ Auth::user()->first_name }}" placeholder="Owner's first name" onfocus="elementFocus(this.id)">
                      
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="owner_last_name" name="owner_last_name" value="{{ Auth::user()->last_name }}" placeholder="Owner's last name" onfocus="elementFocus(this.id)">
                    </div>
                    </div>
                   </div>


                   

                   <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business name" onfocus="elementFocus(this.id)">
                    </div>
                    </div>

                    <div class="col-sm-6">
                   <div class="form-group">
                     <select name="category" id="category" class="form-control" onfocus="elementFocus(this.id)">
                      <option selected disabled>----Select business category----</option>
                      <option value="Resort">Resort</option>
                      <option value="Boat">Boat</option>
                      <option value="Other Services">Other Services</option>
                     </select>
                   </div>
                    </div>
                   </div>


                   <div class="row">
                    <div class="col-sm-6">
                   <div class="form-group">
                      <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Business email" onfocus="elementFocus(this.id)">
                      
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" placeholder="Business phone number" onfocus="elementFocus(this.id)">
                    </div>
                    </div>
                   </div>


                   <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                     <select name="country" id="country" class="form-control" onfocus="elementFocus(this.id)">
                      <option selected disabled>--Select country of registration--</option>
                      
                     </select>
                   </div>
                    </div>

                    <div class="col-sm-6">
                   <div class="form-group">
                     <select name="state" id="state" class="form-control" onfocus="elementFocus(this.id)">
                      <option selected disabled>--Select state--</option>
                     </select>
                   </div>
                    </div>
                   </div>


                   <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                     <select name="city" id="city" class="form-control" onfocus="elementFocus(this.id)">
                      <option selected disabled>--Select city--</option>
                      
                     </select>
                   </div>
                    </div>

                    <div class="col-sm-6">
                   <div class="form-group">
                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip code" onfocus="elementFocus(this.id)">
                   </div>
                    </div>
                   </div>

                   <div class="form-group">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Registered address" onfocus="elementFocus(this.id)">
                    
                   </div>

                   <div class="form-group">
                    <input type="text" class="form-control" id="reg_number" name="reg_number" placeholder="Registration number" onfocus="elementFocus(this.id)">
                    
                   </div>
                  
                   
                    


                    <div class="col-xs-12 image-container image-container-bi" id="add-property-image-container">

                      <div>
                          <p>Images <span class="dim-size">Supported Formats JPG, JPEG, PNG 600 X 400 PX (Max 10 MB)</span></p>
                           
                          
                          
                          
                          <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="file" id="document" class="uploadFile" accept="file/pdf" name="document" data-validation-allowing="pdf">
                              <div id="document-field" class="file-input-button text-center document" style="background-image: url(&quot;&quot;);">
                                  <i class="fa fa-2x fa-plus-circle" aria-hidden="true"></i>
      
                              </div>
      
                              <h5 class="error-file-size" style="display: none"></h5>
                              
                              <span class="help-block form-error document-error">Business document is required in pdf or image*</span>
                   </div>
                    </div>

                    <div class="col-sm-6">
                   <div class="form-group">
                    <input type="file" id="logo" class="uploadFile" accept="image/x-png, image/jpeg, image/jpg" name="logo" data-validation-allowing="jpg, png, jpeg">
                              <div class="file-input-button text-center logo" style="background-image: url(&quot;&quot;);">
                                  <i class="fa fa-2x fa-plus-circle" aria-hidden="true"></i>
      
                              </div>
      
                              <h5 class="error-logo-size" style="display: none"></h5>
                              
                              <span class="help-block form-error logo-error" >Upload company logo</span>
                   </div>
                    </div>
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

        
              

          
        


              <div class="row" id="load-home-blog">
                
               
                

              </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        

        
        
        <div class="col-md-4">
          

          <div class="card card-primary card-outline">
            <div class="card-header with-border">
              <h3 class="card-title">My business list</h3>

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

                @if (count($businesses) > 0)

                @foreach ($businesses as $business)

                @if ($business->business_category == "Resort")
                
                <li class="item">
              
                  <div>
                    
                    <a href="{{ url('auth/business/resorts') }}" class="product-title">Resorts
                    </a>
                    
                  </div>
                </li>
                
                @endif

                @if ($business->business_category == "Boat")
                <li class="item">
              
                  <div>
                    
                    <a href="{{ url('auth/business/boats') }}" class="product-title">Boats
                    </a>
                    
                  </div>
                </li>

                @endif

                @if ($business->business_category == "Other Services")
                
                <li class="item">
              
                  <div>
                    
                    <a href="{{ url('auth/business/services') }}" class="product-title">Services
                    </a>
                    
                  </div>
                </li>

                @endif
                  
                @endforeach

                @else
                  <li>Record empty</li>
                @endif
            
              
                

                
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

</body>
</html>
		@endsection