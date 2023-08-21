<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo e(url('')); ?>" class="brand-link">
    <img src="<?php echo e(asset('storage/img/site_logo/'.$settings[0]->logo)); ?>" alt="<?php echo e($settings[0]->site_name); ?> Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo e($settings[0]->site_name); ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if($myselfs[0]->img == null): ?>
            <img src="<?php echo e(asset('storage/img/users/default.png')); ?>" class="img-circle elevation-2" alt="<?php echo e($myselfs[0]->name); ?>">   
            <?php else: ?>
            <img src="<?php echo e(asset('storage/img/users/'.Auth::user()->id.'/profile/'.$myselfs[0]->img)); ?>" class="img-circle elevation-2" alt="<?php echo e($myselfs[0]->name); ?>">  
            <?php endif; ?>
        
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo e($myselfs[0]->name); ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        
             <li class="nav-item menu-open">
              <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin"): ?>
              <a class="nav-link <?php echo e(request()->is('admin_dashboard*') ? 'active' : ''); ?>" href="<?php echo e(url('admin_dashboard/'.Auth::user()->id)); ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i> <span>Dashboard</span>
                  
                </a>  
              <?php else: ?>
              <a class="nav-link <?php echo e(request()->is('member_dashboard*') ? 'active' : ''); ?>" href="<?php echo e(url('member_dashboard/'.Auth::user()->id)); ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i> <span>Dashboard</span>
                  
                </a>    
              <?php endif; ?>
            
          </li>
        
          <?php if(Auth::user()->role ==1 ||  Auth::user()->user_type == "admin" || Auth::user()->user_type == "resort_owner" || Auth::user()->privilege == "resort_owner"): ?>
        <li class="nav-item">
          <a href="#" class="nav-link <?php echo e(request()->is('admin/resort_manager*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Resort Manager
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="<?php echo e(url('admin/resort_manager/create_resort')); ?>" class="nav-link"><i class="fas fa-plus"></i> Create Resort</a></li>   
            
            
            
            <?php $__currentLoopData = $resorts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resort): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
              <?php if($resort->created_by == Auth::user()->id || $resort->created_by == Auth::user()->admin): ?>
              <li class="nav-item">
                <a href="<?php echo e(url('admin/resort_manager/resort/'.$resort->id)); ?>" class="nav-link"> 
                  <i class="fas fa-home"></i>
                  <p>
                  <?php echo e($resort->name); ?>

                 <i class="fas fa-angle-left right"></i>
                  </p> 
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                <a href="<?php echo e(url('admin/resort_manager/create_room/'.$resort->id)); ?>" class="nav-link">
                  <i class="fas fa-bed"></i> Create room</a></li>
                
                </ul>
              </li>  
              <?php else: ?>
              
              <?php endif; ?>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      
            
          </ul>
        </li>
        <?php endif; ?>


        <?php if(Auth::user()->role ==1 ||  Auth::user()->user_type == "admin" || Auth::user()->user_type == "boat_owner" || Auth::user()->privilege == "boat_owner"): ?>
        <li class="nav-item">
          <a href="#" class="nav-link <?php echo e(request()->is('admin/boat_manager*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-ship"></i>
            <p>
              Boat Manager
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="<?php echo e(url('admin/boat_manager/create_boat')); ?>" class="nav-link"><i class="fas fa-plus"></i> Create Boat</a></li>   
            
            
            
           
            
          </ul>
        </li>
        <?php endif; ?>


        <?php if(Auth::user()->role ==1 ||  Auth::user()->user_type == "admin" || Auth::user()->user_type == "other_services" || Auth::user()->privilege == "other_services"): ?>
        <li class="nav-item">
          <a href="#" class="nav-link <?php echo e(request()->is('admin/service_manager*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-server"></i>
            <p>
              Service Manager
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="<?php echo e(url('admin/service_manager/create_service')); ?>" class="nav-link"><i class="fas fa-plus"></i> Create Service</a></li>   
            
            
            
           
            
          </ul>
        </li>
        <?php endif; ?>
        
        <li class="nav-item">
          <a href="<?php echo e(url('admin/messages')); ?>" class="nav-link <?php echo e(request()->is('admin/messages*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Messages
              <span class="inbox-note right badge badge-danger" id="msg-note"></span>
            </p>
          </a>

        </li>


        
        <li class="nav-item">
          <a href="#" class="nav-link <?php echo e(request()->is('admin/shop_manager*') ? 'active' : ''); ?>">
            <i class="nav-icon ion ion-bag"></i>
            <p>
              Shop Manager
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="<?php echo e(url('admin/shop_manager/create_shop_item')); ?>" class="nav-link"><i class="fas fa-plus"></i> Create Shop Item</a></li> 
            <li class="nav-item"><a href="<?php echo e(url('admin/shop_manager/my_order_list')); ?>" class="nav-link">
              <i class="fas fa-list-alt"></i> 
              <p>My Order List
              <span  class="badge badge-danger right" id="shop-order-note">
              10
              </span>
              </p>
            </a></li>    
            
            
            <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin"): ?>
            <li class="nav-item"><a href="<?php echo e(url('admin/shop_manager/all_order')); ?>" class="nav-link"><i class="fas fa-list-alt"></i> All Order</a></li> 
            <li class="nav-item"><a href="<?php echo e(url('admin/shop_manager/all_sales')); ?>" class="nav-link"><i class="fas fa-money"></i> All Sales</a></li> 

            <?php endif; ?>
           
            
          </ul>
        </li>
        


        <?php if(Auth::user()->role == 1 || Auth::user()->user_type == "admin"): ?>
        
        
        <li class="nav-item">
          <a href="#" class="nav-link <?php echo e(request()->is('admin/content_manager*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Content Manager
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item">
              <a href="<?php echo e(url('admin/content_manager/news_letter')); ?>" class="nav-link">
                <i class="fas fa-newspaper"></i> 
                <p>News Letter Subs   
                <span  class="label pull-right bg-green badge news-letter-note right" id="news-letter-sub-note">
                </span>
                </p>
              </a>
            </li> 
           

            <li class="nav-item" >
              <a href="<?php echo e(url('admin/content_manager/index_slider')); ?>" class="nav-link">
                <i class="fas fa-laptop"></i>
                <p>Index Slider</p>
              </a>
              
            </li>


            <li class="nav-item">
              <a href="<?php echo e(url('admin/content_manager/edit_contents')); ?>" class="nav-link">
                <i class="fas fa-edit"></i> 
                <p>Site Contents</p>
              </a>
              
            </li>

            <li class="nav-item">
              <a href="<?php echo e(url('admin/content_manager/settings')); ?>" class="nav-link">
                <i class="fas fa-gear"></i> <span>Site Settings</span>    
              </a>
            </li> 
            
            <li class="nav-item">
              <a href="<?php echo e(url('admin/content_manager/mail_template')); ?>" class="nav-link">
                <i class="fas fa-envelope-square"></i> <span>Mail Template</span>    
              </a>
            </li>
            
          </ul>
        </li>


          

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-money"></i> 
              <p>
              Debts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('admin/create_debts')); ?>" class="nav-link">
                  <i class="fas fa-plus"></i> 
                  <p>
                  Create Record
                  </p> 
                </a>
              </li> 
            </ul>
          </li>
          <?php elseif(Auth::user()->user_type == "member"): ?>
          <li class="nav-item">
            <a href="<?php echo e(url('members/debts')); ?>" class="nav-link">
              <i class="fas fa-money"></i>
              <p>Debts
              <span class="label pull-right bg-red badge right" id="debt-note"></span>   
              </p>
            </a>
          </li> 
        <?php endif; ?>


        <?php if(Auth::user()->role ==1 ||  Auth::user()->user_type == "admin" || Auth::user()->user_type == "resort_owner" || Auth::user()->privilege == "resort_owner"): ?>
        <li class="nav-item">
          <a href="#" class="nav-link <?php echo e(request()->is('admin/user_manager*') ? 'active' : ''); ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Manager Users
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="<?php echo e(url('admin/user_manager/create_user')); ?>" class="nav-link"><i class="fas fa-plus"></i> Create User</a></li>   
            
            <?php if(Auth::user()->role ==1 ||  Auth::user()->user_type == "admin"): ?>
            <li class="nav-item"><a href="<?php echo e(url('admin/user_manager/resort_owners')); ?>" class="nav-link"><i class="fas fa-home"></i> Resort Owners</a></li>  
            <li class="nav-item"><a href="<?php echo e(url('admin/user_manager/boat_owners')); ?>" class="nav-link"><i class="fas fa-ship"></i> Boat Owners</a></li>    
            <li class="nav-item"><a href="<?php echo e(url('admin/user_manager/other_users')); ?>" class="nav-link"><i class="fas fa-users"></i> Other User</a></li>   
            <li class="nav-item"><a href="<?php echo e(url('admin/user_manager/admin_users')); ?>" class="nav-link"><i class="fas fa-user-secret"></i> Admin User</a></li>   
            <?php endif; ?>
            
           
            
          </ul>
        </li>
        <?php endif; ?>

        


        
            
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside><?php /**PATH C:\xampp\htdocs\beach_comber\resources\views/inc/dashboard-side-bar2.blade.php ENDPATH**/ ?>