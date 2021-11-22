<?php
session_start();
include_once "../php/inc/user-connection.php";
include_once "resConflictCheck.php";

$hotelID = $_GET['hotelID'];
$date = $_GET['bookingDate'];
$dateRange = explode(" to", $_GET['bookingDate']);
$start = trim($dateRange[0]);
$end = trim($dateRange[1]);
$numRooms = $_GET['rooms'];
$priceRoom = "price". ucfirst($_GET['type']);
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
            $price = round(((($numRooms * $records[$priceRoom]) * $weekDays )
                        + (($numRooms * $records[$priceRoom]) * $weekendDays * (1 + $records['weekendSurge'] / 100))) * 1.0825, 2);
            if(FindifFull($conn,1, $hotelID, $_GET['type'], $numRooms, $start, $end)){
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error: The Room you are trying to book is full";
                header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
                exit();
            }
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