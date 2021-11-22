<?php
ob_start();
include_once "inc/head.php";
include_once "inc/side-bar.php";
include_once "../php/inc/user-connection.php";

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
      <h1 class="hero-heading mb-0">Overview</h1>
    </div>
  </div>
  <div class = "row">
      <div class="col-12 mb-4">
        
        <div class="card bg-white shadow-soft border-light text-center py-4 animate-up-5">
          <div class="card-header d-sm-flex flex-row align-items-center flex-0">
            <div class="d-block mb-3 mb-sm-0">
              <div class="fs-5 fw-normal mb-2">Sales Value</div>
              <h2 class="fs-3 fw-extrabold">$10,567</h2>
              <div class="small mt-2">
                <span class="fw-normal me-2">Yesterday</span>
                <span class="fas fa-angle-up text-success"></span>
                <span class="text-success fw-bold">10.57%</span>
              </div>
            </div>
            <div class="d-flex ms-auto">
              <a href="#" class="btn btn-primary text-dark btn-sm me-2">Month</a>
              <a href="#" class="btn btn-primary btn-sm me-3">Week</a>
            </div>
          </div>
          <div class="card-body p-2">
            <div class="ct-chart-sales-value ct-double-octave ct-series-g-primary"></div>
          </div>
        </div>
      </div>
      
      <div class="col-12 mb-4">
                    <div class="card bg-yellow-100 border-0 shadow">
                        <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                            <div class="d-block mb-3 mb-sm-0">
                                <div class="fs-5 fw-normal mb-2">Sales Value</div>
                                <h2 class="fs-3 fw-extrabold">$10,fd567</h2>
                                <div class="small mt-2"> 
                                    <span class="fw-normal me-2">Yesterday</span>                              
                                    <span class="fas fa-angle-up text-success"></span>                                   
                                    <span class="text-success fw-bold">10.57%</span>
                                </div>
                            </div>
                            <div class="d-flex ms-auto">
                                <a href="test.php" class="btn btn-secondary text-dark btn-sm me-2">Month</a>
                                <a href="#" class="btn btn-dark btn-sm me-3">Week</a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div>
                        </div>
                    </div>

                    
                </div>
  <div class="col-12 mb-4">

      <div class="card">
    <div class="card card-body shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
      <div class="fs-5 fw-normal mb-2">Reservation</div>
      <table class="table table-hover">
        <thread>
          <tr>
            <th class="border-gray-200">Reservation ID</th>
            <th class="border-gray-200">Hotel ID</th>
            <th class="border-gray-200">Email</th>
            <th class="border-gray-200">Hotel Name</th>
            <th class="border-gray-200">Room Type</th>
            <th class="border-gray-200">Roombs booked</th>
            <th class="border-gray-200">Arrival Date</th>
            <th class="border-gray-200">Departure Date</th>
            <th class="border-gray-200">$ Total Price</th>

          </tr>
          <thread>
            <?php
            $email = $_SESSION['email'];
            $query = mysqli_query($conn, "SELECT * FROM reservation limit 20;");
            while ($row = mysqli_fetch_array($query)) {
            ?>
              <tr>
                <td><span class="fw-bold"><?php echo $row['ReservationID']; ?></span></td>
                <td><span class="fw-normal"><?php echo $row['hotelID']; ?></span></td>
                <td><span class="fw-normal"><?php echo $row['email']; ?></span></td>
                <td><span class="fw-normal"><?php echo $row['hotelName']; ?></span></td>
                <td><span class="fw-normal"><?php echo $row['roomType']; ?></span></td>
                <td><span class="fw-normal"><?php echo $row['numRoom']; ?></span></td>
                <td><span class="fw-normal"><?php echo $row['arrivalDate']; ?></span></td>
                <td><span class="fw-normal"><?php echo $row['departureDate']; ?></span></td>
                <td><span class="fw-normal">$ <?php echo $row['totalPrice']; ?></span></td>


              </tr>
            <?php  } ?>
      </table>
            </div>
            </div>
            </div>
            <div class="col-12 mb-4">

            <div class="card">
    <div class="card card-body shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
      <div class="fs-5 fw-normal mb-2 mt-4">Hotel</div>
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

                    $query = mysqli_query($conn, "SELECT * FROM hotel limit 20;");
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
            </div>
                    </div>
            </div>
   <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card card-body shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
          <div class="fs-5 fw-normal mb-2">Employees / Admin</div>
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
                    $query = mysqli_query($conn, "SELECT * FROM admin limit 20;");
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
      </div>
    </div>
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card card-body shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
          <div class="fs-5 fw-normal mb-2">Customers</div>
          <table class="table table-hover">
            <thread>
                <tr>
                    <th class="border-gray-200">Name</th>
                    <th class="border-gray-200">Email</th>
                    <th class="border-gray-200">Password</th>
                </tr>
                <thread>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM user limit 20;");
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
      </div>
    </div>
    </div>
  <?php include_once "inc/footer.php" ?>