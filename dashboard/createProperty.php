<?php
include_once "inc/user-connection.php";
$queryLastRow = "SELECT * FROM `hotel`.`hotel` Where hotelID = (SELECT MAX(hotelID) FROM `hotel`.`hotel`)";
$resultLastRow = mysqli_query($conn, $queryLastRow);
$lastID = mysqli_fetch_assoc($resultLastRow);
// hotel property variables
$hotelID = $lastID['hotelID'] + 1;
$hotelName = NULL;
$numRooms = NULL;
$weekendSurge = NULL;
$priceKing = NULL;
$priceQueen = NULL;
$priceStandard = NULL;
$numKing = NULL;
$numQueen = NULL;
$numStandard = NULL;

// Process info when create (submit button) is clicked
if(isset($_POST["create"])) {    // all process provided below at each break point
    if(empty($_POST['hotelName'])) echo "Enter Hotel Name<br>";
    else $hotelName = $_POST['hotelName'];

    if(empty($_POST['numRooms']))  echo "Enter Total Number of Rooms<br>"; 
    else if(!ctype_digit($_POST['numRooms'])) echo "Enter \"non-zero integer\" for Total Number of Rooms<br>";
    else $numRooms = $_POST['numRooms'];

    if(!isset($_POST['king']) && !isset($_POST['queen']) && !isset($_POST['standard'])) echo "Select at least one room type<br>"; 
    // number of rooms of each room type when all room types selected
    if(isset($_POST['king']) && isset($_POST['queen']) && isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.2);
        if(($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);
    
        $numQueen = ($numRooms * 0.3);
        if(($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $numStandard = ($numRooms * 0.5);
        if(($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);
    }
    /* number of rooms of each type when 2 out of 3 types are selected
        * includes all combination */
    if(isset($_POST['king']) && isset($_POST['queen']) && !isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.5);
        if(($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);
    
        $numQueen = ($numRooms * 0.5);
        if(($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);
    }
    if(isset($_POST['king']) && !isset($_POST['queen']) && isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.5);
        if(($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numStandard = ($numRooms * 0.5);
        if(($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);
    }
    if(!isset($_POST['king']) && isset($_POST['queen']) && isset($_POST['standard'])) {
        $numQueen = ($numRooms * 0.5);
        if(($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $numStandard = ($numRooms * 0.5);
        if(($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);
    }
    /* number of rooms of each type when 1 out of 3 types are selected
        * includes all combination */
    if(isset($_POST['king']) && !isset($_POST['queen']) && !isset($_POST['standard'])) $numKing = $numRooms;
    if(!isset($_POST['king']) && isset($_POST['queen']) && !isset($_POST['standard'])) $numQueen = $numRooms;
    if(!isset($_POST['king']) && !isset($_POST['queen']) && isset($_POST['standard'])) $numStandard = $numRooms;

    if(isset($_POST['king']) && empty($_POST['priceKing'])) echo "Enter price of King type room<br>";
    else if(!ctype_digit($_POST['priceKing'])) echo "Enter \"non-zero integer\" for Price of King <br>";
    if(!isset($_POST['king']) && (!empty($_POST['kingPrice']))) echo "King type not selected. Leave blank or enter 0 for price of King<br>";
    $priceKing = $_POST['priceKing'];

    if(isset($_POST['queen']) && empty($_POST['priceQueen'])) echo "Enter price of Queen type room<br>";
    else if(!ctype_digit($_POST['priceQueen'])) echo "Enter \"non-zero integer\" for price of Queen<br>";
    if(!isset($_POST['queen']) && (!empty($_POST['priceQueen']))) echo "Queen type not selected. Leave blank or enter 0 for price of Queen<br>";
    $priceQueen = $_POST['priceQueen'];

    if(isset($_POST['standard']) && empty($_POST['priceStandard'])) echo "Enter price of Standard type room<br>";
    else if(!ctype_digit($_POST['priceStandard'])) echo "Enter Integer for price of Standard<br>";
    if(!isset($_POST['standard']) && (!empty($_POST['priceStandard']))) echo "Standard type not selected. Leave blank or enter 0 for price of Standard<br>";
    $priceStandard = $_POST['priceStandard'];

    if(empty($_POST['weekendSurge']))  echo "Enter Weekend Surge<br>";
    else if(!ctype_digit($_POST['weekendSurge'])) echo "Enter \"non-zero integer\" for Weekend Surge<br>";
    else $weekendSurge = $_POST['weekendSurge'];

    // insert property info into hotel table
    if(!empty($hotelName) && !empty($numRooms) && !empty($weekendSurge)) {
        $insertProp = "INSERT INTO `hotel`.`hotel` (hotelID, hotelName, number_of_rooms, weekendSurge, priceKing, priceQueen, priceStandard, numKing, numQueen, numStandard) 
            VALUES ('$hotelID', '$hotelName', '$numRooms', '$weekendSurge', '$priceKing', '$priceQueen', '$priceStandard', '$numKing', '$numQueen', '$numStandard')";
        $createProp = mysqli_query($conn, $insertProp);

        if (!$createProp) exit( "<p class='error'>Error Creating Hotel Property: ($insertProp) " . mysqli_error($conn) . "</p>");
        echo "<p>Successfully Created Hotel Property \"". $hotelName . "\"</p>";
    }

    // check and insert amenities to GenAmenities table
    if(isset($_POST['pool'])) {
        $ammenityID = 1;
        $ammenityName = $_POST['pool'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) exit( "<p class='error'>Error Adding Amenity to Hotel Property: ($addAmenity) " . mysqli_error($conn) . "</p>");
    }

    if(isset($_POST['gym'])) {
        $ammenityID = 2;
        $ammenityName = $_POST['gym'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) exit( "<p class='error'>Error Adding Amenity to Hotel Property: ($addAmenity) " . mysqli_error($conn) . "</p>");
    }

    if(isset($_POST['spa'])) {
        $ammenityID = 3;
        $ammenityName = $_POST['spa'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) exit( "<p class='error'>Error Adding Amenity to Hotel Property: ($addAmenity) " . mysqli_error($conn) . "</p>");
    }

    if(isset($_POST['businessOffice'])) {
        $ammenityID = 4;
        $ammenityName = $_POST['businessOffice'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) exit( "<p class='error'>Error Adding Amenity to Hotel Property: ($addAmenity) " . mysqli_error($conn) . "</p>");
    }
    
}   // close big if statement for when create (submit) is clicked


mysqli_close($conn);



?>

<html lang="en-US">
    <head><title>Create/Modify Property</title></head>
    <body>
        <h1>Fill form to create property</h1>
        <h3>Hotel ID: <?php echo $hotelID?></h3>
        
        <!-- Main form for property creation -->
        <form action="createProperty.php" method="post">
            <div><br><label for="hotelName">Enter Hotel Name (required):</label><input type="text" name="hotelName"><br></div>
            <div><br><label for="numRooms">Enter Total number of Rooms (required):</label> <input type="text" name="numRooms"><br></div>
            <div>
                <br><label>Select Amenities (optional):</label> <br>
                <label for="pool">Pool</label> <input type="checkbox" name="pool", value="pool"><br>
                <label for="gym">Gym</label> <input type="checkbox" name="gym", value="gym"><br>
                <label for="spa">Spa</label> <input type="checkbox" name="spa", value="spa"><br>
                <label for="businessOffice">Business Office</label> <input type="checkbox" name="businessOffice", value="businessOffice"><br>
            </div>
            <div>
                <br><label>Select Room Types (at least one required):</label><br>
                <label for="king">King</label> <input type="checkbox" name="king", value="king"><br>
                <label for="queen">Queen</label> <input type="checkbox" name="queen", value="queen"><br>
                <label for="standard">Standard</label> <input type="checkbox" name="standard", value="standard"><br>
            </div>
            
            <div>
                <br><label>Enter Price for each Room Type included:
                <br>- Enter integer, no currency sign.
                <br>- Leave blank or enter 0 if no rooms of particular type:</label><br>
                <label for="priceKing">Price for King</label> <input type="text" name="priceKing"><br>
                <label for="priceQueen">Price for Queen</label> <input type="text" name="priceQueen"><br>
                <label for="priceStandard">Price for Standard</label> <input type="text" name="priceStandard"><br>
            </div>
            <div><br><label for="weekendSurge">Enter Weekend Surcharge(Required):</label> <input type="text" name="weekendSurge"><br></div>
            <br><input type="submit" name="create" value="Create Property"><br>
        </form>
        <a href ="hotel.php">Back to Hotel Properties List</a>
    <body>
</html>
