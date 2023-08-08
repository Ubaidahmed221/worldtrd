<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>World TrD - Trading Company</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="{{ url('/') }}/public/website_resource/images/logo.png"> --}}
    <link rel="shortcut icon" href="{{ url('/') }}/public/myimages/worldtrd.jpg">

    <!-- Template CSS Files -->
    <link rel="stylesheet" href="{{ url('/') }}/public/website_resource/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/website_resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/website_resource/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/website_resource/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/website_resource/css/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/public/website_resource/css/skins/orange.css">

    <!-- Live Style Switcher - demo only -->
    <link rel="alternate stylesheet" type="text/css" title="orange"
        href="{{ url('/') }}/public/website_resource/css/skins/orange.css" />
    <link rel="alternate stylesheet" type="text/css" title="green"
        href="{{ url('/') }}/public/website_resource/css/skins/green.css" />
    <link rel="alternate stylesheet" type="text/css" title="blue"
        href="{{ url('/') }}/public/website_resource/css/skins/blue.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/website_resource/css/styleswitcher.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template JS Files -->
    <script src="{{ url('/') }}/public/website_resource/js/modernizr.js"></script>

</head>

<body >
    <!-- SVG Preloader Starts -->
    <div id="preloader">
        <div id="preloader-content">
            {{-- <img src="{{ url('/') }}/public/website_resource/images/loading.png" alt=""> --}}
            {{-- <img src="{{ url('/') }}/public/myimages/worldtrd.jpg" alt=""> --}}
            <div class="d-flex justify-content-center text-white">
                <div class="spinner-border text-white" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>

        </div>
    </div>
    <!-- SVG Preloader Ends -->
    <!-- Live Style Switcher Starts - demo only -->

    <!-- Live Style Switcher Ends - demo only -->
    <!-- Wrapper Starts -->
    <div class="wrapper">
        <!-- Header Starts -->
        <header class="header">
            <div class="container">
                <div class="row">
                    <!-- Logo Starts -->
                    <div class="main-logo col-xs-12 col-md-3 col-md-2 col-lg-2 hidden-xs">
                        <a href="{{ url('/') }}">
                            <img id="logo" class="img-responsive"
                                {{-- src="{{ url('/') }}/public/website_resource/images/logo.png" alt="logo"> --}}
                                src="{{ url('/') }}/public/myimages/worldtrd.jpg" alt="logo">
                        </a>
                    </div>
                    <!-- Logo Ends -->
                    <!-- Statistics Starts -->
                    <div class="col-md-7 col-lg-7">
                        <div style="margin-top: 25px !important;">
                            <marquee class="" behavior="" direction="">
                                @if (session()->has('notification'))
                                    {{ session()->get('notification') }}
                                @endif
                            </marquee>
                        </div>
                    </div>
                    <!-- Statistics Ends -->
                    <!-- User Sign In/Sign Up Starts -->

                    <div class="col-md-3 col-lg-3">
                        <ul class="unstyled user" >

                            @if (session()->has('email'))
                                {{-- <li class="dropdown " style="position: relative; z-index: 881;margin-right:50px;"> --}}
                                <li class="dropdown " style="position: relative;margin-right:50px;">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="fa fa-user"></i> {{ session()->get('name') }}
                                        <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu w-50" style="z-index: 991;" >
                                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="sign-in"><a href="{{ url('/login') }}" class="btn btn-primary"><i
                                            class="fa fa-user"></i> sign in</a></li>

                            @endif

                        </ul>

                    </div>
                    <!-- User Sign In/Sign Up Ends -->
                </div>
            </div>
            <!-- Navigation Menu Starts -->
            <nav class="site-navigation navigation" id="site-navigation" style="z-index: 89;">
                <div class="container">
                    <div class="site-nav-inner">
                        <!-- Logo For ONLY Mobile display Starts -->
                        <a class="logo-mobile" href="index.html">
                            <img id="logo-mobile" class="img-responsive"
                                src="{{ url('/') }}/public/myimages/worldtrd.jpg" alt="logo">

                        </a>
                        <!-- Logo For ONLY Mobile display Ends -->
                        <!-- Toggle Icon for Mobile Starts -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Toggle Icon for Mobile Ends -->
                        <div class="collapse navbar-collapse navbar-responsive-collapse" >
                            <!-- Main Menu Starts -->
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/about') }}">About Us</a></li>
                                <li><a href="{{ url('/plans') }}">Plans</a></li>
                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>


                                <!-- <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">pages <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="register.html">Register page</a></li>
                                        <li><a href="login.html">Login page</a></li>
          <li><a href="shopping-cart.html">Shopping cart</a></li>
                                        <li><a href="shopping-checkout.html">shopping checkout</a></li>
                                        <li><a href="faq.html">FAQ page</a></li>
                                        <li><a href="404.html">404 Page</a></li>
          <li><a href="503.html">Server Error Page</a></li>
                                        <li><a href="terms-of-services.html">Terms of Services</a></li>
          <li><a href="coming-soon.html">Coming Soon</a></li>
                                    </ul>
                                </li> -->
                                <!-- Search Icon Ends -->
                            </ul>
                            <!-- Main Menu Ends -->
                        </div>
                    </div>
                </div>
                <!-- Search Input Starts -->
                <div class="site-search">
                    <div class="container">
                        <input type="text" placeholder="type your keyword and hit enter ...">
                        <span class="close">×</span>
                    </div>
                </div>
                <!-- Search Input Ends -->
            </nav>
            <!-- Navigation Menu Ends -->
        </header>
        <!-- Header Ends -->


        @yield('content')



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <!-- Footer Starts -->
        <footer class="footer">
            <!-- Footer Top Area Starts -->
            <div class="top-footer">
                <div class="container">
                    <div class="row">
                        <!-- Footer Widget Starts -->
                        <div class="col-sm-4 col-md-2">
                            <h4>Our Company</h4>
                            <div class="menu">
                                <ul>
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('/about') }}">About</a></li>
                                    <li><a href="{{ url('/plan') }}">Our Plans</a></li>
                                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Widget Ends -->
                        <!-- Footer Widget Starts -->
                        <div class="col-sm-4 col-md-2">
                            <h4>Help & Support</h4>
                            <div class="menu">
                                {{-- <ul>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="terms-of-services.html">Terms of Services</a></li>
                                    <li><a href="404.html">404</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                </ul> --}}
                                <ul>
                                    <li><a href="{{ url('/about') }}">FAQ</a></li>
                                    <li><a href="terms-of-services.html">Terms of Services</a></li>
                                    <li><a href="{{ url('/about') }}">404</a></li>
                                    <li><a href="login.html">Login</a></li>

                                    <li><a href="{{ url('/about') }}">Coming Soon</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Widget Ends -->
                        <!-- Footer Widget Starts -->
                        <div class="col-sm-4 col-md-3">
                            <h4>Contact Us </h4>
                            <div class="contacts">
                                <div>
                                    <span>contact@website.com</span>
                                </div>
                                <div>
                                    <span>00216 21 184 010</span>
                                </div>
                                <div>
                                    <span>London, England</span>
                                </div>
                                <div>
                                    <span>mon-sat 08am &#x21FE; 05pm</span>
                                </div>
                            </div>
                            <!-- Social Media Profiles Starts -->
                            <div class="social-footer">
                                <ul>
                                    <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <!-- Social Media Profiles Ends -->
                        </div>
                        <!-- Footer Widget Ends -->
                        <!-- Footer Widget Starts -->
                        <div class="col-sm-12 col-md-5">
                            <!-- Facts Starts -->
                            <div class="facts-footer">
                                <div>
                                    <h5>$198.76B</h5>
                                    <span>Market cap</span>
                                </div>
                                <div>
                                    <h5>243K</h5>
                                    <span>daily transactions</span>
                                </div>
                                <div>
                                    <h5>369K</h5>
                                    <span>active accounts</span>
                                </div>
                                <div>
                                    <h5>127</h5>
                                    <span>supported countries</span>
                                </div>
                            </div>
                            <!-- Facts Ends -->
                            <hr>
                            <!-- Supported Payment Cards Logo Starts -->
                            <div class="payment-logos">
                                <h4 class="payment-title">supported payment methods</h4>
                                {{-- <img src="{{ url('/') }}/public/website_resource/images/icons/payment/american-express.png"
                                    alt="american-express"> --}}
                                <img src="{{ url('/') }}/public/website_resource/images/icons/payment/mastercard.png"
                                    alt="mastercard">
                                <img src="{{ url('/') }}/public/website_resource/images/icons/payment/visa.png"
                                    alt="visa">
                                {{-- <img src="{{ url('/') }}/public/website_resource/images/icons/payment/paypal.png"
                                    alt="paypal"> --}}
                                <img class="last"
                                    src="{{ url('/') }}/public/website_resource/images/icons/payment/maestro.png"
                                    alt="maestro">
                                    <img
                                    src="{{ url('/') }}/public/myimages/USDTimg.png"
                                    alt="usd">
                                    <img
                                    src="{{ url('/') }}/public/myimages/faysalbank.png"
                                    alt="faysalbank">
                            </div>
                            <!-- Supported Payment Cards Logo Ends -->
                        </div>
                        <!-- Footer Widget Ends -->
                    </div>
                </div>
            </div>
            <!-- Footer Top Area Ends -->
            <!-- Footer Bottom Area Starts -->
            <div class="bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Copyright Text Starts -->
                            <p class="text-center">Created with Love by <a href="templateshub.net"
                                    target="_blank">World TrD</a></p>
                            <!-- Copyright Text Ends -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom Area Ends -->
        </footer>
        <!-- Footer Ends -->
        <!-- Back To Top Starts  -->
        <a href="#" id="back-to-top" class="back-to-top fa fa-arrow-up"></a>
        <!-- Back To Top Ends  -->

        <!-- Template JS Files -->
        <script src="{{ url('/') }}/public/website_resource/js/jquery-2.2.4.min.js"></script>
        <script src="{{ url('/') }}/public/website_resource/js/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/public/website_resource/js/select2.min.js"></script>
        <script src="{{ url('/') }}/public/website_resource/js/jquery.magnific-popup.min.js"></script>
        <script src="{{ url('/') }}/public/website_resource/js/custom.js"></script>

        <!-- Live Style Switcher JS File - only demo -->
        <script src="{{ url('/') }}/public/website_resource/js/styleswitcher.js"></script>


    </div>

    <script>


            let data = JSON.stringify({{session()->get('dollarrate')}});
            console.log(data);
            localStorage.setItem('dollarrate',data);


    </script>

    <!-- Wrapper Ends -->
</body>

</html>
