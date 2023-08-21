<!DOCTYPE html>
<html>
     <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  


  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/fontawesome-free/css/all.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('bower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/jqvmap/jqvmap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dist_2/css/adminlte.min.css')); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/daterangepicker/daterangepicker.css')); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/summernote/summernote-bs4.min.css')); ?>">

  


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style>

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 10000; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */


/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* Modal Header */
.modal-header {
  padding: 2px 16px;
  background-color: #4c90c7;
  color: white;
}

/* Modal Body */
.modal-body {padding: 2px 16px;}

/* Modal Footer */
.modal-footer {
  padding: 2px 16px;
  background-color: #4c90c7;
  color: white;
}

/* Modal Content */
.modal-content {
  z-index: 10000;
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@keyframes  animatetop {
  from {top: -300px; opacity: 0}
  to {top: 0; opacity: 1}
}

</style>
<script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('js/app/library.js')); ?>"></script>

<script src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script type="text/javascript">
var modal = document.getElementById('modal-elemet');
var span = document.getElementsByClassName('close');

span.onclick = function(){
  modal.style.display = "none";
}

window.onclick = function(event){
  if(event.target == modal){
    modal.style.display = "none"; 
  }
}

function timeSince(date) {

var seconds = Math.floor((new Date() - date) / 1000);

var interval = seconds / 31536000;

if (interval > 1) {
  return Math.floor(interval) + " years";
}
interval = seconds / 2592000;
if (interval > 1) {
  return Math.floor(interval) + " months";
}
interval = seconds / 86400;
if (interval > 1) {
  return Math.floor(interval) + " days";
}
interval = seconds / 3600;
if (interval > 1) {
  return Math.floor(interval) + " hours";
}
interval = seconds / 60;
if (interval > 1) {
  return Math.floor(interval) + " minutes";
}
return Math.floor(seconds) + " seconds";
}

$(document).ready(function(){



function loadRoomModal(resort,id,name){
  $("#modal-elemet").show();
  $("#modal-elemet").html("<div class=\'modal-content \'><div class=\'modal-header\'><span class=\'close\'>&times;<\/span><h2>"+name+" Resort Image Uploads<\/h2><\/div><div class=\'modal-body\'> <form id=\'room-image-upload-form\' action=\'<?php echo e(action('App\Http\Controllers\AjaxRequestController@room_image_upload')); ?>\' method=\'post\' enctype=\'multipart\/form-data\'>  <input type=\'hidden\' id=\'resort\' name=\'resort\' value=\'"+resort+"\' /> <input type=\'hidden\' id=\'room\' name=\'room\' value=\'"+id+"\' />  <div class=\'form-group\'><\/div><div class=\'box-footer clearfix\'><button type=\'submit\' class=\'pull-right btn btn-default\' id=\'sendEmail\'>Submit<i class=\'fa fa-arrow-circle-right\'><\/i><\/button><\/div><span class=\'alert alert-danger blog-alert-danger\' style=\'display: none\'><\/span><span class=\'alert alert-success blog-alert-success\' style=\'display: none\'><\/span> <\/form> <\/div> <div class=\'modal-footer\'><\/div><\/div>");
}

$('#title').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
});

$('#blog-content').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
});

$('#name').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-name-error').hide();
});

$('#price').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-price-error').hide();
});

$('#address').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-address-error').hide();
});

$('#desc').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-desc-error').hide();
});
$('#email').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-email-error').hide();
});

$('#phone').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-phone-error').hide();
});

$('#pass').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-pass-error').hide();
});

$('#cpass').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-cpass-error').hide();
});


$('#resort-img1').on('change', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-media-error').hide();
});

$('#category').on('change', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-category-error').hide(); 
});

$('#qnty').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-qnty-error').hide();
});

$('#capacity').on('focus', function(e){
  $(this).css('border', 'solid 1px gray');
  $('.resort-capacity-error').hide();
});



