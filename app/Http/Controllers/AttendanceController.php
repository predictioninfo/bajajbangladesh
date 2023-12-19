<?php

namespace App\Http\Controllers;

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
use App\Imports\AttendanceImport;
use App\Exports\AttendanceExport;
use App\Exports\DateWiseAttendanceExport;

use Illuminate\Http\Request;
use Auth;
use DB;
use DateTime;
use Excel;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function addAttendanceEmployeeDateWise(Request $request)
    {

        $validated = $request->validate([
            'attendance_date' => 'required',
            'employee_id' => 'required',
        ]);

        //$date = new DateTime("now", new \DateTimeZone('Asia/Dhaka') );
        $current_date = $request->attendance_date;

        $current_day_name = date('D', strtotime($request->attendance_date));

        $office_shift_details = User::where('id', $request->employee_id)->first('office_shift_id');

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
        $clock_in_time_in_seconds = strtotime($request->clock_in) + 60 * 60;
        ################ Late Time Countable Seconds code code ends here ######################################################


        if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->employee_id)->where(function ($query) {
            $query->where('is_half', 0)
                ->orWhereNull('is_half');
        })
            ->where('leaves_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()
        ) { //condition for leave aprovements

            return back()->with('message', 'You Have Taken A Leave For This Day!!!');
        }

        if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements

            return back()->with('message', 'You are not permitted to give attendance when you are on traveling!!!');
        }

        if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->where('holiday_name', '=', $current_day_name)->exists()) {
            return back()->with('message', 'You are not permitted to give your attendane on hoilday!!!');
        }
        if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereRaw('"' . $current_date . '" between `start_date` and `end_date`')->exists()) {
            return back()->with('message', 'You are not permitted to give your attendane on hoilday!!!');
        }

        if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $request->employee_id)->where('late_time_date', $request->attendance_date)->exists()) {

            $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $request->employee_id)->where('late_time_date', $request->attendance_date)->first('id');

            $late_time = LateTime::find($late_time_row_id->id);
            $late_time->delete();
        }

        if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $request->employee_id)->where('over_time_date', $request->attendance_date)->where('over_time_type', '=', 'Automatic')->exists()) {

            $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $request->employee_id)->where('over_time_date', $request->attendance_date)->where('over_time_type', '=', 'Automatic')->first('id');

            $over_time = OverTime::find($over_time_row_id->id);
            $over_time->delete();
        }

        if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $request->employee_id)->whereDate('attendance_date', $request->attendance_date)->exists()) { //condition for travel aprovements
            return back()->with('message', 'You already gave your attendance!!!');
        }

        $attendance = new Attendance();
        $attendance->attendance_com_id = Auth::user()->com_id;
        $attendance->employee_id = $request->employee_id;
        $attendance->attendance_date = $request->attendance_date;
        if ($request->clock_in) {
            $attendance->clock_in = $request->clock_in;
            // $attendance->check_in_latitude = $request->lat;
            // $attendance->check_in_longitude = $request->longt;
            //$attendance->check_in_ip = $local_server_ip;
            if (date_create($request->clock_in) >= date_create($shift_in)) {
                if ($shift_in != 0 && $shift_out != 0) {

                    $attendance->time_late = date_create($shift_in)->diff(date_create($request->clock_in))->format('%H:%i:%s');

                    if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {

                        if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $request->attendance_date)->exists()) {

                            $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $request->attendance_date)->get('id');

                            foreach ($late_times as $late_times_value) {

                                $late_time = LateTime::find($late_times_value->id);
                                $late_time->late_time_com_id = Auth::user()->com_id;
                                $late_time->late_time_employee_id = $request->employee_id;
                                $late_time->late_time_date = $request->attendance_date;
                                $late_time->save();
                            }
                        } else {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $request->employee_id;
                            $late_time->late_time_date = $request->attendance_date;
                            $late_time->save();
                        }
                    }
                }
            }
        }

        if ($request->clock_out) {

            $attendance->clock_out = $request->clock_out;
            if (date_create($request->clock_out) >= date_create($payable_over_time_hour)) {
                if ($shift_in != 0 && $shift_out != 0) {
                    $attendance->overtime = date_create($shift_out)->diff(date_create($request->clock_out))->format('%H:%i:%s');

                    $todays_over_time = date_create($shift_out)->diff(date_create($request->clock_out))->format('%H:%i:%s');
                    if (User::where('id', $request->employee_id)->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $request->employee_id)->where('id', $request->employee_id)->where('id', $request->employee_id)->exists()) {
                        if (OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $request->attendance_date)->exists()) {

                            $over_times = OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $request->attendance_date)->get('id');

                            foreach ($over_times as $over_times_value) {

                                $over_time = OverTime::find($over_times_value->id);
                                $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                $over_time->save();
                            }
                        } else {
                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $request->employee_id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $request->attendance_date;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
            }
            if (date_create($request->clock_out) <= date_create($shift_out)) {
                if ($shift_in != 0 && $shift_out != 0) {
                    $attendance->early_leaving = date_create($request->clock_out)->diff(date_create($shift_out))->format('%H:%i:%s');
                }
            }
        }

        //$attendance->check_in_out = 0;
        $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
        $attendance->check_in_out = 1;
        $attendance->attendance_status = "Present";
        $attendance->save();

        ########################### MONTHLY ATTENDANCE CODE STARTS #########################################

        $current_date_number = date("d", strtotime($request->attendance_date));
        $attendance_month = date("m", strtotime($request->attendance_date));
        $attendance_year = date("Y", strtotime($request->attendance_date));

        if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $attendance_month)->whereYear('attendance_year', '=', $attendance_year)->exists()) {

            $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $attendance_month)->whereYear('attendance_year', '=', $attendance_year)->get();

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
            $monthly_attendance->monthly_employee_id = $request->employee_id;
            $monthly_attendance->attendance_month = $request->attendance_date;
            $monthly_attendance->attendance_year = $request->attendance_date;
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

        ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


        return back()->with('message', 'Added Successfully');
    }

    public function updateAttendanceEmployeeDateWise(Request $request)
    {

        $validated = $request->validate([
            'attendance_date' => 'required',
            'employee_id' => 'required',
        ]);

        //$date = new DateTime("now", new \DateTimeZone('Asia/Dhaka') );
        $current_date = $request->attendance_date;

        $current_day_name = date('D', strtotime($request->attendance_date));

        $office_shift_details = User::where('id', $request->employee_id)->first('office_shift_id');

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
        $clock_in_time_in_seconds = strtotime($request->clock_in) + 60 * 60;
        ################ Late Time Countable Seconds code code ends here ######################################################

        if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->employee_id)->where(function ($query) {
            $query->where('is_half', 0)
                ->orWhereNull('is_half');
        })
            ->where('leaves_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()
        ) { //condition for leave aprovements

            return back()->with('message', 'You Have Taken A Leave For This Day!!!');
        }

        if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements

            return back()->with('message', 'You are not permitted to give attendance when you are on traveling!!!');
        }

        if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->where('holiday_name', '=', $current_day_name)->exists()) {
            return back()->with('message', 'You are not permitted to give your attendane on hoilday!!!');
        }
        if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereRaw('"' . $current_date . '" between `start_date` and `end_date`')->exists()) {
            return back()->with('message', 'You are not permitted to give your attendane on hoilday!!!');
        }

        if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $request->employee_id)->where('late_time_date', $request->attendance_date)->exists()) {

            $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $request->employee_id)->where('late_time_date', $request->attendance_date)->first('id');

            $late_time = LateTime::find($late_time_row_id->id);
            $late_time->delete();
        }

        if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $request->employee_id)->where('over_time_date', $request->attendance_date)->where('over_time_type', '=', 'Automatic')->exists()) {

            $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $request->employee_id)->where('over_time_date', $request->attendance_date)->where('over_time_type', '=', 'Automatic')->first('id');

            $over_time = OverTime::find($over_time_row_id->id);
            $over_time->delete();
        }


        if ($request->clock_in) {

            ////////// Attandance check-in code Starts...

            $attendance = Attendance::find($request->id);
            $attendance->clock_in = $request->clock_in;
            if (date_create($request->clock_in) >= date_create($shift_in)) {
                if ($shift_in != 0 && $shift_out != 0) {

                    $attendance->time_late = date_create($shift_in)->diff(date_create($request->clock_in))->format('%H:%i:%s');

                    if ($clock_in_time_in_seconds >= $office_late_time_config_in_seconds) {

                        if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $request->attendance_date)->exists()) {

                            $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $request->attendance_date)->get('id');

                            foreach ($late_times as $late_times_value) {

                                $late_time = LateTime::find($late_times_value->id);
                                $late_time->late_time_com_id = Auth::user()->com_id;
                                $late_time->late_time_employee_id = $request->employee_id;
                                $late_time->late_time_date = $request->attendance_date;
                                $late_time->save();
                            }
                        } else {
                            $late_time = new LateTime();
                            $late_time->late_time_com_id = Auth::user()->com_id;
                            $late_time->late_time_employee_id = $request->employee_id;
                            $late_time->late_time_date = $request->attendance_date;
                            $late_time->save();
                        }
                    }
                }
            }
            $attendance->save();

            ////////// Attandance check-in code Ends...

        }

        if ($request->clock_out) {

            ////////// Attandance checkout code Starts...

            $attendance = Attendance::find($request->id);
            $attendance->clock_out = $request->clock_out;
            if (date_create($request->clock_out) >= date_create($payable_over_time_hour)) {
                if ($shift_in != 0 && $shift_out != 0) {
                    $attendance->overtime = date_create($shift_out)->diff(date_create($request->clock_out))->format('%H:%i:%s');

                    $todays_over_time = date_create($shift_out)->diff(date_create($request->clock_out))->format('%H:%i:%s');
                    if (User::where('id', $request->employee_id)->where('over_time_payable', '=', 'Yes')->where('user_over_time_type', '=', 'Automatic')->exists() && User::where('id', $request->employee_id)->where('id', $request->employee_id)->where('id', $request->employee_id)->exists()) {

                        if (OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $request->attendance_date)->exists()) {

                            $over_times = OverTime::where('over_time_employee_id', $request->employee_id)->where('over_time_date', $request->attendance_date)->get('id');

                            foreach ($over_times as $over_times_value) {

                                $over_time = OverTime::find($over_times_value->id);
                                $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                $over_time->save();
                            }
                        } else {
                            $over_time = new OverTime();
                            $over_time->over_time_com_id = Auth::user()->com_id;
                            $over_time->over_time_employee_id = $request->employee_id;
                            $over_time->over_time_type = "Automatic";
                            $over_time->over_time_date = $request->attendance_date;
                            $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                            $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                            $over_time->over_time_rate = Auth::user()->user_over_time_rate;
                            $over_time->save();
                        }
                    }
                }
            }
            if (date_create($request->clock_out) <= date_create($shift_out)) {
                if ($shift_in != 0 && $shift_out != 0) {
                    $attendance->early_leaving = date_create($request->clock_out)->diff(date_create($shift_out))->format('%H:%i:%s');
                }
            }
            $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
            $attendance->save();

            ////////// Attandance checkout code Ends...

        }

        return back()->with('message', 'Updated Successfully');
    }

    public function deleteAttendanceEmployeeDateWise($id)
    {

        // echo $id; exit;

        $attendance_details = Attendance::where('id', $id)->get();

        foreach ($attendance_details as $attendance_details_vaue) {

            if (LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_details_vaue->employee_id)->where('late_time_date', $attendance_details_vaue->attendance_date)->exists()) {

                $late_time_row_id =  LateTime::where('late_time_com_id', Auth::user()->com_id)->where('late_time_employee_id', $attendance_details_vaue->employee_id)->where('late_time_date', $attendance_details_vaue->attendance_date)->first('id');

                $late_time = LateTime::find($late_time_row_id->id);
                $late_time->delete();
            }

            if (OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_details_vaue->employee_id)->where('over_time_date', $attendance_details_vaue->attendance_date)->where('over_time_type', '=', 'Automatic')->exists()) {

                $over_time_row_id = OverTime::where('over_time_com_id', Auth::user()->com_id)->where('over_time_employee_id', $attendance_details_vaue->employee_id)->where('over_time_date', $attendance_details_vaue->attendance_date)->where('over_time_type', '=', 'Automatic')->first('id');

                $over_time = OverTime::find($over_time_row_id->id);
                $over_time->delete();
            }

            $attendance = Attendance::find($id);
            $attendance->delete();

            return back()->with('message', 'Deleted Successfully');
        }
    }

    public function dateWiseAllAttendance(Request $request)
    {

        //$date=date_create($request->searchable_date);
        // echo $request->searchable_date; exit;
        //echo date_format($request->searchable_date,"Y/m/d"); exit;

        $validated = $request->validate([
            'searchable_date' => 'required',
        ]);

        $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
            //->join('companies', 'attendances.attendance_com_id', '=', 'companies.id')
            //->select('attendances.*','users.first_name','users.last_name', 'companies.company_name')
            ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
            ->where('attendance_com_id', '=', Auth::user()->com_id)
            ->where('attendance_date', '=', $request->searchable_date)
            ->get();

        return view('back-end.premium.timesheets.attendance.attendance-index', [
            'attendances' => $attendances,
        ]);
    }


    public function dateWiseEmployeeAttendance(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')) {
            $employees = User::where('com_id', Auth::user()->com_id)
                ->where('is_active', 1)
                ->where('users_bulk_deleted', 'No')
                ->whereNull('company_profile')
                ->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo']);

            $query = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                ->where('attendance_com_id', '=', Auth::user()->com_id)
                ->whereBetween('attendance_date', [$request->start_date, $request->end_date])
                ->orderBy("attendance_date", "desc");

            if ($request->filled('employee_id')) {
                $query->where('employee_id', $request->employee_id);
            } else {

                $query = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                    ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                    ->where('attendance_com_id', '=', Auth::user()->com_id)
                    ->whereBetween('attendance_date', [$request->start_date, $request->end_date])
                    ->where('employee_id',  Auth::user()->id)
                    ->orderBy("attendance_date", "desc");
            }
        }
        $attendances = $query->paginate(100);

        $request->session()->put('attendances', $attendances);

        return view('back-end.premium.timesheets.attendance.date-wise-attendance-index', get_defined_vars());
    }

    public function dateWiseAttendanceDownload(Request $request)
    {
        $attendances = $request->session()->get('attendances');
        if ($attendances) {
            $data['attendances'] = $attendances;
            $exl = Excel::download(new DateWiseAttendanceExport($data), 'Date-wise-attendance-report.xlsx');
            $request->session()->forget('attendances');
            return $exl;
        } else {
            $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                ->where('attendance_com_id', '=', Auth::user()->com_id)
                ->orderBy("attendance_date", "desc")
                ->get();
            $data['attendances'] = $attendances;
            $exl = Excel::download(new DateWiseAttendanceExport($data), 'Date-wise-attendance-report.xlsx');
            return $exl;
        }
    }

    public function monthWiseEmployeeAttendance(Request $request)
    {
        $validated = $request->validate([
            // 'month_year' => 'required',
        ]);

        $month = date("m", strtotime($request->month_year));
        $year = date("Y", strtotime($request->month_year));
        $current_month = date("m", strtotime($request->month_year));
        $current_year = date("Y", strtotime($request->month_year));

        $attendances = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
            ->select('monthly_attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id', 'users.id')
            ->where('monthly_com_id', '=', Auth::user()->com_id)
            ->where('monthly_employee_id', '=', $request->employee_id)
            ->whereMonth('attendance_month', '=', $month)
            ->whereYear('attendance_year', '=', $year)
            ->get();

        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')
        ->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo', 'joining_date', 'id']);
        if ($request->month_year) {
            $attendances = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                ->select('monthly_attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id', 'users.id')
                ->where('monthly_com_id', '=', Auth::user()->com_id)
                // ->where('monthly_employee_id', '=', $request->employee_id)
                ->whereMonth('attendance_month', '=', $month)
                ->whereYear('attendance_year', '=', $year)
                ->get();
        }

        if ($request->employee_id && $request->month_year) {
            $attendances = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                ->select('monthly_attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id', 'users.id')
                ->where('monthly_com_id', '=', Auth::user()->com_id)
                ->where('monthly_employee_id', '=', $request->employee_id)
                ->whereMonth('attendance_month', '=', $month)
                ->whereYear('attendance_year', '=', $year)
                ->get();
        }
        if ($request->Search) {
            return view('back-end.premium.timesheets.attendance.month-wise-attandance-search-index', [
                'attendances' => $attendances,
                'employees' => $employees,
                'month' => $month,
                'year' => $year,
                'current_month' => $current_month,
                'current_year' => $current_year,
            ]);
        }
        if ($request->download) {
            $data['attendances'] = $attendances;
            $data['employees'] = $employees;
            $data['month'] = $month;
            $data['year'] = $year;
            $data['current_month'] = $current_month;
            $data['current_year'] = $current_year;
            return  Excel::download(new AttendanceExport($data), 'Attendance-Report.xlsx');
        }
    }

    public function fileImportAttendance(Request $request)
    {
        Excel::import(new AttendanceImport, request()->file('file'));
        return back()->with('message', 'Imported Successfully');
    }

    public function updateAttendanceLocation(Request $request)
    {
        if (User::where('id', $request->employee_id)->exists()) {
            $user = User::find($request->employee_id);
            $user->attendance_status = "No";
            $user->check_in_ip = NULL;
            $user->check_out_ip = NULL;
            $user->check_in_latitude = NULL;
            $user->check_in_latitude_two = NULL;
            $user->check_in_latitude_three = NULL;
            $user->check_in_longitude = NULL;
            $user->check_in_longitude_two = NULL;
            $user->check_in_longitude_three = NULL;
            $user->check_out_latitude = NULL;
            $user->check_out_latitude_two = NULL;
            $user->check_out_latitude_three = NULL;
            $user->check_out_longitude = NULL;
            $user->check_out_longitude_two = NULL;
            $user->check_out_longitude_three = NULL;
            $user->save();
        }
        return back()->with('message', 'Reset Successfully');
    }

    public function updateBulkAttendanceLocation(Request $request)
    {
        if (User::where('com_id', $request->com_id)->exists()) {

            $employee_details = User::where('com_id', $request->com_id)->get(['id']);

            foreach ($employee_details as $employee_details_value) {
                $user = User::find($employee_details_value->id);
                $user->attendance_status = "No";
                $user->check_in_ip = NULL;
                $user->check_out_ip = NULL;
                $user->check_in_latitude = NULL;
                $user->check_in_latitude_two = NULL;
                $user->check_in_latitude_three = NULL;
                $user->check_in_longitude = NULL;
                $user->check_in_longitude_two = NULL;
                $user->check_in_longitude_three = NULL;
                $user->check_out_latitude = NULL;
                $user->check_out_latitude_two = NULL;
                $user->check_out_latitude_three = NULL;
                $user->check_out_longitude = NULL;
                $user->check_out_longitude_two = NULL;
                $user->check_out_longitude_three = NULL;
                $user->save();
            }

            return back()->with('message', 'Bulk Reset Successfully!!!');
        } else {
            return back()->with('message', 'Nothing To Reset!!!!');
        }
    }

    public function bulkAttendanceForm($id)
    {
        $employee = User::findOrFail($id);
        return view('back-end.premium.timesheets.import-attendance.import-attendance-form', compact('employee'));
    }

    public function individualBulkAttendance(Request $request)
    {

        $existance_array = [];



        //exit;

        if ($request->date_one) {

            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_one' => 'required',
                'checkInOne' => 'required',
                'checkOutOne' => 'required',
                'check_in_out' => 'required',
            ]);

            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_one)->exists()) {
                // return back()->with('message','Already '.$request->date_one.' Attendance  submit');
                // session()->flash('message', 'This is a message!');
                array_push($existance_array, $request->date_one);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_one;
                $attendance->clock_in = $request->checkInOne;
                $attendance->clock_out = $request->checkOutOne;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // return back()->with('message','Attendance submit successfully');
                //array_push($existance_array,$request->date_one);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_one);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

            }
        }
        if ($request->date_two) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_two' => 'required',
                'checkInTwo' => 'required',
                'checkOutTwo' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_two)->exists()) {
                array_push($existance_array, $request->date_two);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_two;
                $attendance->clock_in = $request->checkInTwo;
                $attendance->clock_out = $request->checkOutTwo;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_two);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_two);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################



            }
        }
        if ($request->date_three) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_three' => 'required',
                'checkInthree' => 'required',
                'checkOutThree' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_three)->exists()) {
                array_push($existance_array, $request->date_three);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_three;
                $attendance->clock_in = $request->checkInthree;
                $attendance->clock_out = $request->checkOutThree;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_three);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_three);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

            }
        }

        if ($request->date_four) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_four' => 'required',
                'checkInFour' => 'required',
                'checkOutFour' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_four)->exists()) {
                array_push($existance_array, $request->date_four);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_four;
                $attendance->clock_in = $request->checkInFour;
                $attendance->clock_out = $request->checkOutFour;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_four);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_four);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_five) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_five' => 'required',
                'checkInFive' => 'required',
                'checkOutFive' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_five)->exists()) {
                array_push($existance_array, $request->date_five);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_five;
                $attendance->clock_in = $request->checkInFive;
                $attendance->clock_out = $request->checkOutFive;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_five);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_five);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_six) {

            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_six' => 'required',
                'checkInSix' => 'required',
                'checkOutSix' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_six)->exists()) {
                array_push($existance_array, $request->date_six);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_six;
                $attendance->clock_in = $request->checkInSix;
                $attendance->clock_out = $request->checkOutSix;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_six);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_six);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################
            }
        }
        if ($request->date_seven) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_seven' => 'required',
                'checkInSeven' => 'required',
                'checkOutSeven' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_seven)->exists()) {
                array_push($existance_array, $request->date_seven);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_seven;
                $attendance->clock_in = $request->checkInSeven;
                $attendance->clock_out = $request->checkOutSeven;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_seven);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_seven);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################
            }
        }
        if ($request->date_eight) {

            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_eight' => 'required',
                'checkInEight' => 'required',
                'checkOutEight' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_eight)->exists()) {
                array_push($existance_array, $request->date_eight);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_eight;
                $attendance->clock_in = $request->checkInEight;
                $attendance->clock_out = $request->checkOutEight;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_eight);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_eight);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_nine) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_nine' => 'required',
                'checkInNine' => 'required',
                'checkOutOne' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_nine)->exists()) {
                array_push($existance_array, $request->date_nine);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_nine;
                $attendance->clock_in = $request->checkInNine;
                $attendance->clock_out = $request->checkOutNine;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_nine);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_nine);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_ten) {

            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_ten' => 'required',
                'checkInTen' => 'required',
                'checkOutTen' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_ten)->exists()) {
                array_push($existance_array, $request->date_ten);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_ten;
                $attendance->clock_in = $request->checkInTen;
                $attendance->clock_out = $request->checkOutTen;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_ten);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_ten);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_eleven) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_eleven' => 'required',
                'checkInEleven' => 'required',
                'checkOutEleven' => 'required',
                'check_in_out' => 'required',
            ]);



            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_eleven)->exists()) {
                array_push($existance_array, $request->date_eleven);

                array_push($existance_array, $request->date_eleven);

                //skip
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_eleven;
                $attendance->clock_in = $request->checkInEleven;
                $attendance->clock_out = $request->checkOutEleven;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_eleven);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_eleven);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twelve) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twelve' => 'required',
                'checkInTwelve' => 'required',
                'checkOutTwelve' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twelve)->exists()) {
                array_push($existance_array, $request->date_twelve);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twelve;
                $attendance->clock_in = $request->checkInTwelve;
                $attendance->clock_out = $request->checkOutTwelve;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_twelve);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twelve);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_thirteen) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_thirteen' => 'required',
                'checkInThirteen' => 'required',
                'checkOutThirteen' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_thirteen)->exists()) {
                array_push($existance_array, $request->date_thirteen);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_thirteen;
                $attendance->clock_in = $request->checkInThirteen;
                $attendance->clock_out = $request->checkOutThirteen;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_thirteen);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_thirteen);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_fourteen) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_fourteen' => 'required',
                'checkInFourteen' => 'required',
                'checkOutFourteen' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_fourteen)->exists()) {
                array_push($existance_array, $request->date_fourteen);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_fourteen;
                $attendance->clock_in = $request->checkInFourteen;
                $attendance->clock_out = $request->checkOutFourteen;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_fourteen);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_fourteen);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_fifthteen) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_fifthteen' => 'required',
                'checkInFifthteen' => 'required',
                'checkOutFifthteen' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_fifthteen)->exists()) {
                array_push($existance_array, $request->date_fifthteen);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_fifthteen;
                $attendance->clock_in = $request->checkInFifthteen;
                $attendance->clock_out = $request->checkOutFifthteen;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_fifthteen);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_fifthteen);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_sixteen) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_sixteen' => 'required',
                'checkInsixteen' => 'required',
                'checkOutsixteen' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_sixteen)->exists()) {
                array_push($existance_array, $request->date_sixteen);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_sixteen;
                $attendance->clock_in = $request->checkInsixteen;
                $attendance->clock_out = $request->checkOutsixteen;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_sixteen);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_sixteen);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_seventeen) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_seventeen' => 'required',
                'checkInseventeen' => 'required',
                'checkOutseventeen' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_seventeen)->exists()) {
                array_push($existance_array, $request->date_seventeen);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_seventeen;
                $attendance->clock_in = $request->checkInseventeen;
                $attendance->clock_out = $request->checkOutseventeen;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_seventeen);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_seventeen);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);
                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_eightteen) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_eightteen' => 'required',
                'checkIneightteen' => 'required',
                'checkOuteightteen' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_eightteen)->exists()) {
                array_push($existance_array, $request->date_eightteen);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_eightteen;
                $attendance->clock_in = $request->checkIneightteen;
                $attendance->clock_out = $request->checkOuteightteen;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_eightteen);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_eightteen);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_ninthteen) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_ninthteen' => 'required',
                'checkInninthteen' => 'required',
                'checkOutninthteen' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_ninthteen)->exists()) {
                array_push($existance_array, $request->date_ninthteen);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_ninthteen;
                $attendance->clock_in = $request->checkInninthteen;
                $attendance->clock_out = $request->checkOutninthteen;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_ninthteen);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_ninthteen);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twenty) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twenty' => 'required',
                'checkIntwenty' => 'required',
                'checkOuttwenty' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twenty)->exists()) {
                array_push($existance_array, $request->date_twenty);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twenty;
                $attendance->clock_in = $request->checkIntwenty;
                $attendance->clock_out = $request->checkOuttwenty;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_twenty);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twenty);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twentyOne) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentyOne' => 'required',
                'checkIntwentyOne' => 'required',
                'checkOuttwentyOne' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentyOne)->exists()) {
                array_push($existance_array, $request->date_twentyOne);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentyOne;
                $attendance->clock_in = $request->checkIntwentyOne;
                $attendance->clock_out = $request->checkOuttwentyOne;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_twentyOne);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentyOne);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twentyTwo) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentyTwo' => 'required',
                'checkIntwentyTwo' => 'required',
                'checkOuttwentyTwo' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentyTwo)->exists()) {
                array_push($existance_array, $request->date_twentyTwo);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentyTwo;
                $attendance->clock_in = $request->checkIntwentyTwo;
                $attendance->clock_out = $request->checkOuttwentyTwo;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_twentyTwo);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentyTwo);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twentyThree) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentyThree' => 'required',
                'checkIntwentyThree' => 'required',
                'checkOuttwentyThree' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentyThree)->exists()) {
                array_push($existance_array, $request->date_twentyThree);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentyThree;
                $attendance->clock_in = $request->checkIntwentyThree;
                $attendance->clock_out = $request->checkOuttwentyThree;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_twentyThree);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentyThree);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }

        if ($request->date_twentyFour) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentyFour' => 'required',
                'checkIntwentyFour' => 'required',
                'checkOuttwentyFour' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentyFour)->exists()) {
                array_push($existance_array, $request->date_twentyFour);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentyFour;
                $attendance->clock_in = $request->checkIntwentyFour;
                $attendance->clock_out = $request->checkOuttwentyFour;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_twentyFour);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentyFour);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twentyFive) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentyFive' => 'required',
                'checkIntwentyFive' => 'required',
                'checkOuttwentyFive' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentyFive)->exists()) {
                array_push($existance_array, $request->date_twentyFive);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentyFive;
                $attendance->clock_in = $request->checkIntwentyFive;
                $attendance->clock_out = $request->checkOuttwentyFive;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_twentyFive);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentyFive);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twentySix) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentySix' => 'required',
                'checkIntwentySix' => 'required',
                'checkOuttwentySix' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentySix)->exists()) {
                array_push($existance_array, $request->date_twentySix);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentySix;
                $attendance->clock_in = $request->checkIntwentySix;
                $attendance->clock_out = $request->checkOuttwentySix;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_twentySix);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentySix);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twentySeven) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentySeven' => 'required',
                'checkIntwentySeven' => 'required',
                'checkOuttwentySeven' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentySeven)->exists()) {
                array_push($existance_array, $request->date_twentySeven);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentySeven;
                $attendance->clock_in = $request->checkIntwentySeven;
                $attendance->clock_out = $request->checkOuttwentySeven;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_twentySeven);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentySeven);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twentyEight) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentyEight' => 'required',
                'checkIntwentyEight' => 'required',
                'checkOuttwentyEight' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentyEight)->exists()) {
                array_push($existance_array, $request->date_twentyEight);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentyEight;
                $attendance->clock_in = $request->checkIntwentyEight;
                $attendance->clock_out = $request->checkOuttwentyEight;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_twentyEight);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentyEight);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_twentyNine) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_twentyNine' => 'required',
                'checkIntwentyNine' => 'required',
                'checkOuttwentyNine' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_twentyNine)->exists()) {
                array_push($existance_array, $request->date_twentyNine);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_twentyNine;
                $attendance->clock_in = $request->checkIntwentyNine;
                $attendance->clock_out = $request->checkOuttwentyNine;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_twentyNine);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_twentyNine);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_thirty) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_thirty' => 'required',
                'checkInthirty' => 'required',
                'checkOutthirty' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_thirty)->exists()) {
                array_push($existance_array, $request->date_thirty);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_thirty;
                $attendance->clock_in = $request->checkInthirty;
                $attendance->clock_out = $request->checkOutthirty;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                // array_push($existance_array,$request->date_thirty);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_thirty);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }
        if ($request->date_thirtyOne) {
            $validated = $request->validate([
                'employee_id' => 'required',
                'attendance_com_id' => 'required',
                'date_thirtyOne' => 'required',
                'checkInThirtyOne' => 'required',
                'checkOutThirtyOne' => 'required',
                'check_in_out' => 'required',
            ]);
            if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', '=', Auth::user()->com_id)->where('attendance_date', '=', $request->date_thirtyOne)->exists()) {
                array_push($existance_array, $request->date_thirtyOne);
            } else {
                $attendance = new Attendance;
                $attendance->employee_id = $request->employee_id;
                $attendance->attendance_com_id = $request->attendance_com_id;
                $attendance->attendance_date = $request->date_thirtyOne;
                $attendance->clock_in = $request->checkInThirtyOne;
                $attendance->clock_out = $request->checkOutThirtyOne;
                $attendance->check_in_out = $request->check_in_out;
                $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                $attendance->save();
                //array_push($existance_array,$request->date_thirtyOne);

                ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                $time = strtotime($request->date_thirtyOne);
                $current_date = date("Y-m-d", $time);
                $current_date = date("Y-m-d", $time);
                $current_month = date("m", $time);
                $current_year = date("Y", $time);
                $current_date_number = date("d", $time);

                if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id = $request->employee_id;
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

                ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


            }
        }

        if ($existance_array) {
            return back()->with('message', 'Attendance Submitted Successfully!!! But ' . json_encode($existance_array) . ' dates already exist!');
        } else {
            return back()->with('message', 'Attendance Submitted Successfully!!!');
        }
    }
}
