<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
            </div>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <button class="btn btn-sm btn-white rounded-circle shadow-inset border-light">
                                <span class="fas fa-user"></span>
                            </button>
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small fw-bold text-gray-900">
                                    <?php
                                    if (isset($_SESSION['name']))
                                        echo $_SESSION['name'];

                                    else
                                        echo "User";

                                    ?>
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                        <a class="dropdown-item d-flex align-items-center">
                            <span class="sidebar-icon">
                                <span class="fas fa-user">
                                </span>
                            </span>
                            <?php
                            if (isset($_SESSION['name']))
                                echo $_SESSION['name'];

                            else
                                echo "User";

                            ?> </a>
                        <a class="dropdown-item d-flex align-items-center" href="settings.php">
                            <span class="sidebar-icon">
                                <span class="fas fa-cog">
                                </span>
                            </span>
                            Settings
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="../index.html">
                            <span class="sidebar-icon">
                                <span class="fas fa-home">
                                </span>
                            </span>
                            Home
                        </a>
                        <div role="separator" class="dropdown-divider my-1"></div>
                        <a class="dropdown-item d-flex align-items-center" href="../php/logout.php">
                            <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Sign out
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>