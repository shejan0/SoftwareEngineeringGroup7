<?php include_once "inc/user-connection.php"; ?>
<html lang="en-US">
    <head><title>Modify Property</title></head>
    <h1>Modify Property<h1>
    <form action="modifyProperty.php" method="post">
        <div><br><label for="hotelID"><h3>Enter Hotel ID of Hotel to be Modified (required):<h3></label><input type="text" name="hotelID"><br></div>
        <br><input type="submit" name="enter" value="Enter"><br>
    </form>
    <?php
        if(isset($_POST["enter"])) {
            if(empty($_POST['hotelID'])) echo "Enter Hotel ID<br>";
            else if(!ctype_digit($_POST['hotelID'])) echo "Enter \"non-zero integer\" for Hotel ID<br>";
            else $hotelID = $_POST['hotelID'];
            
            if(!empty($hotelID)) {
                $hotelQuery = "SELECT * FROM `hotel`.`hotel` WHERE hotelID = $hotelID";
                $hotelResult = mysqli_query($conn, $hotelQuery); 
                $hotelRow = mysqli_num_rows($hotelResult);
                if ($hotelRow == 0) echo 'Hotel Property with ID ' . $hotelID . ' does not exist';
                else {
                    $hotelProp = mysqli_fetch_assoc($hotelResult);
                    $hotelID = $hotelProp['hotelID'];  
                    echo "<h3>Current Hotel Info for Hotel ID " . $hotelID . "</h3>";
                    echo "Hotel Name: " . $hotelProp['hotelName'] . "<br>";
                    echo "Total number of rooms: " . $hotelProp['number_of_rooms'] . "<br>";
                    echo "Number of Standard Rooms: " . $hotelProp['numStandard'] . "<br>";
                    echo "Number of Queen Rooms: " . $hotelProp['numQueen'] . "<br>";
                    echo "Number of King Rooms: " . $hotelProp['numKing'] . "<br>";
                    echo "Price of Standard Rooms: " . $hotelProp['priceStandard'] . "<br>";
                    echo "Price of Queen Rooms: " . $hotelProp['priceQueen'] . "<br>";
                    echo "Price of King Rooms: " . $hotelProp['priceKing'] . "<br>";
                    echo "Weekend Surcharge: " . $hotelProp['weekendSurge'] . "<br>"; 
                    $amenityQuery = "SELECT * FROM `hotel`.`GenAmenities` WHERE hotelID = $hotelID";
                    $amenityResult = mysqli_query($conn, $amenityQuery); 
                    $amenityRows = mysqli_num_rows($amenityResult);
                    echo "Currently amenities for \"" . $hotelProp['hotelName'] . "\":";
                    if ($amenityRows == 0) echo "N/A<br>";
                    else while ($amenity = mysqli_fetch_assoc($amenityResult)) {
                        $all_amenities[] = $amenity['amenityName'];
                        echo " | " . $amenity['amenityName'] . " | ";
                    }
                    ?>
                    <h1>Fill fields to be Modified. Empty fields will not be modified</h1> <h3>Hotel ID: $hotelID</h3>
                    <form action="modifyProperty.php" method="post">
                        <div><br><label for="hotelName">Enter Hotel Name:</label><input type="text" name="hotelName"><br></div>
                        <div><br><label for="numRooms">Enter Total number of Rooms (required):</label> <input type="text" name="numRooms"><br></div>
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
                            <br><label>Enter Price for each Room Type included:
                            <br>(Note: Enter integer, no currency sign. Leave blank or enter 0 if no rooms of particular type)</label><br>
                            <label for="priceKing">Price for King</label> <input type="text" name="priceKing"><br>
                            <label for="priceQueen">Price for Queen</label> <input type="text" name="priceQueen"><br>
                            <label for="priceStandard">Price for Standard</label> <input type="text" name="priceStandard"><br>
                        </div>
                        <div><br><label for="weekendSurge">Enter Weekend Surcharge(Required):</label> <input type="text" name="weekendSurge"><br></div>
                        <br><input type="submit" name="modify" value="Modify Property"><br>
                    </form>               
    <?php
                }
            }
        }
        if (isset($_POST["modify"])) {    // all process provided below at each break point
            if (!empty($_POST['hotelName'])) 
                if ($_POST['hotelName'] != $hotelProp['hotelName']) {
                    $hotelName = $_POST['hotelName'];
                    $updateNameQuery = "UPDATE `hotel`.`hotel` SET hotelName = $hotelName WHERE hotelID=$hotelID";
                    $updateNameResult = mysqli_query($conn, $updateNameQuery);
                }
            else echo "Hotel Name field blank. Hotel Name unchaged<br>";

        }
        mysqli_close($conn);
    ?>
    <a href ="hotel.php">Back to Hotel Properties List</a>
</html>