<nav class="navbar navbar-expand navbar-light bg-white shadow-sm fixed-top"
    style="margin-left: 240px; height: 60px; border-bottom: 1px solid #e3e6f0; z-index: 1030;">

    <div class="container-fluid d-flex justify-content-between align-items-center">

        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
            <i class="fa fa-bars"></i>
        </button>

        <h5 class="fw-bold text-light mb-0">🐄 Ternak Track Dashboard</h5>
        <ul class="navbar-nav align-items-center">

            <div class="topbar-divider d-none d-sm-block mx-3"></div>

            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-none d-lg-inline text-gray-600 small fw-semibold me-2">Admin</span>
                    <img class="img-profile rounded-circle border" src="{{ asset('img/undraw_profile.svg') }}"
                        alt="Profile" width="35" height="35">
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw text-gray-400 me-2"></i> Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw text-gray-400 me-2"></i> Settings
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw text-gray-400 me-2"></i> Activity Log
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="#" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400 me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
