<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoanController extends Controller
{
    public function addEmployeeLoan(Request $request)
    {
        $validated = $request->validate([
            'loans_month_year' => 'required',
            'loans_start_date' => 'required',
            'loans_title' => 'required',
            'loans_type' => 'required',
            'loans_amount' => 'required',
            'loans_no_of_installments' => 'required',
            'loans_reason' => 'required',
        ]);
        try {
            $loan = new Loan();
            $loan->loans_com_id = Auth::user()->com_id;
            $loan->loans_employee_id = Session::get('employee_setup_id');
            $loan->loans_month_year = $request->loans_month_year;
            $loan->loans_start_date = $request->loans_start_date;
            $loan->loans_title = $request->loans_title;
            $loan->loans_type = $request->loans_type;
            $loan->loans_amount = $request->loans_amount;
            $loan->loans_no_of_installments = $request->loans_no_of_installments;
            $loan->loans_remaining_amount = $request->loans_amount;
            $loan->loans_remaining_installments = $request->loans_no_of_installments;
            $loan->loans_monthly_payable = $request->loans_amount / $request->loans_no_of_installments;
            $loan->loans_reason = $request->loans_reason;
            $loan->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeLoanById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeLoanByIds = Loan::where($where)->first();

        return response()->json($employeeLoanByIds);
    }

    public function employeeLoanUpdate(Request $request)
    {
        $validated = $request->validate([
            'loans_month_year' => 'required',
            'loans_start_date' => 'required',
            'loans_title' => 'required',
            'loans_type' => 'required',
            'loans_amount' => 'required',
            'loans_no_of_installments' => 'required',
            'loans_reason' => 'required',
        ]);
        try {
            $loan = Loan::find($request->id);
            $loan->loans_month_year = $request->loans_month_year;
            $loan->loans_start_date = $request->loans_start_date;
            $loan->loans_title = $request->loans_title;
            $loan->loans_type = $request->loans_type;
            $loan->loans_amount = $request->loans_amount;
            $loan->loans_no_of_installments = $request->loans_no_of_installments;
            $loan->loans_remaining_amount = $request->loans_amount;
            $loan->loans_remaining_installments = $request->loans_no_of_installments;
            $loan->loans_monthly_payable = $request->loans_amount / $request->loans_no_of_installments;
            $loan->loans_reason = $request->loans_reason;
            $loan->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeLoan($id)
    {
        try {
            $loan = Loan::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}