$('form#blog-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');
//var uid = jQuery("#uid").val();
//var name = jQuery("#name").val();
//var title = jQuery("#title").val();
//var content = jQuery("#blog-content").val();

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#title').val()) == ""){
     $('#title').css('border', 'solid 1px red');
     $('.blog-alert-danger').show();
     $('.blog-alert-danger').html('Please enter title for your blog!');  
}else if($.trim($('#blog-content').val()) == ""){
     $('#blog-content').css('border', 'solid 1px red');
     $('.blog-alert-danger').show();
     $('.blog-alert-danger').html('Type your blog content!');  
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
             $(".alert").hide();
         },
         error:function(){
         $(".blog-alert-success").hide();
         $(".blog-alert-danger").show();
         $(".blog-alert-danger").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
             $("#blog-body").prepend(data.data);
             $("#sendEmail").prop('disabled', true);
             $(".blog-alert-success").show();
             $(".blog-alert-success").html('Blog posted succesfully.');
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








$('form#user-form').on('submit', function(e){
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

}else if($.trim($('#email').val()) == ""){
  $('#email').css('border', 'solid 1px red');
  $('.resort-email-error').show();

}else if($.trim($('#phone').val()) == ""){
  $('#phone').css('border', 'solid 1px red');
  $('.resort-phone-error').show();
  $('.resort-phone-error').html('(*Required)');

}else if(!Number($('#phone').val())){
  $('#phone').css('border', 'solid 1px red');
  $('.resort-phone-error').show();
  $('.resort-phone-error').html('(Phone field requires numeric data only)');
}else if($.trim($('#pass').val()) == "" || $('#pass').val().length < 6){
  $('#pass').css('border', 'solid 1px red');
  $('.resort-pass-error').show();
  $('.resort-pass-error').html('(*Required|Password field requires 6 characters minimum )');

}else if($.trim($('#cpass').val()) == ""){
  $('#cpass').css('border', 'solid 1px red');
  $('.resort-cpass-error').show();
  $('.resort-cpass-error').html('(*Required|Confirm the password entry)');

}else if($.trim($('#cpass').val()) != $('#pass').val()){
  $('#cpass').css('border', 'solid 1px red');
  $('.resort-cpass-error').show();
  $('.resort-cpass-error').html('(*Password not matched)');

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
              $(".blog-alert-danger").hide();
              $(".blog-alert-success").css('display', 'block !important');
              $(".blog-alert-success").html(data.message);
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
}else if($.trim($('#site-name').val()) == ""){
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
              $(".blog-alert-danger").hide();
              $(".blog-alert-success").css('display', 'block !important');
              $(".blog-alert-success").html(data.message);
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



$('form#shop-category-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#category-name').val()) == ""){
     $('#category-name').css('border', 'solid 1px red');
     $('.resort-cname-error').show();

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





$('form#create-debt-form').on('submit', function(e){
e.preventDefault();
var action = $(this).attr('action');

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#category').val()) == ""){
     $('#category').css('border', 'solid 1px red');
     $('.resort-category-error').show();
}else if($.trim($('#amount').val()) == ""){
     $('#amount').css('border', 'solid 1px red');
     $('.resort-amount-error').show();
}else if(!Number($('#amount').val())){
  $('#amount').css('border', 'solid 1px red');
  $('.resort-amount-error').show();
  $('.resort-amount-error').html('Credit amount field accepts numeric input only');
}else if(jQuery.trim($('#datepicker').val()) == ""){
    $('#datepicker').css('border', 'solid 1px red');
     $('.resort-date-error').show();
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
             $(".show-msg").html("<div class='load'>Loading...</div>");
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
              $(".blog-alert-danger-2").hide();
              $(".show-msg").html(data.message);
            }else if(data.success == false){
              $(".blog-alert-success").hide();
              $(".blog-alert-danger").hide();
              $(".blog-alert-danger-2").show();
              $(".show-msg").html(data.data);
            }else{
              $(".blog-alert-success").hide();
              $(".blog-alert-danger").show();
              $(".blog-alert-danger").html(data);
            }
              
         }
         });

}

});




