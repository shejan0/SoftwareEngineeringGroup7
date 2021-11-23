<?php
include_once "inc/session_start.php";
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
$all_amenities = array();  
$reservationID = $_SESSION['reservationID'];
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
            <h2 class="h4">Edit Reservations</h2>
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
            <a href="reservations.php" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2">Back to reservations</a>
        </div>
    </div>
    <!-- Hotel info  -->
    <div class="card card-body border-0 shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
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
            $query = mysqli_query($conn, "SELECT * FROM reservation where ReservationID = \"$reservationID\";");
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
        <!-- end of table -->
    </div>
    <div class="card-body shadow-soft border-light animate-up-5 bg-white row justify-content-center mt-5">
        <h2 class="h5 mb-4"><?php echo "Update Reservation #$reservationID" ?></h2>
        <form action="reservations.php" method="post" class="mt-4">
        <div class="col-xl-4 col-md-6 mb-4 ">
              <label class="form-label" for="form_dates">Dates</label>
              <div class="datepicker-container datepicker-container-left">
                <input class="form-control  input-group btn-pill bg-white shadow-soft border-light" type="text" name="bookingDate" id="form_dates"
                  placeholder="Choose your dates">
              </div>
            </div>
            <div class="form-group mb-4">
                <label for="hotelName">Select new room type:</label>
                <div class="input-group">
                <select class="form-select input-group btn-pill bg-white shadow-soft border-light" name="roomType" id="form_guests" 
              title=" ">
                <option value="Standard">Standard</option>
                <option value="Queen">Queen</option>
                <option value="King">King</option>`
              </select>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="totalRooms">Select new number of rooms booked:</label>
                <div class="input-group">
                <select class="form-select input-group btn-pill bg-white  shadow-soft border-light" name="numRooms" id="form_rooms" 
                title=" ">

                <?php
                for($i = 1; $i<=10;$i++){
                  echo "<option value\"$i\">$i</option>";
                }
                ?>
              </select>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="update"  value="Modify Property">Save changes</button>
            </div>
            <input type='hidden' name="reservationID" value="<?php echo $reservationID?>">
        </form>
    </div>
    <?php include_once "inc/footer.php" ?>