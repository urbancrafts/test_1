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
        
             <li class="nav-item menu-open">
              @if (Auth::user()->user_type == "Admin")
              <a class="nav-link {{ request()->is('auth/admin/dashboard*') ? 'active' : '' }}" href="{{ url('auth/admin/dashboard') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i> <span>Dashboard</span>
                  
                </a>  
              @elseif(Auth::user()->user_type == "Business")
              <a class="nav-link {{ request()->is('auth/business/dashboard*') ? 'active' : '' }}" href="{{ url('auth/business/dashboard') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i> <span>Dashboard</span>
                  
                </a>
              @elseif(Auth::user()->user_type == "Customer")
              
              <a class="nav-link {{ request()->is('auth/customer/dashboard*') ? 'active' : '' }}" href="{{ url('auth/customer/dashboard') }}">
                <i class="nav-icon fas fa-tachometer-alt"></i> <span>Dashboard</span>
                  
                </a>

              @endif
            
          </li>
        
          @foreach ($businesses as $business)

          @if ($business->business_category == "Resort")
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('auth/business/resorts*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Resort Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="{{ url('auth/business/resorts') }}" class="nav-link"><i class="fas fa-plus"></i> Create Resort</a></li>   
            
      
          </ul>
        </li>


        @endif


        @if ($business->business_category == "Boat")
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('auth/business/boats*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-ship"></i>
            <p>
              Boat Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="{{ url('auth/business/boats') }}" class="nav-link"><i class="fas fa-plus"></i> Create Boat</a></li>   
            
                 
            
          </ul>
        </li>
        @endif

        @if ($business->business_category == "Other Services")
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('auth/business/services*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-server"></i>
            <p>
              Other Services
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item"><a href="{{ url('auth/business/services') }}" class="nav-link"><i class="fas fa-plus"></i> Create Service</a></li>   
            
            
            
           
            
          </ul>
        </li>
        @endif

        @endforeach


        


        
        
        <li class="nav-item">
          <a href="{{ url('admin/messages')}}" class="nav-link {{ request()->is('admin/messages*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Messages
              <span class="inbox-note right badge badge-danger" id="msg-note"></span>
            </p>
          </a>

        </li>


        
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('admin/shop_manager*') ? 'active' : '' }}">
            <i class="nav-icon ion ion-bag"></i>
            <p>
              Shop Manager
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
        


        @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin")
        
        
        <li class="nav-item">
          <a href="#" class="nav-link {{ request()->is('admin/content_manager*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Content Manager
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
           
            <li class="nav-item">
              <a href="{{ url('admin/content_manager/news_letter')}}" class="nav-link">
                <i class="fas fa-newspaper"></i> 
                <p>News Letter Subs   
                <span  class="label pull-right bg-green badge news-letter-note right" id="news-letter-sub-note">
                </span>
                </p>
              </a>
            </li> 
           

            <li class="nav-item" >
              <a href="{{ url('admin/content_manager/index_slider')}}" class="nav-link">
                <i class="fas fa-laptop"></i>
                <p>Index Slider</p>
              </a>
              
            </li>


            <li class="nav-item">
              <a href="{{ url('admin/content_manager/edit_contents')}}" class="nav-link">
                <i class="fas fa-edit"></i> 
                <p>Site Contents</p>
              </a>
              
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/content_manager/settings')}}" class="nav-link">
                <i class="fas fa-gear"></i> <span>Site Settings</span>    
              </a>
            </li> 
            
            <li class="nav-item">
              <a href="{{ url('admin/content_manager/mail_template')}}" class="nav-link">
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
                <a href="{{ url('admin/create_debts')}}" class="nav-link">
                  <i class="fas fa-plus"></i> 
                  <p>
                  Create Record
                  </p> 
                </a>
              </li> 
            </ul>
          </li>
          @elseif(Auth::user()->user_type == "member")
          <li class="nav-item">
            <a href="{{ url('members/debts')}}" class="nav-link">
              <i class="fas fa-money"></i>
              <p>Debts
              <span class="label pull-right bg-red badge right" id="debt-note"></span>   
              </p>
            </a>
          </li> 
        @endif


        @if (Auth::user()->role ==1 ||  Auth::user()->user_type == "admin" || Auth::user()->user_type == "resort_owner" || Auth::user()->privilege == "resort_owner")
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
            
            @if(Auth::user()->role ==1 ||  Auth::user()->user_type == "admin")
            <li class="nav-item"><a href="{{ url('admin/user_manager/resort_owners') }}" class="nav-link"><i class="fas fa-home"></i> Resort Owners</a></li>  
            <li class="nav-item"><a href="{{ url('admin/user_manager/boat_owners') }}" class="nav-link"><i class="fas fa-ship"></i> Boat Owners</a></li>    
            <li class="nav-item"><a href="{{ url('admin/user_manager/other_users') }}" class="nav-link"><i class="fas fa-users"></i> Other User</a></li>   
            <li class="nav-item"><a href="{{ url('admin/user_manager/admin_users') }}" class="nav-link"><i class="fas fa-user-secret"></i> Admin User</a></li>   
            @endif
            
           
            
          </ul>
        </li>
        @endif

        


        
            
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>