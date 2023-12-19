<?php

namespace App\Http\Controllers;

use App\Models\StatutoryDeduction;
use Illuminate\Http\Request;
use Auth;
use Session;

class StatutoryDeductionController extends Controller
{
    public function addEmployeeSatatutoryDeduction(Request $request)
    {
        $validated = $request->validate([
            'statutory_deduc_month_year' => 'required',
            'statutory_deduc_type' => 'required',
            'statutory_deduc_title' => 'required',
            'statutory_deduc_amount' => 'required',
        ]);
        try {
            $statutory_deduction = new StatutoryDeduction();
            $statutory_deduction->statutory_deduc_com_id = Auth::user()->com_id;
            $statutory_deduction->statutory_deduc_employee_id = Session::get('employee_setup_id');
            $statutory_deduction->statutory_deduc_month_year = $request->statutory_deduc_month_year . "-01";
            $statutory_deduction->statutory_deduc_type = $request->statutory_deduc_type;
            $statutory_deduction->statutory_deduc_title = $request->statutory_deduc_title;
            $statutory_deduction->statutory_deduc_amount = $request->statutory_deduc_amount;
            $statutory_deduction->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeSatatutoryDeductionById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeStatutoryDeductionByIds = StatutoryDeduction::where($where)->first();

        return response()->json($employeeStatutoryDeductionByIds);
    }

    public function employeeSatatutoryDeductionUpdate(Request $request)
    {
        $validated = $request->validate([
            'statutory_deduc_month_year' => 'required',
            'statutory_deduc_type' => 'required',
            'statutory_deduc_title' => 'required',
            'statutory_deduc_amount' => 'required',
        ]);
        try {
            $statutory_deduction = StatutoryDeduction::find($request->id);
            $statutory_deduction->statutory_deduc_month_year = $request->statutory_deduc_month_year . "-01";
            $statutory_deduction->statutory_deduc_type = $request->statutory_deduc_type;
            $statutory_deduction->statutory_deduc_title = $request->statutory_deduc_title;
            $statutory_deduction->statutory_deduc_amount = $request->statutory_deduc_amount;
            $statutory_deduction->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeeSatatutoryDeduction($id)
    {
        try {
            $statutory_deduction = StatutoryDeduction::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}