<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyBankAccount;
use App\Models\CompanyBankAccountCommunication;
use App\Models\User;
use Auth;
use DB;
use Session;
class CompanyBankAccountCommunicationController extends Controller
{
    public function index(){

     $employees = User::where('com_id',Auth::user()->com_id)->orderBy('id','desc')->get();
     $bank_accounts = CompanyBankAccount::where('company_bank_account_com_id',Auth::user()->com_id)->get();
     $commmunication_bank_accounts = CompanyBankAccountCommunication::where('company_bank_account_communication_com_id',Auth::user()->com_id)->get();

     return view('back-end.premium.customize.comapny-bank-account-communication.index',compact('bank_accounts','employees','commmunication_bank_accounts'));

    }

    public function addBankAccountCommunication(Request $request){
        $validated = $request->validate([
            'bank_id' => 'required',
            'emp_id' => 'required',
        ]);
        try {
            $com_bank_account = new CompanyBankAccountCommunication();
            $com_bank_account->company_bank_account_communication_com_id = Auth::user()->com_id;
            $com_bank_account->company_bank_account_communication_bank_id = $request->bank_id;
            $com_bank_account->company_bank_account_communication_emp_id = $request->emp_id;
            $com_bank_account->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

return back()->with('message','Bank Account Added Successfully');
}


public function editBankAccountCommunication(Request $request,$id){
        $validated = $request->validate([
            'bank_id' => 'required',
            'emp_id' => 'required',
        ]);
        try {
            $com_bank_account = CompanyBankAccountCommunication::where('id',$id)->first();
            $com_bank_account->company_bank_account_communication_com_id = Auth::user()->com_id;
            $com_bank_account->company_bank_account_communication_bank_id = $request->bank_id;
            $com_bank_account->company_bank_account_communication_emp_id = $request->emp_id;
            $com_bank_account->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

return back()->with('message','Bank Account edited Successfully');
}
public function deleteBankAccountCommunication($id){
CompanyBankAccountCommunication::where('id',$id)->delete();
return back()->with('message','Bank Account Communication deleted Successfully');
}
}
