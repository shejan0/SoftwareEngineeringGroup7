<?php
include_once "php/head.php";
include_once "php/header.php";

?>

  <div class="container-fluid bg-white">
    <div class="row">
      <div class="col-lg-6 py-4 p-xl-5">
        <h2 class="mb-4">San Antonio, TX</h2>
        <hr class="my-4">
        <?php include_once "php/search-filter.php" ?>
        <hr class="my-4">
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">
          <div class="me-3">
            <p class="mb-3 mb-md-0"><strong>12</strong> results found</p>
          </div>
          <div>
            <label class="form-label me-2" for="form_sort">Sort by</label>
            <select class="selectpicker" name="sort" id="form_sort" data-style="btn-selectpicker" title="">
              <option value="sortBy_0">Most popular </option>
              <option value="sortBy_1">A-Z </option>
              <option value="sortBy_2">High-Low </option>
              <option value="sortBy_3">Low-High </option>
            </select>
          </div>
        </div>
        <div class="row">
          <!-- place item-->
          <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e33b1527bfe2abaf92">
            <div class="card h-100  shadow-soft border-light animate-up-2 bg-white">
              <div class="card-img-top overflow-hidden gradient-overlay">
                <img class="img-fluid" src="../assets/img/hotels/hotel-room1.jpeg"
                  alt="Modern, Well-Appointed Room" />
                <a class="tile-link" href="#"></a>
                <div class="card-img-overlay-bottom z-index-20">
                  <div class="d-flex text-white text-sm align-items-center">
                    <!-- <img class="avatar avatar-border-white flex-shrink-0 me-2" src="../img/avatar/avatar-0.jpg" alt="Pamela"/>
                      <div>Pamela</div> -->
                  </div>
                </div>
              </div>
              <div class="card-body d-flex align-items-center">
                <div class="w-100">
                  <h6 class="card-title"><a class="text-decoration-none text-dark" href="#">Modern,
                      Well-Appointed Room</a></h6>
                  <div class="d-flex card-subtitle mb-3">
                    <p class="flex-grow-1 mb-0 text-muted text-sm">Private room</p>
                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                    </p>
                  </div>
                  <p class="card-text text-muted"><span class="h4 text-secondary">$180</span> per night</p>
                </div>
              </div>
            </div>
          </div>
          <!-- place item-->
          <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e322f3375db4d89128">
            <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
              <div class="card-img-top overflow-hidden gradient-overlay">
                <img class="img-fluid" src="../assets/img/hotels/hotel-room2.jpeg"
                  alt="Cute Quirky Garden apt, NYC adjacent" />
                <a class="tile-link" href="#"></a>
                <div class="card-img-overlay-bottom z-index-20">
                  <div class="d-flex text-white text-sm align-items-center">
                  </div>
                </div>
              </div>
              <div class="card-body d-flex align-items-center">
                <div class="w-100">
                  <h6 class="card-title"><a class="text-decoration-none text-dark" href="#">Cute Quirky
                      Garden apt, NYC adjacent</a></h6>
                  <div class="d-flex card-subtitle mb-3">
                    <p class="flex-grow-1 mb-0 text-muted text-sm">King suitet</p>
                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300"> </i>
                    </p>
                  </div>
                  <p class="card-text text-muted"><span class="h4 text-primary">$121</span> per night</p>
                </div>
              </div>
            </div>
          </div>
          <!-- place item-->
          <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e3a31e62979bf147c9">
            <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
              <div class="card-img-top overflow-hidden gradient-overlay">
                <img class="img-fluid" src="../assets/img/hotels/hotel-room3.jpeg"
                  alt="Modern Apt - Vibrant Neighborhood!" />
                <a class="tile-link" href="#"></a>
                <div class="card-img-overlay-bottom z-index-20">
                  <div class="d-flex text-white text-sm align-items-center">
                  </div>
                </div>
              </div>
              <div class="card-body d-flex align-items-center">
                <div class="w-100">
                  <h6 class="card-title"><a class="text-decoration-none text-dark" href="#">
                      Modern Vibrant room</a>
                  </h6>
                  <div class="d-flex card-subtitle mb-3">
                    <p class="flex-grow-1 mb-0 text-muted text-sm">Queen suite</p>
                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-end">
                      <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300"> </i><i
                        class="fa fa-star text-gray-300"> </i>
                    </p>
                  </div>
                  <p class="card-text text-muted"><span class="h4 text-primary">$75</span> per night</p>
                </div>
              </div>
            </div>
          </div>
          <!-- place item-->
          <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e3503eb77d487e8082">
            <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
              <div class="card-img-top overflow-hidden gradient-overlay">
                <img class="img-fluid" src="../assets/img/hotels/hotel-room4.jpeg"
                  alt="Sunny Private Studio-Apartment" />
                <a class="tile-link" href="#"></a>
                <div class="card-img-overlay-bottom z-index-20">
                  <div class="d-flex text-white text-sm align-items-center">
                  </div>
                </div>
              </div>
              <div class="card-body d-flex align-items-center">
                <div class="w-100">
                  <h6 class="card-title"><a class="text-decoration-none text-dark" href="#">Sunny
                      Private Studio room</a></h6>
                  <div class="d-flex card-subtitle mb-3">
                    <p class="flex-grow-1 mb-0 text-muted text-sm">Standard suite</p>
                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300"> </i>
                    </p>
                  </div>
                  <p class="card-text text-muted"><span class="h4 text-primary">$93</span> per night</p>
                </div>
              </div>
            </div>
          </div>
          <!-- place item-->
          <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e39aa2eed0626e485d">
            <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
              <div class="card-img-top overflow-hidden gradient-overlay"> <img class="img-fluid"
                  src="../assets/img/hotels/hotel-room5.jpeg" alt="Mid-Century Modern Garden Paradise" /><a
                  class="tile-link" href="#"></a>
                <div class="card-img-overlay-bottom z-index-20">
                  <div class="d-flex text-white text-sm align-items-center">
                  </div>
                </div>
              </div>
              <div class="card-body d-flex align-items-center">
                <div class="w-100">
                  <h6 class="card-title"><a class="text-decoration-none text-dark" href="#">Mid-Century
                      Modern Garden room</a></h6>
                  <div class="d-flex card-subtitle mb-3">
                    <p class="flex-grow-1 mb-0 text-muted text-sm">Standard suite</p>
                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>
                    </p>
                  </div>
                  <p class="card-text text-muted"><span class="h4 text-primary">$115</span> per night</p>
                </div>
              </div>
            </div>
          </div>
          <!-- place item-->
          <div class="col-sm-6 mb-5 hover-animate" data-marker-id="59c0c8e39aa2edasd626e485d">
            <div class="card h-100 shadow-soft border-light animate-up-2 bg-white">
              <div class="card-img-top overflow-hidden gradient-overlay"> <img class="img-fluid"
                  src="../assets/img/hotels/hotel-room6.jpeg" alt="Brooklyn Life, Easy to Manhattan" /><a
                  class="tile-link" href="#"></a>
                <div class="card-img-overlay-bottom z-index-20">
                  <div class="d-flex text-white text-sm align-items-center">
                  </div>
                </div>
              </div>
              <div class="card-body d-flex align-items-center">
                <div class="w-100">
                  <h6 class="card-title"><a class="text-decoration-none text-dark" href="#">Standard room</a></h6>
                  <div class="d-flex card-subtitle mb-3">
                    <p class="flex-grow-1 mb-0 text-muted text-sm">Studio suite</p>
                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-end"><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i
                        class="fa fa-star text-warning"></i><i class="fa fa-star text-gray-300"> </i>
                    </p>
                  </div>
                  <p class="card-text text-muted"><span class="h4 text-primary">$123</span> per night</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
          <ul class="pagination pagination-template d-flex justify-content-center ">
            <li class="page-item "><a class="page-link" href="#"> <i class="fa fa-angle-left"></i></a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#"> <i class="fa fa-angle-right"></i></a></li>
          </ul>
        </nav>
      </div>
      <div class="col-lg-6 map-side-lg pe-lg-0">
        <div class="map-full shadow-soft border-light" id="categorySideMap"></div>
      </div>
    </div>
  </div>
  <?php
include_once "php/footer.php";  ?>
  <script>
  createListingsMap({
    mapId: 'categorySideMap',
    jsonFile: '../assets/js/cities-map/san-antonio.json',
    mapPopupType: 'rental',
    useTextIcon: true,
    // tileLayer: tileLayers[5]  - uncomment for a different map styling
  });
</script>

