@extends('back-end.premium.layout.employee-setting-main')
@section('content')
<?php
    use App\Models\ValueTypeDetail;
    use App\Models\valueTypeConfigDetail;

    use App\Models\User;
    use App\Models\valueTypeConfig;

    $users = User::where('id', Session::get('employee_setup_id'))->first(['id','designation_id', 'department_id', 'id','first_name','last_name']);
    $users_values = valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)
        ->where('value_type_desg_id', $users->designation_id)
        ->get();
    $users_status = valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)
        ->where('value_type_emp_id', $users->id)
        ->where('status', "Approve")
        ->where('created_at',date("Y"))
        ->first();
    $date = new DateTime('now', new \DateTimeZone('Asia/Dhaka'));
    $current_date = $date->format('Y-m-d');
    $current_month = $date->format('m');
    $current_day = $date->format('d');
    $lastDay = $date->modify('last day of this month');
    $lastDays = $lastDay->format('d');

    $review_permission = 'Not-Permitted';
    $year_end_review_permission = 'Not-Permitted';
    $review_visible_days = 0;
    $current_day_number = $current_day;
    $current_month_number = $current_month;
    $lastDayOfcurrentMonth = $lastDays;

    foreach ($yearly_reviews as $yearly_reviews_value) {
        if ($current_month_number == $yearly_reviews_value->yearly_review_after_months && $current_day_number >= $yearly_reviews_value->yearly_review_upto) {
            $review_permission = 'Permitted';
        } else {
            $year_end_review_permission = 'Not-Permitted';
        }

    }

    ?>
