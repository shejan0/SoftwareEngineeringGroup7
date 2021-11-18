<?php
include_once "../php/inc/user-connection.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
?>

<body>
  <main class="content bg-white">
    <?php include_once "inc/header.php"; ?>
    <div class="py-4">
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
            <div class="mt-3">
              <button class="btn btn-gray-800 mt-2 " type="submit" name='update'>Save all</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include_once "inc/footer.php" ?>