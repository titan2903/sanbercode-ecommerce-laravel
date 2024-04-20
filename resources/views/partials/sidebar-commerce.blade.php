<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('/admin-templates/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            @auth
            <a href="/profile" class="d-block">{{ Auth::user()->name }}</a>
            @endauth
            @guest
            <a href="#" class="d-block">Not Login</a>
            @endguest
        </div>
    </div>

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
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="/products" class="nav-link">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        Products
                    </p>
                </a>
            </li>

            @auth
            <li class="nav-item">
                <a href="/carts" class="nav-link">
                    <i class="nav-icon fa fa-shopping-cart"></i>
                    <p>
                        Carts
                    </p>
                </a>
            </li>
            @endauth

            @auth
            <li class="nav-item">
                <a href="/orders" class="nav-link">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>
                        Orders
                    </p>
                </a>
            </li>
            @endauth

            @auth
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
            @endauth

            @guest
            <li class="nav-item">
                <a href="/login" class="nav-link">
                    <i class="nav-icon fas fa-sign-in-alt"></i>
                    <p>
                        Login
                    </p>
                </a>
            </li>
            @endguest

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>