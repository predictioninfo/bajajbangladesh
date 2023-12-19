<?php

namespace App\Http\Controllers;

use App\Models\OtherPayment;
use Illuminate\Http\Request;
use Auth;
use Session;

class OtherPaymentController extends Controller
{
    public function addEmployeeOtherPayment(Request $request)
    {

        $validated = $request->validate([
            'other_payment_month_year' => 'required',
            'other_payment_title' => 'required',
            'other_payment_amount' => 'required',
        ]);
        try {
            $other_payment = new OtherPayment();
            $other_payment->other_payment_com_id = Auth::user()->com_id;
            $other_payment->other_payment_employee_id = Session::get('employee_setup_id');
            $other_payment->other_payment_month_year = $request->other_payment_month_year . "-01";
            $other_payment->other_payment_title = $request->other_payment_title;
            $other_payment->other_payment_amount = $request->other_payment_amount;
            $other_payment->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeOtherPaymentById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeOtherPaymentByIds = OtherPayment::where($where)->first();

        return response()->json($employeeOtherPaymentByIds);
    }

    public function employeeOtherPaymentUpdate(Request $request)
    {
        $validated = $request->validate([
            'other_payment_month_year' => 'required',
            'other_payment_title' => 'required',
            'other_payment_amount' => 'required',
        ]);
        try {
            $other_payment = OtherPayment::find($request->id);
            $other_payment->other_payment_month_year = $request->other_payment_month_year . "-01";
            $other_payment->other_payment_title = $request->other_payment_title;
            $other_payment->other_payment_amount = $request->other_payment_amount;
            $other_payment->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeOtherPayment($id)
    {
        try {
            $other_payment = OtherPayment::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}