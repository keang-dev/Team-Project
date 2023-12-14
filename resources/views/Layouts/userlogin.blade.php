<ul class="navbar-nav" ml-auto>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link text-black" data-toggle="dropdown">
            <img src="{{asset('icon/user.png')}}" alt="" width="27" width="25"
                class="brand-image img-circle elevation-3 mr-1">
            {{Auth::user()->name}} <i class="right fa fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="#" class="dropdown-item">
                <div class="">
                    <input type="checkbox" @click="handleDarkmode()" value="1" class="mr-1" /><span>Dark Mode</span>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fa fa-user text-info mr-2"></i>ព័ត៌មានផ្ទាល់ខ្លួន
            </a>
            <a href="{{route('user.logout')}}" class="dropdown-item">
                <i class="fa fa-sign-out-alt text-danger mr-2"></i> ចាកចេញ
            </a>
        </div>
    </li>
</ul>