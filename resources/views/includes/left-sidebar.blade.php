<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->fullname }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li class="active treeview">
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-user"></i> <span>Users</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách user
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm user </a>
                    </li>
                </ul>
            </li>

            <li class="active treeview">
                <a href="{{ route('role.index') }}">
                    <i class="fa fa-user"></i> <span>Roles</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    <li>
                    <a href="{{ route('role.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách role
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('role.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm role </a>
                    </li>
                </ul>
            </li>

            <li class="active treeview">
                <a href="{{ route('organization.index') }}">
                    <i class="fa fa-university"></i> <span>Doanh nghiệp</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    <li>
                        <a href="{{ route('organization.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách doanh nghiệp
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('organization.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm doanh nghiệp</a>
                    </li>
                </ul>
            </li>

            <li class="active treeview">
                <a href="{{ route('employee.index') }}">
                    <i class="fa fa-users"></i> <span>Nhân viên</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    <li>
                        <a href="{{ route('employee.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách nhân viên
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employee.create') }}">
                        <i class="fa fa-circle-o"></i> Thêm mới nhân viên </a>
                    </li>
                </ul>
            </li>


            <li class="active treeview">
                <a href="{{ route('employee.index') }}">
                    <i class="fa fa-table"></i> <span>Vị trí bàn</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    <li>
                        <a href="{{ route('employee.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách bàn
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employee.create') }}">
                        <i class="fa fa-circle-o"></i> Thêm bàn </a>
                    </li>
                </ul>
            </li>

            <li class="active treeview">
                <a href="{{ route('employee.index') }}">
                    <i class="fa fa-hand-o-up"></i> <span>DS nút bấm</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">
                    <li>
                        <a href="{{ route('employee.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách nút
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employee.create') }}">
                        <i class="fa fa-circle-o"></i> Thêm nút </a>
                    </li>
                </ul>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>