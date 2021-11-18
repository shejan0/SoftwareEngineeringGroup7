<?php
include_once "../php/inc/user-connection.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
?>

<body>
  <main class="content bg-white">
    <?php include_once "inc/header.php"; ?>
    <li class="breadcrumb-item active" aria-current="page">
        <a href=" <?php echo basename(__FILE__) ?>"><?php echo basename(__FILE__, '.php') ?>
        </a>
    </li>
    <div class="py-4">
    </div>
    <div class="row">
      <div class="col-12 col-xl-8">
        <div class="card card-body bg-white border-0 shadow-soft border border-light mb-4 ">
          <h2 class="h5 mb-4">Placeholder for reservation page</h2>
            <div class="row">
              <div class="col-md-6 mb-3">
                <div>
                  <label>placeholder</label>
                  <input class="form-control"  type="text" placeholder="placeholder">
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div>
                  <label for="last_name">placeholder</label>
                  <input class="form-control" id="last_name" type="text" placeholder="placeholder">
                </div>
              </div>
              
            </div>
            <div class="row">
        </div>
      </div>
    </div>
    <?php include_once "inc/footer.php" ?>