<?php

namespace App\Http\Controllers;

use App\Models\WorkExperience;
use Illuminate\Http\Request;
use Auth;
use Session;

class WorkExperienceController extends Controller
{
    public function workExperirenceEmployeeAdd(Request $request)
    {
        $validated = $request->validate([
            'work_experience_company_name' => 'required',
            'work_experience_from_date' => 'required',
            'work_experience_to_date' => 'required',
            'work_experience_post' => 'required',
            'work_experience_desc' => 'required',
        ]);
        try {


             $work_experience = new WorkExperience();
             $work_experience->work_experience_com_id = Auth::user()->com_id;
             $work_experience->work_experience_employee_id = Session::get('employee_setup_id');
             $work_experience->total_year_of_experience = $request->total_year_of_experience;
             $work_experience->work_experience_company_name = $request->work_experience_company_name;
             $work_experience->work_experience_from_date = $request->work_experience_from_date;
             $work_experience->work_experience_to_date = $request->work_experience_to_date;
             $work_experience->work_experience_post = $request->work_experience_post;
             $work_experience->work_experience_desc = $request->work_experience_desc;
             $work_experience->save();

        return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function employeeWorkExperirenceById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeImmigrantByIds = WorkExperience::where($where)->first();
        return response()->json($employeeImmigrantByIds);
    }

    public function employeeWorkExperirenceUpdate(Request $request)
    {
        $validated = $request->validate([
            'work_experience_company_name' => 'required',
            'work_experience_from_date' => 'required',
            'work_experience_to_date' => 'required',
            'work_experience_post' => 'required',
            'work_experience_desc' => 'required',
        ]);
        try {
            $work_experience = WorkExperience::find($request->id);
            $work_experience->work_experience_company_name = $request->work_experience_company_name;
            $work_experience->work_experience_from_date = $request->work_experience_from_date;
            $work_experience->total_year_of_experience = $request->total_year_of_experience;
            $work_experience->work_experience_to_date = $request->work_experience_to_date;
            $work_experience->work_experience_post = $request->work_experience_post;
            $work_experience->work_experience_desc = $request->work_experience_desc;
            $work_experience->save();

            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteEmployeeWorkExperirence($id)
    {
        try {
            $work_experience = WorkExperience::where('id', $id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }
}
