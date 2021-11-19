<?php session_start()?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Admin Sign in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Pixel Bootstrap 5 - Sign in">
    <meta name="author" content="Themesberg">
    <meta name="description" content="Open source and free Bootstrap 5 UI Kit featuring 80 UI components, 5 example pages, and a Gulp and Sass workflow.">
    <link rel="canonical" href="https://themesberg.com/product/ui-kit/pixel-free-bootstrap-5-ui-kit">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon.ico">
    <link type="text/css" href="../vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link type="text/css" href="../css/pixel.css" rel="stylesheet">

</head>
<body>
    <main>
        <!-- Section -->
        <section class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark"
            data-background="../assets/img/pages/form-image.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div
                            class="signin-inner my-4 my-lg-0 bg-white  border rounded border-gray-300 p-4 p-lg-5 w-100 fmxw-500">
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
                        }
                        ?>
                            <p class="text-center">
                                <a href="../index.html" class="d-flex align-items-center justify-content-center">
                                    <span class="text-gray"><span class="fas fa-arrow-left me-2"></span>Back to homepage
                                </span>
                                </a>
                            </p>
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Employee Sign in</h1>
                            </div>
                            <form action="../php/server.php" method = "POST" class="mt-4">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="email">Your Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><span
                                                class="fas fa-envelope"></span></span>
                                        <input type="email" class="form-control" placeholder="example@company.com"
                                            id="email" name= 'email' required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Your Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2"><span
                                                    class="fas fa-unlock-alt"></span></span>
                                            <input type="password" placeholder="Password" class="form-control"
                                                id="password" name='password' required>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                </div>
                                <div class="d-grid">
                                   <button type="submit" class="btn btn-primary" name='admin-sign-in'>Sign in</button>
                                </div>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-1">
                                <span class="fw-normal">
                                     Customer?
                                    <a href="sign-in.php" class="fw-bold text-underline">Sign in here</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../vendor/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../vendor/headroom.js/dist/headroom.min.js"></script>

    <!-- Vendor JS -->
    <script src="../vendor/onscreen/dist/on-screen.umd.min.js"></script>
    <script src="../vendor/jarallax/dist/jarallax.min.js"></script>
    <script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="../vendor/vivus/dist/vivus.min.js"></script>
    <script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../assets/js/pixel.js"></script>
</body>
</html>