<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo"><b>Admin</b>LTE</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            @if(Auth::check())
                <li class="user user-menu">
                    <a class="btn"><span class="hidden-xs">Logged in as {{ ucfirst(Auth::user()->name)}}</span></a>
                </li>
                <li class="user user-menu">
                    <a href="{{URL::to('logout')}}" class="btn"><span>Sign out</span></a>
                </li>
            @else
                <li class="user user-menu">
                    <a href="{{URL::to('auth/login')}} col-xs-4 text-center"><span>Login</span></a>
                </li>
            @endif
            </ul>
        </div>
    </nav>
</header>