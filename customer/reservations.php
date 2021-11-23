<?php
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";
if(isset($_POST)){
    if(!empty($_POST['delete'])){
      if(!$conn->query("DELETE FROM reservation WHERE reservationID = $_POST[delete]")){
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = $conn->error;
      }else{
        $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
        $_SESSION['message'] = "Successfully deleted Hotel Name to \"" . $_POST['delete'] . "\"";
      }
     
    }
  }
?>
    <section class="py-5 bg-white shadow-inset border-light">
      <div class="container">
        <h1 class="hero-heading mb-0">Your reservations</h1>
        <p class="text-muted mb-5">View your reservations</p>
            <!-- Employee Table -->
    <div class="card card-body border-0 shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
        <table class="table table-hover">
            <thread>
                <tr>
                    <th class="border-gray-200">Delete</th>
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
                <form action="" method="post">
                <thread>
                    <?php
                    $email = $_SESSION['email'];
                    $query = mysqli_query($conn, "SELECT * FROM reservation where email = '$email';");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                        <td><span class="fw-normal"><input type="submit" name="delete" value="<?php echo $row['ReservationID']; ?>"></td>
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
                    </form>
        </table>
    </div>
      </div>
    </section>
    <?php
include_once "php/footer.php";  ?>
    <!-- Footer-->