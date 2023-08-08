@extends('layouts.dashboard-layout')
@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Add withdraw</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="card-body">
                                <form action="{{ url('/') }}/dashboard/store-withdraw" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Select Currency</label>

                                            <select class="form-select " name="currency" id="currency">

                                                <option value="0">PKR (1 USDT = {{ session()->get('dollarrate') }})</option>
                                                <option value="1">USDT </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label class="form-label">With Draw amount (in <b id="currlabel"> PKR </b>)
                                            </label>
                                            <input type="number" min="0" value="{{old('amount')}}" name="amount" id="amount"
                                                class="form-control " placeholder="Enter amount">
                                                @error('amount')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label class="form-label">With Draw amount (in <b id="currlabel"> USDT </b>)
                                            </label>
                                            <input type="number" readonly min="0" name="final_amount"
                                                id="final_amount" class="form-control " placeholder="Enter Final Amount">

                                        </div>

                                        <div class="col-md-6 mt-2" id="bankname">
                                            <label class="form-label">Enter Bank Name</label>
                                            <input type="text" name="bankname"  class="form-control">
                                            @error('bankname')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-2" id="holdername">
                                            <label class="form-label">Account Title Name</label>
                                            <input type="text"  name="holdername"  class="form-control"
                                                placeholder="Enter Title Name">
                                            @error('holdername')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label class="form-label">Account Number or Wallet Address</label>
                                            <input type="text" name="account_number" class="form-control"
                                                placeholder="Account Number">
                                            @error('account_number')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Add withdraw</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('amount').addEventListener('keyup', function() {

            var curr = document.getElementById('currency').value;
            var data = localStorage.getItem('dollarrate');
            data = JSON.parse(data);

            let ddd = document.getElementById('amount').value;

            if (curr == 0) {
                ddd = ddd / data;
                document.getElementById('final_amount').value = Math.floor(ddd);
            }
            else{
                document.getElementById('final_amount').value =  ddd;

            }

        });

        document.getElementById('currency').addEventListener('change', function() {

            var curr = this.value;
            let ddd = document.getElementById('amount').value;
            var data = localStorage.getItem('dollarrate');
            data = JSON.parse(data);


            if (curr == 1) {

                document.getElementById('currlabel').innerHTML = '$';
                document.getElementById('final_amount').value =  ddd;
                document.getElementById('bankname').style = 'display:none';
                document.getElementById('holdername').style = 'display:none';


            } else {
                document.getElementById('bankname').style = 'display:block';
                document.getElementById('holdername').style = 'display:block';
                document.getElementById('final_amount').value =  Math.floor(ddd / data);
                document.getElementById('currlabel').innerHTML = 'PKR';

            }

        });
    </script>
@endsection
