<?php
include_once "../php/inc/user-connection.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
?>
<main class="content bg-white">
    <?php include_once "inc/header.php"; ?>
    <li class="breadcrumb-item active" aria-current="page">
        <a href=" <?php echo basename(__FILE__) ?>"><?php echo basename(__FILE__, '.php') ?>
        </a>
    </li>
    </ol>
    </nav>
    <h2 class="h4">Employees</h2>
    <p class="mb-0">List of employees and admin information.</p>
    </div>
    <div class="btn mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2" data-bs-toggle="modal" data-bs-target="#modalSignUp">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add employee
        </button>
        <button type="button" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2" data-bs-toggle="modal" data-bs-target="#modalSignUp">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add employee
        </button>
        <!-- Modal Content -->
        <div class="modal fade" id="modalSignUp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-md-5">
                        <h2 class="h4 text-center">Employee information</h2>
                        <form action="server.php" method=POST>

                            <!-- Modal Form -->

                            <!-- Name -->
                            <div class="form-group mb-4">
                                <label for="name">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text border-gray-300" id="basic-addon5">
                                        <span class="fas fa-user"></span>
                                    </span>
                                    <input type="text" placeholder="Name" class="form-control border-gray-300" id="name" name="name" required>
                                </div>
                            </div>

                            <!-- email -->
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text border-gray-300" id="basic-addon3">
                                        <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                    </span>
                                    <input type="email" class="form-control border-gray-300" placeholder="example@company.com" id="email" name='email' autofocus required>
                                </div>
                            </div>

                            <!-- password -->
                            <div class="form-group">
                                <div class="form-group mb-4">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text border-gray-300" id="basic-addon4">
                                            <svg class="icon icon-xxs"" fill=" currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        <input type="password" placeholder="Password" class="form-control border-gray-300" id="password" name='password' required>
                                    </div>
</div>
                            </div>
                            <!-- submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name='admin-sign-up'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>     
    </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
                <div class="input-group me-2 me-lg-3 fmxw-400 ">
                    <span class="input-group-text bg-white shadow-soft border border-ligh">
                        <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="text" class="form-control bg-white shadow-soft border border-ligh" placeholder="Search employees">
                </div>
            </div>
            <div class="col-4 col-md-2 col-xl-1 ps-md-0 text-end">
                <div class="dropdown">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0">
                        <span class="small ps-3 fw-bold text-dark">Show</span>
                        <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg></a>
                        <a class="dropdown-item fw-bold" href="#">20</a>
                        <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Table -->
    <div class="card card-body border-0 shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
        <table class="table table-hover">
            <thread>
                <tr>
                    <th class="border-gray-200">ID</th>
                    <th class="border-gray-200">Name</th>
                    <th class="border-gray-200">Email</th>
                    <th class="border-gray-200">Password</th>
                </tr>
                <thread>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM admin;");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><span class="fw-bold"><?php echo $row['ID']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['name']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['email']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['password']; ?></span></td>
                        </tr>
                    <?php  } ?>
        </table>
    </div>
    <?php include_once "inc/footer.php" ?>