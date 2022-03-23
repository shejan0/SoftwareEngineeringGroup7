<?php
ob_start();
include_once "inc/head.php";
include_once "inc/side-bar.php";
include_once "../php/inc/user-connection.php";

$email = $_SESSION['email'];

// gets total revenue 
$revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(totalPrice) as totalPrice from reservation"));

// gets total employee and customer
$users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(name) as totalUsers from user"));


$hotels = mysqli_fetch_assoc(mysqli_query($conn,"SELECT count(hotelName) as totalHotel from hotel"));
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
  <div class="row">
    <div class="col-12 col-lg-6 col-xl-4 mb-4">
      <div class="card border-light shadow-soft bg-white ">
        <div class="card-body">
          <div class="row d-block d-xl-flex align-items-center">
            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
              <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="d-sm-none">
                <h2 class="fw-extrabold h5">Revenue</h2>
                <h3 class="mb-1">$<?php echo $revenue['totalPrice'];?></h3>
              </div>
            </div>
            <div class="col-12 col-xl-7 px-xl-0">
              <div class="d-none d-sm-block">
                <h2 class="h6 text-gray-400 mb-0">Revenue</h2>
                <h3 class="fw-extrabold mb-2">$<?php echo $revenue['totalPrice'];?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6 col-xl-4 mb-4">
      <div class="card border-light shadow-soft bg-white ">
        <div class="card-body">
          <div class="row d-block d-xl-flex align-items-center">
            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
              <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0 shadow-inset border-light">
              <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
               
              </div>
              <div class="d-sm-none">
                <h2 class="fw-extrabold h5">User</h2>
                <h3 class="mb-1">$<?php echo $users['totalUsers'];?></h3>
              </div>
            </div>
            <div class="col-12 col-xl-7 px-xl-0">
              <div class="d-none d-sm-block">
                <h2 class="h6 text-gray-400 mb-0">Users</h2>
                <h3 class="fw-extrabold mb-2"><?php echo $users['totalUsers'];?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-4 mb-4">
      <div class="card border-light shadow-soft bg-white ">
        <div class="card-body">
          <div class="row d-block d-xl-flex align-items-center">
            <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
              <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0 shadow-inset border-light ">
                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="d-sm-none">
                <h2 class="fw-extrabold h5">Total Properties</h2>
                <h3 class="mb-1"><?php echo $hotels['totalHotel']?></h3>
              </div>
            </div>
            <div class="col-12 col-xl-7 px-xl-0">
              <div class="d-none d-sm-block">
                <h2 class="h6 text-gray-400 mb-0"># Properties</h2>
                <h3 class="fw-extrabold mb-2"><?php echo $hotels['totalHotel']?></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 mb-4">
      <div class="card">
        <div class="card card-body shadow-soft border border-light table-wrapper table-responsive  bg-white">
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
        <div class="card card-body shadow-soft border border-light table-wrapper table-responsive  bg-white">
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
        <div class="card card-body shadow-soft border border-light table-wrapper table-responsive  bg-white">
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
        <div class="card card-body shadow-soft border border-light table-wrapper table-responsive  bg-white">
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