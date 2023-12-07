<li class="nav-item" id="menu_setting">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-cogs"></i>
        <p>
            User Setting
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{route('user.list')}}" class="nav-link" id="menu_user">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('role.index')}}" class="nav-link" id="menu_role">
                <i class="far fa-circle nav-icon"></i>
                <p>Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('permission.index')}}" class="nav-link" id="menu_permission">
                <i class="far fa-circle nav-icon"></i>
                <p>Permission (Dev Only)</p>
            </a>
        </li>
    </ul>
</li>