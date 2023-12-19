<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use DateTime;
use DataTables;
use App\Models\Area;
use App\Models\Role;
use App\Models\Town;
use App\Models\User;
use App\Models\Leave;
use App\Models\Region;
use App\Models\Travel;
use App\Models\DbHouse;
use App\Models\Holiday;
use App\Models\LeaveType;
use App\Models\Territory;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Designation;
use App\Models\OfficeShift;
use App\Models\VariableType;
use Illuminate\Http\Request;
use App\Models\CompensatoryLeave;
use App\Models\MonthlyAttendance;
use App\Models\AttendanceLocation;
use App\Models\LatetimeConfig;
use App\Models\LateTime;
use Carbon\Carbon;
use Session;


class TimesheetController extends Controller
{
    public function attendanceIndex()
    {

        $machinetransactionData = DB::connection('second_mysql')->table('ep_eptransaction')->get();
        $matchingUsers = collect();

        foreach ($machinetransactionData as $transaction) {



            $clockIntime = DateTime::createFromFormat('H:i:s.u', $transaction->check_time)->format('H:i:s');
            $users = DB::table('users')
                ->where('company_assigned_id', $transaction->emp_code)
                ->get();
            foreach ($users as $user) {
                $matchingUser = new \stdClass();
                $matchingUser->id = $user->id;
                $matchingUser->company_assigned_id = $transaction->emp_code;
                $matchingUser->check_date = $transaction->check_date;
                $matchingUser->check_time = $clockIntime;
                $matchingUsers->push($matchingUser);
            }
        }


        foreach ($matchingUsers as $matchingUser) {

            $user = DB::table('users')
                ->where('company_assigned_id', $transaction->emp_code)
                ->first();
            $current_day_name = date('D', strtotime($transaction->check_date));
            if ($current_day_name == "Sun") {
                $office_shifts_array = OfficeShift::where('id', '=',  $user->office_shift_id)->get(['sunday_in', 'sunday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->sunday_in;
                    $shift_out = $office_shifts->sunday_out;
                }
            } elseif ($current_day_name == "Mon") {
                $office_shifts_array = OfficeShift::where('id', '=',  $user->office_shift_id)->get(['monday_in', 'monday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->monday_in;
                    $shift_out = $office_shifts->monday_out;
                }
            } elseif ($current_day_name == "Tue") {
                $office_shifts_array = OfficeShift::where('id', '=',  $user->office_shift_id)->get(['tuesday_in', 'tuesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->tuesday_in;
                    $shift_out = $office_shifts->tuesday_out;
                }
            } elseif ($current_day_name == "Wed") {
                $office_shifts_array = OfficeShift::where('id', '=',  $user->office_shift_id)->get(['wednesday_in', 'wednesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->wednesday_in;
                    $shift_out = $office_shifts->wednesday_out;
                }
            } elseif ($current_day_name == "Thu") {
                $office_shifts_array = OfficeShift::where('id', '=',  $user->office_shift_id)->get(['thursday_in', 'thursday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->thursday_in;
                    $shift_out = $office_shifts->thursday_out;
                }
            } elseif ($current_day_name == "Fri") {
                $office_shifts_array = OfficeShift::where('id', '=',  $user->office_shift_id)->get(['friday_in', 'friday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->friday_in;
                    $shift_out = $office_shifts->friday_out;
                }
            } elseif ($current_day_name == "Sat") {
                $office_shifts_array = OfficeShift::where('id', '=',  $user->office_shift_id)->get(['saturday_in', 'saturday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->saturday_in;
                    $shift_out = $office_shifts->saturday_out;
                }
            } else {

                return back()->with('message', 'Office Shift Not Set Properly For This Day Yet!!!');
            }


            $clockIntime = DateTime::createFromFormat('H:i:s.u', $transaction->check_time)->format('H:i:s');

            $clockInDate = Carbon::createFromFormat('Y-m-d', $transaction->check_date);

            $current_month = $clockInDate->format('m');
            $current_year = $clockInDate->format('Y');
            $current_date_number = $clockInDate->format('d');
            ################ Seconds from shift start to end time of the day code starts from here ################################
            $company_shift_in_seconds = strtotime($shift_in) + 60 * 60;
            ################ Seconds from shift start to end time of the day code ends here #######################################

            ################ Late Time Countable Seconds code starts from here ####################################################
            $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->first(['minimum_countable_time']);
            $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
            $current_time_in_seconds = strtotime($clockIntime) + 60 * 60;


            if (Attendance::where('employee_id', $matchingUser->id)->where('attendance_date', date('y-m-d'))->exists()) {
                // update the latest attendance record with the clock-out time
                $empCodeCounts = DB::connection('second_mysql')
                    ->table('ep_eptransaction')
                    ->select('emp_code', DB::raw('count(*) as count'))
                    ->groupBy('emp_code')
                    ->get();
                foreach ($empCodeCounts as $empCodeCount) {
                    if ($empCodeCount->count >= 2 && Attendance::where('employee_id', $matchingUser->id)->where('attendance_date', date('y-m-d'))->exists()) {
                        $attendance = Attendance::where('employee_id', $matchingUser->id)->where('attendance_date', date('y-m-d'))->latest()->first();
                        $attendance->clock_out = $matchingUser->check_time;
                        if (date_create($matchingUser->check_time) <= date_create($shift_out)) {
                            if ($shift_in != 0 && $shift_out != 0) {
                                $attendance->early_leaving = date_create($matchingUser->check_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                            }
                        }
                        $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');

                        $attendance->check_in_out = 1;
                        $attendance->save();


                        ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                        if (MonthlyAttendance::where('monthly_employee_id', $matchingUser->id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                            $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $matchingUser->id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                            $monthly_attendance->monthly_employee_id = $matchingUser->id;
                            $monthly_attendance->attendance_month = $matchingUser->check_date;
                            $monthly_attendance->attendance_year = $matchingUser->check_date;
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

                        ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################
                    }
                }
            } else {
                // create a new attendance record
                $attendance = new Attendance();
                $attendance->attendance_com_id = Auth::user()->com_id;
                $attendance->employee_id = $matchingUser->id;
                $attendance->attendance_date = $matchingUser->check_date;
                $attendance->clock_in = $matchingUser->check_time;
                $attendance->check_in_out = 1;

                if (date_create($clockIntime) >= date_create($shift_in)) {
                    if ($shift_in != 0 && $shift_out != 0) {

                        $attendance->time_late = date_create($shift_in)->diff(date_create($clockIntime))->format('%H:%i:%s');

                        if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {

                            if (LateTime::where('late_time_employee_id', $matchingUser->id)->where('late_time_date',  $matchingUser->check_date)->exists()) {

                                $late_times = LateTime::where('late_time_employee_id', $matchingUser->id)->where('late_time_date',  $matchingUser->check_date)->get('id');

                                foreach ($late_times as $late_times_value) {

                                    $late_time = LateTime::find($late_times_value->id);
                                    $late_time->late_time_com_id = Auth::user()->com_id;
                                    $late_time->late_time_employee_id = $matchingUser->id;
                                    $late_time->late_time_date =  $matchingUser->check_date;
                                    $late_time->save();
                                }
                            } else {
                                $late_time = new LateTime();
                                $late_time->late_time_com_id = Auth::user()->com_id;
                                $late_time->late_time_employee_id = $matchingUser->id;
                                $late_time->late_time_date =  $matchingUser->check_date;
                                $late_time->save();
                            }
                        }
                    }
                }
                $attendance->attendance_status = "Present";
                $attendance->save();

                ######################################################### MONTHLY ATTENDANCE CODE Start ############################
                if (MonthlyAttendance::where('monthly_employee_id',  $matchingUser->id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->exists()) {

                    $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id',  $matchingUser->id)->whereMonth('attendance_month', '=', $current_month)->whereYear('attendance_year', '=', $current_year)->get();

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
                    $monthly_attendance->monthly_employee_id =  $matchingUser->id;
                    $monthly_attendance->attendance_month = $matchingUser->check_date;
                    $monthly_attendance->attendance_year = $matchingUser->check_date;
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
        //List show Method
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

            $current_date = date('Y-m-d');
            $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                ->where('attendance_com_id', '=', Auth::user()->com_id)
                ->whereDate('attendance_date', $current_date)
                ->get();

            return view('back-end.premium.timesheets.attendance.attendance-index', [
                'attendances' => $attendances,
            ]);
        } else {

            $current_date = date('Y-m-d');
            $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                ->where('employee_id', Auth::user()->id)
                ->where('attendance_com_id', Auth::user()->com_id)
                ->whereDate('attendance_date', $current_date)
                ->orderBy("attendance_date", "desc")
                ->get();

            return view('back-end.premium.timesheets.attendance.attendance-index', [
                'attendances' => $attendances,
            ]);
        }
    }


    public function dateWiseAttendanceIndex()
    {
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

            $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo']);
            $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                ->where('attendance_com_id', '=', Auth::user()->com_id)
                ->orderBy("attendance_date", "desc")
                ->paginate(100);

            return view('back-end.premium.timesheets.attendance.date-wise-attendance-index', get_defined_vars());
        } else {

            $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo']);
            $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                ->where('employee_id', Auth::user()->id)
                ->where('attendance_com_id', '=', Auth::user()->com_id)
                ->orderBy("attendance_date", "desc")
                ->paginate(100);

            return view('back-end.premium.timesheets.attendance.date-wise-attendance-index', get_defined_vars());
        }
    }

    public function monthWiseAttendanceIndex()
    {
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {
            $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo']);
            $date = new DateTime("now", new \DateTimeZone('Asia/Kolkata'));
            $current_month = $date->format('m');
            $current_year = $date->format('Y');
            $attendances = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                ->select('monthly_attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                ->where('monthly_com_id', '=', Auth::user()->com_id)
                ->whereMonth('attendance_month', '=', $current_month)
                ->whereYear('attendance_year', '=', $current_year)
                ->get();
            return view('back-end.premium.timesheets.attendance.month-wise-attendance-index2', [
                'attendances' => $attendances,
                'employees' => $employees,
                'month' => $current_month,
                'year' => $current_year,
            ]);
        } else {
            $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo']);
            $date = new DateTime("now", new \DateTimeZone('Asia/Kolkata'));
            $current_month = $date->format('m');
            $current_year = $date->format('Y');
            $attendances = MonthlyAttendance::join('users', 'monthly_attendances.monthly_employee_id', '=', 'users.id')
                ->select('monthly_attendances.*', 'users.first_name', 'users.last_name', 'users.company_assigned_id')
                ->where('monthly_employee_id', Auth::user()->id)
                ->where('monthly_com_id', Auth::user()->com_id)
                ->whereMonth('attendance_month', '=', $current_month)
                ->whereYear('attendance_year', '=', $current_year)
                ->get();
            return view('back-end.premium.timesheets.attendance.month-wise-attendance-index2', [
                'attendances' => $attendances,
                'employees' => $employees,
                'month' => $current_month,
                'year' => $current_year,
            ]);
        }
    }

    public function updateAttendanceIndex(Request $request)
    {
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo', 'company_assigned_id']);
        $attendances = [];

        return view('back-end.premium.timesheets.update-attendance.update-attendance-index', [
            'attendances' => $attendances,
            'employees' => $employees,
        ]);
    }

    public function updateAttendanceEmployeeDateWiseSearch(Request $request)
    {

        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo']);

        if (Attendance::where('attendance_com_id', '=', Auth::user()->com_id)->where('employee_id', '=', $request->employee_id)->where('attendance_date', '=', $request->update_date)->exists()) {

            $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->join('companies', 'attendances.attendance_com_id', '=', 'companies.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name', 'companies.company_name', 'users.company_assigned_id')
                ->where('attendance_com_id', '=', Auth::user()->com_id)
                ->where('employee_id', '=', $request->employee_id)
                ->where('attendance_date', '=', $request->update_date)
                // ->whereMonth('attendance_date','=',$request->update_date)
                // ->whereYear('attendance_date', '=', $request->update_date)
                ->get();

            return view('back-end.premium.timesheets.update-attendance.update-attendance-index', [
                'attendances' => $attendances,
                'employees' => $employees,
            ]);
        } else {

            $employee_id = $request->employee_id;
            $add_date = $request->update_date;

            $attendances = Attendance::join('users', 'attendances.employee_id', '=', 'users.id')
                ->join('companies', 'attendances.attendance_com_id', '=', 'companies.id')
                ->select('attendances.*', 'users.first_name', 'users.last_name', 'companies.company_name', 'users.company_assigned_id')
                ->where('attendance_com_id', '=', Auth::user()->com_id)
                ->where('employee_id', '=', $request->employee_id)
                ->get();

            return view('back-end.premium.timesheets.add-attendance.add-attendance-index', [
                'employee_id' => $employee_id,
                'add_date' => $add_date,
                'attendances' => $attendances,
            ]);
        }
        // return back();
    }

    public function importAttendanceIndex()
    {
        return view('back-end.premium.timesheets.import-attendance.import-attendance-index');
    }

    public function officeShiftIndex()
    {

        $time_sheet_sub_module_six_add = "6.6.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $time_sheet_sub_module_six_edit = "6.6.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $time_sheet_sub_module_six_delete = "6.6.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $office_shift_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Office-Shift')->get();
        $office_shifts = OfficeShift::where('office_shift_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.timesheets.office-shift.office-shift-index', [
            'office_shifts' => $office_shifts,
            'office_shift_types' => $office_shift_types,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function manageWeeklyHolidayIndex()
    {

        $time_sheet_sub_module_seven_add = "6.7.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $time_sheet_sub_module_seven_edit = "6.7.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $time_sheet_sub_module_seven_delete = "6.7.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_seven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->get();

        return view('back-end.premium.timesheets.manage-holiday.manage-weekly-holiday-index', [
            'holidays' => $holidays,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function manageOtherHolidayIndex()
    {
        $time_sheet_sub_module_eight_add = "6.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $time_sheet_sub_module_eight_edit = "6.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $time_sheet_sub_module_eight_delete = "6.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }



        $holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->get();

        return view('back-end.premium.timesheets.manage-holiday.manage-other-holiday-index', [
            'holidays' => $holidays,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function manageLeaveTypeIndex()
    {

        $time_sheet_sub_module_nine_add = "6.9.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $time_sheet_sub_module_nine_edit = "6.9.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $time_sheet_sub_module_nine_delete = "6.9.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_nine_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get();

        return view('back-end.premium.timesheets.manage-leave-type.manage-leave-type-index', [
            'leave_types' => $leave_types,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function manageLeaveIndex()
    {

        $current_year =  date('Y');
        $startDate = date("Y-m-d");
        //$endDate = date('Y-m-d',strtotime('+365 days'));
        $endDate = date('Y') . '-' . '12' . '-' . '31';

        $previous_start_date = date('Y-m-d', strtotime('-7 days'));
        $upto_end_date = date('Y-m-d', strtotime('+1 days'));
        $sick_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '4')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Auth::user()->id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $casual_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '5')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Auth::user()->id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $annual_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '7')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Auth::user()->id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $Sick_leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Sick leave")
            ->get();
        $Casual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Casual Leave")
            ->get();
        $Annual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Annual Leave")
            ->get();
        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get();
        $users = User::where('id', Auth::user()->id)->get(['id', 'joining_date']);

        $time_sheet_sub_module_ten_add = "6.10.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $time_sheet_sub_module_ten_delete = "6.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get(['id', 'leave_type']);
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'profile_photo', 'company_assigned_id']);
        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.company_assigned_id', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->orderBy("id", "desc")
                ->get();
        } else {
            $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.company_assigned_id', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->where('leaves_approver_generation_one_id', '=', Auth::user()->id)
                ->orWhere('leaves_approver_generation_two_id', '=', Auth::user()->id)
                ->orderBy("id", "desc")
                ->get();
        }

        return view('back-end.premium.timesheets.manage-leaves.manage-leaves-index',  get_defined_vars());
    }
    public function approveManageLeaveIndex()
    {

        $time_sheet_sub_module_ten_add = "6.10.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $time_sheet_sub_module_ten_delete = "6.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $Sick_leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Sick leave")
            ->get();
        $Casual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Casual Leave")
            ->get();
        $Annual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Annual Leave")
            ->get();
        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get();
        $users = User::where('id', Auth::user()->id)->get(['id', 'joining_date']);

        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get(['id', 'leave_type']);
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'profile_photo', 'company_assigned_id']);
        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.company_assigned_id', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->where('leaves.leaves_status', '=', 'Approved')
                ->orderBy("id", "desc")
                ->get();
        } else {
            $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.company_assigned_id', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->where('leaves.leaves_status', '=', 'Approved')
                ->where('leaves_approver_generation_one_id', '=', Auth::user()->id)
                ->orWhere('leaves_approver_generation_two_id', '=', Auth::user()->id)
                ->orderBy("id", "desc")
                ->get();
        }
        return view('back-end.premium.timesheets.manage-leaves.manage-leaves-index', get_defined_vars());
    }

    public function pendingManageLeaveIndex()
    {

        $time_sheet_sub_module_ten_add = "6.10.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $time_sheet_sub_module_ten_delete = "6.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $Sick_leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Sick leave")
            ->get();
        $Casual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Casual Leave")
            ->get();
        $Annual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Annual Leave")
            ->get();
        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get();
        $users = User::where('id', Auth::user()->id)->get(['id', 'joining_date']);

        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get(['id', 'leave_type']);
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'profile_photo', 'company_assigned_id']);
        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.company_assigned_id', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->where('leaves.leaves_status', '=', 'Pending')
                ->orderBy("id", "desc")
                ->get();
        } else {
            $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.company_assigned_id', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->where('leaves.leaves_status', '=', 'Pending')
                ->where('leaves_approver_generation_one_id', '=', Auth::user()->id)
                ->orWhere('leaves_approver_generation_two_id', '=', Auth::user()->id)
                ->orderBy("id", "desc")
                ->get();
        }
        return view('back-end.premium.timesheets.manage-leaves.manage-leaves-index', get_defined_vars());
    }




    public function approveLeaveIndex()
    {

        $Sick_leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Sick leave")
            ->get();
        $Casual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Casual Leave")
            ->get();
        $Annual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Annual Leave")
            ->get();
        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get();
        $users = User::where('id', Auth::user()->id)->get(['id', 'joining_date']);


        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->get(['id', 'first_name', 'last_name', 'profile_photo', 'company_assigned_id']);
        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.last_name', 'users.company_profile', 'departments.department_name', 'designations.designation_name',  'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->orderBy("id", "desc")
                ->get();
        } else {
            $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.last_name', 'users.company_profile', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->where('leaves_approver_generation_one_id', '=', Auth::user()->id)
                ->orWhere('leaves_approver_generation_two_id', '=', Auth::user()->id)
                ->orderBy("id", "desc")
                ->get();
        }

        return view('back-end.premium.timesheets.approve-leaves.approve-leave', get_defined_vars());
    }


    public function approveLeaveShow(Request $request)
    {

        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $leave = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->where('id', $request->id)
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.last_name', 'users.company_profile', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->where('leaves.id', $request->id)
                ->orderBy("leaves.id", "desc")
                ->first();
        } else {
            $leave = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
                ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
                ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
                ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
                // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
                // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
                // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
                // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
                // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
                ->select('leaves.*', 'users.first_name', 'users.last_name', 'users.company_profile', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
                ->where('leaves_company_id', '=', Auth::user()->com_id)
                ->where('leaves_approver_generation_one_id', '=', Auth::user()->id)
                ->orWhere('leaves_approver_generation_two_id', '=', Auth::user()->id)
                ->where('leaves.id', $request->id)
                ->orderBy("leaves.id", "desc")
                ->first();
        }
        $ancbd = LeaveType::get();
        $current_year = date('Y');
        $startDate = date('Y-m-d');
        //$endDate = date('Y-m-d',strtotime('+365 days'));
        $endDate = date('Y') . '-' . '12' . '-' . '31';

        $previous_start_date = date('Y-m-d', strtotime('-7 days'));
        $upto_end_date = date('Y-m-d', strtotime('+1 days'));
        $sick_leave_count = Leave
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            ::where('leaves_leave_type_id', '=', '4')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', $leave->leaves_employee_id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')
            ->sum('total_days');
        $casual_leave_count = Leave
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            ::where('leaves_leave_type_id', '=', '5')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', $leave->leaves_employee_id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')
            ->sum('total_days');
        $annual_leave_count = Leave
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            ::where('leaves_leave_type_id', '=', '7')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', $leave->leaves_employee_id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')
            ->sum('total_days');
        return response()->json(get_defined_vars());
    }



    public function approveTravelIndex()
    {

        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $travels = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_com_id', '=', Auth::user()->com_id)
                ->where('travel_status', '!=', 'Approved')
                ->orderBy("id", "desc")
                ->get();
        } else {
            $travels = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_com_id', '=', Auth::user()->com_id)
                ->where('travel_status', '!=', 'Approved')
                ->where('travel_approver_generation_one_id', '=', Auth::user()->id)
                ->orWhere('travel_approver_generation_two_id', '=', Auth::user()->id)
                ->orderBy("id", "desc")
                ->get();
        }


        return view('back-end.premium.timesheets.approve-travel.approve-travel-index', [
            'travels' => $travels,
        ]);
    }

    public function ManageTravelIndex()
    {

        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $travels = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_com_id', '=', Auth::user()->com_id)
                ->orderBy("id", "desc")
                ->get();
        } else {
            $travels = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_com_id', '=', Auth::user()->com_id)
                ->where('travel_approver_generation_one_id', '=', Auth::user()->id)
                ->orWhere('travel_approver_generation_two_id', '=', Auth::user()->id)
                ->orderBy("id", "desc")
                ->get();
        }
        return view('back-end.premium.timesheets.approve-travel.manage-travel-index', [
            'travels' => $travels,
        ]);
    }

    public function locationResetIndex()
    {

        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'company_assigned_id', 'profile_photo']);
        return view('back-end.premium.timesheets.location-reset.location-reset-index', [
            'employees' => $employees,
        ]);
    }

    public function locationLockIndex()
    {

        $attendance_locations = AttendanceLocation::where('attendance_location_com_id', Auth::user()->com_id)->orderBy('id', "desc")->get();

        return view('back-end.premium.timesheets.location-lock.location-lock-index', [
            'attendance_locations' => $attendance_locations,
        ]);
    }


    public function compensatoryLeavesIndex(Request $request)
    {

        $time_sheet_sub_module_ten_add = "6.10.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $time_sheet_sub_module_ten_edit = "6.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $time_sheet_sub_module_ten_delete = "6.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $compensatory_leaves = CompensatoryLeave::with('usercompensatoryleave')->where('compen_leave_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.timesheets.compensatory-leave.compensatory-leave-index', [
            'compensatory_leaves' => $compensatory_leaves,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function compensatoryLeavesApproveIndex(Request $request)
    {

        $time_sheet_sub_module_ten_add = "6.10.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $time_sheet_sub_module_ten_edit = "6.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $time_sheet_sub_module_ten_delete = "6.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $time_sheet_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        // $compensatory_leaves = CompensatoryLeave::with('usercompensatoryleave')->where('compen_leave_com_id', Auth::user()->com_id)->where(function ($query) {
        //     $query->where('compen_leave_approver_one_id', Auth::user()->id)
        //         ->orWhere('compen_leave_approver_two_id', Auth::user()->id);
        // })->get();
        $compensatory_leaves = CompensatoryLeave::where('compen_leave_approver_one_id', Auth::user()->id)
            // ->orWhere('compen_leave_approver_two_id', Auth::user()->id)
            ->get();

        return view('back-end.premium.timesheets.compensatory-leave-approve.compensatory-leave-approve-index', [
            'compensatory_leaves' => $compensatory_leaves,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }
}
