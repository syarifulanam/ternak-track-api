        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Ternak track</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Daily
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ request()->routeIs('growth.*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-line"></i>
                    <span>Growth Records</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('health.*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-heartbeat"></i>
                    <span>Health Records</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('vaccinations.*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-syringe"></i>
                    <span>Vaccinations</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('feeding.*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-utensils"></i>
                    <span>Feeding Records</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('breeding.*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-venus-mars"></i>
                    <span>Breeding</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('offsprings.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('offsprings.index') }}">
                    <i class="fas fa-baby"></i>
                    <span>Offsprings</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('sales.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('sales.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Sales</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ request()->routeIs('farms.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('web.farms.index') }}">
                    <i class="fas fa-tractor"></i>
                    <span>Farms</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('cages.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('web.cages.index') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Cages</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('animals.*') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-drumstick-bite"></i>
                    <span>Animals</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
