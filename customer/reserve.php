<?php
session_start();
include_once "inc/user-connection.php";
$queryLastRow = "SELECT * FROM `hotel`.`Reservation` Where reservationID = (SELECT MAX(reservationID) FROM `hotel`.`Reservation`)";
$resultLastRow = mysqli_query($conn, $queryLastRow);
$lastID = mysqli_fetch_assoc($resultLastRow);
if ($lastID != NULL) $reservationID = $lastID['reservationID'] + 1;
else $reservationID = 1;
$hotelID  = NULL;
$roomType = NULL;
$email = NULL;
$arrival = NULL;
$departure = NULL;
$totalPrice = NULL;
$numRes = NULL;
$cancelled = 0;

$numDays = NULL;
$weekDays = NULL;
$weekendDays = NULL;
$totalPrice = NULL;

    if(isset($_POST['submit']))
    {
        $dates = $_POST['bookingDate'];
        $numRes = $_POST['rooms'];
        $roomType = $_POST['type'];
        $hotelID = $_POST['hotelID']

        $pattern = '{(\d+-\d+-\d+) to (\d+-\d+-\d+)/)}';
        if(preg_match($pattern, $dates, $matches)){
            $arrival = $matches[1];
            $departure = $matches[2];
        }
    }

mysqli_close($conn);
?>