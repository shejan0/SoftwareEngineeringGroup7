<?php
session_start();
include_once "../php/inc/user-connection.php";


$id = $_GET['hotelID'];
$date = $_GET['bookingDate'];
$numRooms = $_GET['rooms'];
$roomType = $_GET['type'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];

$query = "SELECT * from hotel where hotelID = $id";
$result = mysqli_query($conn,$query);
$records = mysqli_fetch_assoc($result);

if(isset($_GET['book'])){
    if ($roomType == 'queen' && !empty($date) && !empty($numRooms)){
    $update = "UPDATE hotel set numQueen = $records[numQueen] - $numRooms where hotelID = $id";
    $updateResult = mysqli_query($conn,$update);

    $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
    $_SESSION['message'] = "Successfully booked your reservation";
    header("location: room-details.php?".$_SERVER['QUERY_STRING']);
    exit();
    }
    else{
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error - Must enter all fields in order to book reservations";
        header("location: room-details.php?".$_SERVER['QUERY_STRING']);
        exit();
    }
}
// header("location: room-details.php?".$_SERVER['QUERY_STRING']);
// exit();