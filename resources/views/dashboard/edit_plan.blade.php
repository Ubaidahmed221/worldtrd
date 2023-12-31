@extends('layouts.dashboard-layout')
@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0 sm_padding_15px">
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Edit plan</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="card-body">
                                <form action="{{url('/')}}/dashboard/update-plan/{{$data->plan_id}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="inputEmail4">Plan title</label>
                                            <input type="text" class="form-control" id="inputEmail4" name="plan_title"
                                                value="{{ $data->plan_title }}" placeholder="Enter plan title">
                                            @error('plan_title')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class=" col-md-6">
                                            <label class="form-label" for="inputPassword4">Minimum plan amount</label>
                                            <input type="number" class="form-control" id="inputPassword4"
                                                name="minimum_amount" value="{{ $data->minimum_amount }}"
                                                placeholder="Minimum plan amount">
                                            @error('minimum_amount')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class=" col-md-4">
                                            <label class="form-label" for="inputPassword4">Maximum plan amount</label>
                                            <input type="number" class="form-control" id="inputPassword4"
                                                name="maximum_amount" value="{{ $data->maximum_amount }}"
                                                placeholder="Minimum plan amount">
                                            @error('maximum_amount')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class=" col-md-4">
                                            <label class="form-label" for="inputAddress">Duration number</label>
                                            <input type="number" class="form-control" value="{{ $data->duration_number }}"
                                                name="duration_number">
                                            @error('duration_number')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="inputState">Duration type</label>
                                            <select name="duration_type" id="inputState" class="form-control">
                                                @if ($data->duration_type == 0)
                                                    <option selected value="0">Day</option>
                                                    <option value="1">Week</option>
                                                    <option value="2">Month</option>
                                                @endif
                                                @if ($data->duration_type == 1)
                                                    <option selected value="1" >Week</option>
                                                    <option value="0">Day</option>
                                                    <option value="2">Month</option>
                                                @endif
                                                @if ($data->duration_type == 2)
                                                    <option selected value="2" >Month</option>
                                                    <option value="1">Week</option>
                                                    <option value="0">Day</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class=" col-md-4">
                                            <label class="form-label" for="inputPassword4">Daily Profit percentage</label>
                                            <input type="number" class="form-control" name="daily_profit_percentage"
                                                value="{{ $data->daily_profit_percentage }}"
                                                placeholder="Daily Profit percentage">
                                                @error('daily_profit_percentage')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class=" col-md-4">
                                            <label class="form-label" for="inputPassword4">Return Amount</label>
                                            <input type="date" class="form-control" name="return_amount_when"
                                                value="{{ $data->return_amount_when }}">
                                            @error('return_amount_when')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="inputState">Daily Profit</label>
                                            <select id="inputState" name="profit_daily" class="form-control">
                                                @if ($data->profit_daily == 1)
                                                    <option selected value="1" >Yes</option>
                                                    <option value="0">No</option>
                                                @endif
                                                @if ($data->profit_daily == 0)
                                                    <option selected value="0" >No</option>
                                                    <option value="1">Yes</option>
                                                @endif
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-md-6">
                                            <label class="form-label" for="inputState">Category</label>
                                            <select id="inputState" name="cat_id" class="form-control">
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->cat_id }}"
                                                        {{ $cat->cat_id == $data->cat_id ? 'selected' : '' }}>
                                                        {{ $cat->category_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label" for="inputState">Status</label>
                                            <select id="inputState" name="status" class="form-select">
                                                @if ($data->status == 1)
                                                <option selected value="1">Active</option>
                                                <option  value="0" >Unactive</option>
                                                @else
                                                <option value="1" >Active</option>
                                                <option selected  value="0">Unactive</option>
                                                @endif
                                                
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Plan Image </label>
                                            <input type="file" name="img" class="form-control">
                                        </div>

                                        <input type="hidden" value="{{ $data->img}}" name="old_img"
                                            class="form-control mb-3">

                                            <div class="col-md-6">
                                                <img src="{{ url('/public/planimg') }}/{{ $data->img }}" width="70px"
                                                    alt="img">
                                            </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Update plan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
