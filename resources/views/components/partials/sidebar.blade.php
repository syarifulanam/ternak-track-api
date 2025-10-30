<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-paw"></i>
        </div>
        <div class="sidebar-brand-text mx-2">
            <span class="font-weight-bold text-uppercase">Ternak</span>
            <span class="text-light">Track</span>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-tachometer-alt fa-fw"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Daily</div>

    <li class="nav-item {{ Request::is('growths*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/growths') }}">
            <i class="fas fa-chart-line fa-fw"></i>
            <span>Growth</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('healths*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/healths') }}">
            <i class="fas fa-heartbeat fa-fw"></i>
            <span>Health</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('vaccinations*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/vaccinations') }}">
            <i class="fas fa-syringe fa-fw"></i>
            <span>Vaccinations</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('feedings*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/feedings') }}">
            <i class="fas fa-utensils fa-fw"></i>
            <span>Feeding</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('breedings*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/breedings') }}">
            <i class="fas fa-venus-mars fa-fw"></i>
            <span>Breeding</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('offsprings*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/offsprings') }}">
            <i class="fas fa-baby fa-fw"></i>
            <span>Offsprings</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sales*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/sales') }}">
            <i class="fas fa-shopping-cart fa-fw"></i>
            <span>Sales</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Master Data</div>

    <li class="nav-item {{ Request::is('farms*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/farms') }}">
            <i class="fas fa-tractor fa-fw"></i>
            <span>Farms</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('cages*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/cages') }}">
            <i class="fas fa-th-large fa-fw"></i>
            <span>Cages</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('animals*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/animals') }}">
            <i class="fas fa-drumstick-bite fa-fw"></i>
            <span>Animals</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
