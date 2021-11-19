<<<<<<< HEAD
<?php 
include_once "../dashboard/inc/session_start.php";
include_once "../dashboard/inc/head.php";
include_once "../dashboard/inc/side-bar.php";

=======
<?php
include_once "../dashboard/inc/session_start.php";
>>>>>>> a188ebceb0c3223215768eb9a587148defe7d714
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";

$all_amenities = array();
$hotelProp = $_SESSION['property'];
$hotelID = $hotelProp['hotelID'];
$header = "updateProperty.php";
<<<<<<< HEAD
$all_amenities = array();  
include_once "../dashboard/inc/header.php";
?>
<main class="content bg-white">
    <?php include_once "../dashboard/inc/header.php"; ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href=" <?php echo basename(__FILE__) ?>"><?php echo basename(__FILE__, '.php') ?>
                            </a>
                        </li>
                    </ol>
                </nav>
                <h2 class="h4">Hotel</h2>
                <p class="mb-0">Hotel table - add or edit hotels.</p>
            </div>
       
        <div class="btn mb-2 mb-md-0">
            <a href="../property/createProperty.php" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2">Add Property </a>
            <a href="../property/modifyProperty.php"class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2">ModifyProperty </a>
        </div>
</div>
    <form action="modifyProperty.php" method="post">
        <div><br><label for="hotelID"><h3>Enter Hotel ID of Hotel to be Modified (required):</h3></label><input type="text" name="hotelID"><br></div>
        <br><input type="submit" name="enter" value="Enter"><br>
    </form>
    <?php
        if(isset($_POST["enter"])) {
            if(empty($_POST['hotelID'])) echo "Enter Hotel ID<br>";
            else if(!ctype_digit($_POST['hotelID'])) echo "Enter \"positive integer\" for Hotel ID<br>";
            else {
                $hotelID = $_POST['hotelID'];
                $hotelQuery = "SELECT * FROM `hotel`.`hotel` WHERE hotelID = $hotelID";
                $hotelResult = mysqli_query($conn, $hotelQuery); 
                $hotelRow = mysqli_num_rows($hotelResult);
                if ($hotelRow == 0) echo 'Hotel Property with ID ' . $hotelID . ' does not exist';
                else {
                    $hotelProp = mysqli_fetch_assoc($hotelResult);
                    $_SESSION['property'] = $hotelProp;
                    header("location: $header");
                }
=======
$hotelList = "../dashboard/hotel.php";

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
        if ($hotelRow == 0) {
            $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
            $_SESSION['message'] = 'Hotel Property with ID ' . $hotelID . ' does not exist';
            header("location: $hotelList");
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
            } else {
                $_SESSION['alert'] = "alert alert-success alert-dismissible fade show";
                $_SESSION['message'] = "Successfully Updated Hotel Name to \"" . $hotelName . "\"";
                header("location: $hotelList");
                exit();
>>>>>>> a188ebceb0c3223215768eb9a587148defe7d714
            }
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
    } else $totalRooms = $hotelProp['number_of_rooms'];

    [$numKing, $numQueen, $numStandard] = calcNumRooms($king, $queen, $standard, $totalRooms, $header);
    validatePrice($king, $queen, $standard, $priceKing, $priceQueen, $priceStandard, $header);

    $updateQuery = "UPDATE hotel.hotel SET numKing='$numKing', numQueen='$numQueen', numStandard='$numStandard', 
    priceKing='$priceKing', priceQueen='$priceQueen', priceStandard='$priceStandard' WHERE (hotelID='$hotelID')";
    $updateResult = mysqli_query($conn, $updateQuery);
    if (!$updateResult) exit("<p class='error'>Error Updating Room Types' Values: ($updateQuery) " . mysqli_error($conn) . "</p>");
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
