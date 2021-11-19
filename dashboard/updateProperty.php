<?php
include_once "inc/session_start.php";
include_once "../php/inc/user-connection.php";
include_once "validateProperty.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
$all_amenities = array();  

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
            <h2 class="h4">Hotel</h2>
            <p class="mb-0">Hotel table - add or edit hotels.</p>
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
        <div class="btn mb-2 mb-md-0">
            <a href="hotel.php" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center animate-up-2">Back to hotel</a>
        </div>
    </div>
    <!-- Hotel info  -->
    <div class="card card-body border-0 shadow-soft border border-light table-wrapper table-responsive animate-up-5 bg-white">
        <table class="table table-hover">
            <?php
            if (isset($_SESSION['property'])) {
                $hotelProp = $_SESSION['property'];
                $hotelID = $hotelProp['hotelID'];
                $query = mysqli_query($conn, "SELECT * FROM hotel;");
            ?>
                <h2 class="h5 mb-4"><?php echo "$hotelProp[hotelName] info" ?></h2>
                <thread>
                    <tr>
                        <th class="border-gray-200">Hotel ID</th>
                        <th class="border-gray-200">Hotel Name</th>
                        <th class="border-gray-200">Total Number of Rooms</th>
                        <th class="border-gray-200">Number of Standard Rooms</th>
                        <th class="border-gray-200">Number of Queen Rooms</th>
                        <th class="border-gray-200">Number of King Rooms</th>
                        <th class="border-gray-200">Price of Standard</th>
                        <th class="border-gray-200">Price of Queen</th>
                        <th class="border-gray-200">Price of King</th>
                        <th class="border-gray-200">Weekend Surge</th>
                        <th class="border-gray-200">Current Amenities</th>

                    </tr>
                    <thread>
                        <tr>
                            <td><span class="fw-bold"><?php echo  $hotelID; ?></span></td>
                            <td><span class="fw-normal"><?php echo $hotelProp['hotelName']; ?></span></td>
                            <td><span class="fw-normal"><?php echo  $hotelProp['number_of_rooms']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $hotelProp['numStandard']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $hotelProp['numQueen']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $hotelProp['numKing']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $hotelProp['priceStandard']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $hotelProp['priceQueen']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $hotelProp['priceKing']; ?></span></td>
                            <td><span class="fw-normal"><?php echo $hotelProp['weekendSurge']; ?></span></td>
                            <td><span class="fw-normal">
                                    <?php
                                    $amenityQuery = "SELECT * FROM `hotel`.`GenAmenities` WHERE hotelID = $hotelID";
                                    $amenityResult = mysqli_query($conn, $amenityQuery);
                                    $amenityRows = mysqli_num_rows($amenityResult);
                                    if ($amenityRows == 0) echo "N/A<br>";
                                    else {
                                        while ($amenity = mysqli_fetch_assoc($amenityResult)) {
                                            $all_amenities[] = $amenity['amenityName'];
                                            echo $amenity['amenityName'] . " ";
                                        }
                                    } ?>
                                </span></td>
                        </tr>
                    <?php
                }
                    ?>
        </table>
        <!-- end of table -->
    </div>
    <div class="card-body shadow-soft border-light animate-up-5 bg-white row justify-content-center mt-5">
        <h2 class="h5 mb-4"><?php echo "Update $hotelProp[hotelName]" ?></h2>
        <form action="modify.php" method="post" class="mt-4">
            <div class="form-group mb-4">
                <label for="hotelName">Enter Hotel Name:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-hotel"></span></span>
                    <input type="text" name="hotelName" class="form-control">
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="totalRooms">Enter Total number of Rooms:</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-door-open	"></span></span>
                    <input type="text" name="totalRooms" class='form-control'>
                </div>
            </div>
            <div class="row mb-5 mb-lg-5">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group mb-4">
                        <div class="mb-3">
                            <span class="fw-bold">Amenities</span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pool" , value="pool" <?php if (in_array("pool", $all_amenities)) echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="pool">Pool</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="gym" value="gym"  <?php if (in_array("gym", $all_amenities)) echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="gym">Gym</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="spa" value="spa"  <?php if (in_array("spa", $all_amenities)) echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="spa">Spa</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="businessOffice" value="businessOffice"  <?php if (in_array("businessOffice", $all_amenities)) echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="businessOffice">Business Office</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-6 mt-4 mt-md-0">

                    <div class="form-group mb-4">
                        <label for="hotelName">Room Type (at least one)</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="king" , value="king"  <?php if ($hotelProp['numKing']>0) echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="king">King</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="queen" , value="queen" <?php if ($hotelProp['numQueen']>0) echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="queen">Queen</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="standard" , value="standard" <?php if ($hotelProp['numStandard']>0) echo 'checked="checked"'; ?>>
                            <label class="form-check-label" for="standard">Standard</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mb-3"><span class="h6 fw-bold">Room type pricing</span></div>
            <div class="form-group mb-4">
                <label for="priceKing">King price</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-dollar-sign	"></span></span>
                    <input type="text" name="priceKing" class="form-control" value=<?php echo $hotelProp['priceKing']; ?>>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="priceQueen">Queen price</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-dollar-sign"></span></span>
                    <input type="text" name="priceQueen" class="form-control" value=<?php echo $hotelProp['priceQueen']; ?>>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="priceStandard">Standard price</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-dollar-sign"></span></span>
                    <input type="text" name="priceStandard" class="form-control" value=<?php echo $hotelProp['priceStandard']; ?>>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="weekendSurge">Weekend surge (percentage - omit percent sign)</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-percentage"></span></span>
                    <input type="text" name="weekendSurge" class="form-control">
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="modify"  value="Modify Property">Save changes</button>
            </div>
        </form>
    </div>
    <?php include_once "inc/footer.php" ?>