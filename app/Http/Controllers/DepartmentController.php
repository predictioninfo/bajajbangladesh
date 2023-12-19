<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Auth;
use DB;

class DepartmentController extends Controller
{
    public function addDepartment(Request $request)
    {

        $validated = $request->validate([
            'department_name' => 'required|unique:departments',
            'department_name_bangla' => 'required|unique:departments',
        ]);
        try {
            $department = new Department();
            $department->department_com_id = Auth::user()->com_id;
            $department->department_name = $request->department_name;
            $department->department_name_bangla = $request->department_name_bangla;
            $department->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }

        return back()->with('message', 'Department Added Successfully');
    }

    public function updateDepartment(Request $request)
    {
        $validated = $request->validate([
            'department_name' => 'required',
            'department_name_bangla' => 'required',
        ]);
        try {
            $department =  Department::find($request->id);
            $department->department_com_id = Auth::user()->com_id;
            $department->department_name = $request->department_name;
            $department->department_name_bangla = $request->department_name_bangla;
            $department->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Department Updated Successfully');
    }

    public function deleteDepartment($id)
    {

        DB::beginTransaction();
        try {
            $department = Department::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function bulkDeleteDepartment(Request $request)
    {
        try {
            $department = Department::where('department_com_id', $request->bulk_delete_com_id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }
}
