@extends('layouts.website-layout')
@section('content')

<!-- Banner Area Starts -->
<section class="banner-area">
    <div class="banner-overlay">
        <div class="banner-text text-center">
            <div class="container">
                <!-- Section Title Starts -->
                <div class="row text-center">
                    <div class="col-xs-12">
                        <!-- Title Starts -->
                        <h2 class="title-head">About <span>Us</span></h2>
                        <!-- Title Ends -->
                        <hr>
                        <!-- Breadcrumb Starts -->
                        <ul class="breadcrumb">
                            <li><a href="{{url('/')}}"> home</a></li>
                            <li>About</li>
                        </ul>
                        <!-- Breadcrumb Ends -->
                    </div>
                </div>
                <!-- Section Title Ends -->
            </div>
        </div>
    </div>
</section>
<!-- Banner Area Starts -->
<!-- About Section Starts -->
<section class="about-page">
    <div class="container">
        <!-- Section Content Starts -->
        <div class="row about-content">
            <!-- Image Starts -->
            <div class="col-sm-12 col-md-5 col-lg-6 text-center">
                <img id="about-us" class="img-responsive img-about-us" src="{{ url('/') }}/public/website_resource/images/about-us.jpg" alt="about us">
            </div>
            <!-- Image Ends -->
            <!-- Content Starts -->
            <div class="col-sm-12 col-md-7 col-lg-6">
                <div class="feature-about">
                    <h3 class="title-about">WE ARE World TrD</h3>
                    <p class="about-text">World TrD is an excellent opportunity for people who want to safeguard and
                        grow their hard-earned money. World TrD investors can also enjoy a handsome salary. This
                        section will also help you understand how To Start A World TrD Business and grow it by leaps
                        and bounds. Real estate gives you good and consistent returns. On average, you can earn up to
                        20% return every month. For instance, if you purchase a piece of property for RS.500,000, you
                        can sell it for Rs.560,000 next month, that too without doing anything. You are earning an extra
                        Rs.60,000 by sitting at home

                    </p>
                </div>

                <a class="btn btn-primary btn-services" href="services.html">Our services</a>
            </div>
            <!-- Content Ends -->

        </div>
        <!-- Section Content Ends -->
    </div><!--/ Content row end -->
</section>
<!-- About Section Ends -->
<!-- Facts Section Starts -->
<section class="facts">
    <!-- Container Starts -->
    <div class="container">
        <!-- Fact Badges Starts -->
        <div class="row text-center facts-content">
            <div class="text-center heading-facts">
                <h2>World TrD<span> numbers</span></h2>
                <p>leading cryptocurrency exchange since day one of Bitcoin distribution</p>
            </div>
            <!-- Fact Badge Item Starts -->
            <div class="col-xs-12 col-md-3 col-sm-6 fact">
                <h3>$77.45B</h3>
                <h4>market cap</h4>
            </div>
            <!-- Fact Badge Item Ends -->
            <!-- Fact Badge Item Starts -->
            <div class="col-xs-12 col-md-3 col-sm-6 fact fact-clear">
                <h3>165k</h3>
                <h4>daily transactions</h4>
            </div>
            <!-- Fact Badge Item Ends -->
            <!-- Fact Badge Item Starts -->
            <div class="col-xs-12 col-md-3 col-sm-6 fact">
                <h3>1726</h3>
                <h4>active accounts</h4>
            </div>
            <!-- Fact Badge Item Ends -->
            <!-- Fact Badge Item Starts -->
            <div class="col-xs-12 col-md-3 col-sm-6">
                <h3>17</h3>
                <h4>years on the market</h4>
            </div>
            <!-- Fact Badge Item Ends -->
            <div class="col-xs-12 buttons">
                {{-- <a class="btn btn-primary btn-pricing" href="register.html">See pricing</a> --}}
                <a class="btn btn-primary btn-pricing" href="{{ url('/plans') }}">See pricing</a>
                {{-- <span class="or"> or </span> --}}
                {{-- <a class="btn btn-primary btn-register" href="register.html">Register Now</a> --}}
            </div>
        </div>
        <!-- Fact Badges Ends -->
    </div>
    <!-- Container Ends -->
</section>
<!-- facts Section Ends -->

<!-- Call To Action Section Starts -->
<section class="call-action-all">
    <div class="call-action-all-overlay">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Call To Action Text Starts -->
                    <div class="action-text">
                        <h2>Get Started Today With World trd</h2>
                        <p class="lead">Open account for free and start trading World trd!</p>
                    </div>
                    <!-- Call To Action Text Ends -->
                    <!-- Call To Action Button Starts -->
                    <p class="action-btn"><a class="btn btn-primary" href="register.html">Register Now</a></p>
                    <!-- Call To Action Button Ends -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Call To Action Section Ends -->

@endsection
