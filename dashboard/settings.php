<?php
include_once "../php/inc/user-connection.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
?>

<body>
  <main class="content bg-white">
    <?php include_once "inc/header.php"; ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
      <div>
        <div class="dropdown">
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
            <a class="dropdown-item d-flex align-items-center" href="#">
              <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
              </svg>
              Document
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
              </svg>
              Message
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
              </svg>
              Product
            </a>
            <div role="separator" class="dropdown-divider my-1"></div>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <svg class="dropdown-icon text-danger me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
              </svg>
              My Plan
            </a>
          </div>
        </div>
      </div>
      <div>
        <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
          <a class="dropdown-item d-flex align-items-center" href="#">
            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
              <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
            Products
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
            </svg>
            Customers
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
            </svg>
            Orders
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z" clip-rule="evenodd"></path>
            </svg>
            Console
          </a>
          <div role="separator" class="dropdown-divider my-1"></div>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <svg class="dropdown-icon text-gray-800 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
              <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
            </svg>
            All Reports
          </a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-xl-8">
        <div class="card card-body bg-white border-0 shadow-soft border border-light mb-4 ">
          <h2 class="h5 mb-4">General information</h2>
          <form>
            <div class="row">
              <div class="col-md-6 mb-3">
                <div>
                  <label for="first_name">First Name</label>
                  <input class="form-control" id="first_name" type="text" placeholder="Enter your first name" required>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div>
                  <label for="last_name">Last Name</label>
                  <input class="form-control" id="last_name" type="text" placeholder="Enter your last name" required>
                </div>
              </div>
              
            </div>
            <div class="row align-items-center">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input class="form-control" id="email" type="email" placeholder="name@company.com" required>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input class="form-control" id="password" type="password" placeholder="abc123" required>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input class="form-control" id="phone" type="number" placeholder="+12-345 678 910" required>
                </div>
              </div> -->
            </div>
            <!-- <h2 class="h5 my-4">Location</h2>
            <div class="row">
              <div class="col-sm-9 mb-3">
                <div class="form-group">
                  <label for="address">Address</label>
                  <input class="form-control" id="address" type="text" placeholder="Enter your home address" required>
                </div>
              </div>
              <div class="col-sm-3 mb-3">
                <div class="form-group">
                  <label for="number">Number</label>
                  <input class="form-control" id="number" type="number" placeholder="No." required>
                </div>
              </div>
            </div> -->
            <!-- <div class="row">
              <div class="col-sm-4 mb-3">
                <div class="form-group">
                  <label for="city">City</label>
                  <input class="form-control" id="city" type="text" placeholder="City" required>
                </div>
              </div>
              <div class="col-sm-4 mb-3">
                <label for="state">State</label>
                <select class="form-select w-100 mb-0" id="state" name="state" aria-label="State select example">
                  <option selected>State</option>
                  <option value="AL">Alabama</option>
                  <option value="AK">Alaska</option>
                  <option value="AZ">Arizona</option>
                  <option value="AR">Arkansas</option>
                  <option value="CA">California</option>
                  <option value="CO">Colorado</option>
                  <option value="CT">Connecticut</option>
                  <option value="DE">Delaware</option>
                  <option value="DC">District Of Columbia</option>
                  <option value="FL">Florida</option>
                  <option value="GA">Georgia</option>
                  <option value="HI">Hawaii</option>
                  <option value="ID">Idaho</option>
                  <option value="IL">Illinois</option>
                  <option value="IN">Indiana</option>
                  <option value="IA">Iowa</option>
                  <option value="KS">Kansas</option>
                  <option value="KY">Kentucky</option>
                  <option value="LA">Louisiana</option>
                  <option value="ME">Maine</option>
                  <option value="MD">Maryland</option>
                  <option value="MA">Massachusetts</option>
                  <option value="MI">Michigan</option>
                  <option value="MN">Minnesota</option>
                  <option value="MS">Mississippi</option>
                  <option value="MO">Missouri</option>
                  <option value="MT">Montana</option>
                  <option value="NE">Nebraska</option>
                  <option value="NV">Nevada</option>
                  <option value="NH">New Hampshire</option>
                  <option value="NJ">New Jersey</option>
                  <option value="NM">New Mexico</option>
                  <option value="NY">New York</option>
                  <option value="NC">North Carolina</option>
                  <option value="ND">North Dakota</option>
                  <option value="OH">Ohio</option>
                  <option value="OK">Oklahoma</option>
                  <option value="OR">Oregon</option>
                  <option value="PA">Pennsylvania</option>
                  <option value="RI">Rhode Island</option>
                  <option value="SC">South Carolina</option>
                  <option value="SD">South Dakota</option>
                  <option value="TN">Tennessee</option>
                  <option value="TX">Texas</option>
                  <option value="UT">Utah</option>
                  <option value="VT">Vermont</option>
                  <option value="VA">Virginia</option>
                  <option value="WA">Washington</option>
                  <option value="WV">West Virginia</option>
                  <option value="WI">Wisconsin</option>
                  <option value="WY">Wyoming</option>
                </select>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="zip">ZIP</label>
                  <input class="form-control" id="zip" type="tel" placeholder="ZIP" required>
                </div>
              </div>
            </div> -->
            <div class="mt-3">
              <button class="btn btn-gray-800 mt-2 " type="submit">Save all</button>
            </div>
          </form>
        </div>
        <div class="card card-body bg-white border-0 shadow-soft border border-light  mb-4">
              <h2 class="h5 mb-4">Select profile photo</h2>
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <!-- Avatar -->
                  <img class="avatar-xl me-4 rounded-circle shadow-soft border border-light" src="../assets/img/team/discord.png" alt="change avatar">
                </div>
                <div class="file-field">
                  <div class="d-flex justify-content-xl-center ms-xl-3">
                    <div class="d-flex">
                      <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                      </svg>
                      <input type="file" name='profile-photo'>
                      <div class="d-md-block text-left">
                        <div class="fw-normal text-dark mb-1">Choose Image</div>
                        <div class="text-gray small">JPG, GIF or PNG. Max size of 800K</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-body bg-white border-0 shadow-soft border border-light  mb-4">
              <h2 class="h5 mb-4">Select cover photo</h2>
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <!-- Avatar -->
                  <img class="avatar-xl me-4 rounded-circle shadow-soft border border-light" src="../assets/img/profile-cover.jpg" alt="change cover">
                </div>
                <div class="file-field">
                  <div class="d-flex justify-content-xl-center ms-xl-3">
                    <div class="d-flex">
                      <svg class="icon text-gray-500 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                      </svg>
                      <input type="file" name='cover-photo'>
                      <div class="d-md-block text-left">
                        <div class="fw-normal text-dark mb-1">Choose Image</div>
                        <div class="text-gray small">JPG, GIF or PNG. Max size of 800K</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      </div>
      
      <div class="col-12 col-xl-4">
        <div class="row">
          <div class="col-12 mb-4">
            <div class="card  bg-white shadow-soft border border-light text-center  p-0">
              <div class="profile-cover rounded-top" data-background="../assets/img/profile-cover.jpg"></div>
              <div class="card-body pb-5">
                <img src="../assets/img/team/discord.png" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
                <h4 class="h3">
                  <?php  echo $_SESSION['name']; ?>
                </h4>
                <h5 class="fw-normal"><?php echo $_SESSION['email']; ?></h5>
                <!-- <a class="btn btn-sm btn-gray-800 d-inline-flex align-items-center me-2" href="#">
                  <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                  </svg>
                  Connect
                </a>

                <a class="btn btn-sm btn-primary" href="#">Send Message</a> -->
              </div>
            </div>
          </div>
          <form action="../php/upload.php" method=POST>
          <div class="col-12">
          </div>
          <div class="col-12">        
          </div>
          </form>
        </div>
      </div>
    </div>
    <?php include_once "inc/footer.php" ?>
  </main>

  <!-- Core -->
  <script src="../vendor/@popperjs/core/dist/umd/popper.min.js"></script>
  <script src="../vendor/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Vendor JS -->
  <script src="../vendor/onscreen/dist/on-screen.umd.min.js"></script>

  <!-- Slider -->
  <script src="../vendor/nouislider/distribute/nouislider.min.js"></script>

  <!-- Smooth scroll -->
  <script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

  <!-- Charts -->
  <script src="../vendor/chartist/dist/chartist.min.js"></script>
  <script src="../vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

  <!-- Datepicker -->
  <script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

  <!-- Sweet Alerts 2 -->
  <script src="../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

  <!-- Moment JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

  <!-- Vanilla JS Datepicker -->
  <script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

  <!-- Notyf -->
  <script src="../vendor/notyf/notyf.min.js"></script>

  <!-- Simplebar -->
  <script src="../vendor/simplebar/dist/simplebar.min.js"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!-- Volt JS -->
  <script src="../assets/js/volt.js"></script>


</body>

</html>