<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Models\Grade;
use App\Models\GradeLabel;
use App\Models\GradeSetup;
use App\Models\Permission;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;


class OrganizationCofigarationController extends Controller
{
    public function grade(Request $request)
    {
        $orgainzation_configure_sub_module_three_add = "15.22.1";
        $orgainzation_configure_sub_module_three_edit = "15.22.2";
        $orgainzation_configure_sub_module_three_delete = "15.22.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $orgainzation_configure_sub_module_three_add . '"]\')')->exists()) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $orgainzation_configure_sub_module_three_edit . '"]\')')->exists()) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $orgainzation_configure_sub_module_three_delete . '"]\')')->exists()) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $grades = Grade::where('grade_com_id', Auth::user()->com_id)->get();
        $grade_labels = GradeLabel::where('grade_label_com_id', Auth::user()->com_id)->get();
        $depatments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
        $grade_setups = GradeSetup::where('grade_setup_com_id', Auth::user()->com_id)->get();
        $users = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('company_profile', null)->get();
        return  view('back-end.premium.organization.configarations.grade', get_defined_vars());
    }

    public function addRecommendation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        try {
            $recommendation = new Recommendation();
            $recommendation->recom_com_id = Auth::user()->com_id;
            $recommendation->name = $request->name;
            $recommendation->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Added Successfully');
    }

    public function recommendationById(Request $request)
    {

        $where = array('id' => $request->id);
        $recommendationTypeByIds = Recommendation::where($where)->first();

        return response()->json($recommendationTypeByIds);
    }


    public function updateRecommendation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        try {
            $recommendation =  Recommendation::find($request->id);
            $recommendation->name = $request->name;
            $recommendation->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deletRecommendation($id)
    {
        try {
            $recommendation =  Recommendation::where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
        return back()->with('message', 'Deleted Successfully');
    }
    public function addGrade(Request $request)
    {
        if (Grade::where('grade_com_id', Auth::user()->com_id)->where('grade_sort_order', $request->grade_sort_order)->exists()) {
            return back()->with('message', 'Grade sort order already exit');
        } else {
            $grade = new Grade();
            $grade->grade_com_id = Auth::user()->com_id;
            $grade->grade_name = $request->grade_name;
            $grade->grade_defination = $request->grade_defination;
            $grade->grade_sort_order = $request->grade_sort_order;
            $grade->save();
            return back()->with('message', 'Grade Added Succsesfully');
        }
    }
    public function editGrade(Request $request)
    {
        if (Grade::where('grade_com_id', Auth::user()->com_id)->where('grade_sort_order', $request->grade_sort_order)->exists()) {
            return back()->with('message', 'Grade sort order already exit');
        } else {
            $grade = Grade::find($request->id);
            $grade->grade_com_id = Auth::user()->com_id;
            $grade->grade_name = $request->grade_name;
            $grade->grade_defination = $request->grade_defination;
            $grade->grade_sort_order = $request->grade_sort_order;
            $grade->save();
            return back()->with('message', 'Grade Updated Succsesfully');
        }
    }
    public function deleteGrade($id)
    {

        $grade = Grade::find($id)->delete();
        return back()->with('message', 'Grade Deleted Succsesfully');
    }

    public function addGradeLabel(Request $request)
    {
        if (GradeLabel::where('grade_label_com_id', Auth::user()->com_id)->exists()) {
            $grade = GradeLabel::find($request->id);
            $grade->grade_label_com_id = Auth::user()->com_id;
            $grade->name = $request->grade_label_name;
            $grade->save();
            return back()->with('message', 'Grade updated succsesfully');
        } else {
            $grade = new GradeLabel();
            $grade->grade_label_com_id = Auth::user()->com_id;
            $grade->name = $request->grade_label_name;
            $grade->save();
            return back()->with('message', 'Grade added succsesfully');
        }
    }
    public function addGradeSetup(Request $request)
    {
        $report_to_parent_id = User::where('id', $request->emp_id)->first('report_to_parent_id');

        // Check if employee is already assigned
        $existingGradeSetup = GradeSetup::where('emp_id', $request->emp_id)->first();
        if ($existingGradeSetup) {
            return back()->with('message', 'Employee already assigned');
        }

        $grade = new GradeSetup();
        $grade->grade_setup_com_id = Auth::user()->com_id;
        $grade->grade_id = $request->grade_id;
        $grade->dept_id = $request->department_id;
        $grade->desg_id = $request->designation_id;
        $grade->emp_id = $request->emp_id;
        $grade->report_to_parent_id = $report_to_parent_id->report_to_parent_id;
        $grade->under_dept_id = $request->department_id_u;
        $grade->under_desg_id = $request->designation_id_u;
        $grade->under_grade_id = $request->under_grade_id;
        $grade->parent_id = $request->gradesetup_id;
        $grade->save();

        return back()->with('message', 'Grade Setup added successfully');
    }

    public function editGradeSetup(Request $request)
    {
        $where = array('id' => $request->id);
        $resignationByIds = GradeSetup::where($where)->first();
        $parent_id =  GradeSetup::where($where)->value('parent_id');
        $parent_grade_name = GradeSetup::with('gardeSetaupGarde')->where('id', $parent_id)->first();
        return response()->json(get_defined_vars());
    }
    public function updateGradeSetup(Request $request)
    {
        $report_to_parent_id = User::where('id', $request->edit_employee_id)->first('report_to_parent_id');
        $grade = GradeSetup::find($request->id);
        $grade->grade_setup_com_id = Auth::user()->com_id;

        $grade->report_to_parent_id = $report_to_parent_id->report_to_parent_id;
        if ($request->parent_id) {
            $grade->under_grade_id = $request->input('edit_show_grade');
            $grade->under_dept_id = $request->input('edit_designation_id_u');
            $grade->under_desg_id = $request->input('edit_department_id_u');
        } else {
            $grade->under_grade_id = null;
            $grade->under_dept_id = null;
            $grade->under_desg_id = null;
        }
        $grade->grade_id = $request->edit_grade_id;
        $grade->dept_id = $request->edit_department_id;
        $grade->desg_id = $request->edit_designation_id;
        $grade->emp_id = $request->edit_employee_id;
        $grade->save();
        return back()->with('message', 'Grade Setup Update succsesfully');
    }
    public function deleteGradeSetup($id)
    {
        $parent_d =  GradeSetup::where('id', $id)->first('parent_id');
        if ($parent_d->parent_id == null) {
            return back()->with('message', 'Parent Employee Delete Not Possible');
        } else {
            $grade = GradeSetup::find($id)->delete();
            return back()->with('message', 'Grade Setup Deleted Succsesfully');
        }
    }
}
