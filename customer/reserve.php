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
$weekDays = 0;
$weekendDays = 0;
$surgePrice = NULL;
$totalPrice = NULL;

    if(isset($_POST['submit']))
    {
        $dates = $_POST['bookingDate'];
        $numRes = $_POST['rooms'];
        $roomType = $_POST['type'];
        $hotelID = $_POST['hotelID']
        
        //Separate $dates into arrival and departure dates
        $pattern = '{(\d+-\d+-\d+) to (\d+-\d+-\d+)/)}';
        if(preg_match($pattern, $dates, $matches)){
            $arrival = $matches[1];
            $departure = $matches[2];
        }
        //Calculate total number of days 
        $datediff = $arrival - $departure;
        $numDays = ($datediff / (60 * 60 * 24));

        $begin = new DateTime( $arrival );
        $end   = new DateTime( $departure );
        //Loop through days and identify number of weekend days and week days
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $day = date("D", strtotime($i));

            //Check to see if it is equal to Sat or Sun.
            if($day == 'Sat' || $day == 'Sun'){
                //Increment weekend days
                $weekendDays++;
            }
            else{
                //Increment week days
                $weekDays++;
            }
        }
    }

mysqli_close($conn);
?>