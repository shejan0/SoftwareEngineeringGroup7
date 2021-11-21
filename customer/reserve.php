<?php
session_start();
include_once "../php/inc/user-connection.php";
/*$queryLastRow = "SELECT * FROM Reservation Where reservationID = (SELECT MAX(reservationID) FROM Reservation)";
$resultLastRow = mysqli_query($conn, $queryLastRow);
$lastID = mysqli_fetch_assoc($resultLastRow);
if ($lastID != NULL) $reservationID = $lastID['reservationID'] + 1;
else */$reservationID = 1;
$hotelID  = NULL;
$roomType = NULL;
$email = "ERROR";
$arrival = "1990-01-01";
$departure = "1990-01-02"; 
$totalPrice = -1;
$numRes = NULL;
$cancelled = 0;

$numDays = NULL;
$roomPrice = -1;
$weekDays = 0;
$weekendDays = 0;
$surgePrice = -1;

    if(isset($_POST['submit']))
    {
        $dates = $_POST['bookingDate'];
        $numRes = $_POST['rooms'];
        $roomType = $_POST['type'];
        $hotelID = $_POST['hotelID'];
        $email = $_SESSION['email'];
        $dateRange = explode(" to", $dates);
        $arrival = trim($dateRange[0]);
        $departure = trim($dateRange[1]);
        

        $begin = new DateTime(strval( $arrival ));
        $end   = new DateTime(strval( $departure ));
        //Loop through days and identify number of weekend days and week days
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
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

        if($roomType == "Standard"){
            $queryPrice = "SELECT * FROM hotel Where hotelID = $hotelID";
            $result = mysqli_query($conn, $queryPrice);
            $arr = mysqli_fetch_assoc($resultPrice);
            $roomPrice = $arr['priceStandard'];
            $surgePrice = $roomPrice * (1 + ($arr['weekendSurge'] / 100));
        }
        else if($roomType == "Queen"){
            $queryPrice = "SELECT priceQueen, weekendSurge FROM 'hotel'.'hotel' Where hotelID = $hotelID";
            $resultPrice = mysquli_query($conn, $queryPrice);
            $arrPrice = mysqli_fetch_assoc($resultPrice);
            $roomPrice = $arrPrice['priceQueen'];
            $surgePrice = $roomPrice * (1 + $arrPrice['weekendSurge']);
        }
        else if($roomType == "King"){
            $queryPrice = "SELECT priceking, weekendSurge FROM 'hotel'.'hotel' Where hotelID = $hotelID";
            $resultPrice = mysquli_query($conn, $queryPrice);
            $arrPrice = mysqli_fetch_assoc($resultPrice);
            $roomPrice = $arrPrice['priceKing'];
            $surgePrice = $roomPrice * (1 + $arrPrice['weekendSurge']);
        }

        $totalPrice = (($roomPrice * $weekDays) + ($surgePrice * $weekendDays)) * $numRes;

        //Separate $dates into arrival and departure dates
        /*
        $pattern = '{(\d+-\d+-\d+) to (\d+-\d+-\d+)}';
        if(preg_match($pattern, $dates, $matches)){
            $arrival = $matches[1];
            $departure = $matches[2];
        }*/
        
    }
    ?>
    <html>
        <body>
            <?php
            echo $hotelID;
            echo $reservationID;
            echo $roomType;
            echo $email;
            echo $arrival;
            echo $departure;
            echo $totalPrice;
            echo $numRes;
            ?>
        </body>
    </html>
    <?php
    mysqli_close($conn);
?>