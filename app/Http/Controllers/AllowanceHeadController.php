<?php

namespace App\Http\Controllers;

use App\Models\AllowanceHead;
use Illuminate\Http\Request;
use Auth;

class AllowanceHeadController extends Controller
{

    public function addAllowance(Request $request)
    {
        $validated = $request->validate([
            'allowance_head_name' => 'required',
        ]);
        try {
            $allowance_head = new AllowanceHead();
            $allowance_head->allowance_com_id = Auth::user()->com_id;
            $allowance_head->allowance_head_name = $request->allowance_head_name;
            $allowance_head->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

        return back()->with('message', 'Allowance Added Successfully');
    }

    public function updateAllowance(Request $request)
    {
        $validated = $request->validate([
            'allowance_head_name' => 'required|min:3',
        ]);
        try {
            $allowance_head =  AllowanceHead::find($request->id);
            $allowance_head->allowance_com_id = Auth::user()->com_id;
            $allowance_head->allowance_head_name = $request->allowance_head_name;
            $allowance_head->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }


        return back()->with('message', 'Allowance Updated Successfully');
    }

    public function deleteAllowance($id)
    {
        try {
            $allowance_head =  AllowanceHead::find($id);
            $allowance_head->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

        return back()->with('message', 'Allowance Deleted Successfully');
    }

    public function bulkDeleteAllowanceHead(Request $request)
    {
        try {
            $allowance_head = AllowanceHead::where('allowance_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }
}