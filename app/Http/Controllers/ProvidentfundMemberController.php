<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProvidentfundMember;
use Illuminate\Http\Request;
use Auth;
use Session;
use Mail;

class ProvidentfundMemberController extends Controller
{
    public function sendMembershipProposal($id)
    {
        try {
            $provident_member_details = User::where('id', $id)->first(['email', 'first_name', 'last_name']);


            $data["email"] = $provident_member_details->email;
            $data["client_name"] = $provident_member_details->first_name . ' ' . $provident_member_details->last_name;
            $data["subject"] = "Provident Fund Proposal";


            $pf_member_name = array(
                'pf_member_name' => $provident_member_details->first_name . ' ' . $provident_member_details->last_name,
            );

            Mail::send('back-end.premium.emails.pf-member-proposal', [
                'pf_member_name' => $pf_member_name,
            ], function ($message) use ($data) {
                $message->to($data["email"], $data["client_name"])
                    ->subject($data["subject"]);
            });

            return back()->with('message', 'Sent');
        } catch (\Exception $e) {
         
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function pfMembershipTaken($id)
    {
        try {
            $pf_membership_taken = User::find($id);
            $pf_membership_taken->user_provident_fund_member = "Yes";
            $pf_membership_taken->save();

            return back()->with('message', 'PF Membership Process Done!');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeProvidentfundMemberById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeProvidentfundMemberByIds = ProvidentfundMember::where($where)->first();

        return response()->json($employeePensionByIds);
    }

    public function employeeProvidentfundMemberUpdate(Request $request)
    {
        try {
            $pension = ProvidentfundMember::find($request->id);
            $pension->update($request->all());

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeeProvidentfundMember($id)
    {
        try {
            $pension = ProvidentfundMember::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}
