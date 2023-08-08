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
                                    <h4>All your Transaction</h4>

                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>
                                                @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                <th scope="col">Id</th>
                                                <th scope="col">User Name</th>
                                                @endif
                                                <th scope="col">Type</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status of Transaction</th>
                                                <th scope="col">Date & time</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                        <td> <a href="#"
                                                                class="question_content">{{ $item->ntransaction_id }}</a>
                                                        </td>
                                                        <td> <a href="#"
                                                                class="question_content">{{ $item->user_name }}</a>
                                                        </td>
                                                    @endif

                                                    @if ($item->type == 0)
                                                        <td>Deposit</td>
                                                    @endif

                                                    @if ($item->type == 1)
                                                        <td>Withdraw</td>
                                                    @endif

                                                    @if ($item->type == 2)
                                                        <td>Invest</td>
                                                    @endif

                                                    <td>$ {{ $item->amount }}</td>

                                                    @if ($item->tstatus == 0)
                                                        <td><a href="#" class="status_btn bg-primary">Pending</a></td>
                                                    @endif

                                                    @if ($item->tstatus == 1)
                                                        <td><a href="#" class="status_btn bg-success">Accepted</a>
                                                        </td>
                                                    @endif

                                                    @if ($item->tstatus == 2)
                                                        <td><a href="#" class="status_btn bg-danger">Rejected</a></td>
                                                    @endif

                                                    <td>{{ $item->date }}</td>

                                                    @if (session()->get('role') == 4)
                                                        <td>
                                                            <a href="{{ url('/dashboard/edit-transactions') }}/{{ $item->transaction_id }}"
                                                                class="fs-6 text-success"><i class="ti-pencil"></i></a>
                                                            <a href="{{ url('/dashboard/delete-transactions') }}/{{ $item->transaction_id }}"
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
