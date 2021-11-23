<?php

session_start();
include_once "../php/inc/user-connection.php";
include_once "../customer/resConflictCheck.php";


// checks if reservation exists
if (isset($_POST['check'])) {

    if (empty($_POST['reservationID'])) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter a reservation ID to modify";
        header("location: reservations.php");
        exit();
    }
    // if user entered an invalid input for hotel I
    else if (!ctype_digit($_POST['reservationID'])) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter a positive integer for ID only";
        header("location: reservations.php");
        exit();
    } else {
        $reservationID = $_POST['reservationID'];
        $query = "SELECT * FROM reservation where ReservationID = $reservationID";
        $result = mysqli_query($conn, $query);

        if(!$result){
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: " . mysqli_error($conn);
            header("location: reservations.php");
            exit();
        }
        $row = mysqli_num_rows($result);

        // no reservation ID found
        if ($row == 0) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = 'Error: Could not find Reservation #' . $reservationID ;
            $_SESSION['reservationID'] = $_POST['reservationID'];
            header("location: reservations.php");
            exit();
        }

        // found 
        else {
            $reservation = mysqli_fetch_assoc($result);
            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = 'Success: Found Reservation ID';
            $_SESSION['reservationID'] = $reservationID;
            header("location: updateReservations.php");
        }
    }
}

if (isset($_POST['checkCust'])) {

    if (empty($_POST['reservationID'])) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter a reservation ID to modify";
        header("location: reservations.php");
        exit();
    }
    // if user entered an invalid input for hotel I
    else if (!ctype_digit($_POST['reservationID'])) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter a positive integer for ID only";
        header("location: reservations.php");
        exit();
    } else {
        $reservationID = $_POST['reservationID'];
        $query = "SELECT * FROM reservation where ReservationID = $reservationID";
        $result = mysqli_query($conn, $query);

        if(!$result){
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: " . mysqli_error($conn);
            header("location: reservations.php");
            exit();
        }
        $row = mysqli_num_rows($result);

        // no reservation ID found
        if ($row == 0) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = 'Error: Could not find Reservation #' . $reservationID ;
            $_SESSION['reservationID'] = $_POST['reservationID'];
            header("location: reservations.php");
            exit();
        }
        // email associated with reservation does not match customer email
        else if($row['email'] != $_SESSION['email']){
            echo $row['email'];
            echo $_SESSION['email'];
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = 'Error: Reservation requested is not associated with customer: ' . $_SESSION['email'] ;
            $_SESSION['reservationID'] = $_POST['reservationID'];
            header("location: reservations.php");
            exit();
        }
        // found 
        else {
            $reservation = mysqli_fetch_assoc($result);
            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = 'Success: Found Reservation ID';
            $_SESSION['reservationID'] = $reservationID;
            header("location: updateReservations.php");
        }
    }
}

function customerResModify($conn, $reservationID, $newRoomType, $newNumRooms, $newArrival, $newDeparture, $email)
{
    $result = $conn->query("SELECT ReservationID FROM reservation WHERE email = \"$email\";");
    while ($assoc = $result->fetch_assoc()) {
        if ($assoc['ReservationID'] == $reservationID) {
            $success = reservationModify($conn, $reservationID, $newRoomType, $newNumRooms, $newArrival, $newDeparture);
            return $success;
        }
    }
    return false;
}

