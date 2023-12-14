<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
            <div class="sidebar-search-results">
                <div class="list-group"><a href="#" class="list-group-item">
                        <div class="search-title"><strong class="text-light"></strong>N<strong
                                class="text-light"></strong>o<strong class="text-light"></strong> <strong
                                class="text-light"></strong>e<strong class="text-light"></strong>l<strong
                                class="text-light"></strong>e<strong class="text-light"></strong>m<strong
                                class="text-light"></strong>e<strong class="text-light"></strong>n<strong
                                class="text-light"></strong>t<strong class="text-light"></strong> <strong
                                class="text-light"></strong>f<strong class="text-light"></strong>o<strong
                                class="text-light"></strong>u<strong class="text-light"></strong>n<strong
                                class="text-light"></strong>d<strong class="text-light"></strong>!<strong
                                class="text-light"></strong></div>
                        <div class="search-path"></div>
                    </a></div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link" id="menu_dashboard">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            {{__('t.Dashboard')}}
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                @include('layouts.TableMenuSideBar')
                @include('layouts.UserMenuSideBar')
                <li class="nav-item" id="menu_translate">
                    <a href="#" class="nav-link">
                        <img src="{{asset('icon/kh.png')}}" alt="" width="27" width="25"
                            class="brand-image img-circle elevation-3 mr-1">
                        <p>
                            {{__('t.Translate')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="{{route('language.greeting_create_en')}}" class="nav-link" id="menu_greeting_en">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Greeting En</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{route('language.greeting_kh')}}" class="nav-link" id="menu_greeting_en">
                                <img src="{{asset('icon/kh.png')}}" alt="" width="27" width="25"
                                    class="brand-image img-circle elevation-3 mr-1">
                                <p>{{__('t.Translate to khmer')}}</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>