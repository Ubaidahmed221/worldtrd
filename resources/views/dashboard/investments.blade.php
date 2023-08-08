    @extends('layouts.dashboard-layout')
    @section('content')
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <!-- <div class="main-title">
                    <h3 class="m-0">Data table</h3>
                    </div> -->
                                </div>
                            </div>
                            <div class="white_card_body">
                                <div class="QA_section">


                                    <div class="container my-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4>All Investments</h4>

                                            </div>
                                            @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                <div class=" col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="search"
                                                            name="search" placeholder="Searching.....">
                                                        <button id="searchbtn" class="btn btn-primary">Search</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="QA_table mb_30">

                                        <table class="table lms_table_active " id="myTable">
                                            <thead>
                                                <tr>
                                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                        <th scope="col">Invest id</th>
                                                    @endif

                                                    <th scope="col">Plan Name</th>
                                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                        <th scope="col">user Name</th>
                                                        <th scope="col">user Email</th>
                                                    @endif
                                                    <th scope="col">Interest in %</th>
                                                    <th scope="col">Date & time</th>
                                                    <th scope="col">Investment Amount</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                            <td> <a href="#"
                                                                    class="question_content">{{ $item->invest_id }}</a></td>
                                                        @endif
                                                        <td>{{ $item->plan_title }}</td>
                                                        @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                            <td>{{ $item->user_name }}</td>
                                                            <td>{{ $item->user_email }}</td>
                                                        @endif
                                                        <td>{{ $item->daily_profit_percentage }}%</td>
                                                        <td>{{ $item->idate }}</td>
                                                        <td>${{ $item->amount }}</td>
                                                        @if ($item->istatus == 1)
                                                            <td><a href="#" class="status_btn bg-success">Active</a>
                                                            </td>
                                                        @else
                                                            <td><a href="#" class="status_btn bg-danger">InActive</a>
                                                            </td>
                                                        @endif
                                                        {{-- <td>
                                                        <a href="{{ url('/dashboard/edit-investments') }}"
                                                            class="fs-6 text-success"><i class="ti-pencil"></i></a>
                                                        <button class="btn border-0 text-danger"><i
                                                                class="ti-trash"></i></button>
                                                    </td> --}}
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {


                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tbody tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

            });
        </script>
    @endsection
