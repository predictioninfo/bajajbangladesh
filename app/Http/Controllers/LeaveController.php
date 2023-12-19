<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\MonthlyAttendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Holiday;
use App\Models\OfficeShift;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\Region;
use App\Models\Area;
use App\Models\Territory;
use App\Models\Town;
use App\Models\DbHouse;
use App\Models\CompanyCalendar;
use App\Models\Notification;
use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use DateTime;

class LeaveController extends Controller
{
    public function leaveStore(Request $request)
    {

        $validated = $request->validate([
            'employee_id' => 'required',
            'leave_type' => 'required',
            'leave_reason' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));

        ################################ approved leave request existance check code starts ######################################################
        if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->employee_id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $start_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
            return back()->with('message', 'There is an approved leave request in this date range!!!');
        }
        if (DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->employee_id)->where('leaves_status', '=', 'Approved')->whereRaw('"' . $end_date . '" between `leaves_start_date` and `leaves_end_date`')->exists()) { //condition for leave aprovements
            return back()->with('message', 'There is an approved leave request in this date range!!!');
        }

        $leave_dates = DB::table('leaves')->where('leaves_company_id', Auth::user()->com_id)->where('leaves_employee_id', $request->employee_id)->where('leaves_status', '=', 'Approved')->get();

        foreach ($leave_dates as $leave_dates_value) {
            if (($leave_dates_value->leaves_start_date >= $start_date) && ($leave_dates_value->leaves_start_date <= $end_date)) {
                // echo "Approved start date is between two dates";
                return back()->with('message', 'Approved leave request start date exists in this date range!!!');
            }
            if (($leave_dates_value->leaves_end_date >= $start_date) && ($leave_dates_value->leaves_end_date <= $end_date)) {
                // echo "Approved end date is between two dates";
                return back()->with('message', 'Approved leave request end date exists in this date range!!!');
            }
        }
        ################################ approved leave request existance check code ends ##########################################################

        ############### start date and end date should be this month code starts###########
        $requested_start_time = strtotime($start_date);
        $requested_start_time_month = date("m", $requested_start_time);
        $requested_start_time_year = date("Y", $requested_start_time);

        $requested_end_time = strtotime($end_date);
        $requested_end_time_month = date("m", $requested_end_time);
        $requested_end_time_year = date("Y", $requested_end_time);

        $current_month = date('m');
        $current_year = date('Y');

        if ($request->is_half) {
            //No need to check attendance
            if ($start_date != $end_date) {
                return back()->with('message', 'Half leave is allowed only for a single date!!!');
            }
        } else {
            if (($current_date >= $start_date) && ($current_date <= $end_date)) {
                // echo "Current date is between two dates";
                if (Attendance::where('attendance_com_id', Auth::user()->com_id)
                    ->where('employee_id', $request->employee_id)
                    ->where('check_in_out', 1)
                    ->where('attendance_date', $current_date)
                    ->exists()
                ) { //condition for attendance existence for this date
                    return back()->with('message', 'You are not permitted to send this leave request because you already gave your attendance for today!!! Contact with your system administrator for extra support!!!');
                }
            } else {
                //echo "Current date is not between two dates";
            }
        }

        // if($current_month == $requested_start_time_month && $current_year == $requested_start_time_year && $current_month == $requested_end_time_month && $current_year == $requested_end_time_year){
        //     //skip
        // } else {
        //     return back()->with('message','Start Date and End Date Should Be In This Month');
        // }


        ############### start date and end date should be this month code ends ###########

        ############### remaining days checking code starts###########

        $alocated_leave_days = LeaveType::where('id', $request->leave_type)
            ->where('leave_type_company_id', Auth::user()->com_id)
            ->get();

        $number_of_allocated_leave_days = 0;

        foreach ($alocated_leave_days as $alocated_leave_days_value) {

            $number_of_allocated_leave_days += $alocated_leave_days_value->allocated_day;
        }

        $current_year = date("Y");

        $approvel_leave_days_of_this_year = Leave::where('leaves_employee_id', $request->employee_id)
            ->where('leaves_company_id', Auth::user()->com_id)
            ->whereYear('leaves_start_date', '=', $current_year)
            ->where('leaves_leave_type_id', '=', $request->leave_type)
            ->where('leaves_status', '=', 'Approved')
            ->get();

        $number_of_approved_leave_days = 0;

        foreach ($approvel_leave_days_of_this_year as $approvel_leave_days_of_this_year_value) {

            $diff = strtotime($approvel_leave_days_of_this_year_value->leaves_end_date) - strtotime($approvel_leave_days_of_this_year_value->leaves_start_date);
            $days = abs(round($diff / 86400));
            $number_of_approved_leave_days += $days + 1;
        }



        function dateDiffInDays($date1, $date2)
        {
            $diff = strtotime($date2) - strtotime($date1);
            return abs(round($diff / 86400));
        }

        // Start date
        $date1 = $start_date;
        // End date
        $date2 = $end_date;

        $dateDiff = dateDiffInDays($date1, $date2);

        $number_of_requested_leave_days = $dateDiff + 1;

        // echo $number_of_requested_leave_days; echo "<br>";
        //  echo $number_of_allocated_leave_days; echo "<br>";
        //  echo $number_of_approved_leave_days;

        //exit;

        if ($number_of_approved_leave_days >= $number_of_allocated_leave_days) {
            return back()->with('message', 'You have already taken all the leaves!!!');
        } else {

            $leave_days_remaining = $number_of_allocated_leave_days - $number_of_approved_leave_days;
            if ($number_of_requested_leave_days >= $leave_days_remaining) {
                return back()->with('message', 'Sorry, Limit Exceed!!! You can not take a leave for more than ' . $leave_days_remaining . ' days in this year!!!');
            }
        }


        ############### remaining days checking code ends###########


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

        $random_key = generateRandomString() . $request->employee_id;

        ############### random key generate code staendsrts###########



        $users = User::where('id', '=', $request->employee_id)
            ->where('com_id', Auth::user()->com_id)
            ->get(['com_id', 'report_to_parent_id', 'email', 'first_name', 'last_name', 'department_id', 'designation_id', 'region_id', 'joining_date']);
        foreach ($users as $users) {

            if (
                $users->department_id == '' || $users->department_id == Null ||
                $users->designation_id == '' || $users->designation_id == Null
                // $users->region_id == '' || $users->region_id == Null
                // $users->area_id == '' || $users->area_id == Null ||
                // $users->territory_id == '' || $users->territory_id == Null ||
                // $users->town_id == '' || $users->town_id == Null ||
                // $users->db_house_id == '' || $users->db_house_id == Null

            ) {
                return back()->with('message', 'Department, Designation Not Set Properly');
            }

            if ($users->report_to_parent_id == '' || $users->report_to_parent_id == Null) {

                return back()->with('message', 'Supervisor Not Set Yet!!!');
            } else {

                $generation_one_details = User::where('id', '=', $users->report_to_parent_id)
                    ->where('com_id', Auth::user()->com_id)
                    ->get(['com_id', 'report_to_parent_id', 'email']);
                foreach ($generation_one_details as $generation_one_details_value) {

                    $leave = new Leave();
                    $leave->leaves_token = $random_key;
                    $leave->leaves_company_id = Auth::user()->com_id;
                    $leave->leaves_leave_type_id = $request->leave_type;
                    $leave->leaves_department_id = $users->department_id;
                    $leave->leaves_designation_id = $users->designation_id;
                    $leave->leaves_employee_id = $request->employee_id;
                    $leave->assigned_employee_id = $request->assigned_employee_id;
                    $leave->leaves_approver_generation_one_id = $users->report_to_parent_id;
                    $leave->leaves_approver_generation_two_id = $generation_one_details_value->report_to_parent_id;
                    $leave->leaves_start_date = $start_date;
                    $leave->leaves_end_date = $end_date;
                    if ($request->file('leave_document')) {
                        $image = $request->file('leave_document');
                        $input['imagename'] = time() . '.' . $image->extension();
                        $filePath = 'uploads/employee-document-files';
                        $imageUrl = $filePath . '/' . $input['imagename'];
                        $imageStoring = $image->move($filePath, $input['imagename']);
                        $leave->leave_document = $imageUrl;
                    }
                    $leave->total_days = $number_of_requested_leave_days;
                    $leave->leave_reason = $request->leave_reason;
                    $leave->leaves_status = "Pending";
                    $leave->leaves_region_id = $users->region_id;
                    $leave->leaves_area_id = $users->area_id;
                    $leave->leaves_territory_id = $users->territory_id;
                    $leave->leaves_town_id = $users->town_id;
                    $leave->leaves_db_house_id = $users->db_house_id;
                    $leave->is_half = $request->is_half;
                    $leave->save();
                    if ($generation_one_details_value->report_to_parent_id == '' || $generation_one_details_value->report_to_parent_id == Null) {

                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = Auth::user()->com_id;
                        $notification->notification_type = "Leave";
                        $notification->notification_title = "You Have A New Leave Request To Approve";
                        $notification->notification_from = $request->employee_id;
                        $notification->notification_to = $users->report_to_parent_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();

                        $data["email"] = $generation_one_details_value->email;
                        $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                        $data["subject"] = "Leave Request";

                        $sender_name = array(
                            'pay_slip_net_salary' => $data["request_sender_name"],
                        );

                        Mail::send('back-end.premium.emails.leave-request', [
                            'sender_name' => $sender_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_sender_name"])
                                ->subject($data["subject"]);
                        });
                    } else {

                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = Auth::user()->com_id;
                        $notification->notification_type = "Leave";
                        $notification->notification_title = "You Have A New Leave Request To Approve";
                        $notification->notification_from = $request->employee_id;
                        $notification->notification_to = $users->report_to_parent_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();

                        $notification_second = new Notification();
                        $notification_second->notification_token = $random_key;
                        $notification_second->notification_com_id = Auth::user()->com_id;
                        $notification_second->notification_type = "Leave";
                        $notification_second->notification_title = "You Have A New Leave Request To Approve";
                        $notification_second->notification_from = $request->employee_id;
                        $notification_second->notification_to = $generation_one_details_value->report_to_parent_id;
                        $notification_second->notification_status = "Unseen";
                        $notification_second->save();


                        $generation_two_details = User::where('id', '=', $generation_one_details_value->report_to_parent_id)->get('email');
                        $peoxy_employee = User::where('id', '=', $request->assigned_employee_id)->first('email');

                        foreach ($generation_two_details as $generation_two_details_value) {

                            ######## first generation email##########
                            $data["email"] = $generation_one_details_value->email;
                            $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                            $data["subject"] = "Leave Request";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.leave-request', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });

                            ######## first generation email ends##########

                            ######## second generation email##########
                            $data["email"] = $generation_two_details_value->email;
                            $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                            $data["subject"] = "Leave Request";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.leave-request', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });

                            ######## second generation email ends##########


                            $data["email"] = $peoxy_employee->email;
                            $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                            $data["subject"] = "Employees Proxy";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.employee-proxy', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });
                        }
                    }
                }

                return back()->with('message', 'Sent!!');
            }
        }
    }


    public function leaveDetailsById(Request $request)
    {
        $where = array('id' => $request->id);
        $leaves_details_by_id = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')->select('leaves.*', 'users.first_name')->where('id', '=', $where)->get();
        return response()->json($leaves_details_by_id);
    }

    public function leaveById(Request $request)
    {

        $where = array('id' => $request->id);
        $leaves  = Leave::where($where)->first();

        return response()->json($leaves);
    }

    public function updateType(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required',
            'allocated_day' => 'required',
        ]);

        $leave = Leave::find($request->id);
        $leave->leave_type_company_id = Auth::user()->com_id;
        $leave->leave_type = $request->leave_type;
        $leave->allocated_day = $request->allocated_day;
        $leave->save();

        return back()->with('message', 'Updated Successfully');
    }

    public function deleteLeave($id)
    {
        $leave_token_details = Leave::where('id', '=', $id)->first('leaves_token');
        if ($leave_token_details->leaves_token != NULL) {
            $notification_delete = Notification::where('notification_token', $leave_token_details->leaves_token)->delete();
        }

        $leave = Leave::where('id', $id)->delete();

        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteLeave(Request $request)
    {

        $leave_token_details = Leave::where('leaves_company_id', $request->bulk_delete_com_id)->get(['leaves_token']);
        foreach ($leave_token_details as $leave_token_details_value) {
            $notification_delete = Notification::where('notification_token', $leave_token_details_value->leaves_token)->delete();
        }

        $leave = Leave::where('leaves_company_id', $request->bulk_delete_com_id)->delete();

        return back()->with('message', 'Deleted Successfully');
    }

    public function approveLeave($id, $leave_approver_id)
    {
        $leave = Leave::find($id);
        $leave->leaves_status = "Approved";
        $leave->save();
        $approver_id = Leave::where('id', '=', $id)->first(['leaves_start_date', 'leaves_end_date', 'leave_reason', 'leaves_employee_id', 'leaves_token']);
        $sender_details = User::where('id', '=', $approver_id->leaves_employee_id)->get(['email', 'first_name', 'last_name']);
        $approvers_details = User::where('id', $leave_approver_id)->get(['first_name', 'last_name']);

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
        $random_key = generateRandomString();
        ############### random key generate code staendsrts###########


        foreach ($sender_details as $sender_details_value) {
            foreach ($approvers_details as $approvers_details_value) {

                $notification = new Notification();
                $notification->notification_token = $random_key;
                $notification->notification_com_id = Auth::user()->com_id;
                $notification->notification_type = "Leave-Approved";
                $notification->notification_title = "Your Leave Request was Approved";
                $notification->notification_from = $leave_approver_id;
                $notification->notification_to = $approver_id->leaves_employee_id;
                $notification->notification_status = "Unseen";
                $notification->save();

                if ($approver_id->leaves_token != NULL) {
                    $notification_delete = Notification::where('notification_token', $approver_id->leaves_token)->delete();
                }

                $event = new CompanyCalendar();
                $event->company_calendar_com_id = Auth::user()->com_id;
                $event->company_calendar_employee_id = $approver_id->leaves_employee_id;
                $event->company_calendar_employee_name = $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                $event->title = "Leave for " . $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                $event->calander_detail_type = "Leave";
                $event->calander_details = $approver_id->leave_reason;
                $event->start = $approver_id->leaves_start_date;
                $event->end = $approver_id->leaves_end_date;
                $event->save();

                $data["email"] = $sender_details_value->email;
                $data["request_receiver_name"] = $approvers_details_value->first_name . ' ' . $approvers_details_value->last_name;
                $data["subject"] = "Request Acceptance";

                $receiver_name = array(
                    'request_receiver_name' => $data["request_receiver_name"],
                );

                Mail::send('back-end.premium.emails.approve-request', [
                    'receiver_name' => $receiver_name,

                ], function ($message) use ($data) {
                    $message->to($data["email"], $data["request_receiver_name"])->subject($data["subject"]);
                });
            }
        }

        return back()->with('message', 'Approved Successfully');
    }

    public function editAndApproveLeave(Request $request)
    {

        $approver_id = Leave::where('id', '=', $request->id)->first(['leaves_start_date', 'leaves_end_date', 'leave_reason', 'leaves_employee_id', 'leaves_token']);
        $sender_details = User::where('id', '=', $approver_id->leaves_employee_id)->get(['email', 'first_name', 'last_name']);
        $approvers_details = User::where('id', Auth::user()->id)->get(['first_name', 'last_name']);


        if ($request->leave_status == "Approved") {

            if (($approver_id->leaves_start_date <= $request->start_date) && ($approver_id->leaves_end_date >= $request->end_date)) {
                $leave = Leave::find($request->id);
                $leave->leaves_status = "Approved";
                $leave->leaves_start_date = $request->start_date;
                $leave->leaves_end_date = $request->end_date;
                $leave->save();
            } else {
                return back()->with('message', 'You are not permitted to extend the date range. Only you can reduce the date range');
            }



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
            $random_key = generateRandomString();
            ############### random key generate code staendsrts###########


            foreach ($sender_details as $sender_details_value) {
                foreach ($approvers_details as $approvers_details_value) {

                    $notification = new Notification();
                    $notification->notification_token = $random_key;
                    $notification->notification_com_id = Auth::user()->com_id;
                    $notification->notification_type = "Leave-Approved";
                    $notification->notification_title = "Your Leave Request was Approved";
                    $notification->notification_from = Auth::user()->id;
                    $notification->notification_to = $approver_id->leaves_employee_id;
                    $notification->notification_status = "Unseen";
                    $notification->save();

                    if ($approver_id->leaves_token != NULL) {
                        $notification_delete = Notification::where('notification_token', $approver_id->leaves_token)->delete();
                    }

                    $event = new CompanyCalendar();
                    $event->company_calendar_com_id = Auth::user()->com_id;
                    $event->company_calendar_employee_id = $approver_id->leaves_employee_id;
                    $event->company_calendar_employee_name = $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                    $event->title = "Leave for " . $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                    $event->calander_detail_type = "Leave";
                    $event->calander_details = $approver_id->leave_reason;
                    $event->start = $approver_id->leaves_start_date;
                    $event->end = $approver_id->leaves_end_date;
                    $event->save();

                    $data["email"] = $sender_details_value->email;
                    $data["request_receiver_name"] = $approvers_details_value->first_name . ' ' . $approvers_details_value->last_name;
                    $data["subject"] = "Request Acceptance";

                    $receiver_name = array(
                        'request_receiver_name' => $data["request_receiver_name"],
                    );

                    Mail::send('back-end.premium.emails.approve-request', [
                        'receiver_name' => $receiver_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_receiver_name"])->subject($data["subject"]);
                    });
                }
            }

            return back()->with('message', 'Approved Successfully');
        } else {

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
            $random_key = generateRandomString();
            ############### random key generate code staendsrts###########

            $leave = Leave::find($request->id);
            $leave->leaves_status = "Denied";
            $leave->save();

            foreach ($sender_details as $sender_details_value) {
                foreach ($approvers_details as $approvers_details_value) {

                    $notification = new Notification();
                    $notification->notification_token = $random_key;
                    $notification->notification_com_id = Auth::user()->com_id;
                    $notification->notification_type = "Leave-Request-Denied";
                    $notification->notification_title = "Your Leave Request was Denied";
                    $notification->notification_from = Auth::user()->id;
                    $notification->notification_to = $approver_id->leaves_employee_id;
                    $notification->notification_status = "Unseen";
                    $notification->save();

                    if ($approver_id->leaves_token != NULL) {
                        $notification_delete = Notification::where('notification_token', $approver_id->leaves_token)->delete();
                    }

                    $data["email"] = $sender_details_value->email;
                    $data["request_receiver_name"] = $approvers_details_value->first_name . ' ' . $approvers_details_value->last_name;
                    $data["subject"] = "Leave Request Denied";

                    $receiver_name = array(
                        'request_receiver_name' => $data["request_receiver_name"],
                    );

                    Mail::send('back-end.premium.emails.deny-request', [
                        'receiver_name' => $receiver_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_receiver_name"])->subject($data["subject"]);
                    });
                }
            }
            return back()->with('message', 'Denied Successfully');
        }
    }
}
