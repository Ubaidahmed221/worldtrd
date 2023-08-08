
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
                                    <h4>All Users</h4>
                                </div>

                                <div class="container my-2">
                                    <div class="row">
                                        <div class="offset-md-6 col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="search" name="search" placeholder="Searching.....">
                                                <button id="searchbtn" class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (session()->has('status'))
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong></strong> {{ session()->get('status') }} !
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active " id="myTable">
                                        <thead>
                                            <tr>
                                                @if (session()->get('role') == 4)
                                                <th scope="col">Id</th>
                                                @endif
                                                <th scope="col">Full name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email or username</th>
                                                {{-- @if (session()->get('role') == 4) --}}
                                                    <th scope="col">password</th>
                                                {{-- @endif --}}
                                                {{-- <th scope="col">Total Investment</th> --}}
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <!-- <th scope="col">Parent_id</th>
                    <th scope="col">Role:</th> -->
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                @if (session()->get('role') == 4)
                                                    <td> <a href="#" class="question_content"> {{ $user->user_id }}
                                                        </a></td>
                                                    @endif

                                                    <td>{{ $user->user_name }}</td>
                                                    <td>{{ $user->user_phone }}</td>
                                                    <td>{{ $user->user_email }}</td>
                                                    {{-- @if (session()->get('role') == 4) --}}
                                                    <td>{{ $user->user_password }}</td>
                                                    {{-- @endif --}}
                                                    {{-- <td>${{ $user->iamount }}</td> --}}
                                                    @if ($user->status == 1)
                                                        <td><a href="#" class="status_btn bg-success">Active</a>
                                                        </td>
                                                    @else
                                                        <td><a href="#" class="status_btn bg-danger">Inactive</a></td>
                                                    @endif
                                                    <td>{{ $user->date }}</td>
                                                    <td>
                                                        {{-- <a href="{{ url('/dashboard/detail-user') }}/{{ $user->user_id }}"
                                                            class="fs-6 text-success"><i class="fa-solid fa-circle-info me-2"></i></a> --}}
                                                        <a href="{{ url('/dashboard/edit-invested-user') }}/{{ $user->user_id }}"
                                                            class="fs-6 text-success"><i class="ti-pencil"></i></a>
                                                        <a href="{{ url('/dashboard/delete-invested-user') }}/{{ $user->user_id }}"
                                                            class="btn border-0 text-danger"><i class="ti-trash"></i></a>
                                                    </td>
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

$(document).ready(function(){


  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

//   $("#searchbtn").on("click", function() {
//     var value = $('#search').val().toLowerCase();
//     $("#myTable tbody tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });

});

    </script>


@endsection
