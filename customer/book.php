<?php
session_start();
include_once "../php/inc/user-connection.php";


$id = $_GET['hotelID'];
$date = $_GET['bookingDate'];
$dateRange = explode(" to", $_GET['bookingDate']);
$start = trim($dateRange[0]);
$end = trim($dateRange[1]);
$numRooms = $_GET['rooms'];
$priceRoom = "price". ucfirst($_GET['type']);
$roomsAvailable = "num" . ucfirst($_GET['type']);
$email = $_SESSION['email'];
$name = $_SESSION['name'];

// gets number of rooms and price for each room type
$query = "SELECT * from hotel where hotelID = $id";
$result = mysqli_query($conn, $query);
$records = mysqli_fetch_assoc($result);

 // gets reservation ID
 $reservationQuery = mysqli_query($conn, "SELECT ReservationID from reservation where hotelID = $id;");
 $reservation = mysqli_fetch_assoc($reservationQuery);

if (isset($_GET['submit'])) {
    if (!empty($date)) {

        // if room avaliable
        if ($numRooms <= $records[$roomsAvailable]) {
            $subtotal = ($numRooms * $records[$priceRoom]);
            $tax = $subtotal * .0825;
            $price = ($numRooms * $records[$priceRoom]) * 1.0825;


            $update = "UPDATE hotel set $roomsAvailable = $records[$roomsAvailable] - $numRooms where hotelID = $id;";
            $updateResult = mysqli_query($conn, $update);
            $insert = "INSERT into reservation (hotelID,hotelName,roomType,email,arrivalDate,departureDate,totalPrice,numRoom) 
            values ('$id','$records[hotelName]','$_GET[type]','$email','$start','$end','$price','$numRooms');";
            $insertResult = mysqli_query($conn, $insert);

            // if query failed
            if (!$insertResult || !$updateResult) {
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error: " . mysqli_error($conn);
                header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
                exit();
            }
            // if no error, send to confirmation page to confirm before booking
            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = "Confirm your reservation below." ;
            header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
           // header("location: invoice.php?name=$name&email=$email&hotelName=$records[hotelName]&reservationID=$reservation[ReservationID]&subtotal=$subtotal&total=$price&roomPrice=$records[$priceRoom]&tax=$tax&" . $_SERVER['QUERY_STRING']);
            exit();

            // if room booked is full
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
