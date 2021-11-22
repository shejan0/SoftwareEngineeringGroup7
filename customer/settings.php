<?php
include_once "php/head.php";
include_once "php/header.php";
include_once "../php/inc/user-connection.php";
?>
    <section class="py-5 bg-white shadow-inset border-light">
      <div class="container">
        <h1 class="hero-heading mb-0">Personal info</h1>
        <p class="text-muted mb-5">Manage your Personal info and settings here.</p>
        <div class="row">
          <div class="col-lg-7 mb-5 mb-lg-0 shadow-soft border-light">
            <div class="text-block"> 
              <div class="row mb-3">
                <div class="col-sm-9">
                  <h5>Personal Details</h5>
                </div>
                <div class="col-sm-3 text-end">
                  <button class="btn btn-link ps-0 text-primary collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#personalDetails" aria-expanded="false" aria-controls="personalDetails">Update</button>
                </div>
              </div>
              <p class="text-sm text-muted"><i class="fa fa-id-card fa-fw me-2"></i><?php echo $_SESSION['name']?><br>
              <i class="fa fa-envelope-open fa-fw me-2"></i><?php echo $_SESSION['email']?> </p>
              <div class="collapse" id="personalDetails">
                <form action="modifyCustomer.php" method="post">
                  <div class="row pt-4">
                    <div class="mb-4 col-md-6">
                      <label class="form-label" for="name">Name</label>
                      <input class="form-control" type="text" name="newName" id="name" placeholder="name">
                    </div>
                    <div class="mb-4 col-md-6">
                      <label class="form-label" for="email">Email address</label>
                      <input class="form-control" type="email" name="newEmail" id="email" placeholder="email">
                    </div>
                    <div class="mb-4 col-md-6">
                      <label class="form-label" for="password">Password</label>
                      <input class="form-control" type="text" name="newPassword" id="password" placeholder="password">
                    </div>
                  </div>
                  <button class="btn btn-outline-primary mb-4" type="submit" name = "update">Save your personal details</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php
include_once "php/footer.php";  ?>
    <!-- Footer-->