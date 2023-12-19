<?php

namespace App\Http\Controllers;

use App\Models\OverTime;
use Illuminate\Http\Request;
use Auth;
use Session;

class OverTimeController extends Controller
{
    public function addEmployeeOverTime(Request $request)
    {
        $validated = $request->validate([
            'over_time_date' => 'required',
            'over_time_company_duty_in_seconds' => 'required',
            'over_time_employee_in_seconds' => 'required',
            'over_time_rate' => 'required',
        ]);
        try {
            //OverTime::create($request->all());
            $over_time = new OverTime();
            $over_time->over_time_com_id = Auth::user()->com_id;
            $over_time->over_time_employee_id = Session::get('employee_setup_id');
            $over_time->over_time_type = "Manual";
            $over_time->over_time_date = $request->over_time_date;
            $over_time->over_time_company_duty_in_seconds = $request->over_time_company_duty_in_seconds;
            $over_time->over_time_employee_in_seconds = $request->over_time_employee_in_seconds;
            $over_time->over_time_rate = $request->over_time_rate;
            $over_time->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeOverTimeById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeOverTimeByIds = OverTime::where($where)->first();

        return response()->json($employeeOverTimeByIds);
    }

    public function employeeOverTimeUpdate(Request $request)
    {
        $validated = $request->validate([
            'over_time_date' => 'required',
            'over_time_company_duty_in_seconds' => 'required',
            'over_time_employee_in_seconds' => 'required',
            'over_time_rate' => 'required',
        ]);
        try {
            // $over_time = OverTime::find($request->id);
            // $over_time->update($request->all());
            $over_time = OverTime::find($request->id);
            $over_time->over_time_date = $request->over_time_date;
            $over_time->over_time_company_duty_in_seconds = $request->over_time_company_duty_in_seconds;
            $over_time->over_time_employee_in_seconds = $request->over_time_employee_in_seconds;
            $over_time->over_time_rate = $request->over_time_rate;
            $over_time->save();
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeeOverTime($id)
    {
        try {
            $over_time = OverTime::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}