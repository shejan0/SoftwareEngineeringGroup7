<?php 

function validateTotalRooms($totalRooms, $header) {
    if (!ctype_digit($totalRooms)) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Enter a positive integer for number of rooms";
        header("location: $header");
        exit();
    }
}

function validateWeekendSurge($weekendSurge, $header) {
    if (!ctype_digit($weekendSurge)){
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error - Invalid input: Only positive integer are allowed";
        header("location: $header");
        exit();
    }
}

function calcNumRooms($king, $queen, $standard, $totalRooms, $header) {
    $numKing = 0;
    $numQueen = 0;
    $numStandard = 0;
    if (!isset($king) && !isset($queen) && !isset($standard)) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Please select at least one room type.";
        header("location: $header");
        exit();
    }
    // number of rooms of each room type when all room types selected
    if (isset($king) && isset($queen) && isset($standard)) {
        $numKing = ($totalRooms * 0.2);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numQueen = ($totalRooms * 0.3);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $numStandard = ($totalRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numKing + $numQueen + $numStandard;
        if ($currTotal > $totalRooms) $numKing = $numKing - ($currTotal - $totalRooms);
    }
    /* number of rooms of each type when 2 out of 3 types are selected
        * includes all combination */
    if (isset($king) && isset($queen) && !isset($standard)) {
        $numKing = ($totalRooms * 0.5);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numQueen = ($totalRooms * 0.5);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $currTotal = $numKing + $numQueen;
        if ($currTotal > $totalRooms) $numKing = $numKing - ($currTotal - $totalRooms);
    }
    if (isset($king) && !isset($queen) && isset($standard)) {
        $numKing = ($totalRooms * 0.5);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numStandard = ($totalRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numKing + $numStandard;
        if ($currTotal > $totalRooms) $numKing = $numKing - ($currTotal - $totalRooms);
    }
    if (!isset($king) && isset($queen) && isset($standard)) {
        $numQueen = ($totalRooms * 0.5);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $numStandard = ($totalRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numQueen + $numStandard;
        if ($currTotal > $totalRooms) $numQueen = $numQueen - ($currTotal - $totalRooms);
    }
    /* number of rooms of each type when 1 out of 3 types are selected
        * includes all combination */
    if (isset($king) && !isset($queen) && !isset($standard)) $numKing = $totalRooms;
    if (!isset($king) && isset($queen) && !isset($standard)) $numQueen = $totalRooms;
    if (!isset($king) && !isset($queen) && isset($standard)) $numStandard = $totalRooms;

    return [$numKing, $numQueen, $numStandard];
}

function validatePrice($king, $queen, $standard, $priceKing, $priceQueen, $priceStandard, $header) {
    // if no price is entered for selected type
    if ((isset($king) && empty($priceKing)) || (isset($queen) && empty($priceQueen)) || (isset($standard) && empty($priceStandard))) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Missing price for rooms - enter price for selected rooms";
        header("location: $header");
        exit();
    }
    // if price entered is not a valid input (has to be an int)
    else if ((isset($king) && !ctype_digit($priceKing)) || (isset($queen) && !ctype_digit($priceQueen)) || (isset($standard) && !ctype_digit($priceStandard))) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error - Invalid input for price: Only positive integer are allowed";
        header("location: $header");
        exit();
    }
    // if price entered for a type that's not selected
    else if ((!isset($king) && !empty($priceKing)) || (!isset($queen) && !empty($priceQueen)) || (!isset($standard) && !empty($priceStandard))) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error: Price entered for a non-selected type.";
        header("location: $header");
        exit();
    }
}
function validateAmenities($pool, $gym, $spa, $businessOffice, $hotelID, $header, $conn) {
    if (isset($pool)) {
        $amenityID = 1;
        addAmenity($pool, $amenityID, $hotelID, $header, $conn);
    }
    if (isset($gym)) {
        $amenityID = 2;
        addAmenity($gym, $amenityID, $hotelID, $header, $conn);
    }
    if (isset($spa)) {
        $amenityID = 3;
        addAmenity($spa, $amenityID, $hotelID, $header, $conn);
    }
    if (isset($businessOffice)) {
        $amenityID = 4;
        addAmenity($businessOffice, $amenityID, $hotelID, $header, $conn);
    }
}

function addAmenity($amenityName, $amenityID, $hotelID, $header, $conn) {
    $addQuery = "INSERT INTO `hotel`.`amenities` (hotelID, amenityID, amenityName) VALUES ('$hotelID','$amenityID', '$amenityName')";
    $addResult = mysqli_query($conn, $addQuery);
    if (!$addResult) {
        $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
        $_SESSION['message'] = "Error adding amenities";
        header("location: $header");
        exit();
    }
    return $addResult;
}

?>