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
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>仪表盘<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/auth/index/dashboard" class="nav-link" target="mainiframe">
                                <i class="far fa-circle nav-icon"></i>
                                <p>首页</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>系统配置<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sys/user/index" class="nav-link" target="mainiframe">
                                <i class="far fa-circle nav-icon"></i>
                                <p>用户</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/auth/role/index" class="nav-link" target="mainiframe">
                                <i class="far fa-circle nav-icon"></i>
                                <p>角色</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/auth/permission/index" class="nav-link" target="mainiframe">
                                <i class="far fa-circle nav-icon"></i>
                                <p>权限</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/auth/menu/index" class="nav-link" target="mainiframe">
                                <i class="far fa-circle nav-icon"></i>
                                <p>菜单</p>
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