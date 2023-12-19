<?php

namespace App\Http\Traits;
use App\Models\OfficeShift;
use Illuminate\Http\Request;
use Auth;
use DateTime;

trait DayWiseOfficeShift {
    public function officeShift() {
        // Fetch all the students from the 'student' table.
        // $student = Student::all();
        // return view('welcome')->with(compact('student'));

        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka') );
        $current_date = $date->format('Y-m-d');
        $current_day_name = date('D', strtotime($current_date));

        if($current_day_name == "Sun"){
            $office_shifts = OfficeShift::where('office_shift_com_id','=',Auth::user()->com_id)->first(['sunday_in', 'sunday_out']);
            $shift_in = $office_shifts->sunday_in;
            $shift_out = $office_shifts->sunday_out;
        }elseif($current_day_name == "Mon"){
            $office_shifts = OfficeShift::where('office_shift_com_id','=',Auth::user()->com_id)->first(['monday_in', 'monday_out']);
            $shift_in = $office_shifts->monday_in;
            $shift_out = $office_shifts->monday_out;
        }elseif($current_day_name == "Tue"){
            $office_shifts = OfficeShift::where('office_shift_com_id','=',Auth::user()->com_id)->first(['tuesday_in', 'tuesday_out']);
            $shift_in = $office_shifts->tuesday_in;
            $shift_out = $office_shifts->tuesday_out;
        }elseif($current_day_name == "Wed"){
            $office_shifts = OfficeShift::where('office_shift_com_id','=',Auth::user()->com_id)->first(['wednesday_in', 'wednesday_out']);
            $shift_in = $office_shifts->wednesday_in;
            $shift_out = $office_shifts->wednesday_out;
        }elseif($current_day_name == "Thu"){
            $office_shifts = OfficeShift::where('office_shift_com_id','=',Auth::user()->com_id)->first(['thursday_in', 'thursday_out']);
            $shift_in = $office_shifts->thursday_in;
            $shift_out = $office_shifts->thursday_out;
        }elseif($current_day_name == "Fri"){
            $office_shifts = OfficeShift::where('office_shift_com_id','=',Auth::user()->com_id)->first(['friday_in', 'friday_out']);
            $shift_in = $office_shifts->friday_in;
            $shift_out = $office_shifts->friday_out;
        }elseif($current_day_name == "Sat"){
            $office_shifts = OfficeShift::where('office_shift_com_id','=',Auth::user()->com_id)->first(['saturday_in', 'saturday_out']);
            $shift_in = $office_shifts->saturday_in;
            $shift_out = $office_shifts->saturday_out;
        }else{
            $shift_in = 0;
            $shift_out = 0;
        }
        // return([
        //     'shift_in' => $shift_in,
        // ]);
        return;

    }
}