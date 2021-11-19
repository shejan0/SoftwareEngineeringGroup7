<?php 
session_start();
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";

$header = "modifyProperty.php";
$all_amenities = array();  
?>
<html lang="en-US">
    <head><title>Modify Property</title></head>
    <h1>Modify Property</h1>
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
                    header("location: updateProperty.php");
                }
            }
        }

        mysqli_close($conn);
    ?>
    <br><a href ="../dashboard/hotel.php">Back to Hotel Properties List</a>
</html>