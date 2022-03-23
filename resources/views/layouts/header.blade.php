<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header border-right">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <a class="navbar-brand" href>
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->

                    <!-- Light Logo icon -->
                    <img src="{{ asset('img/logo.png') }}" alt="homepage" style="width: 60px; height: 60px;" class="dark-logo">
                    <img src="{{ asset('img/logo.png') }}" alt="homepage" style="width: 60px; height: 60px;" class="light-logo">
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text" style="font-family: sans-serif; font-weight: bold;">
                    &nbsp; Pasar Blahkiuh
                </span>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown mega-dropdown">
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="ml-2 font-medium">{{ auth('web')->check() ? auth('web')->user()->nama : auth('pedagang')->user()->nama }}</span><span class="fas fa-angle-down ml-2"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                            <div class="ml-2">
                                <h4 class="mb-0">{{ auth('web')->check() ? auth('web')->user()->nama : auth('pedagang')->user()->nama }}</h4>
                                <p class=" mb-0 text-muted">{{ auth('web')->check() ? auth('web')->user()->email : auth('pedagang')->user()->email }}</p>
                                <a href="{{ auth('web')->check() ? route('admin.biodata.index') : route('pedagang.biodata.index') }}" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ auth('web')->check() ? route('admin.biodata.index') : route('pedagang.biodata.index') }}"><i class="ti-user mr-1 ml-1"></i> My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="document.getElementById('logout-form').submit()"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                    </div>
                </li>
                <form action="{{ route('logout') }}" id="logout-form" method="post">@csrf</form>
            </ul>
        </div>
    </nav>
</header>
