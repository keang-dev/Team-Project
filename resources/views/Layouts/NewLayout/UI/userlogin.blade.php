<ul class="navbar-nav" ml-auto>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link text-black" data-toggle="dropdown">
            <img src="{{asset('img/logo.png')}}" alt="" width="27" width="25"
                class="brand-image img-circle elevation-3 mr-1">
            {{Auth::user()->name}} <i class="right fa fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="" class="dropdown-item">
                <i class="fa fa-user text-info mr-2"></i> Profile
            </a>
            <a href="{{route('user.logout')}}" class="dropdown-item">
                <i class="fa fa-sign-out-alt text-danger mr-2"></i> Logout
            </a>
        </div>
    </li>
</ul>