<?php
include_once "modifyAdmin.php";
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
  <div class="card-body shadow-soft border-light animate-up-5 bg-white row justify-content-center">
    <!-- alert message -->
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
    <h2 class="h5 mb-4">General information</h2>
    <?php
    if (isset($_SESSION['message'])) { ?>
      <h2 class="h5 mb-4"><?php echo $_SESSION['message']; ?></h2>
    <?php
      unset($_SESSION['message']);
    } ?>
    <form action="modifyAdmin.php" method="post">
      <div class="row mb-4 mb-lg-5">
        <div class="col-12 col-md-4">
          <div class="form-group"> <label for="name">Full name</label>

            <div class="input-group mb-4">
              <span class="input-group-text"><span class="fas far fa-user"></span></span>
              <input class="form-control" id="name" name="name" type="text" placeholder="Enter your full name">
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8">
          <div class="row align-items-center">
            <div class="col"> <label for="email">Email</label>

              <div class="form-group">
                <div class="input-group input-group-border"><span class="input-group-text"><span class="fas fa-envelope-open"></span></span>
                  <input class="form-control" id="email" type="email" name="email" placeholder="name@company.com">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group"><label for="password">Password</label>
                <div class="input-group input-group-border">
                  <span class="input-group-text"><span class="fas far fa-lock"></span></span>
                  <input class="form-control" id="password" type="password" name="password" placeholder="abc123">
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