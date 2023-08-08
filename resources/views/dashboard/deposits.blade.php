@extends('layouts.dashboard-layout')
@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            @if (session()->has('status'))
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Thanks!</strong> {{ session()->get('status') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="box_header m-0">
                                <!-- <div class="main-title">
        <h3 class="m-0">Data table</h3>
        </div> -->
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Deposit</h4>

                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>
                                                @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                    <th scope="col">Id</th>
                                                    <th scope="col">User </th>
                                                @endif
                                                <th scope="col">Amount in USDT</th>
                                                {{-- <th scope="col">Amount in PKR</th> --}}
                                                <th scope="col">Transaction file</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                    <th scope="col">Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($data as $item)
                                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                        <td> <a href="#"
                                                                class="question_content">{{ $item->deposit_id }}</a></td>
                                                        <td>{{ $item->user_name }}</td>
                                                    @endif
                                                    <td>$ {{ $item->amount}}</td>
                                                    {{-- <td>{{ $item->amount * session()->get('dollarrate') }} PKR</td> --}}

                                                    <td><a href="{{ url('/public/transaction_images') }}/{{ $item->transaction_file }} "
                                                            target="_blank"> <img
                                                                src="{{ url('/public/transaction_images') }}/{{ $item->transaction_file }}"
                                                                width="60px"> </a> </td>
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
                                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                        <td>
                                                            <a href="{{ url('/dashboard/edit-deposits') }}/{{ $item->deposit_id }}"
                                                                class="fs-6 text-success"><i class="ti-pencil"></i></a>
                                                    @endif
                                                    @if (session()->get('role') == 4)
                                                    <a href="{{ url('/dashboard/delete-deposits') }}/{{ $item->deposit_id }}"
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
