<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->getAvatarUrl() }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->fullname }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li class="treeview @if (\Request::is('user/*')) menu-open @endif">
                <a href="{{ route('user.index') }}">
                    <i class="fa fa-user"></i> <span>Users</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu @if (\Request::is('user/*')) block-class @endif">
                    <li @if (\Route::currentRouteNamed('user.index')) class="active" @endif>
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách user
                        </a>
                    </li>
                    <li @if (\Route::currentRouteNamed('user.getCreate')) class="active" @endif>
                        <a href="{{ route('user.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm user </a>
                    </li>
                </ul>
            </li>

            <li class="treeview @if (\Request::is('role/*')) menu-open @endif">
                <a href="{{ route('role.index') }}">
                    <i class="fa fa-hourglass-half"></i> <span>Roles</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu @if (\Request::is('role/*')) block-class @endif">
                    <li @if (\Route::currentRouteNamed('organization.index')) class="active" @endif>
                        <a href="{{ route('role.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách role
                        </a>
                    </li>
                    <li @if (\Route::currentRouteNamed('role.getCreate')) class="active" @endif>
                        <a href="{{ route('role.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm role </a>
                    </li>
                </ul>
            </li>

            <li class="treeview @if (\Request::is('organization/*')) menu-open @endif">
                <a href="{{ route('organization.index') }}">
                    <i class="fa fa-university"></i> <span>Doanh nghiệp</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu @if (\Request::is('organization/*')) block-class @endif">
                    <li @if (\Route::currentRouteNamed('organization.index')) class="active" @endif>
                        <a href="{{ route('organization.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách doanh nghiệp
                        </a>
                    </li>
                    <li @if (\Route::currentRouteNamed('organization.getCreate')) class="active" @endif>
                        <a href="{{ route('organization.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm doanh nghiệp</a>
                    </li>
                </ul>
            </li>

            <li class="treeview @if (\Request::is('employee/*')) menu-open @endif">
                <a href="{{ route('employee.index') }}">
                    <i class="fa fa-users"></i> <span>Nhân viên</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu @if (\Request::is('employee/*')) block-class @endif">
                    <li @if (\Route::currentRouteNamed('employee.index')) class="active" @endif>
                        <a href="{{ route('employee.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách nhân viên
                        </a>
                    </li>
                    <li @if (\Route::currentRouteNamed('employee.getCreate')) class="active" @endif>
                        <a href="{{ route('employee.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm mới nhân viên </a>
                    </li>
                </ul>
            </li>

            <li class="treeview @if (\Request::is('table/*')) menu-open @endif">
                <a href="{{ route('table.index') }}">
                    <i class="fa fa-table"></i> <span>Vị trí bàn</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu @if (\Request::is('table/*')) block-class @endif">
                    <li @if (\Route::currentRouteNamed('table.index')) class="active" @endif>
                        <a href="{{ route('table.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách bàn
                        </a>
                    </li>
                    <li @if (\Route::currentRouteNamed('table.getCreate')) class="active" @endif>
                        <a href="{{ route('table.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm bàn </a>
                    </li>
                </ul>
            </li>

            <li class="treeview @if (\Request::is('button/*')) menu-open @endif">
                <a href="{{ route('button.index') }}">
                    <i class="fa fa-hand-o-up"></i> <span>DS nút bấm</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu @if (\Request::is('button/*')) block-class @endif">
                    <li @if (\Route::currentRouteNamed('button.index')) class="active" @endif>
                        <a href="{{ route('button.index') }}">
                            <i class="fa fa-circle-o"></i> Danh sách nút
                        </a>
                    </li>
                    <li @if (\Route::currentRouteNamed('button.getCreate')) class="active" @endif>
                        <a href="{{ route('button.getCreate') }}">
                        <i class="fa fa-circle-o"></i> Thêm nút </a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>