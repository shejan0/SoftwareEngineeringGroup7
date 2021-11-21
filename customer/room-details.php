<?php
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";
?>
<div class="container py-5">
  <div class="row">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-primary breadcrumb-primary  breadcrumb-transparent">
        <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="customer.php">Hotels</a></li>
        <li class="breadcrumb-item active" aria-current="page">Bookings</li>
      </ol>
    </nav>
    <div class="col-lg-8">
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
                        }?>
      <div class="text-block">
        <!--
            <p class="text-primary"><i class="fa-map-marker-alt fa me-1"></i> Brooklyn, New York</p>
            -->
        <?php
        if (empty($_GET["hotelID"])) {
          echo "<h1>FAILED</h1>";
        } else {
          $namequery = "SELECT hotelName FROM hotel.hotel WHERE hotelID=?";
          $prepared = $conn->prepare($namequery);
          $prepared->bind_param("i", $_GET["hotelID"]);
          $prepared->execute();
          $prepared->bind_result($name);
          $prepared->fetch();
          echo "<h1>$name</h1>";
          $prepared->close();
        }
        ?>
        <?php
        if (empty($_GET["hotelID"])) {
          echo "<p class=\"text-muted fw-light\">FAILED</p>";
        } else {
          $descquery = "SELECT hotelDesc FROM hotel.Descriptions WHERE hotelID=?;";
          $prepared = $conn->prepare($descquery);
          $prepared->bind_param("i", $_GET["hotelID"]);
          $prepared->execute();
          $prepared->bind_result($desc);
          $prepared->fetch();
          echo "<p class=\"text-muted fw-light\">$desc</p>";
          $prepared->close();
        }
        ?>
