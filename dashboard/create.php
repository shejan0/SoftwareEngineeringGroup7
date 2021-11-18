<?php
session_start();
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";

$queryLastRow = "SELECT * FROM `hotel`.`hotel` Where hotelID = (SELECT MAX(hotelID) FROM `hotel`.`hotel`)";
$resultLastRow = mysqli_query($conn, $queryLastRow);
$lastID = mysqli_fetch_assoc($resultLastRow);
if ($lastID != NULL) $hotelID = $lastID['hotelID'] + 1;
else $hotelID = 1;
$header = "createProperty.php";

if (!isset($_SESSION['email'])) {
    header("Location: ../html/admin-sign-in.php");
}
// Process info when create (submit button) is clicked
if (isset($_POST["create"])) {    // all process provided below at each break point
    // assign all values from $_post before validation
    $hotelName = $_POST['hotelName'];
    $totalRooms = $_POST['totalRooms'];
    $king=$_POST['king'];
    $queen=$_POST['queen'];
    $standard=$_POST['standard'];
    $priceKing = $_POST['priceKing'];
    $priceQueen = $_POST['priceQueen'];   
    $priceStandard = $_POST['priceStandard'];
    $pool = $_POST['pool'];
    $gym = $_POST['gym'];
    $spa = $_POST['spa'];
    $businessOffice = $_POST['businessOffice'];
    $weekendSurge=$_POST['weekendSurge'];

    
    validateTotalRooms($totalRooms, $header);
    [$numKing, $numQueen, $numStandard] = calcNumRooms($king, $queen, $standard, $totalRooms, $header);
    validatePrice($king, $queen, $standard, $priceKing, $priceQueen, $priceStandard, $header);
    validateWeekendSurge($weekendSurge, $header);

    if(!empty($hotelName) && !empty($totalRooms) && !empty($weekendSurge)) {
        // all validation done, insert property info into hotel table
        $insertProp = "INSERT INTO `hotel`.`hotel` (hotelID, hotelName, number_of_rooms, weekendSurge, priceKing, priceQueen, priceStandard, numKing, numQueen, numStandard) 
            VALUES ('$hotelID', '$hotelName', '$totalRooms', '$weekendSurge', '$priceKing', '$priceQueen', '$priceStandard', '$numKing', '$numQueen', '$numStandard')";
        $createProp = mysqli_query($conn, $insertProp);

        if (!$createProp) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error creating hotel property";
            header("location: $header");
            exit();
        }
        else {
            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = "Successfully created " . $hotelName . " Property";
            header("location: $header");
        }
    }
    // check and insert amenities to GenAmenities table
    validateAmenities($pool, $gym, $spa, $businessOffice, $hotelID, $header, $conn);
    // if (isset($pool)) {
    //     $amenityID = 1;
    //     $amenityName=$pool;
    //     $addQuery = "INSERT INTO `hotel`.`GenAmenities` (hotelID, amenityID, amenityName)
    //     VALUES ('$hotelID','$amenityID', '$amenityName')";
    //     $addResult = mysqli_query($conn, $addQuery);
    //     if (!$addResult) {
    //         $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
    //         $_SESSION['message'] = "Error adding amenities";
    //         header("location: $header");
    //         exit();
    //     }
    // }
    // if (isset($gym)) {
    //     $amenityID = 2;
    //     $amenityName=$gym;
    //     $addQuery = "INSERT INTO `hotel`.`GenAmenities` (hotelID, amenityID, amenityName) VALUES ('$hotelID','$amenityID', '$amenityName')";
    //     $addResult = mysqli_query($conn, $addQuery);
    //     if (!$addResult) {
    //         $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
    //         $_SESSION['message'] = "Error adding amenities";
    //         header("location: $header");
    //         exit();
    //     }
    // }
    // if (isset($spa)) {
    //     $amenityID = 3;
    //     $amenityName=$spa;
    //     $addQuery = "INSERT INTO `hotel`.`GenAmenities` (hotelID, amenityID, amenityName) VALUES ('$hotelID','$amenityID', '$amenityName')";
    //     $addResult = mysqli_query($conn, $addQuery);
    //     if (!$addResult) {
    //         $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
    //         $_SESSION['message'] = "Error adding amenities";
    //         header("location: $header");
    //         exit();
    //     }
    // }
    // if (isset($businessOffice)) {
    //     $amenityID = 4;
    //     $amenityName=$businessOffice;
    //     $addQuery = "INSERT INTO `hotel`.`GenAmenities` (hotelID, amenityID, amenityName) VALUES ('$hotelID','$amenityID', '$amenityName')";
    //     $addResult = mysqli_query($conn, $addQuery);
    //     if (!$addResult) {
    //         $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
    //         $_SESSION['message'] = "Error adding amenities";
    //         header("location: $header");
    //         exit();
    //     }
    // }
} 

// close connection
mysqli_close($conn);
