<?php
ob_start();
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";

// gets total number of records BEFORE search
$countRow = "SELECT count(1) from hotel;";
$execute = mysqli_query($conn, $countRow);
$row = mysqli_fetch_array($execute);
$total = $row[0];
?>

<div class="container-fluid bg-white">
  <div class="row justify-content-center">
    <div class="col-lg-6 py-4 p-xl-5">
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
      <h2 class="mb-4">San Antonio, TX</h2>
      <hr class="my-4">
      <?php 
        include "php/search-filter.php"; 
        //print_r($hotelList);
      ?>
      <hr class="my-4">
      <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">
        <div class="me-3">
          <p class="mb-3 mb-md-0"><strong><?php 
          if(empty($hotelList)){
            echo $total;
          }else{
            echo count($hotelList);
          }
           
          ?>
          </strong> results found</p>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      function randomPic($dir = '../assets/img/hotel')
      {
        $files = glob($dir . '/*.*');
        $file = array_rand($files);
        return $files[$file];
      }

      if(empty($hotelList)){
          $fillquery = "SELECT h.hotelID, h.hotelName, h.weekendSurge,h.priceStandard,d.imageLink,h.priceQueen,h.priceKing FROM hotel h, Descriptions d WHERE h.hotelID = d.hotelID;";
          $result = $conn->query($fillquery);

        // gets random image
        
        if ($result->num_rows <= 0) {
          echo "<div class=\"col-md-5 mb-5 hover-animate\">";
          echo "<div class=\"card h-100  shadow-soft border-light animate-up-2 bg-white\">";
          echo "<div class=\"card-img-top overflow-hidden shadow-soft border-light animate-up-2\">";
          echo "<a href=\"\">";
          echo "<img src=\".".randomPic()."\" alt=\"Front pages overview\">";
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
            $priceStandard = $list['priceStandard'];
            $priceQueen = $list['priceQueen'];
            $priceKing = $list['priceKing'];
            $weekendSurge = $list['weekendSurge'];
            if(empty($list['imageLink'])){
              $imageLink = randomPic();
            }else{
              $imageLink=$list['imageLink'];
            }
            

            echo "<div class=\"col-md-4 mb-5 hover-animate\">";
            echo "<div class=\"card h-100  shadow-soft border-light animate-up-2 bg-white\">";
            echo "<div class=\"card-img-top overflow-hidden shadow-soft border-light animate-up-2\">";
            echo "<a href=\"room-details.php?hotelID=$id\">";
            echo "<img src=\"$imageLink\" alt=\"Front pages overview\">";
            echo "</a></div>";
            echo "<div class=\"card-body d-flex align-items-center\">";
            echo "<div class=\"w-100\">";
            echo "<h6 class=\"card-title\">";
            echo "<a class=\"text-decoration-none text-dark\" href=\"room-details.php?hotelID=$id\">$name</a>";
            echo "</h6>";
            echo "<div class=\"d-flex card-subtitle mb-3\">";
            echo "</div>";
            
            if(!empty($priceStandard)){
              echo "<p class=\"card-text text-muted\"><span class=\"h4 text-secondary\">$$priceStandard</span> Standard / per night</p>";
            }
            if(!empty($priceQueen)){
              echo "<p class=\"card-text text-muted\"><span class=\"h4 text-secondary\">$$priceQueen</span> Queen / per night</p>";
            }
            if(!empty($priceKing)){
              echo "<p class=\"card-text text-muted\"><span class=\"h4 text-secondary\">$$priceKing</span> King / per night</p>";
            }
            if(!empty($weekendSurge)){
              echo "<p class=\"card-text text-muted\">". $weekendSurge . "% weekend upcharge</p>";
            }
            echo "</div></div></div></div>";
          }
        }
      }else{
        $stmt_obj = $conn->stmt_init();
          $stmt_str="SELECT h.hotelID, h.hotelName, h.weekendSurge, h.priceStandard,d.imageLink,h.priceQueen,h.priceKing FROM hotel h, Descriptions d WHERE h.hotelID = d.hotelID AND h.hotelID = ?;";
          if(!$stmt_obj){
            echo "<h1>Failed to initialize the prepared statement</h1>";
          }else{
            if(!($stmt_obj->prepare($stmt_str)&&$stmt_obj->bind_param("i",$hotelListID)&&$stmt_obj->bind_result($id,$name,$weekendSurge,$priceStandard,$imageLink,$priceQueen,$priceKing))){
                echo "<p>ERROR: ". $stmt_obj->error . "</p>";
          }
        foreach($hotelList as $hotelListKey => $hotelListID){
            $stmt_obj->execute();
            $stmt_obj->fetch();
            if(empty($imageLink)){
              $imageLink = randomPic();
            }
            echo "<div class=\"col-md-4 mb-5 hover-animate\">";
            echo "<div class=\"card h-100  shadow-soft border-light animate-up-2 bg-white\">";
            echo "<div class=\"card-img-top overflow-hidden shadow-soft border-light animate-up-2\">";
            echo "<a href=\"room-details.php?hotelID=$id\">";
            echo "<img src=\"$imageLink\" alt=\"Front pages overview\">";
            echo "</a></div>";
            echo "<div class=\"card-body d-flex align-items-center\">";
            echo "<div class=\"w-100\">";
            echo "<h6 class=\"card-title\">";
            echo "<a class=\"text-decoration-none text-dark\" href=\"room-details.php?hotelID=$id\">$name</a>";
            echo "</h6>";
            echo "<div class=\"d-flex card-subtitle mb-3\">";
            echo "</div>";
            
            if(!empty($priceStandard)){
              echo "<p class=\"card-text text-muted\"><span class=\"h4 text-secondary\">$$priceStandard</span> Standard / per night</p>";
            }
            if(!empty($priceQueen)){
              echo "<p class=\"card-text text-muted\"><span class=\"h4 text-secondary\">$$priceQueen</span> Queen / per night</p>";
            }
            if(!empty($priceKing)){
              echo "<p class=\"card-text text-muted\"><span class=\"h4 text-secondary\">$$priceKing</span> King / per night</p>";
            }
            if(!empty($weekendSurge)){
              echo "<p class=\"card-text text-muted\">". $weekendSurge . "% weekend upcharge</p>";
            }
            echo "</div></div></div></div>";
          }
        }
      }
      ?>
      
    </div>
    
  </div>
</div>
<?php
include_once "php/footer.php";  ?>
