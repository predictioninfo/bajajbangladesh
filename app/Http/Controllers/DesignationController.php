<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Auth;
use DB;

class DesignationController extends Controller
{
    public function addDesignation(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required',
            'designation_name' => 'required',
            'designation_bangla_name' => 'required',
        ]);
        try {
            $designation = new Designation();
            $designation->designation_com_id = Auth::user()->com_id;
            $designation->designation_department_id = $request->department_id;
            $designation->designation_name = $request->designation_name;
            $designation->designation_bangla_name = $request->designation_bangla_name;

            // Check if the combination already exists in the database
            $existingDesignation = Designation::where('designation_com_id', Auth::user()->com_id)
                ->where('designation_department_id', $request->department_id)
                ->where('designation_name', $request->designation_name)
                ->where('designation_bangla_name', $request->designation_bangla_name)
                ->first();

            if ($existingDesignation) {
                return back()->with('message', 'Designation Already Added');
            }

            // Save to database if the combination doesn't exist
            $designation->save();
        } catch (Exception $e) {
            return back()->with('message', 'OOPs! Something Is Missing. Please check carefully');
        }

        return back()->with('message', 'Designation Added Successfully');;
    }

    public function updateDesignation(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required',
            'designation_name' => 'required',
            'designation_bangla_name' => 'required',
        ]);

        try {
            $designation =  Designation::find($request->id);
            $designation->designation_com_id = Auth::user()->com_id;
            if ($request->department_id) {
                $designation->designation_department_id = $request->department_id;
            }
            if ($request->designation_name) {
                $designation->designation_name = $request->designation_name;
                $designation->designation_bangla_name = $request->designation_bangla_name;
            }
            // Check if the combination already exists in the database
            // $existingDesignation = Designation::where('designation_com_id', Auth::user()->com_id)
            //     ->where('designation_department_id', $request->department_id)
            //     ->where('designation_name', $request->designation_name)
            //     ->where('designation_bangla_name', $request->designation_bangla_name)
            //     ->first();

            // if ($existingDesignation) {
                // return back()->with('message', 'Designation Already Added');
            // }

            // Save to database if the combination doesn't exist
            $designation->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }

        return back()->with('message', 'Designation Updated Successfully');
    }

    public function deleteDesignation($id)
    {
        DB::beginTransaction();
        try {
            $designation = Designation::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function bulkDeleteDesignation(Request $request)
    {
        try {
            $designation = Designation::where('designation_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }
}
