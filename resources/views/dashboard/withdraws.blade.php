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
                            <div class="container">

                                <div class="row">
                                    @if (session()->has('status1'))
                                    <div class="col-md-6">
                                        <div class="alert alert-danger alert-dismissible show" role="alert">
                                            <strong>{{ session()->get('status1') }} </strong>
                                            <button type="button" class="btn-close ms-auto  " data-bs-dismiss="alert"
                                            aria-label="Close">X</button>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if (session()->has('status'))
                                    <div class="col-md-6">
                                        <div class="alert alert-success alert-dismissible show" role="alert">
                                            <strong>{{ session()->get('status') }} </strong>
                                            <button type="button" class="btn-close ms-auto  " data-bs-dismiss="alert"
                                            aria-label="Close">X</button>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                       

                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4> Your All With draws</h4>

                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>
                                                @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                    <th scope="col">Id</th>
                                                    <th scope="col">User Name</th>
                                                @endif
                                                <th scope="col">Bank Name</th>
                                                <th scope="col">Final amount in $</th>
                                                <th scope="col">Final amount in PKR</th>
                                                <th scope="col">Acount Number</th>
                                                <th scope="col">Acount title</th>
                                                <th scope="col">Request Date & time</th>
                                                <th scope="col">Status</th>
                                                @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                    <th scope="col">Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                        <td> <a href="#"
                                                                class="question_content">{{ $item->withdraw_id }}</a></td>
                                                        <td>{{ $item->user_name }}</td>
                                                    @endif
                                                    <td>{{ $item->bank_name }}</td>
                                                    <td>${{ $item->final_amount }}</td>
                                                    <td>{{ $item->final_amount * session()->get('dollarrate') }} PKR</td>
                                                    <td>{{ $item->account_number }}</td>
                                                    <td>{{ $item->account_title }}</td>
                                                    <td>{{ $item->date }}</td>

                                                    <td>
                                                        @if ($item->tstatus == 0)
                                                            <span class="bg-warning p-2">Pending</span>
                                                        @elseif ($item->tstatus == 1)
                                                            <span class="bg-success p-2">Accepted</span>
                                                        @else
                                                            <span class="bg-danger p-2">Rejected</span>
                                                        @endif
                                                        @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                    <td>
                                                        <a href="{{ url('/dashboard/edit-withdraws') }}/{{ $item->withdraw_id }}"
                                                            class="fs-6 text-success"><i class="ti-pencil"></i></a>
                                                        <a href="{{ url('/dashboard/delete-withdraws') }}/{{ $item->withdraw_id }}"
                                                            class="fs-6 text-danger"><i class="ti-trash"></i></a>
                                                    </td>
                                            @endif
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
