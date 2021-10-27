<?php
ob_start();
include_once "php/head.php";
include_once "php/header.php";

if(!isset($_SESSION['email']))
{
    header("Location: ../html/sign-in.html");
}
?>
    <main>
        <section class="section section-header bg-primary text-white ">
            <img class="bg-image" src="../assets/img/city/coastline.jpg" alt="">
            <div class="container z-2">
                <div class="row justify-content-center text-center pt-6">
                    <div class="col-12 text-center">
                        <div class="bootstrap-big-icon d-none d-lg-block">
                        </div>
                        <h1 class="fw-bolder display-2">Need a place to stay? Find the hotel you're looking for</h1>
            
                        <h2 class="lead fw-normal text-white mb-4 px-lg-10">Your city's best hotels,ready to be booked
                            online.
                        </h2>
                        <form>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg rounded-start"
                                        placeholder="City">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <section class="section section-lg bg-white">
            <div class="container">
                <div class="row mb-2 mb-lg-2">
                    <div class="col-12 col-md-9 col-lg-8 text-center mx-auto">
                        <h2 class="h1 mb-4">Book your next destination from the best hotels in your city.
                        </h2>
                    </div>
                </div>
                <div class="row mb-5 mb-lg-6">
                    <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="card shadow border-gray-300 bg-white shadow-soft border-light animate-up-4">
                            <a href="la.php">
                                <img src="../assets/img/city/la.jpg" class="card-img-top rounded" alt="LA">
                                <div class="card-body">
                                    <h3 class="h4 card-title mb-2">Los Angeles, CA</h3>
                                    <span class="card-subtitle text-gray fw-normal">The City of Angels</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="card shadow border-gray-300 bg-white shadow-soft border-light animate-up-4">
                            <a href="ny.php">
                            <img src="../assets/img/city/ny.jpeg" class="card-img-top rounded" alt="NYC">
                            <div class="card-body">
                                <h3 class="h4 card-title mb-2">New York City, NY</h3>
                                <span class="card-subtitle text-gray fw-normal">The Big Apple</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="card shadow border-gray-300 bg-white shadow-soft border-light animate-up-4">
                            <a href="chicago.php">
                            <img src="../assets/img/city/chicago.jpeg" class="card-img-top rounded"
                                alt="Chicago">
                            <div class="card-body">
                                <h3 class="h4 card-title mb-2">Chicago, IL</h3>
                                <span class="card-subtitle text-gray fw-normal">The Windy City</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="row mb-2 mb-lg-2">
                        <div class="col-12 col-md-1 col-lg-8 text-center mx-auto">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="card shadow border-gray-300 bg-white shadow-soft border-light animate-up-4">
                            <a href="seattle.php">
                            <img src="../assets/img/city/seattle.jpeg" class="card-img-top rounded"
                                alt="Seattle">
                            <div class="card-body">
                                <h3 class="h4 card-title mb-2">Seattle WA</h3>
                                <span class="card-subtitle text-gray fw-normal">The Emerald City</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="card shadow border-gray-300 bg-white shadow-soft border-light animate-up-4">
                            <a href="sf.php">
                            <img src="../assets/img/city/golden-gate.jpg" class="card-img-top rounded"
                                alt="San Francisco">
                            <div class="card-body">
                                <h3 class="h4 card-title mb-2">San Francisco, CA</h3>
                                <span class="card-subtitle text-gray fw-normal">The Golden City</span>
                            </div>
                        </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                        <div class="card shadow border-gray-300 bg-white shadow-soft border-light animate-up-4">
                            <a href="sa.php">
                            <img src="../assets/img/city/san-antonio.jpeg" class="card-img-top rounded"
                                alt="San antonio">
                            <div class="card-body">
                                <h3 class="h4 card-title mb-2">San Antonio, CA</h3>
                                <span class="card-subtitle text-gray fw-normal">The Alamo City</span>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="row mb-2 mb-lg-2">
                    <div class="col-12 col-md-9 col-lg-8 text-center mx-auto">
                        <h2 class="h1 mb-4">Discover new destinations.</h2>
                        <span class="lead mb-4 text-gray">Own a hotel? Improve your workflow and help customers discover
                            you through Portal.
                        </span>
                        <!-- <div class="mb-3 mt-4">
                            <a href="#"
                                class="btn btn-lg btn-primary rounded-pill animate-up-4 text-white shadow-soft border-light"
                                type="button">Learn More</a>
                        </div> -->
                        <!--Buttons-->
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer pt-6 pb-5 bg-primary text-white ">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="navbar-brand-dark mb-4" height="35" src="../assets/img/brand/light.svg" alt="Logo">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    <ul class="social-buttons mb-5 mb-lg-0">
                        <button class="btn btn-icon-only btn-facebook animate-up-3 rounded-pill" type="button" aria-label="facebook button"
                            title="facebook button">
                            <span aria-hidden="true" class="fab fa-facebook"></span>
                        </button>
                        <button class="btn btn-icon-only btn-twitter text-white animate-up-3 rounded-pill" type="button"
                            aria-label="pinterest button" title="pinterest button">
                            <span aria-hidden="true" class="fab fa-twitter"></span>
                        </button>
                        <button class="btn btn-icon-only btn-instagram animate-up-3 rounded-pill" type="button" aria-label="youtube button"
                            title="youtube button">
                            <span aria-hidden="true" class="fab fa-instagram"></span>
                        </button>
                        <button class="btn btn-icon-only btn-github animate-up-3 rounded-pill" type="button" aria-label="behance button"
                            title="behance button">
                            <span aria-hidden="true" class="fab fa-github"></span>
                        </button>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-5 mb-lg-0">
                    <span class="h5">Portal</span>
                    <ul class="footer-links mt-2">
                        <li><a # href="#">Home</a></li>
                        <li><a # href="#">Something here</a></li>
                        <li><a # href="#">Something here</a></li>
                        <li><a # href="#">Something here</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-5 mb-lg-0">
                    <span class="h5">Something here</span>
                    <ul class="footer-links mt-2">
                        <li><a href="#" #>Something here</a></li>
                        <li><a href="#" #>Something here</a></li>
                        <li><a # href="#">Something here</a>
                        </li>
                        <li><a # href="#">Something here</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-4 mb-5 mb-lg-0">
                    <span class="h5">Subscribe</span>
                    <p class="text-muted font-small mt-2">Join our mailing list. We write rarely, but only the best
                        content.
                    </p>
                    <form action="#">
                        <div class="form-row mb-2">
                            <div class="col-12">
                                <label class="h6 fw-normal text-muted d-none" for="exampleInputEmail3">Email
                                    address</label>
                                <input type="email" class="form-control mb-2" placeholder="example@company.com"
                                    name="email" aria-label="Subscribe form" id="exampleInputEmail3" required>
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-tertiary animate-up-2" data-loading-text="Sending">
                                    <span>Subscribe</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="text-muted font-small m-0">We’ll never share your details. See our Privacy Policy</p>
                </div>
            </div>
            <hr class="bg-primary my-3 my-lg-5">
            <div class="row">
                <div class="col mb-md-0">
                    <a href="#" # class="d-flex justify-content-center mb-3">
                        <img src="../assets/img/brand/light.svg" height="30" class="me-2" alt="Logo">
                        <p class="text-white fw-bold footer-logo-text m-0">Portal</p>
                    </a>
                    <div class="d-flex text-center justify-content-center align-items-center" role="contentinfo">
                        <p class="fw-normal font-small mb-0">Copyright © Portal 2021. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
?>
    <!-- Core -->
    <script src="../vendor/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="../vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../vendor/headroom.js/dist/headroom.min.js"></script>

    <!-- Vendor JS -->
    <script src="../vendor/onscreen/dist/on-screen.umd.min.js"></script>
    <script src="../vendor/jarallax/dist/jarallax.min.js"></script>
    <script src="../vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="../vendor/vivus/dist/vivus.min.js"></script>
    <script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/js/swiper.min.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Pixel JS -->
    <script src="../assets/js/pixel.js"></script>
</body>

</html>