<?php

$attendance_counts = Attendance::where('employee_id','=',$new_payments_value->monthly_employee_id)
                                    ->whereMonth('attendance_date', '=',$last_month)
                                    ->whereYear('attendance_date', '=',$previous_month_year)
                                    ->where('check_in_out', '=',1)
                                    ->get();
    $all_attendances_of_the_month = $attendance_counts->count();







    if($sub_total_working_days > $total_number_of_days_of_the_month){
        $total_working_days = $total_number_of_days_of_the_month;
    }elseif ($sub_total_working_days < 1) {
        $total_working_days = 0;
    }else{
        $total_working_days = $sub_total_working_days;
    }
