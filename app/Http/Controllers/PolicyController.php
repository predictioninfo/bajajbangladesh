<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Auth;

class PolicyController extends Controller
{
    public function addPolicy(Request $request)
    {
        $validated = $request->validate([
            'policy_title' => 'required',
            'policy_desc' => 'required|min:10',
        ]);
        try {
            $policy = new Policy();
            $policy->policy_com_id  = Auth::user()->com_id;
            $policy->policy_title = $request->policy_title;
            $policy->policy_desc = $request->policy_desc;
            $policy->policy_added_by  = Auth::user()->id;
            $policy->save();


            return back()->with('message', 'Company Policy Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function updatePolicy(Request $request)
    {
        $validated = $request->validate([
            'policy_title' => 'required',
            'policy_desc' => 'required|min:10',
        ]);
        try {
            $policy =  Policy::find($request->id);
            $policy->policy_title = $request->policy_title;
            $policy->policy_desc = $request->policy_desc;
            $policy->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Company Policy Updated Successfully');
    }

    public function deletePolicy($id)
    {
        try {
            $policy =  Policy::find($id);
            $policy->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

        return back()->with('message', 'Company Policy Deleted Successfully');
    }
}