<?php
session_start();
include_once "../php/inc/user-connection.php";


$id = $_GET['hotelID'];
$date = $_GET['bookingDate'];
$dateRange = explode(" to", $_GET['bookingDate']);
$start = trim($dateRange[0]);
$end = trim($dateRange[1]);
$numRooms = $_GET['rooms'];
$roomType = $_GET['type'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$weekDays = 0;
$weekendDays = 0;


$begin = new DateTime(strval( $start ));
$end   = new DateTime(strval( $end ));
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

// gets number of rooms for each room type
echo $id;
print_r($conn);
$query = "SELECT * from hotel where hotelID = \"$id\"";
$resultr = $conn->query($query);
if(!$resultr){
    echo mysqli_error($conn);   
}
$records = mysqli_fetch_assoc($resultr);

if (isset($_GET['book'])) {
    if ($roomType == 'standard' && !empty($date)) {

        // if room avaliable
        if ($numRooms <= $records['numStandard']) {
            $price = (($numRooms * $records['priceStandard']) * 1.0825) * $weekDays 
                        + (($numRooms * $records['priceStandard']) * 1.0825) * $weekendDays * (1 + $records['weekendSurge'] / 100);
            $insert = "INSERT into reservation (hotelID,hotelName,roomType,email,arrivalDate,departureDate,totalPrice,numRoom) 
                        values ('$id','$records[hotelName]','$roomType','$email','$start','$end','$price','$numRooms');";

            // insert reseravation into table
            $insertResult = mysqli_query($conn, $insert);

            if (!$insertResult || !$updateResult) {
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
    } else if ($roomType == 'queen' && !empty($date)) {
        // if room avaliable
        if ($numRooms <= $records['numQueen']) {
            $price = ($numRooms * $records['priceQueen']) * 1.0825;
            $insert = "INSERT into reservation (hotelID,hotelName,roomType,email,arrivalDate,departureDate,totalPrice,numRoom) 
                        values ('$id','$records[hotelName]','$roomType','$email','$start','$end','$price','$numRooms');";

            $insertResult = mysqli_query($conn, $insert);

            if (!$insertResult || !$updateResult) {
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
    } else if ($roomType == 'king' && !empty($date)) {
        if ($numRooms <= $records['numKing']) {
            $price = ($numRooms * $records['priceKing']) * 1.0825;
            $insert = "INSERT into reservation (hotelID,hotelName,roomType,email,arrivalDate,departureDate,totalPrice,numRoom) 
                        values ('$id','$records[hotelName]','$roomType','$email','$start','$end','$price','$numRooms');";

            $insertResult = mysqli_query($conn, $insert);
            
            if (!$insertResult || !$updateResult) {
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
    } else {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter valid dates.";
        header("location: room-details.php?" . $_SERVER['QUERY_STRING']);
        exit();
    }
}
