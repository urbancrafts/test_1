

      <?php $__env->startSection('content'); ?>
		<!-- Page loader -->
    
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')); ?>">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/bs-stepper/css/bs-stepper.min.css')); ?>">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins_2/dropzone/min/dropzone.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins_2/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">


<script type="text/javascript">
$(window).ready(function(){

$("form#msg-form").on('submit', function(e){
e.preventDefault();

var action = $(this).attr('action');
var formdata = new FormData(this);//create an instance for the form input fields

if($.trim($('#receipient').val()) == ""){
     $('#receipient').css('border', 'solid 1px red');
     $('.msg-error').show();
     $('.show-msg').html('Please select a receipient!');  
}else if($.trim($('#subject').val()) == ""){
     $('#subject').css('border', 'solid 1px red');
     $('.msg-error').show();
     $('.show-msg').html('Enter subject for this message!');   
}else if($.trim($('#compose-textarea').val()) == ""){
    $('#compose-textarea').css('border', 'solid 1px red');
     $('.msg-error').show();
     $('.show-msg').html('Enter your messages!'); 
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
            $('.msg-error').hide();
             $(".msg-success").show();
             $(".show-msg").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
         $(".msg-success").hide();
         $(".msg-error").show();
         $(".show-msg").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
              $("#send-btn").prop('disabled', true);
              $(".msg-error").hide();
              $(".msg-success").show();
              $(".show-msg").html(data.message);
              window.location = "<?php echo e(url('admin/messages')); ?>";
            }else if(data.success == false){
              $(".msg-success").hide();
              $(".msg-error").show();
              $(".show-msg").html(data.data);
            }else{
                $(".msg-success").hide();
              $(".msg-error").show();
              $(".show-msg").html(data);
            }
              
         }
         });

}

});


$('input[type=radio][name=user_type]').on('change', function () {
        var getVal = jQuery(this).val();
        
        $.ajax({
          headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
         type: "POST",
         dataType: "json",
         url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@message_user_type')); ?>",
         data: {"user_type": getVal},
         beforeSend:function(){
            $('.msg-error').hide();
             $(".msg-success").show();
             $(".show-msg").html("<div class='load'>Loading...</div>");
         },
         complete:function(){
             $(".load").hide();
         },
         error:function(){
         $(".msg-success").hide();
         $(".msg-error").show();
         $(".show-msg").html("Please check your internet connection");
         },
         success:function(data){
            if(data.success == true){
             
              $(".msg-error").hide();
              $(".msg-success").hide();
              $("#receipient").html(data.data);
              
            }else if(data.success == false){
              $(".msg-success").hide();
              $(".msg-error").show();
              $(".show-msg").html(data.data);
            }else{
                $(".msg-success").hide();
              $(".msg-error").show();
              $(".show-msg").html(data);
            }
              
         }
         });   
    
    });


});
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
        Inbox
        <small>new message</small>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="<?php echo e(url('admin/messages/new_message')); ?>" class="btn btn-primary btn-block mb-3">Compose</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                <a href="<?php echo e(url('admin/messages')); ?>" class="nav-link"><i class="fa fa-inbox"></i> Inbox
                  <span class="badge bg-primary float-right inbox-note"></span></a></li>
                <li class="nav-item"><a href="<?php echo e(url('admin/messages/sent_messages')); ?>" class="nav-link"><i class="fa fa-envelope-o"></i> Sent</a></li>
                <?php if(Auth::user()->role == 1 || Auth::user()->user_type == 'admin'): ?>
                <li class="nav-item"><a href="<?php echo e(url('admin/messages/support')); ?>" class="nav-link"><i class="fa fa-user-secret"></i> Supports <span class="badge bg-warning float-right support-note"></span></a>
                </li>
                <?php endif; ?>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
         
        </div>
        <!-- /.col -->
        

        <div class="col-md-9">
            
            <form id="msg-form" action="<?php echo e(action('App\Http\Controllers\AjaxRequestController@post_msg')); ?>">
            <div class="card card-primary card-outline">
                <div class="alert alert-success alert-dismissible msg-success" style="display: none" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Message!</h4>
                    <span class="show-msg"></span>
                  </div>
    
                  <div class="alert alert-danger alert-dismissible msg-error" style="display: none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Error!</h4>
                    <span class="show-msg"></span>
                  </div>
              <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
              </div>
              <!-- /.box-header -->
              <div class="card-body">
                  
                <div class="form-group">
                    <label>Send to:</label> 
                    <?php if(Auth::user()->user_type == "admin"): ?>
                    
                    <label><input type="radio" name="user_type" value="all" id="radioPrimary2" checked>All Users</label>
                    <label><input type="radio" name="user_type" value="admin" id="radioPrimary2">Admin Users</label>
                    <label><input type="radio" name="user_type" value="member" id="radioPrimary2">Club Members</label>
                    <label><input type="radio" name="user_type" value="resort_owner" id="radioPrimary2">Resort Owners</label>
                    <label><input type="radio" name="user_type" value="boat_owner" id="radioPrimary2">Boat Owners</label>         
                    <?php else: ?>
                    <label><input type="radio" name="user_type" value="all" id="radioPrimary2" checked>All Users</label>
                    <label><input type="radio" name="user_type" value="admin" id="radioPrimary2">Admin Users</label>  
                    <?php endif; ?>
                    <select class="form-control select2" name="receipient[]" id="receipient" multiple="multiple" data-placeholder="Send to"
                            style="width: 100%;">

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->email); ?>"><?php echo e($user->name); ?></option>   
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                      
                    </select>
                  </div>
                  <input type="hidden" id="sender" name="sender" value="<?php echo e(Auth::user()->email); ?>" />
                  <input type="hidden" id="sender-name" name="sender-name" value="<?php echo e(Auth::user()->name); ?>" />
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" placeholder="Subject:">
                </div>
                <div class="form-group">
                      <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px" placeholder="Type in your message here....">
                        
                      </textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Attachment
                    <input type="file" name="attachment" id="attachment">
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="card-footer">
                <div class="float-right">
                  
                  <button type="submit" class="btn btn-primary" id="send-btn"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /. box -->
            </form>
          </div>
          <!-- /.col -->



      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>




        <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		

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

<script src="<?php echo e(asset('plugins_2/select2/js/select2.full.min.js')); ?>"></script>
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



<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist_2/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('dist_2/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist_2/js/demo.js')); ?>"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>

</body>
</html>

		<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/home/new-message.blade.php ENDPATH**/ ?>