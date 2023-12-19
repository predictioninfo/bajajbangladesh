<?php

namespace App\Http\Controllers;

use App\Models\OfficeShift;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Auth;

class OfficeShiftController extends Controller
{
    public function addOfficeShift(Request $request)
    {

        // echo date('g:i a', strtotime($request->sunday_out));
        // exit;

        if (OfficeShift::where('office_shift_com_id', Auth::user()->com_id)->where('shift_name', '=', $request->shift_name)->exists()) {

            return back()->with('message', 'You Already Added This Shift Name');
        } else {
            $validated = $request->validate([
                'shift_name' => 'required',
            ]);
            try {
                $office_shift = new OfficeShift();
                $office_shift->office_shift_com_id  = Auth::user()->com_id;
                $office_shift->shift_name  = $request->shift_name;
                $office_shift->sunday_in  = $request->sunday_in;
                $office_shift->sunday_out  = $request->sunday_out;
                $office_shift->monday_in  = $request->monday_in;
                $office_shift->monday_out  = $request->monday_out;
                $office_shift->tuesday_in  = $request->tuesday_in;
                $office_shift->tuesday_out  = $request->tuesday_out;
                $office_shift->wednesday_in  = $request->wednesday_in;
                $office_shift->wednesday_out  = $request->wednesday_out;
                $office_shift->thursday_in  = $request->thursday_in;
                $office_shift->thursday_out  = $request->thursday_out;
                $office_shift->friday_in  = $request->friday_in;
                $office_shift->friday_out  = $request->friday_out;
                $office_shift->saturday_in  = $request->saturday_in;
                $office_shift->saturday_out  = $request->saturday_out;
                $office_shift->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing');
            }
            return back()->with('message', 'Office Shift Added Successfully');
        }
    }
    public function updateOfficeShift(Request $request)
    {
        try {
            $office_shift = OfficeShift::find($request->id);
            $office_shift->office_shift_com_id  = Auth::user()->com_id;
            $office_shift->shift_name  = $request->shift_name;
            $office_shift->sunday_in  = $request->sunday_in;
            $office_shift->sunday_out  = $request->sunday_out;
            $office_shift->monday_in  = $request->monday_in;
            $office_shift->monday_out  = $request->monday_out;
            $office_shift->tuesday_in  = $request->tuesday_in;
            $office_shift->tuesday_out  = $request->tuesday_out;
            $office_shift->wednesday_in  = $request->wednesday_in;
            $office_shift->wednesday_out  = $request->wednesday_out;
            $office_shift->thursday_in  = $request->thursday_in;
            $office_shift->thursday_out  = $request->thursday_out;
            $office_shift->friday_in  = $request->friday_in;
            $office_shift->friday_out  = $request->friday_out;
            $office_shift->saturday_in  = $request->saturday_in;
            $office_shift->saturday_out  = $request->saturday_out;
            $office_shift->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Office Shift Updated Successfully');
    }

    public function deleteOfficeShift($id)
    {
        try{
            $office_shift = OfficeShift::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs! There have dependancy');
        }

        return back()->with('message', 'Deleted Successfully');
    }

    public function updateAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required',
            'announcement_title' => 'required',
            'announcement_desc' => 'required',
        ]);
        try {
            $announcement = Announcement::find($request->id);
            $announcement->announcement_department_id = $request->department_id;
            $announcement->announcement_title = $request->announcement_title;
            $announcement->announcement_desc = $request->announcement_desc;
            $announcement->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

        return back()->with('message', 'Announcement Updated Successfully');
    }

    public function deleteAnnouncement($id)
    {
        try {
            $announcement = Announcement::find($id);
            $announcement->delete();
            return back()->with('message', 'Announcement Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}
