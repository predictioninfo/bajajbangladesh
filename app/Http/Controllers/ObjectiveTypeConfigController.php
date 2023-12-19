<?php

namespace App\Http\Controllers;

use App\Models\ObjectiveTypeConfig;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\ObjectiveType;
use App\Models\ObjectivePointConfig;
use App\Models\ObjectiveTypeConfigMasters;
use App\Models\Permission;
use App\Models\Designation;
use App\Models\Role;
use Auth;
use DB;

class ObjectiveTypeConfigController extends Controller
{

    public function objectiveTypeConfigAdd(Request $request)
    {
        try {
            if (ObjectiveTypeConfigMasters::where('obj_type_config_com_id', Auth::user()->com_id)->where('obj_config_mas_dep_id', $request->obj_config_mas_dep_id)
               ->where('obj_config_mas_dis_id', $request->obj_config_mas_dis_id)->exists()) {
                return back()->with('message', 'You already configured your value for this Designation!');
            } else {

            $objectiveType = new ObjectiveTypeConfigMasters;
            $objectiveType->obj_type_config_com_id = Auth::user()->com_id;
            $objectiveType->obj_config_mas_dis_id  = $request->obj_config_mas_dis_id;
            $objectiveType->obj_config_mas_dep_id  = $request->obj_config_mas_dep_id;

            $objectiveType->save();
            if ($objectiveType->id) {
                $this->ObjectiveTypeConfigDetails($objectiveType->id, $request, $objectiveType->obj_config_mas_dis_id, $objectiveType->obj_config_mas_dep_id);
            }
            return redirect()->route('objectives-type-configs')->with('message', 'Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }

    }

     public function ObjectiveTypeConfigDetails($masterId, $request,$disignationID,$departID)
     {
         ObjectiveTypeConfig::where('objective_type_mas_id', $masterId)->delete();
            $objectiveTypeDetails = $request->obj_config_percent;
            $allDetails = array();
            foreach ($objectiveTypeDetails as $key => $value) :
                $objectiveTypeDetails = array();
                $objectiveTypeDetails['objective_type_mas_id'] = $masterId;
                $objectiveTypeDetails['obj_config_com_id'] = Auth::user()->com_id;
                $objectiveTypeDetails['obj_config_desig_id'] = $disignationID;
                $objectiveTypeDetails['obj_config_dept_id'] = $departID;
                $objectiveTypeDetails['obj_config_obj_typ_id'] = $request->obj_config_obj_typ_id[$key];
                $objectiveTypeDetails['obj_config_percent'] = $request->obj_config_percent[$key];
                $objectiveTypeDetails['obj_config_target_point'] = $request->obj_config_target_point[$key];
                array_push($allDetails, $objectiveTypeDetails);
            endforeach;
            ObjectiveTypeConfig::insert($allDetails);

            return back()->with('message', 'Added Successfully');

    }

    public function objectiveTypeConfigIndex()
    {
        $performance_sub_module_four_add = "15.2.1";
        $performance_sub_module_four_edit = "15.2.2";
        $performance_sub_module_four_delete = "15.2.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_four_add . '"]\')')->exists()) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_four_edit . '"]\')')->exists()) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $performance_sub_module_four_delete . '"]\')')->exists()) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
        $objective_type_configs = ObjectiveTypeConfigMasters::where('obj_type_config_com_id', Auth::user()->com_id)->orderBy('id', 'DESC')->get();
        $objective_points = ObjectivePointConfig::where('objective_point_config_com_id', Auth::user()->com_id)->get();
        $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.objective-type-config.objective-type-config-index', get_defined_vars());
    }



    public function objectiveTypeConfigEdit($id)
    {
        $detailsObjectiveTypes = ObjectiveTypeConfig::with('userdepartmentfromobjectiveconfig','userdesignationfromobjectiveconfig','userobjectivetypefromobjectiveconfig')->where('objective_type_mas_id', $id)
            ->where('obj_config_com_id', Auth::user()->com_id)
            ->get();
        $detailsObjective = ObjectiveTypeConfigMasters::where('id', $id)->where('obj_type_config_com_id', Auth::user()->com_id)
            ->first();
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
        $objective_points = ObjectivePointConfig::where('objective_point_config_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.performance.objective-type-config.edit', get_defined_vars());
    }

    public function objectiveTypeConfigShow($id)
    {
        $detailsObjectiveTypes = ObjectiveTypeConfig::with('userdepartmentfromobjectiveconfig','userdesignationfromobjectiveconfig','userobjectivetypefromobjectiveconfig')->where('objective_type_mas_id', $id)
            ->where('obj_config_com_id', Auth::user()->com_id)
            ->get();
        $detailsObjective = ObjectiveTypeConfigMasters::where('id', $id)->where('obj_type_config_com_id', Auth::user()->com_id)
            ->first();
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
        $objective_points = ObjectivePointConfig::where('objective_point_config_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.performance.objective-type-config.show', get_defined_vars());
    }

    public function objectiveTypeConfigById(Request $request)
    {

        $where = array('id' => $request->id);
        $employeeObjectiveTypeConfigByIds = ObjectiveTypeConfig::where($where)->first();
        return response()->json($employeeObjectiveTypeConfigByIds);
    }
    public function createObjctiveType(Request $request)
    {
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
        $objective_type_configs = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->orderBy('id', 'DESC')->get();
        $objective_points = ObjectivePointConfig::where('objective_point_config_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.performance.objective-type-config.create_obj_type_config', get_defined_vars());
    }

    public function updateObjectiveTypeConfig(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $objectiveType = ObjectiveTypeConfigMasters::findOrFail($id);
            $objectiveType->obj_type_config_com_id = Auth::user()->com_id;
            $objectiveType->obj_config_mas_dis_id  = $request->obj_config_mas_dis_id;
            $objectiveType->obj_config_mas_dep_id  = $request->obj_config_mas_dep_id;

            $objectiveType->save();
            if ($objectiveType->id) {
                $this->updateObjectiveTypeConfigDetails($objectiveType->id, $request,$objectiveType->obj_config_mas_dis_id, $objectiveType->obj_config_mas_dep_id);
            }
            DB::commit();
            // all good
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function updateObjectiveTypeConfigDetails($masterId, $request,$disignationID,$departID)
    {
        ObjectiveTypeConfig::where('objective_type_mas_id', $masterId)->delete();

        $objectiveTypeDetails = $request->obj_config_percent;
        $allDetails = array();
        foreach ($objectiveTypeDetails as $key => $value) :
            $objectiveTypeDetails = array();
            $objectiveTypeDetails['objective_type_mas_id'] = $masterId;
            $objectiveTypeDetails['obj_config_com_id'] = Auth::user()->com_id;
            $objectiveTypeDetails['obj_config_desig_id'] = $disignationID;
            $objectiveTypeDetails['obj_config_dept_id'] = $departID;
            $objectiveTypeDetails['obj_config_obj_typ_id'] = $request->obj_config_obj_typ_id[$key];
            $objectiveTypeDetails['obj_config_percent'] = $request->obj_config_percent[$key];
            $objectiveTypeDetails['obj_config_target_point'] = $request->obj_config_target_point[$key];
            array_push($allDetails, $objectiveTypeDetails);
        endforeach;
        ObjectiveTypeConfig::insert($allDetails);

        return back()->with('message', 'Added Successfully');
    }


    public function deleteObjectiveTypeConfig($id)
    {
        {
            DB::beginTransaction();

        try {
            $objective_type_config = ObjectiveTypeConfigMasters::find($id);
            $objective_type_config->delete();
            ObjectiveTypeConfig::where('objective_type_mas_id', $id)->delete();

            DB::commit();
                // all good
                return back()->with('message', 'Deleted Successfully');
            } catch (\Exception $e) {
                DB::rollback();
                return $e->getMessage();
            }
        }


    }
}
