<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\ProvidentfundBankaccount;
use Illuminate\Http\Request;
use Auth;
use Session;

class BankAccountController extends Controller
{
    public function addEmployeeBankAccount(Request $request)
    {

        if (BankAccount::where('bank_account_com_id', '=', Auth::user()->com_id)->where('bank_account_employee_id', '=', Session::get('employee_setup_id'))->exists()) {
            return back()->with('message', 'This Employee Already has a Bank Account');
        } else {
            $validated = $request->validate([
                'stuff_id' => 'required',
                // 'bank_name' => 'required',
                // 'bank_type' => 'required',
                // 'bank_account_number' => 'required',
                // 'bank_code' => 'required',
                // 'bank_branch' => 'required',
            ]);
            // try {
                $bank_account = new BankAccount();
                $bank_account->bank_account_com_id = Auth::user()->com_id;
                $bank_account->bank_account_employee_id = Session::get('employee_setup_id');
                $bank_account->stuff_id = $request->stuff_id;
                $bank_account->bank_account_id = $request->bank_id;

                // $bank_account->bank_name = $request->bank_name;
                // $bank_account->bank_type = $request->bank_type;
                $bank_account->bank_account_number = $request->bank_account_number;
                // $bank_account->bank_code = $request->bank_code;
                // $bank_account->bank_branch = $request->bank_branch;
                $bank_account->save();
            // } catch (\Exception $e) {
            //     return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            // }
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeeBankAccountById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeBankAccountByIds = BankAccount::where($where)->first();

        return response()->json($employeeBankAccountByIds);
    }

    public function employeeBankAccountUpdate(Request $request,$id)
    {
        $validated = $request->validate([
            'stuff_id' => 'required',
        ]);
        try {

            $bank_account = BankAccount::where('id',$id)->first();
            $bank_account->bank_account_com_id = Auth::user()->com_id;
            $bank_account->bank_account_employee_id = Session::get('employee_setup_id');
            $bank_account->stuff_id = $request->stuff_id;
            $bank_account->bank_account_id = $request->bank_id;
            $bank_account->bank_account_number = $request->bank_account_number;
            $bank_account->save();

        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeBankAccount($id)
    {
        $bank_account = BankAccount::where('id', $id)->delete();
        return back()->with('message', 'Deleted Successfully');
    }
    public function addPfBankAccount(Request $request)
    {

        if (ProvidentfundBankaccount::where('providentfund_bankaccount_com_id', '=', Auth::user()->com_id)->exists()) {
            return back()->with('message', 'Already has a PF Bank Account');
        } else {

            $validated = $request->validate([
                'providentfund_bankaccount_bank_name' => 'required',
                'providentfund_bankaccount_bank_account_number' => 'required',
                // 'providentfund_bankaccount_branch_name' => 'required',
                // 'providentfund_bankaccount_branch_code' => 'required',
            ]);
            try {
                $pf_bank_account = new ProvidentfundBankaccount();
                $pf_bank_account->providentfund_bankaccount_com_id = Auth::user()->com_id;
                $pf_bank_account->providentfund_bankaccount_bank_name = $request->providentfund_bankaccount_bank_name;
                $pf_bank_account->providentfund_bankaccount_bank_account_number = $request->providentfund_bankaccount_bank_account_number;
                $pf_bank_account->providentfund_bankaccount_branch_name = $request->providentfund_bankaccount_branch_name;
                $pf_bank_account->providentfund_bankaccount_branch_code = $request->providentfund_bankaccount_branch_code;
                $pf_bank_account->save();
            } catch (\Exception $e) {
                return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
            }
        }
        return back()->with('message', 'Added Successfully');
    }

    public function employeePfBankAccountById(Request $request)
    {
        try {
            $where = array('id' => $request->id);
            $employeePfBankAccountByIds = ProvidentfundBankaccount::where($where)->first();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return response()->json($employeePfBankAccountByIds);
    }
    public function pFBankAccountUpdate(Request $request)
    {
        $validated = $request->validate([
            'providentfund_bankaccount_bank_name' => 'required',
            'providentfund_bankaccount_bank_account_number' => 'required',
            // 'providentfund_bankaccount_branch_name' => 'required',
            // 'providentfund_bankaccount_branch_code' => 'required',
        ]);
        try {
            $pf_bank_account = ProvidentfundBankaccount::find($request->id);
            $pf_bank_account->providentfund_bankaccount_bank_name = $request->providentfund_bankaccount_bank_name;
            $pf_bank_account->providentfund_bankaccount_bank_account_number = $request->providentfund_bankaccount_bank_account_number;
            $pf_bank_account->providentfund_bankaccount_branch_name = $request->providentfund_bankaccount_branch_name;
            $pf_bank_account->providentfund_bankaccount_branch_code = $request->providentfund_bankaccount_branch_code;
            $pf_bank_account->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deletePfBankAccount($id)
    {
        try {
            $pf_bank_account = ProvidentfundBankaccount::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}