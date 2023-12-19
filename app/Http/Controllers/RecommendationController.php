<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use App\Models\SuperRecommendation;
use App\Models\Recommendation;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;
use DB;

class RecommendationController extends Controller
{
    public function recommendetionIndex()
    {
        $performance_sub_module_one_add = "15.1.1";
        $performance_sub_module_one_edit = "15.1.2";
        $performance_sub_module_one_delete = "15.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_one_add . '"]\')')->exists()) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_one_edit . '"]\')')->exists()) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_one_delete . '"]\')')->exists()) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
         $recommendentions = SuperRecommendation::with('recommendationType','employee')->where('super_recom_com_id', Auth::user()->com_id)->get();

         $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();

         foreach ($roles as $roles_value) {
            if ($roles_value->roles_admin_status == 'Yes' || Auth::user()->company_profile == 'Yes') {
                $employees = User::where('com_id', Auth::user()->com_id)->get();

            } else {
                $employees = User::where('report_to_parent_id', '=', Auth::user()->id)
                ->where('com_id', Auth::user()->com_id)
                ->get();
            }

         $recommendentionType = Recommendation::where('recom_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.recommendetion.recommendetionIndex',get_defined_vars());
    }
    }

    public function recommendationAdd(Request $request)
    {
        $validated = $request->validate([
            'recom_id' => 'required',
        ]);
        try {
            $recommendentions = new SuperRecommendation();
            $recommendentions->super_recom_com_id = Auth::user()->com_id;
            $recommendentions->recom_id = $request->recom_id;
            $recommendentions->recom_employee_id = $request->recom_employee_id;
            $recommendentions->recom_details = $request->recom_details;
            $recommendentions->save();

            return back()->with('message', 'Recommendation Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function updateRecommendation(Request $request)
    {
        $validated = $request->validate([
            'recom_id' => 'required',
        ]);
        try {
            $recommendentions =  SuperRecommendation::find($request->id);
            $recommendentions->super_recom_com_id = Auth::user()->com_id;
            $recommendentions->recom_id = $request->recom_id;
            $recommendentions->recom_employee_id = $request->recom_employee_id;
            $recommendentions->recom_details = $request->recom_details;
            $recommendentions->save();


            return back()->with('message', 'Recommendentions Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }


    public function deleteRecommendation($id)
    {

        DB::beginTransaction();
        try {
            $recommendentions = SuperRecommendation::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

}
