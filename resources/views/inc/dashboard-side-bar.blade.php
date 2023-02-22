 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            @if($myselfs[0]->img == null)
            <img src="{{asset('storage/img/users/default.png')}}" class="img-circle" alt="{{$myselfs[0]->name}}">   
            @else
            <img src="{{asset('storage/img/users/'.Auth::user()->id.'/profile/'.$myselfs[0]->img)}}" class="img-circle" alt="{{$myselfs[0]->name}}">  
            @endif
        </div>
        <div class="pull-left info">
          <p>{{$myselfs[0]->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
        <li class="active">
            @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin")
            <a href="{{ url('admin_dashboard/'.Auth::user()->id) }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                
              </a>  
            @else
            <a href="{{ url('member_dashboard/'.Auth::user()->id) }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                
              </a>    
            @endif
          
        </li>
        
        
        


        <li class="treeview">
            <a href="#">
              <i class="fa fa-home"></i> <span>Resorts</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
                @if (Auth::user()->role ==1 ||  Auth::user()->user_type == "admin" || Auth::user()->user_type == "resort_owner")
                <li><a href="{{ url('admin/create_resort') }}"><i class="fa fa-plus"></i> Create Resort</a></li>   
                @endif
              @foreach ($resorts as $resort)
              
              @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin" || $resort->created_by == Auth::user()->id)
              <li class="treeview">
                <a href="{{ url('admin/resort/'.$resort->id) }}"><i class="fa fa-home"></i> {{ $resort->name}}
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ url('admin/create_room/'.$resort->id) }}"><i class="fa fa-hotel"></i> Create room</a></li>
                
                </ul>
              </li>  
              @else
              
              @endif

              @endforeach
              
            </ul>
          </li>
        
          <li>
            <a href="{{ url('admin/messages')}}">
              <i class="fa fa-envelope-o"></i> <span>Messages</span>   
              <span class="pull-right-container">
                <small class="label pull-right bg-red inbox-note" id="msg-note"></small>
              </span> 
            </a>
          </li> 
      
          @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin")
          
          <li>
            <a href="{{ url('admin/news_letter')}}">
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
                <a href="{{ url('admin/create_debts')}}">
                  <i class="fa fa-plus"></i> <span>Create Record</span> 
                </a>
              </li> 
            </ul>
          </li>
          @elseif(Auth::user()->user_type == "member")
          <li>
            <a href="{{ url('members/debts')}}">
              <i class="fa fa-money"></i> <span>Debts</span> 
              <span class="pull-right-container">
                <small class="label pull-right bg-red" id="debt-note"></small>
              </span>   
            </a>
          </li> 
        @endif

        
        @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin")
        
        <li>
          <a href="{{ url('admin/create_store')}}">
            <i class="ion ion-bag"></i>
            <span>Store</span>
          </a>
          
        </li>

        <li>
          <a href="{{ url('admin/index_slider')}}">
            <i class="fa fa-laptop"></i>
            <span>Index Slider</span>
          </a>
          
        </li>

        @endif

        @if(Auth::user()->user_type == "admin")
        <li>
            <a href="{{ url('admin/services')}}">
              <i class="fa fa-server"></i>
              <span>Services</span>
            </a>
            
          </li>

        @endif

        @if (Auth::user()->user_type == "boat_owner" || Auth::user()->user_type == "yacht_owner")
        
        <li>
          <a href="{{ url('admin/boat_services')}}">
            <i class="fa fa-ship"></i>
            <span>Boat Services</span>
          </a>
          
        </li>

        @endif

        @if (Auth::user()->role == 1 || Auth::user()->user_type == "admin")
        <li>
            <a href="{{ url('admin/edit_contents')}}">
              <i class="fa fa-edit"></i> <span>Contents</span>
              
            </a>
            
          </li>

        @endif


        @if (Auth::user()->role == 1)
        <li>
            <a href="{{ url('admin/users')}}">
              <i class="fa fa-users"></i> <span>Users</span>    
            </a>
          </li>  
        <li>
            <a href="{{ url('admin/settings')}}">
              <i class="fa fa-gear"></i> <span>Settings</span>    
            </a>
          </li>  
        @endif
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>