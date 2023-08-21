

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
      $(document).ready(function(){
      
      
        
             
             $total_record = <?php echo e(count($blogs)); ?>;
             $record_per_page = 9;
             $numer_of_page = ($total_record / $record_per_page);
             $current_page = 1;
             $start = Math.ceil($current_page * $record_per_page) - $record_per_page;
             loadHomeBlog($record_per_page, $start);
      
        function loadHomeBlog($record_per_page, $start){
          $user_id = "<?php echo e($profiles[0]->id); ?>";
          $action = "loadHomeBlogs";
               $.ajax({
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
               type: "POST",
               dataType: "json",
               url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@load_profile_blog')); ?>",
               data: {"record_per_page": $record_per_page, "start": $start, "user_id": $user_id, "action": $action},
               beforeSend:function(){
                 $("#activity").append("<div class='load'><img src='<?php echo e(asset('loaders/loader.gif')); ?>'/ > Loading...</div>");
               },
               complete:function(){
                 $(".load").remove();
               },
               error:function(){
               $("#activity").append("<div class='errLoading'><img src='<?php echo e(asset('icons/ic_connections.png')); ?>'/ > Please check your internet connection</div>");
               },
               success:function(data){
                 if(data.success == true){
                $("#activity").html(data.data);
                   
                
                }else if(data.success == false){
                $("#activity").html(data.message);
                }else{
                $("#activity").html(data);
                }
                
               }
               });
      
        }
      
        $current_page = 2;
             $(window).scroll(function(){
             if($(window).scrollTop()+window.innerHeight == $(document).height()){
             $start = ($current_page * $record_per_page) - $record_per_page;
              if($current_page <= $numer_of_page){
                loadHomeBlog($record_per_page, $start);
               
              }
             }
             });
             
             
             setInterval(function(){
             
             },130000);
             
             setInterval(function(){
             
             },120000);
          
      
      });
      
      function makeComment(elem, id){
        var field = $("#"+elem);
        
          $(field).keypress(function(e){
            
           if(e.keyCode == 13){
             
            if($.trim(field.val()) == ""){
            alert('comment box cannot empty');
            }else{
             $.ajax({
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
               type: "POST",
               dataType: "json",
               url: "<?php echo e(action('App\Http\Controllers\AjaxRequestController@post_blog_comment')); ?>",
               data: {"comment": field.val(), "blog-id": id},
               beforeSend:function(){
                 $("#blog_comment_"+id).append("<div class='load'><img src='<?php echo e(asset('loaders/loader.gif')); ?>'/ > Loading...</div>");
               },
               complete:function(){
                 $(".load").remove();
               },
               error:function(){
             
               },
               success:function(data){
                 if(data.success == true){
               
                $("#blog_comment_"+id).html(data.data);
                field.val("");
                
                }else if(data.success == false){
                $("#blog_comment_"+id).append(data.data);
                }else{
                $("#blog_comment_"+id).append(data);
                }
                
               }
               });
      
              }
           }
          });
      }
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
          <?php if(Auth::user()->id == $profiles[0]->id): ?>
              My Profile
          <?php else: ?>
        <?php echo e($profiles[0]->name); ?>'s Profile
          <?php endif; ?>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <span class="alert alert-danger show-error" style="display: none"></span><span class="alert alert-success show-success" style="display: none"></span>

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <?php if($profiles[0]->img == null): ?>
                <img class="profile-user-img img-fluid img-circle" src="<?php echo e(asset('storage/img/users/default.png')); ?>" alt="<?php echo e($profiles[0]->name); ?>">   
                <?php else: ?>
                <img class="profile-user-img img-fluid img-circle" src="<?php echo e(asset('storage/img/users/'.$profiles[0]->id.'/profile/'.$profiles[0]->img)); ?>" alt="<?php echo e($profiles[0]->name); ?>">  
                <?php endif; ?>
              </div>

              <h3 class="profile-username text-center"><?php echo e($profiles[0]->name); ?></h3>

              <p class="text-muted text-center"></p>
              
              <?php if($profiles[0]->id == Auth::user()->id || Auth::user()->user_type == "admin"): ?>
              <form id="profile-img-form" action="<?php echo e(action('App\Http\Controllers\AjaxRequestController@upload_profile_image')); ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="user_id" name="user_id" value="<?php echo e($profiles[0]->id); ?>" />
             <input type="file" id="p_img" name="p_img" title="browse for a profile image" style="width: 190px;" />
             <button class="btn btn-primary btn-block">Upload<button>
              </form>
              <?php endif; ?>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <strong><i class="fa fa-info margin-r-5"></i> Info</strong>

              <p class="text-muted">
                <?php echo e($profiles[0]->about); ?>

              </p>

              <hr>

              <strong><i class="fa fa-user margin-r-5"></i> User Type</strong>

              <p class="text-muted">
                <?php if($profiles[0]->user_type == "member"): ?>
                   Club Member
                <?php elseif($profiles[0]->user_type == "resort_owner"): ?>
                  Resort Owner
                <?php elseif($profiles[0]->user_type == "boat_owner"): ?>
                  Boat Owner
                <?php elseif($profiles[0]->user_type == "yacht_owner"): ?>
                  Yacht Owner
                <?php elseif($profiles[0]->user_type == "admin"): ?>
                  Admin User
                <?php endif; ?>
              </p>

              <hr>

              <strong><i class="fa fa-briefcase margin-r-5"></i> Profession</strong>

              <p>
                <?php echo e($profiles[0]->profession); ?>

              </p>

             

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">

                <li class="nav-item"><a href="#activity" data-toggle="tab" class="fa fa-comment nav-link active"> Activity</a></li>
              
                <li class="nav-item"><a href="#settings" data-toggle="tab" class="fa fa-gear nav-link"> Settings</a></li>
              <?php if( Auth::user()->id == $profiles[0]->id): ?>
              <li class="nav-item"><a href="#security" data-toggle="tab" class="fa fa-lock nav-link"> Security</a></li>
              <?php endif; ?>
            </ul>
            </div>
            <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                
                
              </div>
              <!-- /.tab-pane -->
             
               
              <div class="tab-pane" id="settings">
                 <?php if(Auth::user()->id == $profiles[0]->id || Auth::user()->role == 1): ?>
                <form id="profile-update-form" action="<?php echo e(action('App\Http\Controllers\AjaxRequestController@profile_update_upload')); ?>" class="form-horizontal" method="POST">
                 
                  <div class="form-group">
                    <input type="hidden" name="user_id" value="<?php echo e($profiles[0]->id); ?>" />
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Enter your name" value="<?php echo e($profiles[0]->name); ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="p_email" name="p_email" placeholder="Enter your email address" value="<?php echo e($profiles[0]->email); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Phone No.</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="p_number" name="p_number" placeholder="Enter your phone number" value="<?php echo e($profiles[0]->phone); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">About</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="about" name="about" placeholder="A brief bio data"><?php echo e($profiles[0]->about); ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Occupation</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo e($profiles[0]->profession); ?>" placeholder="Enter occupation">
                    </div>
                  </div>
                  
                  <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin"): ?>

                  <div class="form-group">
                    <label for="inputposition" class="col-sm-2 control-label">Position</label>

                    <div class="col-sm-10">
                      <select id="position" name="position" class="form-control">
                        <?php if($profiles[0]->position != ""): ?>
                      <option value="<?php echo e($profiles[0]->position); ?>" selected><?php echo e($profiles[0]->position); ?></option>
                      <option value="president">president</option>
                      <option value="vice president">vice president</option>
                      <option value="general secretary">general secretary</option>
                      <option value="financial secretary">financial secretary</option>
                      <option value="trustee">trustee</option>
                       
                           
                       <?php else: ?>
                      <option value="" selected disabled>Select position</option>
                      <option value="president">president</option>
                      <option value="vice president">vice president</option>
                      <option value="general secretary">general secretary</option>
                      <option value="financial secretary">financial secretary</option>
                      <option value="trustee">trustee</option>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputprivilege" class="col-sm-2 control-label">Privilege</label>

                    <div class="col-sm-10">

                      <select id="privilege" name="privilege[]" class="form-control select2" multiple="multiple" data-placeholder="Select addition privileges">
                        
                        <?php if($profiles[0]->user_type == "member"): ?>
                        
                        <?php if($profiles[0]->privilege == "resort_owner" && $profiles[0]->privilege_2 == ""): ?>
                        <option value="resort_owner" selected>Resort Owner</option>
                        <option value="boat_owner">Boat Owner</option> 
                        <?php elseif($profiles[0]->privilege_2 == "boat_owner" && $profiles[0]->privilege == ""): ?>
                        <option value="boat_owner" selected>Boat Owner</option>
                        <option value="resort_owner">Resort Owner</option> 
                        <?php elseif($profiles[0]->privilege == "resort_owner" && $profiles[0]->privilege_2 == "boat_owner"): ?>
                        <option value="resort_owner" selected>Resort Owner</option>
                        <option value="boat_owner" selected>Boat Owner</option> 
                        <?php else: ?>
                        <option value="boat_owner">Boat Owner</option>
                        <option value="resort_owner">Resort Owner</option>
                        <?php endif; ?>
                       <?php elseif($profiles[0]->user_type == "resort_owner"): ?>
                       <?php if($profiles[0]->privilege_2 == "boat_owner"): ?>
                       <option value="boat_owner" selected>Boat Owner</option>  
                       <?php else: ?>
                       <option value="boat_owner">Boat Owner</option> 
                       <?php endif; ?>
                       
                       <?php elseif($profiles[0]->user_type == "boat_owner"): ?>
                       <?php if($profiles[0]->privilege == "resort_owner"): ?>
                       <option value="resort_owner" selected>Resort Owner</option>
                       <?php else: ?>
                       <option value="resort_owner">Resort Owner</option> 
                       <?php endif; ?>
                       
                       <?php endif; ?>
                      </select>
                    </div>
                  </div>

                   <?php if($profiles[0]->id != Auth::user()->id ): ?>
                       <?php if($profiles[0]->isActive == 1): ?>
                       
                    <label ><input type="radio" name="status" id="status" value="1" checked />Activate</label> 

                 
                  <label><input type="radio" name="status" id="status" value="0" />Deactivate</label>
                 <?php elseif($profiles[0]->isActive == 0): ?>
                 <label ><input type="radio" name="status" id="status" value="1" />Activate</label> 

                 
                  <label ><input type="radio" name="status" id="status" value="0" checked />Deactivate</label>
                  <?php endif; ?>
                  
                  <?php endif; ?>

                  <?php endif; ?>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">

<button type="submit" id="profile_update_btn" class="btn btn-primary">Update</button>  
<span class="alert alert-danger show-error1" style="display: none"></span>
<span class="alert alert-success show-success1" style="display: none"></span>

                  </div>
                  </div>
                </form>
              
          <?php else: ?>

          
              
          <?php endif; ?>
              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="security">
                <fieldset>
                <legend class="fa fa-lock"> Change Password</legend>
                <form id="profile-password-change" action="<?php echo e(action('App\Http\Controllers\AjaxRequestController@profile_change_password')); ?>" class="form-horizontal" method="POST">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Old password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Enter your old password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">New password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Enter your name password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Confirm password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="c_pass" name="c_pass" placeholder="Confirm your new password">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="password_change_btn" class="btn btn-primary">Change</button>
                      <span class="alert alert-danger show-error2" style="display: none"></span>
                      <span class="alert alert-success show-success2" style="display: none"></span>
                    </div>
                  </div>
                </form>
                </fieldset>
              </div>
              <!-- /.tab-pane -->


            </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      </div>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SONY\Desktop\beach_comber\resources\views/home/profile.blade.php ENDPATH**/ ?>