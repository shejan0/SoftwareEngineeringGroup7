<?php
include_once "inc/session_start.php";
include_once "../php/inc/user-connection.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
?>
<main class="content bg-white">
    <?php include_once "inc/header.php"; ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href=" <?php echo basename(__FILE__) ?>"><?php echo basename(__FILE__, '.php') ?>
                        </a>
                    </li>
                </ol>
            </nav>
            <h2 class="h4">Customers</h2>
            <p class="mb-0">Customer table</p>

        </div>
        <?php
        if (isset($_SESSION['message']) && isset($_SESSION['alert'])) { ?>
            <div class="<?php echo $_SESSION['alert'] ?>" role="alert">
                <span class="fas fa-bullhorn me-1"></span>
                <strong><?php echo $_SESSION['message'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['alert']);
        } ?>
    </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
        </div>
    </div>

    <!-- Employee Table -->
    <div class="card card-body border-0 shadow-soft border border-light table-wrapper table-responsive bg-white">
        <table class="table table-hover">
            <thread>
                <tr>
                    <th class="border-gray-200">Name</th>
                    <th class="border-gray-200">Email</th>
                    <th class="border-gray-200">Password</th>
                </tr>
                <thread>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM user;");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><span class="fw-normal"><?php echo $row['name']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['email']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['password']; ?></span></td>
                        </tr>
                    <?php  } ?>
        </table>
    </div>
    <?php include_once "inc/footer.php" ?>