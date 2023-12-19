<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyBankAccount;
use Auth;
use DB;
use Session;
class CompanyBankAccountController extends Controller
{
public function index(){

$bank_accounts = CompanyBankAccount::where('company_bank_account_com_id',Auth::user()->com_id)->get();
return view('back-end.premium.customize.company-bank-account.index',compact('bank_accounts'));
}

public function addBankAccount(Request $request){
        $validated = $request->validate([
            'bank_name' => 'required',
            'bank_type' => 'required',
            'account_number' => 'required',
            'branch_name' => 'required',
            'routing_number' => 'required',
            'address' => 'required',
        ]);
        try {
            $com_bank_account = new CompanyBankAccount();
            $com_bank_account->company_bank_account_com_id = Auth::user()->com_id;
            $com_bank_account->company_bank_account_number = $request->account_number;
            $com_bank_account->company_bank_account_type = $request->bank_type;
            $com_bank_account->company_bank_account_name = $request->bank_name;
            $com_bank_account->company_bank_account_branch = $request->branch_name;
            $com_bank_account->company_bank_account_routing_number = $request->routing_number;
            $com_bank_account->company_bank_account_address = $request->address;
            $com_bank_account->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

return back()->with('message','Bank Account Added Successfully');
}

public function editBankAccount(Request $request,$id){
        $validated = $request->validate([
            'bank_name' => 'required',
            'bank_type' => 'required',
            'account_number' => 'required',
            'branch_name' => 'required',
            'routing_number' => 'required',
            'address' => 'required',
        ]);
        try {
            $com_bank_account = CompanyBankAccount::where('id',$id)->first();
            $com_bank_account->company_bank_account_com_id = Auth::user()->com_id;
            $com_bank_account->company_bank_account_number = $request->account_number;
            $com_bank_account->company_bank_account_type = $request->bank_type;
            $com_bank_account->company_bank_account_name = $request->bank_name;
            $com_bank_account->company_bank_account_branch = $request->branch_name;
            $com_bank_account->company_bank_account_routing_number = $request->routing_number;
            $com_bank_account->company_bank_account_address = $request->address;
            $com_bank_account->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

return back()->with('message','Bank Account edited Successfully');
}
public function deleteBankAccount($id){
CompanyBankAccount::where('id',$id)->delete();
return back()->with('message','Bank Account deleted Successfully');
}
}