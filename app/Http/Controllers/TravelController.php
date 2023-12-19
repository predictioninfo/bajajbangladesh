<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Travel;
use App\Models\CompanyCalendar;
use App\Models\Notification;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Auth;
use Mail;
use DateTime;

class TravelController extends Controller
{
    public function travelAdd(Request $request)
    {

        $validated = $request->validate([
            'travel_department_id' => 'required',
            'travel_employee_id' => 'required',
            'travel_arrangement_type' => 'required',
            'travel_purpose' => 'required',
            'travel_place' => 'required',
            'travel_start_date' => 'required',
            'travel_end_date' => 'required',
            'travel_expected_budget' => 'required',
            'travel_actual_budget' => 'required',
            'travel_mode' => 'required',
            'travel_status' => 'required',
        ]);
        try {
            $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
            $current_date = $date->format('Y-m-d');
            $start_date = date('Y-m-d', strtotime($request->travel_start_date));
            $end_date = date('Y-m-d', strtotime($request->travel_end_date));

            ################################ approved travel request existance check code starts ######################################################
            if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->travel_employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $start_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                return back()->with('message', 'There is an approved travel request in this date range!!!');
            }
            if (Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->travel_employee_id)->where('travel_status', '=', 'Approved')->whereRaw('"' . $end_date . '" between `travel_start_date` and `travel_end_date`')->exists()) { //condition for travel aprovements
                return back()->with('message', 'There is an approved travel request in this date range!!!');
            }

            $travel_dates = Travel::where('travel_com_id', Auth::user()->com_id)->where('travel_employee_id', $request->travel_employee_id)->where('travel_status', '=', 'Approved')->get();

            foreach ($travel_dates as $travel_dates_value) {
                if (($travel_dates_value->travel_start_date >= $start_date) && ($travel_dates_value->travel_start_date <= $end_date)) {
                    // echo "Approved start date is between two dates";
                    return back()->with('message', 'Approved travel request start date exists in this date range!!!');
                }
                if (($travel_dates_value->travel_end_date >= $start_date) && ($travel_dates_value->travel_end_date <= $end_date)) {
                    // echo "Approved end date is between two dates";
                    return back()->with('message', 'Approved travel request end date exists in this date range!!!');
                }
            }
            ################################ approved travel request existance check code ends ######################################################

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