$("#profile-img-form").on('submit', function(e){
e.preventDefault();

var action = $(this).attr('action');

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#p_img').val()) == ""){
$('#p_img').css('border', 'solid 1px red');
$('.show-error').fadeIn('slow', function(){
  $('.show-error').fadeOut(8000);
});
$('.show-error').html('*Browse for an image');

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
             $(".show-success").show();
             $('.show-error').hide();
             $(".show-success").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
         $(".show-success").hide();
         $(".show-error").show();
         $(".show-error").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              $("#sendEmail").prop('disabled', true);
              $(".show-success").show();
              $(".show-success").html(data.message);
              location.reload();
            }else if(data.success == false){
              $(".show-success").hide();
              $(".show-error").show();
              $(".show-error").html(data.message);
            }else{
              $(".show-success").hide();
              $(".show-error").show();
              $(".show-error").html(data);
            }
              
         }
         });

}


});


$("#profile-update-form").on('submit', function(e){
  e.preventDefault();
  var action = $(this).attr('action');

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#p_name').val()) == ""){
     $('#p_name').css('border', 'solid 1px red');
     $('.show-error1').fadeIn('slow', function(){
  $('.show-error1').fadeOut(8000);
});
     $('.show-error1').html('name field is required');
}else if($.trim($('#p_email').val()) == ""){
     $('#p_email').css('border', 'solid 1px red');
     $('.show-error1').fadeIn('slow', function(){
  $('.show-error1').fadeOut(8000);
});;
     $('.show-error1').html('enter email address');
}else if($.trim($('#p_number').val()) == ""){
  $('#p_number').css('border', 'solid 1px red');
     $('.show-error1').fadeIn('slow', function(){
  $('.show-error1').fadeOut(8000);
});;
     $('.show-error1').html('phone number required!');
}else if(!Number($('#p_number').val())){
  $('#p_number').css('border', 'solid 1px red');
  $('.show-error1').fadeIn('slow', function(){
  $('.show-error1').fadeOut(8000);
});;
     $('.show-error1').html('phone number field requires numeric data only');
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
             $(".show-success1").show();
             $('.show-error1').hide();
             $(".show-success1").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
         $(".show-success1").hide();
         $(".show-error1").show();
         $(".show-error1").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              $("#profile_update_btn").prop('disabled', true);
              $(".show-success1").show();
              $(".show-error1").hide();
              $(".show-success1").html(data.message);
            }else if(data.success == false){
              $(".show-success1").hide(); 
              $(".show-error1").show();
              $(".show-error1").html(data.data);
            }else{
              $(".show-success1").hide(); 
              $(".show-error1").show();
              $(".show-error1").html(data);
            }
              
         }
         });

}

});


$("#profile-password-change").on('submit', function(e){
  e.preventDefault();
  var action = $(this).attr('action');

var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#old_pass').val()) == ""){
     $('#old_pass').css('border', 'solid 1px red');
     $('.show-error2').fadeIn('slow', function(){
  $('.show-error2').fadeOut(8000);
});
     $('.show-error2').html('Enter your old password');
}else if($.trim($('#new_pass').val()) == "" || $.trim($('#new_pass').val()).length < 6){
     $('#new_pass').css('border', 'solid 1px red');
     $('.show-error2').fadeIn('slow', function(){
  $('.show-error2').fadeOut(8000);
});;
     $('.show-error2').html('Type in your new password|Minimum of six(6) characters required.');
}else if($.trim($('#c_pass').val()) == ""){
  $('#c_pass').css('border', 'solid 1px red');
     $('.show-error2').fadeIn('slow', function(){
  $('.show-error2').fadeOut(8000);
});;
     $('.show-error2').html('Confirm new password');
}else if($.trim($('#c_pass').val()) != $('#new_pass').val()){
  $('#c_pass').css('border', 'solid 1px red');
     $('.show-error2').fadeIn('slow', function(){
  $('.show-error2').fadeOut(8000);
});;
     $('.show-error2').html('Confirmed password does not match with new password entry');
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
             $(".show-success2").show();
             $('.show-error2').hide();
             $(".show-success2").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
         $(".show-success2").hide();
         $(".show-error2").show();
         $(".show-error2").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              $("#password_change_btn").prop('disabled', true);
              $(".show-success2").show();
              $(".show-error2").hide();
              $(".show-success2").html(data.message);
            }else if(data.success == false){
              $(".show-success2").hide(); 
              $(".show-error2").show();
              $(".show-error2").html(data.data);
            }else{
              $(".show-success2").hide(); 
              $(".show-error2").show();
              $(".show-error2").html(data);
            }
              
         }
         });

}
});


