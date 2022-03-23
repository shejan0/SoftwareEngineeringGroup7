<?php
ob_start(); // fix "header already sent" error
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";

$id = $_GET['hotelID'];
$date = $_GET['bookingDate'];
$dateRange = explode(" to", $_GET['bookingDate']);
$start = trim($dateRange[0]);
$end = trim($dateRange[1]);
$numRooms = $_GET['rooms'];
$priceRoom = "price" . ucfirst($_GET['type']);
$roomsAvailable = "num" . ucfirst($_GET['type']);
$email = $_SESSION['email'];
$name = $_SESSION['name'];

$weekDays = 0;
$weekendDays = 0;

$begin = new DateTime(strval( $start ));
$end2   = new DateTime(strval( $end ));
//Loop through days and identify number of weekend days and week days
for($i = $begin; $i <= $end2; $i->modify('+1 day')){
    $day = $i->format("Y-m-d");
    $test = (date('N', strtotime($day)) >= 6);
    //Check to see if it is equal to Sat or Sun.
    if($test){
        //Increment weekend days
        $weekendDays++;
    }
    else{
        //Increment week days
        $weekDays++;
    }
}

// gets number of rooms and price for each room type
$query = "SELECT * from hotel where hotelID = $id";
$result = mysqli_query($conn, $query);
$records = mysqli_fetch_assoc($result);

// gets reservation ID
$reservationQuery = mysqli_query($conn, "SELECT ReservationID from reservation where hotelID = $id;");
$reservation = mysqli_fetch_assoc($reservationQuery);

if (isset($_GET['book'])) {
    if (!empty($_GET['bookingDate'])) {
        if ($numRooms <= $records[$roomsAvailable]) {
            $surgePercent = $records['weekendSurge'];
            $subtotal = ($numRooms * $records[$priceRoom]) * ($weekDays + $weekendDays);
            $weekendSurge = ($numRooms * $records[$priceRoom] * $weekendDays) * ( $surgePercent / 100);
            $tax = round(($subtotal + $weekendSurge) * .0825, 2);
            $price = round($subtotal + $weekendSurge + $tax, 2);
            
        } else {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: The Room you are trying to book is full";
            header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
    } else {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Please enter a valid date before booking";
        header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
        exit();
    }
}
?>
<section class="section section-lg pt-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between mb-4">
                    <?php echo "<a href=\"room-details.php?hotelID=$id\" class=\"mb-3 mb-lg-0\">"; ?>
                    <span class="icon icon-xs">
                        <span class="fas fa-chevron-left me-2"></span>
                    </span> Back to booking
                 </a>
                </div>
                <div class="card border-light shadow-inset p-4 p-md-5 position-relative">
                    <div class="d-flex justify-content-between pb-4 pb-md-5 mb-4 mb-md-5 border-bottom border-gray-300">
                        <div>
                            <h4>Portal</h4>
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
                            <ul class="list-group simple-list">
                                <li class="list-group-item fw-normal border-0 ps-0 py-1">1 UTSA BLVD</li>
                                <li class="list-group-item fw-normal border-0 ps-0 py-1">San Antonio, TX, USA</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-6 d-flex align-items-center justify-content-center">
                        <h2 class="h1 mb-0">Confirmation<?php //echo $_GET['reservationID'] 
                                                        ?></h2><span class="badge badge-xl badge-success ms-2">Paid</span>
                    </div>
                    <div class="row justify-content-between mb-4 mb-md-5">
                        <div class="col-sm">
                            <h5>Your Information:</h5>
                            <div>
                                <ul class="list-group simple-list">
                                    <li class="list-group-item font-weight-norma border-0 ps-0 py-1"><strong>Name: </strong> <?php echo $_SESSION['name'] ?></li>
                                    <li class="list-group-item font-weight-norma border-0 ps-0 py-1"><strong>Email: </strong>  <?php echo $_SESSION['email'] ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm col-lg-4">
                        <h5>Hotel Information:</h5>
                            <div>
                                <ul class="list-group simple-list">
                                    <li class="list-group-item font-weight-norma border-0 ps-0 py-1"><strong>Hotel Name: </strong> <?php echo $records['hotelName'] ?></li>
                                    <li class="list-group-item font-weight-norma border-0 ps-0 py-1"><strong>Booking date: </strong>  <?php echo $date ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="bg-gray-300 border-top">
                                        <tr>
                                            <th scope="row" class="border-0 text-left">Hotel Name</th>
                                            <th scope="row" class="border-0">Room type</th>
                                            <th scope="row" class="border-0">Qty</th>
                                            <th scope="row" class="border-0">Price</th>
                                            <th scope="row" class="border-0">Dates</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-left fw-bold h6"><?php echo $records['hotelName'] ?></th>
                                            <td><?php echo $_GET['type'] ?></td>
                                            <td><?php echo $_GET['rooms'] ?></td>
                                            <td><?php echo $records[$priceRoom] ?></td>
                                            <td><?php echo $date ?></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end text-right mb-4 py-4 border-bottom">
                                <div class="mt-4">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left"><strong>Subtotal</strong></td>
                                                <td class="right">$ <?php echo $subtotal ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Weekend Surge</strong></td>
                                                <td class="right">$ <?php echo $weekendSurge ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Tax Rate (8.25%)</strong></td>
                                                <td class="right">$ <?php echo $tax ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Total</strong></td>
                                                <td class="right">$ <strong><?php echo $price ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <form action='book.php' method=GET>
                                <input type="hidden" name="hotelID" value="<?php echo $_GET['hotelID']; ?>">
                                <input type="hidden" name="bookingDate" value="<?php echo $_GET['bookingDate']; ?>">
                                <input type="hidden" name="rooms" value="<?php echo $_GET['rooms']; ?>">
                                <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>">

                                <button class="btn btn-primary me-2 shadow-soft border-light animate-up-2" name='submit' value='submit' type='submit'> Confirm booking</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include_once "php/footer.php";
?>
<!-- Footer-->