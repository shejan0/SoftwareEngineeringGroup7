<?php
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";
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
                            <td><span class="fw-normal"><a href="" class="nav-link">
                    <span class="sidebar-icon">
                        <span class="fas fa-window-close	">
                        </span>
                    </span>
                </a></span></td>


                        </tr>
                    <?php  } ?>
        </table>
    </div>
      </div>
    </section>
    <?php
include_once "php/footer.php";  ?>
    <!-- Footer-->