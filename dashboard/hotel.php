<?php
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
            <h2 class="h4">Hotel</h2>
            <p class="mb-0">Hotel table - add or edit hotels.</p>
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
        <div class="btn mb-2 mb-md-0">
            <a href="createProperty.php" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2">Add Property </a>
            <button type="button" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2" data-bs-toggle="modal" data-bs-target="#modal-form">Modify Property </button>

            <!-- Modal -->
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded bg-white">
                        <div class="modal-body p-0">
                            <div class="card bg-white p-4">
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="card-header border-0 bg-white text-center pb-0">
                                    <h2 class="h4">Enter property id</h2>
                                </div>
                                <div class="card-body">
                                    <!-- Form -->
                                    <form action="modify.php" method='post' class="mt-4">
                                        <div class="form-group mb-4">
                                            <label for="hotelID">Property ID</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><span class="fas fa-hotel"></span></span>
                                                <input type="text" class="form-control" name="hotelID" placeholder="Property ID">
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" name="enter" value="Enter" class="btn btn-primary">Modify property</button>
                                        </div></form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row align-items-center justify-content-between">
            <div class="col col-md-6 col-lg-3 col-xl-4">
            </div>
        </div>
    </div>
    <!-- Hotel Table -->
    <div class="card card-body border-0 shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
        <table class="table table-hover">
            <thread>
                <tr>
                    <th class="border-gray-200">Hotel ID</th>
                    <th class="border-gray-200">Hotel Name</th>
                    <th class="border-gray-200">Total Number of Rooms</th>
                    <th class="border-gray-200">Number of Standard Rooms</th>
                    <th class="border-gray-200">Number of Queen Rooms</th>
                    <th class="border-gray-200">Number of King Rooms</th>
                    <th class="border-gray-200">Price of Standard</th>
                    <th class="border-gray-200">Price of Queen</th>
                    <th class="border-gray-200">Price of King</th>
                    <th class="border-gray-200">Weekend Surge</th>
                </tr>
                <thread>
                    <?php

                    $query = mysqli_query($conn, "SELECT * FROM hotel;");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><span class="fw-bold"><?php echo $row['hotelID']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['hotelName']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['number_of_rooms']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['numStandard']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['numQueen']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['numKing']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['priceStandard']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['priceQueen']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['priceKing']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $row['weekendSurge']; ?></span></td>
                        </tr>
                    <?php  } ?>
        </table>
    </div>
    <?php include_once "inc/footer.php" ?>