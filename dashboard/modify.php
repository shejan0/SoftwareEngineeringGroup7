<?php 
include_once "inc/session_start.php";
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";
$all_amenities = array();  

// modify property
if (isset($_POST["enter"])) {
    if (empty($_POST['hotelID'])) echo "Enter Hotel ID<br>";
    else if (!ctype_digit($_POST['hotelID'])) echo "Enter \"positive integer\" for Hotel ID<br>";
    else {
        $hotelID = $_POST['hotelID'];
        $hotelQuery = "SELECT * FROM `hotel`.`hotel` WHERE hotelID = $hotelID";
        $hotelResult = mysqli_query($conn, $hotelQuery);
        $hotelRow = mysqli_num_rows($hotelResult);

        // no hotel with id
        if ($hotelRow == 0){
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = 'Hotel Property with ID ' . $hotelID . ' does not exist';
             header("location: hotel.php");
             exit();
        }

        // found hotel
        else {
            $hotelProp = mysqli_fetch_assoc($hotelResult);
            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = 'Success: Found hotel ID - modify hotel below';
            $_SESSION['property'] = $hotelProp;
            header("location: updateProperty.php");
        }
    }
}
?>