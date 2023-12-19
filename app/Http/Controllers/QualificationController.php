<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;
use Auth;
use Session;

class QualificationController extends Controller
{
    public function qualificationEmployeeAdd(Request $request)
    {

        $validated = $request->validate([
            'qualification_institute_name' => 'required',
            'qualification_education_level' => 'required',
            'qualification_from_date' => 'required',
            'qualification_to_date' => 'required',
            'qualification_language_version' => 'required',
            // 'qualification_skill' => 'required',
            // 'qualification_description' => 'required',
        ]);
        try {
            $qualification = new Qualification();
            $qualification->qualification_com_id = Auth::user()->com_id;
            $qualification->qualification_employee_id = Session::get('employee_setup_id');
            $qualification->qualification_institute_name = $request->qualification_institute_name;
            $qualification->qualification_education_level = $request->qualification_education_level;
            $qualification->qualification_from_date = $request->qualification_from_date;
            $qualification->qualification_to_date = $request->qualification_to_date;
            $qualification->qualification_language_version = $request->qualification_language_version;
            $qualification->qualification_skill = $request->qualification_skill;
            $qualification->qualification_description = $request->qualification_description;
            $qualification->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeQualificationById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeQualificationByIds = Qualification::where($where)->first();

        return response()->json($employeeQualificationByIds);
    }

    public function employeeQualificationUpdate(Request $request)
    {

        $validated = $request->validate([
            'qualification_institute_name' => 'required',
            'qualification_education_level' => 'required',
            'qualification_from_date' => 'required',
            'qualification_to_date' => 'required',
            'qualification_language_version' => 'required',
            'qualification_skill' => 'required',
            'qualification_description' => 'required',
        ]);
        try {
            $qualification = Qualification::find($request->id);
            $qualification->qualification_institute_name = $request->qualification_institute_name;
            $qualification->qualification_education_level = $request->qualification_education_level;
            $qualification->qualification_from_date = $request->qualification_from_date;
            $qualification->qualification_to_date = $request->qualification_to_date;
            $qualification->qualification_language_version = $request->qualification_language_version;
            $qualification->qualification_skill = $request->qualification_skill;
            $qualification->qualification_description = $request->qualification_description;
            $qualification->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeeQualification($id)
    {
        try {
            $qualification = Qualification::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}