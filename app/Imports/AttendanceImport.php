<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Attendance;
use App\Models\MonthlyAttendance;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\OfficeShift;
use App\Models\OverTime;
use App\Models\Holiday;
use App\Models\Region;
use App\Models\Role;
use App\Models\AttendanceLocation;
use App\Models\LatetimeConfig;
use App\Models\LateTime;
use App\Models\Permission;
use App\Models\Travel;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Hash;
use Auth;
use DateTime;
use DB;


class AttendanceImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // $UNIX_DATE = ($row['attendance_date'] - 25569) * 86400;
        // echo $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
        //  $UNIX_CLOCK_IN_TIME = ($row['clock_in'] - 25569) * 86400;
        //  echo $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
        //  $UNIX_CLOCK_OUT_TIME = ($row['clock_out'] - 25569) * 86400;
        //  echo $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
        //  exit;

        if (User::where('com_id', Auth::user()->com_id)->where('company_assigned_id', $row['0'])->exists()) {

            //echo "ok" ; exit;
            $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
            //$current_date = request()->file('attendance_date');
            // $current_date = $date->format('Y-m-d');
            //$current_date = "2021-12-04";
            // $current_month = $date->format('m');
            // $current_year = $date->format('Y');
            //$current_date_number = $date->format('d');
            $current_time = $date->format('H:i:s');
            // $current_day_name = date('D', strtotime($current_date));

            $attendance_employee_id = User::where('com_id', Auth::user()->com_id)->where('company_assigned_id', $row['0'])->first('id');
            if ($row['1']) {
                $UNIX_DATE = ($row['1'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['2'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['3'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);


                ############################## overtime , late time early leave code ###################

                $current_day_name = date('D', strtotime($formatteddate));

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where('id', $attendance_employee_id->id)->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['4']) {
                $UNIX_DATE = ($row['4'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['5'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['6'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['7']) {
                $UNIX_DATE = ($row['7'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['8'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['9'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['10']) {
                $UNIX_DATE = ($row['10'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['11'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['12'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['13']) {
                $UNIX_DATE = ($row['13'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['14'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['15'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['16']) {
                $UNIX_DATE = ($row['16'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['17'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['18'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['18']) {
                $UNIX_DATE = ($row['19'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['20'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['21'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['22']) {
                $UNIX_DATE = ($row['22'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['23'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['24'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['25']) {
                $UNIX_DATE = ($row['25'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['26'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['27'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['28']) {
                $UNIX_DATE = ($row['28'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['29'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['30'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['31']) {
                $UNIX_DATE = ($row['31'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['32'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['33'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['34']) {
                $UNIX_DATE = ($row['34'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['35'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['36'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['37']) {
                $UNIX_DATE = ($row['37'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['38'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['39'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['40']) {
                $UNIX_DATE = ($row['40'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['41'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['42'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['43']) {
                $UNIX_DATE = ($row['43'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['44'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['45'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['46']) {
                $UNIX_DATE = ($row['46'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['47'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['48'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['49']) {
                $UNIX_DATE = ($row['49'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['50'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['51'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['52']) {
                $UNIX_DATE = ($row['52'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['53'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['54'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['55']) {
                $UNIX_DATE = ($row['55'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['56'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['57'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;

                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['58']) {
                $UNIX_DATE = ($row['58'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['59'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['60'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['61']) {
                $UNIX_DATE = ($row['61'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['62'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['63'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['64']) {
                $UNIX_DATE = ($row['64'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['65'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['66'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['67']) {
                $UNIX_DATE = ($row['67'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['68'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['69'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['70']) {
                $UNIX_DATE = ($row['70'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['71'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['72'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['73']) {
                $UNIX_DATE = ($row['73'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['74'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['75'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['76']) {
                $UNIX_DATE = ($row['76'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['77'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['78'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['79']) {
                $UNIX_DATE = ($row['79'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['80'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['81'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['82']) {
                $UNIX_DATE = ($row['82'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['83'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['84'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['85']) {
                $UNIX_DATE = ($row['85'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['86'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['87'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }

            if ($row['88']) {
                $UNIX_DATE = ($row['88'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['89'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['90'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            if ($row['91']) {
                $UNIX_DATE = ($row['91'] - 25569) * 86400;
                $formatteddate = gmdate("Y-m-d", $UNIX_DATE);
                $current_date = gmdate("Y-m-d", $UNIX_DATE);
                $current_month =
                    gmdate("m", $UNIX_DATE);
                $current_year =
                    gmdate("Y", $UNIX_DATE);
                $current_date_number =
                    gmdate("d", $UNIX_DATE);
                $UNIX_CLOCK_IN_TIME = ($row['92'] - 25569) * 86400;
                $formatted_clock_in_time = gmdate("H:i:s", $UNIX_CLOCK_IN_TIME);
                $UNIX_CLOCK_OUT_TIME = ($row['93'] - 25569) * 86400;
                $formatted_clock_out_time = gmdate("H:i:s", $UNIX_CLOCK_OUT_TIME);
                ############################## overtime , late time early leave code ###################
                $current_day_name = date(
                    'D',
                    strtotime($formatteddate)
                );

                $office_shift_details = User::where('id', $attendance_employee_id->id)->first('office_shift_id');

                //echo $office_shift_details->office_shift_id; exit;

                if ($current_day_name == "Sun") {

                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['sunday_in', 'sunday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->sunday_in;
                            $shift_out = $office_shifts->sunday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Mon") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['monday_in', 'monday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->monday_in;
                            $shift_out = $office_shifts->monday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Tue") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['tuesday_in', 'tuesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->tuesday_in;
                            $shift_out = $office_shifts->tuesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Wed") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['wednesday_in', 'wednesday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->wednesday_in;
                            $shift_out = $office_shifts->wednesday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Thu") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['thursday_in', 'thursday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->thursday_in;
                            $shift_out = $office_shifts->thursday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Fri") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['friday_in', 'friday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->friday_in;
                            $shift_out = $office_shifts->friday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } elseif ($current_day_name == "Sat") {
                    if (OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->exists()) {
                        $office_shifts_array = OfficeShift::where('id', $office_shift_details->office_shift_id)->where('office_shift_com_id', '=', Auth::user()->com_id)->get(['saturday_in', 'saturday_out']);
                        foreach ($office_shifts_array as $office_shifts) {
                            $shift_in = $office_shifts->saturday_in;
                            $shift_out = $office_shifts->saturday_out;
                        }
                    } else {
                        return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                    }
                } else {

                    return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
                }

                // echo json_encode($this->officeShift()); exit;

                ################ Seconds from shift start to end time of the day code starts from here ################################
                $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
                $company_shift_out_seconds = strtotime($shift_out) + 60 * 60;
                $diff_shift_seconds_for_the_day = $company_shift_out_seconds - $company_shift_in_seconds;
                ################ Seconds from shift start to end time of the day code ends here #######################################
                $payable_time = strtotime($shift_out) + 60 * 60;
                $payable_over_time_hour = date('H:i', $payable_time);
                ################ Late Time Countable Seconds code starts from here ####################################################
                $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
                $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
                $clock_in_time_in_seconds = strtotime($formatted_clock_in_time) + 60 * 60;
                ################ Late Time Countable Seconds code code ends here ######################################################


                if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $attendance_employee_id->id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                    ///return back()->with('message','You Have Taken A Leave For This Day!!!');
                    return;
                }

                if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $attendance_employee_id->id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $formatteddate . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->exists()) {

                    $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_employee_id->id)->where('late_time_date', $formatteddate)->first('id');

                    $late_time = LateTime::find($late_time_row_id->id);
                    $late_time->delete();
                }

                if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->exists()) {

                    $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_employee_id->id)->where('over_time_date', $formatteddate)->where('over_time_type', '=', 'Automatic')->first('id');

                    $over_time = OverTime::find($over_time_row_id->id);
                    $over_time->delete();
                }

                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $attendance_employee_id->id)->whereDate('attendance_date', '=', $formatteddate)->exists()) { //condition for travel aprovements
                    //return back()->with('message','You are not permitted to give attendance when you are on traveling!!!');
                    return;
                }

                ////////// Attandance check-in code Starts...


                $time_late = '';
                $overtime = '';
                $early_leaving = '';


                if (date_create($formatted_clock_in_time) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $time_late = date_create($shift_in)->diff(date_create($formatted_clock_in_time))->format('%H:%i:%s');

                        if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $attendance_employee_id->id;
                            $late_time->late_time_date = $formatteddate;
                            $late_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) >= date_create($payable_over_time_hour)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $overtime = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');

                        $todays_over_time = date_create($shift_out)->diff(date_create($formatted_clock_out_time))->format('%H:%i:%s');
                        if (User::where(
                            'id',
                            $attendance_employee_id->id
                        )->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->where('id', $attendance_employee_id->id)->exists()) {

                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $attendance_employee_id->id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $formatteddate;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
                if (date_create($formatted_clock_out_time) <= date_create($shift_out)) {
                    if ($shift_in != 0 && $shift_out != 0) {
                        $early_leaving = date_create($formatted_clock_out_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                    }
                }
                ############################## overtime , late time early leave code ###################
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $attendance_employee_id->id;
                $attendance->attendance_date = $formatteddate;
                $attendance->clock_in = $formatted_clock_in_time;
                $attendance->clock_out = $formatted_clock_out_time;
                $attendance->time_late = $time_late;
                $attendance->overtime = $overtime;
                $attendance->early_leaving = $early_leaving;
                $attendance->check_in_out = 1;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
            }
            ############################## Monthly Attendance Count Start ###################
            if (MonthlyAttendance::where('monthly_employee_id', $attendance_employee_id->id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $attendance_employee_id->id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();
                foreach ($monthly_attendance_employee_id as $monthly_attendance_employee_id_value) {

                    $monthly_attendance = MonthlyAttendance::find($monthly_attendance_employee_id_value->id);

                    if ($current_date_number == 1) {
                        $monthly_attendance->day_one = "P";
                    } elseif ($current_date_number == 2) {
                        $monthly_attendance->day_two = "P";
                    } elseif ($current_date_number == 3) {
                        $monthly_attendance->day_three = "P";
                    } elseif ($current_date_number == 4) {
                        $monthly_attendance->day_four = "P";
                    } elseif ($current_date_number == 5) {
                        $monthly_attendance->day_five = "P";
                    } elseif ($current_date_number == 6) {
                        $monthly_attendance->day_six = "P";
                    } elseif ($current_date_number == 7) {
                        $monthly_attendance->day_seven = "P";
                    } elseif ($current_date_number == 8) {
                        $monthly_attendance->day_eight = "P";
                    } elseif ($current_date_number == 9) {
                        $monthly_attendance->day_nine = "P";
                    } elseif ($current_date_number == 10) {
                        $monthly_attendance->day_ten = "P";
                    } elseif ($current_date_number == 11) {
                        $monthly_attendance->day_eleven = "P";
                    } elseif ($current_date_number == 12) {
                        $monthly_attendance->day_twelve = "P";
                    } elseif ($current_date_number == 13) {
                        $monthly_attendance->day_thirteen = "P";
                    } elseif ($current_date_number == 14) {
                        $monthly_attendance->day_fourteen = "P";
                    } elseif ($current_date_number == 15) {
                        $monthly_attendance->day_fifteen = "P";
                    } elseif ($current_date_number == 16) {
                        $monthly_attendance->day_sixteen = "P";
                    } elseif ($current_date_number == 17) {
                        $monthly_attendance->day_seventeen = "P";
                    } elseif ($current_date_number == 18) {
                        $monthly_attendance->day_eighteen = "P";
                    } elseif ($current_date_number == 19) {
                        $monthly_attendance->day_nineteen = "P";
                    } elseif ($current_date_number == 20) {
                        $monthly_attendance->day_twenty = "P";
                    } elseif ($current_date_number == 21) {
                        $monthly_attendance->day_twenty_one = "P";
                    } elseif ($current_date_number == 22) {
                        $monthly_attendance->day_twenty_two = "P";
                    } elseif ($current_date_number == 23) {
                        $monthly_attendance->day_twenty_three = "P";
                    } elseif ($current_date_number == 24) {
                        $monthly_attendance->day_twenty_four = "P";
                    } elseif ($current_date_number == 25) {
                        $monthly_attendance->day_twenty_five = "P";
                    } elseif ($current_date_number == 26) {
                        $monthly_attendance->day_twenty_six = "P";
                    } elseif ($current_date_number == 27) {
                        $monthly_attendance->day_twenty_seven = "P";
                    } elseif ($current_date_number == 28) {
                        $monthly_attendance->day_twenty_eight = "P";
                    } elseif ($current_date_number == 29) {
                        $monthly_attendance->day_twenty_nine = "P";
                    } elseif ($current_date_number == 30) {
                        $monthly_attendance->day_thirty = "P";
                    } elseif ($current_date_number == 31) {
                        $monthly_attendance->day_thirty_one = "P";
                    } else {
                        return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                    }

                    $monthly_attendance->save();
                }
            } else {

                $monthly_attendance = new MonthlyAttendance();
                $monthly_attendance->monthly_com_id = Auth::user()->com_id;
                $monthly_attendance->monthly_employee_id = $attendance_employee_id->id;
                $monthly_attendance->attendance_month = $current_date;
                $monthly_attendance->attendance_year = $current_date;
                if ($current_date_number == 1) {
                    $monthly_attendance->day_one = "P";
                } elseif ($current_date_number == 2) {
                    $monthly_attendance->day_two = "P";
                } elseif ($current_date_number == 3) {
                    $monthly_attendance->day_three = "P";
                } elseif ($current_date_number == 4) {
                    $monthly_attendance->day_four = "P";
                } elseif ($current_date_number == 5) {
                    $monthly_attendance->day_five = "P";
                } elseif ($current_date_number == 6) {
                    $monthly_attendance->day_six = "P";
                } elseif ($current_date_number == 7) {
                    $monthly_attendance->day_seven = "P";
                } elseif ($current_date_number == 8) {
                    $monthly_attendance->day_eight = "P";
                } elseif ($current_date_number == 9) {
                    $monthly_attendance->day_nine = "P";
                } elseif ($current_date_number == 10) {
                    $monthly_attendance->day_ten = "P";
                } elseif ($current_date_number == 11) {
                    $monthly_attendance->day_eleven = "P";
                } elseif ($current_date_number == 12) {
                    $monthly_attendance->day_twelve = "P";
                } elseif ($current_date_number == 13) {
                    $monthly_attendance->day_thirteen = "P";
                } elseif ($current_date_number == 14) {
                    $monthly_attendance->day_fourteen = "P";
                } elseif ($current_date_number == 15) {
                    $monthly_attendance->day_fifteen = "P";
                } elseif ($current_date_number == 16) {
                    $monthly_attendance->day_sixteen = "P";
                } elseif ($current_date_number == 17) {
                    $monthly_attendance->day_seventeen = "P";
                } elseif ($current_date_number == 18) {
                    $monthly_attendance->day_eighteen = "P";
                } elseif ($current_date_number == 19) {
                    $monthly_attendance->day_nineteen = "P";
                } elseif ($current_date_number == 20) {
                    $monthly_attendance->day_twenty = "P";
                } elseif ($current_date_number == 21) {
                    $monthly_attendance->day_twenty_one = "P";
                } elseif ($current_date_number == 22) {
                    $monthly_attendance->day_twenty_two = "P";
                } elseif ($current_date_number == 23) {
                    $monthly_attendance->day_twenty_three = "P";
                } elseif ($current_date_number == 24) {
                    $monthly_attendance->day_twenty_four = "P";
                } elseif ($current_date_number == 25) {
                    $monthly_attendance->day_twenty_five = "P";
                } elseif ($current_date_number == 26) {
                    $monthly_attendance->day_twenty_six = "P";
                } elseif ($current_date_number == 27) {
                    $monthly_attendance->day_twenty_seven = "P";
                } elseif ($current_date_number == 28) {
                    $monthly_attendance->day_twenty_eight = "P";
                } elseif ($current_date_number == 29) {
                    $monthly_attendance->day_twenty_nine = "P";
                } elseif ($current_date_number == 30) {
                    $monthly_attendance->day_thirty = "P";
                } elseif ($current_date_number == 31) {
                    $monthly_attendance->day_thirty_one = "P";
                } else {
                    return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                }

                 $monthly_attendance->day_one = "P";

                $monthly_attendance->save();
            }

            ############################## Monthly Attendance Count End ###################
            return;
        }
    }
}