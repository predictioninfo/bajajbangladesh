<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompensatoryLeave;
use App\Models\Attendance;
use App\Models\Travel;
use App\Models\Holiday;
use App\Models\Leave;
use Illuminate\Http\Request;
use Auth;
use DB;
use DateTime;
use Mail;

class CompensatoryLeaveController extends Controller
{
    public function compensatoryLeavesSet(Request $request)
    {

        $current_day_name = date('D', strtotime($request->compen_leave_date));
        //$current_day_name = date('D', strtotime("2022-01-01"));
        $start_date = date('Y-m-d', strtotime($request->compen_leave_date));
        $end_date = date('Y-m-d', strtotime($request->compen_leave_date));

        ################################ compensatory leave approved request existance check code starts ######################################################
        if (CompensatoryLeave::where('compen_leave_com_id', Auth::user()->com_id)->where('compen_leave_employee_id', $request->compen_leave_employee_id)->where('compen_leave_status', 1)->whereDate('compen_leave_date', $start_date)->exists()) { //condition for compensatory leave aprovements
            return back()->with('message', 'There is an approved compensatory leave on this date!!!');
        }
        ################################  compensatory leave approved request existance check code ends ##########################################################
        ################################ approved leave request existance check code starts ######################################################
        if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->compen_leave_employee_id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $start_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
            return back()->with('message', 'There is an approved leave request in this date range!!!');
        }
        ################################ approved leave request existance check code ends ##########################################################
        ################################ attendance existance check code starts ######################################################
        if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $request->compen_leave_employee_id)->whereDate('attendance_date', $start_date)->exists()) { //condition for attendance existence of the current date
            return back()->with('message', 'You gave your attendance on that day!!!');
        }
        ################################ attendance existance check code ends ######################################################
        ################################ Approved travel request existance check code starts ######################################################
        if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->compen_leave_employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $start_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
            return back()->with('message', 'You are not permitted to send the request while you are already on traveling!!!');
        }
        ################################ attendance existance check code starts ######################################################

        ################################ Holiday existance check code starts ######################################################
        if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->where('holiday_name', $current_day_name)->exists()) { //condition for weekly holiday
            //echo "yes";
            return back()->with('message', 'The requested date is already a holiday!!!');
        } else {
            if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereRaw('"' . $start_date . '" between `start_date` and `end_date`')->exists()) { //condition for weekly holiday
                //echo "yes";
                return back()->with('message', 'The requested date is already a holiday!!!');
            }
        }
        ################################ Holiday existance check code starts ######################################################


        $users = User::where('id', $request->compen_leave_employee_id)->get(['report_to_parent_id', 'email']);
        foreach ($users as $user) {
            $first_supervisors = User::where('id', $user->report_to_parent_id)->get(['report_to_parent_id', 'email']);
            foreach ($first_supervisors as $first_supervisors_value) {
                if ($first_supervisors_value->report_to_parent_id) {

                    $compensatory_leave = CompensatoryLeave::find($request->id);
                    $compensatory_leave->compen_leave_approver_one_id = $user->report_to_parent_id;
                    $compensatory_leave->compen_leave_approver_two_id = $first_supervisors_value->report_to_parent_id;
                    $compensatory_leave->compen_leave_date = $request->compen_leave_date;
                    $compensatory_leave->compen_leave_dsec = $request->compen_leave_dsec;
                    $compensatory_leave->compen_leave_status = 0;
                    $compensatory_leave->save();

                    try {
                        ######## first generation email##########
                        $data["email"] = $first_supervisors_value->email;
                        $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
                        $data["subject"] = "Compensatory Leave Request";

                        $sender_name = array(
                            'pay_slip_net_salary' => $data["request_sender_name"],
                        );

                        Mail::send('back-end.premium.emails.compesatory', [
                            'sender_name' => $sender_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_sender_name"])
                                ->subject($data["subject"]);
                        });

                        ######## first generation email ends##########

                        $second_supervisors = User::where('id', $first_supervisors_value->report_to_parent_id)->get(['report_to_parent_id', 'email']);

                        foreach ($second_supervisors as $second_supervisors_value) {
                            if ($second_supervisors_value->report_to_parent_id) {
                                ######## Second generation email##########
                                $data["email"] = $second_supervisors_value->email;
                                $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
                                $data["subject"] = "Compensatory Leave Request";

                                $sender_name = array(
                                    'pay_slip_net_salary' => $data["request_sender_name"],
                                );

                                Mail::send('back-end.premium.emails.compesatory', [
                                    'sender_name' => $sender_name,
                                ], function ($message) use ($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                });

                                ######## Second generation email ends##########
                            }
                        }
                    } catch (\Exception $e) {
                        return back()->with('message', 'Setup a valid email to notify Supervisor');
                    }
                } else {
                    $compensatory_leave = CompensatoryLeave::find($request->id);
                    $compensatory_leave->compen_leave_approver_one_id = $user->report_to_parent_id;
                    $compensatory_leave->compen_leave_date = $request->compen_leave_date;
                    $compensatory_leave->compen_leave_dsec = $request->compen_leave_dsec;
                    $compensatory_leave->compen_leave_status = 0;
                    $compensatory_leave->save();
                }
            }
        }
        return back()->with('message', 'Set Successfully');
    }

    public function compensatoryLeavesApprove($id)
    {

        $compensatory_details = CompensatoryLeave::where('id', $id)->get();

        foreach ($compensatory_details as $compensatory_details_value) {

            $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
            $current_date = $date->format('Y-m-d');
            //$current_date = "2021-12-04";
            $current_month = $date->format('m');
            $current_year = $date->format('Y');
            $current_date_number = $date->format('d');
            $current_time = $date->format('H:i:s');
            //$local_server_ip = $request->ip();
            $current_day_name = date('D', strtotime($compensatory_details_value->compen_leave_date));
            //$current_day_name = date('D', strtotime("2022-01-01"));

            $start_date = date('Y-m-d', strtotime($compensatory_details_value->compen_leave_date));
            $end_date = date('Y-m-d', strtotime($compensatory_details_value->compen_leave_date));

            ################################ compensatory leave approved request existance check code starts ######################################################
            if (CompensatoryLeave::where('compen_leave_com_id', Auth::user()->com_id)->where('compen_leave_employee_id', $compensatory_details_value->compen_leave_employee_id)->where('compen_leave_status', 1)->whereDate('compen_leave_date', $start_date)->exists()) { //condition for compensatory leave aprovements
                return back()->with('message', 'There is an approved compensatory leave on this date!!!');
            }
            ################################  compensatory leave approved request existance check code ends ##########################################################

            ################################ approved leave request existance check code starts ######################################################
            if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $compensatory_details_value->compen_leave_employee_id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $start_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
                return back()->with('message', 'There is an approved leave request in this date range for this employee!!!');
            }
            ################################ approved leave request existance check code ends ##########################################################
            ################################ attendance existance check code starts ######################################################
            if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $compensatory_details_value->compen_leave_employee_id)->whereDate('attendance_date', $start_date)->exists()) { //condition for attendance existence of the current date
                return back()->with('message', 'The employee gave his attendance on this day!!!');
            }
            ################################ attendance existance check code ends ######################################################
            ################################ Approved travel request existance check code starts ######################################################
            if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $compensatory_details_value->compen_leave_employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $start_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                return back()->with('message', 'The employee is not permitted to get approved his/her request while he/she is already on traveling!!!');
            }
            ################################ attendance existance check code starts ######################################################
            ################################ Holiday existance check code starts ######################################################
            if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Weekly-Holiday')->where('holiday_name', $current_day_name)->exists()) { //condition for weekly holiday
                //echo "yes";
                return back()->with('message', 'The requested date is already a holiday!!!');
            } else {
                if (Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereRaw('"' . $start_date . '" between `start_date` and `end_date`')->exists()) { //condition for weekly holiday
                    //echo "yes";
                    return back()->with('message', 'The requested date is already a holiday!!!');
                }
            }
            ################################ Holiday existance check code starts ######################################################
            ############### random key generate code starts###########
            function generateRandomString($length = 25)
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            $random_key = generateRandomString() . $compensatory_details_value->compen_leave_employee_id;
            ############### random key generate code staendsrts###########

            $users = User::where('com_id', $compensatory_details_value->compen_leave_com_id)->where('id', $compensatory_details_value->compen_leave_employee_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name', 'department_id', 'designation_id', 'region_id', 'area_id', 'territory_id', 'town_id', 'db_house_id']);

            foreach ($users as $users) {

                if ($users->department_id == '' || $users->department_id == Null) {
                    return back()->with('message', 'Department Not Set Properly');
                } elseif ($users->designation_id == '' || $users->designation_id == Null) {
                    return back()->with('message', 'Designation Not Set Properly');
                }

                if ($users->report_to_parent_id == '' || $users->report_to_parent_id == Null) {
                    return back()->with('message', 'Supervisor Not Set Yet!!!');
                } else {
                    try {
                        $generation_one_details = User::where('id', '=', $users->report_to_parent_id)->get(['report_to_parent_id', 'email']);
                        foreach ($generation_one_details as $generation_one_details_value) {

                            $leave = new Leave();
                            $leave->leaves_token = $random_key;
                            $leave->leaves_company_id = Auth::user()->com_id;
                            $leave->leaves_leave_type_id = 0;
                            $leave->leaves_department_id = $users->department_id;
                            $leave->leaves_designation_id = $users->designation_id;
                            $leave->leaves_employee_id = $compensatory_details_value->compen_leave_employee_id;
                            $leave->leaves_approver_generation_one_id = $users->report_to_parent_id;
                            $leave->leaves_approver_generation_two_id = $generation_one_details_value->report_to_parent_id;
                            $leave->leaves_start_date = $start_date;
                            $leave->leaves_end_date = $end_date;
                            $leave->total_days = 1;
                            $leave->leave_reason = "Compensatory Leave";
                            $leave->leaves_status = "Approved";
                            $leave->leaves_region_id = $users->region_id;
                            $leave->leaves_area_id = $users->area_id;
                            $leave->leaves_territory_id = $users->territory_id;
                            $leave->leaves_town_id = $users->town_id;
                            $leave->leaves_db_house_id = $users->db_house_id;
                            //$leave->is_half = $request->is_half;

                            $leave->save();



                            $compensatory_leave = CompensatoryLeave::find($id);
                            $compensatory_leave->compen_leave_status = 1;
                            $compensatory_leave->save();

                            ######## email portion code starts #################
                            $data["email"] = $users->email;
                            $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                            $data["subject"] = "Compensatory Leave Request Acceptance Status";

                            $receiver_name = array(
                                'request_receiver_name' => $data["request_receiver_name"],
                            );

                            Mail::send('back-end.premium.emails.compensatory-leave-aprove', [
                                'receiver_name' => $receiver_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_receiver_name"])->subject($data["subject"]);
                            });

                            ######## email portion code ends ###################


                        }
                    } catch (\Exception $e) {
                        return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
                    }
                }
            }



            // terms of checking someting will be added here.....

            return back()->with('message', 'Approved Successfully');
        }
    }
}
