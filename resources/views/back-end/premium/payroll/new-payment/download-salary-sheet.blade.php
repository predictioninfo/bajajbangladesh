<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table td {
            line-height: 25px;
            padding-left: 15px;
            border: 1px solid black;
        }

        table th {
            background-color: #fbc403;
            color: #363636;
            border: 1px solid black;
        }
    </style>
    <?php
    use App\Models\BankAccount;

    ?>
</head>

<body>
    <section class="main-contant-section">

        <?php

        use App\Models\Attendance;
        use App\Models\Holiday;
        use App\Models\Leave;
        use App\Models\Loan;
        use App\Models\FestivalBonus;
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


        <div class="table-responsive mt-4">
            <table id="user-table" class="table table-bordered table-hover table-striped"
                style="margin-left:-10%;margin-right:-10%;">
                <thead style="background-color:#00695c; color:white;">
                    <tr>
                        <th>SL</th>
                        <th>Employee</th>
                        <th>Employee ID</th>
                        <th>Joining Date</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Salary Type</th>
                        <th>Gross Salary</th>
                        <th>Basic Salary</th>
                        <th>Total Working Hour</th>
                        <th>Per Hour Rate</th>
                        <th>House Rent</th>
                        <th>Medical</th>
                        <th>Conveyance</th>
                        <th>Festival Bonus</th>
                        <th>Net Overtime</th>
                        <th>Commission</th>
                        <th>Other Payment</th>
                        <th>Tax Per Month</th>
                        <th>Loan</th>
                        <th>PF Contribution</th>
                        <th>Statutory Deduction</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Working Days</th>
                        <th>Late Time Days</th>
                        <th>Late Time Salary Deduction</th>
                        <th>Lunch Allowance</th>
                        <th>Mobile Bill</th>
                        <th>TA/DA</th>
                        <th>Net Salary</th>
                        {{--
                        <th>OT Rate(2 Times)</th>
                        <th>OT Hour</th>
                        <th>Total OT</th>
                        <th>Night Shift Allowance</th>
                        <th>Night Shift Days</th>
                        <th>Total Night Shift Pay</th>
                        --}}
                        <th>Payroll Charge</th>
                        {{--<th>Insurance</th>--}}
                        <th>Tax</th>
                        <th>CTC(Cost To Company)</th>
                        <th>Exchange Risk</th>
                        <th>Total Payable</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @php($j = 1)
                    @php($total_tax_deduction=0)
                    @php($total_net_salary=0)
                    @php($total_payroll_charge=0)
                    @php($total_payable_amount=0)
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

                                    $late_time_salary_cut_days =0;
                                    $late_time_salary_cut_days = intval($total_days_from_late_count_array / $minimum_countable_late_config_days->minimum_countable_day);

                                    //late_time_salary_cut_days end
                                    // for ($a = 1; $a <= $total_days_from_late_count_array; $a++) {
                                    //     if ($a % $minimum_countable_late_config_days->minimum_countable_day == 0) {
                                    //         $countable_late_days += 1;
                                    //     }
                                    // }
                                    for ($a = 1; $a <= $total_days_from_late_count_array; $a++) {
                                    $late_days += 1;
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

                                                    $start_date_joining_date_wise = date('d', strtotime($$new_payments_value->joining_date));
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

                                $employee_basic_salary_percentage_wise = ($new_payments_value->gross_salary * $new_payments_value->salary_config_basic_salary) / 100; //basic salary after deducting 60 percent

                                ?>
                    @if ($all_attendances_of_the_month != 0)
                    <tr>

                        <?php

                                        //echo $total_working_days;

                                        $employee_per_day_gross_salary = $new_payments_value->gross_salary / $total_number_of_days_of_the_month;

                                        $this_month_wise_gross_salary = $employee_per_day_gross_salary * $total_working_days;

                                        $employee_per_day_basic_salary = (($new_payments_value->gross_salary * $new_payments_value->salary_config_basic_salary)
                                        / 100) /$total_number_of_days_of_the_month;

                                        $employee_late_cut_salary = 0;
                                        if($late_time_salary_config->late_time_salary_config == "Basic"){
                                        $employee_late_cut_salary = $employee_per_day_basic_salary * $late_time_salary_cut_days;
                                        }elseif ($late_time_salary_config->late_time_salary_config == "Gross") {
                                        $employee_late_cut_salary = $employee_per_day_gross_salary * $late_time_salary_cut_days;
                                        }

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

                                            //$yearly_total_gross_salary = 45833*12; //this month wise yearly gross salary

                                            $house_rent_non_taxable_minimum_range_yearly = 300000; //house-rent non taxable minimum range
                                            $medical_allowance_non_taxable_minimum_range_yearly = 120000; //medical allowance non taxable minimum range
                                            $conveyance_allowance_non_taxable_minimum_range_yearly = 30000; //convayance allowance non taxable minimum range

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
                                            $taxable_yearly_gross_salary = $yearly_total_gross_salary - $deductable_total_yearly_house_rent_and_allowances + $taxable_total_yearly_house_rent_and_allowances;

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
                                            $this_month_wise_yearly_gross_salary = ($monthly_festival_bonus + $monthly_commission + $monthly_provident_fund + $monthly_other_payment + $monthly_over_time_payment) * 12 + $taxable_yearly_gross_salary; ///yearly gross salary with all additions

                                            $gross_salary = $this_month_wise_yearly_gross_salary;

                                            if ($tax_configs_value->minimum_salary <= $gross_salary) {
                                                if ($gross_salary < $tax_configs_value->maximum_salary) {
                                                    $taxable_salary = $gross_salary - $tax_configs_value->minimum_salary;
                                                } else {
                                                    $taxable_salary = $tax_configs_value->maximum_salary - $tax_configs_value->minimum_salary;
                                                }

                                                $tax_deduction_percentage = $taxable_salary * $tax_configs_value->tax_percentage;

                                                $taxable_salary = $tax_configs_value->minimum_salary;

                                                $tax_deduction = $tax_deduction_percentage / 100;

                                                $previous_deducted_salary_tax += $tax_deduction;
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
                                        if ($tax_deduction_amount >= 1 && $tax_deduction_amount <= $minimum_tax_config->minimum_tax_config_amount) {
                                            $all_tax_deduction = $minimum_tax_config->minimum_tax_config_amount;
                                        } else {
                                            $all_tax_deduction = $tax_deduction_amount;
                                        }

                                        //echo  $all_tax_deduction;
                                        ######### tax configuring code for 0 to Minimum tax amount ends here ##############

                                        ?>


                        <?php
                                        $bank_accounts = BankAccount::where('bank_account_com_id', Auth::user()->com_id)
                                            ->where('bank_account_employee_id', $new_payments_value->monthly_employee_id)
                                            ->first();
                                    $total_transport_allowance = $all_attendances_of_the_month * $new_payments_value->transport_allowance + 0;
                                    $total_mobile_bill = $new_payments_value->mobile_bill + 0;


                                    if (Loan::where('loans_employee_id', '=',
                                    $new_payments_value->monthly_employee_id)->where('loans_remaining_installments', '>',
                                    0)->exists()){

                                    $employee_loan = Loan::where('loans_employee_id', '=',
                                    $new_payments_value->monthly_employee_id)->where('loans_remaining_installments', '>',
                                    0)->get(['loans_remaining_amount', 'loans_remaining_installments']);

                                    foreach ($employee_loan as $employee_loan_value){
                                     $monthly_loan =
                                    $employee_loan_value->loans_remaining_amount /
                                    $employee_loan_value->loans_remaining_installments;
                                    }
                                    }
                                    else{
                                     $monthly_loan = 0;
                                    }



                                    $statutory_deduction_this_month = 0;

                                    if (StatutoryDeduction::where('statutory_deduc_employee_id', '=',
                                    $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                    '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                    $previous_month_year)->exists()){

                                    $statutory_deductions = StatutoryDeduction::where('statutory_deduc_employee_id',
                                    '=',
                                    $new_payments_value->monthly_employee_id)->whereMonth('statutory_deduc_month_year',
                                    '=', $last_month)->whereYear('statutory_deduc_month_year', '=',
                                    $previous_month_year)->pluck('statutory_deduc_amount');

                                    foreach ($statutory_deductions as $statutory_deductions_value){
                                    $statutory_deduction_this_month += $statutory_deductions_value;
                                    }
                                    }


                                    if(Lunch::where('lunch_com_id', Auth::user()->com_id)->where('lunch_emp_id',$new_payments_value->monthly_employee_id)->whereMonth('lunch_month_year',$last_month)->whereYear('lunch_month_year',$previous_month_year)->exists()){

                                   $lunch_bill_deduction = Lunch::where('lunch_com_id',Auth::user()->com_id)->where('lunch_emp_id',$new_payments_value->monthly_employee_id)->whereMonth('lunch_month_year',$last_month)->whereYear('lunch_month_year',$previous_month_year)->pluck('lunch_bill');

                                   }else{
                                    $lunch_bill_deduction = 0;
                                   }



                                     if ($new_payments_value->salary_type == 'Monthly'){

                                      $monthly_net_salary = $this_month_wise_basic_salary + $this_month_wise_house_rent + $this_month_wise_conveyance + $this_month_wise_medical + $festival_bonus_for_the_employee + $total_transport_allowance + $total_mobile_bill + $monthly_commission + $monthly_other_payment + $monthly_over_time_payment - $all_tax_deduction - $monthly_provident_fund - $monthly_loan - $statutory_deduction_this_month-$lunch_bill_deduction;
                                     }


                                    if($new_payments_value->salary_type == 'Hourly'){
                                     $monthly_net_salary = number_format((float) $totalHourlySalary, 2, '.', '');
                                    }


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
                        <?php
                                 if(IncrementSalaryHistory::where('emp_id',
                                $new_payments_value->monthly_employee_id)->first()){


                                            $incrementData = IncrementSalaryHistory::where('inc_sal_his_com_id', Auth::user()->com_id)
                                                ->where('emp_id', $new_payments_value->monthly_employee_id)
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
                                            $totalWorkingDays = $probitionTotalWorkingDays + $daysPreviousBetween;

                                        }
                                elseif(User::where('id',
                                $new_payments_value->monthly_employee_id)->where('is_active' ,
                                1)->whereNotNull('active_date')->first()){


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
                                         $netSalary =$totalSalary;
                                       }if(User::where('id', $request->pay_slip_employee_id)->whereNotNull('inactive_date')->first()){


                                    $userInactiveDate = User::where('com_id', Auth::user()->com_id)
                                    ->where('id', $request->pay_slip_employee_id)
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
                                    $data = Holiday::where('holiday_com_id', Auth::user()->com_id)
                                    ->where('holiday_type', 'Weekly-Holiday')
                                    ->where('holiday_name', [$holiday])
                                    ->get();
                                    if (!$data->isEmpty()) {
                                    $holidayData = array_merge($holidayData, $data->toArray());
                                    }
                                    }

                                    $holidayDataCount = count($holidayData);

                                    //attandance weekend holiday count end

                                    //attandance other-holiday count start

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
                                    if ($activeMonthstartDate <= $holidaysEndDate && $activMonthLastDate>= $holidaysEndDate) {
                                        // Find the start and end dates of the overlapping period
                                        $overlapStartDate = max($activeMonthstartDate, $holidaysStartDate);
                                        $overlapEndDate = min($activMonthLastDate, $holidaysEndDate);

                                        // Calculate the number of overlapping days
                                        $duration = $overlapStartDate->diff($overlapEndDate);
                                        $overlappingDays += $duration->days + 1;
                                        }
                                        }

                                        //attandance other-holiday count end

                                        // Leave Attendence Count Start

                                        $leaves = Leave::where('leaves_employee_id', $request->pay_slip_employee_id)->where('leaves_status',
                                        'Approved')->get();
                                        $overlappingLeaveDays = 0;
                                        foreach ($leaves as $leave) {
                                        $leaveStartDate = Carbon::parse($leave->leaves_start_date);
                                        $leaveEndDate = Carbon::parse($leave->leaves_end_date);

                                        // Check if the probation period overlaps with the holiday period
                                        if ($activeMonthstartDate <= $leaveEndDate && $activMonthLastDate>= $leaveStartDate) {
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
                                            $data = Attendance::where('employee_id', $request->pay_slip_employee_id)
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
                                            $totalWorkingDays = $totalAttendanceCount + $holidayDataCount + $overlappingDays + $overlappingLeaveDays;
                                            // probition working days count end
                                            // probition previous salary count start
                                            $totalSalary = ($userInactiveDate->gross_salary / $previousDayOfMonth) * $totalWorkingDays;
                                            $netSalary = $totalSalary;
                                            }else{
                                            $totalWorkingDays = $total_working_days;
                                            $netSalary = $monthly_net_salary;
                                       }
                                    ?>


                        <td>{{$j++}}</td>
                        <td>{{$new_payments_value->first_name." ".$new_payments_value->last_name}}</td>
                        <td>{{$new_payments_value->company_assigned_id}}</td>
                        <td>{{$new_payments_value->joining_date}}</td>
                        <td>{{$new_payments_value->department_name}}</td>
                        <td>{{$new_payments_value->designation_name}}</td>
                        <td>{{$new_payments_value->salary_type}}</td>
                        <td>{{$new_payments_value->gross_salary}}</td>
                        <td>{{($new_payments_value->gross_salary * $new_payments_value->salary_config_basic_salary) /
                            100}}</td>
                        <td>{{ $sum_total_hours }} </td>
                        <td>{{$new_payments_value->per_hour_rate ?? 0}}</td>
                        <td>{{($new_payments_value->gross_salary *
                            $new_payments_value->salary_config_house_rent_allowance) /
                            100}}</td>
                        <td>{{($new_payments_value->gross_salary * $new_payments_value->salary_config_medical_allowance)
                            / 100}}
                        </td>
                        <td>{{($new_payments_value->gross_salary *
                            $new_payments_value->salary_config_conveyance_allowance) /
                            100}}</td>
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
                        <td>{{$monthly_over_time_payment ?? 0 }}</td>
                        <td>{{$monthly_commission ?? 0}}</td>
                        <td>{{$monthly_other_payment ?? 0 }}</td>
                        <td>{{number_format((float) $all_tax_deduction, 2, '.', '')}}</td>
                        <td>{{ $monthly_loan ?? 0}}</td>
                        <td>{{$monthly_provident_fund ?? 0}}</td>
                        <td>{{$statutory_deductions ?? 0}}</td>
                        <td>{{date("F", strtotime($new_payments_value->attendance_month))}}</td>
                        <td>{{date('Y', strtotime($new_payments_value->attendance_month))}}</td>
                        <td>{{ $totalWorkingDays}}</td>
                        <td>{{$late_days ?? 0}}</td>
                        <td>{{$employee_late_cut_salary ?? 0}}</td>
                        <td>{{$lunch_bill_deduction}}</td>
                        <td>{{$new_payments_value->mobile_bill}}</td>
                        <td>{{$total_transport_allowance ?? 0}}</td>
                        <td>{{ $netSalary = number_format((float)($netSalary+$bonus_amount)-$employee_late_cut_salary,
                            2, '.', '')}}</td>
                        <td>@php ($payroll_charge = ($netSalary*15)/100) {{number_format((float)$payroll_charge, 2, '.',
                            '')}}
                        </td>

                        @php ($insurance = 0)
                        <td>@php ($tax_on_payrol_charge = ((($payroll_charge*10)/100) + $netSalary + $payroll_charge +
                            $insurance)*1.5/100) {{number_format((float)$tax_on_payrol_charge, 2, '.', '')}}</td>
                        <td>@php($total_ctc = $netSalary + $payroll_charge + $insurance +
                            $tax_on_payrol_charge){{number_format((float)$total_ctc, 2, '.', '')}}</td>

                        <td>{{$exchange_risk = 365.42}}</td>

                        <td>@php($total_payable = $total_ctc + $exchange_risk){{number_format((float)$total_payable, 2,
                            '.',
                            '')}}
                        </td>


                    </tr>

                    @php($total_tax_deduction += $all_tax_deduction)
                    @php($total_net_salary += $netSalary)
                    @php($total_payroll_charge += $payroll_charge)
                    @php($total_payable_amount += $total_payable)


                    @endif
                    @endif


                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold;">{{number_format((float)$total_tax_deduction, 2, '.', '')}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold;"> {{number_format((float)$total_net_salary, 2, '.', '')}}</td>
                        <td style="font-weight: bold;"> {{number_format((float)$total_payroll_charge, 2, '.', '')}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-weight: bold;"> {{number_format((float)$total_payable_amount, 2, '.', '')}}</td>

                    </tr>
                </tbody>

            </table>

        </div>
        </div>
    </section>

</body>

</html>