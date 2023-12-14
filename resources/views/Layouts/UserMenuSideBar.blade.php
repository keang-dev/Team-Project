<li class="nav-item" id="menu_setting">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cogs text-danger"></i>
        <p>
            {{__('t.User Setting')}}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview ml-2">

        <li class="nav-item">
            <a href="{{route('user.list')}}" class="nav-link" id="menu_user">
                <i class="fa fa-users nav-icon text-success"></i>
                <p>{{__('t.Users')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('role.index')}}" class="nav-link" id="menu_role">
                <img src="{{asset('icon/key.svg')}}" width="13" width="12">
                <p class="ml-3">{{__('t.Role')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('permission.index')}}" class="nav-link" id="menu_permission">
                <i class="fa fa-key nav-icon text-yellow"></i>
                <p>{{__('t.Permission (Dev Only)')}}</p>
            </a>
        </li>
    </ul>
</li>