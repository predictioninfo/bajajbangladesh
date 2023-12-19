<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Auth;

class EventAndMeetingController extends Controller
{
    public function ebventIndex()
    {
        $event_and_meeting_sub_module_one_add = "10.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $event_and_meeting_sub_module_one_edit = "10.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $event_and_meeting_sub_module_one_delete = "10.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $events = Event::join('departments', 'events.event_department_id', '=', 'departments.id')
            ->select('events.*', 'departments.department_name')
            ->where('event_com_id', '=', Auth::user()->com_id)
            ->get();
        return view('back-end.premium.events-and-meetings.event.event-index',  get_defined_vars());
    }
    public function meetingIndex()
    {
        $event_and_meeting_sub_module_two_add = "10.2.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $event_and_meeting_sub_module_two_edit = "10.2.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $event_and_meeting_sub_module_two_delete = "10.2.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $event_and_meeting_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $meetings = Meeting::where('meeting_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.events-and-meetings.meeting.meeting-index', get_defined_vars());
    }
}