<section class="main-contant-section">
    <div class="container-fluid">

        @if (Session::get('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong class="text-danger">{{ $error }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach

        @php($i = 1)

        <div class="objective-contant">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header with-border" style="background:#458191; color:white;">
                            <h1 class="card-title text-center"> {{ $users->first_name ?? '' }}
                                {{ $users->last_name ?? ''}}'s Value Review Form</h1>
                        </div>
                    </div>
                    @if ($review_permission == 'Permitted')
                    <div>
                        <form method="POST" action="{{ route('value-type-configures') }}" enctype="multipart/form-data">
                            @csrf

                            <table class="form-table objective" id="Objective_plan">

                                <th>SL </th>
                                <th>Value</th>
                                <th class="text-center">
                                    Employee Comments with examples of behaviors
                                </th>
                                <th class="text-center">
                                    Supervisor Comments with examples of behavior displayed or not displayed
                                </th>
                                <th class="text-center">
                                    Employee Rating
                                </th>
                                <th class="text-center">
                                    Supervisor Rating
                                </th>


                                @foreach ($variable_types as $variable_type)
                                <input type="hidden" name="value_type_emp_id" class="code" id="customFieldName"
                                    value="{{ Session::get('employee_setup_id') }}" />
                                <input type="hidden" name="value_type_desg_id" class="code" id="customFieldName"
                                    value="{{ $users->designation_id }}" />
                                <input type="hidden" name="value_type_config_dept_id" class="code" id="customFieldName"
                                    value="{{ $users->department_id }}" />
                                <tr>
                                    <th colspan="7" class="text-center">
                                        {{ $variable_type->value_type_name }}
                                    </th>
                                </tr>
                                <tr valign="top">


                                    <?php

                                        $value_type_details = ValueTypeDetail::with('valueConfigDeatils')->where('value_type_detail_com_id', Auth::user()->com_id)
                                        ->where('value_type_detail_value_type_id', $variable_type->id)
                                        ->get();
                                    ?>
                                    @foreach ($value_type_details as $value_type_detail)
                                    <?php
                                    $value_type_config_details =
                                    valueTypeConfigDetail::where('value_type_config_detail_com_id',
                                    Auth::user()->com_id)->where('value_type_config_detail_emp_id',
                                    Session::get('employee_setup_id'))->where('value_type_config_type_detail_id',
                                    $value_type_detail->id)
                                    //->whereYear('created_at', date("Y"))
                                    ->first();

                                    // $value_supervisor_rating =
                                    // valueTypeConfigDetail::where('value_type_config_detail_com_id',
                                    //                         Auth::user()->com_id)
                                    //                         ->where('value_type_config_detail_emp_id', $value_type_config_details->value_type_config_detail_emp_id)
                                    //                         //->whereYear('created_at', date("Y"))
                                    //                         ->groupBy('value_type_config_id')
                                    //                         ->avg('value_type_config_supervisor_rating');
                                    // $value_employee_rating =
                                    // valueTypeConfigDetail::where('value_type_config_detail_com_id',
                                    // Auth::user()->com_id)
                                    // ->where('value_type_config_detail_emp_id', $value_type_config_details->value_type_config_detail_emp_id)
                                    // //->whereYear('created_at', date("Y"))
                                    // ->groupBy('value_type_config_id')
                                    // ->avg('value_type_config_employee_rating');
                                    // $value_type_details =
                                    // valueTypeConfigDetail::where('value_type_config_detail_com_id',
                                    // Auth::user()->com_id)->where('value_type_config_detail_emp_id',
                                    // Session::get('employee_setup_id'))->where('value_type_config_type_detail_id',
                                    // $value_type_detail->id)->get();
                                    ?>
                                <tr valign="top">

                                    <input type="hidden" class="code" name="value_type_id[]"
                                        value="{{ $value_type_detail->value_type_config_type_detail_id ?? null }}" />
                                    <input type="hidden" class="code" name="config_value_type_id[]"
                                        value="{{ $value_type_detail->id ?? null }}" />
                                    <input type="hidden" class="code" name="value_type_config_type_id[]"
                                        value="{{ $variable_type->id ?? null }}" />

                                    <td> <input type="text" readonly value="{{ $i++ }}" /> </td>
                                    <td>{{ $value_type_detail->value_type_detail_value ?? null }}</td>


                                    <td> <input type="text" class="code" id="customFieldValue"
                                            name="employee_comments[]" placeholder="Employee Comments"
                                            value="{{ $value_type_config_details->value_type_config_Employee_behaviour ?? null }} " />
                                    </td>
                                    <td> <input type="text" class="code" id="customFieldValue"
                                            name="supervisor_comments[]"
                                            value="{{ $value_type_config_details->value_type_config_supervisor_comment ?? null }} "
                                            placeholder="Supervisor Comments" readonly />
                                    </td>

                                    <td>
                                        <select name="employee_value_type_point[]" class="form-control  "
                                            data-live-search="true" data-live-search-style="begins"
                                            data-dependent="valuetype" title="{{ __('Select Rating Value') }}...">
                                            {{-- @foreach ($variable_points as $variable_point)
                                            <option value="{{ $variable_point->id }}" {{ $value_type_detail->
                                                valueConfigDeatils->
                                                value_type_config_employee_rating == $variable_point->id ? 'selected' :
                                                '' }}>
                                                {{ $variable_point->value_signature }}
                                            </option>
                                            @endforeach --}}
                                            {{-- @foreach ($value_type_details as $detail) --}}
                                            {{-- $emploee_rating = $detail->value_type_config_employee_rating;
                                            $supervisor_rating = $detail->value_type_config_supervisor_rating; --}}
                                            {{-- @if($value_type_config_details->created_at->format('Y') == date('Y'))
                                            --}}

                                            {{-- <option value="5" {{ $value_type_config_details->
                                                value_type_config_employee_rating == 5 ? 'selected' :
                                                '' }}>A</option>
                                            <option value="4" {{ $value_type_config_details->
                                                value_type_config_employee_rating == 4 ? 'selected' :
                                                '' }}>B</option>
                                            <option value="3" {{ $value_type_config_details->
                                                value_type_config_employee_rating == 3 ? 'selected' :
                                                '' }}>C</option>
                                            <option value="2" {{ $value_type_config_details->
                                                value_type_config_employee_rating == 2 ? 'selected' :
                                                '' }}>D</option>
                                            <option value="1" {{ $value_type_config_details->
                                                value_type_config_employee_rating == 1 ? 'selected' :
                                                '' }}>F</option> --}}
                                            {{-- @else
                                            <option value="" selected>Please Select</option>
                                            <option value="5">A</option>
                                            <option value="4">B</option>
                                            <option value="3">C</option>
                                            <option value="2">D</option>
                                            <option value="1">F</option>
                                            @endif --}}
                                            {{-- @foreach --}}
                                            <option value="" selected>Please Select</option>
                                            <option value="5" {{ $value_type_detail->
                                                value_type_config_employee_rating == 5 ? 'selected' :
                                                '' }}>A</option>
                                            <option value="4" {{ $value_type_detail->
                                                value_type_config_employee_rating == 4 ? 'selected' :
                                                '' }}>B</option>
                                            <option value="3" {{ $value_type_detail->
                                                value_type_config_employee_rating == 3 ? 'selected' :
                                                '' }}>C</option>
                                            <option value="2" {{ $value_type_detail->
                                                value_type_config_employee_rating == 2 ? 'selected' :
                                                '' }}>D</option>
                                            <option value="1" {{ $value_type_detail->
                                                value_type_config_employee_rating == 1 ? 'selected' :
                                                '' }}>F</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="supervisor_employee_value_type_point[]" class="form-control  "
                                            data-live-search="true" data-live-search-style="begins"
                                            data-dependent="valuetype" title="{{ __('Select Rating Value') }}...">
                                            {{-- @foreach ($variable_points as $variable_point)
                                            <option readonly value="{{ $variable_point->id }}" {{ $value_type_detail->
                                                valueConfigDeatils->
                                                value_type_config_employee_rating == $variable_point->id ? 'selected' :
                                                ''}}>
                                                {{ $variable_point->value_signature }}
                                            </option>
                                            @endforeach --}}
                                            {{-- @if($value_type_config_details->created_at->format('Y') == date('Y'))
                                            --}}
                                            {{-- <option value="">Please Select </option>
                                            <option value="5" {{ $value_type_config_details->
                                                value_type_config_supervisor_rating == 5 ? 'selected' :
                                                '' }}>A</option>
                                            <option value="4" {{ $value_type_config_details->
                                                value_type_config_supervisor_rating == 4 ? 'selected' :
                                                '' }}>B</option>
                                            <option value="3" {{ $value_type_config_details->
                                                value_type_config_supervisor_rating == 3 ? 'selected' :
                                                '' }}>C</option>
                                            <option value="2" {{ $value_type_config_details->
                                                value_type_config_supervisor_rating == 2 ? 'selected' :
                                                '' }}>D</option>
                                            <option value="1" {{ $value_type_config_details->
                                                value_type_config_supervisor_rating == 1 ? 'selected' :
                                                '' }}>F</option> --}}
                                            {{-- @else

                                            <option value="" selected>Please Select</option>
                                            <option value="5">A</option>
                                            <option value="4">B</option>
                                            <option value="3">C</option>
                                            <option value="2">D</option>
                                            <option value="1">F</option>

                                            @endif --}}
                                            <option value="" selected>Please Select</option>
                                            <option value="5" {{ $value_type_detail->
                                                value_type_config_supervisor_rating == 5 ? 'selected' :
                                                '' }}>A</option>
                                            <option value="4" {{ $value_type_detail->
                                                value_type_config_supervisor_rating == 4 ? 'selected' :
                                                '' }}>B</option>
                                            <option value="3" {{ $value_type_detail->
                                                value_type_config_supervisor_rating == 3 ? 'selected' :
                                                '' }}>C</option>
                                            <option value="2" {{ $value_type_detail->
                                                value_type_config_supervisor_rating == 2 ? 'selected' :
                                                '' }}>D</option>
                                            <option value="1" {{ $value_type_detail->
                                                value_type_config_supervisor_rating == 1 ? 'selected' :
                                                '' }}>F</option>
                                        </select>
                                    </td>
                                </tr>

                                @endforeach
                                </tr>
                                @endforeach

                                <tr>
                                    <td class=" text-right" colspan="4">Value Average</td>
                                    <td class=" text-center">
                                        {{-- @if($value_employee_rating == 5) {{__('A') }}
                                        @elseif($value_employee_rating >= 4) {{__('B') }}
                                        @elseif($value_employee_rating >= 3) {{__('C') }}
                                        @elseif($value_employee_rating >= 2) {{__('D') }}
                                        @elseif($value_employee_rating >= 1) {{__('F') }}
                                        @endif --}}
                                        {{-- {{ $value_employee_rating }} --}}
                                    </td>
                                    <td class=" text-center">
                                        {{-- @if($value_supervisor_rating == 5) {{__('A') }}
                                        @elseif($value_supervisor_rating >= 4) {{__('B') }}
                                        @elseif($value_supervisor_rating >= 3) {{__('C') }}
                                        @elseif($value_supervisor_rating >= 2) {{__('D') }}
                                        @elseif($value_supervisor_rating >= 1) {{__('F') }}
                                        @endif --}}
                                        {{-- {{ $value_supervisor_rating }} --}}
                                    </td>
                                </tr>
                                <span id="objec"></span>
                            </table>
                            {{-- @if($users_status->status == "Approve")

                            @else
                            <button class="btn btn-grad">Save</button>
                            @endif --}}

                            <button class="btn btn-grad">Save</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="content-box">
                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Year') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($value_type_configs as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->valueDepartment->department_name ?? null }}</td>
                                <td>{{ $value->valueDesignation->designation_name ?? null }}</td>
                                <td>{{ ucfirst($value->valueUser->first_name ?? '') }}
                                    {{ ucfirst($value->valueUser->last_name ?? '') }}
                                </td>

                                <td>{{$value->created_at->format('Y')}} </td>
                                <td> <a href="{{ route('employee-performance-value-type-configure-details', $value->id) }}"
                                        class="btn btn-info">Details</a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
@endsection
