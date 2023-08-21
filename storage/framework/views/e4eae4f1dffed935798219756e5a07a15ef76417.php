 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <?php if($myselfs[0]->img == null): ?>
            <img src="<?php echo e(asset('storage/img/users/default.png')); ?>" class="img-circle" alt="<?php echo e($myselfs[0]->name); ?>">   
            <?php else: ?>
            <img src="<?php echo e(asset('storage/img/users/'.Auth::user()->id.'/profile/'.$myselfs[0]->img)); ?>" class="img-circle" alt="<?php echo e($myselfs[0]->name); ?>">  
            <?php endif; ?>
        </div>
        <div class="pull-left info">
          <p><?php echo e($myselfs[0]->name); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="active">
            <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin"): ?>
            <a href="<?php echo e(url('admin_dashboard/'.Auth::user()->id)); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                
              </a>  
            <?php else: ?>
            <a href="<?php echo e(url('member_dashboard/'.Auth::user()->id)); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                
              </a>    
            <?php endif; ?>
          
        </li>
        
        
        


        <li class="treeview">
            <a href="#">
              <i class="fa fa-home"></i> <span>Resorts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                <?php if(Auth::user()->role ==1 ||  Auth::user()->user_type == "admin" || Auth::user()->user_type == "resort_owner"): ?>
                <li><a href="<?php echo e(url('admin/create_resort')); ?>"><i class="fa fa-plus"></i> Create Resort</a></li>   
                <?php endif; ?>
              <?php $__currentLoopData = $resorts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resort): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
              <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin" || $resort->created_by == Auth::user()->id): ?>
              <li class="treeview">
                <a href="<?php echo e(url('admin/resort/'.$resort->id)); ?>"><i class="fa fa-home"></i> <?php echo e($resort->name); ?>

                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo e(url('admin/create_room/'.$resort->id)); ?>"><i class="fa fa-hotel"></i> Create room</a></li>
                
                </ul>
              </li>  
              <?php else: ?>
              
              <?php endif; ?>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </ul>
          </li>
        
          <li>
            <a href="<?php echo e(url('admin/messages')); ?>">
              <i class="fa fa-envelope-o"></i> <span>Messages</span>   
              <span class="pull-right-container">
                <small class="label pull-right bg-red inbox-note" id="msg-note"></small>
              </span> 
            </a>
          </li> 
      
          <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin"): ?>
          
          <li>
            <a href="<?php echo e(url('admin/news_letter')); ?>">
              <i class="fa fa-newspaper-o"></i> <span>News Letter Subs</span>   
              <span class="pull-right-container">
                <small class="label pull-right bg-green news-letter-note" id="news-letter-sub-note"></small>
              </span> 
            </a>
          </li> 

          <li class="treeview">
            <a href="#">
              <i class="fa fa-money"></i> <span>Debts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="<?php echo e(url('admin/create_debts')); ?>">
                  <i class="fa fa-plus"></i> <span>Create Record</span> 
                </a>
              </li> 
            </ul>
          </li>
          <?php elseif(Auth::user()->user_type == "member"): ?>
          <li>
            <a href="<?php echo e(url('members/debts')); ?>">
              <i class="fa fa-money"></i> <span>Debts</span> 
              <span class="pull-right-container">
                <small class="label pull-right bg-red" id="debt-note"></small>
              </span>   
            </a>
          </li> 
        <?php endif; ?>

        
        <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin"): ?>
        
        <li>
          <a href="<?php echo e(url('admin/create_store')); ?>">
            <i class="ion ion-bag"></i>
            <span>Store</span>
          </a>
          
        </li>

        <li>
          <a href="<?php echo e(url('admin/index_slider')); ?>">
            <i class="fa fa-laptop"></i>
            <span>Index Slider</span>
          </a>
          
        </li>

        <?php endif; ?>

        <?php if(Auth::user()->user_type == "admin"): ?>
        <li>
            <a href="<?php echo e(url('admin/services')); ?>">
              <i class="fa fa-server"></i>
              <span>Services</span>
            </a>
            
          </li>

        <?php endif; ?>

        <?php if(Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner"): ?>
        
        <li>
          <a href="<?php echo e(url('admin/boat_services')); ?>">
            <i class="fa fa-ship"></i>
            <span>Boat Services</span>
          </a>
          
        </li>

        <?php endif; ?>

        <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin"): ?>
        <li>
            <a href="<?php echo e(url('admin/edit_contents')); ?>">
              <i class="fa fa-edit"></i> <span>Contents</span>
              
            </a>
            
          </li>

        <?php endif; ?>


        <?php if(Auth::user()->role == 1): ?>
        <li>
            <a href="<?php echo e(url('admin/users')); ?>">
              <i class="fa fa-users"></i> <span>Users</span>    
            </a>
          </li>  
        <li>
            <a href="<?php echo e(url('admin/settings')); ?>">
              <i class="fa fa-gear"></i> <span>Settings</span>    
            </a>
          </li>  
        <?php endif; ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/inc/dashboard-side-bar.blade.php ENDPATH**/ ?>