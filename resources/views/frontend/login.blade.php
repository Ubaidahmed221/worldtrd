@extends('layouts.website-layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')

<br><br><br>
<div class="container ">

        <!-- Section Title Starts -->
        <div class="row text-center">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                @if (session()->has('status'))

                <div class="alert alert-danger alert-dismissible show" role="alert">
                    <strong>{{session()->get('status')}}</strong>.
                    <button type="button" class="btn-close mt-3" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <h2 class="title-head hidden-xs">member <span>login</span></h2>
                <p class="info-form">Send, receive and securely store your amount in your wallet</p>

                <form action="{{url('/login-store')}}" method="post">
                    @csrf
                    <!-- Input Field Starts -->
                    <div class="form-group">
                        <input class="form-control" name="email" id="email" placeholder="EMAIL" type="email" required>
                    </div>
                    <!-- Input Field Ends -->
                    <!-- Input Field Starts -->
                    <div class="form-group">
                        <input class="form-control" name="password" id="password" placeholder="PASSWORD" type="password"
                            required>
                    </div>
                    <!-- Input Field Ends -->
                    <!-- Submit Form Button Starts -->
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">login</button>
                    </div>
                    <!-- Submit Form Button Ends -->
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <br><br><br>
@endsection
