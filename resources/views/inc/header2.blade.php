<div class="preloader flex-column justify-content-center align-items-center">
  @if ($settings->logo != null)
  <img class="animation__shake" src="{{ $settings->icon }}" alt="{{$settings->site_name}} Logo" height="60" width="60">
  @endif
  
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    
  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    

    
    <!-- Notifications Dropdown Menu -->

    


    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge note-counter"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right load-note-bar">
        
      </div>
    </li>

    



     <!-- User Account: style can be found in dropdown.less -->
     <li class="nav-item dropdown user user-menu">
      <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        @if(Auth::user() && $myselfs->profile_img_url == null)
        <img src="{{asset('storage/img/users/default.png')}}" class="user-image" alt="{{$myselfs->first_name}}">   
        @else
        <img src="{{$myselfs->profile_img_url}}" class="user-image" alt="{{$myselfs->first_name}}">  
        @endif
        
        <span class="hidden-xs">{{$myselfs->first_name}}</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          @if($myselfs->profile_img_url == null)
        <img src="{{asset('storage/img/users/default.png')}}" class="img-circle" alt="{{$myselfs->first_name}}">   
        @else
        <img src="{{$myselfs->profile_img_url}}" class="img-circle" alt="{{$myselfs->first_name}}">  
        @endif
          

          <p>
           {{$myselfs->first_name}}
           <small>Joined: {{Auth::user()->created_at}}</small>
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
          <div class="float-left">
            @if(Auth::user()->user_type == "Admin")
            <a href="{{ url('auth/admin/profile/'.Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
          @elseif(Auth::user()->user_type == "Business")
          <a href="{{ url('auth/business/profile/'.Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
          @elseif(Auth::user()->user_type == "Customer")
          <a href="{{ url('auth/customer/profile/'.Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
          @endif
          </div>
          <div class="float-right">
            <a href="{{ route('logout') }}" class="btn btn-default btn-flat" 
              onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </li>
      </ul>
    </li>



    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
   
  </ul>
</nav>
<!-- /.navbar -->





