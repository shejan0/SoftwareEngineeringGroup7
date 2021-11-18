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
    </li>                </ol>
            </nav>
            <h2 class="h4">Hotel</h2>
            <p class="mb-0">Search hotel.</p>
        </div>
        <div class="btn mb-2 mb-md-0">
        <div class="btn-group ms-2 ms-lg-3">
                <a class="btn btn-sm btn-outline-gray-600" href="createProperty.php">Create Property</a>
                <a class="btn btn-sm btn-outline-gray-600" href="modifyProperty.php">Modify Property</a>
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
                    <input type="text" class="form-control bg-white shadow-soft border border-ligh" placeholder="Search hotels">
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