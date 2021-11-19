<?php
session_start();
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";
$header="updateProperty.php";
?>

<html>
    <?php
        if(isset($_SESSION['property'])) {
            $hotelProp = $_SESSION['property'];
            $hotelID = $hotelProp['hotelID'];
            echo "<h3>Current Hotel Info for Hotel ID " . $hotelID . "</h3>";
            echo "Hotel Name: " . $hotelProp['hotelName'] . "<br>";
            echo "Total number of rooms: " . $hotelProp['number_of_rooms'] . "<br>";
            echo "Number of King Rooms: " . $hotelProp['numKing'] . "<br>";
            echo "Number of Queen Rooms: " . $hotelProp['numQueen'] . "<br>";
            echo "Number of Standard Rooms: " . $hotelProp['numStandard'] . "<br>";
            echo "Price of King Rooms: " . $hotelProp['priceKing'] . "<br>";
            echo "Price of Queen Rooms: " . $hotelProp['priceQueen'] . "<br>";
            echo "Price of Standard Rooms: " . $hotelProp['priceStandard'] . "<br>";
            echo "Weekend Surcharge: " . $hotelProp['weekendSurge'] . "<br>"; 
            $amenityQuery = "SELECT * FROM `hotel`.`GenAmenities` WHERE hotelID = $hotelID";
            $amenityResult = mysqli_query($conn, $amenityQuery); 
            $amenityRows = mysqli_num_rows($amenityResult);
            echo "Currently amenities for \"" . $hotelProp['hotelName'] . "\": ";
            if ($amenityRows == 0) echo "N/A<br>";
            else {
                while ($amenity = mysqli_fetch_assoc($amenityResult)) {
                    $all_amenities[] = $amenity['amenityName'];
                    echo $amenity['amenityName'] . " ";
                }
            }
        }

    ?>
    <h3>Fill fields that need Modification.</h3> 
    <form action="updateProperty.php" method="post">
        <strong>Hotel ID: 
            <?php 
            $_POST['hotelID'] = $hotelID;
            echo $hotelID; 
        ?>
        </strong>
        <div><br><label for="hotelName">Enter Hotel Name (optional):</label><input type="text" name="hotelName"><br></div>
        <div><br><label for="totalRooms">Enter Total number of Rooms (optional):</label> <input type="text" name="totalRooms"><br></div>
        <div>
            <br><label>Select Amenities (optional):
            <br>(Note: All current amenitites are checked. To modify check aditional or uncheck current)</label><br>
            <label for="pool">Pool</label> <input type="checkbox" name="pool", value="pool"
            <?php if (in_array("pool", $all_amenities)) echo 'checked="checked"'; ?>><br>
            <label for="gym">Gym</label> <input type="checkbox" name="gym", value="gym" 
            <?php if (in_array("gym", $all_amenities)) echo 'checked="checked"'; ?>><br>
            <label for="spa">Spa</label> <input type="checkbox" name="spa", value="spa"
            <?php if (in_array("spa", $all_amenities)) echo 'checked="checked"'; ?>><br>
            <label for="businessOffice">Business Office</label> <input type="checkbox" name="businessOffice", value="businessOffice" 
            <?php if (in_array("businessOffice", $all_amenities)) echo 'checked="checked"'; ?>><br>
        </div>
        <div>
            <br><label>Select Room Types (at least one required):
            <br>(Note: All current types are checked.)</label><br>
            <label for="king">King</label> <input type="checkbox" name="king", value="king"
            <?php if ($hotelProp['numKing']>0) echo 'checked="checked"'; ?>><br>
            <label for="queen">Queen</label> <input type="checkbox" name="queen", value="queen"
            <?php if ($hotelProp['numQueen']>0) echo 'checked="checked"'; ?>><br>
            <label for="standard">Standard</label> <input type="checkbox" name="standard", value="standard"
            <?php if ($hotelProp['numStandard']>0) echo 'checked="checked"'; ?>><br>
        </div>
        <div>
            <br><label>Enter Price for each Room Type selected:
            <br>(Note: Current prices auto-filled, modify based on selected room types.)</label><br>
            <label for="priceKing">Price for King</label> <input type="text" name="priceKing" value=<?php echo $hotelProp['priceKing']; ?>><br>
            <label for="priceQueen">Price for Queen</label> <input type="text" name="priceQueen" value=<?php echo $hotelProp['priceQueen']; ?>><br>
            <label for="priceStandard">Price for Standard</label> <input type="text" name="priceStandard" value=<?php echo $hotelProp['priceStandard']; ?>><br>
        </div>
        <div><br><label for="weekendSurge">Enter Weekend Surcharge(optional):</label> <input type="text" name="weekendSurge"><br></div>
        <br><input type="submit" name="modify" value="Modify Property"><br>
    </form>
    <?php
    if (isset($_POST["modify"])) {    // all process provided below at each break point
            //initialize vars
            $hotelName = $_POST['hotelName'];
            $totalRooms = $_POST['totalRooms'];
            if(isset($_POST['king'])) $king=$_POST['king'];
            else $king=NULL;
            if(isset($_POST['queen'])) $queen=$_POST['queen'];
            else $queen=NULL;
            if(isset($_POST['standard'])) $standard=$_POST['standard'];
            else $standard=NULL;

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
                    if (!$updateResult) exit("<p class='error'>Error Updating Hotel Name: ($updateQuery) " . mysqli_error($conn) . "</p>");
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

            [$numKing, $numQueen, $numStandard] = calcNumRooms($king, $queen, $standard, $totalRooms, $header);
            validatePrice($king, $queen, $standard, $priceKing, $priceQueen, $priceStandard, $header);

            $updateQuery = "UPDATE `hotel`.`hotel` SET `numKing`='$numKing', `numQueen`='$numQueen', `numStandard`='$numStandard', 
            `priceKing`='$priceKing', `priceQueen`='priceQueen' `priceStandard`='$priceStandard' WHERE (`hotelID`='$hotelID')";
            $updateResult = mysqli_query($conn, $updateQuery);

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
</html>