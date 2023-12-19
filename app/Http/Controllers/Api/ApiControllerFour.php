<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Immigrant;
use App\Models\EmergencyContact;
use App\Models\SocialProfile;
use App\Models\Document;
use App\Models\WorkExperience;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\SalaryConfig;
use App\Models\Commission;
use App\Models\Loan;
use App\Models\StatutoryDeduction;
use App\Models\OtherPayment;
use App\Models\SupportTicket;
use App\Models\OverTime;
use App\Models\Pension;
use App\Models\Attendance;
use App\Models\MonthlyAttendance;
use App\Models\Holiday;
use App\Models\Region;
use App\Models\Role;
use App\Models\AttendanceLocation;
use App\Models\LatetimeConfig;
use App\Models\LateTime;
use App\Models\OfficeShift;
use App\Models\Award;
use App\Models\Travel;
use App\Models\Transfer;
use App\Models\Termination;
use App\Models\Resignation;
use App\Models\Promotion;
use App\Models\Complaint;
use App\Models\Warning;
use App\Models\Leave;
use App\Models\Project;
use App\Models\Task;
use App\Models\PaySlip;
use App\Models\Announcement;
use App\Models\Policy;
use App\Models\Notification;
use App\Models\CompanyCalendar;
use App\Models\Asset;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Mail;
use Image;
use PDF;
use DateTime;

class ApiControllerFour extends Controller
{

