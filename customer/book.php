<?php
session_start();
include_once "../php/inc/user-connection.php";
include_once "resConflictCheck.php";
include_once "../dashboard/modifyReservation.php";

$hotelID = $_GET['hotelID'];
$date = $_GET['bookingDate'];
$dateRange = explode(" to", $_GET['bookingDate']);
$start = trim($dateRange[0]);
$end = trim($dateRange[1]);
$numRooms = $_GET['rooms'];
$priceRoom = "price". ucfirst($_GET['type']);
$roomsAvailable = "num" . ucfirst($_GET['type']);
$roomType = $_GET['type'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];

// gets number of rooms for each room type
$query = "SELECT * from hotel where hotelID = \"$hotelID\"";
$resultr = $conn->query($query);
if(!$resultr){
    echo mysqli_error($conn);   
}
$records = mysqli_fetch_assoc($resultr);

 // gets reservation ID
 $reservationQuery = mysqli_query($conn, "SELECT ReservationID from reservation where hotelID = $hotelID;");
 $reservation = mysqli_fetch_assoc($reservationQuery);

if (isset($_GET['submit'])) {
    if (!empty($date)) {

        // if room avaliable
        if ($numRooms <= $records[$roomsAvailable]) {
            if(FindifFull($conn, NULL, $hotelID, $roomType, $numRooms, $start, $end)){
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error: The Room you are trying to book is full";
                header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
                exit();
            }
            $price = calculatePrice($conn, $hotelID, $roomType, $numRooms, $start, $end);
            $insert = "INSERT into reservation (hotelID,hotelName,roomType,email,arrivalDate,departureDate,totalPrice,numRoom) 
                        values ('$hotelID','$records[hotelName]','$_GET[type]','$email','$start','$end','$price','$numRooms');";

            // insert reseravation into table
            $insertResult = mysqli_query($conn, $insert);

            if (!$insertResult ) {
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error: " . mysqli_error($conn);
                header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
                exit();
            }

            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = "Successfully booked your reservation from " . $start .  " to " . $end;
            header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
            exit();
        } else {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: The Room you are trying to book is full";
            header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
     }
    // if date field is empty
    else {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Please enter a valid date before booking";
        header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
        exit();
    }
}