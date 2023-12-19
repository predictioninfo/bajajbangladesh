@extends('back-end.premium.layout.premium-main')
@section('content')
<?php
    use App\Models\BankAccount;

    use App\Models\HouseRentNonTaxableRangeYearly;
    use App\Models\MedicalAllowanceNonTaxableRangeYearly;
    use App\Models\ConveyanceAllowanceNonTaxableRangeYearly;
    use App\Models\YearlyFestivalBonusConfig;

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


        <div class="card mb-0">
            <div class="card-header with-border">
                <h1 class="card-title text-center"> {{ __('New Payments') }} </h1>
                <nav aria-label="breadcrumb">

                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>
                        <li><a href="#">List - New Payments </a></li>
                    </ol>

                </nav>
            </div>
        </div>

    </div>

    <?php

        use App\Models\Attendance;
        use App\Models\Holiday;
        use App\Models\Leave;
        use App\Models\Loan;
        use App\Models\FestivalBonus;
        use App\Models\FestivalPayment;
        use App\Models\Commission;
        use App\Models\StatutoryDeduction;
        use App\Models\OtherPayment;
        use App\Models\OverTime;
        use App\Models\LatetimeConfig;
        use App\Models\LateTime;
        use App\Models\Travel;
        use App\Models\CompensatoryLeave;
        use App\Models\IncrementSalaryHistory;
        use App\Models\User;
        use App\Models\Lunch;
        use Carbon\Carbon;
        // $last_month_date_year = date('Y-m-d', strtotime('last month'));
        // $last_month = date('m', strtotime('last month'));////////////the payment month
        // $date_wise_day_name = date('D', strtotime('last month'));
        // $previous_month_year = date('Y', strtotime('last month'));////////////the payment month's year

        $total_number_of_days_of_the_month = cal_days_in_month(CAL_GREGORIAN, $last_month, $previous_month_year);
        $first_date_of_last_month = $previous_month_year . '-' . $last_month . '-' . '01';
        $last_date_of_the_last_month = $previous_month_year . '-' . $last_month . '-' . $total_number_of_days_of_the_month;

        ////// function to find total number of holidays code starts////////////
        function total_holiday($month, $year)
        {
            $holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                ->where('holiday_type', '=', 'Weekly-Holiday')
                ->get();

            $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $holidays = 0;
            for ($i = 1; $i <= $total_days; $i++) {
                foreach ($holidays_names as $holidays_names_value) {
                    if (date('N', strtotime($year . '-' . $month . '-' . $i)) == $holidays_names_value->holiday_number) {
                        //if monday means 1, tue means 2.... sunday means 7
                        $holidays++;
                    }
                };
            }
            return $holidays;
        }
        //echo total_holiday(1,2016);
        // function to find total number of holidays code ends///////////////
        ////// other-holiday count code starts////////////
        //if(Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Other-Holiday')->whereMonth('start_date','=',$last_month)->whereYear('start_date', '=',$previous_month_year)->exists()) {
        if (
            Holiday::where('holiday_com_id', Auth::user()->com_id)
                ->where('holiday_type', '=', 'Other-Holiday')
                ->exists()
        ) {
            $other_holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                ->where('holiday_type', '=', 'Other-Holiday')
                ->get();

            //echo json_encode($other_holidays);

            $all_other_holidays_without_weekly_holiday = 0;
            foreach ($other_holidays as $other_holidays_value) {
                // $startDate = new DateTime($other_holidays_value->start_date);
                // $endDate = new DateTime($other_holidays_value->end_date);

                // $difference = $endDate->diff($startDate);
                // $all_other_holidays += $difference->format("%a") + 1;

                if ($other_holidays_value->start_date >= $first_date_of_last_month && $other_holidays_value->start_date <= $last_date_of_the_last_month) {
                    if ($other_holidays_value->end_date >= $first_date_of_last_month && $other_holidays_value->end_date <= $last_date_of_the_last_month) {
                        //echo "(other start date and end date exists in dates)";

                        // echo "ok";

                        ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                        $finding_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                            ->where('holiday_type', '=', 'Weekly-Holiday')
                            ->get();

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
                        echo '<br>';
                    } else {
                        //echo "(other start date exists but end date not in dates)";

                        ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                        $finding_holidays_names = Holiday::where('holiday_com_id', Auth::user()->com_id)
                            ->where('holiday_type', '=', 'Weekly-Holiday')
                            ->get();

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
                        } else {
                            $all_other_holidays_without_weekly_holiday += 0;
                        }
                    }
                }
            }
        } else {
            $all_other_holidays_without_weekly_holiday = 0;
        }
        ////// other-holiday count code ends////////////
        ?>
    <div class="content-box">
        <form method="post" action="{{ route('department-wise-employee-payments') }}" class="container-fluid">
            @csrf
            <div class="row align-items-end">

                <div class="col-md-4 form-group">

                    <label>{{ __('Department') }} *</label>
                    <select name="department_id" class="form-control" required>
                        <option>Choose a Department</option>
                        <option value="0">All Department</option>
                        @foreach ($departments as $department_values)
                        <option value="{{ $department_values->id }}">
                            {{ $department_values->department_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_date">{{ __('Month') }}</label>
                        <input class="form-control" name="month_year" type="month">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-grad"><i class="fa fa-search"></i>
                                {{ __('Search') }}
                            </button>
                        </div>
                    </div>
                </div>
        </form>
        <div class="col-md-12">
            <form method="post" action="{{route('with-out-payments-sheet-approval')}}">
                @csrf
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="start_date">{{__('Month')}}</label>
                            <input class="form-control" type="month" name="month_year" required>
                        </div>
                    </div>

                    <div class="col-md-4 form-group">
                        <label>{{ __('Employee') }} *</label>
                        <select name="emp_id" class="form-control" required>
                            <option>Select Employee</option>

                            @foreach ($users as $user_values)
                            <option value="{{ $user_values->company_bank_account_communication_emp_id }}">
                                {{ $user_values->bankAccountCommunication->first_name }} {{
                                $user_values->bankAccountCommunication->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 ">
                        <div class="form-group pt-4 mt-1">
                            <input type="submit" name="download_pdf" class="btn btn-grad"
                                value="{{__('Send For Approval')}}" />
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <form method="post" action="{{route('month-wise-salary-sheet-generate-with-out-payments')}}">
                @csrf
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="start_date">{{__('Month')}}</label>
                            <input class="form-control" type="month" name="month_year" required>
                        </div>
                    </div>

                    <div class="col-md-3 ">
                        <div class="form-group pt-4 mt-1">
                            <input type="submit" name="download_pdf" class="btn btn-grad"
                                value="{{__('Download PDF')}}" />
                            {{-- <input type="submit" name="download_excel" class="btn btn-grad"
                                value="{{__('Download Excel')}}" /> --}}
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <div class="table-responsive mt-4">
        <table id="user-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>{{ __('SL') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Total joinig Duration') }}</th>
                    <th>{{ __('Payslip Type') }}</th>
                    <th>{{ __('Basic Salary') }}</th>
                    <th>{{ __('House Rent') }}</th>
                    <th>{{ __('Medical') }}</th>
                    <th>{{ __('Conveyance') }}</th>
                    <th>{{ __('Per Hour Rate') }}</th>
                    <th>{{ __('Total Working Hour') }}</th>
                    <th>{{ __('Bonus') }}</th>
                    <th>{{ __('Tax Deduction') }}</th>
                    <th>{{ __('Provident Fund') }}</th>
                    <th>{{ __('Loan') }}</th>
                    <th>{{ __('Total Late Days') }}</th>
                    <th>{{ __('Late Time Salary Deduction') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($new_payments as $new_payments_value)
                @if ($new_payments_value->monthly_payment_status == 0)
                <?php
                ############################################### attendance count code starts################################
                                $attendance_counts = Attendance::where('employee_id', '=', $new_payments_value->monthly_employee_id)
                                    ->whereMonth('attendance_date', '=', $last_month)
                                    ->whereYear('attendance_date', '=', $previous_month_year)
                                    ->where('check_in_out', '=', 1)
                                    ->get();
                                $all_attendances_of_the_month = $attendance_counts->count();
                                ############################################## attendance count code ends here ######################################
                                ############################################### attendance work hours count code starts################################
                                $attendance_work_hours_counts = Attendance::where('employee_id', '=', $new_payments_value->monthly_employee_id)
                                    ->whereMonth('attendance_date', '=', $last_month)
                                    ->whereYear('attendance_date', '=', $previous_month_year)
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
                                ############################################### attendance work hours count in minutes code starts################################
                                $total_work_minutes = 0;
                                foreach ($attendance_work_hours_counts as $a) {
                                    sscanf($a->total_work, '%d:%d', $hour, $min);
                                    $total_work_minutes += $hour * 60 + $min;
                                }
                                $sum_total_min = sprintf('%02d', $total_work_minutes);

                                ############################################## attendance work hours count code ends here ######################################

                                ############################################## approved half leave days count code starts ######################################
                                if (
                                    Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)
                                        ->where('is_half', '=', 1)
                                        ->where('leaves_status', '=', 'Approved')
                                        ->whereMonth('leaves_start_date', '=', $last_month)
                                        ->whereYear('leaves_end_date', '=', $previous_month_year)
                                        ->exists()
                                ) {
                                    $employee_half_leaves = Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)
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
                                    Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)
                                        ->where('is_half', '=', 1)
                                        ->where('leaves_status', '=', 'Approved')
                                        ->whereMonth('leaves_start_date', '=', $last_month)
                                        ->whereYear('leaves_end_date', '=', $previous_month_year)
                                        ->exists()
                                ) {
                                    $employee_half_leaves_to_get_no_of_attendences = Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)
                                        ->where('is_half', '=', 1)
                                        ->where('leaves_status', '=', 'Approved')
                                        ->whereMonth('leaves_start_date', '=', $last_month)
                                        ->whereYear('leaves_end_date', '=', $previous_month_year)
                                        ->get();

                                    $number_of_attendances_on_half_leave = 0;

                                    foreach ($employee_half_leaves_to_get_no_of_attendences as $employee_half_leaves_to_get_no_of_attendences_value) {
                                        //echo $employee_half_leaves_to_get_no_of_attendences_value->leaves_start_date;
                                        if (
                                            Attendance::where('employee_id', $new_payments_value->monthly_employee_id)
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
                                    Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)
                                        ->where(function ($query) {
                                            $query->where('is_half', 0)->orWhereNull('is_half');
                                        })
                                        ->where('leaves_status', '=', 'Approved')
                                        ->exists()
                                ) {
                                    /////leave days exists or not condition starts/////////////////

                                    $employee_leaves = Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)
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
                                $late_days =0;
                                $late_time_salary_cut_days =0;

                                if (
                                    LateTime::where('late_time_employee_id', '=', $new_payments_value->monthly_employee_id)
                                        ->whereMonth('late_time_date', '=', $last_month)
                                        ->whereYear('late_time_date', '=', $previous_month_year)
                                        ->exists()
                                ) {
                                    $minimum_countable_late_config_days = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_day']); //minimum countable days
                                    $total_days_from_late_count_array = LateTime::where('late_time_employee_id', '=', $new_payments_value->monthly_employee_id)
                                        ->whereMonth('late_time_date', '=', $last_month)
                                        ->whereYear('late_time_date', '=', $previous_month_year)
                                        ->count(); //total late days
                                    //late_time_salary_cut_days start

                                    $late_time_salary_cut_days = intval($total_days_from_late_count_array / $minimum_countable_late_config_days->minimum_countable_day);

                                    //late_time_salary_cut_days end
                                    // for ($a = 1; $a <= $total_days_from_late_count_array; $a++) {
                                    //     if ($a % $minimum_countable_late_config_days->minimum_countable_day == 0) {
                                    //         $countable_late_days += 1;
                                    //     }
                                    // }
                                    for ($a = 1; $a <= $total_days_from_late_count_array; $a++) {
                                         $late_days +=1;
                                          }
                                }
                                //echo $countable_late_days;
                                ########################################## Late Days Counting Code Ends Here ##############################################################################

                                ############################## Travelling Days counting code starts#####################################
                                if (
                                    Travel::where('travel_com_id', Auth::user()->com_id)
                                        ->where('travel_employee_id', '=', $new_payments_value->monthly_employee_id)
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
                                        ->where('travel_employee_id', '=', $new_payments_value->monthly_employee_id)
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
                                $compensatory_leave_counts = CompensatoryLeave::where('compen_leave_employee_id', '=', $new_payments_value->monthly_employee_id)
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
                                $firstWorkingDate = new DateTime($new_payments_value->joining_date);

                                if ($firstWorkingDate >= $monthStartDate && $firstWorkingDate <= $monthEndDate) {
                                    //echo "in the month";

                                    $timestamp = strtotime($new_payments_value->joining_date);
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
                                            //->whereBetween('start_date', [$new_payments_value->joining_date, $last_date_of_the_last_month_for_joining_counting])
                                            ->get();

                                        $all_other_holidays_joining_date_wise_without_weekly_holiday = 0;
                                        foreach ($other_holidays_joining_date_wise as $other_holidays_joining_date_wise_value) {
                                            if ($other_holidays_joining_date_wise_value->start_date >= $new_payments_value->joining_date && $other_holidays_joining_date_wise_value->start_date <= $last_date_of_the_last_month_for_joining_counting) {
                                                if ($other_holidays_joining_date_wise_value->end_date >= $new_payments_value->joining_date && $other_holidays_joining_date_wise_value->end_date <= $last_date_of_the_last_month_for_joining_counting) {
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
                                                if ($other_holidays_joining_date_wise_value->end_date >= $new_payments_value->joining_date && $other_holidays_joining_date_wise_value->end_date <= $last_date_of_the_last_month_for_joining_counting) {
                                                    //echo "(other start date not exists but end date exists in dates)";

                                                    ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                    $holidays_names_joining_date_wise = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                        ->where('holiday_type', '=', 'Weekly-Holiday')
                                                        ->get();

                                                    $start_date_joining_date_wise = date('d', strtotime($new_payments_value->joining_date));
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

                                                    $joiningDateWiseOtherHolidayStartDate = new DateTime($new_payments_value->joining_date);
                                                    $joiningDateWiseOtherHolidayEndDate = new DateTime($other_holidays_joining_date_wise_value->end_date);

                                                    $joiningDateWiseOtherHolidayDifference = $joiningDateWiseOtherHolidayEndDate->diff($joiningDateWiseOtherHolidayStartDate);
                                                    $all_other_holidays_joining_date_wise_without_weekly_holiday += $joiningDateWiseOtherHolidayDifference->format('%a') + 1 - $joining_date_wise_holidays;
                                                } else {
                                                    if ($other_holidays_joining_date_wise_value->start_date <= $new_payments_value->joining_date && $other_holidays_joining_date_wise_value->end_date >= $last_date_of_the_last_month_for_joining_counting) {
                                                        //echo "(both dates are out of the joining date and end date of the month)";

                                                        ###################################### joining date wise holidays counting from start date to end date code starts ######################################
                                                        $holidays_names_joining_date_wise = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                            ->where('holiday_type', '=', 'Weekly-Holiday')
                                                            ->get();
                                                        $start_date_joining_date_wise = date('d', strtotime($new_payments_value->joining_date));
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

                                                        $joiningDateWiseOtherHolidayStartDate = new DateTime($new_payments_value->joining_date);
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

                                    $timestamp = strtotime($new_payments_value->joining_date);
                                    $only_joining_date_day_number = date('d', $timestamp);

                                    //echo "total_holiday OF THE MONTH"; echo total_holiday($last_month,$previous_month_year); echo "<br>";
                                    // echo "all_other_holidays_joining_date_wise_without_weekly_holiday"; echo $all_other_holidays_joining_date_wise_without_weekly_holiday; echo "<br>";
                                    // echo "ATTEBDANCE "; echo $all_attendances_of_the_month; echo "<br>";

                                    ############################################### Joining date wise attendance count code starts#########################################
                                    $attendance_counts_joining_date_wise = Attendance::where('employee_id', '=', $new_payments_value->monthly_employee_id)
                                        ->whereBetween('attendance_date', [$new_payments_value->joining_date, $last_date_of_the_last_month_for_joining_counting])
                                        ->where('check_in_out', '=', 1)
                                        ->get();
                                    $all_attendances_of_the_month_joining_date_wise = $attendance_counts_joining_date_wise->count();
                                    ############################################## Joining date wise attendance count code ends here #######################################

                                    //echo "ATTEBDANCE JOINING DATE WISE"; echo $all_attendances_of_the_month_joining_date_wise; echo "<br>";

                                    //$sub_total_working_days = $all_attendances_of_the_month + joining_date_wise_total_holiday($last_month,$previous_month_year,$only_joining_date_day_number) + $all_other_holidays_joining_date_wise_without_weekly_holiday + $all_leaves_by_employee_without_holiday + $all_half_leaves_by_employee_without_holiday + $all_travel_days - $countable_late_days - $compensatory_leave_of_the_month; //total working days
                                    $sub_total_working_days = $all_attendances_of_the_month + $holidays_joining_date_wise + $all_other_holidays_joining_date_wise_without_weekly_holiday + $all_leaves_by_employee_without_holiday + $all_half_leaves_by_employee_without_holiday + $all_travel_days - $number_of_attendances_on_half_leave - $countable_late_days - $compensatory_leave_of_the_month; //total working days
                                } else {
                                    //echo "not in";
                                    //exit;

                                    // $finding_holidays_namess = Holiday::where('holiday_com_id',Auth::user()->com_id)->where('holiday_type','=','Weekly-Holiday')->get();

                                    // $start_date_other_holiday_wise =  date('d', strtotime("2022-05-01"));
                                    // $end_date_other_holiday_wise =  date('d', strtotime("2022-05-01"));

                                    // $other_holiday_wise_holidayss=0;
                                    // for($i=$start_date_other_holiday_wise;$i<=$end_date_other_holiday_wise;$i++)
                                    // foreach($finding_holidays_namess as $finding_holidays_names_value){
                                    // if(date('N',strtotime($previous_month_year.'-'.$last_month.'-'.$i))==$finding_holidays_names_value->holiday_number)   //if monday means 1, tue means 2.... sunday means 7
                                    // $other_holiday_wise_holidayss++;
                                    // }
                                    // //echo $other_holiday_wise_holidays;

                                    //  echo "other_holiday_wise_holidays test"; echo $other_holiday_wise_holidayss; echo "<br>";

                                    // $otherHolidayWiseOtherHolidayStartDate = new DateTime("2022-05-01");
                                    // $otherHolidayWiseOtherHolidayEndDate = new DateTime("2022-05-01");

                                    // $otherHolidayWiseOtherHolidayDifference = $otherHolidayWiseOtherHolidayEndDate->diff($otherHolidayWiseOtherHolidayStartDate);
                                    // echo "other holiday test"; echo $all_ot_holiday = $otherHolidayWiseOtherHolidayDifference->format("%a") + 1 - $other_holiday_wise_holidayss; echo "<br>";
                                    // //echo "other holiday test"; echo $all_ot_holiday = $otherHolidayWiseOtherHolidayDifference->format("%a") + 1; echo "<br>";

                                    // echo "all_attendances_of_the_month"; echo $all_attendances_of_the_month; echo "<br>";
                                    // echo "total_holiday"; echo total_holiday($last_month,$previous_month_year); echo "<br>";
                                    // echo "all_other_holidays_without_weekly_holiday"; echo $all_other_holidays_without_weekly_holiday; echo "<br>";
                                    // echo "all_leaves_by_employee_without_holiday"; echo $all_leaves_by_employee_without_holiday; echo "<br>";
                                    // echo "all_half_leaves_by_employee_without_holiday"; echo $all_half_leaves_by_employee_without_holiday; echo "<br>";
                                    // echo "all_travel_days"; echo $all_travel_days; echo "<br>";
                                    // echo "countable_late_days"; echo $countable_late_days; echo "<br>";
                                    // echo "compensatory_leave_of_the_month"; echo $compensatory_leave_of_the_month; echo "<br>";

                                    // echo "<br>";
                                    // echo "<br>";

                                    $sub_total_working_days = $all_attendances_of_the_month + total_holiday($last_month, $previous_month_year) + $all_other_holidays_without_weekly_holiday + $all_leaves_by_employee_without_holiday + $all_half_leaves_by_employee_without_holiday + $all_travel_days - $number_of_attendances_on_half_leave - $countable_late_days - $compensatory_leave_of_the_month; //total working days
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

                                $employee_basic_salary_percentage_wise = ($new_payments_value->gross_salary * $new_payments_value->salary_config_basic_salary) / 100;

                                //basic salary after deducting 60 percent

                                $days = floor((time() - strtotime($new_payments_value->joining_date)) / 86400);

                                $start_date = new DateTime($new_payments_value->joining_date);
                                $end_date = new DateTime();

                                $interval = $start_date->diff($end_date);

                                $years = $interval->y;
                                $months = $interval->m;
                                $day = $interval->d;

                                $total_months = $years * 12 + $months;

                                $bonus_amount = 0;
                                ?>
                @if ($all_attendances_of_the_month != 0)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $new_payments_value->first_name }} {{ $new_payments_value->last_name }}</td>
                    <td>{{ $new_payments_value->company_assigned_id }}</td>
                    <td>{{ $years.' '.__('Year').' '.$months.' '.__('Month').' '.$day.' '.__('days')}} </td>
                    <td>{{ $new_payments_value->salary_type }}</td>
                    <td>{{ $employee_basic_salary_percentage_wise }}</td>
                    <td>{{ $all_house_rent =
                        ($new_payments_value->gross_salary *
                        $new_payments_value->salary_config_house_rent_allowance) / 100 }}
                    </td>
                    <td>{{ $salary_config_medical_allowance =
                        ($new_payments_value->gross_salary *
                        $new_payments_value->salary_config_medical_allowance) / 100 }}
                    </td>
                    <td>{{ $salary_config_conveyance_allowance =
                        ($new_payments_value->gross_salary *
                        $new_payments_value->salary_config_conveyance_allowance) / 100 }}
                    </td>

                    <td>{{ $new_payments_value->per_hour_rate }}</td>
                    <td>{{ $sum_total_hours }}</td>

                    <td>
                        @if (FestivalBonus::where('festival_bonus_com_id', '=',
                        Auth::user()->com_id)->whereMonth('festival_bonus_date_month_year', '=',
                        $last_month)->exists())





                        @foreach ($festivalBonus as $festivalBonusMonth)
                        <?php

                        $month_year = date('Y-m', strtotime($festivalBonusMonth->festival_bonus_date_month_year));
                        $month_year_date = date('M-Y', strtotime($festivalBonusMonth->festival_bonus_date_month_year));

                        $payment_month = date('m', strtotime($festivalBonusMonth->festival_bonus_date_month_year));
                        $payment_year = date('Y', strtotime($festivalBonusMonth->festival_bonus_date_month_year));

                        $festival_bounus_title = $festivalBonusMonth->festival_bonus_title ?? null;

                        ?>

                        @if (FestivalPayment::where('festival_payment_com_id', Auth::user()->com_id)
                        ->where('festival_payment_emp_id',$new_payments_value->id)
                        ->where('status',1)
                        ->whereMonth('festival_payment_date', '=', $payment_month)
                        ->whereYear('festival_payment_date', '=', $payment_year)
                        ->exists())
                        {{ $bonus_amount = 0 }}

                        @else


                        @if(($total_months >= $festival_config->festival_config_festival_bonus_time_duration)
                        &&($month_year == date('Y-m')))


                        @if($festival_config->festival_config_salary_type == "Gross")
                        {{$bonus_amount =
                        ($new_payments_value->gross_salary*$festival_config->festival_config_festival_bonus_percentage)/100}}
                        @endif
                        @if($festival_config->festival_config_salary_type == "Basic")
                        {{
                        $bonus_amount =
                        ((($new_payments_value->gross_salary*$salary_configs->salary_config_basic_salary)/100)*$festival_config->festival_config_festival_bonus_percentage)/100
                        }}
                        @endif
                        @endif
                        @endif
                        @endforeach

                        @endif

                    </td>

                    <?php

                                        //echo $total_working_days;

                                        $employee_per_day_gross_salary = $new_payments_value->gross_salary / $total_number_of_days_of_the_month;

                                        $employee_per_day_basic_salary = (($new_payments_value->gross_salary * $new_payments_value->salary_config_basic_salary) / 100) /$total_number_of_days_of_the_month;

                                        $employee_late_cut_salary = 0;
                                        if($late_time_salary_config->late_time_salary_config == "Basic"){
                                        $employee_late_cut_salary = $employee_per_day_basic_salary * $late_time_salary_cut_days;
                                        }elseif ($late_time_salary_config->late_time_salary_config == "Gross") {
                                        $employee_late_cut_salary = $employee_per_day_gross_salary * $late_time_salary_cut_days;
                                        }else{
                                            $employee_late_cut_salary = 0;
                                        }


                                        $this_month_wise_gross_salary = $employee_per_day_gross_salary * $total_working_days;

                                        $this_month_wise_basic_salary = ($this_month_wise_gross_salary * $new_payments_value->salary_config_basic_salary) / 100;
                                        $this_month_wise_house_rent = ($this_month_wise_gross_salary * $new_payments_value->salary_config_house_rent_allowance) / 100;
                                        $this_month_wise_conveyance = ($this_month_wise_gross_salary * $new_payments_value->salary_config_conveyance_allowance) / 100;
                                        $this_month_wise_medical = ($this_month_wise_gross_salary * $new_payments_value->salary_config_medical_allowance) / 100;

                                        if (
                                            FestivalBonus::where('festival_bonus_com_id', '=', Auth::user()->com_id)
                                                ->whereMonth('festival_bonus_date_month_year', '=', $last_month)
                                                ->exists()
                                        ) {
                                            $festival_bonus_for_the_employee = ($new_payments_value->gross_salary * $new_payments_value->salary_config_festival_bonus) / 100 + 0;
                                        } else {
                                            $festival_bonus_for_the_employee = 0;
                                        }

                                        ###################################### tax deduction code starts from here ######################################
                                        $previous_deducted_salary_tax = 0;
                                        ?>


                                    @foreach ($tax_configs as $tax_configs_value)
                                    <?php

                                            ###################################house-rent and allowances tax configure code starts from here####################

                                            $yearly_total_gross_salary = $this_month_wise_gross_salary * 12; //this month wise yearly gross salary
                                            $yearly_festival_bonus_data =  YearlyFestivalBonusConfig::where('employee_id', '=', $new_payments_value->monthly_employee_id)
                                                    ->first('total_bonus');

                                            if ($yearly_festival_bonus_data) {
                                                $yearly_festival_bonus = $yearly_festival_bonus_data->total_bonus;
                                            } else {
                                                // If no record is found, set a default value for $yearly_festival_bonus
                                                $yearly_festival_bonus = 0;
                                            }

                                        //    $yearly_festival_bonus = 100000;
                                            //$yearly_total_gross_salary = 45833*12; //this month wise yearly gross salary
                                            //house-rent non taxable minimum range start

                                            $house_rent_non_taxable_minimum_range_yearly = 300000;
                                            if(HouseRentNonTaxableRangeYearly::where('house_rent_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->exists()){
                                             $house_rent_non_taxable_minimum_range_yearly =   $house_rent_non_taxable->house_rent_non_taxable_range_yearlies_amount;
                                            }else{
                                              $house_rent_non_taxable_minimum_range_yearly = 300000;
                                            }
                                            //house-rent non taxable minimum range end
                                            //medical allowance non taxable minimum range start
                                            $medical_allowance_non_taxable_minimum_range_yearly = 120000;
                                            if(MedicalAllowanceNonTaxableRangeYearly::where('medical_allowance_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->exists()){
                                             $medical_allowance_non_taxable_minimum_range_yearly = $medical_allowance_non_taxable->medical_allowance_non_taxable_range_yearlies_amount;
                                            }else{
                                             $medical_allowance_non_taxable_minimum_range_yearly = 120000;
                                            }
                                            //medical allowance non taxable minimum range end
                                            //convayance allowance non taxable minimum range start
                                            $conveyance_allowance_non_taxable_minimum_range_yearly = 30000;

                                            if(ConveyanceAllowanceNonTaxableRangeYearly::where('conveyance_allowance_non_taxable_range_yearlies_com_id',Auth::user()->com_id)->exists()){
                                               $conveyance_allowance_non_taxable_minimum_range_yearly =
                                               $conveyance_allowance_non_taxable->conveyance_allowance_non_taxable_range_yearlies_amount;
                                            }else{
                                                $conveyance_allowance_non_taxable_minimum_range_yearly = 30000;
                                             }

                                             //convayance allowance non taxable minimum range end

                                            $basic_salary_of_the_yearly_gross_salary = ($yearly_total_gross_salary * $new_payments_value->salary_config_basic_salary) / 100; //yearly basic-salary getting from yearly gross salary

                                            $house_rent_of_the_yearly_gross_salary = ($yearly_total_gross_salary * $new_payments_value->salary_config_house_rent_allowance) / 100; //yearly house-rent getting from yearly gross salary

                                            $medical_allowance_of_the_yearly_gross_salary = ($yearly_total_gross_salary * $new_payments_value->salary_config_medical_allowance) / 100; //yearly medical allowance getting from yearly gross salary

                                            $conveyance_allowance_of_the_yearly_gross_salary = ($yearly_total_gross_salary * $new_payments_value->salary_config_conveyance_allowance) / 100; //yearly convance allowance getting from yearly gross salary

                                            if ($house_rent_of_the_yearly_gross_salary >= $house_rent_non_taxable_minimum_range_yearly) {
                                                $yearly_taxable_house_rent = $house_rent_of_the_yearly_gross_salary - $house_rent_non_taxable_minimum_range_yearly;

                                                $yearly_deductable_house_rent = $house_rent_non_taxable_minimum_range_yearly;

                                            } else {
                                                $yearly_taxable_house_rent = 0;
                                                $yearly_deductable_house_rent = $house_rent_of_the_yearly_gross_salary;

                                            }

                                            if ($medical_allowance_of_the_yearly_gross_salary >= $medical_allowance_non_taxable_minimum_range_yearly) {
                                                $yearly_taxable_medical_allowance = $medical_allowance_of_the_yearly_gross_salary - $medical_allowance_non_taxable_minimum_range_yearly;
                                                $yearly_deductable_medical_allowance = $medical_allowance_non_taxable_minimum_range_yearly;

                                            } else {
                                                $yearly_taxable_medical_allowance = 0;
                                                $yearly_deductable_medical_allowance = $medical_allowance_of_the_yearly_gross_salary;
                                            }

                                            if ($conveyance_allowance_of_the_yearly_gross_salary >= $conveyance_allowance_non_taxable_minimum_range_yearly) {
                                                $yearly_taxable_conveyance_allowance = $conveyance_allowance_of_the_yearly_gross_salary - $conveyance_allowance_non_taxable_minimum_range_yearly;
                                                $yearly_deductable_conveyance_allowance = $conveyance_allowance_non_taxable_minimum_range_yearly;

                                            } else {
                                                $yearly_taxable_conveyance_allowance = 0;
                                                $yearly_deductable_conveyance_allowance = $conveyance_allowance_of_the_yearly_gross_salary;

                                            }

                                            $taxable_total_yearly_house_rent_and_allowances = $yearly_taxable_house_rent + $yearly_taxable_medical_allowance + $yearly_taxable_conveyance_allowance;
                                            $deductable_total_yearly_house_rent_and_allowances = $yearly_deductable_house_rent + $yearly_deductable_medical_allowance + $yearly_deductable_conveyance_allowance;
                                            $taxable_yearly_gross_salary = $yearly_festival_bonus + $basic_salary_of_the_yearly_gross_salary  + $taxable_total_yearly_house_rent_and_allowances;
                                           // dd($taxable_yearly_gross_salary);
                                            ###################################house-rent and allowances tax configure code ends here####################

                                            ###################################festival bonus code starts from here####################
                                            if (
                                                FestivalBonus::where('festival_bonus_com_id', '=', Auth::user()->com_id)
                                                    ->whereMonth('festival_bonus_date_month_year', '=', $last_month)
                                                    ->exists()
                                            ) {
                                                $monthly_festival_bonus = ($new_payments_value->gross_salary * $new_payments_value->salary_config_festival_bonus) / 100;
                                            } else {
                                                $monthly_festival_bonus = 0;
                                            }
                                            ###################################festival bonus code ends here####################

                                            ################################### Commission code starts from here ####################

                                            if (
                                                Commission::where('commission_employee_id', '=', $new_payments_value->monthly_employee_id)
                                                    ->whereMonth('commission_month_year', '=', $last_month)
                                                    ->whereYear('commission_month_year', '=', $previous_month_year)
                                                    ->exists()
                                            ) {
                                                $employee_commissions_array = Commission::where('commission_employee_id', '=', $new_payments_value->monthly_employee_id)
                                                    ->whereMonth('commission_month_year', '=', $last_month)
                                                    ->whereYear('commission_month_year', '=', $previous_month_year)
                                                    ->pluck('commission_amount');
                                                foreach ($employee_commissions_array as $employee_commission_value) {
                                                    $monthly_commission = $employee_commission_value;
                                                }
                                            } else {
                                                $monthly_commission = 0;
                                            }
                                            ################################### Commission code ends here ####################

                                            ################################### PF code starts from here####################
                                            if ($new_payments_value->user_provident_fund_member == 'Yes') {
                                                $monthly_provident_fund = ($new_payments_value->gross_salary * $new_payments_value->user_provident_fund) / 100 + 0;
                                            } else {
                                                $monthly_provident_fund = 0;
                                            }
                                            ################################### PF code ends here####################

                                            ################################### Other Payment code starts from here ####################
                                            if (
                                                OtherPayment::where('other_payment_employee_id', '=', $new_payments_value->monthly_employee_id)
                                                    ->whereMonth('other_payment_month_year', '=', $last_month)
                                                    ->whereYear('other_payment_month_year', '=', $previous_month_year)
                                                    ->exists()
                                            ) {
                                                $other_payments_array = OtherPayment::where('other_payment_employee_id', '=', $new_payments_value->monthly_employee_id)
                                                    ->whereMonth('other_payment_month_year', '=', $last_month)
                                                    ->whereYear('other_payment_month_year', '=', $previous_month_year)
                                                    ->pluck('other_payment_amount');
                                                foreach ($other_payments_array as $other_payments_value) {
                                                    $monthly_other_payment = $other_payments_value;
                                                }
                                            } else {
                                                $monthly_other_payment = 0;
                                            }
                                            ################################### Other Payment code ends here ####################

                                            ################################### Over Time code starts from here ####################
                                            if (
                                                Overtime::where('over_time_employee_id', '=', $new_payments_value->monthly_employee_id)
                                                    ->whereMonth('over_time_date', '=', $last_month)
                                                    ->whereYear('over_time_date', '=', $previous_month_year)
                                                    ->exists()
                                            ) {
                                                $over_times = Overtime::where('over_time_employee_id', '=', $new_payments_value->monthly_employee_id)
                                                    ->whereMonth('over_time_date', '=', $last_month)
                                                    ->whereYear('over_time_date', '=', $previous_month_year)
                                                    ->get(['over_time_company_duty_in_seconds', 'over_time_employee_in_seconds', 'over_time_rate']);
                                                $monthly_over_time_payment = 0;
                                                foreach ($over_times as $over_times_value) {
                                                    $employee_basic_salary_per_second = $employee_per_day_gross_salary / $over_times_value->over_time_company_duty_in_seconds;
                                                    $employee_over_time_amount_without_over_time_rate = $employee_basic_salary_per_second * $over_times_value->over_time_employee_in_seconds;
                                                    $monthly_over_time_payment += $employee_over_time_amount_without_over_time_rate * $over_times_value->over_time_rate;
                                                }
                                            } else {
                                                $monthly_over_time_payment = 0;
                                            }

                                            //Per minutes rate count and total salary count start

                                            $perMinutesRate = $new_payments_value->per_hour_rate / 60;
                                            $totalHourlySalary = $sum_total_min * $perMinutesRate;

                                            //Per minutes rate count and total salary count end

                                            ################################### Over Time code ends here ####################

                                            ###################################### Tax config wise tax amount code starts from here ######################################

                                            //$this_month_wise_yearly_gross_salary = ($this_month_wise_basic_salary + $monthly_festival_bonus + $monthly_commission + $monthly_provident_fund + $monthly_other_payment + $monthly_over_time_payment)*12 + $taxable_total_yearly_house_rent_and_allowances; ///yearly gross salary with all additions
                                            //$this_month_wise_yearly_gross_salary = ($monthly_festival_bonus + $monthly_commission + $monthly_provident_fund + $monthly_other_payment + $monthly_over_time_payment)*12 + $basic_salary_of_the_yearly_gross_salary + $taxable_total_yearly_house_rent_and_allowances; ///yearly gross salary with all additions
                                            $this_month_wise_yearly_gross_salary = ( $monthly_commission + $monthly_provident_fund + $monthly_other_payment + $monthly_over_time_payment) * 12 + $taxable_yearly_gross_salary; ///yearly gross salary with all additions
                                            $gross_salary = $this_month_wise_yearly_gross_salary;

                                            if ($tax_configs_value->minimum_salary <= $gross_salary) {
                                                if ($gross_salary < $tax_configs_value->maximum_salary) {
                                                    $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;

                                                } else {
                                                    $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;

                                                }

                                                $tax_deduction_percentage = $taxable_salary * $tax_configs_value->tax_percentage;
                                                //      dd($tax_deduction_percentage);
                                                $taxable_salary = $tax_configs_value->minimum_salary;
                                                // dd($taxable_salary);
                                                $tax_deduction = $tax_deduction_percentage / 100;
                                                //dd($tax_deduction);
                                                $previous_deducted_salary_tax += $tax_deduction;
                                                //dd($previous_deducted_salary_tax);
                                            }
                                            ###################################### Tax config wise tax amount code ends here ######################################
                                            ?>
                                @endforeach
                                <?php
                                        ######################################tax deduction code ends here ######################################
                                        ?>
                                <?php
                                        ######### tax configuring code for 0 to Minimum tax amount starts from here ##############
                                        //echo $previous_deducted_salary_tax;
                                        //echo "<br>";
                                        $tax_deduction_amount = $previous_deducted_salary_tax / 12;
                                            //dd($tax_deduction_amount);
                                        $minimum_tax_config_amount = 417;

                                        if($minimum_tax_config->minimum_tax_config_amount){
                                         $minimum_tax_config_amount = $minimum_tax_config->minimum_tax_config_amount;
                                        }

                                        if ($tax_deduction_amount >= 1 && $tax_deduction_amount <= $minimum_tax_config_amount) {
                                            $all_tax_deduction = $minimum_tax_config_amount;
                                        } else {
                                            $all_tax_deduction = $tax_deduction_amount;
                                        }

                                        //echo  $all_tax_deduction;
                                        ######### tax configuring code for 0 to Minimum tax amount ends here ##############
                                        ######### Lunch Allowance start here ##############
                                        if(Lunch::where('lunch_com_id', Auth::user()->com_id)->where('lunch_emp_id',$new_payments_value->monthly_employee_id)->whereMonth('lunch_month_year',$last_month)->whereYear('lunch_month_year',$previous_month_year)->exists()){

                                        $lunch_bill_deduction = Lunch::where('lunch_com_id',Auth::user()->com_id)->where('lunch_emp_id',$new_payments_value->monthly_employee_id)->whereMonth('lunch_month_year',$last_month)->whereYear('lunch_month_year',$previous_month_year)->first('lunch_bill');

                                        $lunch_bill_deduction = $lunch_bill_deduction->lunch_bill;

                                    }else{
                                        $lunch_bill_deduction = 0;
                                    }
                                       ######### Lunch Allowance end here ##############
                                        ?>


                    <td>{{ round($all_tax_deduction ?? 0) }}</td>
                    <td>{{ $monthly_provident_fund ?? null }}</td>
                    <td>
                        @if (Loan::where('loans_employee_id', '=',
                        $new_payments_value->monthly_employee_id)->where('loans_remaining_installments', '>',
                        0)->exists())
                        @php(
                        $employee_loan = Loan::where('loans_employee_id', '=',
                        $new_payments_value->monthly_employee_id)->where('loans_remaining_installments', '>',
                        0)->get(['loans_remaining_amount', 'loans_remaining_installments'])
                        )
                        @foreach ($employee_loan as $employee_loan_value)
                        {{ $monthly_loan =
                        $employee_loan_value->loans_remaining_amount /
                        $employee_loan_value->loans_remaining_installments }}
                        @endforeach
                        @else
                        {{ $monthly_loan = 0 }}
                        @endif
                    </td>
                    <td>{{$late_days ?? 0}}</td>
                    <td>{{round($employee_late_cut_salary)}} </td>
                    <td>
                        @if ($new_payments_value->monthly_payment_status == 0)
                        {{ __('Unpaid') }}
                        @elseif($new_payments_value->monthly_payment_status == 1)
                        {{ __('Paid') }}
                        @endif
                    </td>
                    <?php
                    $bank_accounts = BankAccount::where('bank_account_com_id', Auth::user()->com_id)
                                            ->where('bank_account_employee_id', $new_payments_value->monthly_employee_id)
                                            ->first();
                                        ?>
                    <td>

                        <a href="#" class="btn edit" data-toggle="modal"
                            data-target="#datailsModal{{ $new_payments_value->id }}" title=" Detail "
                            data-original-title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a>

                        <form method="post" action="{{ route('make-payments') }}" class="form-horizontal btn"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="pay_slip_bank_account_id" value="{{ $bank_accounts->id ?? 0 }}">
                            <input type="hidden" name="monthly_attendance_row_id" value="{{ $new_payments_value->id }}">
                            <input type="hidden" name="pay_slip_email" value="{{ $new_payments_value->email }}">
                            <input type="hidden" name="pay_slip_employee_name"
                                value="{{ $new_payments_value->first_name . ' ' . $new_payments_value->last_name }}">
                            <input type="hidden" name="pay_slip_com_id"
                                value="{{ $new_payments_value->monthly_com_id }}">
                            <input type="hidden" name="pay_slip_employee_id"
                                value="{{ $new_payments_value->monthly_employee_id }}">
                            <input type="hidden" name="pay_slip_department_id"
                                value="{{ $new_payments_value->department_id }}">
                            <input type="hidden" name="pay_slip_payment_type"
                                value="{{ $new_payments_value->salary_type }}">
                            <input type="hidden" name="pay_slip_payment_date" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="pay_slip_month_year"
                                value="{{ $new_payments_value->attendance_month }}">
                            <input type="hidden" name="pay_slip_basic_salary"
                                value="{{ $employee_basic_salary_percentage_wise }}">
                            <input type="hidden" name="pay_slip_house_rent" value="{{ $all_house_rent }}">
                            <input type="hidden" name="pay_slip_medical_allowance"
                                value="{{ ($new_payments_value->gross_salary * $new_payments_value->salary_config_medical_allowance) / 100 }}">
                            <input type="hidden" name="pay_slip_conveyance_allowance"
                                value="{{ ($new_payments_value->gross_salary * $new_payments_value->salary_config_conveyance_allowance) / 100 }}">
                            <input type="hidden" name="pay_slip_festival_bonus" value="{{ $bonus_amount + 0 }}">
                            <input type="hidden" name="pay_slip_gross_salary"
                                value="{{ $new_payments_value->gross_salary }}">
                            <input type="hidden" name="pay_slip_total_working_hour" value="{{ $sum_total_hours }}">
                            <input type="hidden" name="pay_slip_per_hour_rate"
                                value="{{ $new_payments_value->per_hour_rate }}">
                            <input type="hidden" name="late_days" value="{{ $late_days }}">
                            <input type="hidden" name="pay_slip_late_day_salary_deduct"
                                value="{{ $employee_late_cut_salary }}">
                            <input type="hidden" name="pay_slip_commissions" value="{{ $monthly_commission ?? null }}">
                            <input type="hidden" name="pay_slip_other_payments"
                                value="{{ $monthly_other_payment ?? null }}">
                            <input type="hidden" name="pay_slip_overtimes"
                                value="{{ $monthly_over_time_payment ?? null }}">
                            <input type="hidden" name="pay_slip_provident_fund"
                                value="{{ $monthly_provident_fund ?? null }}">
                            <input type="hidden" name="pay_slip_tax_deduction" value="{{ $all_tax_deduction ?? null }}">
                            <input type="hidden" name="pay_slip_loans" value="{{ $monthly_loan ?? null }}">
                            @php($statutory_deduction_this_month = 0)
                            @if (StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                            $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                            '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                            $previous_month_year)->exists())
                            @php(
                            $statutory_deductions = StatutoryDeduction::where('statutory_deduc_employee_id',
                            '=',
                            $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                            '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                            $previous_month_year)->pluck('statutory_deduc_amount')
                            )
                            @foreach ($statutory_deductions as $statutory_deductions_value)
                            @php($statutory_deduction_this_month += $statutory_deductions_value)
                            @endforeach
                            @endif
                            <input type="hidden" name="pay_slip_statutory_deduction"
                                value="{{ $statutory_deduction_this_month }}">
                            <input type="hidden" name="pay_slip_transport_allowance"
                                value="{{ $total_transport_allowance = $all_attendances_of_the_month * $new_payments_value->transport_allowance + 0 }}">
                            <input type="hidden" name="pay_slip_mobile_bill"
                                value="{{ $total_mobile_bill = $new_payments_value->mobile_bill + 0 }}">

                            <input type="hidden" name="pay_slip_lunch_allowance"
                                value="{{ $lunch_bill_deduction + 0 }}">

                            @if ($new_payments_value->salary_type == 'Monthly')
                            <input type="hidden" name="pay_slip_net_salary"
                                value="{{ $monthly_net_salary = $this_month_wise_basic_salary + $this_month_wise_house_rent + $this_month_wise_conveyance + $this_month_wise_medical + $festival_bonus_for_the_employee + $bonus_amount + $total_transport_allowance + $total_mobile_bill + $monthly_commission + $monthly_other_payment + $monthly_over_time_payment - $all_tax_deduction - $monthly_provident_fund - $monthly_loan - $statutory_deduction_this_month - $lunch_bill_deduction - $employee_late_cut_salary}}">
                            @endif

                            @if ($new_payments_value->salary_type == 'Hourly')
                            <input type="hidden" name="pay_slip_net_salary"
                                value="{{ $monthly_net_salary = number_format((float) $totalHourlySalary, 2, '.', '') }}">
                            @endif

                            <input type="hidden" name="monthly_attendanc_payment_status" value="1">
                            <input type="hidden" name="pay_slip_working_days" value="{{ $total_working_days }}">
                            <input type="submit" name="action_button" class="btn btn-info"
                                value="{{ __('Make-Payment') }}" />
                        </form>
                    </td>

                </tr>

                <!-- Details Modal Starts -->
                <div id="datailsModal{{ $new_payments_value->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog payment-slip-view">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 id="exampleModalLabel" class="modal-title">Employee Salary Details
                                </h5>
                                {{-- <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                    class="close"><i class="dripicons-cross"></i></button> --}}
                                <button type="button" data-dismiss="modal" id="close" aria-label="Close"
                                    class="close"><i class="dripicons-cross"></i></button>
                            </div>

                            <div class="modal-body">

                                @if(IncrementSalaryHistory::where('emp_id',
                                $new_payments_value->monthly_employee_id)->whereMonth('increment_date',$last_month)->whereYear('increment_date',$previous_month_year)->first())

                                {{-- ########## Old Code for calculation probation before and after salary ########## --}}
                                <?php

                                            $incrementData = IncrementSalaryHistory::where('inc_sal_his_com_id', Auth::user()->com_id)
                                                ->where('emp_id', $new_payments_value->monthly_employee_id)
                                                ->whereMonth('increment_date',$last_month)
                                                ->whereYear('increment_date',$previous_month_year)
                                                ->first();
                                            // previous month history
                                            $startOfMonth = now()->subMonth()->startOfMonth()->format('Y-m-d');
                                            $incrementDate = Carbon::parse($incrementData->increment_date);
                                            $previousDayOfMonth = now()->subMonth()->daysInMonth;


                                            // specify the start and end dates
                                            $startDate = Carbon::parse($startOfMonth);
                                            $endDate = Carbon::parse($incrementDate);


                                            //attandance weekend holiday  count start
                                            $holidaysDays = [];
                                            for ($holidayDate = $startDate->copy(); $holidayDate->lte($endDate); $holidayDate->addDay()) {
                                                $holidaysDays[] = $holidayDate->format('D');
                                            }

                                            $holidayData = [];

                                            foreach ($holidaysDays as $holiday) {
                                                $data = Holiday::where('holiday_com_id',  Auth::user()->com_id)
                                                    ->where('holiday_type', 'Weekly-Holiday')
                                                    ->where('holiday_name', [$holiday])
                                                    ->get();
                                                if (!$data->isEmpty()) {
                                                    $holidayData[$holiday] = $data;
                                                }
                                            }
                                            $holidayDataCount = count($holidayData);

                                            //attandance weekend holiday count end

                                            //attandance other-holiday  count start

                                            $otherHolidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                ->where('holiday_type', 'Other-Holiday')
                                                ->get();
                                            $probationStartDate = Carbon::parse($incrementData->start_date_of_month);
                                            $probationEndDate = Carbon::parse($incrementData->increment_date);

                                            $overlappingDays = 0;
                                            foreach ($otherHolidays as $holiday) {
                                                $holidaysStartDate = Carbon::parse($holiday->start_date);
                                                $holidaysEndDate = Carbon::parse($holiday->end_date);

                                                // Check if the probation period overlaps with the holiday period
                                                if ($probationStartDate <= $holidaysEndDate && $probationEndDate >= $holidaysStartDate) {
                                                    // Find the start and end dates of the overlapping period
                                                    $overlapStartDate = max($probationStartDate, $holidaysStartDate);
                                                    $overlapEndDate = min($probationEndDate, $holidaysEndDate);

                                                    // Calculate the number of overlapping days
                                                    $duration = $overlapStartDate->diff($overlapEndDate);
                                                    $overlappingDays += $duration->days + 1;
                                                }
                                            }

                                            //attandance other-holiday  count end

                                            // Leave Attendence Count Start

                                            $leaves = Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)->where('leaves_status', 'Approved')->get();
                                            $overlappingLeaveDays = 0;
                                            foreach ($leaves as $leave) {
                                                $leaveStartDate = Carbon::parse($leave->leaves_start_date);
                                                $leaveEndDate = Carbon::parse($leave->leaves_end_date);

                                                // Check if the probation period overlaps with the holiday period
                                                if ($probationStartDate <= $leaveEndDate && $probationEndDate >= $leaveStartDate) {
                                                    // Find the start and end dates of the overlapping period
                                                    $overlapLeaveStartDate = max($probationStartDate, $leaveStartDate);
                                                    $overlapLeaveEndDate = min($probationEndDate, $leaveEndDate);

                                                    // Calculate the number of overlapping days
                                                    $durationLeave = $overlapLeaveStartDate->diff($overlapLeaveEndDate);
                                                    $overlappingLeaveDays += $durationLeave->days + 1;
                                                }
                                            }

                                            // Leave Attendence Count End

                                            //attandance day count start
                                            $days = [];
                                            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                                                $days[] = $date->format('Y-m-d');
                                            }

                                            $attendanceData = [];
                                            foreach ($holidaysDays as $holiday) {
                                                $data = Holiday::where('holiday_com_id',  Auth::user()->com_id)
                                                    ->where('holiday_type', 'Weekly-Holiday')
                                                    ->where('holiday_name', [$holiday])
                                                    ->get();
                                                if (!$data->isEmpty()) {
                                                    $holidayData = array_merge($holidayData, $data->toArray());
                                                }
                                            }

                                            //attandance day count start end

                                            //total probition working day start
                                            $totalAttendanceCount = 0;
                                            foreach ($attendanceData as $data) {
                                                $totalAttendanceCount += $data->count();
                                            }


                                            // probition working days count start
                                            $probitionTotalWorkingDays = $totalAttendanceCount +  $holidayDataCount + $overlappingDays + $overlappingLeaveDays;
                                            // probition working days count end

                                            // other  working day start
                                            $daysPreviousBetween = $total_working_days - $probitionTotalWorkingDays;
                                             // other  working day end

                                          // probition previous salary  count start
                                             $previousMonthSalary = ($incrementData->old_gross_salary / $previousDayOfMonth) * $probitionTotalWorkingDays;
                                          // probition previous salary  count end

                                          // probition  after  count start
                                             $currentMonthSalary =  ($incrementData->new_gross_salary / $previousDayOfMonth) * $daysPreviousBetween;
                                          // probition  after  count end

                                            //total salary start
                                            $totalSalary = round($previousMonthSalary +   $currentMonthSalary);
                                            //total salary end

                                            $netSalary = $totalSalary + $total_mobile_bill + $monthly_over_time_payment;
                                            $totalWorkingDay = $probitionTotalWorkingDays + $daysPreviousBetween;

                                     ?>
                               {{-- ########## Old Code for calculation probation before and after salary ########## --}}
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="profile-view">
                                            <div class="profile-img">
                                                <img class="rounded" width="80"
                                                    src="{{ asset($new_payments_value->profile_photo) }}">
                                            </div>
                                            <div class="profile-info">
                                                <h3>{{ $new_payments_value->first_name . ' ' .
                                                    $new_payments_value->last_name }}</h3>
                                                <a href="#">{{ __('View Details') }}</a>
                                                {{$new_payments_value->monthly_employee_id}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 form-group" style="text-align: center;">
                                        <h2>Salary Details</h2>
                                    </div><br>
                                    <div class="col-md-12 form-group" style="text-align: center;">

                                        <h2>- - - - - - - - - - - - - - - - - - - -</h2>
                                    </div>

                                    <div class="col-md-12">
                                        <dl>
                                            <dd> <b> Bank Account: </b></dd>
                                            <dd> {{ $bank_accounts->bank_account_number ?? null }} </dd>
                                            <dd> <b> Monthly Payslip:</b></dd>
                                            <dd> {{ $new_payments_value->salary_type }} </dd>
                                            <dd> <b> Payment for the month: </b></dd>
                                            <dd>
                                                <?php
                                                    $dateObj = DateTime::createFromFormat('!m', $last_month);
                                                    $monthName = $dateObj->format('F');
                                                    echo $monthNameAndYear = $monthName . ', ' . $previous_month_year;
                                                ?>
                                            </dd>
                                            <dd> <b> Total Hours: </b> </dd>
                                            <dd> {{ $sum_total_hours }} </dd>
                                            <dd> <b> Per Hour Rate: </b></dd>
                                            <dd> {{ $new_payments_value->per_hour_rate }} </dd>
                                            <dd> <b> Total Hourly Salay: </b></dd>
                                            <dd> {{ number_format((float) $totalHourlySalary, 2, '.', '') }} </dd>
                                            <dd> <b> probation Previous Working Days: </b></dd>
                                            <dd> {{ $incrementData->days_before_probation
                                                }} </dd>
                                            <dd> <b> probation After Working Days: </b></dd>
                                            <dd> {{ $incrementData->days_after_probation }} </dd>
                                            <dd> <b> Number of Days: </b></dd>
                                            <dd> {{ $totalWorkingDay }} </dd>
                                            <dd> <b> Number of Late Days: </b></dd>
                                            <dd>
                                                {{$late_days ?? 0}}
                                            </dd>
                                            <dd> <b>Late Days Salary Cut: </b></dd>
                                            <dd>
                                                {{$employee_late_cut_salary ?? 0}}
                                            </dd>

                                            <dd> <b> Basic Salary: </b></dd>
                                            <dd> {{ $employee_basic_salary_percentage_wise }} </dd>
                                            <dd> <b> House Rent:</b></dd>
                                            <dd> {{ $all_house_rent }} </dd>
                                            <dd> <b> Allowances: </b></dd>
                                            <dd> Conveyance =
                                                {{ ($new_payments_value->gross_salary *
                                                $new_payments_value->salary_config_conveyance_allowance) / 100 }}Tk,
                                                Medical =
                                                {{ ($new_payments_value->gross_salary *
                                                $new_payments_value->salary_config_medical_allowance) / 100 }}Tk,
                                                Festival Bonus = {{ $bonus_amount }}Tk
                                            </dd>
                                            <dd> <b> Commissions: </b></dd>
                                            <dd> {{ $monthly_commission }} </dd>
                                            <dd> <b> Other Payment: </b></dd>
                                            <dd> {{ $monthly_other_payment }} </dd>
                                            <dd> <b> TA/DA: </b> </dd>
                                            <dd> {{ $total_transport_allowance }} </dd>

                                            <dd> <b> Lunch Allowance: </b></dd>
                                            <dd> {{ $lunch_bill_deduction }} </dd>

                                            <dd> <b> Mobile Bill: </b></dd>
                                            <dd> {{ $total_mobile_bill }} </dd>


                                            <dd> <b> Overtime: </b></dd>
                                            <dd> {{ $monthly_over_time_payment }} </dd>
                                            <dd> <b> Loan: </b></dd>
                                            <dd> {{ $monthly_loan }} </dd>
                                            <dd> <b> Statutory Deductions: </b></dd>
                                            <dd> @if (StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                                $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                                '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                                $previous_month_year)->exists())
                                                @php(
                                                $statutory_deductions =
                                                StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                                $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                                '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                                $previous_month_year)->pluck('statutory_deduc_amount')
                                                )
                                                @foreach ($statutory_deductions as $statutory_deductions_value)
                                                {{ $statutory_deduction_this_months = $statutory_deductions_value }}
                                                @endforeach
                                                @else
                                                {{ $statutory_deduction_this_months = 0 }}
                                                @endif</dd>
                                            <dd> <b> Provident Fund: </b></dd>
                                            <dd> {{ $monthly_provident_fund }} </dd>
                                            <dd> <b> Tax Deduction: </b></dd>
                                            <dd> {{ round($all_tax_deduction) }} </dd>
                                            <dd> <b> Probation Previous Net Salary: </b> </dd>
                                            <dd> {{ $incrementData->salary_before_probation }} </dd>
                                            <dd> <b> Probation After Net Salary: </b></dd>
                                            <dd> {{ $incrementData->salary_after_probation }} </dd>
                                            <dd> <b> Total Salary: </b></dd>
                                            <dd> {{ $incrementData->probation_net_salary - $employee_late_cut_salary}}</dd>
                                        </dl>
                                    </div>
                                </div>

                                @elseif(User::where('id',
                                $new_payments_value->monthly_employee_id)->where('is_active' ,
                                1)->whereNotNull('active_date')->first())
                                <?php

                                                $userActiveDate = User::where('com_id', Auth::user()->com_id)
                                                    ->where('id', $new_payments_value->monthly_employee_id)
                                                    ->first();

                                                // active month date history
                                                $activeDate = Carbon::parse($userActiveDate->active_date);
                                                $activeEndMonthLastDate = now()->subMonth()->endOfMonth()->format('Y-m-d');
                                                $previousDayOfMonth = now()->subMonth()->daysInMonth;

                                                // specify the start and end dates
                                                $startDate = Carbon::parse($activeDate);
                                                $endDate = Carbon::parse($activeEndMonthLastDate);



                                                //attandance weekend holiday  count start
                                                $holidaysDays = [];
                                                for ($holidayDate = $startDate->copy(); $holidayDate->lte($endDate); $holidayDate->addDay()) {
                                                    $holidaysDays[] = $holidayDate->format('D');
                                                }

                                                $holidayData = [];

                                                foreach ($holidaysDays as $holiday) {
                                                    $data = Holiday::where('holiday_com_id',  Auth::user()->com_id)
                                                        ->where('holiday_type', 'Weekly-Holiday')
                                                        ->where('holiday_name', [$holiday])
                                                        ->get();
                                                        if (!$data->isEmpty()) {
                                                            $holidayData = array_merge($holidayData, $data->toArray());
                                                        }
                                                }

                                            $holidayDataCount = count($holidayData);

                                                //attandance weekend holiday count end

                                                //attandance other-holiday  count start

                                                $otherHolidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                    ->where('holiday_type', 'Other-Holiday')
                                                    ->get();

                                                $activeMonthstartDate = Carbon::parse($userActiveDate->active_date);
                                                $activMonthLastDate = Carbon::parse($endDate);


                                                $overlappingDays = 0;

                                                foreach ($otherHolidays as $holiday) {
                                                    $holidaysStartDate = Carbon::parse($holiday->start_date);
                                                    $holidaysEndDate = Carbon::parse($holiday->end_date);

                                                    // Check if the probation period overlaps with the holiday period
                                                    if ($activeMonthstartDate <= $holidaysEndDate && $activMonthLastDate >= $holidaysEndDate) {
                                                        // Find the start and end dates of the overlapping period
                                                        $overlapStartDate = max($activeMonthstartDate, $holidaysStartDate);
                                                        $overlapEndDate = min($activMonthLastDate, $holidaysEndDate);

                                                        // Calculate the number of overlapping days
                                                        $duration = $overlapStartDate->diff($overlapEndDate);
                                                        $overlappingDays += $duration->days + 1;
                                                    }
                                                }

                                                //attandance other-holiday  count end

                                                // Leave Attendence Count Start

                                                $leaves = Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)->where('leaves_status', 'Approved')->get();
                                                $overlappingLeaveDays = 0;
                                                foreach ($leaves as $leave) {
                                                    $leaveStartDate = Carbon::parse($leave->leaves_start_date);
                                                    $leaveEndDate = Carbon::parse($leave->leaves_end_date);

                                                    // Check if the probation period overlaps with the holiday period
                                                    if ($activeMonthstartDate <= $leaveEndDate && $activMonthLastDate >= $leaveStartDate) {
                                                        // Find the start and end dates of the overlapping period
                                                        $overlapLeaveStartDate = max($activeMonthstartDate, $leaveStartDate);
                                                        $overlapLeaveEndDate = min($activMonthLastDate, $leaveEndDate);

                                                        // Calculate the number of overlapping days
                                                        $durationLeave = $overlapLeaveStartDate->diff($overlapLeaveEndDate);
                                                        $overlappingLeaveDays += $durationLeave->days + 1;
                                                    }
                                                }

                                                // Leave Attendence Count End

                                                //attandance day count start startDate
                                                $days = [];
                                                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                                                    $days[] = $date->format('Y-m-d');
                                                }
                                                $days;
                                                $attendanceData = [];
                                                foreach ($days as $day) {
                                                    $data = Attendance::where('employee_id', $new_payments_value->monthly_employee_id)
                                                        ->whereIn('attendance_date', [$day])
                                                        ->get();
                                                    if (!$data->isEmpty()) {
                                                        $attendanceData[$day] = $data;
                                                    }
                                                }

                                                //attandance day count start end

                                                //total probition working day start
                                                $totalAttendanceCount = 0;
                                                foreach ($attendanceData as $data) {
                                                    $totalAttendanceCount += $data->count();
                                                }


                                               //total probition working day end

                                                // probition working days count start
                                                $totalWorkingDays = $totalAttendanceCount +  $holidayDataCount + $overlappingDays + $overlappingLeaveDays;
                                                // probition working days count end

                                                // probition previous salary  count start
                                         $totalSalary = ($userActiveDate->gross_salary / $previousDayOfMonth) * $totalWorkingDays;
                                    ?>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="employ-profile">
                                            <div class="profile-img">
                                                <img class="rounded" width="80"
                                                    src="{{ asset($new_payments_value->profile_photo) }}">
                                            </div>
                                            <div class="profile-content">
                                                <h3>{{ $new_payments_value->first_name . ' ' .
                                                    $new_payments_value->last_name }} </h3>
                                                <a href="#">{{ __('View Details') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: center;">
                                        <div class="section-title">
                                            <h2>Salary Details</h2>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <dl>
                                            <dd> <b> Bank Account: </b></dd>
                                            <dd> {{ $bank_accounts->bank_account_number ?? null }} </dd>
                                            <dd> <b> Monthly Payslip:</b></dd>
                                            <dd> {{ $new_payments_value->salary_type }} </dd>
                                            <dd> <b> Payment for the month: </b></dd>
                                            <dd>
                                                <?php
                                                    $dateObj = DateTime::createFromFormat('!m', $last_month);
                                                    $monthName = $dateObj->format('F');
                                                    echo $monthNameAndYear = $monthName . ', ' . $previous_month_year;
                                                ?>
                                            </dd>
                                            <dd> <b> Total Hours: </b> </dd>
                                            <dd> {{ $sum_total_hours }} </dd>

                                            <dd> <b> Per Hour Rate: </b></dd>
                                            <dd> {{ $new_payments_value->per_hour_rate }} </dd>
                                            <dd> <b> Total Hourly Salay: </b></dd>
                                            <dd> {{ number_format((float) $totalHourlySalary, 2, '.', '') }} </dd>


                                            <dd> <b> Number of Days: </b></dd>
                                            <dd> {{ $totalWorkingDays }} </dd>
                                            <dd> <b> Number of Late Days: </b></dd>
                                            <dd>
                                                {{$late_days ?? 0}}
                                            </dd>
                                            <dd> <b>Late Days Salary Cut: </b></dd>
                                            <dd>
                                                {{$employee_late_cut_salary ?? 0}}
                                            </dd>
                                            <dd> <b> Basic Salary: </b></dd>
                                            <dd> {{ $employee_basic_salary_percentage_wise }} </dd>
                                            <dd> <b> House Rent:</b></dd>
                                            <dd> {{ $all_house_rent }} </dd>
                                            <dd> <b> Allowances: </b></dd>
                                            <dd> Conveyance =
                                                {{ ($new_payments_value->gross_salary *
                                                $new_payments_value->salary_config_conveyance_allowance) / 100 }}Tk,
                                                Medical =
                                                {{ ($new_payments_value->gross_salary *
                                                $new_payments_value->salary_config_medical_allowance) / 100 }}Tk,
                                                Festival Bonus = {{ $bonus_amount }}Tk</dd>
                                            <dd> <b> Commissions: </b></dd>
                                            <dd> {{ $monthly_commission }} </dd>
                                            <dd> <b> Other Payment: </b></dd>
                                            <dd> {{ $monthly_other_payment }} </dd>
                                            <dd> <b> TA/DA: </b> </dd>
                                            <dd> {{ $total_transport_allowance }} </dd>

                                            <dd> <b> Lunch Allowance: </b></dd>
                                            <dd> {{ $lunch_bill_deduction }} </dd>

                                            <dd> <b> Mobile Bill: </b></dd>
                                            <dd> {{ $total_mobile_bill }} </dd>
                                            <dd> <b> Overtime: </b></dd>
                                            <dd> {{ $monthly_over_time_payment }} </dd>
                                            <dd> <b> Loan: </b></dd>
                                            <dd> {{ $monthly_loan }} </dd>
                                            <dd> <b> Statutory Deductions: </b></dd>
                                            <dd> @if (StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                                $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                                '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                                $previous_month_year)->exists())
                                                @php(
                                                $statutory_deductions =
                                                StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                                $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                                '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                                $previous_month_year)->pluck('statutory_deduc_amount')
                                                )
                                                @foreach ($statutory_deductions as $statutory_deductions_value)
                                                {{ $statutory_deduction_this_months = $statutory_deductions_value }}
                                                @endforeach
                                                @else
                                                {{ $statutory_deduction_this_months = 0 }}
                                                @endif</dd>
                                            <dd> <b> Provident Fund: </b></dd>
                                            <dd> {{ $monthly_provident_fund }} </dd>
                                            <dd> <b> Tax Deduction: </b></dd>
                                            <dd> {{ round($all_tax_deduction) }} </dd>

                                            <dd> <b> Net Salary: </b> </dd>
                                            <dd> {{ round($totalSalary - $employee_late_cut_salary)}} </dd>

                                        </dl>
                                    </div>
                                </div>
                                @elseif(User::where('id',
                                $new_payments_value->monthly_employee_id)->whereNotNull('inactive_date')->first())
                                <?php

                                                $userInactiveDate = User::where('com_id', Auth::user()->com_id)
                                                    ->where('id', $new_payments_value->monthly_employee_id)
                                                    ->first();

                                                // active month date history
                                                $inactiveDate = Carbon::parse($userInactiveDate->inactive_date);
                                                $activeEndMonthFirstDate = now()->subMonth()->startOfMonth()->format('Y-m-d');

                                                $previousDayOfMonth = now()->subMonth()->daysInMonth;

                                                // specify the start and end dates
                                                $startDate = Carbon::parse($activeEndMonthFirstDate);
                                                $endDate = Carbon::parse($inactiveDate);

                                                //attandance weekend holiday count start
                                                $holidaysDays = [];
                                                for ($holidayDate = $startDate->copy(); $holidayDate->lte($endDate); $holidayDate->addDay()) {
                                                    $holidaysDays[] = $holidayDate->format('D');
                                                }

                                                $holidayData = [];

                                                foreach ($holidaysDays as $holiday) {
                                                    $data = Holiday::where('holiday_com_id',  Auth::user()->com_id)
                                                        ->where('holiday_type', 'Weekly-Holiday')
                                                        ->where('holiday_name', [$holiday])
                                                        ->get();
                                                        if (!$data->isEmpty()) {
                                                            $holidayData = array_merge($holidayData, $data->toArray());
                                                        }
                                                }

                                               $holidayDataCount = count($holidayData);

                                                //attandance weekend holiday count end

                                                //attandance other-holiday  count start

                                                $otherHolidays = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                                    ->where('holiday_type', 'Other-Holiday')
                                                    ->get();

                                                $activeMonthstartDate = Carbon::parse($startDate);
                                                $activMonthLastDate = Carbon::parse($endDate);


                                                $overlappingDays = 0;

                                                foreach ($otherHolidays as $holiday) {
                                                    $holidaysStartDate = Carbon::parse($holiday->start_date);
                                                    $holidaysEndDate = Carbon::parse($holiday->end_date);

                                                    // Check if the probation period overlaps with the holiday period
                                                    if ($activeMonthstartDate <= $holidaysEndDate && $activMonthLastDate >= $holidaysEndDate) {
                                                        // Find the start and end dates of the overlapping period
                                                        $overlapStartDate = max($activeMonthstartDate, $holidaysStartDate);
                                                        $overlapEndDate = min($activMonthLastDate, $holidaysEndDate);

                                                        // Calculate the number of overlapping days
                                                        $duration = $overlapStartDate->diff($overlapEndDate);
                                                        $overlappingDays += $duration->days + 1;
                                                    }
                                                }

                                                //attandance other-holiday  count end

                                                // Leave Attendence Count Start

                                                $leaves = Leave::where('leaves_employee_id', $new_payments_value->monthly_employee_id)->where('leaves_status', 'Approved')->get();
                                                $overlappingLeaveDays = 0;
                                                foreach ($leaves as $leave) {
                                                    $leaveStartDate = Carbon::parse($leave->leaves_start_date);
                                                    $leaveEndDate = Carbon::parse($leave->leaves_end_date);

                                                    // Check if the probation period overlaps with the holiday period
                                                    if ($activeMonthstartDate <= $leaveEndDate && $activMonthLastDate >= $leaveStartDate) {
                                                        // Find the start and end dates of the overlapping period
                                                        $overlapLeaveStartDate = max($activeMonthstartDate, $leaveStartDate);
                                                        $overlapLeaveEndDate = min($activMonthLastDate, $leaveEndDate);

                                                        // Calculate the number of overlapping days

                                                        $durationLeave = $overlapLeaveStartDate->diff($overlapLeaveEndDate);
                                                        $overlappingLeaveDays += $durationLeave->days + 1;
                                                    }
                                                }

                                                // Leave Attendence Count End

                                                //attandance day count start startDate
                                                $days = [];
                                                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                                                    $days[] = $date->format('Y-m-d');
                                                }
                                                $days;
                                                $attendanceData = [];
                                                foreach ($days as $day) {
                                                    $data = Attendance::where('employee_id', $new_payments_value->monthly_employee_id)
                                                        ->whereIn('attendance_date', [$day])
                                                        ->get();
                                                    if (!$data->isEmpty()) {
                                                        $attendanceData[$day] = $data;
                                                    }
                                                }

                                                //attandance day count start end

                                                //total probition working day start
                                                $totalAttendanceCount = 0;
                                                foreach ($attendanceData as $data) {
                                                    $totalAttendanceCount += $data->count();
                                                }


                                               //total probition working day end

                                                // probition working days count start
                                                $totalWorkingDays = $totalAttendanceCount +  $holidayDataCount + $overlappingDays + $overlappingLeaveDays;
                                                // probition working days count end

                                                // probition previous salary  count start
                                                $totalSalary = ($userInactiveDate->gross_salary / $previousDayOfMonth) * $totalWorkingDays;
                                    ?>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="employ-profile">
                                            <div class="profile-img">
                                                <img class="rounded" width="80"
                                                    src="{{ asset($new_payments_value->profile_photo) }}">
                                            </div>
                                            <div class="profile-content">
                                                <h3>{{ $new_payments_value->first_name . ' ' .
                                                    $new_payments_value->last_name }} </h3>
                                                <a href="#">{{ __('View Details') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: center;">
                                        <div class="section-title">
                                            <h2>Salary Details</h2>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <dl>
                                            <dd> <b> Bank Account: </b></dd>
                                            <dd> {{ $bank_accounts->bank_account_number ?? null }} </dd>
                                            <dd> <b> Monthly Payslip:</b></dd>
                                            <dd> {{ $new_payments_value->salary_type }} </dd>
                                            <dd> <b> Payment for the month: </b></dd>
                                            <dd>
                                                <?php
                                                    $dateObj = DateTime::createFromFormat('!m', $last_month);
                                                    $monthName = $dateObj->format('F');
                                                    echo $monthNameAndYear = $monthName . ', ' . $previous_month_year;
                                                ?>
                                            </dd>
                                            <dd> <b> Total Hours: </b> </dd>
                                            <dd> {{ $sum_total_hours }} </dd>

                                            <dd> <b> Per Hour Rate: </b></dd>
                                            <dd> {{ $new_payments_value->per_hour_rate }} </dd>
                                            <dd> <b> Total Hourly Salay: </b></dd>
                                            <dd> {{ number_format((float) $totalHourlySalary, 2, '.', '') }} </dd>


                                            <dd> <b> Number of Days: </b></dd>
                                            <dd> {{ $totalWorkingDays }} </dd>
                                            <dd> <b> Number of Late Days: </b></dd>
                                            <dd>
                                                {{$late_days ?? 0}}
                                            </dd>
                                            <dd> <b>Late Days Salary Cut: </b></dd>
                                            <dd>
                                                {{$employee_late_cut_salary ?? 0}}
                                            </dd>
                                            <dd> <b> Basic Salary: </b></dd>
                                            <dd> {{ $employee_basic_salary_percentage_wise }} </dd>
                                            <dd> <b> House Rent:</b></dd>
                                            <dd> {{ $all_house_rent }} </dd>
                                            <dd> <b> Allowances: </b></dd>
                                            <dd> Conveyance =
                                                {{ ($new_payments_value->gross_salary *
                                                $new_payments_value->salary_config_conveyance_allowance) / 100 }}Tk,
                                                Medical =
                                                {{ ($new_payments_value->gross_salary *
                                                $new_payments_value->salary_config_medical_allowance) / 100 }}Tk,
                                                Festival Bonus = {{ $bonus_amount }}Tk</dd>
                                            <dd> <b> Commissions: </b></dd>
                                            <dd> {{ $monthly_commission }} </dd>
                                            <dd> <b> Other Payment: </b></dd>
                                            <dd> {{ $monthly_other_payment }} </dd>
                                            <dd> <b> TA/DA: </b> </dd>
                                            <dd> {{ $total_transport_allowance }} </dd>

                                            <dd> <b> Lunch Allowance: </b></dd>
                                            <dd> {{ $lunch_bill_deduction }} </dd>

                                            <dd> <b> Mobile Bill: </b></dd>
                                            <dd> {{ $total_mobile_bill }} </dd>
                                            <dd> <b> Overtime: </b></dd>
                                            <dd> {{ $monthly_over_time_payment }} </dd>
                                            <dd> <b> Loan: </b></dd>
                                            <dd> {{ $monthly_loan }} </dd>
                                            <dd> <b> Statutory Deductions: </b></dd>
                                            <dd> @if (StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                                $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                                '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                                $previous_month_year)->exists())
                                                @php(
                                                $statutory_deductions =
                                                StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                                $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                                '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                                $previous_month_year)->pluck('statutory_deduc_amount')
                                                )
                                                @foreach ($statutory_deductions as $statutory_deductions_value)
                                                {{ $statutory_deduction_this_months = $statutory_deductions_value }}
                                                @endforeach
                                                @else
                                                {{ $statutory_deduction_this_months = 0 }}
                                                @endif</dd>
                                            <dd> <b> Provident Fund: </b></dd>
                                            <dd> {{ $monthly_provident_fund }} </dd>
                                            <dd> <b> Tax Deduction: </b></dd>
                                            <dd> {{ round($all_tax_deduction )}} </dd>

                                            <dd> <b> Net Salary: </b> </dd>
                                            <dd> {{ round($totalSalary - $employee_late_cut_salary)}} </dd>

                                        </dl>
                                    </div>
                                </div>
                                @else
                                <div class="row">

                                    <div class="col-md-12">
                                        <dl>
                                            <dd> <b> Bank Account: </b></dd>
                                            <dd> {{ $bank_accounts->bank_account_number ?? null }} </dd>
                                            <dd> <b> Monthly Payslip:</b></dd>
                                            <dd> {{ $new_payments_value->salary_type }} </dd>
                                            <dd> <b> Payment for the month: </b></dd>
                                            <dd>
                                                <?php
                                                    $dateObj = DateTime::createFromFormat('!m', $last_month);
                                                    $monthName = $dateObj->format('F');
                                                    echo $monthNameAndYear = $monthName . ', ' . $previous_month_year;
                                                ?>
                                            </dd>
                                            <dd> <b> Total Hours: </b> </dd>
                                            <dd> {{ $sum_total_hours }} </dd>

                                            <dd> <b> Per Hour Rate: </b></dd>
                                            <dd> {{ $new_payments_value->per_hour_rate }} </dd>
                                            <dd> <b> Total Hourly Salay: </b></dd>
                                            <dd> {{ number_format((float) $totalHourlySalary, 2, '.', '') }} </dd>
                                            <dd> <b> Number of Days: </b></dd>
                                            <dd> {{ $total_working_days }} </dd>
                                            <dd> <b> Number of Late Days: </b></dd>
                                            <dd>
                                                {{$late_days ?? 0}}
                                            </dd>
                                            <dd> <b>Late Days Salary Cut: </b></dd>
                                            <dd>
                                                {{$employee_late_cut_salary ?? 0}}
                                            </dd>
                                            <dd> <b> Basic Salary: </b></dd>
                                            <dd> {{ $employee_basic_salary_percentage_wise }} </dd>
                                            <dd> <b> House Rent:</b></dd>
                                            <dd> {{ $all_house_rent }} </dd>
                                            <dd> <b> Allowances: </b></dd>
                                            <dd> Conveyance =
                                                {{ ($new_payments_value->gross_salary *
                                                $new_payments_value->salary_config_conveyance_allowance) / 100 }}Tk,
                                                Medical =
                                                {{ ($new_payments_value->gross_salary *
                                                $new_payments_value->salary_config_medical_allowance) / 100 }}Tk,
                                                Festival Bonus = {{ $bonus_amount }}Tk</dd>
                                            <dd> <b> Commissions: </b></dd>
                                            <dd> {{ $monthly_commission }} </dd>
                                            <dd> <b> Other Payment: </b></dd>
                                            <dd> {{ $monthly_other_payment }} </dd>
                                            <dd> <b> TA/DA: </b> </dd>
                                            <dd> {{ $total_transport_allowance }} </dd>

                                            <dd> <b> Lunch Allowance: </b></dd>
                                            <dd> {{ $lunch_bill_deduction }} </dd>
                                            <dd> <b> Mobile Bill: </b></dd>
                                            <dd> {{ $total_mobile_bill }} </dd>
                                            <dd> <b> Overtime: </b></dd>
                                            <dd> {{ $monthly_over_time_payment }} </dd>
                                            <dd> <b> Loan: </b></dd>
                                            <dd> {{ $monthly_loan }} </dd>
                                            <dd> <b> Statutory Deductions: </b></dd>
                                            <dd> @if (StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                                $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                                '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                                $previous_month_year)->exists())
                                                @php(
                                                $statutory_deductions =
                                                StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                                $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                                '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                                $previous_month_year)->pluck('statutory_deduc_amount')
                                                )
                                                @foreach ($statutory_deductions as $statutory_deductions_value)
                                                {{ $statutory_deduction_this_months = $statutory_deductions_value }}
                                                @endforeach
                                                @else
                                                {{ $statutory_deduction_this_months = 0 }}
                                                @endif</dd>
                                            <dd> <b> Provident Fund: </b></dd>
                                            <dd> {{ $monthly_provident_fund }} </dd>
                                            <dd> <b> Tax Deduction: </b></dd>
                                            <dd> {{ round($all_tax_deduction) }} </dd>

                                            <dd> <b> Net Salary: </b> </dd>
                                            <dd> {{ round($monthly_net_salary = $this_month_wise_basic_salary +
                                                $this_month_wise_house_rent + $this_month_wise_conveyance +
                                                $this_month_wise_medical + $festival_bonus_for_the_employee +
                                                $bonus_amount +
                                                $total_transport_allowance + $total_mobile_bill +
                                                $monthly_commission + $monthly_other_payment +
                                                $monthly_over_time_payment - $all_tax_deduction -
                                                $monthly_provident_fund
                                                - $monthly_loan - $statutory_deduction_this_month -
                                                $employee_late_cut_salary)}} </dd>

                                        </dl>
                                    </div>
                                </div>
                                @endif


                            </div>

                        </div>

                    </div>
                </div>
                <!-- Details Modal Ends -->
                @endif
                @endif
                @endforeach

            </tbody>

        </table>

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
