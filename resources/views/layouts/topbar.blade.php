<nav class="navbar navbar-expand bg-white topbar shadow-sm fixed-top"
    style="left: 240px; right: 0; height: 60px; z-index: 1000; border-bottom: 1px solid #e3e6f0;">
    <div class="container-fluid d-flex justify-content-end align-items-center px-4">

        <!-- Bagian Admin di Sebelah Kanan -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="small fw-semibold me-2">Admin</span>
                <img src="{{ asset('img/undraw_profile.svg') }}" alt="Profile" class="rounded-circle border"
                    style="width: 36px; height: 36px; object-fit: cover;">
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fa-solid fa-user me-2 text-secondary"></i>Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fa-solid fa-gear me-2 text-secondary"></i>Settings
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa-solid fa-right-from-bracket me-2 text-secondary"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
