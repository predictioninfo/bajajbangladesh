
<?php

############################################### attendance count code starts################################
$attendance_counts = Attendance::where('employee_id', '=', $new_payments_value->monthly_employee_id)
    ->whereMonth('attendance_date', '=', $last_month)
    ->whereYear('attendance_date', '=', $previous_month_year)
    ->where('check_in_out', '=', 1)
    ->get();
