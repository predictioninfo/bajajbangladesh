<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Auth;
use Mail;

class MeetingController extends Controller
{
    public function meetingAdd(Request $request)
    {

        $validated = $request->validate([
            'meeting_title' => 'required',
            'meeting_department_id' => 'required',
            'meeting_employee_id' => 'required',
            'meeting_status' => 'required',
            'meeting_date' => 'required',
            'meeting_time' => 'required',
        ]);

        try {
            $employee_array = [$request->meeting_employee_id];
            // echo json_encode($fgfdg, JSON_PRETTY_PRINT);exit;

            foreach ($employee_array as $employee_array_data) {
                $employee_data = json_encode($employee_array_data);
            }
            $meeting = new Meeting();
            $meeting->meeting_com_id = Auth::user()->com_id;
            $meeting->meeting_department_id = $request->meeting_department_id;
            $meeting->meeting_employee_id = $employee_data;
            //exit;
            $meeting->meeting_title = $request->meeting_title;
            $meeting->meeting_date = $request->meeting_date;
            $meeting->meeting_time = $request->meeting_time;
            $meeting->meeting_status = $request->meeting_status;
            $meeting->meeting_note = $request->meeting_note;
            $meeting->meeting_notifiable = $request->meeting_notifiable;
            $meeting->save();

            if ($request->meeting_employee_id) {
                try {
                    $employees = User::where('com_id', Auth::user()->com_id)->get();
                    foreach ($employees as $employees_value) {
                        foreach ($request->meeting_employee_id as $meeting_employee_id) {
                            if ($meeting_employee_id == $employees_value->id) {

                                $data["email"] = $employees_value->email;
                                $data["request_sender_name"] = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                                $data["subject"] = "Meeting";

                                $sender_name = array(
                                    'sender_name_value' => $data["request_sender_name"],
                                );

                                Mail::send('back-end.premium.emails.meeting-notice-for-employee', [
                                    'sender_name' => $sender_name,
                                ], function ($message) use ($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                });
                            }
                        }
                    }
                } catch (\Exception $e) {
                    return back()->with('message', 'Added Successfully but email not set properly');
                }
            }

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Opps!There are some Error.Please Contact your IT Support.');
        }
    }

    public function meetingById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeMeetingByIds = Meeting::where($where)->first();

        return response()->json($employeeMeetingByIds);
    }

    public function meetingUpdate(Request $request)
    {
        $validated = $request->validate([
            'meeting_title' => 'required',
            'meeting_status' => 'required',
            'meeting_date' => 'required',
            'meeting_time' => 'required',
        ]);
        try {
            $meeting = Meeting::find($request->id);
            if ($request->edit_meeting_department_id && $request->edit_meeting_employee_id) {
                $meeting->meeting_department_id = $request->edit_meeting_department_id;
                $meeting->meeting_employee_id = $request->edit_meeting_employee_id;
            } else {
                $meeting->meeting_department_id = $request->meeting_department_id_hidden;
                $meeting->meeting_employee_id = $request->meeting_employee_id_hidden;
            }
            $meeting->meeting_title = $request->meeting_title;
            $meeting->meeting_date = $request->meeting_date;
            $meeting->meeting_time = $request->meeting_time;
            $meeting->meeting_status = $request->meeting_status;
            $meeting->meeting_note = $request->meeting_note;
            $meeting->meeting_notifiable = $request->meeting_notifiable;
            $meeting->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Please insert all requird field');
        }
    }

    public function deleteMeeting($id)
    {
        $meeting = Meeting::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteMeeting(Request $request)
    {
        $meeting = Meeting::where('meeting_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}