$(".dropdown-toggle").on("click", function(e){

  $.ajax({
				headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 },
				 type: "POST",
			   dataType: "json",
			   url: "<?php echo e(action('App\Http\Controllers\NotificationController@notification_bar')); ?>",
			   data: {"action": "loadNoteBar"},
			   beforeSend:function(){
				   $(".load-note-bar").html("<div class='load'>Opening<img src='<?php echo e(asset('loaders/loader.gif')); ?>'/ ></div>");
			   },
			   complete:function(){
				   $(".load").remove();
			   },
			   error:function(){
          $(".load-note-bar").html("<div class='errLoading'><img src='<?php echo e(asset('icons/ic_connections.png')); ?>'/ > Please check your internet connection</div>");
			   },
			   success:function(data){
				   if(data.success == true){
          
          var note_body = '';
          var hint_note = '';
          //var aDay = 24*60*60*1000;
          //const dateTimeAgo = moment(data.data.notification[i].created_at).fromNow();
          for(i = 0; i < data.data.notification.length; i++){
              if(data.data.notification[i].note_type == "Transaction"){
                note_body += "\r\n<a href=\'<?php echo e(url('admin/notifications')); ?>/"+data.data.notification[i].id+"\' class=\'dropdown-item\'><i class=\'fas fa-money mr-2\'><\/i>"+data.data.tranCounter+" "+data.data.notification[i].note_type+" <span class=\'float-right text-muted text-sm\'><\/span> <\/a><div class=\'dropdown-divider\'><\/div>\r\n";
              }else if(data.data.notification[i].note_type == "Subscription"){
                note_body += "\r\n<a href=\'<?php echo e(url('admin/notifications')); ?>/"+data.data.notification[i].id+"\' class=\'dropdown-item\'><i class=\'fas fa-users mr-2\'><\/i>"+data.data.subCounter+" "+data.data.notification[i].note_type+" <span class=\'float-right text-muted text-sm\'><\/span><\/a><div class=\'dropdown-divider\'><\/div>\r\n";
              }else if(data.data.notification[i].note_type == "Comment"){
                note_body += "\r\n<a href=\'<?php echo e(url('admin/notifications')); ?>/"+data.data.notification[i].id+"\' class=\'dropdown-item\'><i class=\'fas fa-commenting mr-2\'><\/i>"+data.data.comCounter+" "+data.data.notification[i].note_type+" <span class=\'float-right text-muted text-sm\'><\/span><\/a><div class=\'dropdown-divider\'><\/div>\r\n";
              }
          }

          if(data.data.note_count < 1){
            hint_note += "There are no new notifications";
          }else if(data.data.note_count == 1){
            hint_note += data.data.note_count+" new notification";
          }else if(data.data.note_count > 1){
            hint_note += data.data.note_count+" new notifications";
          }          
          var html_data = "\r\n<span class=\'dropdown-item dropdown-header\'>\r\n "+hint_note+" <\/span>\r\n  <div class=\'dropdown-divider\'><\/div>\r\n "+note_body+" <a href=\'<?php echo e(url('admin/notifications')); ?>\' class=\'dropdown-item dropdown-footer\'>See All Notifications<\/a>\r\n";
        
					$(".load-note-bar").html(html_data);				
				  }else if(data.success == false){
					$(".load-note-bar").html(data.data);
				  }else{
					$(".load-note-bar").html(data);
				  }
					
			   }
			   });

});


