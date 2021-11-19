<?php
include_once "../php/inc/user-connection.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";

if (!isset($_SESSION['email'])) {

    $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
    $_SESSION['message'] = "ERROR: You've signed out and do not have permission to access this page - please sign in again.";
    header("Location: ../html/admin-sign-in.php");
    exit();
}
?>
<main class="content bg-white">
    <?php include_once "inc/header.php"; ?>
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
            <h2 class="h4">Update Property</h2>
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
        </div>
        <?php
        if (isset($_SESSION['message']) && isset($_SESSION['alert'])) { ?>
            <div class="<?php echo $_SESSION['alert'] ?>" role="alert">
                <span class="fas fa-bullhorn me-1"></span>
                <strong><?php echo $_SESSION['message'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['alert']);
        } ?>
    </div>
    
    <?php include_once "inc/footer.php" ?>