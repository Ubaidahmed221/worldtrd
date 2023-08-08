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
                                    <h4>All Commissions</h4>
                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>
                                                @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                <th scope="col">Id</th>
                                                @endif
                                                <th scope="col">From User</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date & time</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    @if (session()->get('role') == 3 || session()->get('role') == 4)
                                                        <td> <a href="#"
                                                                class="question_content">{{ $item->comissionid }}</a>
                                                        </td>
                                                        @endif
                                                        <td> <a href="#"
                                                                class="question_content">{{ $item->user_name }}</a>
                                                        </td>

                                                    <td>$ {{ $item->amount }}</td>
                                                    <td>{{ $item->status }}</td>

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
