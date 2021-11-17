<?php

session_start();
include_once "inc/user-connection.php";
$queryLastRow = "SELECT * FROM `hotel`.`hotel` Where hotelID = (SELECT MAX(hotelID) FROM `hotel`.`hotel`)";
$resultLastRow = mysqli_query($conn, $queryLastRow);
$lastID = mysqli_fetch_assoc($resultLastRow);
if ($lastID != NULL) $hotelID = $lastID['hotelID'] + 1;
else $hotelID = 1;
$hotelName = NULL;
$numRooms = NULL;
$weekendSurge = NULL;
$priceKing = NULL;
$priceQueen = NULL;
$priceStandard = NULL;
$numKing = NULL;
$numQueen = NULL;
$numStandard = NULL;

if (!isset($_SESSION['email'])) {
    header("Location: ../html/admin-sign-in.html");
}
// Process info when create (submit button) is clicked
if (isset($_POST["create"])) {    // all process provided below at each break point
    if (empty($_POST['hotelName'])) echo "Error: Hotel Name required<br>";
    else $hotelName = $_POST['hotelName'];

    if (empty($_POST['numRooms']))  echo "Error: Total Number of Rooms required<br>";
    else if (!ctype_digit($_POST['numRooms'])) echo "Error: Enter \"positive integer\" for Total Number of Rooms<br>";
    else $numRooms = $_POST['numRooms'];

    if (!isset($_POST['king']) && !isset($_POST['queen']) && !isset($_POST['standard'])) echo "Error: Select at least one room type<br>";
    // number of rooms of each room type when all room types selected
    if (isset($_POST['king']) && isset($_POST['queen']) && isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.2);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numQueen = ($numRooms * 0.3);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $numStandard = ($numRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numKing + $numQueen + $numStandard;
        if ($currTotal > $numRooms) $numKing = $numKing - ($currTotal - $numRooms);
    }
    /* number of rooms of each type when 2 out of 3 types are selected
        * includes all combination */
    if (isset($_POST['king']) && isset($_POST['queen']) && !isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.5);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numQueen = ($numRooms * 0.5);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $currTotal = $numKing + $numQueen;
        if ($currTotal > $numRooms) $numKing = $numKing - ($currTotal - $numRooms);
    }
    if (isset($_POST['king']) && !isset($_POST['queen']) && isset($_POST['standard'])) {
        $numKing = ($numRooms * 0.5);
        if (($numKing - floor($numKing)) >= 0.5) $numKing = round($numKing);
        else $numKing = floor($numKing);

        $numStandard = ($numRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numKing + $numStandard;
        if ($currTotal > $numRooms) $numKing = $numKing - ($currTotal - $numRooms);
    }
    if (!isset($_POST['king']) && isset($_POST['queen']) && isset($_POST['standard'])) {
        $numQueen = ($numRooms * 0.5);
        if (($numQueen - floor($numQueen)) >= 0.5) $numQueen = round($numQueen);
        else $numQueen = floor($numQueen);

        $numStandard = ($numRooms * 0.5);
        if (($numStandard - floor($numStandard)) >= 0.5) $numStandard = round($numStandard);
        else $numStandard = floor($numStandard);

        $currTotal = $numQueen + $numStandard;
        if ($currTotal > $numRooms) $numQueen = $numQueen - ($currTotal - $numRooms);
    }
    /* number of rooms of each type when 1 out of 3 types are selected
        * includes all combination */
    if (isset($_POST['king']) && !isset($_POST['queen']) && !isset($_POST['standard'])) $numKing = $numRooms;
    if (!isset($_POST['king']) && isset($_POST['queen']) && !isset($_POST['standard'])) $numQueen = $numRooms;
    if (!isset($_POST['king']) && !isset($_POST['queen']) && isset($_POST['standard'])) $numStandard = $numRooms;

    if (isset($_POST['king']) && empty($_POST['priceKing'])) echo "Enter price of King type room<br>";
    else if (isset($_POST['king']) && !ctype_digit($_POST['priceKing'])) echo "Enter \"positive integer\" for Price of King <br>";
    else if (!isset($_POST['king']) && !empty($_POST['kingPrice'])) echo "King type not selected. Leave blank or enter 0 for price of King<br>";
    $priceKing = $_POST['priceKing'];

    if (isset($_POST['queen']) && empty($_POST['priceQueen'])) echo "Enter price of Queen type room<br>";
    else if (isset($_POST['queen']) && !ctype_digit($_POST['priceQueen'])) echo "Enter \"positive integer\" for price of Queen<br>";
    else if (!isset($_POST['queen']) && !empty($_POST['priceQueen'])) echo "Queen type not selected. Leave blank or enter 0 for price of Queen<br>";
    $priceQueen = $_POST['priceQueen'];

    if (isset($_POST['standard']) && empty($_POST['priceStandard'])) echo "Enter price of Standard type room<br>";
    else if (isset($_POST['standard']) && !ctype_digit($_POST['priceStandard'])) echo "Enter \"positive integer\" for price of Standard<br>";
    else if (!isset($_POST['standard']) && !empty($_POST['priceStandard'])) echo "Standard type not selected. Leave blank or enter 0 for price of Standard<br>";
    $priceStandard = $_POST['priceStandard'];

    if (empty($_POST['weekendSurge']))  echo "Enter Weekend Surcharge<br>";
    else if (!ctype_digit($_POST['weekendSurge'])) echo "Enter \"positive integer\" for Weekend Surcharge<br>";
    else $weekendSurge = $_POST['weekendSurge'];

    // insert property info into hotel table
    if (!empty($hotelName) && !empty($numRooms) && !empty($weekendSurge)) {
        $insertProp = "INSERT INTO `hotel`.`hotel` (hotelID, hotelName, number_of_rooms, weekendSurge, priceKing, priceQueen, priceStandard, numKing, numQueen, numStandard) 
            VALUES ('$hotelID', '$hotelName', '$numRooms', '$weekendSurge', '$priceKing', '$priceQueen', '$priceStandard', '$numKing', '$numQueen', '$numStandard')";
        $createProp = mysqli_query($conn, $insertProp);

        if (!$createProp) exit("<p class='error'>Error Creating Hotel Property: ($insertProp) " . mysqli_error($conn) . "</p>");
?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="fas fa-bullhorn me-1"></span>
            <strong>Sucessfully created <?php echo "$hotelName"; ?> </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php }

    // check and insert amenities to GenAmenities table
    if (isset($_POST['pool'])) {
        $ammenityID = 1;
        $ammenityName = $_POST['pool'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) exit("<p class='error'>Error Adding Amenity to Hotel Property: ($addAmenity) " . mysqli_error($conn) . "</p>");
    }

    if (isset($_POST['gym'])) {
        $ammenityID = 2;
        $ammenityName = $_POST['gym'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) exit("<p class='error'>Error Adding Amenity to Hotel Property: ($addAmenity) " . mysqli_error($conn) . "</p>");
    }

    if (isset($_POST['spa'])) {
        $ammenityID = 3;
        $ammenityName = $_POST['spa'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) exit("<p class='error'>Error Adding Amenity to Hotel Property: ($addAmenity) " . mysqli_error($conn) . "</p>");
    }

    if (isset($_POST['businessOffice'])) {
        $ammenityID = 4;
        $ammenityName = $_POST['businessOffice'];
        $addAmenity = "INSERT INTO `hotel`.`GenAmenities`(hotelID, amenityID, amenityName) VALUES ('$hotelID','$ammenityID', '$ammenityName')";
        $add = mysqli_query($conn, $addAmenity);
        if (!$add) exit("<p class='error'>Error Adding Amenity to Hotel Property: ($addAmenity) " . mysqli_error($conn) . "</p>");
    }
}   // close big if statement for when create (submit) is clicked


mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Create hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Pixel Bootstrap 5 - Sign in">
    <meta name="author" content="Themesberg">
    <meta name="description" content="Open source and free Bootstrap 5 UI Kit featuring 80 UI components, 5 example pages, and a Gulp and Sass workflow.">
    <link rel="canonical" href="https://themesberg.com/product/ui-kit/pixel-free-bootstrap-5-ui-kit">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon.ico">
    <link type="text/css" href="../vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link type="text/css" href="../css/pixel.css" rel="stylesheet">

</head>

<body>
    <section class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark" data-background="../assets/img/pages/form-image.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="signin-inner my-4 my-lg-0 bg-white  rounded  p-4 p-lg-5 w-100 fmxw-500">
                        <p class="text-center">
                            <a href="hotel.php" class="d-flex align-items-center justify-content-center">
                                <span class="text-gray"><span class="fas fa-arrow-left me-2"></span>Back to Hotel list
                                </span>
                            </a>
                        </p>
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">Add Hotel</h1>
                        </div>
                        <!-- <h3>Hotel ID: <?php //echo $hotelID 
                                            ?></h3> -->

                        <!-- Main form for property creation -->
                        <form action="createProperty.php" method="post" class="mt-4">
                            <div class="form-group mb-4">
                                <label for="hotelName">Enter Hotel Name (required):</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                    <input type="text" name="hotelName" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="numRooms">Enter Total number of Rooms (required):</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                    <input type="text" name="numRooms" class='form-control'>
                                </div>
                            </div>
                            <div class="row mb-5 mb-lg-5">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group mb-4">
                                        <div class="mb-3">
                                            <span class="fw-bold">Amenities</span>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pool" , value="pool" id="defaultCheck1">
                                            <label class="form-check-label" for="pool">Pool</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="gym" , value="gym" id="defaultCheck1">
                                            <label class="form-check-label" for="gym">
                                                Gym
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="spa" , value="spa" id="defaultCheck1">
                                            <label class="form-check-label" for="spa">
                                                Spa
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="businessOffice" , value="businessOffice">
                                            <label class="form-check-label" for="businessOffice">
                                                Business Office
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-sm-6 mt-4 mt-md-0">

                                    <div class="form-group mb-4">
                                        <label for="hotelName">Room Type (at least one)</label>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="standard" , value="standard" id="defaultCheck1">
                                            <label class="form-check-label" for="standard">Standard</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="queen" , value="queen" id="defaultCheck1">
                                            <label class="form-check-label" for="queen">Queen</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="king" , value="king" id="defaultCheck1">
                                            <label class="form-check-label" for="king">King</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3"><span class="h6 fw-bold">Room type pricing</span></div>
                            <div class="form-group mb-4">
                                <label for="priceKing">King price</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                    <input type="text" name="priceQueen" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="priceQueen">Queen price</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                    <input type="text" name="priceQueen" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="priceStandard">Standard price</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                    <input type="text" name="priceStandard" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="weekendSurge">Weekend surge (percentage - omit percent sign)</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                    <input type="text" name="weekendSurge" class="form-control">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="create" value="Create Property">Create Property</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../vendor/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../vendor/headroom.js/dist/headroom.min.js"></script>

    <!-- Vendor JS -->
    <script src="../vendor/onscreen/dist/on-screen.umd.min.js"></script>
    <script src="../vendor/jarallax/dist/jarallax.min.js"></script>
    <script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="../vendor/vivus/dist/vivus.min.js"></script>
    <script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../assets/js/pixel.js"></script>

    <body>

</html>