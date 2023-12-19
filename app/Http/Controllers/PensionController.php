<?php

namespace App\Http\Controllers;

use App\Models\Pension;
use Illuminate\Http\Request;
use Auth;
use Session;

class PensionController extends Controller
{
    public function addEmployeePension(Request $request)
    {
        if (Pension::where('pension_com_id', '=', $request->pension_com_id)->where('pension_employee_id', '=', $request->pension_employee_id)->exists()) {
            return back()->with('message', 'Already Set, You can not set twice!!!');
        } else {
            Pension::create($request->all());
            return back()->with('message', 'Added Successfully');
        }
    }

    public function employeePensionById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeePensionByIds = Pension::where($where)->first();

        return response()->json($employeePensionByIds);
    }

    public function employeePensionUpdate(Request $request)
    {
        try {
            $pension = Pension::find($request->id);
            $pension->update($request->all());

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeePension($id)
    {
        try {
            $pension = Pension::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}