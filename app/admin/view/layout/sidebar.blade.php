<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-sm">
        <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{session('avatar_url')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{session('user_name')}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-legacy nav-compact" data-widget="treeview" role="menu" data-accordion="false">

                @foreach($menus as $menu)
                    {{--<li class="nav-item has-treeview menu-open">--}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>{{$menu['name']}}<i class="right fas fa-angle-left"></i></p>
                        </a>
                        @foreach($menu['child'] as $child)
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{$child['path']}}" class="nav-link" target="mainiframe">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{$child['name']}}</p>
                                    </a>
                                </li>
                            </ul>
                        @endforeach
                    </li>
                @endforeach

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>