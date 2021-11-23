<?php
include_once "../php/inc/user-connection.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
include_once "modifyReservation.php";

if(isset($_POST)){
  if(isset($_POST['update'])){
    $start = NULL;
    $end = NULL;
    $roomType = NULL;
    $numRooms = NULL;
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
    reservationModify($conn, $reservationID, $roomType, $numRooms, $start, $end);
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
      <h2 class="h4">All Reservations</h2>
      <p class="mb-0">Modify customer reservations</p>

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
      <button type="button" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2" data-bs-toggle="modal" data-bs-target="#modal-form">Modify Reservation </button>

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
                          <button type="submit" name="check" value="Enter" class="btn btn-primary">Modify reservations</button>
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
  </div>
  </div>
  </div>
  </div>
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
            <th class="border-gray-200">Delete</th>

            


          </tr>
          <form action="" method="post">
          <thread>
            <?php
            $email = $_SESSION['email'];
            $query = mysqli_query($conn, "SELECT * FROM reservation;");
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
                <td><span class="fw-normal"><button class="btn btn-sm d-inline-flex align-items-center animate-up-2" type="submit" name="delete" value="<?php echo $row['ReservationID'];?>"> <span><span class="fas fa-window-close"></span></span></button></td>                           

              </tr>
            <?php  } ?>
            </form>
      </table>
    </div>
  </div>
  </div>

  </div>

  <?php include_once "inc/footer.php" ?>