function reservationModify($conn, $reservationID, $newRoomType, $newNumRooms, $newArrival, $newDeparture)
{
    $result = $conn->query("SELECT * FROM reservation WHERE ReservationID = \"$reservationID\";");
    $assoc = $result->fetch_assoc();
    # If a new room type isn't passed, then $newRoomType is 
    #   assigned the previous roomType from reservation
    if ($newRoomType == NULL) {
        $newRoomType = $assoc['roomType'];
    }
    # If a new number of rooms isn't passed, then $newNumRooms 
    #   is assigned the previous numRooms from reservation
    if ($newNumRooms == NULL) {
        $newNumRooms = $assoc['numRoom'];
    }

    # Checks if a new arrival and departure date has been passed in.
    #   If both are not null then it uses func FindifFull to check if
    #   the reservation dates are valid.
    if ($newArrival != NULL && $newDeparture != NULL) {
        if (FindifFull($conn, NULL, $reservationID, $assoc['hotelID'], $newRoomType, $newNumRooms, $newArrival, $newDeparture)) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: The Room you are trying to book is full for the dates you selected";
            header("location: modifyReservation.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
    }
        # If both $newArrival and $newDeparture are null, it assigns both 
    #   variables their respective values from the original reservation.
    #   a check is done just in case $newRoomType has a new value.
    else if ($newArrival == NULL && $newDeparture == NULL) {
        $newArrival = $assoc['arrivalDate'];
        $newDeparture = $assoc['departureDate'];
        if (FindifFull($conn, NULL, $reservationID, $assoc['hotelID'], $newRoomType, $newNumRooms, $newArrival, $newDeparture)) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: The Room you are trying to book is full for the dates you selected";
            header("location: modifyReservation.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
    }
    # If $newArrival is null, it is assigned the previous arrival date
    #   from the original reservation and proceeds to check the date range.
    else if ($newArrival == NULL && $newDeparture != NULL) {
        $newArrival = $assoc['arrivalDate'];
        if (FindifFull($conn, NULL, $reservationID, $assoc['hotelID'], $newRoomType, $newNumRooms, $newArrival, $newDeparture)) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: The Room you are trying to book is full for the dates you selected";
            header("location: modifyReservation.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
    }
    # If $newDeparture is null, it is assigned the previous departure date
    #   from the original reservation and proceeds to check the date range.
    else if ($newDeparture == NULL && $newArrival != NULL) {
        $newDeparture = $assoc['departureDate'];
        if (FindifFull($conn, NULL, $reservationID, $assoc['hotelID'], $newRoomType, $newNumRooms, $newArrival, $newDeparture)) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: The Room you are trying to book is full for the dates you selected";
            header("location: modifyReservation.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
    }

    # A new updated price is calculated from the func calculatePrice
    $newPrice = calculatePrice($conn, $assoc['hotelID'], $newRoomType, $newNumRooms, $newArrival, $newDeparture);
    $update = "UPDATE reservation SET roomType='$newRoomType', arrivalDate='$newArrival', departureDate='$newDeparture',
                         totalPrice='$newPrice', numRoom='$newNumRooms' WHERE ReservationID='$reservationID'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        #returns true upon a successful update
        return true;
    } else {
        return false;
    }
}

function calculatePrice($conn, $hotelID, $roomType, $numRooms, $arrival, $departure)
{
    $result = $conn->query("SELECT weekendSurge, priceKing, priceQueen, priceStandard FROM hotel WHERE hotelID = $hotelID");
    $assoc = $result->fetch_assoc();

    # Assigning $roomPrice based on what roomtime is selected.
    if ($roomType = "Standard") {
        $roomPrice = $assoc['priceStandard'];
    } else if ($roomType = "Queen") {
        $roomPrice = $assoc['priceQueen'];
    } else if ($roomType = "King") {
        $roomPrice = $assoc['priceKing'];
    }

    $weekDays = 0;
    $weekendDays = 0;
    $begin = new DateTime(strval($arrival));
    $end2   = new DateTime(strval($departure));
    //Loop through days and identify number of weekend days and week days
    for ($i = $begin; $i <= $end2; $i->modify('+1 day')) {
        $day = $i->format("Y-m-d");
        $test = (date('N', strtotime($day)) >= 6);
        //Check to see if it is equal to Sat or Sun.
        if ($test) {
            //Increment weekend days
            $weekendDays++;
        } else {
            //Increment week days
            $weekDays++;
        }
    }
    $weekdayValue = $roomPrice * $numRooms * $weekDays;
    $weekendValue = $roomPrice * $numRooms * $weekendDays * (1 + $assoc['weekendSurge'] / 100);
    $totalPrice = ($weekdayValue + $weekendValue) * 1.0825;
    return round($totalPrice, 2);
}
