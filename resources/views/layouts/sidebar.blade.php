<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion position-fixed top-0 start-0 vh-100"
    id="accordionSidebar" style="width: 240px; overflow-y: auto;">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-start px-3 py-4">
        <div class="sidebar-brand-text fw-bold text-left" style="color: white; font-size: 1.5rem;">
            🐄 Ternak Track
        </div>
    </div>

    <!-- Dashboard -->
    <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/dashboard') }}">
            <i class="fas fa-tachometer-alt fa-fw me-2"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Features Section -->
    <div class="sidebar-heading text-white-50 ps-4 mt-2 mb-1">Features</div>

    <li class="nav-item {{ Request::is('growth-records*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/growth-records') }}">
            <i class="fas fa-chart-line fa-fw me-2"></i>
            <span>Growth Records</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('health-records*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/health-records') }}">
            <i class="fas fa-notes-medical fa-fw me-2"></i>
            <span>Health Records</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('vaccinations*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/vaccinations') }}">
            <i class="fas fa-syringe fa-fw me-2"></i>
            <span>Vaccination</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('feeding-records*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/feeding-records') }}">
            <i class="fas fa-utensils fa-fw me-2"></i>
            <span>Feeding Records</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('breeding*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/breeding') }}">
            <i class="fas fa-heart fa-fw me-2"></i>
            <span>Breeding</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('offsprings*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/offsprings') }}">
            <i class="fas fa-baby fa-fw me-2"></i>
            <span>Off Springs</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('sales*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/sales') }}">
            <i class="fas fa-dollar-sign fa-fw me-2"></i>
            <span>Sales</span>
        </a>
    </li>

    <!-- Farm Management Section -->
    <div class="sidebar-heading text-white-50 ps-4 mt-3 mb-1">Farm Management</div>

    <li class="nav-item {{ Request::is('farms*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/farms') }}">
            <i class="fas fa-tractor fa-fw me-2"></i>
            <span>Farms</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('cages*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/cages') }}">
            <i class="fas fa-layer-group fa-fw me-2"></i>
            <span>Cages</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('animals*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/animals') }}">
            <i class="fas fa-paw fa-fw me-2"></i>
            <span>Animals</span>
        </a>
    </li>

    <!-- General Settings Section -->
    <div class="sidebar-heading text-white-50 ps-4 mt-3 mb-1">General Settings</div>

    <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center py-2 ps-4" href="{{ url('/users') }}">
            <i class="fas fa-user-cog fa-fw me-2"></i>
            <span>Users</span>
        </a>
    </li>
</ul>