<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\CompanyCalendar;
use App\Models\Department;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
use Mail;

class EventController extends Controller
{
    public function eventAdd(Request $request)
    {
        $validated = $request->validate([
            'event_title' => 'required',
            'event_department_id' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'events_employee_id' => 'required',
        ]);

        try {
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
            $employee_array = [$request->events_employee_id];

            foreach ($employee_array as $employee_array_data) {
                $employee_data = json_encode($employee_array_data);
            }

            $random_key = generateRandomString();

            $event = new Event();
            $event->event_com_id = Auth::user()->com_id;
            $event->event_unique_key = $random_key;
            $event->event_department_id = $request->event_department_id;
            $event->events_employee_id = $employee_data;
            $event->event_title = $request->event_title;
            $event->event_date = $request->event_date;
            $event->event_time = $request->event_time;
            $event->save();

            $department_name_array = Department::where('id', '=', $request->event_department_id)->get(['department_name', 'id']);

            foreach ($department_name_array as  $department_name_array_value) {
                $event = new CompanyCalendar();
                $event->company_calendar_com_id = Auth::user()->com_id;
                $event->company_calendar_unique_key = $random_key;
                $event->company_calendar_employee_all = "Yes";
                $event->calander_detail_type = "Event";
                $event->company_calendar_event_department_name = $department_name_array_value->department_name;
                $event->title = $request->event_title;
                $event->start = $request->event_date;
                $event->end = $request->event_date;
                $event->save();
            }


            if ($request->events_employee_id) {
                try {
                    $employees = User::where('com_id', Auth::user()->com_id)->get();
                    foreach ($employees as $employees_value) {
                        foreach ($request->events_employee_id as $event_employee_id) {
                            if ($event_employee_id == $employees_value->id) {

                                $data["email"] = $employees_value->email;
                                $data["request_sender_name"] = Auth::user()->first_name . ' ' . Auth::user()->last_name;
                                $data["subject"] = "Event";

                                $sender_name = array(
                                    'sender_name_value' => $data["request_sender_name"],
                                );

                                Mail::send('back-end.premium.emails.event-notice-for-employee', [
                                    'sender_name' => $sender_name,
                                ], function ($message) use ($data) {
                                    $message->to($data["email"], $data["request_sender_name"])
                                        ->subject($data["subject"]);
                                });
                            }
                        }
                    }
                } catch (\Exception $e) {
                    return back()->with('message', 'Please set a valid email to notify .');
                }
            }

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Opps!Please contact your it support');
        }
    }

    public function eventById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeEventByIds = Event::where($where)->first();

        return response()->json($employeeEventByIds);
    }

    public function eventUpdate(Request $request)
    {
        $validated = $request->validate([
            'event_title' => 'required',
            'event_department_id' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
        ]);


        $event = Event::find($request->id);

        $event->event_department_id = $request->event_department_id;
        $event->events_employee_id = $request->events_employee_id;
        $event->event_title = $request->event_title;
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;
        $event->save();

        $department_name_array = Department::where('id', '=', $request->event_department_id)->get(['department_name']);
        foreach ($department_name_array as  $department_name_array_value) {
            if (CompanyCalendar::where('company_calendar_unique_key', $request->event_unique_key)->exists()) {
                $unique_key_wise_id = CompanyCalendar::where('company_calendar_unique_key', $request->event_unique_key)->first('id');
                $event = CompanyCalendar::find($unique_key_wise_id->id);
                $event->company_calendar_event_department_name = $department_name_array_value->department_name;
                $event->title = $request->event_title;
                $event->start = $request->event_date;
                $event->end = $request->event_date;
                $event->save();
            }
        }

        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEvent($id)
    {
        $unique_key_wise_id = Event::where('id', $id)->first('event_unique_key');
        $delete_company_calender = CompanyCalendar::where('company_calendar_unique_key', $unique_key_wise_id->event_unique_key)->delete();
        $event = Event::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }

    public function bulkDeleteEvent(Request $request)
    {
        $event = Event::where('event_com_id', $request->bulk_delete_com_id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
}