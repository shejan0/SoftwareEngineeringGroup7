
   
<?php
include_once "../php/inc/user-connection.php";
include_once "inc/head.php";
include_once "inc/side-bar.php";

if(!isset($_SESSION['email']))
{
    $_SESSION['alert'] = "alert alert-danger alert-dismissible fade show";
    $_SESSION['message'] = "ERROR: You've signed out and do not have permission to access this page - please sign in again.";
    header("Location: ../html/admin-sign-in.php");
    exit();}
?>
<main class="content bg-white">
    <?php include_once "inc/header.php"; ?>
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
  <h2 class="h4">Placeholder for Reservation page</h2>
  </div>
  </div>
    </div>
    </div>
    
    <div class="card card-body border-0 shadow-soft border border-light animate-up-5 bg-white">
    <h2 class="h5 mb-4">Reservation</h2>
    </div>
    </div>

    </div>

    <?php include_once "inc/footer.php" ?>