<!--         
            <p class="text-muted fw-light">Our garden basement apartment is fully equipped with everything you need to enjoy your stay. Very comfortable for a couple but plenty of space for a small family. Close to many wonderful Brooklyn attractions and quick trip to Manhattan. </p>
            <h6 class="mb-3">The space</h6>
            <p class="text-muted fw-light">Welcome to Brooklyn! We are excited to share our wonderful neighborhood with you. Our modern apartment has a private entrance, fully equipped kitchen, and a very comfortable queen size bed. We are happy to accommodate additional guests with a single bed in the living room, another comfy mattress on the floor and can make arrangements for small children with a portable crib and highchair if requested. </p>
            <p class="text-muted fw-light">Also in the apartment:</p>
            <ul class="text-muted fw-light"> 
              <li>TV with Netflix and DirectTVNow</li>
              <li>Free WiFi</li>
              <li>Gourmet Coffee/Tea making supplies</li>
              <li>Fresh Sheets and Towels</li>
              <li>Toaster, microwave, pots and pans and basic cooking needs like salt, pepper, sugar, and olive oil.</li>
              <li>Air Conditioning to keep you cool all summer!</li>
            </ul>
            <p class="text-muted fw-light">The apartment is surprisingly quiet for being in the heart of a vibrant, bustling neighborhood.</p>
            <h6 class="mb-3">Interaction with guests</h6>
            <p class="text-muted fw-light">We live in the two floors above the garden apartment so we are usually available to answer questions. The garden apartment is separate from our living space. We are happy to provide advice on local attractions, restaurants and transportation around the city. If there's anything you need please don't hesitate to ask!</p>
            -->
      </div>

      <div class="text-block">
        <h4 class="mb-4">Amenities</h4>
        <div class="row">
          <?php
          if (empty($_GET["hotelID"])) {
            echo "<div class=\"col-md-6\">";
            echo "<ul class=\"text-muted\">";
            echo "<li class=\"mb-2\"><span class=\"text-sm\">FAILED</span></li>";
            echo "</ul>";
            echo "</div>";
          } else {
            $ameniquery = "SELECT amenityName FROM hotel.GenAmenities WHERE hotelID=?;";
            $prepared = $conn->prepare($ameniquery);
            $prepared->bind_param("i", $_GET["hotelID"]);
            $prepared->execute();
            $prepared->bind_result($amenity);
            echo "<div class=\"col-md-6\">";
            echo "<ul class=\"text-muted list-inline text-sm mb-4\">";
            while ($prepared->fetch()) {
              if($amenity == 'pool')
              echo "<li class=\"list-inline-item me-3\"><i class=\"fa fa-swimming-pool me-1 text-secondary\"></i>$amenity</li>";
              if($amenity == 'gym')
              echo "<li class=\"list-inline-item me-3\"><i class=\"fas fa-weight-hanging me-1 text-secondary\"></i>$amenity</li>";
              if($amenity == 'spa')
              echo "<li class=\"list-inline-item me-3\"><i class=\"fa fa-spa me-1 text-secondary\"></i>$amenity</li>";
              if($amenity == 'businessOffice')
              echo "<li class=\"list-inline-item me-3\"><i class=\"fas fa-briefcase me-1 text-secondary\"></i>$amenity</li>";
            }
            echo "</ul></div>";
            $prepared->close();
          }
          ?>
          <!--
              <div class="col-md-6">
                <ul class="text-muted">
                  
                  <li class="mb-2"><span class="text-sm">Wifi</span></li>
                  <li class="mb-2"> <i class="fa fa-tv text-secondary w-1rem me-3 text-center"></i><span class="text-sm">Cable TV</span></li>
                  <li class="mb-2"> <i class="fa fa-snowflake text-secondary w-1rem me-3 text-center"></i><span class="text-sm">Air conditioning</span></li>
                  <li class="mb-2"> <i class="fa fa-thermometer-three-quarters text-secondary w-1rem me-3 text-center"></i><span class="text-sm">Heating</span></li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="list-unstyled text-muted">
                  <li class="mb-2"> <i class="fa fa-bath text-secondary w-1rem me-3 text-center"></i><span class="text-sm">Toiletteries</span></li>
                  <li class="mb-2"> <i class="fa fa-utensils text-secondary w-1rem me-3 text-center"></i><span class="text-sm">Equipped Kitchen</span></li>
                  <li class="mb-2"> <i class="fa fa-laptop text-secondary w-1rem me-3 text-center"></i><span class="text-sm">Desk for work</span></li>
                  <li class="mb-2"> <i class="fa fa-tshirt text-secondary w-1rem me-3 text-center"></i><span class="text-sm">Washing machine</span></li>
                </ul>
              </div>
              -->
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="p-4 shadow-soft border-light animate-up-2  ms-lg-4 rounded sticky-top" style="top: 100px;">
        <?php
        if (empty($_GET["hotelID"])) {
          echo "<p class=\"text-muted\"><span class=\"text-primary h2\">FAILED</span></p>";
        } else {
          $pricequery = "SELECT priceStandard,priceQueen,priceKing FROM hotel.hotel WHERE hotelID=?;";
          $prepared = $conn->prepare($pricequery);
          $prepared->bind_param("i", $_GET["hotelID"]);
          $prepared->execute();
          $prepared->bind_result($priceStandard, $priceQueen, $priceKing);
          $prepared->fetch();
          if ($priceStandard != 0) {
            echo "<p class=\"text-muted\"><span class=\"text-primary h2\">$$priceStandard</span> per night <b>STANDARD</b></p>";
          }
          if ($priceQueen != 0) {
            echo "<p class=\"text-muted\"><span class=\"text-primary h2\">$$priceQueen</span> per night <b>QUEEN</b></p>";
          }
          if ($priceKing != 0) {
            echo "<p class=\"text-muted\"><span class=\"text-primary h2\">$$priceKing</span> per night <b>KING</b></p>";
          }
          $prepared->close();
        }
        ?>
        <hr class="my-4">
        <form class="form" id="booking-form" method="get" action="book.php" autocomplete="off">
          <!-- passing ID to book.php -->
        <input type="hidden" name="hotelID" value="<?php echo $_GET['hotelID']; ?>">
          <div class="mb-4">
            <label class="form-label" for="bookingDate">Your stay *</label>
            <div class="datepicker-container datepicker-container-left">
              <input class="form-control input-group btn-pill bg-white shadow-soft border-light" type="text" name="bookingDate" id="form_dates" placeholder="Choose your dates">
              <input type="hidden" name="hotelID" value=<?php$hotelID?>>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label" for="rooms">Rooms *</label>
            <select class="form-control input-group btn-pill bg-white shadow-soft border-light" name="rooms" id="rooms">
              <?php
              for ($i = 1; $i <= 10; $i++) {
                echo "<option value=\"$i\">$i</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-4">
            <label class="form-label" for="type">Room Type *</label>
            <select class="form-control input-group btn-pill bg-white shadow-soft border-light" name="type" id="type">
              <?php
              if (empty($_GET["hotelID"])) {
                echo "<option>FAILED</option>";
              } else {
                $numquery = "SELECT numStandard,numQueen,numKing FROM hotel.hotel WHERE hotelID=?;";
                $prepared = $conn->prepare($numquery);
                $prepared->bind_param("i", $_GET["hotelID"]);
                $prepared->execute();
                $prepared->bind_result($numStandard, $numQueen, $numKing);
                $prepared->fetch();
                  echo "<option value=\"standard\">Standard</option>";
                  echo "<option value=\"queen\">Queen</option>";  
                  echo "<option value=\"king\">King</option>";
                
              }
              ?>
            </select>
          </div>
          <div class="d-grid mb-4">
            <button class="btn btn-primary" type="submit" name='book'>Book your stay</button>
          </div>
        </form>
      </div>
    </div>
    <div class="section section-sm pb-0 mb-n4">
      <div class="container">
        <div class="row justify-content-center">
          <h3 class="text-center">Gallery</h3>
        </div>
      </div>
    </div>
    <div class="section section-md ">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10 mx-auto">
            <div class="section section-lg bg-white border-light shadow-soft animate-up-2 pb-0">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-12 col-md-8 text-center mb-4 mb-lg-6">
                    <h2 class="display-2 fw-bold"><?php if(isset($name))echo $name; else "Pictures of hotels"?></h2>
                    <p class="lead">Pictures of the hotel</p>
                  </div>
                </div>
                <div class="row align-items-center">
                  <?php
                  // gets random image
                  function randomPic($dir = '../assets/img/hotel-detail')
                  {
                    $files = glob($dir . '/*.*');
                    $file = array_rand($files);
                    return $files[$file];
                  }

                  for ($i = 0; $i < 12; $i++) {
                    $image = randomPic();
                    echo "
              <div class=\"col-md-6 col-lg-4 text-center\">
                  <div class=\"card-body py-5 border-light shadow-inset aniamte-up-2\"><img src=\"$image\" class=\"image-xl\" alt=\"hotel image\"> 
                  </div>
              </div>
            ";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once "php/footer.php" ?>