loadDebtNote();
noteCounter();
msgNoteCounter();
newsLetterCounter();
supportNoteCounter();

setInterval(function(){
loadDebtNote();
noteCounter();
msgNoteCounter();
newsLetterCounter();
supportNoteCounter();

      },19000);

});


function updateCredit(id,name){
  var str = confirm('Do you want to update this credit settlement indicating that '+name+' has balanced this debt?');
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@update_debt')); ?>",
         data: {"uid":id},
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

function deleteUser(id,name){
  var str = confirm('Do you really want to delete '+name+'?');
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@delete_user')); ?>",
         data: {"uid":id},
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



function deleteServiceSlide(id,name){
  var str = confirm('Do you really want to delete '+name+'?');
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@delete_service_slide')); ?>",
         data: {"uid":id},
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








function updateReservation(id){
  var str = confirm("Click ok to set resort/room availability to booked.");
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@update_reservation_resources')); ?>",
         data: {"uid":id},
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

function updateReservationState(id){
  var str = confirm("Click ok to set resort/room availability to unbooked.");
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@update_reservation_availability')); ?>",
         data: {"uid":id},
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

function updateBooking(id){
  var str = confirm("Click ok to approve this booking.");
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@update_booking_approval')); ?>",
         data: {"uid":id},
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

function updateBookingState(id){
  var str = confirm("Click ok to set service availability to unbooked.");
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@update_booking_availability')); ?>",
         data: {"uid":id},
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

function selectServiceToUpdate(id){
  var str = confirm("Do you want to update this service? Click Ok to proceed or click Cancel.");
  if(str == true){
    $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@update_index_slide')); ?>",
         data: {"uid":id},
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

function noteCounter(){
  $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\NotificationController@notification_counter')); ?>",
         data: {"loadData": "load"},
         beforeSend:function(){  
         },
         complete:function(){  
         },
         error:function(){
         },
         success:function(data){
            if(data.success == true){
              if(data.data > 0){
              jQuery(".note-counter").html(data.data);
              }
            }else if(data.success == false){
              alert(data.message);
            }else{
              alert(data);
            }
              
         }
         }); 
}


function msgNoteCounter(){
  $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\NotificationController@msg_note')); ?>",
         data: {"loadData": "load"},
         beforeSend:function(){  
         },
         complete:function(){  
         },
         error:function(){
         },
         success:function(data){
            if(data.success == true){
              if(data.data > 0){
              jQuery(".inbox-note").html(data.data);
              }
            }else if(data.success == false){
              alert(data.message);
            }else{
              alert(data);
            }
              
         }
         }); 
}

function newsLetterCounter(){ 
  $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\NotificationController@news_letter_note')); ?>",
         data: {"loadData": "load"},
         beforeSend:function(){  
         },
         complete:function(){  
         },
         error:function(){
         },
         success:function(data){
            if(data.success == true){
              if(data.data > 0){
              jQuery(".news-letter-note").html(data.data);
              }
            }else if(data.success == false){
              alert(data.message);
            }else{
              alert(data);
            }
              
         }
         }); 

}

function supportNoteCounter(){
  $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\NotificationController@support_note')); ?>",
         data: {"loadData": "load"},
         beforeSend:function(){  
         },
         complete:function(){  
         },
         error:function(){
         },
         success:function(data){
            if(data.success == true){
              if(data.data > 0){
              jQuery(".support-note").html(data.data);
              }
            }else if(data.success == false){
              alert(data.message);
            }else{
              alert(data);
            }
              
         }
         }); 
}

function elementFocus(id, element){
  $('#'+id).css('border', 'none');
  $('.'+element).css('display', 'none');
}
</script>

  <?php echo $__env->yieldContent('content'); ?>
  
	<?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/layouts/app.blade.php ENDPATH**/ ?>