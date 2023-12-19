<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;
use Auth;
use Session;

class CommissionController extends Controller
{
    public function addEmployeeCommission(Request $request)
    {
        $validated = $request->validate([
            'commission_type' => 'required',
            'commission_title' => 'required',
            'commission_desc' => 'required',
            'commission_month_year' => 'required',
            'commission_amount' => 'required',
        ]);
        try {
            $commission = new Commission();
            $commission->commission_com_id = Auth::user()->com_id;
            $commission->commission_employee_id = Session::get('employee_setup_id');
            $commission->commission_type = $request->commission_type;
            $commission->commission_title = $request->commission_title;
            $commission->commission_desc = $request->commission_desc;
            $commission->commission_month_year = $request->commission_month_year . "-01";
            $commission->commission_amount = $request->commission_amount;
            $commission->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeCommissionById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeCommissionByIds = Commission::where($where)->first();

        return response()->json($employeeCommissionByIds);
    }

    public function employeeCommissionUpdate(Request $request)
    {
        $validated = $request->validate([
            'commission_type' => 'required',
            'commission_title' => 'required',
            'commission_desc' => 'required',
            'commission_month_year' => 'required',
            'commission_amount' => 'required',
        ]);
        try {
            $commission = Commission::find($request->id);
            $commission->commission_type = $request->commission_type;
            $commission->commission_title = $request->commission_title;
            $commission->commission_desc = $request->commission_desc;
            $commission->commission_month_year = $request->commission_month_year;
            $commission->commission_amount = $request->commission_amount;
            $commission->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeCommission($id)
    {
        try {
            $commission = Commission::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}