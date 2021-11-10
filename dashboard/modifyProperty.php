<?php
include_once "inc/user-connection.php";

if(isset($_POST["enter"])) {
    if(empty($_POST['hotelID'])) echo "Enter Hotel ID<br>";
    else if(!ctype_digit($_POST['hotelID'])) echo "Enter \"non-zero integer\" for Hotel ID<br>";
    else $hotelID = $_POST['hotelID'];
    
    $hotelRow = "SELECT * FROM `hotel`.`hotel` WHERE hotelID = $hotelID";
    $hotelProp = mysqli_query($conn, $hotelRow);
    if (!$hotelProp) exit( "<p class='error'>Error Hotel Property does not exist: ($addAmenity) " . mysqli_error($conn) . "</p>");
}

//echo "<p>Successfully Modified Hotel Property \"". $hotelName . "\"</p>";
mysqli_close($conn);

?>
<html lang="en-US">
    <form>
        <div><br><label for="hotelID">Enter Hotel ID of Hotel to be Modified (required):</label><input type="text" name="hotelID"><br></div>
        <br><input type="submit" name="enter" value="Enter"><br>
    </form>
    <a href ="hotel.php">Back to Hotel Properties List</a>
</html>