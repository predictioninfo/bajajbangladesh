@extends('back-end.premium.layout.premium-main')

@section('content')
    <?php
    use App\Models\Permission;
    use App\Models\Attendance;
    use App\Models\Leave;
    use App\Models\Holiday;
    use App\Models\Travel;
    use App\Models\Role;
    use App\Models\MonthlyAttendance;
    use App\Models\LateTime;
    use App\Models\CompensatoryLeave;
    use App\Models\LatetimeConfig;
    use App\Helpers\Helper;
    //use DateTime;

    $date = new DateTime('now', new \DateTimeZone('Asia/Kolkata'));
    $current_date = $date->format('Y-m-d');
    //$current_time = $date->format('H:i:s');
    ?>

    <section class="main-contant-section">

        <div class=" mb-3">

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



                <div class=" attendance-search">
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title text-center"> {{ __('Month Wise Attendance') }} </h3>
                        </div>

                    </div>
                </div>
          



            <div>Present = P, Absent = A, Leave = L, Weekend = W, Travel = T</div>
            <div class="content-box">
                <form method="post" action="{{ route('month-wise-employee-attendance') }}" class="container-fluid">
                    @csrf

                    <div class="row">

                        <div class="col-md-3 form-group">

                            <label>{{ __('Employee') }} </label>
                            <select name="employee_id" class="form-control selectpicker" data-live-search="true"
                                data-live-search-style="begins" title='Employee'>
                                <option value="">All Employees</option>
                                @foreach ($employees as $employees_value)
                                    <option value="{{ $employees_value->id }}"
                                        data-subtext="<img class='rounded-circle' width='60' height='40'' src='{{ $employees_value->profile_photo }}'>">
                                        {{ $employees_value->first_name }}
                                        {{ $employees_value->last_name }}({{ $employees_value->company_assigned_id }})
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_date">{{ __('Month') }}</label>
                                <input class="form-control" name="month_year" type="month">
                            </div>
                        </div>

                        <div class="col-md-3 form-group mt-4">
                            <input type="submit" name="Search" class="btn btn-grad" value="{{ __('Search') }}" />
                            <input type="submit" name="download" class="btn btn-grad" value="{{ __('Download') }}" />
                        </div>

                    </div>

                </form>
                <div class="table-responsive">
                    <table id="user-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee </th>
                                <th>Employee ID</th>
                                <?php
                        $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);

                        for($i = 1; $i <= $days; $i++){ ?>
                                <?php  if($i%2 == 1){?>
                                <th style="background-color: rgb(245, 227, 227);">
                                    <?php
                                    if ($i < 10) {
                                        $date_month_year = $year . '-' . $month . '-' . $i;
                                        echo date('Y-m-d', strtotime($date_month_year));
                                    } else {
                                        $date_month_year = $year . '-' . $month . '-' . $i;
                                        echo date('Y-m-d', strtotime($date_month_year));
                                    }
                                    ?>
                                </th>
                                <th style="background-color: rgb(245, 227, 227);">InTime</th>
                                <th style="background-color: rgb(245, 227, 227);">OutTime</th>
                                <th style="background-color: #e08c47;">Work Hour</th>
                                <?php }else{ ?>
                                <th>
                                    <?php
                                    if ($i < 10) {
                                        $date_month_year = $year . '-' . $month . '-' . $i;
                                        echo date('Y-m-d', strtotime($date_month_year));
                                    } else {
                                        $date_month_year = $year . '-' . $month . '-' . $i;
                                        echo date('Y-m-d', strtotime($date_month_year));
                                    }
                                    ?>
                                </th>
                                <th>InTime</th>
                                <th>OutTime</th>
                                <th>Work Hour</th>
                                <?php  } }?>


                                {{-- <th>Worked Days</th> --}}
                                <th>Total Worked Hours</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($j = 1)
                            @foreach ($attendances as $attendancesValue)
                                {{-- @php($date_wise_day_name = date('D', strtotime($attendancesValue->attendance_month)))
                        @php($attendance_dates = "'".$attendancesValue->attendance_month."'") --}}
                                <?php

                                //exit;
                                $day_one_string = '01';
                                $day_one_year_month_date = $year . '-' . $month . '-' . $day_one_string;
                                $day_one_date_wise_day_name = date('D', strtotime($day_one_year_month_date));

                                $day_two_string = '02';
                                $day_two_year_month_date = $year . '-' . $month . '-' . $day_two_string;
                                $day_two_date_wise_day_name = date('D', strtotime($day_two_year_month_date));

                                $day_three_string = '03';
                                $day_three_year_month_date = $year . '-' . $month . '-' . $day_three_string;
                                $day_three_date_wise_day_name = date('D', strtotime($day_three_year_month_date));

                                $day_four_string = '04';
                                $day_four_year_month_date = $year . '-' . $month . '-' . $day_four_string;
                                $day_four_date_wise_day_name = date('D', strtotime($day_four_year_month_date));

                                $day_five_string = '05';
                                $day_five_year_month_date = $year . '-' . $month . '-' . $day_five_string;
                                $day_five_date_wise_day_name = date('D', strtotime($day_five_year_month_date));

                                $day_six_string = '06';
                                $day_six_year_month_date = $year . '-' . $month . '-' . $day_six_string;
                                $day_six_date_wise_day_name = date('D', strtotime($day_six_year_month_date));

                                $day_seven_string = '07';
                                $day_seven_year_month_date = $year . '-' . $month . '-' . $day_seven_string;
                                $day_seven_date_wise_day_name = date('D', strtotime($day_seven_year_month_date));

                                $day_eight_string = '08';
                                $day_eight_year_month_date = $year . '-' . $month . '-' . $day_eight_string;
                                $day_eight_date_wise_day_name = date('D', strtotime($day_eight_year_month_date));

                                $day_nine_string = '09';
                                $day_nine_year_month_date = $year . '-' . $month . '-' . $day_nine_string;
                                $day_nine_date_wise_day_name = date('D', strtotime($day_nine_year_month_date));

                                $day_ten_string = '10';
                                $day_ten_year_month_date = $year . '-' . $month . '-' . $day_ten_string;
                                $day_ten_date_wise_day_name = date('D', strtotime($day_ten_year_month_date));

                                $day_eleven_string = '11';
                                $day_eleven_year_month_date = $year . '-' . $month . '-' . $day_eleven_string;
                                $day_eleven_date_wise_day_name = date('D', strtotime($day_eleven_year_month_date));

                                $day_twelve_string = '12';
                                $day_twelve_year_month_date = $year . '-' . $month . '-' . $day_twelve_string;
                                $day_twelve_date_wise_day_name = date('D', strtotime($day_twelve_year_month_date));

                                $day_thirteen_string = '13';
                                $day_thirteen_year_month_date = $year . '-' . $month . '-' . $day_thirteen_string;
                                $day_thirteen_date_wise_day_name = date('D', strtotime($day_thirteen_year_month_date));

                                $day_fourteen_string = '14';
                                $day_fourteen_year_month_date = $year . '-' . $month . '-' . $day_fourteen_string;
                                $day_fourteen_date_wise_day_name = date('D', strtotime($day_fourteen_year_month_date));

                                $day_fifteen_string = '15';
                                $day_fifteen_year_month_date = $year . '-' . $month . '-' . $day_fifteen_string;
                                $day_fifteen_date_wise_day_name = date('D', strtotime($day_fifteen_year_month_date));

                                $day_sixteen_string = '16';
                                $day_sixteen_year_month_date = $year . '-' . $month . '-' . $day_sixteen_string;
                                $day_sixteen_date_wise_day_name = date('D', strtotime($day_sixteen_year_month_date));

                                $day_seventeen_string = '17';
                                $day_seventeen_year_month_date = $year . '-' . $month . '-' . $day_seventeen_string;
                                $day_seventeen_date_wise_day_name = date('D', strtotime($day_seventeen_year_month_date));

                                $day_eighteen_string = '18';
                                $day_eighteen_year_month_date = $year . '-' . $month . '-' . $day_eighteen_string;
                                $day_eighteen_date_wise_day_name = date('D', strtotime($day_eighteen_year_month_date));

                                $day_nineteen_string = '19';
                                $day_nineteen_year_month_date = $year . '-' . $month . '-' . $day_nineteen_string;
                                $day_nineteen_date_wise_day_name = date('D', strtotime($day_nineteen_year_month_date));

                                $day_twenty_string = '20';
                                $day_twenty_year_month_date = $year . '-' . $month . '-' . $day_twenty_string;
                                $day_twenty_date_wise_day_name = date('D', strtotime($day_twenty_year_month_date));

                                $day_twenty_one_string = '21';
                                $day_twenty_one_year_month_date = $year . '-' . $month . '-' . $day_twenty_one_string;
                                $day_twenty_one_date_wise_day_name = date('D', strtotime($day_twenty_one_year_month_date));

                                $day_twenty_two_string = '22';
                                $day_twenty_two_year_month_date = $year . '-' . $month . '-' . $day_twenty_two_string;
                                $day_twenty_two_date_wise_day_name = date('D', strtotime($day_twenty_two_year_month_date));

                                $day_twenty_three_string = '23';
                                $day_twenty_three_year_month_date = $year . '-' . $month . '-' . $day_twenty_three_string;
                                $day_twenty_three_date_wise_day_name = date('D', strtotime($day_twenty_three_year_month_date));

                                $day_twenty_four_string = '24';
                                $day_twenty_four_year_month_date = $year . '-' . $month . '-' . $day_twenty_four_string;
                                $day_twenty_four_date_wise_day_name = date('D', strtotime($day_twenty_four_year_month_date));

                                $day_twenty_five_string = '25';
                                $day_twenty_five_year_month_date = $year . '-' . $month . '-' . $day_twenty_five_string;
                                $day_twenty_five_date_wise_day_name = date('D', strtotime($day_twenty_five_year_month_date));

                                $day_twenty_six_string = '26';
                                $day_twenty_six_year_month_date = $year . '-' . $month . '-' . $day_twenty_six_string;
                                $day_twenty_six_date_wise_day_name = date('D', strtotime($day_twenty_six_year_month_date));

                                $day_twenty_seven_string = '27';
                                $day_twenty_seven_year_month_date = $year . '-' . $month . '-' . $day_twenty_seven_string;
                                $day_twenty_seven_date_wise_day_name = date('D', strtotime($day_twenty_seven_year_month_date));

                                $day_twenty_eight_string = '28';
                                $day_twenty_eight_year_month_date = $year . '-' . $month . '-' . $day_twenty_eight_string;
                                $day_twenty_eight_date_wise_day_name = date('D', strtotime($day_twenty_eight_year_month_date));

                                $day_twenty_nine_string = '29';
                                $day_twenty_nine_year_month_date = $year . '-' . $month . '-' . $day_twenty_nine_string;
                                $day_twenty_nine_date_wise_day_name = date('D', strtotime($day_twenty_nine_year_month_date));

                                $day_thirty_string = '30';
                                $day_thirty_year_month_date = $year . '-' . $month . '-' . $day_thirty_string;
                                $day_thirty_date_wise_day_name = date('D', strtotime($day_thirty_year_month_date));

                                $day_thirty_one_string = '31';
                                $day_thirty_one_year_month_date = $year . '-' . $month . '-' . $day_thirty_one_string;
                                $day_thirty_one_date_wise_day_name = date('D', strtotime($day_thirty_one_year_month_date));

                                ?>
                                <tr>

                                    <td>{{ $j++ }}</td>
                                    <td>{{ $attendancesValue->first_name . ' ' . $attendancesValue->last_name }}</td>
                                    <td>{{ $attendancesValue->company_assigned_id }}</td>
                                    <!-- Day One Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)
                                    ->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>


                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')
                                    ->where('holiday_name','=',$day_one_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')
                                    ->whereRaw('"'.$day_one_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_one_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day One Collumn code Ends -->

                                    <!-- Day 2 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_two_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_two_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_two_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_two_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_two_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 2 Collumn code Ends -->

                                    <!-- Day 3 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_three_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_three_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_three_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_three_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_three_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 3 Collumn code Ends -->

                                    <!-- Day 4 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_four_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_four_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_four_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_four_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_four_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 4 Collumn code Ends -->

                                    <!-- Day 5 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_five_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_five_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_five_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_five_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_five_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 5 Collumn code Ends -->

                                    <!-- Day 6 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_six_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_six_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_six_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_six_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_six_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 6 Collumn code Ends -->

                                    <!-- Day 7 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_seven_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_seven_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_seven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_seven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seven_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 7 Collumn code Ends -->

                                    <!-- Day 8 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eight_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eight_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eight_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eight_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eight_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 8 Collumn code Ends -->

                                    <!-- Day 9 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_nine_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_nine_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_nine_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_nine_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nine_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 9 Collumn code Ends -->

                                    <!-- Day 10 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_ten_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_ten_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_ten_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_ten_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_ten_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 10 Collumn code Ends -->

                                    <!-- Day 11 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eleven_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eleven_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eleven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eleven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eleven_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 11 Collumn code Ends -->

                                    <!-- Day 12 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twelve_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twelve_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twelve_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twelve_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twelve_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 12 Collumn code Ends -->

                                    <!-- Day 13 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirteen_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 13 Collumn code Ends -->

                                    <!-- Day 14 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_fourteen_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_fourteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_fourteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_fourteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fourteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 14 Collumn code Ends -->

                                    <!-- Day 15 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_fifteen_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_fifteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_fifteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_fifteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_fifteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 15 Collumn code Ends -->

                                    <!-- Day 16 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_sixteen_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_sixteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_sixteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_sixteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_sixteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 16 Collumn code Ends -->

                                    <!-- Day 17 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_seventeen_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_seventeen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_seventeen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_seventeen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_seventeen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 17 Collumn code Ends -->

                                    <!-- Day 18 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_eighteen_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_eighteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_eighteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_eighteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_eighteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 18 Collumn code Ends -->

                                    <!-- Day 19 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_nineteen_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_nineteen_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_nineteen_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_nineteen_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_nineteen_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 19 Collumn code Ends -->

                                    <!-- Day 20 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 20 Collumn code Ends -->

                                    <!-- Day 21 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_one_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_one_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 21 Collumn code Ends -->

                                    <!-- Day 22 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_two_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_two_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_two_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 22 Collumn code Ends -->

                                    <!-- Day 23 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_three_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_three_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_three_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 23 Collumn code Ends -->

                                    <!-- Day 24 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_four_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_four_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_four_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 24 Collumn code Ends -->

                                    <!-- Day 25 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_five_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_five_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_five_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 25 Collumn code Ends -->

                                    <!-- Day 26 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_six_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_six_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_six_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 26 Collumn code Ends -->

                                    <!-- Day 27 Collumn code Starts -->
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_seven_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_seven_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_seven_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <!-- Day 27 Collumn code Ends -->

                                    <!-- Day 28 Collumn code Starts -->
                                    <?php if($days >= 28){ ?>
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_eight_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_eight_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_eight_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <?php }?>

                                    <!-- Day 28 Collumn code Ends -->

                                    <!-- Day 29 Collumn code Starts -->
                                    <?php if($days >= 29){ ?>
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_twenty_nine_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_twenty_nine_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_twenty_nine_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <?php } ?>

                                    <!-- Day 29 Collumn code Ends -->

                                    <!-- Day 30 Collumn code Starts -->
                                    <?php if($days >= 30){ ?>
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td>{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirty_date_wise_day_name)->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirty_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td>{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirty_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td>{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirty_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td>{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td>{{ __('A') }}</td>
                                    <?php } ?>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td>
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <?php } ?>

                                    <!-- Day 30 Collumn code Ends -->

                                    <!-- Day 31 Collumn code Starts -->
                                    <?php if($days >= 31){ ?>
                                    <?php if(Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out', '=',1)->exists()){ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('P') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$day_thirty_one_date_wise_day_name)->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `start_date` and `end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('W') }}</td>
                                    <?php }elseif(Leave::where('leaves_employee_id',$attendancesValue->monthly_employee_id)->where('leaves_status','=','Approved')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `leaves_start_date` and `leaves_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('L') }}</td>
                                    <?php }elseif(Travel::where('travel_employee_id',$attendancesValue->monthly_employee_id)->where('travel_status','=','Approved')->whereRaw('"'.$day_thirty_one_year_month_date.'" between `travel_start_date` and `travel_end_date`')->exists()) { ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('T') }}</td>
                                    <?php }else{ ?>
                                    <td style="background-color: rgb(245, 227, 227);">{{ __('A') }}</td>
                                    <?php } ?>

                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_in ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out','=',1)->first()){ ?>
                                        {{ $test->clock_out ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <td style="background-color: rgb(245, 227, 227);">
                                        <?php if($test =Attendance::where('employee_id','=',$attendancesValue->monthly_employee_id)->whereDate('attendance_date','=',$day_thirty_one_year_month_date)->where('check_in_out','=',1)->whereNotNull('clock_out')->first()){ ?>
                                        {{ $test->total_work ?? null }}
                                        <?php }else{ }?>
                                    </td>
                                    <?php

                            } ?>

                                    <?php
                                    // $current_month = $date->format('m');
                                    // $current_year = $date->format('Y');
                                    $attendance_work_hours_counts = Attendance::where('employee_id', '=', $attendancesValue->monthly_employee_id)
                                        ->whereMonth('attendance_date', '=', $current_month)
                                        ->whereYear('attendance_date', '=', $current_year)
                                        ->where('check_in_out', '=', 1)
                                        ->whereNotNull('clock_out')
                                        ->get();

                                    $total_work_hours = 0;
                                    foreach ($attendance_work_hours_counts as $a) {
                                        sscanf($a->total_work, '%d:%d', $hour, $min);
                                        $total_work_hours += $hour * 60 + $min;
                                    }

                                    if ($h = floor($total_work_hours / 60)) {
                                        $total_work_hours %= 60;
                                    }
                                    $sum_total_hours = sprintf('%02d:%02d', $h, $total_work_hours);

                                    ?>

                                    <?php
                                    $date = new DateTime('now', new \DateTimeZone('Asia/Kolkata'));
                                    $last_month_date_year = $date->format('m');
                                    $last_month = $date->format('m');
                                    $previous_month_year = $date->format('Y');

                                    // $last_month_date_year = date('Y-m-d', strtotime('current month'));
                                    // $last_month = date('m', strtotime($date->format('m')));
                                    // $date_wise_day_name = date('D', strtotime('current month'));
                                    // $previous_month_year = date('Y', strtotime($date->format('Y')));
                                    //dd($previous_month_year);

                                    // $attendances = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                                    //     ->select('monthly_attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                                    //     ->where('monthly_com_id', '=', Auth::user()->com_id)
                                    //     ->whereMonth('attendance_month', '=', $last_month)
                                    //     ->whereYear('attendance_year', '=', $previous_month_year)
                                    //     ->get();
                                    //return response()->json($attendances);
                                    //dd($attendances);
                                    // return $attendances;

                                    $total_number_of_days_of_the_month = cal_days_in_month(CAL_GREGORIAN, $last_month, $previous_month_year);
                                    //dd($total_number_of_days_of_the_month);
                                    $first_date_of_last_month = $previous_month_year . '-' . $last_month . '-' . '01';
                                    //dd($first_date_of_last_month);
                                    $last_date_of_the_last_month = $previous_month_year . '-' . $last_month . '-' . $total_number_of_days_of_the_month;
                                    //dd($last_date_of_the_last_month);

                                    $month = $date->format('m');
                                    //dd($month);

                                    $year = $date->format('Y');
                                    // dd($year);

                                    ////// function to find total number of holidays code starts////////////
                                    // function total_holiday($month, $year)
                                    // {
                                    // $holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->get();
                                    // // dd($holidays_names);

                                    // $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                    // // dd($total_days);

                                    // $holidays = 0;
                                    // for ($i = 1; $i <= $total_days; $i++)
                                    //     foreach ($holidays_names as $holidays_names_value) {
                                    //         if (date('N', strtotime($year . '-' . $month . '-' . $i)) == $holidays_names_value->holiday_number)   //if monday means 1, tue means 2.... sunday means 7
                                    //             //dd($holidays_names_value->holiday_number);
                                    //             $holidays++;
                                    //         //dd($holidays_names_value->holiday_name);
                                    //     }
                                    // return $holidays;
                                    // }

                                    if (
                                        Holiday::where('holiday_com_id', Auth::user()->com_id)
                                            ->where('holiday_type', '=', 'Other-Holiday')
                                            ->exists()
                                    ) {
                                        $other_holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                            ->where('holiday_type', '=', 'Other-Holiday')
                                            ->get();

                                        // dd($other_holidays);

                                        $all_other_holidays_without_weekly_holiday = 0;
                                        foreach ($other_holidays as $other_holidays_value) {
                                            if ($other_holidays_value->start_date >= $first_date_of_last_month && $other_holidays_value->start_date <= $last_date_of_the_last_month) {
                                                if ($other_holidays_value->end_date >= $first_date_of_last_month && $other_holidays_value->end_date <= $last_date_of_the_last_month) {
                                                    //echo "(other start date and end date exists in dates)";

                                                    // echo "ok";

                                                    ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                    $finding_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();
                                                    //dd($finding_holidays_names);
                                                    $start_date_other_holiday_wise = date('d', strtotime($other_holidays_value->start_date));
                                                    $end_date_other_holiday_wise = date('d', strtotime($other_holidays_value->end_date));

                                                    $other_holiday_wise_holidays = 0;
                                                    for ($i = $start_date_other_holiday_wise; $i <= $end_date_other_holiday_wise; $i++) {
                                                        foreach ($finding_holidays_names as $finding_holidays_names_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $other_holiday_wise_holidays++;
                                                            }
                                                        };
                                                    }
                                                    //echo $other_holiday_wise_holidays;
                                                    ###################################### joining date wise holidays counting from start date to end date code ends here ######################################

                                                    $otherHolidayWiseOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                    $otherHolidayWiseOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                    $otherHolidayWiseOtherHolidayDifference = $otherHolidayWiseOtherHolidayEndDate->diff($otherHolidayWiseOtherHolidayStartDate);
                                                    $all_other_holidays_without_weekly_holiday += $otherHolidayWiseOtherHolidayDifference->format('%a') + 1 - $other_holiday_wise_holidays;
                                                } else {
                                                    //echo "(other start date exists but end date not in dates)";

                                                    ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                    $finding_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();
                                                    //dd($finding_holidays_names);
                                                    $start_date_other_holiday_wise = date('d', strtotime($other_holidays_value->start_date));
                                                    $end_date_other_holiday_wise = date('d', strtotime($last_date_of_the_last_month));

                                                    $other_holiday_wise_holidays = 0;
                                                    for ($i = $start_date_other_holiday_wise; $i <= $end_date_other_holiday_wise; $i++) {
                                                        foreach ($finding_holidays_names as $finding_holidays_names_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $other_holiday_wise_holidays++;
                                                            }
                                                        };
                                                    }
                                                    //echo $other_holiday_wise_holidays;
                                                    ###################################### joining date wise holidays counting from start date to end date code ends here ######################################

                                                    $otherHolidayWiseOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                    $otherHolidayWiseOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                    $otherHolidayWiseOtherHolidayDifference = $otherHolidayWiseOtherHolidayEndDate->diff($otherHolidayWiseOtherHolidayStartDate);
                                                    $all_other_holidays_without_weekly_holiday += $otherHolidayWiseOtherHolidayDifference->format('%a') + 1 - $other_holiday_wise_holidays;
                                                }
                                            } else {
                                                if ($other_holidays_value->end_date >= $first_date_of_last_month && $other_holidays_value->end_date <= $last_date_of_the_last_month) {
                                                    //echo "(other start date not exists but end date exists in dates)";

                                                    ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                    $finding_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();
                                                    //dd($finding_holidays_names);
                                                    $start_date_other_holiday_wise = date('d', strtotime($first_date_of_last_month));
                                                    $end_date_other_holiday_wise = date('d', strtotime($other_holidays_value->end_date));

                                                    $other_holiday_wise_holidays = 0;
                                                    for ($i = $start_date_other_holiday_wise; $i <= $end_date_other_holiday_wise; $i++) {
                                                        foreach ($finding_holidays_names as $finding_holidays_names_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $other_holiday_wise_holidays++;
                                                            }
                                                        };
                                                    }
                                                    //echo $other_holiday_wise_holidays;
                                                    ###################################### joining date wise holidays counting from start date to end date code ends here ######################################

                                                    $otherHolidayWiseOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                    $otherHolidayWiseOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                    $otherHolidayWiseOtherHolidayDifference = $otherHolidayWiseOtherHolidayEndDate->diff($otherHolidayWiseOtherHolidayStartDate);
                                                    $all_other_holidays_without_weekly_holiday += $otherHolidayWiseOtherHolidayDifference->format('%a') + 1 - $other_holiday_wise_holidays;
                                                } else {
                                                    if ($other_holidays_value->start_date <= $first_date_of_last_month && $other_holidays_value->end_date >= $last_date_of_the_last_month) {
                                                        //echo "(both dates are out of the joining date and end date of the month)";

                                                        ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                        $finding_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                            ->get();
                                                        //dd($finding_holidays_names);
                                                        $start_date_other_holiday_wise = date('d', strtotime($first_date_of_last_month));
                                                        $end_date_other_holiday_wise = date('d', strtotime($last_date_of_the_last_month));

                                                        $other_holiday_wise_holidays = 0;
                                                        for ($i = $start_date_other_holiday_wise; $i <= $end_date_other_holiday_wise; $i++) {
                                                            foreach ($finding_holidays_names as $finding_holidays_names_value) {
                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_value->holiday_number) {
                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                    $other_holiday_wise_holidays++;
                                                                }
                                                            };
                                                        }
                                                        //echo $other_holiday_wise_holidays;
                                                        ###################################### joining date wise holidays counting from start date to end date code ends here ######################################

                                                        $otherHolidayWiseOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                        $otherHolidayWiseOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                        $otherHolidayWiseOtherHolidayDifference = $otherHolidayWiseOtherHolidayEndDate->diff($otherHolidayWiseOtherHolidayStartDate);
                                                        $all_other_holidays_without_weekly_holiday += $otherHolidayWiseOtherHolidayDifference->format('%a') + 1 - $other_holiday_wise_holidays;
                                                        //dd($other_holiday_wise_holidays);
                                                    } else {
                                                        $all_other_holidays_without_weekly_holiday += 0;
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        $all_other_holidays_without_weekly_holiday = 0;
                                        //dd($all_other_holidays_without_weekly_holiday);
                                    }
                                    ////// other-holiday count code ends////////////

                                    // foreach ($attendances as $attendancesValue) {

                                    ############################################### attendance count code starts################################
                                    $attendance_counts = Attendance::where('employee_id', '=', $attendancesValue->monthly_employee_id)
                                        ->whereMonth('attendance_date', '=', $last_month)
                                        ->whereYear('attendance_date', '=', $previous_month_year)
                                        ->where('check_in_out', '=', 1)
                                        ->get();
                                    $all_attendances_of_the_month = $attendance_counts->count();
                                    $all_attendances_of_the_month;
                                    ############################################## attendance count code ends here ######################################

                                    ############################################## approved half leave days count code starts ######################################
                                    if (
                                        Leave::where('leaves_employee_id', $attendancesValue->monthly_employee_id)
                                            ->where('is_half', '=', 1)
                                            ->where('leaves_status', '=', 'Approved')
                                            ->whereMonth('leaves_start_date', '=', $last_month)
                                            ->whereYear('leaves_end_date', '=', $previous_month_year)
                                            ->exists()
                                    ) {
                                        $employee_half_leaves = Leave::where('leaves_employee_id', $attendancesValue->monthly_employee_id)
                                            ->where('is_half', '=', 1)
                                            ->where('leaves_status', '=', 'Approved')
                                            ->whereMonth('leaves_start_date', '=', $last_month)
                                            ->whereYear('leaves_end_date', '=', $previous_month_year)
                                            ->get();

                                        $all_half_leaves_by_employee_without_holiday = 0;
                                        //$number_of_attendances_on_half_leave = 0;

                                        foreach ($employee_half_leaves as $employee_half_leaves_value) {
                                            ###################################### holidays counting from leave start date to end date code starts ######################################
                                            $half_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                ->where('holiday_type', '=', 'Weekly-Holiday')
                                                ->get();

                                            $half_leave_start_date = date('d', strtotime($employee_half_leaves_value->leaves_start_date));
                                            $half_leave_end_date = date('d', strtotime($employee_half_leaves_value->leaves_end_date));

                                            $half_holidays_in_leave = 0;
                                            for ($i = $half_leave_start_date; $i <= $half_leave_end_date; $i++) {
                                                foreach ($half_holidays_names as $half_holidays_names_value) {
                                                    if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $half_holidays_names_value->holiday_number) {
                                                        $half_holidays_in_leave += 1;
                                                    } else {
                                                        $half_holidays_in_leave += 0;
                                                    } //if monday means 1, tue means 2.... sunday means 7
                                                }
                                            }

                                            //echo $half_holidays_in_leave;

                                            ###################################### holidays counting from leave start date to end date code ends here ######################################

                                            $startDateHalf = new DateTime($employee_half_leaves_value->leaves_start_date);
                                            $endDateHalf = new DateTime($employee_half_leaves_value->leaves_end_date);

                                            $difference_for_half_leaves = $endDateHalf->diff($startDateHalf);
                                            $all_half_leaves_by_employee_with_holiday = $difference_for_half_leaves->format('%a') + 1; //number of days with holidays between leave start date to end date
                                            $all_half_leaves_by_employee_without_holiday += ($all_half_leaves_by_employee_with_holiday - $half_holidays_in_leave) / 2; //number of days without holidays between leave start date to end date
                                            //$number_of_attendances_on_half_leave += $all_half_leaves_by_employee_with_holiday - $half_holidays_in_leave; //number of attendances on half leave
                                        }
                                    } else {
                                        $all_half_leaves_by_employee_without_holiday = 0;
                                        //$number_of_attendances_on_half_leave = 0;
                                    }

                                    ###################################### approved half leave days count code ends here ######################################

                                    ####################################################### number of attendences on approved half leave code starts #####################################
                                    if (
                                        Leave::where('leaves_employee_id', $attendancesValue->monthly_employee_id)
                                            ->where('is_half', '=', 1)
                                            ->where('leaves_status', '=', 'Approved')
                                            ->whereMonth('leaves_start_date', '=', $last_month)
                                            ->whereYear('leaves_end_date', '=', $previous_month_year)
                                            ->exists()
                                    ) {
                                        $employee_half_leaves_to_get_no_of_attendences = Leave::where('leaves_employee_id', $attendancesValue->monthly_employee_id)
                                            ->where('is_half', '=', 1)
                                            ->where('leaves_status', '=', 'Approved')
                                            ->whereMonth('leaves_start_date', '=', $last_month)
                                            ->whereYear('leaves_end_date', '=', $previous_month_year)
                                            ->get();

                                        $number_of_attendances_on_half_leave = 0;

                                        foreach ($employee_half_leaves_to_get_no_of_attendences as $employee_half_leaves_to_get_no_of_attendences_value) {
                                            //echo $employee_half_leaves_to_get_no_of_attendences_value->leaves_start_date;
                                            if (
                                                Attendance::where('employee_id', $attendancesValue->monthly_employee_id)
                                                    ->where('attendance_date', $employee_half_leaves_to_get_no_of_attendences_value->leaves_start_date)
                                                    ->exists()
                                            ) {
                                                $number_of_attendances_on_half_leave += 1;
                                            } else {
                                                $number_of_attendances_on_half_leave += 0;
                                            }
                                        }
                                    } else {
                                        $number_of_attendances_on_half_leave = 0;
                                    }

                                    //echo $number_of_attendances_on_half_leave;

                                    ###################################### number of attendences on approved half leave code ends here ###################################################

                                    ########################################## Approved Leaving Days counting code starts##########################################
                                    if (
                                        Leave::where('leaves_employee_id', $attendancesValue->monthly_employee_id)
                                            ->where(function ($query) {
                                                $query->where('is_half', 0)->orWhereNull('is_half');
                                            })
                                            ->where('leaves_status', '=', 'Approved')
                                            ->exists()
                                    ) {
                                        /////leave days exists or not condition starts/////////////////

                                        $employee_leaves = Leave::where('leaves_employee_id', $attendancesValue->monthly_employee_id)
                                            ->where(function ($query) {
                                                $query->where('is_half', 0)->orWhereNull('is_half');
                                            })
                                            ->where('leaves_status', '=', 'Approved')
                                            ->get();
                                        $all_leaves_by_employee_without_holiday = 0;

                                        foreach ($employee_leaves as $employee_leaves_value) {
                                            if ($employee_leaves_value->leaves_start_date >= $first_date_of_last_month && $employee_leaves_value->leaves_start_date <= $last_date_of_the_last_month) {
                                                if ($employee_leaves_value->leaves_end_date >= $first_date_of_last_month && $employee_leaves_value->leaves_end_date <= $last_date_of_the_last_month) {
                                                    //echo "(start date and end date exists in last month)";

                                                    ###################################### holidays counting from leave start date to end date code starts ######################################
                                                    $company_holidays_names_in_leave = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();

                                                    $leaves_start_date = date('d', strtotime($employee_leaves_value->leaves_start_date));
                                                    $leaves_end_date = date('d', strtotime($employee_leaves_value->leaves_end_date));

                                                    $holidays_in_leave = 0;
                                                    for ($i = $leaves_start_date; $i <= $leaves_end_date; $i++) {
                                                        foreach ($company_holidays_names_in_leave as $company_holidays_names_in_leave_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $company_holidays_names_in_leave_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $holidays_in_leave++;
                                                            }
                                                        };
                                                    }

                                                    ###################################### holidays counting from leave start date to end date code ends here ######################################
                                                    ###################################### other holidays counting from leave start date to end date code ends here ######################################
                                                    if (
                                                        Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->exists()
                                                    ) {
                                                        //////other holiday exists or not condition starts

                                                        $other_holidays_in_leave = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->get();

                                                        foreach ($other_holidays_in_leave as $other_holidays_in_leave_value) {
                                                            if ($other_holidays_in_leave_value->start_date >= $employee_leaves_value->leaves_start_date && $other_holidays_in_leave_value->start_date <= $employee_leaves_value->leaves_end_date) {
                                                                if ($other_holidays_in_leave_value->end_date >= $employee_leaves_value->leaves_start_date && $other_holidays_in_leave_value->end_date <= $employee_leaves_value->leaves_end_date) {
                                                                    //echo "(other start date and end date exists in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->end_date));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($other_holidays_in_leave_value->start_date);
                                                                    $leaveOtherHolidayEndDate = new DateTime($other_holidays_in_leave_value->end_date);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                } else {
                                                                    //echo "(other start date exists but end date not in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_end_date));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($other_holidays_in_leave_value->start_date);
                                                                    $leaveOtherHolidayEndDate = new DateTime($employee_leaves_value->leaves_end_date);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                }
                                                            } else {
                                                                if ($other_holidays_in_leave_value->end_date >= $employee_leaves_value->leaves_start_date && $other_holidays_in_leave_value->end_date <= $employee_leaves_value->leaves_end_date) {
                                                                    //echo "(other start date not exists but end date exists in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_start_date));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->end_date));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($employee_leaves_value->leaves_start_date);
                                                                    $leaveOtherHolidayEndDate = new DateTime($other_holidays_in_leave_value->end_date);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                } else {
                                                                    if ($other_holidays_in_leave_value->start_date <= $employee_leaves_value->leaves_start_date && $other_holidays_in_leave_value->end_date >= $employee_leaves_value->leaves_end_date) {
                                                                        //echo "(whole leave dates are in other holidays)";

                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                        $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_start_date));
                                                                        $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_end_date));

                                                                        $holidays_counting_for_leave_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                            foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_for_leave_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_for_leave_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                        $leaveOtherHolidayStartDate = new DateTime($employee_leaves_value->leaves_start_date);
                                                                        $leaveOtherHolidayEndDate = new DateTime($employee_leaves_value->leaves_end_date);

                                                                        $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                        $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                    } else {
                                                                        $all_leave_other_holidays_in_leave = 0;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        //////other holiday exists or not condition ends
                                                        $all_leave_other_holidays_in_leave = 0;
                                                    }

                                                    ###################################### other holidays counting from leave start date to end date code ends here ######################################

                                                    $leaveStartDate = new DateTime($employee_leaves_value->leaves_start_date);
                                                    $leaveEndDate = new DateTime($employee_leaves_value->leaves_end_date);

                                                    $difference_between_two_leave_dates = $leaveEndDate->diff($leaveStartDate);
                                                    $all_leaves_by_employee_without_holiday += $difference_between_two_leave_dates->format('%a') + 1 - $holidays_in_leave - $all_leave_other_holidays_in_leave;
                                                } else {
                                                    //echo "(end date not but start date exists in last month)";

                                                    ###################################### holidays counting from leave start date to end date code starts ######################################
                                                    $company_holidays_names_in_leave = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();

                                                    $leaves_start_date = date('d', strtotime($employee_leaves_value->leaves_start_date));
                                                    $leaves_end_date = date('d', strtotime($last_date_of_the_last_month));

                                                    $holidays_in_leave = 0;
                                                    for ($i = $leaves_start_date; $i <= $leaves_end_date; $i++) {
                                                        foreach ($company_holidays_names_in_leave as $company_holidays_names_in_leave_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $company_holidays_names_in_leave_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $holidays_in_leave++;
                                                            }
                                                        };
                                                    }
                                                    ###################################### holidays counting from leave start date to end date code ends here ######################################
                                                    ###################################### other holidays counting from leave start date to end date code ends here ######################################
                                                    if (
                                                        Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->exists()
                                                    ) {
                                                        $other_holidays_in_leave = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->get();

                                                        foreach ($other_holidays_in_leave as $other_holidays_in_leave_value) {
                                                            if ($other_holidays_in_leave_value->start_date >= $employee_leaves_value->leaves_start_date && $other_holidays_in_leave_value->start_date <= $last_date_of_the_last_month) {
                                                                if ($other_holidays_in_leave_value->end_date >= $employee_leaves_value->leaves_start_date && $other_holidays_in_leave_value->end_date <= $last_date_of_the_last_month) {
                                                                    //echo "(other start date and end date exists in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->end_date));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($other_holidays_in_leave_value->start_date);
                                                                    $leaveOtherHolidayEndDate = new DateTime($other_holidays_in_leave_value->end_date);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                } else {
                                                                    //echo "(other start date exists but end date not in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($last_date_of_the_last_month));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($other_holidays_in_leave_value->start_date);
                                                                    $leaveOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                }
                                                            } else {
                                                                if ($other_holidays_in_leave_value->end_date >= $employee_leaves_value->leaves_start_date && $other_holidays_in_leave_value->end_date <= $last_date_of_the_last_month) {
                                                                    //echo "(other start date not exists but end date exists in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_start_date));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->end_date));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($employee_leaves_value->leaves_start_date);
                                                                    $leaveOtherHolidayEndDate = new DateTime($other_holidays_in_leave_value->end_date);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                } else {
                                                                    if ($other_holidays_in_leave_value->start_date <= $employee_leaves_value->leaves_start_date && $other_holidays_in_leave_value->end_date >= $last_date_of_the_last_month) {
                                                                        //echo "(whole leave dates are in other holidays)";

                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                        $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_start_date));
                                                                        $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($last_date_of_the_last_month));

                                                                        $holidays_counting_for_leave_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                            foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_for_leave_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_for_leave_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                        $leaveOtherHolidayStartDate = new DateTime($employee_leaves_value->leaves_start_date);
                                                                        $leaveOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                        $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                        $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                    } else {
                                                                        $all_leave_other_holidays_in_leave = 0;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        $all_leave_other_holidays_in_leave = 0;
                                                    }

                                                    ###################################### other holidays counting from leave start date to end date code ends here ######################################

                                                    $leaveStartDate = new DateTime($employee_leaves_value->leaves_start_date);
                                                    $leaveEndDate = new DateTime($last_date_of_the_last_month);

                                                    $difference_between_two_leave_dates = $leaveEndDate->diff($leaveStartDate);
                                                    $all_leaves_by_employee_without_holiday += $difference_between_two_leave_dates->format('%a') + 1 - $holidays_in_leave - $all_leave_other_holidays_in_leave;
                                                }
                                            } else {
                                                if ($employee_leaves_value->leaves_end_date >= $first_date_of_last_month && $employee_leaves_value->leaves_end_date <= $last_date_of_the_last_month) {
                                                    //echo "(start date not but end date exists in last month)";
                                                    ###################################### holidays counting from leave start date to end date code starts ######################################
                                                    $company_holidays_names_in_leave = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();

                                                    $leaves_start_date = date('d', strtotime($first_date_of_last_month));
                                                    $leaves_end_date = date('d', strtotime($employee_leaves_value->leaves_end_date));

                                                    $holidays_in_leave = 0;
                                                    for ($i = $leaves_start_date; $i <= $leaves_end_date; $i++) {
                                                        foreach ($company_holidays_names_in_leave as $company_holidays_names_in_leave_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $company_holidays_names_in_leave_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $holidays_in_leave++;
                                                            }
                                                        };
                                                    }
                                                    ###################################### holidays counting from leave start date to end date code ends here ######################################
                                                    ###################################### other holidays counting from leave start date to end date code ends here ######################################
                                                    if (
                                                        Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->exists()
                                                    ) {
                                                        //////other holiday exists or not condition starts

                                                        $other_holidays_in_leave = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->get();

                                                        foreach ($other_holidays_in_leave as $other_holidays_in_leave_value) {
                                                            if ($other_holidays_in_leave_value->start_date >= $first_date_of_last_month && $other_holidays_in_leave_value->start_date <= $employee_leaves_value->leaves_end_date) {
                                                                if ($other_holidays_in_leave_value->end_date >= $first_date_of_last_month && $other_holidays_in_leave_value->end_date <= $employee_leaves_value->leaves_end_date) {
                                                                    //echo "(other start date and end date exists in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->end_date));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($other_holidays_in_leave_value->start_date);
                                                                    $leaveOtherHolidayEndDate = new DateTime($other_holidays_in_leave_value->end_date);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                } else {
                                                                    //echo "(other start date exists but end date not in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_end_date));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($other_holidays_in_leave_value->start_date);
                                                                    $leaveOtherHolidayEndDate = new DateTime($employee_leaves_value->leaves_end_date);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                }
                                                            } else {
                                                                if ($other_holidays_in_leave_value->end_date >= $first_date_of_last_month && $other_holidays_in_leave_value->end_date <= $employee_leaves_value->leaves_end_date) {
                                                                    //echo "(other start date not exists but end date exists in leave dates)";

                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                    $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($first_date_of_last_month));
                                                                    $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->end_date));

                                                                    $holidays_counting_for_leave_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                        foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_for_leave_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_for_leave_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                    $leaveOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                                    $leaveOtherHolidayEndDate = new DateTime($other_holidays_in_leave_value->end_date);

                                                                    $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                    $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                } else {
                                                                    if ($other_holidays_in_leave_value->start_date <= $first_date_of_last_month && $other_holidays_in_leave_value->end_date >= $employee_leaves_value->leaves_end_date) {
                                                                        //echo "(whole leave dates are in other holidays)";

                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                        $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($first_date_of_last_month));
                                                                        $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_end_date));

                                                                        $holidays_counting_for_leave_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                            foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_for_leave_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_for_leave_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                        $leaveOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                                        $leaveOtherHolidayEndDate = new DateTime($employee_leaves_value->leaves_end_date);

                                                                        $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                        $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                    } else {
                                                                        $all_leave_other_holidays_in_leave = 0;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        //////other holiday exists or not condition ends
                                                        $all_leave_other_holidays_in_leave = 0;
                                                    }

                                                    ###################################### other holidays counting from leave start date to end date code ends here ######################################

                                                    $leaveStartDate = new DateTime($first_date_of_last_month);
                                                    $leaveEndDate = new DateTime($employee_leaves_value->leaves_end_date);

                                                    $difference_between_two_leave_dates = $leaveEndDate->diff($leaveStartDate);
                                                    $all_leaves_by_employee_without_holiday += $difference_between_two_leave_dates->format('%a') + 1 - $holidays_in_leave - $all_leave_other_holidays_in_leave;
                                                } else {
                                                    if ($employee_leaves_value->leaves_start_date <= $first_date_of_last_month && $employee_leaves_value->leaves_end_date >= $last_date_of_the_last_month) {
                                                        //echo "(whole last month is on Leaving for this employee)";
                                                        ###################################### holidays counting from leave start date to end date code starts ######################################
                                                        $company_holidays_names_in_leave = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                            ->get();

                                                        $leaves_start_date = date('d', strtotime($first_date_of_last_month));
                                                        $leaves_end_date = date('d', strtotime($last_date_of_the_last_month));

                                                        $holidays_in_leave = 0;
                                                        for ($i = $leaves_start_date; $i <= $leaves_end_date; $i++) {
                                                            foreach ($company_holidays_names_in_leave as $company_holidays_names_in_leave_value) {
                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $company_holidays_names_in_leave_value->holiday_number) {
                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                    $holidays_in_leave++;
                                                                }
                                                            };
                                                        }
                                                        ###################################### holidays counting from leave start date to end date code ends here ######################################
                                                        ###################################### other holidays counting from leave start date to end date code ends here ######################################
                                                        if (
                                                            Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                ->where('holiday_type', '=', 'Other-Holiday')
                                                                ->exists()
                                                        ) {
                                                            //////other holiday exists or not condition starts

                                                            $other_holidays_in_leave = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                ->where('holiday_type', '=', 'Other-Holiday')
                                                                ->get();

                                                            foreach ($other_holidays_in_leave as $other_holidays_in_leave_value) {
                                                                if ($other_holidays_in_leave_value->start_date >= $first_date_of_last_month && $other_holidays_in_leave_value->start_date <= $last_date_of_the_last_month) {
                                                                    if ($other_holidays_in_leave_value->end_date >= $first_date_of_last_month && $other_holidays_in_leave_value->end_date <= $last_date_of_the_last_month) {
                                                                        //echo "(other start date and end date exists in leave dates)";

                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                        $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->start_date));
                                                                        $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->end_date));

                                                                        $holidays_counting_for_leave_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                            foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_for_leave_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_for_leave_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                        $leaveOtherHolidayStartDate = new DateTime($other_holidays_in_leave_value->start_date);
                                                                        $leaveOtherHolidayEndDate = new DateTime($other_holidays_in_leave_value->end_date);

                                                                        $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                        $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                    } else {
                                                                        //echo "(other start date exists but end date not in leave dates)";

                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                        $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->start_date));
                                                                        $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($last_date_of_the_last_month));

                                                                        $holidays_counting_for_leave_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                            foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_for_leave_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_for_leave_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                        $leaveOtherHolidayStartDate = new DateTime($other_holidays_in_leave_value->start_date);
                                                                        $leaveOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                        $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                        $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                    }
                                                                } else {
                                                                    if ($other_holidays_in_leave_value->end_date >= $first_date_of_last_month && $other_holidays_in_leave_value->end_date <= $last_date_of_the_last_month) {
                                                                        //echo "(other start date not exists but end date exists in leave dates)";

                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                        $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($employee_leaves_value->leaves_start_date));
                                                                        $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($other_holidays_in_leave_value->end_date));

                                                                        $holidays_counting_for_leave_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                            foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_for_leave_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_for_leave_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                        $leaveOtherHolidayStartDate = new DateTime($employee_leaves_value->leaves_start_date);
                                                                        $leaveOtherHolidayEndDate = new DateTime($other_holidays_in_leave_value->end_date);

                                                                        $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                        $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                    } else {
                                                                        if ($other_holidays_in_leave_value->start_date <= $first_date_of_last_month && $other_holidays_in_leave_value->end_date >= $last_date_of_the_last_month) {
                                                                            //echo "(whole leave dates are in other holidays)";

                                                                            ###################################### other holiday wise holidays counting for leaving from start date to end date code starts ######################################
                                                                            $finding_holidays_names_for_leave_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                                ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                                ->get();

                                                                            $start_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($first_date_of_last_month));
                                                                            $end_date_for_holiday_in_other_holiday_as_leave_request = date('d', strtotime($last_date_of_the_last_month));

                                                                            $holidays_counting_for_leave_in_other_holiday = 0;
                                                                            for ($i = $start_date_for_holiday_in_other_holiday_as_leave_request; $i <= $end_date_for_holiday_in_other_holiday_as_leave_request; $i++) {
                                                                                foreach ($finding_holidays_names_for_leave_in_other_holiday as $finding_holidays_names_for_leave_in_other_holiday_value) {
                                                                                    if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_for_leave_in_other_holiday_value->holiday_number) {
                                                                                        //if monday means 1, tue means 2.... sunday means 7
                                                                                        $holidays_counting_for_leave_in_other_holiday++;
                                                                                    }
                                                                                };
                                                                            }
                                                                            //echo $holidays_counting_for_leave_in_other_holiday;
                                                                            ###################################### other holiday wise holidays counting for leaving from start date to end date code ends here ######################################

                                                                            $leaveOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                                            $leaveOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                            $leaveOtherHolidayDifference = $leaveOtherHolidayEndDate->diff($leaveOtherHolidayStartDate);
                                                                            $all_leave_other_holidays_in_leave = $leaveOtherHolidayDifference->format('%a') + 1 - $holidays_counting_for_leave_in_other_holiday;
                                                                        } else {
                                                                            $all_leave_other_holidays_in_leave = 0;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            //////other holiday exists or not condition ends
                                                            $all_leave_other_holidays_in_leave = 0;
                                                        }

                                                        ###################################### other holidays counting from leave start date to end date code ends here ######################################

                                                        $leaveStartDate = new DateTime($first_date_of_last_month);
                                                        $leaveEndDate = new DateTime($last_date_of_the_last_month);

                                                        $difference_between_two_leave_dates = $leaveEndDate->diff($leaveStartDate);
                                                        $all_leaves_by_employee_without_holiday += $difference_between_two_leave_dates->format('%a') + 1 - $holidays_in_leave - $all_leave_other_holidays_in_leave;
                                                    } else {
                                                        //echo "(start date and end date not exists in last month)";
                                                        $all_leaves_by_employee_without_holiday += 0;
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        /////leave days exists or not condition ends/////////////////
                                        $all_leaves_by_employee_without_holiday = 0;
                                    }
                                    ################################################################################################################################
                                    ####################################### Approved Leaving Days counting  code ends###############################################
                                    ################################################################################################################################

                                    ########################################## Late Days Counting Code Starts From Here #######################################################################
                                    $countable_late_days = 0;
                                    if (
                                        LateTime::where('late_time_employee_id', '=', $attendancesValue->monthly_employee_id)
                                            ->whereMonth('late_time_date', '=', $last_month)
                                            ->whereYear('late_time_date', '=', $previous_month_year)
                                            ->exists()
                                    ) {
                                        $minimum_countable_late_config_days = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_day']); //minimum countable days
                                        $total_days_from_late_count_array = LateTime::where('late_time_employee_id', '=', $attendancesValue->monthly_employee_id)
                                            ->whereMonth('late_time_date', '=', $last_month)
                                            ->whereYear('late_time_date', '=', $previous_month_year)
                                            ->count(); //total late days
                                        for ($a = 1; $a <= $total_days_from_late_count_array; $a++) {
                                            if ($a % $minimum_countable_late_config_days->minimum_countable_day == 0) {
                                                $countable_late_days += 1;
                                            }
                                        }
                                    }
                                    //echo $countable_late_days;
                                    ########################################## Late Days Counting Code Ends Here ##############################################################################

                                    ############################## Travelling Days counting code starts#####################################
                                    if (
                                        Travel::where('travel_com_id', Auth::user()->com_id)
                                            ->where('travel_employee_id', '=', $attendancesValue->monthly_employee_id)
                                            ->where('travel_status', '=', 'Approved')
                                            //->where('travel_start_date','>=','Approved')
                                            // ->where(function($query) use ($last_month){
                                            //     $query->whereMonth('travel_start_date',$last_month)
                                            //                 ->orWhereMonth('travel_end_date',$last_month);
                                            // })
                                            // ->whereYear('travel_start_date', '=',$previous_month_year)
                                            ->exists()
                                    ) {
                                        /////travel days exists or not condition starts/////////////////

                                        $travelling_days = Travel::where('travel_com_id', Auth::user()->com_id)
                                            ->where('travel_employee_id', '=', $attendancesValue->monthly_employee_id)
                                            ->where('travel_status', '=', 'Approved')
                                            ->get();
                                        $all_travel_days = 0;

                                        foreach ($travelling_days as $travelling_days_value) {
                                            if ($travelling_days_value->travel_start_date >= $first_date_of_last_month && $travelling_days_value->travel_start_date <= $last_date_of_the_last_month) {
                                                if ($travelling_days_value->travel_end_date >= $first_date_of_last_month && $travelling_days_value->travel_end_date <= $last_date_of_the_last_month) {
                                                    //echo "(start date and end date exists in last month)";

                                                    ###################################### holidays counting from travel start date to end date code starts ######################################
                                                    $company_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();

                                                    $travel_start_date = date('d', strtotime($travelling_days_value->travel_start_date));
                                                    $travel_end_date = date('d', strtotime($travelling_days_value->travel_end_date));

                                                    $holidays_in_travel = 0;
                                                    for ($i = $travel_start_date; $i <= $travel_end_date; $i++) {
                                                        foreach ($company_holidays_names as $company_holidays_names_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $company_holidays_names_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $holidays_in_travel++;
                                                            }
                                                        };
                                                    }

                                                    ###################################### holidays counting from travel start date to end date code ends here ######################################
                                                    ###################################### other holidays counting from travel start date to end date code ends here ######################################
                                                    if (
                                                        Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->exists()
                                                    ) {
                                                        //////other holiday exists or not condition starts

                                                        $other_holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->get();

                                                        foreach ($other_holidays as $other_holidays_value) {
                                                            if ($other_holidays_value->start_date >= $travelling_days_value->travel_start_date && $other_holidays_value->start_date <= $travelling_days_value->travel_end_date) {
                                                                if ($other_holidays_value->end_date >= $travelling_days_value->travel_start_date && $other_holidays_value->end_date <= $travelling_days_value->travel_end_date) {
                                                                    //echo "(other start date and end date exists in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->end_date));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                } else {
                                                                    //echo "(other start date exists but end date not in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_end_date));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                }
                                                            } else {
                                                                if ($other_holidays_value->end_date >= $travelling_days_value->travel_start_date && $other_holidays_value->end_date <= $travelling_days_value->travel_end_date) {
                                                                    //echo "(other start date not exists but end date exists in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_start_date));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->end_date));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                } else {
                                                                    if ($other_holidays_value->start_date <= $travelling_days_value->travel_start_date && $other_holidays_value->end_date >= $travelling_days_value->travel_end_date) {
                                                                        //echo "(whole travel dates are in other holidays)";

                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                        $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_start_date));
                                                                        $end_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_end_date));

                                                                        $holidays_counting_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                            foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                        $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                                        $travelOtherHolidayEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                                        $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                        $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                    } else {
                                                                        $all_travel_other_holidays = 0;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        //////other holiday exists or not condition ends
                                                        $all_travel_other_holidays = 0;
                                                    }

                                                    ###################################### other holidays counting from travel start date to end date code ends here ######################################

                                                    $travelStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                    $travelEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                    $difference_between_two_travel_dates = $travelEndDate->diff($travelStartDate);
                                                    $all_travel_days += $difference_between_two_travel_dates->format('%a') + 1 - $holidays_in_travel - $all_travel_other_holidays;
                                                } else {
                                                    //echo "(end date not but start date exists in last month)";

                                                    ###################################### holidays counting from travel start date to end date code starts ######################################
                                                    $company_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();

                                                    $travel_start_date = date('d', strtotime($travelling_days_value->travel_start_date));
                                                    $travel_end_date = date('d', strtotime($last_date_of_the_last_month));

                                                    $holidays_in_travel = 0;
                                                    for ($i = $travel_start_date; $i <= $travel_end_date; $i++) {
                                                        foreach ($company_holidays_names as $company_holidays_names_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $company_holidays_names_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $holidays_in_travel++;
                                                            }
                                                        };
                                                    }
                                                    ###################################### holidays counting from travel start date to end date code ends here ######################################
                                                    ###################################### other holidays counting from travel start date to end date code ends here ######################################
                                                    if (
                                                        Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->exists()
                                                    ) {
                                                        $other_holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->get();

                                                        foreach ($other_holidays as $other_holidays_value) {
                                                            if ($other_holidays_value->start_date >= $travelling_days_value->travel_start_date && $other_holidays_value->start_date <= $last_date_of_the_last_month) {
                                                                if ($other_holidays_value->end_date >= $travelling_days_value->travel_start_date && $other_holidays_value->end_date <= $last_date_of_the_last_month) {
                                                                    //echo "(other start date and end date exists in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->end_date));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                } else {
                                                                    //echo "(other start date exists but end date not in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($last_date_of_the_last_month));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                }
                                                            } else {
                                                                if ($other_holidays_value->end_date >= $travelling_days_value->travel_start_date && $other_holidays_value->end_date <= $last_date_of_the_last_month) {
                                                                    //echo "(other start date not exists but end date exists in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_start_date));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->end_date));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                } else {
                                                                    if ($other_holidays_value->start_date <= $travelling_days_value->travel_start_date && $other_holidays_value->end_date >= $last_date_of_the_last_month) {
                                                                        //echo "(whole travel dates are in other holidays)";

                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                        $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_start_date));
                                                                        $end_date_for_holiday_in_other_holiday = date('d', strtotime($last_date_of_the_last_month));

                                                                        $holidays_counting_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                            foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                        $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                                        $travelOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                        $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                        $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                    } else {
                                                                        $all_travel_other_holidays = 0;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        $all_travel_other_holidays = 0;
                                                    }

                                                    ###################################### other holidays counting from travel start date to end date code ends here ######################################

                                                    $travelStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                    $travelEndDate = new DateTime($last_date_of_the_last_month);

                                                    $difference_between_two_travel_dates = $travelEndDate->diff($travelStartDate);
                                                    $all_travel_days += $difference_between_two_travel_dates->format('%a') + 1 - $holidays_in_travel - $all_travel_other_holidays;
                                                }
                                            } else {
                                                if ($travelling_days_value->travel_end_date >= $first_date_of_last_month && $travelling_days_value->travel_end_date <= $last_date_of_the_last_month) {
                                                    //echo "(start date not but end date exists in last month)";
                                                    ###################################### holidays counting from travel start date to end date code starts ######################################
                                                    $company_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();

                                                    $travel_start_date = date('d', strtotime($first_date_of_last_month));
                                                    $travel_end_date = date('d', strtotime($travelling_days_value->travel_end_date));

                                                    $holidays_in_travel = 0;
                                                    for ($i = $travel_start_date; $i <= $travel_end_date; $i++) {
                                                        foreach ($company_holidays_names as $company_holidays_names_value) {
                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $company_holidays_names_value->holiday_number) {
                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                $holidays_in_travel++;
                                                            }
                                                        };
                                                    }
                                                    ###################################### holidays counting from travel start date to end date code ends here ######################################
                                                    ###################################### other holidays counting from travel start date to end date code ends here ######################################
                                                    if (
                                                        Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->exists()
                                                    ) {
                                                        //////other holiday exists or not condition starts

                                                        $other_holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Other-Holiday')
                                                            ->get();

                                                        foreach ($other_holidays as $other_holidays_value) {
                                                            if ($other_holidays_value->start_date >= $first_date_of_last_month && $other_holidays_value->start_date <= $travelling_days_value->travel_end_date) {
                                                                if ($other_holidays_value->end_date >= $first_date_of_last_month && $other_holidays_value->end_date <= $travelling_days_value->travel_end_date) {
                                                                    //echo "(other start date and end date exists in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->end_date));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                } else {
                                                                    //echo "(other start date exists but end date not in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->start_date));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_end_date));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                    $travelOtherHolidayEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                }
                                                            } else {
                                                                if ($other_holidays_value->end_date >= $first_date_of_last_month && $other_holidays_value->end_date <= $travelling_days_value->travel_end_date) {
                                                                    //echo "(other start date not exists but end date exists in travel dates)";

                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                    $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                        ->get();

                                                                    $start_date_for_holiday_in_other_holiday = date('d', strtotime($first_date_of_last_month));
                                                                    $end_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->end_date));

                                                                    $holidays_counting_in_other_holiday = 0;
                                                                    for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                        foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                            if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                //if monday means 1, tue means 2.... sunday means 7
                                                                                $holidays_counting_in_other_holiday++;
                                                                            }
                                                                        };
                                                                    }
                                                                    //echo $holidays_counting_in_other_holiday;
                                                                    ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                    $travelOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                                    $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                    $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                    $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                } else {
                                                                    if ($other_holidays_value->start_date <= $first_date_of_last_month && $other_holidays_value->end_date >= $travelling_days_value->travel_end_date) {
                                                                        //echo "(whole travel dates are in other holidays)";

                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                        $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday = date('d', strtotime($first_date_of_last_month));
                                                                        $end_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_end_date));

                                                                        $holidays_counting_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                            foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                        $travelOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                                        $travelOtherHolidayEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                                        $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                        $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                    } else {
                                                                        $all_travel_other_holidays = 0;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        //////other holiday exists or not condition ends
                                                        $all_travel_other_holidays = 0;
                                                    }

                                                    ###################################### other holidays counting from travel start date to end date code ends here ######################################

                                                    $travelStartDate = new DateTime($first_date_of_last_month);
                                                    $travelEndDate = new DateTime($travelling_days_value->travel_end_date);

                                                    $difference_between_two_travel_dates = $travelEndDate->diff($travelStartDate);
                                                    $all_travel_days += $difference_between_two_travel_dates->format('%a') + 1 - $holidays_in_travel - $all_travel_other_holidays;
                                                } else {
                                                    if ($travelling_days_value->travel_start_date <= $first_date_of_last_month && $travelling_days_value->travel_end_date >= $last_date_of_the_last_month) {
                                                        //echo "(whole last month is on travelling for this employee)";
                                                        ###################################### holidays counting from travel start date to end date code starts ######################################
                                                        $company_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                            ->get();

                                                        $travel_start_date = date('d', strtotime($first_date_of_last_month));
                                                        $travel_end_date = date('d', strtotime($last_date_of_the_last_month));

                                                        $holidays_in_travel = 0;
                                                        for ($i = $travel_start_date; $i <= $travel_end_date; $i++) {
                                                            foreach ($company_holidays_names as $company_holidays_names_value) {
                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $company_holidays_names_value->holiday_number) {
                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                    $holidays_in_travel++;
                                                                }
                                                            };
                                                        }
                                                        ###################################### holidays counting from travel start date to end date code ends here ######################################
                                                        ###################################### other holidays counting from travel start date to end date code ends here ######################################
                                                        if (
                                                            Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                ->where('holiday_type', '=', 'Other-Holiday')
                                                                ->exists()
                                                        ) {
                                                            //////other holiday exists or not condition starts

                                                            $other_holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                ->where('holiday_type', '=', 'Other-Holiday')
                                                                ->get();

                                                            foreach ($other_holidays as $other_holidays_value) {
                                                                if ($other_holidays_value->start_date >= $first_date_of_last_month && $other_holidays_value->start_date <= $last_date_of_the_last_month) {
                                                                    if ($other_holidays_value->end_date >= $first_date_of_last_month && $other_holidays_value->end_date <= $last_date_of_the_last_month) {
                                                                        //echo "(other start date and end date exists in travel dates)";

                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                        $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->start_date));
                                                                        $end_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->end_date));

                                                                        $holidays_counting_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                            foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                        $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                        $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                        $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                        $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                    } else {
                                                                        //echo "(other start date exists but end date not in travel dates)";

                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                        $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->start_date));
                                                                        $end_date_for_holiday_in_other_holiday = date('d', strtotime($last_date_of_the_last_month));

                                                                        $holidays_counting_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                            foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                        $travelOtherHolidayStartDate = new DateTime($other_holidays_value->start_date);
                                                                        $travelOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                        $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                        $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                    }
                                                                } else {
                                                                    if ($other_holidays_value->end_date >= $first_date_of_last_month && $other_holidays_value->end_date <= $last_date_of_the_last_month) {
                                                                        //echo "(other start date not exists but end date exists in travel dates)";

                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                        $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                            ->get();

                                                                        $start_date_for_holiday_in_other_holiday = date('d', strtotime($travelling_days_value->travel_start_date));
                                                                        $end_date_for_holiday_in_other_holiday = date('d', strtotime($other_holidays_value->end_date));

                                                                        $holidays_counting_in_other_holiday = 0;
                                                                        for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                            foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                                    $holidays_counting_in_other_holiday++;
                                                                                }
                                                                            };
                                                                        }
                                                                        //echo $holidays_counting_in_other_holiday;
                                                                        ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                        $travelOtherHolidayStartDate = new DateTime($travelling_days_value->travel_start_date);
                                                                        $travelOtherHolidayEndDate = new DateTime($other_holidays_value->end_date);

                                                                        $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                        $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                    } else {
                                                                        if ($other_holidays_value->start_date <= $first_date_of_last_month && $other_holidays_value->end_date >= $last_date_of_the_last_month) {
                                                                            //echo "(whole travel dates are in other holidays)";

                                                                            ###################################### other holiday wise holidays counting for traveling from start date to end date code starts ######################################
                                                                            $finding_holidays_names_in_other_holiday = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                                ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                                ->get();

                                                                            $start_date_for_holiday_in_other_holiday = date('d', strtotime($first_date_of_last_month));
                                                                            $end_date_for_holiday_in_other_holiday = date('d', strtotime($last_date_of_the_last_month));

                                                                            $holidays_counting_in_other_holiday = 0;
                                                                            for ($i = $start_date_for_holiday_in_other_holiday; $i <= $end_date_for_holiday_in_other_holiday; $i++) {
                                                                                foreach ($finding_holidays_names_in_other_holiday as $finding_holidays_names_in_other_holiday_value) {
                                                                                    if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $finding_holidays_names_in_other_holiday_value->holiday_number) {
                                                                                        //if monday means 1, tue means 2.... sunday means 7
                                                                                        $holidays_counting_in_other_holiday++;
                                                                                    }
                                                                                };
                                                                            }
                                                                            //echo $holidays_counting_in_other_holiday;
                                                                            ###################################### other holiday wise holidays counting for traveling from start date to end date code ends here ######################################

                                                                            $travelOtherHolidayStartDate = new DateTime($first_date_of_last_month);
                                                                            $travelOtherHolidayEndDate = new DateTime($last_date_of_the_last_month);

                                                                            $travelOtherHolidayDifference = $travelOtherHolidayEndDate->diff($travelOtherHolidayStartDate);
                                                                            $all_travel_other_holidays = $travelOtherHolidayDifference->format('%a') + 1 - $holidays_counting_in_other_holiday;
                                                                        } else {
                                                                            $all_travel_other_holidays = 0;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            //////other holiday exists or not condition ends
                                                            $all_travel_other_holidays = 0;
                                                        }

                                                        ###################################### other holidays counting from travel start date to end date code ends here ######################################

                                                        $travelStartDate = new DateTime($first_date_of_last_month);
                                                        $travelEndDate = new DateTime($last_date_of_the_last_month);

                                                        $difference_between_two_travel_dates = $travelEndDate->diff($travelStartDate);
                                                        $all_travel_days += $difference_between_two_travel_dates->format('%a') + 1 - $holidays_in_travel - $all_travel_other_holidays;
                                                    } else {
                                                        //echo "(start date and end date not exists in last month)";
                                                        $all_travel_days += 0;
                                                    }
                                                }
                                            }
                                        }
                                    } else {
                                        /////travel days exists or not condition ends/////////////////
                                        $all_travel_days = 0;
                                    }

                                    #######################################Travelling Days counting  code ends###############################################

                                    ############################################### compensatory leave count code starts################################
                                    $compensatory_leave_counts = CompensatoryLeave::where('compen_leave_employee_id', '=', $attendancesValue->monthly_employee_id)
                                        ->whereMonth('compen_leave_duty_date', '=', $last_month)
                                        ->whereYear('compen_leave_duty_date', '=', $previous_month_year)
                                        ->get();
                                    $compensatory_leave_of_the_month = $compensatory_leave_counts->count();
                                    ############################################## compensatory leave count code ends here ######################################

                                    ####################################################################################################################################
                                    ############################################### days counting upto joining date code starts#########################################
                                    ####################################################################################################################################
                                    $first_date_of_last_month_for_joining_counting = $previous_month_year . '-' . $last_month . '-' . '01';
                                    $last_date_of_the_last_month_for_joining_counting = $previous_month_year . '-' . $last_month . '-' . $total_number_of_days_of_the_month;

                                    $monthStartDate = new DateTime($first_date_of_last_month_for_joining_counting);
                                    $monthEndDate = new DateTime($last_date_of_the_last_month_for_joining_counting);
                                    $firstWorkingDate = new DateTime($attendancesValue->joining_date);

                                    if ($firstWorkingDate >= $monthStartDate && $firstWorkingDate <= $monthEndDate) {
                                        //echo "in the month";

                                        $timestamp = strtotime($attendancesValue->joining_date);
                                        $only_joining_date_wise_day_number = date('d', $timestamp);

                                        $holidays_names_joining_date_wise = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                            ->get();

                                        $total_days_joining_date_wise = cal_days_in_month(CAL_GREGORIAN, $last_month, $previous_month_year);

                                        $holidays_joining_date_wise = 0;
                                        for ($i = $only_joining_date_wise_day_number; $i <= $total_days_joining_date_wise; $i++) {
                                            foreach ($holidays_names_joining_date_wise as $holidays_names_joining_date_wise_value) {
                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $holidays_names_joining_date_wise_value->holiday_number) {
                                                    //if monday means 1, tue means 2.... sunday means 7
                                                    $holidays_joining_date_wise++;
                                                }
                                            }
                                        }

                                        // function to find joining date wise total number of holidays code ends///////////////

                                        ############################## joining date wise other-holiday count code starts ##########################################################
                                        if (
                                            Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                ->where('holiday_type', '=', 'Other-Holiday')
                                                ->exists()
                                        ) {
                                            $other_holidays_joining_date_wise = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                ->where('holiday_type', '=', 'Other-Holiday')
                                                //->whereBetween('start_date', [$attendancesValue->joining_date, $last_date_of_the_last_month_for_joining_counting])
                                                ->get();

                                            $all_other_holidays_joining_date_wise_without_weekly_holiday = 0;
                                            foreach ($other_holidays_joining_date_wise as $other_holidays_joining_date_wise_value) {
                                                if ($other_holidays_joining_date_wise_value->start_date >= $attendancesValue->joining_date && $other_holidays_joining_date_wise_value->start_date <= $last_date_of_the_last_month_for_joining_counting) {
                                                    if ($other_holidays_joining_date_wise_value->end_date >= $attendancesValue->joining_date && $other_holidays_joining_date_wise_value->end_date <= $last_date_of_the_last_month_for_joining_counting) {
                                                        //echo "(other start date and end date exists in dates)";

                                                        ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                        $holidays_names_joining_date_wise = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                            ->get();

                                                        $start_date_joining_date_wise = date('d', strtotime($other_holidays_joining_date_wise_value->start_date));
                                                        $end_date_joining_date_wise = date('d', strtotime($other_holidays_joining_date_wise_value->end_date));

                                                        $joining_date_wise_holidays = 0;
                                                        for ($i = $start_date_joining_date_wise; $i <= $end_date_joining_date_wise; $i++) {
                                                            foreach ($holidays_names_joining_date_wise as $holidays_names_joining_date_wise_value) {
                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $holidays_names_joining_date_wise_value->holiday_number) {
                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                    $joining_date_wise_holidays++;
                                                                }
                                                            };
                                                        }
                                                        //echo $joining_date_wise_holidays;
                                                        ###################################### joining date wise holidays counting from start date to end date code ends here ######################################

                                                        $joiningDateWiseOtherHolidayStartDate = new DateTime($other_holidays_joining_date_wise_value->start_date);
                                                        $joiningDateWiseOtherHolidayEndDate = new DateTime($other_holidays_joining_date_wise_value->end_date);

                                                        $joiningDateWiseOtherHolidayDifference = $joiningDateWiseOtherHolidayEndDate->diff($joiningDateWiseOtherHolidayStartDate);
                                                        $all_other_holidays_joining_date_wise_without_weekly_holiday += $joiningDateWiseOtherHolidayDifference->format('%a') + 1 - $joining_date_wise_holidays;
                                                    } else {
                                                        //echo "(other start date exists but end date not in dates)";

                                                        ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                        $holidays_names_joining_date_wise = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                            ->get();

                                                        $start_date_joining_date_wise = date('d', strtotime($other_holidays_joining_date_wise_value->start_date));
                                                        $end_date_joining_date_wise = date('d', strtotime($last_date_of_the_last_month_for_joining_counting));

                                                        $joining_date_wise_holidays = 0;
                                                        for ($i = $start_date_joining_date_wise; $i <= $end_date_joining_date_wise; $i++) {
                                                            foreach ($holidays_names_joining_date_wise as $holidays_names_joining_date_wise_value) {
                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $holidays_names_joining_date_wise_value->holiday_number) {
                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                    $joining_date_wise_holidays++;
                                                                }
                                                            };
                                                        }
                                                        //echo $joining_date_wise_holidays;
                                                        ###################################### joining date wise holidays counting from start date to end date code ends here ######################################

                                                        $joiningDateWiseOtherHolidayStartDate = new DateTime($other_holidays_joining_date_wise_value->start_date);
                                                        $joiningDateWiseOtherHolidayEndDate = new DateTime($last_date_of_the_last_month_for_joining_counting);

                                                        $joiningDateWiseOtherHolidayDifference = $joiningDateWiseOtherHolidayEndDate->diff($joiningDateWiseOtherHolidayStartDate);
                                                        $all_other_holidays_joining_date_wise_without_weekly_holiday += $joiningDateWiseOtherHolidayDifference->format('%a') + 1 - $joining_date_wise_holidays;
                                                    }
                                                } else {
                                                    if ($other_holidays_joining_date_wise_value->end_date >= $attendancesValue->joining_date && $other_holidays_joining_date_wise_value->end_date <= $last_date_of_the_last_month_for_joining_counting) {
                                                        //echo "(other start date not exists but end date exists in dates)";

                                                        ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                        $holidays_names_joining_date_wise = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                            ->get();

                                                        $start_date_joining_date_wise = date('d', strtotime($$attendancesValue->joining_date));
                                                        $end_date_joining_date_wise = date('d', strtotime($other_holidays_joining_date_wise_value->end_date));

                                                        $joining_date_wise_holidays = 0;
                                                        for ($i = $start_date_joining_date_wise; $i <= $end_date_joining_date_wise; $i++) {
                                                            foreach ($holidays_names_joining_date_wise as $holidays_names_joining_date_wise_value) {
                                                                if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $holidays_names_joining_date_wise_value->holiday_number) {
                                                                    //if monday means 1, tue means 2.... sunday means 7
                                                                    $joining_date_wise_holidays++;
                                                                }
                                                            };
                                                        }
                                                        //echo $joining_date_wise_holidays;
                                                        ###################################### joining date wise holidays counting from start date to end date code ends here ######################################

                                                        $joiningDateWiseOtherHolidayStartDate = new DateTime($attendancesValue->joining_date);
                                                        $joiningDateWiseOtherHolidayEndDate = new DateTime($other_holidays_joining_date_wise_value->end_date);

                                                        $joiningDateWiseOtherHolidayDifference = $joiningDateWiseOtherHolidayEndDate->diff($joiningDateWiseOtherHolidayStartDate);
                                                        $all_other_holidays_joining_date_wise_without_weekly_holiday += $joiningDateWiseOtherHolidayDifference->format('%a') + 1 - $joining_date_wise_holidays;
                                                    } else {
                                                        if ($other_holidays_joining_date_wise_value->start_date <= $attendancesValue->joining_date && $other_holidays_joining_date_wise_value->end_date >= $last_date_of_the_last_month_for_joining_counting) {
                                                            //echo "(both dates are out of the joining date and end date of the month)";

                                                            ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                            $holidays_names_joining_date_wise = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                                ->where('holiday_type', '=', 'Weekly-Holiday')
                                                                ->get();

                                                            $start_date_joining_date_wise = date('d', strtotime($attendancesValue->joining_date));
                                                            $end_date_joining_date_wise = date('d', strtotime($last_date_of_the_last_month_for_joining_counting));

                                                            $joining_date_wise_holidays = 0;
                                                            for ($i = $start_date_joining_date_wise; $i <= $end_date_joining_date_wise; $i++) {
                                                                foreach ($holidays_names_joining_date_wise as $holidays_names_joining_date_wise_value) {
                                                                    if (date('N', strtotime($previous_month_year . '-' . $last_month . '-' . $i)) == $holidays_names_joining_date_wise_value->holiday_number) {
                                                                        //if monday means 1, tue means 2.... sunday means 7
                                                                        $joining_date_wise_holidays++;
                                                                    }
                                                                };
                                                            }
                                                            //echo $joining_date_wise_holidays;
                                                            ###################################### joining date wise holidays counting from start date to end date code ends here ######################################

                                                            $joiningDateWiseOtherHolidayStartDate = new DateTime($attendancesValue->joining_date);
                                                            $joiningDateWiseOtherHolidayEndDate = new DateTime($last_date_of_the_last_month_for_joining_counting);

                                                            $joiningDateWiseOtherHolidayDifference = $joiningDateWiseOtherHolidayEndDate->diff($joiningDateWiseOtherHolidayStartDate);
                                                            $all_other_holidays_joining_date_wise_without_weekly_holiday += $joiningDateWiseOtherHolidayDifference->format('%a') + 1 - $joining_date_wise_holidays;
                                                        } else {
                                                            $all_other_holidays_joining_date_wise_without_weekly_holiday += 0;
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            $all_other_holidays_joining_date_wise_without_weekly_holiday = 0;
                                        }
                                        ###################### joining date wise other-holiday count code ends ##################################

                                        $timestamp = strtotime($attendancesValue->joining_date);
                                        $only_joining_date_day_number = date('d', $timestamp);

                                        ############################################### Joining date wise attendance count code starts#########################################
                                        $attendance_counts_joining_date_wise = Attendance::where('employee_id', '=', $attendancesValue->monthly_employee_id)
                                            ->whereBetween('attendance_date', [$attendancesValue->joining_date, $last_date_of_the_last_month_for_joining_counting])
                                            ->where('check_in_out', '=', 1)
                                            ->get();
                                        $all_attendances_of_the_month_joining_date_wise = $attendance_counts_joining_date_wise->count();
                                        ############################################## Joining date wise attendance count code ends here #######################################

                                        $sub_total_working_days = $all_attendances_of_the_month + $holidays_joining_date_wise + $all_other_holidays_joining_date_wise_without_weekly_holiday + $all_leaves_by_employee_without_holiday + $all_half_leaves_by_employee_without_holiday + $all_travel_days - $number_of_attendances_on_half_leave - $countable_late_days - $compensatory_leave_of_the_month; //total working days
                                        //dd($sub_total_working_days);
                                    } else {
                                        //total_holiday($last_month, $previous_month_year)

                                        $sub_total_working_days = $all_attendances_of_the_month + $all_other_holidays_without_weekly_holiday + $all_leaves_by_employee_without_holiday + $all_half_leaves_by_employee_without_holiday + $all_travel_days - $number_of_attendances_on_half_leave - $countable_late_days - $compensatory_leave_of_the_month; //total working days
                                        $all_attendances_of_the_month;
                                    }

                                    ####################################################################################################################################
                                    ############################################## days counting upto joining date code ends here ######################################
                                    ####################################################################################################################################

                                    //exit;

                                    if ($sub_total_working_days > $total_number_of_days_of_the_month) {
                                        $total_working_days = $total_number_of_days_of_the_month;
                                    } elseif ($sub_total_working_days < 1) {
                                        $total_working_days = 0;
                                    } else {
                                        $total_working_days = $sub_total_working_days;
                                    }

                                    $total_working_days;

                                    ?>

                                    {{-- <td> {{helper::totalWorkedHours()}}</td> --}}
                                    {{-- <td> {{$total_working_days}}</td> --}}

                                    {{-- <td>{{$total_working_days ?? null}}</td> --}}
                                    <td>{{ $sum_total_hours ?? null }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>



        </div>
    </section>





    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });




            $('#user-table').DataTable({


                "aLengthMenu": [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                "iDisplayLength": 25,
                dom: '<"row"lfB>rtip',

                buttons: [{
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });






        });
    </script>
@endsection
