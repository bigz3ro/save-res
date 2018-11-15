<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini"><b>E</b></span>
        <span class="logo-lg"><b>E-Product</b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth::check() ? Auth::user()->getAvatarUrl() : null }}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{ Auth::check() ? Auth::user()->getAvatarUrl() : null }}</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="user-footer">
                          <a href="{{ route('logout') }}"><span class="fa fa-sign-out"></span>Đăng xuất</a>
                      </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>