<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use DB;
use Auth;

class LeaveTypeController extends Controller
{
    public function leaveTypeStore(Request $request)
    {

        $validated = $request->validate([
            'leave_type' => 'required',
            'allocated_day' => 'required|integer',

        ]);
        try {
            $leave_type = new LeaveType();
            $leave_type->leave_type_company_id = Auth::user()->com_id;
            $leave_type->leave_type = $request->leave_type;
            $leave_type->allocated_day = $request->allocated_day;
            $leave_type->activation_days = $request->activation_days;
            $leave_type->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function leaveTypeById(Request $request)
    {
        $where = array('id' => $request->id);
        $leave_types  = LeaveType::where($where)->first();
        return response()->json($leave_types);
    }

    public function updateLeaveType(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required',
            'allocated_day' => 'required|integer',
        ]);
        try {
            $leave_type = LeaveType::find($request->id);
            $leave_type->leave_type_company_id = Auth::user()->com_id;
            $leave_type->leave_type = $request->leave_type;
            $leave_type->allocated_day = $request->allocated_day;
            $leave_type->activation_days = $request->activation_days;
            $leave_type->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteLeaveType($id)
    {
        $leave_type = LeaveType::where('id', $id)->delete();

        return back()->with('message', 'Deleted Successfully');
    }
}
