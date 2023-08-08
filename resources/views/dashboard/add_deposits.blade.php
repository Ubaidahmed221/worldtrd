@extends('layouts.dashboard-layout')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 140px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 150%;
            left: 50%;
            margin-left: -75px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Deposit </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" class="modalclose"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="add-deposit-amount" method="post" class="mt-3">
                        @csrf
                        <select name="charge_method" id="charge_method" class="form-select">
                            <option value="0">PKR (1USDT = {{ $charge[0]->dollar_charge_amount }} PKR) </option>
                            <option value="1">USDT </option>
                        </select>
                        <br>
                        <input type="number" id="amount" name="amount" step="50" placeholder="Enter Amount"
                            class="form-control">
                        <br>
                        <label for="">Final Amount: (in USDT)</label>
                        <input type="number" name="totalamount" id="totalamount" placeholder="Total Amount"
                            class="form-control" readonly id="totalamount">
                        <br>
                        <button type="submit" class="btn btn-primary mt-2 text-end" id="mybtndel">Deposit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" class="modalclose">Close</button>

                </div>
            </div>
        </div>
    </div>


    <script>
        function finalamount() {

            document.getElementById("amount").addEventListener("keyup", function() {
                let amount = this.value;

                var rate = localStorage.getItem('dollarrate');
                rate = JSON.parse(rate);

                let charge = document.getElementById('charge_method').value;

                if (charge == 1) {
                    document.getElementById('totalamount').value = amount;

                } else {
                    amount = amount / rate;
                    document.getElementById('totalamount').value = amount;
                }

            });

        }

        finalamount();

        document.getElementById("charge_method").addEventListener("change", function() {

            var data = localStorage.getItem('dollarrate');
            data = JSON.parse(data);
            let charge = document.getElementById('charge_method').value;

            let amount = document.getElementById("amount").value;

            if (charge == 1) {

                document.getElementById('totalamount').value = Math.floor(amount);

            } else {

                amount = amount / data;
                document.getElementById('totalamount').value = amount;
            }

        });




        $(document).ready(function() {

            $('#add-deposit-amount').on('submit', function(e) {

                e.preventDefault();

                var charge = $('#charge_method').val();
                let aa = JSON.stringify(charge);
                localStorage.setItem('charge', aa);

                var amount = $('#totalamount').val();
                let data = JSON.stringify(amount);
                localStorage.setItem('amount', data);

                $('#exampleModal').modal('hide');


                getamoundata();
                getbank();

            });

            $('#exampleModal').modal('show');


            $(".modalclose").click(function() {

                alert('sdlfkjs');

            });

            getamoundata();

            function getamoundata() {

                var data = localStorage.getItem('amount');

                var dollarrate = localStorage.getItem('dollarrate');
                dollarrate = JSON.parse(dollarrate);

                var charge = localStorage.getItem('charge');
                charge = JSON.parse(charge);
                if (charge == 0) {

                    $('#inputshow').html(`
                    <input type="hidden" name='charge' value='${charge}' />
                    <label class="form-label">Total Amount (in <span
                    id="amountlabel"> PKR</span>)</label>
                    <input type="number" value="${Math.floor(JSON.parse(data)*dollarrate)}" class="form-control" id="myamount" readonly
                    name="myamount" placeholder="">`);
                } else {
                    $('#inputshow').html(`
                    <input type="hidden" name='charge' value='${charge}' />
                    <label class="form-label">Total Amount (in <span
                    id="amountlabel"> USDT</span>)</label>
                    <input type="number" value='${Math.floor(JSON.parse(data))}' class="form-control" id="myamount" readonly
                    name="myamount" placeholder="">
                    `);

                }

                getbank();

            }
        });


        function getbank() {
            var data = localStorage.getItem('charge');
            data = JSON.parse(data);

            if (data == 0) {

                $('#bankset').html(`
                <div class='container'>
                    <div class='row align-items-center'>
                    <div class='col-md-5'>
                        <img src='{{ url('/public/myimages/faysalbank.png') }}' width='100%'/>
                    </div>
                    <div class='col-md-7'>
                            <p class='text-dark'>Bank Name : {{ $payment[0]->bank_name }}</p>
                            <p class='text-dark'>Account Name : {{ $payment[0]->account_title }}</p>
                            <div class='input-group'>
                            <input class='form-control' id='copyaccnumber' value='{{ $payment[0]->account_number }}' />
                            <button onclick="copyaccnumber()" class='btn btn-primary'>
                                <span class="tooltiptext" id="myTooltip"> Copy </span> </buttton>
                            </div>
                    </div>
                    </div>
                </div>
                `);

            } else {
                $('#bankset').html(`
                <div class='container'>
                <div class='row align-items-center'>
                    <div class='col-md-5 text-center'>
                        <img src='{{ url('/public/myimages/USDTimg.png') }}' width='200' height='200'/>
                        </div>
                        <div class='col-md-7'>
                            <p class='text-dark'>Bank Name : {{ $payment[1]->bank_name }}</p>
                            <div class='input-group'>
                            <input class='form-control' id='copyaccnumber' value='{{ $payment[1]->account_number }}' />
                            <button onclick="copyaccnumber()" class='btn btn-primary'>
                                <span class="tooltiptext" id="myTooltip"> Copy </span> </buttton>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                `);

            }
        }
        getbank();
    </script>

    <div class="main_content_iner ">
        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">


                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">

                        <div class="white_card_header">
                            <h4>Bank Details </h4>

                            <div id="bankset"></div>



                        </div>
                        <div class="white_card_body">
                            <div class="card-body">
                                <form action="{{ url('/') }}/dashboard/store-deposits" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6 mt-3">
                                            <div id="inputshow">

                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label">Transaction Image</label>
                                            <input type="file" class="form-control" name="transaction_file"
                                                placeholder="Transaction file">
                                            @error('transaction_file')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Add deposit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function copyaccnumber() {
            var copyText = document.getElementById("copyaccnumber");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);

            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copied Account Number";
        }



        getamoundata();

        document.getElementById('bankname').addEventListener('change', function() {

            var bankid = this.value;

            var data = localStorage.getItem('amount');

            if (bankid == 1 || bankid == 2) {


                document.getElementById('myamount').value = JSON.parse(data) * 310;
                document.getElementById('amountlabel').innerHTML = `PKR`;

            } else {

                document.getElementById('myamount').value = JSON.parse(data);
                document.getElementById('amountlabel').innerHTML = `USDT`;
            }

        });
    </script>
@endsection
