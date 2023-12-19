<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Role;
use App\Models\Upazila;
use App\Models\Union;
use App\Models\Permission;
use Illuminate\Http\Request;
use Auth;
use DB;

class UpazilaController extends Controller
{

    public function upazilaIndex()
    {
        $customize_sub_module_foreteen_add = "3.14.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_foreteen_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_foreteen_edit = "3.14.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_foreteen_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_foreteen_delete = "3.14.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_foreteen_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $upazilas = Upazila::with('district')->get();
        $districts = District::get();
        return view('back-end.premium.customize.upazila.upazila-index', get_defined_vars());
    }


    public function upazilasAdd(Request $request)
    {
        try {
            $upazilas = new Upazila();
            $upazilas->district_id = $request->district_id;
            $upazilas->up_name = $request->up_name;
            $upazilas->up_bn_name = $request->up_bn_name;
            $upazilas->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }


    public function upazilaById(Request $request)
    {
        $where = array('id' => $request->id);
        $upazilasTypeByIds = Upazila::where($where)->first();
        return response()->json($upazilasTypeByIds);
    }

    public function upazilaUpdate(Request $request)
    {
        try {
            $upazilas = Upazila::find($request->id);
            $upazilas->district_id = $request->district_id;
            $upazilas->up_name = $request->up_name;
            $upazilas->up_bn_name = $request->up_bn_name;
            $upazilas->save();
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteUpazila($id)
    {

        DB::beginTransaction();
        try {
            if (Union::where('upazila_id', $id)) {
                return back()->with('message', 'Delete Not Possible, Because this upzila already used');
            } else {
                $upazilas = Upazila::where('id', $id)->delete();
                return back()->with('message', 'Deleted Successfully');
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

}
