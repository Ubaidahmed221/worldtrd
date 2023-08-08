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
                                <div class="white_box_tittle list_header">
                                    @if (session()->get('role') == 0)
                                    <h4>My All Profits</h4>
                                    @else
                                    <h4>All Profits</h4>
                                    @endif

                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>
                                                @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                    <th scope="col">Id</th>
                                                    <th scope="col">User </th>
                                                @endif
                                                <th scope="col">Amount in $</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($data as $item)
                                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                        <td> <a href="#"
                                                                class="question_content">{{ $item->profite_id }}</a></td>
                                                        <td>{{ $item->user_name }}</td>
                                                    @endif
                                                    <td>$ {{ $item->amount}}</td>
                                                    <td>
                                                        @if ($item->tstatus == 0)
                                                            <span class=" bg-warning">Pending</span>
                                                        @elseif ($item->tstatus == 1)
                                                            <span class="bg-success">Accepted</span>
                                                        @else
                                                            <span class="bg-danger">Rejected</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->tdate }}</td>

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
@endsection
