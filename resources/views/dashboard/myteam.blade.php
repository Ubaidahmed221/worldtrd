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
                                    <h4>My Teams</h4>
                                </div>

                                <div class="container my-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card" style="width: 19rem;" >
                                            {{-- <div class="card" style="width: 18rem;"> --}}

                                                <div class="card-body d-flex ">
                                                    <div class="" style="padding-right: 110px">

                                                        <h5 class="card-title">Level</h5>
                                                        <p class="card-text">Level 1</p>
                                                        <p class="card-text">Level 2</p>
                                                        <p class="card-text">Level 3</p>
                                                        <p class="card-text">Level 4</p>

                                                    </div>
                                                    <div class="ml-5">
                                                        <h5 class="card-title">Team Members</h5>
                                                        <p class="card-text">hjhhj</p>
                                                        <p class="card-text">hjhhj</p>
                                                        <p class="card-text">hjhhj</p>
                                                        <p class="card-text">hjhhj</p>

                                                    </div>
                                                  {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                                </div>
                                              {{-- </div> --}}
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="card" style="width: 24rem;" >
                                                {{-- <div class="card" style="width: 18rem;"> --}}

                                                    <div class="card-body d-flex ">
                                                        <div class="" style="padding-right: 50px">

                                                            <h5 class="card-title">Level comission</h5>
                                                            <p class="card-text">Level 1  Comission</p>
                                                            <p class="card-text">Level 2 Comission</p>
                                                            <p class="card-text">Level 3 Comission</p>
                                                            <p class="card-text">Level 4 Comission</p>

                                                        </div>
                                                        <div class="" style="padding-left: 50px">
                                                            <h5 class="card-title">Comission parcent</h5>
                                                            @foreach ($team as $item)

                                                            <p class="card-text">{{ $item->comission_per }} %</p>
                                                            {{-- <p class="card-text">5%</p>
                                                            <p class="card-text">5%</p>
                                                            <p class="card-text">5%</p> --}}
                                                            @endforeach


                                                        </div>
                                                      {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                                                    </div>
                                                  {{-- </div> --}}
                                            </div>
                                        </div>
                                </div>



                                </div>

                                <div class="container my-2 mt-5">
                                    <div class="row">
                                        <div class="offset-md-6 col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="search" name="search"
                                                    placeholder="Searching.....">
                                                    <select name="level" id="level" class="form-select">
                                                        <option value="1">Level 1</option>
                                                        <option value="2">Level 2</option>
                                                        <option value="3">Level 3</option>
                                                        <option value="4">Level 4</option>
                                                    </select>
                                            </div>
                                            {{-- <button id="searchbtn" class="btn btn-primary">Search</button> --}}
                                        </div>
                                    </div>

                                </div>

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

                                                {{-- <th scope="col">Total Investment</th> --}}
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($data)
                                                @foreach ($data as $user)
                                                    <tr>
                                                        @if (session()->get('role') == 4)
                                                            <td> <a href="#" class="question_content">
                                                                    {{ $user->user_id }}
                                                                </a></td>
                                                        @endif

                                                        <td>{{ $user->user_name }}</td>
                                                        <td>{{ $user->user_phone }}</td>
                                                        <td>{{ $user->user_email }}</td>

                                                        {{-- <td>${{ $user->iamount }}</td> --}}
                                                        @if ($user->status == 1)
                                                            <td><a href="#" class="status_btn bg-success">Active</a>
                                                            </td>
                                                        @else
                                                            <td><a href="#" class="status_btn bg-danger">Inactive</a>
                                                            </td>
                                                        @endif
                                                        <td>{{ $user->date }}</td>
                                                        {{-- <td>{{ $user->level }}</td> --}}
                                                        <td class="mylevel">{{ $user->parent_Level }}</td>

                                                    </tr>
                                                @endforeach
                                            @endif

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

            $("#level").on("change", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tbody tr ").filter(function() {
                    $("#myTable tbody tr .mylevel").toggle($(this).text().toLowerCase()
                        .indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