            if (($current_date >= $start_date) && ($current_date <= $end_date)) {
                // echo "Current date is between two dates";
                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $request->travel_employee_id)->where('check_in_out', 1)->where('attendance_date', $current_date)->exists()) { //condition for travel aprovements
                    return back()->with('message', 'You are not permitted to send this travel request because you already gave your attendance for today!!! Contact with your system administrator for extra support!!!');
                }
            } else {
                //echo "Current date is not between two dates";
            }


            $users = User::where('id', '=', $request->travel_employee_id)->get(['report_to_parent_id', 'email', 'first_name', 'last_name', 'department_id', 'designation_id']);

            foreach ($users as $users) {

                if (
                    $users->department_id == '' || $users->department_id == Null ||
                    $users->designation_id == '' || $users->designation_id == Null
                    // $users->region_id == '' || $users->region_id == Null ||
                    // $users->area_id == '' || $users->area_id == Null ||
                    // $users->territory_id == '' || $users->territory_id == Null ||
                    // $users->town_id == '' || $users->town_id == Null ||
                    // $users->db_house_id == '' || $users->db_house_id == Null

                ) {
                    return back()->with('message', 'Department, Designation Not Set Properly');
                }

                if ($users->report_to_parent_id == '' || $users->report_to_parent_id == Null || $users->report_to_parent_id == NULL) {

                    return back()->with('message', 'Supervisor Not Set Yet!!!');
                } else {

                    $generation_one_details = User::where('id', '=', $users->report_to_parent_id)->get(['report_to_parent_id', 'email']);
                    foreach ($generation_one_details as $generation_one_details_value) {

                        $travel = new Travel();
                        $travel->travel_token = $random_key;
                        $travel->travel_com_id = Auth::user()->com_id;
                        $travel->travel_department_id = $request->travel_department_id;
                        $travel->travel_employee_id = $request->travel_employee_id;
                        $travel->travel_approver_generation_one_id = $users->report_to_parent_id;
                        $travel->travel_approver_generation_two_id = $generation_one_details_value->report_to_parent_id;
                        $travel->travel_arrangement_type = $request->travel_arrangement_type;
                        $travel->travel_purpose = $request->travel_purpose;
                        $travel->travel_place = $request->travel_place;
                        $travel->travel_desc = $request->travel_desc;
                        $travel->travel_start_date = $start_date;
                        $travel->travel_end_date = $end_date;
                        $travel->travel_expected_budget = $request->travel_expected_budget;
                        $travel->travel_actual_budget = $request->travel_actual_budget;
                        $travel->travel_mode = $request->travel_mode;
                        $travel->travel_status = $request->travel_status;
                        $travel->save();

                        if ($generation_one_details_value->report_to_parent_id == '' || $generation_one_details_value->report_to_parent_id == Null) {

                            $notification = new Notification();
                            $notification->notification_token = $random_key;
                            $notification->notification_com_id = Auth::user()->com_id;
                            $notification->notification_type = "Travel";
                            $notification->notification_title = "You Have A New Travel Request To Approve";
                            $notification->notification_from = $request->travel_employee_id;
                            $notification->notification_to = $users->report_to_parent_id;
                            $notification->notification_status = "Unseen";
                            $notification->save();


                            $data["email"] = $generation_one_details_value->email;
                            $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                            $data["subject"] = "Travel Request";

                            $sender_name = array(
                                'pay_slip_net_salary' => $data["request_sender_name"],
                            );

                            Mail::send('back-end.premium.emails.travel-request', [
                                'sender_name' => $sender_name,
                            ], function ($message) use ($data) {
                                $message->to($data["email"], $data["request_sender_name"])
                                    ->subject($data["subject"]);
                            });
                        } else {

                            $notification = new Notification();
                            $notification->notification_token = $random_key;
                            $notification->notification_com_id = Auth::user()->com_id;
                            $notification->notification_type = "Travel";
                            $notification->notification_title = "You Have A New Travel Request To Approve";
                            $notification->notification_from = $request->travel_employee_id;
                            $notification->notification_to = $users->report_to_parent_id;
                            $notification->notification_status = "Unseen";
                            $notification->save();

                            $notification_second = new Notification();
                            $notification_second->notification_token = $random_key;
                            $notification_second->notification_com_id = Auth::user()->com_id;
                            $notification_second->notification_type = "Travel";
                            $notification_second->notification_title = "You Have A New Travel Request To Approve";
                            $notification_second->notification_from = $request->travel_employee_id;
                            $notification_second->notification_to = $generation_one_details_value->report_to_parent_id;
                            $notification_second->notification_status = "Unseen";
                            $notification_second->save();


                            $generation_two_details = User::where('id', '=', $generation_one_details_value->report_to_parent_id)->get('email');

                            foreach ($generation_two_details as $generation_two_details_value) {

                                ######## first generation email##########
                                $data["email"] = $generation_one_details_value->email;
                                $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                                $data["subject"] = "Travel Request";

                                $sender_name = array(
                                    'pay_slip_net_salary' => $data["request_sender_name"],
                                );

                                Mail::send('back-end.premium.emails.travel-request', [
                                    'sender_name' => $sender_name,
                                ], function ($message) use ($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                });

                                ######## first generation email ends##########

                                ######## second generation email##########
                                $data["email"] = $generation_two_details_value->email;
                                $data["request_sender_name"] = $users->first_name . ' ' . $users->last_name;
                                $data["subject"] = "Travel Request";

                                $sender_name = array(
                                    'pay_slip_net_salary' => $data["request_sender_name"],
                                );

                                Mail::send('back-end.premium.emails.travel-request', [
                                    'sender_name' => $sender_name,
                                ], function ($message) use ($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                });

                                ######## second generation email ends##########

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

    public function travelById(Request $request)
    {

        $where = array('id' => $request->id);
        $travelByIds = Travel::where($where)->first();

        return response()->json($travelByIds);
    }

    public function travelUpdate(Request $request)
    {

        $validated = $request->validate([
            // 'edit_travel_department_id' => 'required',
            // 'travel_arrangement_type' => 'required',
            // 'travel_purpose' => 'required',
            // 'travel_place' => 'required',
            // 'travel_desc' => 'required',
            // 'travel_start_date' => 'required',
            // 'travel_end_date' => 'required',
            // 'travel_expected_budget' => 'required',
            'travel_actual_budget' => 'required',
            'travel_mode' => 'required',
            'travel_status' => 'required',
        ]);

        $date = new DateTime("now", new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d');

        $start_date = date('Y-m-d', strtotime($request->travel_start_date));
        $end_date = date('Y-m-d', strtotime($request->travel_end_date));

        if (($current_date >= $start_date) && ($current_date <= $end_date)) {
            // echo "Current date is between two dates";

            $travel_details = Travel::where('id', $request->id)->get('travel_employee_id');

            foreach ($travel_details as  $travel_details_value) {
                if (Attendance::where('attendance_com_id', Auth::user()->com_id)->where('employee_id', $travel_details_value->travel_employee_id)->where('check_in_out', 1)->where('attendance_date', $current_date)->exists()) { //condition for travel aprovements
                    return back()->with('message', 'You are not permitted to send this travel request because you already gave your attendance for today!!! Contact with your system administrator for extra support!!!');
                }
            }
        } else {
            //echo "Current date is not between two dates";
        }

        $travel = Travel::find($request->id);
        $travel->travel_department_id = $request->edit_travel_department_id;
        if ($request->edit_travel_employee_id) {
            $travel->travel_employee_id = $request->edit_travel_employee_id;
        } else {
            $travel->travel_employee_id = $request->travel_employee_id_hidden;
        }
        $travel->travel_arrangement_type = $request->travel_arrangement_type;
        $travel->travel_purpose = $request->travel_purpose;
        $travel->travel_place = $request->travel_place;
        $travel->travel_desc = $request->travel_desc;
        $travel->travel_start_date = $start_date;
        $travel->travel_end_date = $end_date;
        $travel->travel_expected_budget = $request->travel_expected_budget;
        $travel->travel_actual_budget = $request->travel_actual_budget;
        $travel->travel_mode = $request->travel_mode;
        $travel->travel_status = $request->travel_status;
        $travel->save();

        // if($request->travel_status == 'Approved'){

        //     if($request->edit_travel_employee_id){
        //         $traveller_details = User::where('id','=',$request->edit_travel_employee_id)->get(['first_name','last_name','email']);
        //     }else{
        //         $traveller_details = User::where('id','=',$request->travel_employee_id_hidden)->get(['first_name','last_name','email']);
        //     }

        //     foreach($traveller_details as $traveller_details_value){

        //         $event = new CompanyCalendar();
        //         $event->company_calendar_com_id = Auth::user()->com_id;
        //         if($request->edit_travel_employee_id){
        //             $event->company_calendar_employee_id = $request->edit_travel_employee_id;
        //         }else{
        //             $event->company_calendar_employee_id = $request->travel_employee_id_hidden;
        //         }
        //         $event->company_calendar_employee_name = $traveller_details_value->first_name.' '.$traveller_details_value->last_name;
        //         $event->calander_detail_type = "Travel";
        //         $event->title = $request->travel_place;
        //         $event->calander_details = $request->travel_purpose;
        //         $event->start = $request->travel_start_date;
        //         $event->end = $request->travel_end_date;
        //         $event->save();

        //         $data["email"]= $traveller_details_value->email;
        //         $data["request_receiver_name"] = $traveller_details_value->first_name.' '.$traveller_details_value->last_name;
        //         $data["subject"] = "Request Acceptance";

        //         $receiver_name = array(
        //             'request_receiver_name' => $data["request_receiver_name"],
        //             );

        //         Mail::send('back-end.premium.emails.travel-approved',[
        //             'receiver_name' => $receiver_name,
        //         ], function($message)use($data) {
        //             $message->to($data["email"],$data["request_receiver_name"])->subject($data["subject"]);
        //             });

        //     }

        // }

        return back()->with('message', 'Updated Successfully');
    }

    public function deleteTravel($id)
    {
        $token_details = Travel::where('id', '=', $id)->first('travel_token');
        if ($token_details->travel_token != NULL) {
            $notification_delete = Notification::where('notification_token', $token_details->travel_token)->delete();
        }

        $travel = Travel::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteTravel(Request $request)
    {
        $token_details = Travel::where('travel_com_id', $request->bulk_delete_com_id)->get(['travel_token']);
        foreach ($token_details as $token_details_value) {
            $notification_delete = Notification::where('notification_token', $token_details_value->travel_token)->delete();
        }

        $travel = Travel::where('travel_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }


    public function approveTravel($id)
    {
        try {
            $travel = Travel::find($id);
            $travel->travel_status = "Approved";
            $travel->save();

            $travel_datails = Travel::where('id', '=', $id)->first(['travel_start_date', 'travel_end_date', 'travel_purpose', 'travel_employee_id', 'travel_token']);
            $sender_details = User::where('id', '=', $travel_datails->travel_employee_id)->get(['email', 'first_name', 'last_name']);
            $approvers_details = User::where('id', Auth::user()->id)->get(['first_name', 'last_name']);

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
                    $notification->notification_type = "Travel-Approved";
                    $notification->notification_title = "Your Travel Request was Approved";
                    $notification->notification_from = Auth::user()->id;
                    $notification->notification_to = $travel_datails->travel_employee_id;
                    $notification->notification_status = "Unseen";
                    $notification->save();

                    if ($travel_datails->travel_token != NULL) {
                        $notification_delete = Notification::where('notification_token', $travel_datails->travel_token)->delete();
                    }

                    $event = new CompanyCalendar();
                    $event->company_calendar_com_id = Auth::user()->com_id;
                    $event->company_calendar_employee_id = $travel_datails->travel_employee_id;
                    $event->company_calendar_employee_name = $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                    $event->title = "Travel for " . $sender_details_value->first_name . ' ' . $sender_details_value->last_name;
                    $event->calander_detail_type = "Travel";
                    $event->calander_details = $travel_datails->travel_purpose;
                    $event->start = $travel_datails->travel_start_date;
                    $event->end = $travel_datails->travel_end_date;
                    $event->save();

                    $data["email"] = $sender_details_value->email;
                    $data["request_receiver_name"] = $approvers_details_value->first_name . ' ' . $approvers_details_value->last_name;
                    $data["subject"] = "Request Acceptance";

                    $receiver_name = array(
                        'request_receiver_name' => $data["request_receiver_name"],
                    );

                    Mail::send('back-end.premium.emails.travel-approved', [
                        'receiver_name' => $receiver_name,
                    ], function ($message) use ($data) {
                        $message->to($data["email"], $data["request_receiver_name"])->subject($data["subject"]);
                    });
                }
            }

            return back()->with('message', 'Approved Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}
