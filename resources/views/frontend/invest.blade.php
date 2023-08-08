@extends('layouts.website-layout')
@section('content')
    <!-- Banner Area Starts -->

    <!-- Banner Area Ends -->
    <!-- Pricing Starts -->
    <section class="pricing">
        <div class="container">
            <div class="row">
                @if (session()->has('status'))
                    <div class="col-md-6">
                        <div class="alert alert-danger alert-dismissible show" role="alert">
                            <strong>{{ session()->get('status') }} </strong>
                            <button type="button" class="btn-close ms-auto  " data-bs-dismiss="alert"
                                aria-label="Close">X</button>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Section Content Starts -->
            <h3 class="text-center">Investment Now</h3>
            <div class="row pricing-tables-content pricing-page">
                <div class="pricing-container">
                    <!-- Pricing Tables Starts -->
                    <div class="container">
                        <form action="{{ url('/investstore') }}/{{ $data[0]->plan_id }}" method="POST"
                            enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-6">
                                    @csrf
                                    <label for="" class="form-label">Enter Amount in $</label>
                                    <input type="number" name="amount"
                                        placeholder="Minimum: ${{ $data[0]->minimum_amount }} and Maximum: ${{ $data[0]->maximum_amount }}"
                                        step="5" class="form-control">

                                </div>
                                {{-- <div class="col-md-6">
                                    <label for="" class="form-label">Confirm Invest ?</label><br>
                                    <label for="">Yes </label> &nbsp;&nbsp; <input type="radio" name="status" value="1" checked>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<label for="">No</label> &nbsp;&nbsp; <input type="radio" name="status" value="0">
                                </div> --}}
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md-3">

                                    <button type="submit" class="btn btn-primary    ">Invest Confirm</button>
                                </div>
                            </div>

                        </form>

                    </div>


                </div>
            </div>

        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
