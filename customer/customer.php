<?php
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";

// gets total number of records BEFORE search
$countRow = "SELECT count(1) from hotel;";
$execute = mysqli_query($conn,$countRow);
$row = mysqli_fetch_array($execute);
$total = $row[0];
?>

<div class="container-fluid bg-white">
  <div class="row justify-content-center">
    <div class="col-lg-6 py-4 p-xl-5">
      <h2 class="mb-4">San Antonio, TX</h2>
      <hr class="my-4">
      <?php include "php/search-filter.php" 

      ?>
      <hr class="my-4">
      <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">
        <div class="me-3">
          <p class="mb-3 mb-md-0"><strong><?php echo $total?></strong> results found</p>
        </div>
        <!-- <div>
          <label class="form-label me-2" for="form_sort">Sort by</label>
          <select class="selectpicker" name="sort" id="form_sort" data-style="btn-selectpicker" title="">
            <option value="sortBy_0">Most popular </option>
            <option value="sortBy_1">A-Z </option>
            <option value="sortBy_2">High-Low </option>
            <option value="sortBy_3">Low-High </option>
          </select>
        </div> -->
      </div>
      </div>
      <div class="row">
        <?php
        $fillquery = "SELECT h.hotelID, h.hotelName, h.priceStandard,d.imageLink FROM hotel h, Descriptions d WHERE h.hotelID = d.hotelID;";
        $result = $conn->query($fillquery);

        // gets random image
        function randomPic($dir = '../assets/img/hotel')
        {
          $files = glob($dir . '/*.*');
          $file = array_rand($files);
          return $files[$file];
        }
        if ($result->num_rows <= 0) {
          echo "<div class=\"col-md-5 mb-5 hover-animate\">";
          echo "<div class=\"card h-100  shadow-soft border-light animate-up-2 bg-white\">";
          echo "<div class=\"card-img-top overflow-hidden shadow-soft border-light animate-up-2\">";
          echo "<a href=\"\">";
          echo "<img src=\"\" alt=\"Front pages overview\">";
          echo "</a></div>";
          echo "<div class=\"card-body d-flex align-items-center\">";
          echo "<div class=\"w-100\">";
          echo "<h6 class=\"card-title\">";
          echo "<a class=\"text-decoration-none text-dark\" href=\"\">FAILED</a>";
          echo "</h6>";
          echo "<div class=\"d-flex card-subtitle mb-3\">";
          echo "</div>";
          echo "<p class=\"card-text text-muted\"><span class=\"h4 text-secondary\">$9999</span> per night</p>";
          echo "</div></div></div></div>";
        } else {
          while ($list = $result->fetch_assoc()) {
            $id = $list['hotelID'];
            $name = $list['hotelName'];
            $price = $list['priceStandard'];
            $imageLink = randomPic();
            echo "<div class=\"col-md-4 mb-5 hover-animate\">";
            echo "<div class=\"card h-100  shadow-soft border-light animate-up-2 bg-white\">";
            echo "<div class=\"card-img-top overflow-hidden shadow-soft border-light animate-up-2\">";
            echo "<a href=\"room-details.php?hotelID=$id\">";
            echo "<img src=\"$imageLink\" alt=\"Front pages overview\">";
            // echo "<img src=\"../assets/img/hotels/hotel1.jpeg\" alt=\"Front pages overview\">";
            echo "</a></div>";
            echo "<div class=\"card-body d-flex align-items-center\">";
            echo "<div class=\"w-100\">";
            echo "<h6 class=\"card-title\">";
            echo "<a class=\"text-decoration-none text-dark\" href=\"room-details.php?hotelID=$id\">$name</a>";
            echo "</h6>";
            echo "<div class=\"d-flex card-subtitle mb-3\">";
            echo "</div>";
            echo "<p class=\"card-text text-muted\"><span class=\"h4 text-secondary\">$$price</span> per night</p>";
            echo "</div></div></div></div>";
          }
        }
        ?>
        <!-- place item
        <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e33b1527bfe2abaf92">
          <div class="card h-100  shadow-soft border-light animate-up-2 bg-white">
          <div class="card-img-top overflow-hidden shadow-soft border-light animate-up-2">
            <a href="room-details.php">
              <img src="../assets/img/hotels/hotel-room1.jpeg" alt="Front pages overview">
            </a>
          </div>
            <div class="card-body d-flex align-items-center">
              <div class="w-100">
                <h6 class="card-title">
                  <a class="text-decoration-none text-dark" href="room-details.php">The Magnolia All</a>
                </h6>
                <div class="d-flex card-subtitle mb-3">
                  <p class="flex-grow-1 mb-0 text-muted text-sm">Private room</p>
                  <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                  </p>
                </div>
                <p class="card-text text-muted"><span class="h4 text-secondary">$282</span> per night</p>
              </div>
            </div>
          </div>
        </div>
  

        <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e322f3375db4d89128">
          <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
          <div class="card-img-top overflow-hidden shadow-soft border-light animate-up-2">
            <a href="room-details.php">
              <img src="../assets/img/hotels/hotel-room2.jpeg" alt="Front pages overview">
            </a>
          </div>
            <div class="card-body d-flex align-items-center">
              <div class="w-100">
                <h6 class="card-title"><a class="text-decoration-none text-dark" href="room-details.php">The Lofts at Town Centre</a></h6>
                <div class="d-flex card-subtitle mb-3">
                  <p class="flex-grow-1 mb-0 text-muted text-sm">King suitet</p>
                  <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300"> </i>
                  </p>
                </div>
                <p class="card-text text-muted"><span class="h4 text-primary">$242</span> per night</p>
              </div>
            </div>
          </div>
        </div>


        <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e3a31e62979bf147c8">
          <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
          <div class="card-img-top overflow-hidden shadow-soft border-light animate-up-2">
            <a href="room-details.php">
              <img src="../assets/img/hotels/hotel-room3.jpeg" alt="Front pages overview">
            </a>
          </div>
            <div class="card-body d-flex align-items-center">
              <div class="w-100">
                <h6 class="card-title"><a class="text-decoration-none text-dark" href="room-details.php">
                    The Courtyard Suites</a>
                </h6>
                <div class="d-flex card-subtitle mb-3">
                  <p class="flex-grow-1 mb-0 text-muted text-sm">Queen suite</p>
                  <p class="flex-shrink-1 m b-0 card-stars text-xs text-end">
                    <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300"> </i><i class="fa fa-star text-gray-300"> </i>
                  </p>
                </div>
                <p class="card-text text-muted"><span class="h4 text-primary">$189</span> per night</p>
              </div>
            </div>
          </div>
        </div>

        
        <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e3503eb77d487e8082">
          <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
          <div class="card-img-top overflow-hidden shadow-soft border-light animate-up-2">
            <a href="room-details.php">
              <img src="../assets/img/hotels/hotel-room4.jpeg" alt="Front pages overview">
            </a>
          </div>
            <div class="card-body d-flex align-items-center">
              <div class="w-100">
                <h6 class="card-title"><a class="text-decoration-none text-dark" href="room-details.php">The Regency Rooms</a></h6>
                <div class="d-flex card-subtitle mb-3">
                  <p class="flex-grow-1 mb-0 text-muted text-sm">Standard suite</p>
                  <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300"> </i>
                  </p>
                </div>
                <p class="card-text text-muted"><span class="h4 text-primary">$153</span> per night</p>
              </div>
            </div>
          </div>
        </div>

        
        <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e39aa2eed0626e485d">
          <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
          <div class="card-img-top overflow-hidden shadow-soft border-light animate-up-2">
            <a href="room-details.php">
              <img src="../assets/img/hotels/hotel-room5.jpeg" alt="Front pages overview">
            </a>
          </div>
            <div class="card-body d-flex align-items-center">
              <div class="w-100">
                <h6 class="card-title"><a class="text-decoration-none text-dark" href="room-details.php">Town Inn Budget Rooms
                    Modern Garden room</a></h6>
                <div class="d-flex card-subtitle mb-3">
                  <p class="flex-grow-1 mb-0 text-muted text-sm">Standard suite</p>
                  <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                  </p>
                </div>
                <p class="card-text text-muted"><span class="h4 text-primary">$176</span> per night</p>
              </div>
            </div>
          </div>
        </div>

        
        <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e39aa2edasd626e485d">
          <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
          <div class="card-img-top overflow-hidden shadow-soft border-light animate-up-2">
            <a href="room-details.php">
              <img src="../assets/img/hotels/hotel-room6.jpeg" alt="Front pages overview">
            </a>
          </div>
            <div class="card-body d-flex align-items-center">
              <div class="w-100">
                <h6 class="card-title"><a class="text-decoration-none text-dark" href="room-details.php">HomeAway Inn</a></h6>
                <div class="d-flex card-subtitle mb-3">
                  <p class="flex-grow-1 mb-0 text-muted text-sm">Studio suite</p>
                  <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300"> </i>
                  </p>
                </div>
                <p class="card-text text-muted"><span class="h4 text-primary">$167</span> per night</p>
              </div>
            </div>
          </div>
        </div>
        -->
      </div>
      <!-- Pagination -->
      <!-- <nav aria-label="Page navigation example">
        <ul class="pagination pagination-template d-flex justify-content-center ">
          <li class="page-item "><a class="page-link" href="#"> <i class="fa fa-angle-left"></i></a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#"> <i class="fa fa-angle-right"></i></a></li>
        </ul>
      </nav> -->
          <!-- <div class="col-lg-6 map-side-lg pe-lg-0">
      <div class="map-full shadow-soft border-light" id="categorySideMap"></div>
    </div> -->
  </div>
</div>
<?php
include_once "php/footer.php";  ?>
