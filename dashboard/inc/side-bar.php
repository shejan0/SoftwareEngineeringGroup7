<?php
include_once "session_start.php";
if(!isset($_SESSION['email']))
{
    $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
    $_SESSION['message'] = "ERROR: You must be login in order to access the dashboard.";
    header("Location: ../html/admin-sign-in.php");
    exit();
}
?>
<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none bg-primary  ">
    <a class="navbar-brand me-lg-5" href="dashboard.php">
        <img class="navbar-brand-dark" src="../assets/img/technologies/react-logo.svg" alt="Volt logo" /> <img class="navbar-brand-light" src="../assets/img/brand/volt-dark.svg" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-primary text-white collapse  shadow-soft " data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="d-block">
                    <h1 class="lead fw-normal text-white mb-4 px-lg-10">Hello,
                        <?php echo $_SESSION['name']; ?>
                    </h1>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img src="../assets/img/technologies/react-logo.svg" height="20" width="20" alt="Volt Logo">
                    </span>
                    <span class="mt-1 ms-1 sidebar-text">Portal Dashboard</span>
                </a>
            </li>
            <!-- <li class="nav-item ">
                <a href="#" class="nav-link">
                    <span class="sidebar-icon" >
                        <span class="fas fa-user-plus">
                        </span>
                    </span>
                    <span class="sidebar-text">Add user</span>
                </a>
            </li> -->
            <li class="nav-item ">
                <a href="employees.php" class="nav-link">
                    <span class="sidebar-icon">
                        <span class="fas fa-address-card">
                        </span>
                    </span>
                    <span class="sidebar-text">Employees</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="customer.php" class="nav-link">
                    <span class="sidebar-icon">
                        <span class="fas fa-user">
                        </span>
                    </span>
                    <span class="sidebar-text">Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="hotel.php" class="nav-link d-flex justify-content-between">
                    <span>
                        <span class="sidebar-icon">
                            <span class="fas fa-hotel">
                            </span>
                        </span>
                        <span class="sidebar-text">Hotel</span>
                    </span>
                </a>

            </li>
            <li class="nav-item">
                <a href="reservations.php" class="nav-link d-flex justify-content-between">
                    <span>
                        <span class="sidebar-icon">
                            <span class="fas fa-calendar-week">
                            </span>
                        </span>
                        <span class="sidebar-text">Reservation</span>
                    </span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="settings.php" class="nav-link">
                    <span class="sidebar-icon">
                        <span class="fas fa-cog">
                        </span>
                    </span>
                    <span class="sidebar-text">Setting</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="../index.html" class="nav-link">
                    <span class="sidebar-icon"><span class="fas fa-home"></span></span>
                    <span class="sidebar-text">Home</span>
                </a>
            </li>
            <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
            <li class="nav-item">
                <a class="btn btn-info d-flex align-items-center justify-content-center btn-upgrade-pro animate-up-2" id='sign-out' name='sign-out' href='../php/logout.php'>
                    <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    sign out</a>
            </li>
        </ul>
    </div>
</nav>