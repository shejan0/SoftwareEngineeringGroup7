<?php
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";
include_once "../dashboard/modifyReservation.php";

if(isset($_POST)){
  if(isset($_POST['update'])){
    $start = NULL;
    $end = NULL;
    $roomType = NULL;
    $numRooms = NULL;
    $email = $_SESSION['email'];
    $reservationID = $_POST['reservationID'];
    if(!empty($_POST['bookingDate'])){
      $dateRange = explode(" to", $_POST['bookingDate']);
      $start = trim($dateRange[0]);
      $end = trim($dateRange[1]);
    }
    if(!empty($_POST['roomType'])){
      $roomType = $_POST['roomType'];
    }
    if(!empty($_POST['numRooms'])){
      $numRooms = $_POST['numRooms'];
    }
    if( customerResModify($conn, $reservationID, $roomType, $numRooms, $start, $end, $email)){
      $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
      $_SESSION['message'] = "Successfully updated reservations";
    }
   
  }
  if(!empty($_POST['delete'])){
    if(!$conn->query("DELETE FROM reservation WHERE reservationID = $_POST[delete]")){
      $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
      $_SESSION['message'] = $conn->error;
    }else{
      $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
      $_SESSION['message'] = "Successfully deleted Hotel Name to \"" . $_POST['delete'] . "\"";
    }
    unset($_SESSION['message']);
    unset($_SESSION['alert']);
  }
}
?>
    <section class="py-5 bg-white shadow-inset border-light">
      <div class="container">
        <h1 class="hero-heading mb-0">Your reservations</h1>
        <p class="text-muted mb-5">View your reservations</p>
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
        <div class="btn mb-md-2">
      <button type="button" class="btn btn-sm btn-primary d-inline-flex align-items-center " data-bs-toggle="modal" data-bs-target="#modal-form">Modify Reservation </button>

      <!-- Modal -->
      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content rounded bg-white">
            <div class="modal-body p-0">
              <div class="card bg-white p-4">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="card-header border-0 bg-white text-center pb-0">
                  <h2 class="h4">Enter Reservation ID</h2>
                </div>
                <div class="card-body">
                  <!-- Form -->
                  <form action="modifyReservation.php" method='post' class="mt-4">
                    <div class="form-group mb-4">
                      <label for="hotelID">Reservation ID</label>
                      <div class="input-group">
                        <span class="input-group-text"><span class="fas fa-hotel"></span></span>
                        <input type="text" class="form-control" name="reservationID" placeholder="Reservation ID">
                        <div>
                          <button type="submit" name="checkCust" value="Enter" class="btn btn-primary">Modify reservations</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
            <!-- Employee Table -->
    <div class="card card-body border-0 shadow-soft border border-light table-wrapper table-responsive  bg-white">
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
                    <th class="border-gray-200">Delete</th>

                    


                </tr>
                <form action="" method="post">
                <thread>
                    <?php
                    $email = $_SESSION['email'];
                    $query = mysqli_query($conn, "SELECT * FROM reservation where email = '$email';");
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
                            <td><span class="fw-normal"><button class="btn btn-md btn-gray-primary d-inline-flex align-items-center " type="submit" name="delete" value="<?php echo $row['ReservationID'];?>"> <span class="sidebar-icon"><span class="fas fa-window-close"></span></span></button></td>                           
                        </tr>
                    <?php  } ?>
                    </form>
        </table>
    </div>
      </div>
    </section>
    <?php
include_once "php/footer.php";  ?>
    <!-- Footer-->