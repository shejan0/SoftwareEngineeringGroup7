<?php
session_start();
include_once "inc/user-connection.php";
$queryLastRow = "SELECT * FROM `hotel`.`hotel` Where hotelID = (SELECT MAX(hotelID) FROM `hotel`.`hotel`)";
$resultLastRow = mysqli_query($conn, $queryLastRow);
$lastID = mysqli_fetch_assoc($resultLastRow);
if ($lastID != NULL) $hotelID = $lastID['hotelID'] + 1;
else $hotelID = 1;
$hotelName = NULL;
$numRooms = NULL;
$weekendSurge = NULL;
$priceKing = NULL;
$priceQueen = NULL;
$priceStandard = NULL;
$numKing = NULL;
$numQueen = NULL;
$numStandard = NULL;

if (!isset($_SESSION['email'])) {
    header("Location: ../html/admin-sign-in.html");
}
// Process info when create (submit button) is clicked
if (isset($_POST["create"])) {    // all process provided below at each break point
    $hotelName = $_POST['hotelName'];

    if (!ctype_digit($_POST['numRooms'])) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter a positive integer for number of rooms";
        header("location: createProperty.php");
        exit();
    } else $numRooms = $_POST['numRooms'];

    if (!isset($_POST['king']) && !isset($_POST['queen']) && !isset($_POST['standard'])) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Please select at least one room.";
        header("location: createProperty.php");
        exit();
    }
    // number of rooms of each room type when all room types selected
    if (isset($_POST['king']) && isset($_POST['queen']) && isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.2);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numQueen = ($numRooms * 0.3);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $numStandard = ($numRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numKing + $numQueen + $numStandard;
        if ($currTotal > $numRooms) $numKing = $numKing - ($currTotal - $numRooms);
    }
    /* number of rooms of each type when 2 out of 3 types are selected
        * includes all combination */
    if (isset($_POST['king']) && isset($_POST['queen']) && !isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.5);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numQueen = ($numRooms * 0.5);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $currTotal = $numKing + $numQueen;
        if ($currTotal > $numRooms) $numKing = $numKing - ($currTotal - $numRooms);
    }
    if (isset($_POST['king']) && !isset($_POST['queen']) && isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.5);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numStandard = ($numRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numKing + $numStandard;
        if ($currTotal > $numRooms) $numKing = $numKing - ($currTotal - $numRooms);
    }
    if (!isset($_POST['king']) && isset($_POST['queen']) && isset($_POST['standard'])) {
        $numQueen = ($numRooms * 0.5);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $numStandard = ($numRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numQueen + $numStandard;
        if ($currTotal > $numRooms) $numQueen = $numQueen - ($currTotal - $numRooms);
    }
    /* number of rooms of each type when 1 out of 3 types are selected
        * includes all combination */
    if (isset($_POST['king']) && !isset($_POST['queen']) && !isset($_POST['standard'])) $numKing = $numRooms;
    if (!isset($_POST['king']) && isset($_POST['queen']) && !isset($_POST['standard'])) $numQueen = $numRooms;
    if (!isset($_POST['king']) && !isset($_POST['queen']) && isset($_POST['standard'])) $numStandard = $numRooms;

    // if king is selected but no price is entered
    if ((isset($_POST['king']) && empty($_POST['priceKing'])) || (isset($_POST['queen']) && empty($_POST['priceQueen'])) || (isset($_POST['standard']) && empty($_POST['priceStandard']))) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Missing price for rooms - enter price for selected rooms";
        header("location: createProperty.php");
        exit();
    }
    // if king is selected but price entered is not a valid input (has to be an int)
    else if ((isset($_POST['king']) && !ctype_digit($_POST['priceKing'])) || (isset($_POST['queen']) && !ctype_digit($_POST['priceQueen'])) || (isset($_POST['standard']) && !ctype_digit($_POST['priceStandard']))) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error - Invalid input: Only positive integer are allowed";
        header("location: createProperty.php");
        exit();
    }
    // if king isn't selected
    else if ((!isset($_POST['king']) && !empty($_POST['kingPrice'])) || (!isset($_POST['queen']) && !empty($_POST['priceQueen'])) || (!isset($_POST['standard']) && !empty($_POST['priceStandard']))) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: King not selected.";
        header("location: createProperty.php");
        exit();
    }
    // if no error assign price to room 
    $priceKing = $_POST['priceKing'];
    $priceQueen = $_POST['priceQueen'];   
    $priceStandard = $_POST['priceStandard'];

    if (!ctype_digit($_POST['weekendSurge'])){
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error - Invalid input: Only positive integer are allowed";
        header("location: createProperty.php");
        exit();
    }
    else $weekendSurge = $_POST['weekendSurge'];

    // insert property info into hotel table
    if (!empty($hotelName) && !empty($numRooms) && !empty($weekendSurge)) {
        $insertProp = "INSERT INTO `hotel`.`hotel` (hotelID, hotelName, number_of_rooms, weekendSurge, priceKing, priceQueen, priceStandard, numKing, numQueen, numStandard) 
            VALUES ('$hotelID', '$hotelName', '$numRooms', '$weekendSurge', '$priceKing', '$priceQueen', '$priceStandard', '$numKing', '$numQueen', '$numStandard')";
        $createProp = mysqli_query($conn, $insertProp);

        if (!$createProp) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error creating hotel property";
            header("location: createProperty.php");
            exit();
        }
        else {
            $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
            $_SESSION['message'] = "Successfully created " . $hotelName . " Property";
            header("location: createProperty.php");
            exit();
        }
    }

    // check and insert amenities to GenAmenities table
    if (isset($_POST['pool'])) {
        $ammenityID = 1;
        $ammenityName = $_POST['pool'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error adding amenities";
            header("location: createProperty.php");
            exit();
        }
    }

    if (isset($_POST['gym'])) {
        $ammenityID = 2;
        $ammenityName = $_POST['gym'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error adding amenities";
            header("location: createProperty.php");
            exit();
        }    }

    if (isset($_POST['spa'])) {
        $ammenityID = 3;
        $ammenityName = $_POST['spa'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error adding amenities";
            header("location: createProperty.php");
            exit();
        }    }

    if (isset($_POST['businessOffice'])) {
        $ammenityID = 4;
        $ammenityName = $_POST['businessOffice'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = "Error adding amenities";
            header("location: createProperty.php");
            exit();
        }    }
} 
// close connection
mysqli_close($conn);
