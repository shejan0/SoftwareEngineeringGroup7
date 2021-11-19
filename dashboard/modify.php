<?php 
include_once "inc/session_start.php";
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";

$all_amenities = array();  
$hotelProp = $_SESSION['property'];
$hotelID = $hotelProp['hotelID'];
$header="updateProperty.php";

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

if (isset($_POST["modify"])) {    // all process provided below at each break point
    //initialize vars
    $hotelName = $_POST['hotelName'];
    $totalRooms = $_POST['totalRooms'];


    if(isset($_POST['king'])) 
        $king=$_POST['king'];
    else 
        $king=NULL;

    if(isset($_POST['queen']))
         $queen=$_POST['queen'];
    else 
        $queen=NULL;
    if(isset($_POST['standard'])) 
        $standard=$_POST['standard'];
    else
         $standard=NULL;

    $priceKing = $_POST['priceKing'];
    $priceQueen = $_POST['priceQueen'];   
    $priceStandard = $_POST['priceStandard'];
    
    if(isset($_POST['pool'])) $pool=$_POST['pool'];
    else $pool=NULL;
    if(isset($_POST['gym'])) $gym=$_POST['gym'];
    else $gym=NULL;
    if(isset($_POST['spa'])) $spa=$_POST['spa'];
    else $spa=NULL;
    if(isset($_POST['businessOffice'])) $businessOffice=$_POST['businessOffice'];
    else $businessOffice=NULL;

    $weekendSurge=$_POST['weekendSurge'];

    if (!empty($hotelName)) {
        if ($hotelName != $hotelProp['hotelName']) {
            $updateQuery = "UPDATE `hotel`.`hotel` SET hotelName = '$hotelName' WHERE (hotelID = '$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);
            if (!$updateResult){
                exit("<p class='error'>Error Updating Hotel Name: ($updateQuery) " . mysqli_error($conn) . "</p>");
            }
            echo "<p>Successfully Updated Hotel Name to \"" . $hotelName . "\"</p>";
        }
    }
    
    //update total rooms
    if (!empty($totalRooms)) {
        validateTotalRooms($totalRooms, $header);
        if ($totalRooms != $hotelProp['number_of_rooms']) {
            $updateQuery = "UPDATE `hotel`.`hotel` SET number_of_rooms='$totalRooms' WHERE (hotelID = '$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);
            if (!$updateResult) exit("<p class='error'>Error Updating Total Number of rooms: ($updateQuery) " . mysqli_error($conn) . "</p>");
            echo "<p>Successfully Updated Total Number of rooms to \"" . $totalRooms . "\"</p>";
        }
    }
    else $totalRooms = $hotelProp['number_of_rooms'];
    
    [$numKing, $numQueen, $numStandard] = calcNumRooms($king, $queen, $standard, $totalRooms, $header);
    validatePrice($king, $queen, $standard, $priceKing, $priceQueen, $priceStandard, $header);

    $updateQuery = "UPDATE hotel.hotel SET numKing='$numKing', numQueen='$numQueen', numStandard='$numStandard', 
    priceKing='$priceKing', priceQueen='$priceQueen', priceStandard='$priceStandard' WHERE (hotelID='$hotelID')";
    $updateResult = mysqli_query($conn, $updateQuery);
    if(!$updateResult) exit("<p class='error'>Error Updating Room Types' Values: ($updateQuery) " . mysqli_error($conn) . "</p>");
    echo "<p>Successfully updated room types' values<p>";

    if (!empty($weekendSurge)) {
        validateWeekendSurge($weekendSurge, $header);
        if ($weekendSurge != $hotelProp['weekendSurge']) {
            $updateQuery = "UPDATE `hotel`.`hotel` SET `weekendSurge`='$weekendSurge' WHERE (`hotelID` = '$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);
            if (!$updateResult) exit("<p class='error'>Error Updating Total Number of rooms: ($updateQuery) " . mysqli_error($conn) . "</p>");
            echo "<p>Successfully Updated Weekend Surge to \"" . $weekendSurge . "\"</p>";
        }
    }
    // delete amenity to then re-add based on updated amenities
    $deleteAmenitiesQuery = "DELETE FROM `hotel`.`GenAmenities` WHERE (`hotelID` = '$hotelID')";
    $deleteAmenitiesResult = mysqli_query($conn, $deleteAmenitiesQuery);
    // check and insert amenities to GenAmenities table
    validateAmenities($pool, $gym, $spa, $businessOffice, $hotelID, $header, $conn);
}

mysqli_close($conn);
?>