<?php
session_start();
include_once "../php/inc/user-connection.php";


$id = $_GET['hotelID'];
$date = $_GET['bookingDate'];
$dateRange = explode(" to", $_GET['bookingDate']);
$start = $dateRange[0];
$end = $dateRange[1];
$numRooms = $_GET['rooms'];
$roomType = $_GET['type'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];

$query = "SELECT * from hotel where hotelID = $id";
$result = mysqli_query($conn, $query);
$records = mysqli_fetch_assoc($result);

if (isset($_GET['book'])) {
    if ($roomType == 'standard' && !empty($date)) {

        // if room avaliable
        if ($numRooms <= $records['numStandard']) {
            $update = "UPDATE hotel set numStandard = $records[numStandard] - $numRooms where hotelID = $id;";
            $updateResult = mysqli_query($conn, $update);

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
    } else if ($roomType == 'queen' && !empty($date)) {
         // if room avaliable
        if ($numRooms <= $records['numQueen']) {
            $update = "UPDATE hotel set numQueen = $records[numQueen] - $numRooms where hotelID = $id;";
            $updateResult = mysqli_query($conn, $update);
            
            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = "Successfully booked your reservation from " . $start .  " to " . $end;
            header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }  else {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: The Room you are trying to book is full";
            header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
    } else if ($roomType == 'king' && !empty($date)) {
        if ($numRooms <= $records['numKing']) {
            $update = "UPDATE hotel set numKing = $records[numKing] - $numRooms where hotelID = $id;";
            $updateResult = mysqli_query($conn, $update);

            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = "Successfully booked your reservation from " . $start .  " to " . $end;
            header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
        else {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error: The Room you are trying to book is full";
            header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
            exit();
        }
    } else {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter valid dates.";
        header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
        exit();
    }
}
