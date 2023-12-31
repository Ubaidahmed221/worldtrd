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
                            <h2 class="title-head">Our <span>Plans</span></h2>
                            <!-- Title Ends -->
                            <hr>
                            <!-- Breadcrumb Starts -->
                            <ul class="breadcrumb">
                                <li><a href="{{ url('/') }}"> home</a></li>
                                <li>pricing</li>
                            </ul>
                            <!-- Breadcrumb Ends -->
                        </div>
                    </div>
                    <!-- Section Title Ends -->
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area Ends -->
    <!-- Pricing Starts -->
    <section class="pricing">
        <div class="container">

            <div class="row">

                @if (session()->has('status'))
                    <div class="col-md-6">
                        <div class="alert alert-success alert-dismissible show" role="alert">
                            <strong>{{ session()->get('status') }} </strong>
                            <button type="button" class="btn-close ms-auto  " data-bs-dismiss="alert"
                                aria-label="Close">X</button>
                        </div>
                    </div>
                @endif
                @if (session()->has('status1'))
                    <div class="col-md-6">
                        <div class="alert alert-danger alert-dismissible show" role="alert">
                            <strong>{{ session()->get('status1') }} </strong>
                            <button type="button" class="btn-close  " data-bs-dismiss="alert" aria-label="Close">X</button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Section Content Starts -->
            <h3 class="text-center">Investment Plans</h3>
            <p class="text-center">HELP AGENCIES TO DEFINE THEIR NEW BUSINESS OBJECTIVES AND THEN CREATE PROFESSIONAL
                SOFTWARE.</p>
            <div class="row pricing-tables-content pricing-page">
                <div class="pricing-container">
                    <!-- Pricing Tables Starts -->
                    <ul class="pricing-list bounce-invert">
                        <!-- Pricing Table #1 Starts -->
                        @foreach ($data as $item)
                            <li class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <ul class="pricing-wrapper">
                                    <li>
                                        <header class="pricing-header">
                                            <h2>{{ $item->plan_title }} <span><br> {{ $item->daily_profit_percentage }}%
                                             @if ($item->profit_daily == 1)
                                             EVERY DAYS
                                             @else
                                             Once Time
                                             @endif       </span></h2>
                                            <div class="price">

                                                <span class="value" style="font-size: 20px">$ {{ $item->minimum_amount }} -
                                                    $ {{ $item->maximum_amount }}</span>
                                                <br>
                                                <span class="">Capital Return: {{ $item->duration_number }}
                                                    @if ($item->duration_type == 0)
                                                        Days
                                                    @else
                                                    Month
                                                    @endif
                                                </span>
                                            </div>
                                        </header>
                                        <span class=""
                                                style="text-align: center; display: block;color: #fdc01a;">
                                                Capital Will return ?
                                                 @if ($item->return_amount == 1)
                                                Yes
                                                @else
                                                No
                                                @endif
                                                </span>
                                        <footer class="pricing-footer">
                                            @if ($item->pstatus == 0)

                                            <a  style="cursor: pointer;"
                                                class="btn btn-primary disabled">Tempary Block &nbsp;&nbsp;<i class="fa-solid fa-lock"></i> </a>


                                            @else
                                            <a href="{{ url('/invest') }}/{{ $item->plan_id }}"
                                                class="btn btn-primary">Invest Now</a>
                                            @endif

                                        </footer>




                                    </li>
                                </ul>
                        @endforeach


                    </ul>
                </div>
            </div>

        </div>
    </section>
    <!-- Pricing Ends -->
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
