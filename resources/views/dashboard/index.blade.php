@extends('layouts.dashboard-layout')

@section('content')
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">

            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex align-items-center justify-content-between">
                        <div class="page_title_left">
                            <h3 class="f_s_30 f_w_700 text_white">Dashboard</h3>
                            <a href="" class="text-white h6 text-decoration-underline">Refresh</a>

                        </div>

                    </div>
                </div>
            </div>
            <div class="row ">

                <div class="col-lg-3">
                    <div class="white_card card_height_100 mb_20">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                    <h3 class="m-0">Total All User Current Balance:</h3>
                                    @else
                                    <h3 class="m-0">Current Balance:</h3>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="white_card_body">

                            <h4 class="f_w_900 f_s_35 mb-0 me-2">${{$balance}}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="white_card card_height_100 mb_20">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                    <h3 class="m-0">Total All User Deposit:</h3>
                                    @else
                                    <h3 class="m-0">Total Deposit:</h3>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="white_card_body">

                            <h4 class="f_w_900 f_s_35 mb-0 me-2">$@if ($deposit[0]->depositamount)
                                {{$deposit[0]->depositamount}}
                                @else
                                0
                            @endif</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="white_card card_height_100 mb_20">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                    <h3 class="m-0">Total All User Investement:</h3>
                                    @else
                                    <h3 class="m-0">Total Investement:</h3>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="white_card_body">

                            <h4 class="f_w_900 f_s_35 mb-0 me-2">$@if ($invest[0]->investamount)
                                {{$invest[0]->investamount}}
                                @else
                                0
                            @endif</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="white_card card_height_100 mb_20">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                    <h3 class="m-0">Total All User Withdraw:</h3>
                                    @else
                                    <h3 class="m-0">Total Withdraw:</h3>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="white_card_body">

                            <h4 class="f_w_900 f_s_35 mb-0 me-2">$@if ($withdraw[0]->withdrawamount)
                                {{$withdraw[0]->withdrawamount}}
                                @else
                                0
                            @endif</h4>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="white_card card_height_100 mb_20">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                    <h3 class="m-0">Total All User Profit:</h3>
                                    @else
                                    <h3 class="m-0">Total Profit:</h3>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="white_card_body">

                            <h4 class="f_w_900 f_s_35 mb-0 me-2">$@if ($profit[0]->profitamount)
                                {{round($profit[0]->profitamount,2)}}
                                @else
                                0
                            @endif</h4>
                        </div>
                    </div>
                </div>

                @if (session()->get('role') == 3 || session()->get('role') == 4)
                <div class="col-lg-3">
                    <a href="{{url('/dashboard/users')}}">
                    <div class="white_card card_height_100 mb_20">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Total Users :</h3>
                                </div>

                            </div>
                        </div>
                        <div class="white_card_body">

                            <h4 class="f_w_900 f_s_35 mb-0 me-2">@if ($countuser[0]->count)
                                {{$countuser[0]->count}}
                                @else
                                0
                            @endif</h4>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-lg-3">
                    <div class="white_card card_height_100 mb_20">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Deleted Users :</h3>
                                </div>

                            </div>
                        </div>
                        <div class="white_card_body">

                            <h4 class="f_w_900 f_s_35 mb-0 me-2">@if ($deluser[0]->count)
                                {{$deluser[0]->count}}
                                @else
                                0
                            @endif</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="white_card card_height_100 mb_20">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Add Current Investment :</h3>
                                </div>

                            </div>
                        </div>
                        <div class="white_card_body">

                            <h4 class="f_w_900 f_s_35 mb-0 me-2">@if ($deluser[0]->count)
                                {{$deluser[0]->count}}
                                @else
                                0
                            @endif</h4>
                        </div>
                    </div>
                </div>

                @endif


            </div>
            <div>
                <canvas id="myChart"></canvas>
              </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

@endsection
