<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\SupportTicket;
use App\Models\Permission;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
use Session;
use Mail;

class SupportTicketController extends Controller
{
    public function supportTicketIndex()
    {

        $support_ticket_module_add = "12.0.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_add . '"]\')')->exists()) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $support_ticket_module_edit = "12.0.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_edit . '"]\')')->exists()) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $support_ticket_module_delete = "12.0.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $support_ticket_module_delete . '"]\')')->exists()) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $employees = User::where('com_id',Auth::user()->com_id)->get(['id','first_name','last_name']);
     
        $support_tickets = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
            ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
            ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('support_ticket_com_id', '=', Auth::user()->com_id)
            ->get();

        if (Auth::user()->company_profile == 'Yes') {
            $support_tickets = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
                ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
                ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('support_ticket_com_id', '=', Auth::user()->com_id)
                ->get();
        } else {
            $support_tickets = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
                ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
                ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('support_ticket_com_id', '=', Auth::user()->com_id)
                ->where('support_ticket_generation_one_id', '=', Auth::user()->id)
                ->orWhere('support_ticket_generation_two_id', '=', Auth::user()->id)
                ->get();
        }



        return view('back-end.premium.support-ticket.support-ticket-index', get_defined_vars());
    }
    public function supportTicketAdd(Request $request)
    {

        //echo "ok"; exit;

        $validated = $request->validate([
            'support_ticket_department_id' => 'required',
            'support_ticket_employee_id' => 'required',
            'support_ticket_priority' => 'required',
            'support_ticket_subject' => 'required',
            'support_ticket_note' => 'required',
            'support_ticket_date' => 'required',
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

            $users = User::where('id', '=', $request->support_ticket_employee_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name', 'department_id', 'designation_id', 'region_id', 'area_id', 'territory_id', 'town_id', 'db_house_id']);

            foreach ($users as $users) {

                if (
                    $users->department_id == '' || $users->department_id == Null ||
                    $users->designation_id == '' || $users->designation_id == Null ||
                    $users->region_id == '' || $users->region_id == Null ||
                    $users->area_id == '' || $users->area_id == Null ||
                    $users->territory_id == '' || $users->territory_id == Null ||
                    $users->town_id == '' || $users->town_id == Null ||
                    $users->db_house_id == '' || $users->db_house_id == Null

                ) {
                    return back()->with('message', 'Department, Designation, Region, Area, Territory, Town and Db House Not Set Properly');
                }

                if ($users->report_to_parent_id == '' || $users->report_to_parent_id == Null || $users->report_to_parent_id == NULL) {

                    return back()->with('message', 'Supervisor Not Set Yet!!!');
                } else {



                    $generation_one_details = User::where('id', '=', $users->report_to_parent_id)->get(['report_to_parent_id', 'email']);
                    foreach ($generation_one_details as $generation_one_details_value) {

                        $support_ticket = new SupportTicket();
                        $support_ticket->support_ticket_token = $random_key;
                        $support_ticket->support_ticket_com_id = Auth::user()->com_id;
                        $support_ticket->support_ticket_department_id = $request->support_ticket_department_id;
                        $support_ticket->support_ticket_employee_id = $request->support_ticket_employee_id;
                        $support_ticket->support_ticket_generation_one_id = $users->report_to_parent_id;
                        $support_ticket->support_ticket_generation_two_id = $generation_one_details_value->report_to_parent_id;
                        $support_ticket->support_ticket_priority = $request->support_ticket_priority;
                        $support_ticket->support_ticket_subject = $request->support_ticket_subject;
                        $support_ticket->support_ticket_note = $request->support_ticket_note;
                        $support_ticket->support_ticket_date = $request->support_ticket_date;

                        $image = $request->file('support_ticket_attachment');
                        $input['imagename'] = time() . '.' . $image->extension();
                        $filePath = 'uploads/employee-ticket-files';
                        $imageUrl = $filePath . '/' . $input['imagename'];
                        $imageStoring = $image->move($filePath, $input['imagename']);

                        $support_ticket->support_ticket_attachment = $imageUrl;
                        $support_ticket->support_ticket_desc = strip_tags($request->support_ticket_desc);
                        $support_ticket->support_ticket_status = "Pending";
                        $support_ticket->save();


                        if ($generation_one_details_value->report_to_parent_id == '' || $generation_one_details_value->report_to_parent_id == Null) {

                            $notification = new Notification();
                            $notification->notification_token = $random_key;
                            $notification->notification_com_id = Auth::user()->com_id;
                            $notification->notification_type = "Support";
                            $notification->notification_title = "You Have A New Support Request";
                            $notification->notification_from = $request->support_ticket_employee_id;
                            $notification->notification_to = $users->report_to_parent_id;
                            $notification->notification_status = "Unseen";
                            $notification->save();

                            $data["email"] = $generation_one_details_value->email;
                            $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                            $data["subject"] = "Support Request";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.support-request', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });
                        } else {

                            $notification = new Notification();
                            $notification->notification_token = $random_key;
                            $notification->notification_com_id = Auth::user()->com_id;
                            $notification->notification_type = "Support";
                            $notification->notification_title = "You Have A New Support Request";
                            $notification->notification_from = $request->support_ticket_employee_id;
                            $notification->notification_to = $users->report_to_parent_id;
                            $notification->notification_status = "Unseen";
                            $notification->save();

                            $notification_second = new Notification();
                            $notification_second->notification_token = $random_key;
                            $notification_second->notification_com_id = Auth::user()->com_id;
                            $notification_second->notification_type = "Support";
                            $notification_second->notification_title = "You Have A New Support Request";
                            $notification_second->notification_from = $request->support_ticket_employee_id;
                            $notification_second->notification_to = $generation_one_details_value->report_to_parent_id;
                            $notification_second->notification_status = "Unseen";
                            $notification_second->save();

                            $generation_two_details = User::where('id', '=', $generation_one_details_value->report_to_parent_id)->get('email');

                            foreach ($generation_two_details as $generation_two_details_value) {

                                ######## first generation email##########
                                $data["email"] = $generation_one_details_value->email;
                                $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                                $data["subject"] = "Support Request";

                                $sender_name = array(
                                    'pay_slip_net_salary' => $data["request_sender_name"],
                                );

                                Mail::send('back-end.premium.emails.support-request', [
                                    'sender_name' => $sender_name,
                                ], function ($message) use ($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                });

                                ######## first generation email ends##########

                                ######## second generation email##########
                                $data["email"] = $generation_two_details_value->email;
                                $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                                $data["subject"] = "Support Request";

                                $sender_name = array(
                                    'pay_slip_net_salary' => $data["request_sender_name"],
                                );

                                Mail::send('back-end.premium.emails.support-request', [
                                    'sender_name' => $sender_name,
                                ], function ($message) use ($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                });

                                ######## second generation email ends##########

                            }
                        }
                    }



                    return back()->with('message', 'Added Successfully');
                }
            }



            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }



    public function supportTicketById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeEventByIds = SupportTicket::where($where)->first();

        return response()->json($employeeEventByIds);
    }

    public function supportTicketUpdate(Request $request)
    {
        // echo 'ok'; exit;
        $validated = $request->validate([
            'edit_support_ticket_department_id' => 'required',
            'support_ticket_priority' => 'required',
            'support_ticket_subject' => 'required',
            'support_ticket_note' => 'required',
            'support_ticket_date' => 'required',
        ]);

        try {

            $support_ticket = SupportTicket::find($request->id);
            $support_ticket->support_ticket_department_id = $request->edit_support_ticket_department_id;
            if ($request->edit_support_ticket_employee_id) {
                $support_ticket->support_ticket_employee_id = $request->edit_support_ticket_employee_id;
            }
            $support_ticket->support_ticket_priority = $request->support_ticket_priority;
            $support_ticket->support_ticket_subject = $request->support_ticket_subject;
            $support_ticket->support_ticket_note = $request->support_ticket_note;
            $support_ticket->support_ticket_date = $request->support_ticket_date;
            if ($request->support_ticket_attachment) {
                $image = $request->file('support_ticket_attachment');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/employee-ticket-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
                $support_ticket->support_ticket_attachment = $imageUrl;
            }
            $support_ticket->support_ticket_desc = $request->support_ticket_desc;
            $support_ticket->support_ticket_status = $request->support_ticket_status;
            $support_ticket->save();

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


            if ($request->support_ticket_status == 'Opened') {

                $support_ticket_employee_details = SupportTicket::where('id', '=', $request->id)->get('support_ticket_employee_id');

                foreach ($support_ticket_employee_details as $support_ticket_employee_details_id) {

                    $users = User::where('id', '=', $support_ticket_employee_details_id->support_ticket_employee_id)->get(['email', 'first_name', 'last_name', 'report_to_parent_id']);

                    foreach ($users as $users) {

                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = Auth::user()->com_id;
                        $notification->notification_type = "Support-Updated";
                        $notification->notification_title = "Support Ticket Opened";
                        $notification->notification_from = $users->report_to_parent_id;
                        $notification->notification_to = $support_ticket_employee_details_id->support_ticket_employee_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();

                        $data["email"] = $users->email;
                        $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                        $data["subject"] = "Support Status";

                        $receiver_name = array(
                            'pay_slip_net_salary' => $data["request_receiver_name"],
                        );

                        Mail::send('back-end.premium.emails.support-open-status', [
                            'receiver_name' => $receiver_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_receiver_name"])
                                ->subject($data["subject"]);
                        });
                    }
                }
            } elseif ($request->support_ticket_status == 'Closed') {

                $support_ticket_employee_details = SupportTicket::where('id', '=', $request->id)->get('support_ticket_employee_id');

                foreach ($support_ticket_employee_details as $support_ticket_employee_details_id) {

                    $users = User::where('id', '=', $support_ticket_employee_details_id->support_ticket_employee_id)->get(['email', 'first_name', 'last_name', 'report_to_parent_id']);

                    foreach ($users as $users) {

                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = Auth::user()->com_id;
                        $notification->notification_type = "Support-Updated";
                        $notification->notification_title = "Support Ticket Closed";
                        $notification->notification_from = $users->report_to_parent_id;
                        $notification->notification_to = $support_ticket_employee_details_id->support_ticket_employee_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();

                        $data["email"] = $users->email;
                        $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                        $data["subject"] = "Support Status";

                        $receiver_name = array(
                            'pay_slip_net_salary' => $data["request_receiver_name"],
                        );

                        Mail::send('back-end.premium.emails.support-close-status', [
                            'receiver_name' => $receiver_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_receiver_name"])
                                ->subject($data["subject"]);
                        });
                    }
                }
            }



            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function deleteSupportTicket($id)
    {
        $token_details = SupportTicket::where('id', '=', $id)->first('support_ticket_token');
        if ($token_details->support_ticket_token != NULL) {
            $notification_delete = Notification::where('notification_token', $token_details->support_ticket_token)->delete();
        }

        $support_ticket = SupportTicket::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function employeeSupportTicketAdd(Request $request)
    {
        $validated = $request->validate([
            'support_ticket_priority' => 'required',
            'support_ticket_subject' => 'required',
            'support_ticket_note' => 'required',
            'support_ticket_date' => 'required',
            'support_ticket_desc' => 'required',
        ]);
        try {
            $session_employee_details = User::where('id', '=', Session::get('employee_setup_id'))->get('department_id');

            foreach ($session_employee_details as $session_employee_details_value) {

                $support_ticket = new SupportTicket();
                $support_ticket->support_ticket_com_id = Auth::user()->com_id;
                $support_ticket->support_ticket_department_id = $session_employee_details_value->department_id;
                $support_ticket->support_ticket_employee_id = Session::get('employee_setup_id');
                $support_ticket->support_ticket_priority = $request->support_ticket_priority;
                $support_ticket->support_ticket_subject = $request->support_ticket_subject;
                $support_ticket->support_ticket_note = $request->support_ticket_note;
                $support_ticket->support_ticket_date = $request->support_ticket_date;

                if ($request->support_ticket_attachment) {
                    $image = $request->file('support_ticket_attachment');
                    $input['imagename'] = time() . '.' . $image->extension();
                    $filePath = 'uploads/employee-ticket-files';
                    $imageUrl = $filePath . '/' . $input['imagename'];
                    $imageStoring = $image->move($filePath, $input['imagename']);

                    $support_ticket->support_ticket_attachment = $imageUrl;
                }
                $support_ticket->support_ticket_desc = strip_tags($request->support_ticket_desc);
                $support_ticket->support_ticket_status = "Pending";
                $support_ticket->save();
            }

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeSupportTicketById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeEventByIds = SupportTicket::where($where)->first();

        return response()->json($employeeEventByIds);
    }

    public function employeeSupportTicketUpdate(Request $request)
    {

        //  echo 'ok'; exit;
        $validated = $request->validate([
            'support_ticket_priority' => 'required',
            'support_ticket_subject' => 'required',
            'support_ticket_note' => 'required',
            'support_ticket_date' => 'required',
            'support_ticket_desc' => 'required',
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


            $support_ticket = SupportTicket::find($request->id);
            $support_ticket->support_ticket_priority = $request->support_ticket_priority;
            $support_ticket->support_ticket_subject = $request->support_ticket_subject;
            $support_ticket->support_ticket_note = $request->support_ticket_note;
            $support_ticket->support_ticket_date = $request->support_ticket_date;
            if ($request->support_ticket_attachment) {
                $image = $request->file('support_ticket_attachment');
                $input['imagename'] = time() . '.' . $image->extension();
                $filePath = 'uploads/employee-ticket-files';
                $imageUrl = $filePath . '/' . $input['imagename'];
                $imageStoring = $image->move($filePath, $input['imagename']);
                $support_ticket->support_ticket_attachment = $imageUrl;
            }
            $support_ticket->support_ticket_desc = $request->support_ticket_desc;
            $support_ticket->support_ticket_status = $request->support_ticket_status;
            $support_ticket->save();

            if ($request->support_ticket_status == 'Opened') {

                $support_ticket_employee_details = SupportTicket::where('id', '=', $request->id)->get('support_ticket_employee_id');

                foreach ($support_ticket_employee_details as $support_ticket_employee_details_id) {

                    $users = User::where('id', '=', $support_ticket_employee_details_id->support_ticket_employee_id)->get(['email', 'first_name', 'last_name', 'report_to_parent_id']);

                    foreach ($users as $users) {

                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = Auth::user()->com_id;
                        $notification->notification_type = "Support-Updated";
                        $notification->notification_title = "Support Ticket Opened";
                        $notification->notification_from = $users->report_to_parent_id;
                        $notification->notification_to = $support_ticket_employee_details_id->support_ticket_employee_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();


                        $data["email"] = $users->email;
                        $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                        $data["subject"] = "Support Status";

                        $receiver_name = array(
                            'pay_slip_net_salary' => $data["request_receiver_name"],
                        );

                        Mail::send('back-end.premium.emails.support-open-status', [
                            'receiver_name' => $receiver_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_receiver_name"])
                                ->subject($data["subject"]);
                        });
                    }
                }
            } elseif ($request->support_ticket_status == 'Closed') {

                $support_ticket_employee_details = SupportTicket::where('id', '=', $request->id)->get('support_ticket_employee_id');

                foreach ($support_ticket_employee_details as $support_ticket_employee_details_id) {

                    $users = User::where('id', '=', $support_ticket_employee_details_id->support_ticket_employee_id)->get(['email', 'first_name', 'last_name']);

                    foreach ($users as $users) {

                        $notification = new Notification();
                        $notification->notification_token = $random_key;
                        $notification->notification_com_id = Auth::user()->com_id;
                        $notification->notification_type = "Support";
                        $notification->notification_title = "Support Ticket Opened";
                        $notification->notification_from = $users->report_to_parent_id;
                        $notification->notification_to = $support_ticket_employee_details_id->support_ticket_employee_id;
                        $notification->notification_status = "Unseen";
                        $notification->save();

                        $data["email"] = $users->email;
                        $data["request_receiver_name"] = $users->first_name . ' ' . $users->last_name;
                        $data["subject"] = "Support Status";

                        $receiver_name = array(
                            'pay_slip_net_salary' => $data["request_receiver_name"],
                        );

                        Mail::send('back-end.premium.emails.support-open-status', [
                            'receiver_name' => $receiver_name,
                        ], function ($message) use ($data) {
                            $message->to($data["email"], $data["request_receiver_name"])
                                ->subject($data["subject"]);
                        });
                    }
                }
            }

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
    public function deleteEmployeeSupportTicket($id)
    {

        $token_details = SupportTicket::where('id', '=', $id)->first('support_ticket_token');
        if ($token_details->support_ticket_token != NULL) {
            $notification_delete = Notification::where('notification_token', $token_details->support_ticket_token)->delete();
        }

        $support_ticket = SupportTicket::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteSupportTicket(Request $request)
    {
        $token_details = SupportTicket::where('support_ticket_com_id', $request->bulk_delete_com_id)->get(['support_ticket_token']);
        foreach ($token_details as $token_details_value) {
            $notification_delete = Notification::where('notification_token', $token_details_value->support_ticket_token)->delete();
        }

        $support_ticket = SupportTicket::where('support_ticket_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}
