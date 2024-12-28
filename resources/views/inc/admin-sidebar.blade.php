<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  @if ($settings->logo == null)
  <a href="{{url('')}}" class="brand-link">
    <span class="brand-text font-weight-light">{{$settings->site_name}}</span>
  </a>
  @else
  <a href="{{url('')}}" class="brand-link">
    <img src="{{ $settings->logo }}" alt="{{$settings->site_name}} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{$settings->site_name}}</span>
  </a>
  @endif
  

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if($myselfs->profile_img_url == null)
            <img src="{{asset('storage/img/users/default.png')}}" class="img-circle elevation-2" alt="{{Auth::user()->first_name}}">   
            @else
            <img src="{{ $myselfs->profile_img_url }}" class="img-circle elevation-2" alt="{{Auth::user()->first_name}}">  
            @endif
        
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->first_name}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        
             <li class="nav-item">
              
              <a class="nav-link {{ request()->is('auth/admin/dashboard*') ? 'active' : '' }}" href="{{ url('auth/admin/dashboard') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i> <span>Dashboard</span>
                  
                </a>  
              
              
            
          </li>
        
        @if ( Auth::user()->admin_account()->get()[0]->type == 1 || Auth::user()->admin_account()->privileges()->get()[0]->privilege == "Resorts" )
          
        
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('auth/admin/business/resorts*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Resort Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="{{ url('auth/admin/business/resorts') }}" class="nav-link"><i class="fas fa-plus"></i> Resort Features</a></li>   
            
      
          </ul>
        </li>
@endif


@if ( Auth::user()->admin_account()->get()[0]->type == 1 || Auth::user()->admin_account()->privileges()->get()[0]->privilege == "Boats" )  
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('auth/admin/business/boats*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-ship"></i>
            <p>
              Boat Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="{{ url('auth/admin/business/boats') }}" class="nav-link"><i class="fas fa-plus"></i> Create Boat</a></li>   
            
                 
            
          </ul>
        </li>
        
@endif

@if ( Auth::user()->admin_account()->get()[0]->type == 1 || Auth::user()->admin_account()->privileges()->get()[0]->privilege == "Services" )
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('auth/admin/business/services*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-server"></i>
            <p>
              Other Services
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="{{ url('auth/admin/business/services') }}" class="nav-link"><i class="fas fa-plus"></i> Create Service</a></li>   
                
            
          </ul>
        </li>
        

@endif


        
        
        <li class="nav-item">
          <a href="{{ url('admin/messages')}}" class="nav-link {{ request()->is('admin/messages*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Messages
              <span class="inbox-note right badge badge-danger" id="msg-note"></span>
            </p>
          </a>

        </li>

@if ( Auth::user()->admin_account()->get()[0]->type == 1 || Auth::user()->admin_account()->privileges()->get()[0]->privilege == "Stores" )       
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('admin/shop_manager*') ? 'active' : '' }}">
            <i class="nav-icon ion ion-bag"></i>
            <p>
              Store Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="{{ url('admin/shop_manager/create_shop_item') }}" class="nav-link"><i class="fas fa-plus"></i> Create Shop Item</a></li> 
            <li class="nav-item"><a href="{{ url('admin/shop_manager/my_order_list') }}" class="nav-link">
              <i class="fas fa-list-alt"></i> 
              <p>My Order List
              <span  class="badge badge-danger right" id="shop-order-note">
              10
              </span>
              </p>
            </a></li>    
            
            
            @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin")
            <li class="nav-item"><a href="{{ url('admin/shop_manager/all_order') }}" class="nav-link"><i class="fas fa-list-alt"></i> All Order</a></li> 
            <li class="nav-item"><a href="{{ url('admin/shop_manager/all_sales') }}" class="nav-link"><i class="fas fa-money"></i> All Sales</a></li> 

            @endif
           
            
          </ul>
        </li>
        

@endif
        
        
@if ( Auth::user()->admin_account()->get()[0]->type == 1 || Auth::user()->admin_account()->privileges()->get()[0]->privilege == "Contents" )       
        <li class="nav-item {{ request()->is('auth/admin/content_managment*') ? 'menu-is-opening menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('auth/admin/content_managment*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Content Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item">
              <a href="{{ url('/auth/admin/content_managment/news_letter')}}" class="nav-link {{ request()->is('auth/admin/content_managment/news_letter*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> 
                <p>Mail Subscribers   
                <span  class="label pull-right bg-green badge news-letter-note right" id="news-letter-sub-note">
                </span>
                </p>
              </a>
            </li> 
           

            <li class="nav-item" >
              <a href="{{ url('/auth/admin/content_managment/index_slider')}}" class="nav-link {{ request()->is('auth/admin/content_managment/index_slider*') ? 'active' : '' }}">
                <i class="fas fa-laptop"></i>
                <p>Landing page Slideshow</p>
              </a>
              
            </li>


            <li class="nav-item">
              <a href="{{ url('/auth/admin/content_managment/edit_contents')}}" class="nav-link {{ request()->is('auth/admin/content_managment/edit_contents*') ? 'active' : '' }}">
                <i class="fas fa-edit"></i> 
                <p>Feeds Contents</p>
              </a>
              
            </li>

            <li class="nav-item">
              <a href="{{ url('/auth/admin/content_managment/settings')}}" class="nav-link {{ request()->is('auth/admin/content_managment/settings*') ? 'active' : '' }}">
                <i class="fas fa-gear"></i> <span>Site Settings</span>    
              </a>
            </li> 
            
            <li class="nav-item">
              <a href="{{ url('/auth/admin/content_managment/mail_template')}}" class="nav-link {{ request()->is('auth/admin/content_managment/mail_template*') ? 'active' : '' }}">
                <i class="fas fa-envelope-square"></i> <span>Mail Template</span>    
              </a>
            </li>
            
          </ul>
        </li>

@endif
          

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
                <a href="{{ url('admin/create_debts')}}" class="nav-link">
                  <i class="fas fa-plus"></i> 
                  <p>
                  Create Record
                  </p> 
                </a>
              </li> 
            </ul>
          </li>
          

@if ( Auth::user()->admin_account()->get()[0]->type == 1 || Auth::user()->admin_account()->privileges()->get()[0]->privilege == "Admin" )
        
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('admin/user_manager*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Manager Users
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="{{ url('admin/user_manager/create_user') }}" class="nav-link"><i class="fas fa-plus"></i> Create User</a></li>   
            
            
             
            <li class="nav-item"><a href="{{ url('admin/user_manager/other_users') }}" class="nav-link"><i class="fas fa-users"></i> Other User</a></li>   
            
            
            
           
            
          </ul>
        </li>
        

   @endif     


        
            
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>