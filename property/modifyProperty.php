<?php 
include_once "../dashboard/inc/session_start.php";
include_once "../dashboard/inc/head.php";
include_once "../dashboard/inc/side-bar.php";

include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";

$header = "updateProperty.php";
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
            }
        }

        mysqli_close($conn);
    ?>
    <br><a href ="../dashboard/hotel.php">Back to Hotel Properties List</a>
</html>