<nav id="sidebarMenu" class="sidebar">
    <ul class="nav flex-column text-start">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? 'fw-bold' : '' }}" href="/dashboard">
                <i class="bi bi-speedometer2 me-0"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('growth-records') ? 'fw-bold' : '' }}" href="/growth-records">
                <i class="bi bi-graph-up me-0"></i> Growth Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('health-records') ? 'fw-bold' : '' }}" href="/health-records">
                <i class="bi bi-journal-medical me-0"></i> Health Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('vaccination') ? 'fw-bold' : '' }}" href="/vaccination">
                <i class="bi bi-syringe me-0"></i> Vaccination
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('feeding-records') ? 'fw-bold' : '' }}" href="/feeding-records">
                <i class="bi bi-egg-fried me-0"></i> Feeding Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('breeding') ? 'fw-bold' : '' }}" href="/breeding">
                <i class="bi bi-people me-0"></i> Breeding
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('off-springs') ? 'fw-bold' : '' }}" href="/off-springs">
                <i class="bi bi-baby me-0"></i> Off Springs
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('sales') ? 'fw-bold' : '' }}" href="/sales">
                <i class="bi bi-currency-dollar me-0"></i> Sales
            </a>
        </li>

        <h6 class="sidebar-heading mt-4 mb-1 text-dark fw-bold">
            Farm Management
        </h6>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('farms') ? 'fw-bold' : '' }}" href="/farms">
                <i class="bi bi-tractor me-0"></i> Farms
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('cages') ? 'fw-bold' : '' }}" href="/cages">
                <i class="bi bi-grid-3x3-gap me-0"></i> Cages
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('animals') ? 'fw-bold' : '' }}" href="/animals">
                <i class="bi bi-cow me-0"></i> Animals
            </a>
        </li>

        <h6 class="sidebar-heading mt-4 mb-1 text-dark fw-bold">
            General Settings
        </h6>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('users') ? 'fw-bold' : '' }}" href="/users">
                <i class="bi bi-people me-0"></i> Users
            </a>
        </li>
    </ul>
</nav>
