<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>Nomupay</title>
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/landing/plugins/bootstrap/bootstrap.min.css">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/landing/plugins/themify-icons/themify-icons.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/landing/plugins/slick/slick.css">
    <!-- venobox popup -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/landing/plugins/Venobox/venobox.css">
    <!-- aos -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/landing/plugins/aos/aos.css">

    <!-- Main Stylesheet -->
    <link href="<?= base_url() ?>assets/landing/css/style.css" rel="stylesheet">

</head>

<body>
    <!-- navigation -->
    <section class="fixed-top navigation">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="/" style="font-weight: bold; font-size: 32px"><span>Nomu</span><span class="text-primary">Pay</span></a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- navbar -->
                <div class="collapse navbar-collapse text-center" id="navbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#feature">Feature</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://wa.me/6285710386771">Contact</a>
                        </li>
                    </ul>
                    <a href="<?= base_url() . (session()->get("isLoggedIn") ? 'mypanel/dashboard' : 'auth/register') ?>" class="btn btn-primary ml-lg-3 primary-shadow"><?= session()->get("isLoggedIn") ? "Dashboard" : "Sign Up" ?>
                </div>
            </nav>
        </div>
    </section>
    <!-- /navigation -->

    <!-- hero area -->
    <section class="hero-section hero" data-background="" style="background-image: url(<?= base_url() ?>assets/landing/images/hero-area/banner-bg.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center zindex-1">
                    <h1 class="mb-3">Take Control of </br>
                        Your E-Wallet
                    </h1>
                    <p class="mb-4">Get your exclusive e-wallet with NomuPay! Send, receive, and top up effortlessly</p>
                    <a href="<?= base_url() ?>auth/register" class="btn btn-secondary btn-lg">Get Started</a>
                    <!-- banner image -->
                    <img class="img-fluid w-100 banner-image shadow rounded" src="<?= base_url() ?>assets/landing/images/hero-area/banner-img-s.png" alt="banner-img">
                </div>
            </div>
        </div>
        <!-- background shapes -->
        <div id="scene">
            <img class="img-fluid hero-bg-1 up-down-animation" src="<?= base_url() ?>assets/landing/images/background-shape/feature-bg-2.png" alt="">
            <img class="img-fluid hero-bg-2 left-right-animation" src="<?= base_url() ?>assets/landing/images/background-shape/seo-ball-1.png" alt="">
            <img class="img-fluid hero-bg-3 left-right-animation" src="<?= base_url() ?>assets/landing/images/background-shape/seo-half-cycle.png" alt="">
            <img class="img-fluid hero-bg-4 up-down-animation" src="<?= base_url() ?>assets/landing/images/background-shape/green-dot.png" alt="">
            <img class="img-fluid hero-bg-5 left-right-animation" src="<?= base_url() ?>assets/landing/images/background-shape/blue-half-cycle.png" alt="">
            <img class="img-fluid hero-bg-6 up-down-animation" src="<?= base_url() ?>assets/landing/images/background-shape/seo-ball-1.png" alt="">
            <img class="img-fluid hero-bg-7 left-right-animation" src="<?= base_url() ?>assets/landing/images/background-shape/yellow-triangle.png" alt="">
            <img class="img-fluid hero-bg-8 up-down-animation" src="<?= base_url() ?>assets/landing/images/background-shape/service-half-cycle.png" alt="">
            <img class="img-fluid hero-bg-9 up-down-animation" src="<?= base_url() ?>assets/landing/images/background-shape/team-bg-triangle.png" alt="">
        </div>
    </section>
    <!-- /hero-area -->

    <!-- feature -->
    <section class="section feature mb-0 pb-0" id="feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Awesome Features</h2>
                    <p class="mb-100">By using NomuPay, you will got the best features for your business</p>
                </div>
                <!-- feature item -->
                <div class="col-md-6 mb-80">
                    <div class="d-flex feature-item">
                        <div>
                            <i class="ti-shopping-cart feature-icon mr-4"></i>
                        </div>
                        <div>
                            <h4>Transaction</h4>
                            <p>Handle any transaction in your business with NomuPay</p>
                        </div>
                    </div>
                </div>
                <!-- feature item -->
                <div class="col-md-6 mb-80">
                    <div class="d-flex feature-item">
                        <div>
                            <i class="ti-wallet feature-icon mr-4"></i>
                        </div>
                        <div>
                            <h4>Send Money</h4>
                            <p>Your customer will be able to send balance to each other wallet</p>
                        </div>
                    </div>
                </div>
                <!-- feature item -->
                <div class="col-md-6 mb-80">
                    <div class="d-flex feature-item">
                        <div>
                            <i class="ti-package feature-icon mr-4"></i>
                        </div>
                        <div>
                            <h4>Receive Money</h4>
                            <p>Your customer will be able to receive balance from the others</p>
                        </div>
                    </div>
                </div>

                <!-- feature item -->
                <div class="col-md-6 mb-80">
                    <div class="d-flex feature-item">
                        <div>
                            <i class="ti-lock feature-icon mr-4"></i>
                        </div>
                        <div>
                            <h4>Secure</h4>
                            <p>Security is our top priority to make sure all of our users are safe when using NomuPay</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img class="feature-bg-1 up-down-animation" src="<?= base_url() ?>assets/landing/images/background-shape/feature-bg-1.png" alt="bg-shape">
        <img class="feature-bg-2 left-right-animation" src="<?= base_url() ?>assets/landing/images/background-shape/feature-bg-2.png" alt="bg-shape">
    </section>
    <!-- /feature -->

    <!-- footer -->
    <footer class="footer-section footer" style="background-image: url(<?= base_url() ?>assets/landing/images/backgrounds/footer-bg.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-center text-lg-left mb-4 mb-lg-0">
                    <!-- logo -->
                    <a href="/" style="font-weight: bold; font-size: 32px">
                        <span class="text-dark">Nomu</span><span class="text-primary">Pay</span>
                    </a>
                </div>
                <!-- footer menu -->
                <nav class="col-lg-8 align-self-center mb-5">
                    <ul class="list-inline text-lg-right text-center footer-menu">
                        <li class="list-inline-item active"><a href="/">Home</a></li>
                        <li class="list-inline-item"><a class="page-scroll" href="#feature">Feature</a></li>
                        <li class="list-inline-item"><a href="https://wa.me/6285710386771">Contact</a></li>
                    </ul>
                </nav>
                <!-- footer social icon -->
                <nav class="col-12">
                    <ul class="list-inline text-lg-right text-center social-icon">
                        <li class="list-inline-item">
                            <a class="facebook" href="/"><i class="ti-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="twitter" href="/"><i class="ti-twitter-alt"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="linkedin" href="/"><i class="ti-linkedin"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="black" href="/"><i class="ti-github"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </footer>
    <!-- /footer -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/landing/plugins/jQuery/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>assets/landing/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="<?= base_url() ?>assets/landing/plugins/slick/slick.min.js"></script>
    <!-- venobox -->
    <script src="<?= base_url() ?>assets/landing/plugins/Venobox/venobox.min.js"></script>
    <!-- aos -->
    <script src="<?= base_url() ?>assets/landing/plugins/aos/aos.js"></script>
    <!-- Main Script -->
    <script src="<?= base_url() ?>assets/landing/js/script.js"></script>

</body>

</html>
