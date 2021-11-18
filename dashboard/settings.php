<?php
include_once "modifyAdmin.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";
?>
<main class="content bg-white">
  <?php include_once "inc/header.php"?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>  <li class="breadcrumb-item active" aria-current="page">
    <a href=" <?php echo basename(__FILE__) ?>"><?php echo basename(__FILE__, '.php') ?>
    </a>
  </li>
  </ol>
  </nav>
  <h2 class="h4">Settings</h2>
  <p class="mb-0">Update user profile.</p>
  </div>
  </div>
  <div class="card-body shadow-soft border-light animate-up-5 bg-white row justify-content-center">
    <!-- alert message -->
    <?php
    if (isset($_SESSION['message']) && isset($_SESSION['alert'])) { ?>
      <div class="<?php echo $_SESSION['alert'] ?>" role="alert">
        <span class="fas fa-bullhorn me-1"></span>
        <strong><?php echo $_SESSION['message'] ?></strong>
        <strong><?php echo $_SESSION['track'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
      unset($_SESSION['message']);
      unset($_SESSION['alert']);
    } ?>
    <h2 class="h5 mb-4">General information</h2>
    <form action="modifyAdmin.php" method="post">
      <div class="row mb-4 mb-lg-5">
        <div class="col-12 col-md-4">
          <div class="form-group"> <label for="name">Full name</label>

            <div class="input-group mb-4">
              <span class="input-group-text"><span class="fas far fa-user"></span></span>
              <input class="form-control" id="name" name="newName" type="text" placeholder="Enter your full name">
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8">
          <div class="row align-items-center">
            <div class="col"> <label for="email">Email</label>

              <div class="form-group">
                <div class="input-group input-group-border"><span class="input-group-text"><span class="fas fa-envelope-open"></span></span>
                  <input class="form-control" id="email" type="email" name="newEmail" placeholder="name@company.com">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group"><label for="password">Password</label>
                <div class="input-group input-group-border">
                  <span class="input-group-text"><span class="fas far fa-lock"></span></span>
                  <input class="form-control" id="password" type="password" name="newPassword" placeholder="abc123">
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary mt-2 " type="submit" name='update'>Update profile</button>
      </div>
    </form>
  </div>
  </div>

  </div>

  <?php include_once "inc/footer.php" ?>