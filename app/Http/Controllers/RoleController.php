<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Auth;
use DB;

class RoleController extends Controller
{
    public function roleStore(Request $request)
    {

        $validated = $request->validate([
            'roles_name' => 'required',
            // 'roles_description' => 'required',
        ]);
        try {
            $role = new Role();
            $role->roles_com_id = Auth::user()->com_id;
            $role->roles_name = $request->roles_name;
            $role->roles_description = $request->roles_description;
            if ($request->roles_admin_status) {
                $role->roles_admin_status = $request->roles_admin_status;
            }
            if ($request->roles_bulk_status) {
                $role->roles_bulk_status = $request->roles_bulk_status;
                // if (Role::where('roles_com_id', Auth::user()->com_id)->where('roles_bulk_status', '=', 'Yes')->exists()) {
                //     return back()->with('message', 'You already added a role with bulk import status');
                // } else {
                //     $role->roles_bulk_status = $request->roles_bulk_status;
                // }
            }
            $role->roles_is_active = $request->active;
            $role->save();

            return back()->with('message', 'Added Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function roleById(Request $request)
    {

        $where = array('id' => $request->id);
        $roleByIds = Role::where($where)->first();

        return response()->json($roleByIds);
    }

    public function updateRole(Request $request)
    {
        $validated = $request->validate([
            'roles_name' => 'required',
            // 'roles_description' => 'required',
        ]);
        // return $request->all();
        try {
            $role = Role::find($request->id);
            $role->roles_name = $request->roles_name;
            $role->roles_description = $request->roles_description;
            $role->roles_admin_status = $request->roles_admin_status ? $request->roles_admin_status : '';
            $role->roles_bulk_status = $request->roles_bulk_status ? $request->roles_bulk_status : '';
            $role->roles_is_active = $request->active;
            $role->save();


            return back()->with('message', 'Updated Successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing');
        }
    }

    public function deleteRole($id)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }
}