    public function userAttandanceCheckIn(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'com_id' => 'required',
                'employee_id' => 'required',
                'lat' => 'required',
                'longt' => 'required',
                'office_shift_id' => 'required',
                // 'user_over_time_type' => 'required',
                // 'over_time_payable' => 'required',
                // 'user_over_time_rate' => 'required',
            ]
        );

      $office_shift = User::where('com_id',$request->com_id)->where('id',$request->employee_id)->first('office_shift_id');

      $office_shift_id = $office_shift->office_shift_id;
        //   return response()->json([
        //         'success' => false,
        //          'showButton' => 'check-in',
        //         'message' => 'response from check in',
        //     ])->setStatusCode(200);


        if (!$request->com_id) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'company id field is required!!!',
            ])->setStatusCode(200);
        }


        if (!$request->employee_id) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'employee id field is required!!!',
            ])->setStatusCode(200);
        }

        if (!$request->lat) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'latitude field is required in checkin respone!!!',
            ])->setStatusCode(200);
        }


        if (!$request->longt) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'longtude field is required!!!',
            ])->setStatusCode(200);
        }

        if (!$office_shift_id) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'office shift id field is required!!!',
            ])->setStatusCode(200);
        }
        // if(!$request->user_over_time_type){

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'over time type field is required!!!',
        //     ])->setStatusCode(200);
        // }
        // if(!$request->over_time_payable){

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'over time payable field is required!!!',
        //     ])->setStatusCode(200);
        // }

        // if(!$request->user_over_time_rate){

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'over time rate field is required!!!',
        //     ])->setStatusCode(200);
        // }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                //'message'=>$validator->errors(),
                'showButton' => 'check-in',
                'message' => 'some fields are missing!!!',
            ]);
        }



        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');
        //$current_date = "2021-12-04";
        $current_month = $date->format('m');
        $current_year = $date->format('Y');
        $current_date_number = $date->format('d');
        $current_time = $date->format('H:i:s');
        $local_server_ip = $request->ip();
        $current_day_name = date('D', strtotime($current_date));
        //$current_day_name = date('D', strtotime("2022-01-01"));



        if (Attendance::where('attendance_com_id', $request->com_id)->where('employee_id', $request->employee_id)->whereDate('attendance_date', $current_date)->exists()) {
            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'You already gave your attendance!!!',
            ])->setStatusCode(200);
        }

        if ($current_day_name == "Sun") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['sunday_in', 'sunday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->sunday_in;
                    $shift_out = $office_shifts->sunday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-in',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Mon") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['monday_in', 'monday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->monday_in;
                    $shift_out = $office_shifts->monday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-in',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Tue") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['tuesday_in', 'tuesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->tuesday_in;
                    $shift_out = $office_shifts->tuesday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-in',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Wed") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['wednesday_in', 'wednesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->wednesday_in;
                    $shift_out = $office_shifts->wednesday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-in',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Thu") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['thursday_in', 'thursday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->thursday_in;
                    $shift_out = $office_shifts->thursday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-in',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Fri") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['friday_in', 'friday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->friday_in;
                    $shift_out = $office_shifts->friday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-in',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Sat") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['saturday_in', 'saturday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->saturday_in;
                    $shift_out = $office_shifts->saturday_out;
                }
            } else {

                return response()->json([
                    'success' => false,
                    'showButton' => 'check-in',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } else {
            // $shift_in = 0;
            // $shift_out = 0;
            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
            ])->setStatusCode(200);
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
        $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', $request->com_id)->first(['minimum_countable_time']);
        $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
        $current_time_in_seconds = strtotime($current_time) + 60 * 60;
        ################ Late Time Countable Seconds code code ends here ######################################################


        if (DB::table('leaves')->where('leaves_company_id', $request->com_id)->where('leaves_employee_id', $request->employee_id)->where(function ($query) {
            $query->where('is_half', 0)
                ->orWhereNull('is_half');
        })
            ->where('leaves_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()
        ) { //condition for leave aprovements
            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'You Have Taken A Leave For This Day!!!',
            ])->setStatusCode(200);
        }

        if (Travel::where('travel_com_id', $request->com_id)->where('travel_employee_id', $request->employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'You are not permitted to give your attendance when you are on traveling!!!',
            ])->setStatusCode(200);
        }

        // if(Holiday::where('holiday_com_id',$request->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$current_day_name)->exists()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'You are not permitted to give your attendane on hoilday!!!',
        //     ])->setStatusCode(200);
        // }
        // if(Holiday::where('holiday_com_id',$request->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$current_date.'" between `start_date` and `end_date`')->exists()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'You are not permitted to give your attendane on hoilday!!!',
        //     ])->setStatusCode(200);
        // }

        ////////// Attandance check-in code Starts...


        if ($request->lat && $request->longt) {


            $users = User::where('id', $request->employee_id)->get();

            $latitude = $request->lat;
            $longitude = $request->longt;
            $employee_id = $request->employee_id;

            foreach ($users as $usersValue) {

                //echo $usersValue->attendance_status; exit;

                if ($usersValue->attendance_status == "" || $usersValue->attendance_status == NULL || $usersValue->attendance_status == 'No') {
                    // if($usersValue->attendance_status == NULL || $usersValue->attendance_status == 'No'){
                    //echo 'ok'; exit;

                    $user = User::find($request->employee_id);
                    $user->attendance_status = "Yes";
                    $user->check_in_ip = $local_server_ip;
                    $user->check_in_latitude = $request->lat;
                    $user->check_in_longitude = $request->longt;
                    $user->save();



                    $attendance = new Attendance();
                    $attendance->attendance_com_id = $request->com_id;
                    $attendance->employee_id = $request->employee_id;
                    $attendance->attendance_date = $current_date;
                    $attendance->clock_in = $current_time;
                    $attendance->check_in_latitude = $request->lat;
                    $attendance->check_in_longitude = $request->longt;
                    $attendance->check_in_ip = $local_server_ip;
                    if (date_create($current_time) >= date_create($shift_in)) {
                        if ($shift_in != 0 && $shift_out != 0) {

                            $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                            if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {

                                if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {
                                    $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                    foreach ($late_times as $late_times_value) {

                                        $late_time = LateTime::find($late_times_value->id);
                                        $late_time->late_time_com_id = $request->com_id;
                                        $late_time->late_time_employee_id = $request->employee_id;
                                        $late_time->late_time_date = $current_date;
                                        $late_time->save();
                                    }
                                } else {
                                    $late_time = new LateTime();
                                    $late_time->late_time_com_id = $request->com_id;
                                    $late_time->late_time_employee_id = $request->employee_id;
                                    $late_time->late_time_date = $current_date;
                                    $late_time->save();
                                }
                            }
                        }
                    }

                    //$attendance->check_in_out = 0;
                    $attendance->check_in_out = 1;
                    $attendance->attendance_status = "Present";
                    $attendance->save();

                    ########################### MONTHLY ATTENDANCE CODE STARTS #########################################


                    ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################



                    ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
                    if (MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', $current_month)->whereYear('attendance_year', $current_year)->exists()) {

                        $monthly_attendance_employee_id = MonthlyAttendance::where('monthly_employee_id', $request->employee_id)->whereMonth('attendance_month', $current_month)->whereYear('attendance_year', $current_year)->get();

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
                                return response()->json([
                                    'success' => false,
                                    'showButton' => 'check-out',
                                    'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                ])->setStatusCode(200);
                            }

                            $monthly_attendance->save();
                        }
                    } else {

                        $monthly_attendance = new MonthlyAttendance();
                        $monthly_attendance->monthly_com_id = $request->com_id;
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
                            return response()->json([
                                'success' => false,
                                'showButton' => 'check-out',
                                'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                            ])->setStatusCode(200);
                        }

                        $monthly_attendance->save();
                    }

                    ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################


                    return response()->json([
                        'success' => true,
                        'showButton' => 'check-out',
                        'message' => 'Attendance Submitted Successfully',
                    ])->setStatusCode(200);
                } else {

                    //echo 'not ok'; exit;
                    $added_chackin_lat = $usersValue->check_in_latitude + 0.001;
                    $deducted_checkin_lat = $usersValue->check_in_latitude - 0.001;
                    $added_checkin_longi = $usersValue->check_in_longitude + 0.001;
                    $deducted_checkin_longi = $usersValue->check_in_longitude - 0.001;


                    if (($added_chackin_lat >= $request->lat && $deducted_checkin_lat <= $request->lat) || ($added_checkin_longi >= $request->longt && $deducted_checkin_longi <= $request->longt)) {
                        if (Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->exists()) {

                            return response()->json([
                                'success' => false,
                                'showButton' => 'check-out',
                                'message' => 'Already Checked In For Today!!! Please Contact With The System Administrator!!!',
                            ])->setStatusCode(200);
                        } else {

                            $attendance = new Attendance();
                            $attendance->attendance_com_id = $request->com_id;
                            $attendance->employee_id = $request->employee_id;
                            $attendance->attendance_date = $current_date;
                            $attendance->clock_in = $current_time;
                            $attendance->check_in_latitude = $request->lat;
                            $attendance->check_in_longitude = $request->longt;
                            $attendance->check_in_ip = $local_server_ip;
                            if (date_create($current_time) >= date_create($shift_in)) {
                                if ($shift_in != 0 && $shift_out != 0) {

                                    $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');
                                    if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {
                                        if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {
                                            $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                            foreach ($late_times as $late_times_value) {

                                                $late_time = LateTime::find($late_times_value->id);
                                                $late_time->late_time_com_id = $request->com_id;
                                                $late_time->late_time_employee_id = $request->employee_id;
                                                $late_time->late_time_date = $current_date;
                                                $late_time->save();
                                            }
                                        } else {
                                            $late_time = new LateTime();
                                            $late_time->late_time_com_id = $request->com_id;
                                            $late_time->late_time_employee_id = $request->employee_id;
                                            $late_time->late_time_date = $current_date;
                                            $late_time->save();
                                        }
                                  }
                                }
                            }
                            //$attendance->check_in_out = 0;
                            $attendance->check_in_out = 1;
                            $attendance->attendance_status = "Present";
                            $attendance->save();

                            ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
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
                                        return response()->json([
                                            'success' => false,
                                            'showButton' => 'check-out',
                                            'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                        ])->setStatusCode(200);
                                    }

                                    $monthly_attendance->save();
                                }
                            } else {

                                $monthly_attendance = new MonthlyAttendance();
                                $monthly_attendance->monthly_com_id = $request->com_id;
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
                                    return response()->json([
                                        'success' => false,
                                        'showButton' => 'check-out',
                                        'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                    ])->setStatusCode(200);
                                }

                                $monthly_attendance->save();
                            }

                            ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                            return response()->json([
                                'success' => true,
                                'showButton' => 'check-out',
                                'message' => 'Attendance Submitted Successfully',
                            ])->setStatusCode(200);
                        }
                    }else {
                         if ($usersValue->multi_attendance == "1") {

                            $attendance =  new Attendance();
                            $attendance->attendance_com_id = $request->com_id;
                            $attendance->employee_id = $request->employee_id;
                            $attendance->attendance_date = $current_date;
                            $attendance->clock_in = $current_time;
                            $attendance->check_in_latitude = $request->lat;
                            $attendance->check_in_longitude = $request->longt;
                            $attendance->check_in_ip = $local_server_ip;
                            if (date_create($current_time) >= date_create($shift_in)) {
                                if ($shift_in != 0 && $shift_out != 0) {

                                    $attendance->time_late = date_create($shift_in)->diff(date_create($current_time))->format('%H:%i:%s');

                                    if ($current_time_in_seconds >= $office_late_time_config_in_seconds) {
                                        if (LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->exists()) {
                                            $late_times = LateTime::where('late_time_employee_id', $request->employee_id)->where('late_time_date', $current_date)->get('id');

                                            foreach ($late_times as $late_times_value) {

                                                $late_time = LateTime::find($late_times_value->id);
                                                $late_time->late_time_com_id = $request->com_id;
                                                $late_time->late_time_employee_id = $request->employee_id;
                                                $late_time->late_time_date = $current_date;
                                                $late_time->save();
                                            }
                                        } else {
                                            $late_time = new LateTime();
                                            $late_time->late_time_com_id = $request->com_id;
                                            $late_time->late_time_employee_id = $request->employee_id;
                                            $late_time->late_time_date = $current_date;
                                            $late_time->save();
                                        }
                                    }
                                }
                            }
                            //$attendance->check_in_out = 0;
                            $attendance->check_in_out = 1;
                            $attendance->attendance_status = "Present";
                            $attendance->save();

                            ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
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
                                        return response()->json([
                                            'success' => false,
                                            'showButton' => 'check-out',
                                            'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                        ])->setStatusCode(200);
                                    }

                                    $monthly_attendance->save();
                                }
                            } else {

                                $monthly_attendance = new MonthlyAttendance();
                                $monthly_attendance->monthly_com_id = $request->com_id;
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
                                    return response()->json([
                                        'success' => false,
                                        'showButton' => 'check-out',
                                        'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                    ])->setStatusCode(200);
                                }

                                $monthly_attendance->save();
                            }

                            ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                            return response()->json([
                                'success' => true,
                                'showButton' => 'check-out',
                                'message' => 'Attendance Submitted Successfully',
                            ])->setStatusCode(200);
                         }else{
                            if (AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->exists()) {
                                $attempt_counts = AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->get(['id', 'attendance_location_check_in_attempt']);
                                foreach ($attempt_counts as $attempt_counts_value) {
                                    $attendance_location = AttendanceLocation::find($attempt_counts_value->id);
                                    $attendance_location->attendance_location_com_id = $request->com_id;
                                    $attendance_location->attendance_location_employee_id = $request->employee_id;
                                    $attendance_location->attendance_location_date = $current_date;
                                    $attendance_location->attendance_location_check_in_latitude = $request->lat;
                                    $attendance_location->attendance_location_check_in_longitude = $request->longt;
                                    $attendance_location->attendance_location_check_in_attempt = $attempt_counts_value->attendance_location_check_in_attempt + 1;

                                    $attendance_location->save();
                                }
                            } else {
                                $attendance_location = new AttendanceLocation();
                                $attendance_location->attendance_location_com_id = $request->com_id;
                                $attendance_location->attendance_location_employee_id = $request->employee_id;
                                $attendance_location->attendance_location_date = $current_date;
                                $attendance_location->attendance_location_check_in_latitude = $request->lat;
                                $attendance_location->attendance_location_check_in_longitude = $request->longt;
                                $attendance_location->attendance_location_check_in_attempt = 1;

                                $attendance_location->save();
                            }
                            return response()->json([
                               'success' => false,
                               'showButton' => 'check-out',
                               'message' => 'Your Location Not matched, Please Try Again!',
                            ])->setStatusCode(200);
                         }

                    }
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'Your Browser Or Device not Supported Geolocaton',
            ])->setStatusCode(200);
        }
        ////////// Attandance check-in code Ends...
    }

    public function userAttandanceCheckOut(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'com_id' => 'required',
                'employee_id' => 'required',
                'lat' => 'required',
                'longt' => 'required',
                'office_shift_id' => 'required',
                'user_over_time_type' => 'required',
                'over_time_payable' => 'required',
                //'user_over_time_rate' => 'required',
            ]
        );

        $ovr_tym_rate = $request->user_over_time_rate;

        $office_shift = User::where('com_id',$request->com_id)->where('id',$request->employee_id)->first('office_shift_id');
        $office_shift_id = $office_shift->office_shift_id;
        // return response()->json([
        //     'success' => true,
        //      'showButton' => 'check-out',
        //     'message' => 'response from checkout',
        // ])->setStatusCode(200);


        if (!$request->com_id) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'company id field is required!!!',
            ])->setStatusCode(200);
        }


        if (!$request->employee_id) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'employee id field is required!!!',
            ])->setStatusCode(200);
        }

        if (!$request->lat) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'latitude field is required checkout response!!!',
            ])->setStatusCode(200);
        }

        if (!$request->longt) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'longtude field is required!!!',
            ])->setStatusCode(200);
        }

        if (!$office_shift_id) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'office shift id field is required!!!',
            ])->setStatusCode(200);
        }
        if (!$request->user_over_time_type) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'over time type field is required!!!',
            ])->setStatusCode(200);
        }
        if (!$request->over_time_payable) {

            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'over time payable field is required!!!',
            ])->setStatusCode(200);
        }

        if (!$request->user_over_time_rate) {

            // return response()->json([
            //     'success' => false,
            //     'message' => 'over time rate field is required!!!',
            // ])->setStatusCode(200);

            $ovr_tym_rate = 0;
        }

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                //'message'=>$validator->errors(),
                'showButton' => 'check-out',
                'message' => 'some fields are missing!!!',
            ]);
        }


        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');
        //$current_date = "2021-12-04";
        $current_month = $date->format('m');
        $current_year = $date->format('Y');
        $current_date_number = $date->format('d');
        $current_time = $date->format('H:i:s');
        $local_server_ip = $request->ip();
        $current_day_name = date('D', strtotime($current_date));
        //$current_day_name = date('D', strtotime("2022-01-01"));




        if (Attendance::where('employee_id', $request->employee_id)->where('attendance_com_id', $request->com_id)->where('attendance_date', $current_date)->exists()) {
            // return response()->json([
            //     'success' => true,
            //     'attendance_status'=>'Present',
            // ])->setStatusCode(200);
        } else {
            return response()->json([
                'success' => false,
                'showButton' => 'check-in',
                'message' => 'Checkout request will not be accepted untill you check in!',
            ])->setStatusCode(200);
        }


        if ($current_day_name == "Sun") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['sunday_in', 'sunday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->sunday_in;
                    $shift_out = $office_shifts->sunday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-out',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Mon") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['monday_in', 'monday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->monday_in;
                    $shift_out = $office_shifts->monday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-out',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Tue") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['tuesday_in', 'tuesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->tuesday_in;
                    $shift_out = $office_shifts->tuesday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-out',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Wed") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['wednesday_in', 'wednesday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->wednesday_in;
                    $shift_out = $office_shifts->wednesday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-out',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Thu") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['thursday_in', 'thursday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->thursday_in;
                    $shift_out = $office_shifts->thursday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-out',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Fri") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['friday_in', 'friday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->friday_in;
                    $shift_out = $office_shifts->friday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-out',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } elseif ($current_day_name == "Sat") {
            if (OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->exists()) {
                $office_shifts_array = OfficeShift::where('id', '=', $office_shift_id)->where('office_shift_com_id', '=', $request->com_id)->get(['saturday_in', 'saturday_out']);
                foreach ($office_shifts_array as $office_shifts) {
                    $shift_in = $office_shifts->saturday_in;
                    $shift_out = $office_shifts->saturday_out;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'showButton' => 'check-out',
                    'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
                ])->setStatusCode(200);
            }
        } else {
            // $shift_in = 0;
            // $shift_out = 0;
            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'Office Shift Not Set Properly For This Day Yet!!!',
            ])->setStatusCode(200);
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
        $office_late_time_config_minutes = LatetimeConfig::where('latetime_config_com_id', '=', $request->com_id)->first(['minimum_countable_time']);
        $office_late_time_config_in_seconds = $company_shift_in_seconds + $office_late_time_config_minutes->minimum_countable_time * 60;
        $current_time_in_seconds = strtotime($current_time) + 60 * 60;
        ################ Late Time Countable Seconds code code ends here ######################################################


        if (DB::table('leaves')->where('leaves_company_id', $request->com_id)->where('leaves_employee_id', $request->employee_id)->where(function ($query) {
            $query->where('is_half', 0)
                ->orWhereNull('is_half');
        })
            ->where('leaves_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()
        ) { //condition for leave aprovements
            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'You Have Taken A Leave For This Day!!!',
            ])->setStatusCode(200);
        }

        if (Travel::where('travel_com_id', $request->com_id)->where('travel_employee_id', $request->employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $current_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
            return response()->json([
                'success' => false,
                'showButton' => 'check-out',
                'message' => 'You are not permitted to give attendance when you are on traveling!!!',
            ])->setStatusCode(200);
        }

        // if(Holiday::where('holiday_com_id',$request->com_id)->where('holiday_type','=','Weekly-Holiday')->where('holiday_name','=',$current_day_name)->exists()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'You are not permitted to give your attendane on hoilday!!!',
        //     ])->setStatusCode(200);
        // }
        // if(Holiday::where('holiday_com_id',$request->com_id)->where('holiday_type','=','Other-Holiday')->whereRaw('"'.$current_date.'" between `start_date` and `end_date`')->exists()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'You are not permitted to give your attendane on hoilday!!!',
        //     ])->setStatusCode(200);
        // }

        ////////// Attandance checkout code Starts...


        if ($request->lat && $request->longt) {


            $users = User::where('id', $request->employee_id)->get();

            $latitude = $request->lat;
            $longitude = $request->longt;
            $employee_id = $request->employee_id;

            foreach ($users as $usersValue) {

                if ($usersValue->check_out_latitude == '' || $usersValue->check_out_longitude == '' || $usersValue->check_out_latitude == NULL || $usersValue->check_out_longitude == NULL || $usersValue->check_out_latitude === 'No' || $usersValue->check_out_longitude === 'No') {

                    $user = User::find($request->employee_id);
                    $user->check_out_ip = $local_server_ip;
                    $user->check_out_latitude = $request->lat;
                    $user->check_out_longitude = $request->longt;
                    $user->save();

                    $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();


                    foreach ($attendance_employee_id as $attendance_employee_id_value) {

                        $attendance = Attendance::find($attendance_employee_id_value->id);
                        $attendance->clock_out = $current_time;
                        $attendance->check_out_latitude = $request->lat;
                        $attendance->check_out_longitude = $request->longt;
                        $attendance->check_out_ip = $local_server_ip;
                        if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                            if ($shift_in != 0 && $shift_out != 0) {
                                $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                if ($request->over_time_payable == 'Yes' && $request->user_over_time_type == 'Automatic') {
                                    $over_time = new OverTime();
                                    $over_time->over_time_com_id = $request->com_id;
                                    $over_time->over_time_employee_id = $request->employee_id;
                                    $over_time->over_time_type = "Automatic";
                                    $over_time->over_time_date = $current_date;
                                    $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                    $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                    //$over_time->over_time_rate = $request->user_over_time_rate;
                                    $over_time->over_time_rate = $ovr_tym_rate;
                                    $over_time->save();
                                }
                            }
                        }
                        if (date_create($current_time) <= date_create($shift_out)) {
                            if ($shift_in != 0 && $shift_out != 0) {
                                $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                            }
                        }
                        $attendance->total_work = date_create($attendance->clock_in)->diff(date_create($attendance->clock_out))->format('%H:%i:%s');
                        $attendance->check_in_out = 1;
                        $attendance->save();

                        ########################### MONTHLY ATTENDANCE CODE STARTS #########################################
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
                                    return response()->json([
                                        'success' => false,
                                        'showButton' => 'check-in',
                                        'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                    ])->setStatusCode(200);
                                }

                                $monthly_attendance->save();
                            }
                        } else {

                            $monthly_attendance = new MonthlyAttendance();
                            $monthly_attendance->monthly_com_id = $request->com_id;
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
                                return response()->json([
                                    'success' => false,
                                    'showButton' => 'check-in',
                                    'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                ])->setStatusCode(200);
                            }

                            $monthly_attendance->save();
                        }

                        ######################################################### MONTHLY ATTENDANCE CODE ENDS ############################

                        //return back()->with('message','Attendance Checkout Done Successfully');
                        return response()->json([
                            'success' => true,
                            'showButton' => 'check-out',
                            'message' => 'Attendance Checkout Done Successfully',
                        ])->setStatusCode(200);
                    }
                } else {

                    $added_chackout_lat = $usersValue->check_out_latitude + 0.001;
                    $deducted_checkout_lat = $usersValue->check_out_latitude - 0.001;
                    $added_checkout_longi = $usersValue->check_out_longitude + 0.001;
                    $deducted_checkout_longi = $usersValue->check_out_longitude - 0.001;

                    if (($added_chackout_lat >= $request->lat && $deducted_checkout_lat <= $request->lat) || ($added_checkout_longi >= $request->longt && $deducted_checkout_longi <= $request->longt)) {


                        $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();


                        foreach ($attendance_employee_id as $attendance_employee_id_value) {

                            // if($attendance_employee_id_value->check_in_out === 1){

                            //     return back()->with('message','Already Checked Out For Today!!! Please Contact With The System Administrator!!!');

                            // }else{

                            $attendance = Attendance::find($attendance_employee_id_value->id);
                            $attendance->clock_out = $current_time;
                            $attendance->check_out_latitude = $request->lat;
                            $attendance->check_out_longitude = $request->longt;
                            $attendance->check_out_ip = $local_server_ip;
                            if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                    $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                    if ($request->over_time_payable == 'Yes' && $request->user_over_time_type == 'Automatic') {
                                        $over_time = new OverTime();
                                        $over_time->over_time_com_id = $request->com_id;
                                        $over_time->over_time_employee_id = $request->employee_id;
                                        $over_time->over_time_type = "Automatic";
                                        $over_time->over_time_date = $current_date;
                                        $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                        $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                        //$over_time->over_time_rate = $request->user_over_time_rate;
                                        $over_time->over_time_rate = $ovr_tym_rate;
                                        $over_time->save();
                                    }
                                }
                            }
                            if (date_create($current_time) <= date_create($shift_out)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                }
                            }
                            $attendance->check_in_out = 1;
                            $attendance->save();

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
                                        return response()->json([
                                            'success' => false,
                                            'showButton' => 'check-out',
                                            'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                        ])->setStatusCode(200);
                                    }

                                    $monthly_attendance->save();
                                }
                            } else {

                                $monthly_attendance = new MonthlyAttendance();
                                $monthly_attendance->monthly_com_id = $request->com_id;
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
                                   // return back()->with('message', 'Monthly Attendance Date Not Working Properly, Please Check The Error.');
                                    return response()->json([
                                        'success' => false,
                                        'showButton' => 'check-out',
                                        'message' => 'Monthly Attendance Date Not Working Properly, Please Check The Error.',
                                    ])->setStatusCode(200);
                                }

                                $monthly_attendance->save();
                            }
                            return response()->json([
                                'success' => true,
                                'showButton' => 'check-out',
                                'message' => 'Attandance Checkout Done Successfully',
                            ])->setStatusCode(200);

                            //}
                        }
                    } else {

                        if ($usersValue->multi_attendance == "1") {

                        $attendance_employee_id = Attendance::where('employee_id', $request->employee_id)->where('attendance_date', '=', $current_date)->get();

                        foreach ($attendance_employee_id as $attendance_employee_id_value) {


                            $attendance = Attendance::find($attendance_employee_id_value->id);

                            $attendance->clock_out = $current_time;
                            $attendance->check_out_latitude = $request->lat;
                            $attendance->check_out_longitude = $request->longt;
                            $attendance->check_out_ip = $local_server_ip;
                            if (date_create($current_time) >= date_create($payable_over_time_hour)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->overtime = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');

                                    $todays_over_time = date_create($shift_out)->diff(date_create($current_time))->format('%H:%i:%s');
                                    if ($request->over_time_payable == 'Yes' && $request->user_over_time_type == 'Automatic') {
                                        $over_time = new OverTime();
                                        $over_time->over_time_com_id = $request->com_id;
                                        $over_time->over_time_employee_id = $request->employee_id;
                                        $over_time->over_time_type = "Automatic";
                                        $over_time->over_time_date = $current_date;
                                        $over_time->over_time_company_duty_in_seconds = $diff_shift_seconds_for_the_day;
                                        $over_time->over_time_employee_in_seconds = strtotime($todays_over_time) - strtotime('TODAY');
                                        //$over_time->over_time_rate = $request->user_over_time_rate;
                                        $over_time->over_time_rate = $ovr_tym_rate;
                                        $over_time->save();
                                    }
                                }
                            }
                            if (date_create($current_time) <= date_create($shift_out)) {
                                if ($shift_in != 0 && $shift_out != 0) {
                                    $attendance->early_leaving = date_create($current_time)->diff(date_create($shift_out))->format('%H:%i:%s');
                                }
                            }
                            $attendance->check_in_out = 1;
                            $attendance->save();

                        }

                        return response()->json([
                            'success' => true,
                            'showButton' => 'check-out',
                            'message' => 'Attendance Checkout Done Successfully',
                        ])->setStatusCode(200);
                    }else{

                        if (AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->exists()) {
                                $attempt_counts = AttendanceLocation::where('attendance_location_employee_id', $request->employee_id)->where('attendance_location_date', '=', $current_date)->get(['id', 'attendance_location_check_out_attempt']);
                                foreach ($attempt_counts as $attempt_counts_value) {
                                    $attendance_location = AttendanceLocation::find($attempt_counts_value->id);
                                    $attendance_location->attendance_location_com_id = $request->com_id;
                                    $attendance_location->attendance_location_employee_id = $request->employee_id;
                                    $attendance_location->attendance_location_date = $current_date;
                                    $attendance_location->attendance_location_check_out_latitude = $request->lat;
                                    $attendance_location->attendance_location_check_out_longitude = $request->longt;
                                    $attendance_location->attendance_location_check_out_attempt = $attempt_counts_value->attendance_location_check_out_attempt + 1;
                                    $attendance_location->save();
                                }
                            } else {
                                $attendance_location = new AttendanceLocation();
                                $attendance_location->attendance_location_com_id = $request->com_id;
                                $attendance_location->attendance_location_employee_id = $request->employee_id;
                                $attendance_location->attendance_location_date = $current_date;
                                $attendance_location->attendance_location_check_out_latitude = $request->lat;
                                $attendance_location->attendance_location_check_out_longitude = $request->longt;
                                $attendance_location->attendance_location_check_out_attempt = 1;
                                $attendance_location->save();
                            }
                        return response()->json([
                        'success' => false,
                        'showButton' => 'check-out',
                        'message' => 'CheckOut Location Not Match !!! ',
                    ])->setStatusCode(200);
                    }
                  }
                }
            }
        } else {
            return response()->json([
                'success' => true,
                'showButton' => 'check-out',
                'message' => 'Your Browser Or Device not Supported Geolocaton',
            ])->setStatusCode(200);
        }


        ////////// Attandance checkout code Ends...








    }
}
