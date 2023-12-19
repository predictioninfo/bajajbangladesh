<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
use DB;
use Mail;

class ComplaintController extends Controller
{
    public function complaintAdd(Request $request)
    {
        $validated = $request->validate([
            'complaint_from_department_id' => 'required',
            'complaint_from_employee_id' => 'required',
            'complaint_to_department_id' => 'required',
            'complaint_to_employee_id' => 'required',
            'complaint_date' => 'required',
            'complaint_title' => 'required',
            'complaint_desc' => 'required',
        ]);

        try {
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
            $start_date = date('Y-m-d', strtotime($request->complaint_date));

            $complaint = new Complaint();
            $complaint->complaint_com_id = Auth::user()->com_id;
            $complaint->complaint_from_department_id = $request->complaint_from_department_id;
            $complaint->complaint_from_employee_id = $request->complaint_from_employee_id;
            $complaint->complaint_to_department_id = $request->complaint_to_department_id;
            $complaint->complaint_to_employee_id = $request->complaint_to_employee_id;
            $complaint->complaint_date = $start_date;
            $complaint->complaint_title = $request->complaint_title;
            $complaint->complaint_desc = $request->complaint_desc;
            $complaint->save();

            $users_notifications = User::where('id', '=', $request->complaint_to_employee_id)->get(['email', 'first_name', 'last_name']);

            foreach ($users_notifications as $users_notification) {

                $notification = new Notification();
                $notification->notification_token = $random_key;
                $notification->notification_com_id = Auth::user()->com_id;
                $notification->notification_type = "Complaint";
                $notification->notification_title = "You Have A Complaint";
                $notification->notification_from = $request->complaint_from_employee_id;
                $notification->notification_to = $request->complaint_to_employee_id;
                $notification->notification_status = "Unseen";
                $notification->save();
            }

            $users = User::where('id', '=', $request->complaint_to_employee_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name', 'department_id', 'designation_id', 'region_id', 'area_id', 'territory_id', 'town_id', 'db_house_id']);

            foreach ($users as $user) {
                ########email for admin start##########

                $users_names = User::where('id', '=', $request->complaint_from_employee_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name']);
                foreach ($users_names as $users_name) {
                    $admins = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('user_admin_status', 1)->get(['email']);
                    foreach ($admins as $admins_value) {

                        $data["email"] = $admins_value->email;
                        $data["request_sender_name"] = $users_name->first_name . ' ' . $users_name->last_name;

                        $data["complaint_against_name"] = $user->first_name . ' ' . $user->last_name;
                        $data["subject"] = "Complaint";

                        $sender_name = array(
                            'pay_slip_net_salary' => $data["request_sender_name"],
                        );
                        $complaint_against_name = array(
                            'complaint_against_name' => $data["complaint_against_name"]
                        );
                        Mail::send('back-end.premium.emails.complaint', [
                            'sender_name' => $sender_name,
                            'complaint_against_name' => $complaint_against_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_sender_name"])
                                ->subject($data["subject"]);
                        });
                    }
                    ########email for admin ends ##########

                    if ($user->report_to_parent_id == '' || $user->report_to_parent_id == Null) {

                        return back()->with('message', 'Supervisor Not Set Yet!!!');
                    } else {
                        $generation_one_details = User::where('com_id', Auth::user()->com_id)->where('id', '=', $user->report_to_parent_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name']);
                        foreach ($generation_one_details as $generation_one_details_value) {

                            ######## first generation email##########
                            $data["email"] = $generation_one_details_value->email;
                            $data["request_sender_name"] = $users_name->first_name . ' ' . $users_name->last_name;
                            $data["complaint_against_name"] = $user->first_name . ' ' . $user->last_name;
                            $data["subject"] = "Complaint";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );
                            $complaint_against_name = array(
                                'complaint_against_name' => $data["complaint_against_name"]
                            );
                            Mail::send('back-end.premium.emails.complaint', [
                                'sender_name' => $sender_name,
                                'complaint_against_name' => $complaint_against_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });

                            ######## first generation email ends##########
                            $generation_two_details = User::where('id', '=', $generation_one_details_value->report_to_parent_id)->whereNotNull('email')->get(['report_to_parent_id', 'email']);

                            foreach ($generation_two_details as $generation_two_details_value) {

                                ######## second generation email ##########
                                $data["email"] = $generation_two_details_value->email;
                                $data["request_sender_name"] = $users_name->first_name . ' ' . $users_name->last_name;
                                $data["complaint_against_name"] = $user->first_name . ' ' . $user->last_name;
                                $data["subject"] = "Complaint";

                                $sender_name = array(
                                    'pay_slip_net_salary' => $data["request_sender_name"],
                                );
                                $complaint_against_name = array(
                                    'complaint_against_name' => $data["complaint_against_name"]
                                );

                                Mail::send('back-end.premium.emails.complaint', [
                                    'sender_name' => $sender_name,
                                    'complaint_against_name' => $complaint_against_name,
                                ], function ($message) use ($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                });
                                ######## second generation email ends ##########
                            }
                        }
                    }
                }
            }

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }

    public function EmployeeComplaintAdd(Request $request)
    {
        $validated = $request->validate([
            'complaint_from_department_id' => 'required',
            'complaint_from_employee_id' => 'required',
            'complaint_to_department_id' => 'required',
            'complaint_to_employee_id' => 'required',
            'complaint_date' => 'required',
            'complaint_title' => 'required',
            'complaint_desc' => 'required',
        ]);

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


        $start_date = date('Y-m-d', strtotime($request->complaint_date));

        $complaint = new Complaint();
        $complaint->complaint_com_id = Auth::user()->com_id;
        $complaint->complaint_from_department_id = $request->complaint_from_department_id;
        $complaint->complaint_from_employee_id = $request->complaint_from_employee_id;
        $complaint->complaint_to_department_id = $request->complaint_to_department_id;
        $complaint->complaint_to_employee_id = $request->complaint_to_employee_id;
        $complaint->complaint_date = $start_date;
        $complaint->complaint_title = $request->complaint_title;
        $complaint->complaint_desc = $request->complaint_desc;
        $complaint->save();

        $users_notifications = User::where('id', '=', $request->complaint_to_employee_id)->get(['email', 'first_name', 'last_name']);

        foreach ($users_notifications as $users_notification) {

            $notification = new Notification();
            $notification->notification_token = $random_key;
            $notification->notification_com_id = Auth::user()->com_id;
            $notification->notification_type = "Complaint";
            $notification->notification_title = "You Have A Complaint";
            $notification->notification_from = $request->complaint_from_employee_id;
            $notification->notification_to = $request->complaint_to_employee_id;
            $notification->notification_status = "Unseen";
            $notification->save();
        }
        $users = User::where('id', '=', $request->complaint_to_employee_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name', 'department_id', 'designation_id', 'region_id', 'area_id', 'territory_id', 'town_id', 'db_house_id']);

        foreach ($users as $user) {
            ########email for admin start ##########
            $users_names = User::where('id', '=', $request->complaint_from_employee_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name']);
            foreach ($users_names as $users_name) {
                $admins = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('user_admin_status', 1)->get(['report_to_parent_id', 'email']);
                foreach ($admins as $admins_value) {

                    $data["email"] = $admins_value->email;
                    $data["request_sender_name"] = $users_name->first_name . ' ' . $users_name->last_name;
                    $data["complaint_against_name"] = $user->first_name . ' ' . $user->last_name;
                    $data["subject"] = "Complaint";

                    $sender_name = array(
                        'pay_slip_net_salary' => $data["request_sender_name"],
                    );
                    $complaint_against_name = array(
                        'complaint_against_name' => $data["complaint_against_name"]
                    );
                    Mail::send('back-end.premium.emails.complaint', [
                        'sender_name' => $sender_name,
                        'complaint_against_name' => $complaint_against_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_sender_name"])
                            ->subject($data["subject"]);
                    });
                }
                ########email for admin ends ##########

                if ($user->report_to_parent_id == '' || $user->report_to_parent_id == Null) {

                    return back()->with('message', 'Supervisor Not Set Yet!!!');
                } else {
                    $generation_one_details = User::where('id', '=', $user->report_to_parent_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name']);
                    foreach ($generation_one_details as $generation_one_details_value) {

                        ######## first generation email ##########
                        $data["email"] = $generation_one_details_value->email;
                        $data["request_sender_name"] = $users_name->first_name . ' ' . $users_name->last_name;
                        $data["complaint_against_name"] = $user->first_name . ' ' . $user->last_name;
                        $data["subject"] = "Complaint";

                        $sender_name = array(
                            'pay_slip_net_salary' => $data["request_sender_name"],
                        );
                        $complaint_against_name = array(
                            'complaint_against_name' => $data["complaint_against_name"]
                        );
                        Mail::send('back-end.premium.emails.complaint', [
                            'sender_name' => $sender_name,
                            'complaint_against_name' => $complaint_against_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_sender_name"])
                                ->subject($data["subject"]);
                        });

                        ######## first generation email ends ##########

                        $generation_two_details = User::where('id', '=', $generation_one_details_value->report_to_parent_id)->get(['report_to_parent_id', 'email']);



                        foreach ($generation_two_details as $generation_two_details_value) {

                            ######## second generation email ##########
                            $data["email"] = $generation_two_details_value->email;
                            $data["request_sender_name"] = $users_name->first_name . ' ' . $users_name->last_name;
                            $data["complaint_against_name"] = $user->first_name . ' ' . $user->last_name;
                            $data["subject"] = "Complaint";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );
                            $complaint_against_name = array(
                                'complaint_against_name' => $data["complaint_against_name"]
                            );

                            Mail::send('back-end.premium.emails.complaint', [
                                'sender_name' => $sender_name,
                                'complaint_against_name' => $complaint_against_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });
                            ######## second generation email ends ##########

                        }
                    }
                }
            }
        }

        return back()->with('message', 'Added Successfully');
    }

    public function complaintById(Request $request)
    {

        $where = array('id' => $request->id);
        $complaintByIds = Complaint::where($where)->first();

        return response()->json($complaintByIds);
    }

    public function complaintUpdate(Request $request)
    {


        $validated = $request->validate([
            'complaint_date' => 'required',
            'complaint_title' => 'required',
            'complaint_desc' => 'required',
        ]);

        try {
            $start_date = date('Y-m-d', strtotime($request->complaint_date));

            $complaint = Complaint::find($request->id);
            if ($request->edit_complaint_from_department_id) {
                $complaint->complaint_from_department_id = $request->edit_complaint_from_department_id;
            }
            if ($request->edit_complaint_from_employee_id) {
                $complaint->complaint_from_employee_id = $request->edit_complaint_from_employee_id;
            }
            if ($request->edit_complaint_to_department_id) {
                $complaint->complaint_to_department_id = $request->edit_complaint_to_department_id;
            }
            if ($request->edit_complaint_to_employee_id) {
                $complaint->complaint_to_employee_id = $request->edit_complaint_to_employee_id;
            }
            $complaint->complaint_date = $start_date;
            $complaint->complaint_title = $request->complaint_title;
            $complaint->complaint_desc = $request->complaint_desc;
            $complaint->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Plese fill up all requird field.');
        }
    }

    public function deleteComplaint($id)
    {
        try {
            $complaint = Complaint::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }

    public function bulkDeleteComplaint(Request $request)
    {
        try {
            $complaint = Complaint::where('complaint_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }
}