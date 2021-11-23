<?php
include_once "inc/session_start.php";
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";

$all_amenities = array();
$hotelProp = $_SESSION['property'];
$hotelID = $hotelProp['hotelID'];
$header = "updateProperty.php";

// modify property
if (isset($_POST["enter"])) {
    // if user entered nothing for hotel ID
    if (empty($_POST['hotelID'])) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter hotel ID";
        header("location: hotel.php");
        exit();

        // if user entered an invalid input for hotel ID
    } else if (!ctype_digit($_POST['hotelID'])) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter a positive integer for ID only";
        header("location: hotel.php");
        exit();
    } else {
        $hotelID = $_POST['hotelID'];
        $hotelQuery = "SELECT * FROM `hotel`.`hotel` WHERE hotelID = $hotelID";
        $hotelResult = mysqli_query($conn, $hotelQuery);
        $hotelRow = mysqli_num_rows($hotelResult);

        // no hotel with id
        if ($hotelRow == 0) {
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
    $desc = $_POST['desc'];
    $imgLink = $_POST['imgLink'];


    if (isset($_POST['king']))
        $king = $_POST['king'];
    else
        $king = NULL;

    if (isset($_POST['queen']))
        $queen = $_POST['queen'];
    else
        $queen = NULL;
    if (isset($_POST['standard']))
        $standard = $_POST['standard'];
    else
        $standard = NULL;

    $priceKing = $_POST['priceKing'];
    $priceQueen = $_POST['priceQueen'];
    $priceStandard = $_POST['priceStandard'];

    if (isset($_POST['pool'])) $pool = $_POST['pool'];
    else $pool = NULL;
    if (isset($_POST['gym'])) $gym = $_POST['gym'];
    else $gym = NULL;
    if (isset($_POST['spa'])) $spa = $_POST['spa'];
    else $spa = NULL;
    if (isset($_POST['businessOffice'])) $businessOffice = $_POST['businessOffice'];
    else $businessOffice = NULL;

    $weekendSurge = $_POST['weekendSurge'];

    // if hotel name is not empty insert new hotel name
    if (!empty($hotelName)) {
        if ($hotelName != $hotelProp['hotelName']) {
            $updateQuery = "UPDATE `hotel`.`hotel` SET hotelName = '$hotelName' WHERE (hotelID = '$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);
            if (!$updateResult) {
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error updating hotel name";
                header("location: $header");
                exit();
            } 
                $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
                $_SESSION['message'] = "Successfully Updated Hotel Name to \"" . $hotelName . "\"";
            
        }
    }
    //update total rooms
    if (!empty($totalRooms)) {
        validateTotalRooms($totalRooms, $header);
        if ($totalRooms != $hotelProp['number_of_rooms']) {
            $updateQuery = "UPDATE `hotel`.`hotel` SET number_of_rooms='$totalRooms' WHERE (hotelID = '$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);
            if (!$updateResult) {
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error updating total number of hotel rooms";
                header("location: $header");
                exit();
            } 
                $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
                $_SESSION['message'] = "Successfully Updated total number of rooms to \"" . $totalRooms . "\"";
            
        }
    } else $totalRooms = $hotelProp['number_of_rooms'];

    [$numKing, $numQueen, $numStandard] = calcNumRooms($king, $queen, $standard, $totalRooms, $header);
    validatePrice($king, $queen, $standard, $priceKing, $priceQueen, $priceStandard, $header);

    $updateQuery = "UPDATE hotel.hotel SET numKing='$numKing', numQueen='$numQueen', numStandard='$numStandard', 
    priceKing='$priceKing', priceQueen='$priceQueen', priceStandard='$priceStandard' WHERE (hotelID='$hotelID')";
    $updateResult = mysqli_query($conn, $updateQuery);
    if (!$updateResult) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error updating hotel name";
        header("location: $header");
        exit();
    }
        $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
        $_SESSION['message'] = "Successfully Updated room types";
    
    if (!empty($weekendSurge)) {
        validateWeekendSurge($weekendSurge, $header);
        if ($weekendSurge != $hotelProp['weekendSurge']) {
            $updateQuery = "UPDATE `hotel`.`hotel` SET `weekendSurge`='$weekendSurge' WHERE (`hotelID` = '$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);
            if (!$updateResult) {
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error updating hotel name";
                header("location: $header");
                exit();            }
         
                $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
                $_SESSION['message'] = "Successfully Updated weekend surge to " . $weekendSurge;
        }
    }
    // delete amenity to then re-add based on updated amenities
    $deleteAmenitiesQuery = "DELETE FROM `hotel`.`GenAmenities` WHERE (`hotelID` = '$hotelID')";
    $deleteAmenitiesResult = mysqli_query($conn, $deleteAmenitiesQuery);
    // check and insert amenities to GenAmenities table
    validateAmenities($pool, $gym, $spa, $businessOffice, $hotelID, $header, $conn);
    if (!empty($desc)) {
        if ($desc != $hotelProp['desc']) {
            $updateQuery = "UPDATE `hotel`.`Descriptions` SET `hotelDesc`='$desc' WHERE (`hotelID` = '$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);
            if (!$updateResult) {
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error updating hotel name";
                header("location: $header");
                exit();            }
         
                $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
                $_SESSION['message'] = "Successfully Updated weekend surge to " . $weekendSurge;
        }
    }
    if (!empty($imgLink)) {
        if ($imgLink != $hotelProp['imgLink']) {
            $updateQuery = "UPDATE `hotel`.`Descriptions` SET `imageLink`='$imgLink' WHERE (`hotelID` = '$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);
            if (!$updateResult) {
                $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
                $_SESSION['message'] = "Error updating hotel name";
                header("location: $header");
                exit();            }
         
                $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
                $_SESSION['message'] = "Successfully Updated weekend surge to " . $weekendSurge;
        }
    }

    header("location: hotel.php");
    exit();
}

mysqli_close($conn);
