<?php
include_once "modifyUser.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
?>
<main class="content bg-white">
  <?php include_once "inc/header.php"; ?>
  <li class="breadcrumb-item active" aria-current="page">
    <a href=" <?php echo basename(__FILE__) ?>"><?php echo basename(__FILE__, '.php') ?>
    </a>
  </li>
  </ol>
  </nav>
  <h2 class="h4">Settings</h2>
  <p class="mb-0">Update user profile.</p>
  </div>
  </div>

  <div class="card card-body border-0 shadow-soft border border-light animate-up-5 bg-white">
    <h2 class="h5 mb-4">General information</h2>
    <?php
    if (isset($_SESSION['message'])) { ?>
   <h2 class="h5 mb-4"><?php echo $_SESSION['message']; ?></h2>
    <?php
      unset($_SESSION['message']);
    } ?>
    <form action="modifyUser.php" method="post">
      <div class="row">
        <div class="col-md-6 mb-3">
          <div>
            <label for="first_name">First Name</label>
            <input class="form-control" id="first_name" name="first" type="text" placeholder="Enter your first name">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div>
            <label for="last_name">Last Name</label>
            <input class="form-control" id="last_name" name="last" type="text" placeholder="Enter your last name">
          </div>
        </div>

      </div>
      <div class="row align-items-center">
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" placeholder="name@company.com">
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" id="password" type="password" name="password" placeholder="abc123">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="mt-3">
          <button class="btn btn-gray-800 mt-2 " type="submit" name='update'>Update profile</button>
        </div>
    </form>
  </div>
  </div>

  </div>

  <?php include_once "inc/footer.php" ?>