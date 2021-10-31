<?php
include_once "user-connection.php";

?>
<form autocomplete="off" method="get"> <!--Get the action back to the host page -->
          <div class="row">
            <div class="col-xl-4 col-md-6 mb-4 ">
              <label class="form-label" for="form_dates">Dates</label>
              <div class="datepicker-container datepicker-container-left">
                <input class="form-control  input-group btn-pill bg-white shadow-soft border-light" type="text" name="bookingDate" id="form_dates"
                  placeholder="Choose your dates">
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <label class="form-label" for="form_guests">Guests</label>
              <select class="form-select input-group btn-pill bg-white  shadow-soft border-light" name="guests" id="form_guests" 
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
                <?php
                  $roomTypequery = "SELECT DISTINCT typeName FROM RoomType;";
                  $result = $conn->query($roomTypequery);
                  //print_r($result);
                  if($result->num_rows<=0){
                    echo "<option>FAILED</option>";
                  }else{
                    while($roomType = $result->fetch_assoc()){
                      
                      $name=$roomType["typeName"];
                      echo "<option value=\"$name\">$name</option>";
                   }
                  }
                ?>
              </select>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <label class="form-label">Price range</label>
              <div class="text-primary" id="slider-snap"></div>
              <div class="nouislider-values">
                <div class="min">From $<span id="slider-snap-value-from"></span></div>
                <div class="max">To $<span id="slider-snap-value-to"></span></div>
              </div>
              <input type="hidden" name="pricefrom" id="slider-snap-input-from" value="40">
              <input type="hidden" name="priceto" id="slider-snap-input-to" value="300">
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
                        if(isset($_GET[$aname])){
                          echo "<input class=\"form-check-input \" id=\"\" name=\"$aname\" type=\"checkbox\" checked>";  
                        }else{
                          echo "<input class=\"form-check-input \" id=\"\" name=\"$aname\" type=\"checkbox\">";
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
              <button class="btn btn-primary shadow-soft border-light animate-up-2" type="submit"> <i class="fas fa-search me-1"></i>Search</button>
            </div>
          </div>
        </form>