
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo e($settings[0]->site_name); ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning note-counter"></span>
            </a>
            <ul class="dropdown-menu load-note-bar">
              
              
              
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if(Auth::user()->img == null): ?>
              <img src="<?php echo e(asset('storage/img/users/default.png')); ?>" class="user-image" alt="<?php echo e(Auth::user()->name); ?>">   
              <?php else: ?>
              <img src="<?php echo e(asset('storage/img/users/'.Auth::user()->id.'/profile/'.Auth::user()->img)); ?>" class="user-image" alt="<?php echo e(Auth::user()->name); ?>">  
              <?php endif; ?>
              
              <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if(Auth::user()->img == null): ?>
              <img src="<?php echo e(asset('storage/img/users/default.png')); ?>" class="img-circle" alt="<?php echo e(Auth::user()->name); ?>">   
              <?php else: ?>
              <img src="<?php echo e(asset('storage/img/users/'.Auth::user()->id.'/profile/'.Auth::user()->img)); ?>" class="img-circle" alt="<?php echo e(Auth::user()->name); ?>">  
              <?php endif; ?>
                

                <p>
                 <?php echo e(Auth::user()->name); ?>

                 <small>Joined: <?php echo e(Auth::user()->created_at); ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo e(url('users/profile/'.Auth::user()->id)); ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo e(route('logout')); ?>" class="btn btn-default btn-flat" 
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                      <?php echo csrf_field(); ?>
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/inc/header.blade.php ENDPATH**/ ?>