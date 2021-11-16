<?php
session_set_cookie_params(0);
session_start();

// Checks if user is logged in by checkign if email is set, if not logged in redirect to sign-in page.
// ensures along with logout.php that once sign out - user won't be able to access the site that only is available to logged in users
if(!isset($_SESSION['email']))
{
    header("Location: ../html/sign-in.html");
}
?>

<body style="padding-top: 72px;">
    <header class="header">
        <!-- Navbar-->
        <nav id="navbar-main" aria-label="Primary navigation" class="navbar navbar-expand-lg fixed-top shadow navbar-light bg-white">
            <div class="container-fluid position-relative">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand py-1" href="/">
                        <img src="../assets/img/brand/dark.svg" alt="Directory logo"></a>
                </div>
                <div class="navbar-collapse collapse me-auto" id="navbar_global">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <a href="#navbar_global" class="fas fa-times" data-bs-toggle="collapse" data-bs-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="customer.php">Customer Home</a></li>

                    </ul>
                </div>
                <div class="d-flex align-items-center ">
                    <div class="btn-group mb-2 me-2">
                        <button type="button" class="btn btn-sm btn-white rounded-circle shadow-soft border-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-user"></span>
                        </button>
                        <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                            <span class="mb-0 font-medium">
                                <?php
                                if(isset($_SESSION['email']))
                                {
                                    echo $_SESSION['name'];
                                }
                                ?>
                            </span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-end">
                            <span class="dropdown-item rounded-top">Hi,
                            <?php
                                if(isset($_SESSION['email']))
                                {
                                    echo $_SESSION['name'];
                                }
                                ?>
                            </span>
                            <a class="dropdown-item" href="customer.php">Customer Home</a>
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item rounded-bottom" href="../php/logout.php">
                                <span class="fas fa-sign-out-alt"></span>
                                Sign out</a>
                        </div>
                        <button class="navbar-toggler ms-2  shadow-soft border-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </nav>
        <!-- /Navbar -->
    </header>