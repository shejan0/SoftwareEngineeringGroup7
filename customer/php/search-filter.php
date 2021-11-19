<?php
include_once "user-connection.php"
?>
<form autocomplete="off" method="post" action=""> <!--Get the action back to the host page -->
          <div class="row">
            <div class="col-xl-4 col-md-6 mb-4 ">
              <label class="form-label" for="form_dates">Dates</label>
              <div class="datepicker-container datepicker-container-left">
                <input class="form-control  input-group btn-pill bg-white shadow-soft border-light" type="text" name="bookingDate" id="form_dates"
                  placeholder="Choose your dates">
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <label class="form-label" for="form_rooms">Rooms</label>
              <select class="form-select input-group btn-pill bg-white  shadow-soft border-light" name="rooms" id="form_rooms" 
                title=" ">

                <?php
                for($i = 1; $i<=10;$i++){
                  echo "<option value\"$i\">$i</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <label class="form-label" for="form_type">Room type</label>
              <select class="form-select input-group btn-pill bg-white shadow-soft border-light" name="roomType" id="form_guests" 
              title=" ">
                <option value="Standard">Standard</option>
                <option value="Queen">Queen</option>
                <option value="King">King</option>`
              </select>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <label class="form-label">Price range</label>
              <div class="text-primary" id="slider-snap"></div>
              <div class="nouislider-values">
                <div class="min">From $<span id="slider-snap-value-from"></span></div>
                <div class="max">To $<span id="slider-snap-value-to"></span></div>
              </div>

              <input type="hidden" name="pricefrom" id="slider-snap-input-from" value="30">
              <input type="hidden" name="priceto" id="slider-snap-input-to" value="200">

            </div>
            <div class="col-md-6 col-lg-12 col-xl-8 mb-4 d-xl-flex justify-content-center">
              <div>
                <label class="form-label">Amentities</label>
                <ul class="list-inline mb-0 mt-1">
                  <?php
                    $amenityquery = "SELECT DISTINCT amenityName FROM GenAmenities;";
                    $result = $conn->query($amenityquery);
                    if($result->num_rows<=0){
                      echo "<li class=\"list-inline-item\">";
                      echo "<div class=\"form-check form-switch\">";
                      echo "<input class=\"form-check-input \" id=\"\" type=\"checkbox\">";
                      echo "<label class=\"form-check-label\" for=\"\"> <span class=\"text-sm\">FAILED</span></label>";
                      echo "</div>";
                      echo "</li>";
                    }else{
                      while($amenity = $result->fetch_assoc()){
                        $aname=$amenity["amenityName"];
                        echo "<li class=\"list-inline-item\">";
                        echo "<div class=\"form-check form-switch\">";
                        if(isset($_POST[$aname])){
                          echo "<input class=\"form-check-input \" name=\"$aname\" type=\"checkbox\" checked>"; 
                        }else{
                          echo "<input class=\"form-check-input \" name=\"$aname\" type=\"checkbox\">";
                        }
                        echo "<label class=\"form-check-label\" for=\"\"> <span class=\"text-sm\">$aname</span></label>";
                        echo "</div>";
                        echo "</li>";
                      }
                    }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 mb-4 order-2 order-sm-1">
              <button name="search" class="btn btn-primary shadow-soft border-light animate-up-2" type="submit"> <i class="fas fa-search me-1"></i>Search</button>
            </div>
          </div>
        </form>
        <?php
          if (isset($_POST['search']))
                    {
                      print_r($_POST);
                      $roomType = $_POST['roomType'];
                      $price_from = $_POST['pricefrom'];
                      $price_to = $_POST['priceto'];
                      $hotelList= array();
                     if ($roomType == "Standard") {
                       
                       $query_string ="SELECT hotelID FROM hotel WHERE numStandard>0 AND priceStandard>$price_from AND priceStandard<$price_to;";
                       $result = $conn->query($query_string);
                       
                      while($array=$result->fetch_array(MYSQLI_NUM)){

                        array_push($hotelList,$array[0]);
                      }
                      //print_r($hotelList);
                     }
                     else if ($roomType == "Queen") {
                      $query_string ="SELECT hotelID FROM hotel WHERE numQueen>0 AND priceQueen>$price_from AND priceQueen<$price_to;";
                      $result = $conn->query($query_string);
                      
                     while($array=$result->fetch_array(MYSQLI_NUM)){

                       array_push($hotelList,$array[0]);
                     }
                     //print_r($hotelList);


                     }
                     else if ($roomType == "King") {
                      $query_string ="SELECT hotelID FROM hotel WHERE numKing>0 AND priceKing>$price_from AND priceKing<$price_to;";
                      $result = $conn->query($query_string);
                      
                     while($array=$result->fetch_array(MYSQLI_NUM)){

                       array_push($hotelList,$array[0]);
                     }
                     //print_r($hotelList);
                     }else {
                      echo "<p>NOT A VALID ROOM TYPE</p>";
                    }
                    //LIST IS IN HOTEL LIST
                    $stmt_str = "SELECT DISTINCT hotelID FROM GenAmenities WHERE amenityName = ?";
                    $stmt_object = $conn->stmt_init();
                    if(!$stmt_object){
                      echo "<p>ERROR: Statement object doesn't work</p>";
                    }
                    if(!($stmt_object->prepare($stmt_str)&&$stmt_object->bind_param("s", $key)&&$stmt_object->bind_result($current_hotel))){
                      echo "<p>ERROR: ".$stmt_object->error . "</p>";
                    }
          
                    foreach($_POST as $key => $value){                    
                      if($value == 'on'){
                        $query_result_arr = array();
                        //echo $key;
                        $stmt_object->execute();
                        while($stmt_object->fetch()){
                          array_push($query_result_arr,$current_hotel);
                        }
                        //print_r($query_result_arr);
                        foreach($hotelList as $hotelKey => $hotelID){
                          if(!in_array($hotelID,$query_result_arr)){
                            //the hotel from our previous search is not in this search
                            unset($hotelList[$hotelKey]);
                          }
                        }
                      }
                    }
                    print_r($hotelList);
                    //check if space given dates and reservation number of rooms
                    }
        ?>
