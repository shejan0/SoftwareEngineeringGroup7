<?php
include_once "inc/user-connection.php";

if(isset($_POST["enter"])) {
    
//echo "<p>Successfully Modified Hotel Property \"". $hotelName . "\"</p>";


?>
<html lang="en-US">
    <form action="modifyProperty.php" method="post">
        <div><br><label for="hotelID">Enter Hotel ID of Hotel to be Modified (required):</label><input type="text" name="hotelID"><br></div>
        <br><input type="submit" name="enter" value="Enter"><br>
        <?php 
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
                    $hotelID = $hotelProp['hotelID']
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
                }
            }
        ?>
    </form>
    
    <h1>Fill form to Modify property</h1>
    <h3>Hotel ID: <?php echo $hotelID?></h3>
    <p>Fields left blank will remain unchanged.<p>

    <!-- Main form for property creation -->
    <form action="modifyProperty.php" method="post">
        <div><br><label for="hotelName">Enter Hotel Name:</label><input type="text" name="hotelName"><br></div>
        <?php
            $hotelName = $_POST['hotelName'];
            if(!empty($hotelName) && $hotelName != $hotelProp['hotelName']) {
                $updateProp = "UPDATE `hotel`.`hotel` SET hotelName = $hotelName WHERE hotelID = $hotelID"; 
                $modifyProp = mysqli_query($conn, $updateProp);
                if (!$modifyProp) exit( "<p class='error'>Error Creating Hotel Property: ($updateProp) " . mysqli_error($conn) . "</p>");
            }
        ?>
        <div><br><label for="numRooms">Enter Total number of Rooms (required):</label> <input type="text" name="numRooms"><br></div>
        <?php    
            $numRooms = $_POST['numRooms'];
            if(!empty($numRooms) && $numRooms != $hotelProp['number_of_rooms']) {
                $updateProp = "UPDATE `hotel`.`hotel` SET number_of_rooms = $numRooms WHERE hotelID = $hotelID"; 
                $modifyProp = mysqli_query($conn, $updateProp);
                if (!$modifyProp) exit( "<p class='error'>Error Creating Hotel Property: ($updateProp) " . mysqli_error($conn) . "</p>");
            }
        ?>
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
            <?php
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
            ?>
        </div>
        
        <div>
            <br><label>Enter Price for each Room Type included:
            <br>- Enter integer, no currency sign.
            <br>- Leave blank or enter 0 if no rooms of particular type:</label><br>
            <label for="priceKing">Price for King</label> <input type="text" name="priceKing"><br>
            <?php
                if(isset($_POST['king']) && empty($_POST['priceKing'])) echo "Enter price of King type room<br>";
                else if(!ctype_digit($_POST['priceKing'])) echo "Enter \"non-zero integer\" for Price of King <br>";
                if(!isset($_POST['king']) && (!empty($_POST['kingPrice']))) echo "King type not selected. Leave blank or enter 0 for price of King<br>";
                $priceKing = $_POST['priceKing'];
            ?>
            <label for="priceQueen">Price for Queen</label> <input type="text" name="priceQueen"><br>
            <?php
                if(isset($_POST['queen']) && empty($_POST['priceQueen'])) echo "Enter price of Queen type room<br>";
                else if(!ctype_digit($_POST['priceQueen'])) echo "Enter \"non-zero integer\" for price of Queen<br>";
                if(!isset($_POST['queen']) && (!empty($_POST['priceQueen']))) echo "Queen type not selected. Leave blank or enter 0 for price of Queen<br>";
                $priceQueen = $_POST['priceQueen'];
            ?>
            <label for="priceStandard">Price for Standard</label> <input type="text" name="priceStandard"><br>
            <?php
                if(isset($_POST['standard']) && empty($_POST['priceStandard'])) echo "Enter price of Standard type room<br>";
                else if(!ctype_digit($_POST['priceStandard'])) echo "Enter Integer for price of Standard<br>";
                if(!isset($_POST['standard']) && (!empty($_POST['priceStandard']))) echo "Standard type not selected. Leave blank or enter 0 for price of Standard<br>";
                $priceStandard = $_POST['priceStandard'];
            ?>
        </div>
        <div><br><label for="weekendSurge">Enter Weekend Surcharge(Required):</label> <input type="text" name="weekendSurge"><br></div>
        <?php 
            if(empty($_POST['weekendSurge']))  echo "Enter Weekend Surge<br>";
            else if(!ctype_digit($_POST['weekendSurge'])) echo "Enter \"non-zero integer\" for Weekend Surge<br>";
            else $weekendSurge = $_POST['weekendSurge'];
        ?>
        <br><input type="submit" name="create" value="Create Property"><br>
    </form>

    <!-- database management -->
    <?php
        // insert property info into hotel table
        

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
    <a href ="hotel.php">Back to Hotel Properties List</a>
</html>