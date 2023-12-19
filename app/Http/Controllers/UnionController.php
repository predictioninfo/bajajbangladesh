<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use App\Models\Role;
use App\Models\Union;
use App\Models\Permission;
use Illuminate\Http\Request;
use Auth;
use DB;

class UnionController extends Controller
{

    public function unionIndex()
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


        $unions = Union::with('upazila')->orderBy('id', 'DESC')->paginate(100);
        $upazilas = Upazila::get();
        return view('back-end.premium.customize.union.union-index', get_defined_vars());
    }


    public function unionAdd(Request $request)
    {
        try {
            $union = new Union();
            $union->upazila_id = $request->upazila_id;
            $union->un_name = $request->un_name;
            $union->un_bn_name = $request->un_bn_name;
            $union->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }


    public function unionById(Request $request)
    {
        $where = array('id' => $request->id);
        $unionTypeByIds = Union::where($where)->first();
        return response()->json($unionTypeByIds);
    }

    public function unionUpdate(Request $request)
    {
        try {
            $union = Union::find($request->id);
            $union->upazila_id = $request->upazila_id;
            $union->un_name = $request->un_name;
            $union->un_bn_name = $request->un_bn_name;
            $union->save();
            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteUnion($id)
    {

        DB::beginTransaction();
        try {
            $upazilas = Union::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function searchUnion(Request $request)
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
        $search = $request->input('search');
        $unions = Union::with('upazila')
            ->where('un_name', 'like', "%{$search}%")
            ->orWhere('un_bn_name', 'like', "%{$search}%")
            ->orWhereHas('upazila', function ($query) use ($search) {
                $query->where('up_name', 'like', "%{$search}%");
            })
            ->get();

        // Create an array to hold the search results and additional variables
        $responseData = [
            'unions' => $unions,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ];

        // Return the response as JSON
        return response()->json($responseData);
    }
}
