<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="{{ asset('storage/img/site_logo/'.$settings[0]->logo) }}" alt="{{$settings[0]->site_name}} Logo" height="60" width="60">
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
        @if(Auth::user()->img == null)
        <img src="{{asset('storage/img/users/default.png')}}" class="user-image" alt="{{Auth::user()->name}}">   
        @else
        <img src="{{asset('storage/img/users/'.Auth::user()->id.'/profile/'.Auth::user()->img)}}" class="user-image" alt="{{Auth::user()->name}}">  
        @endif
        
        <span class="hidden-xs">{{Auth::user()->name}}</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          @if(Auth::user()->img == null)
        <img src="{{asset('storage/img/users/default.png')}}" class="img-circle" alt="{{Auth::user()->name}}">   
        @else
        <img src="{{asset('storage/img/users/'.Auth::user()->id.'/profile/'.Auth::user()->img)}}" class="img-circle" alt="{{Auth::user()->name}}">  
        @endif
          

          <p>
           {{Auth::user()->name}}
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
            <a href="{{ url('users/profile/'.Auth::user()->id) }}" class="btn btn-default btn-flat">Profile</a>
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





