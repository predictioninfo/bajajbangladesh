<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Region;
use App\Models\Role;
use App\Models\AttendanceLocation;
use App\Models\Permission;
use App\Models\Locatoincustomize;
use DB;
use Auth;
use Session;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {

        $user_sub_module_one_add = "1.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }
        $user_sub_module_one_edit = "1.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $user_sub_module_one_delete = "1.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->where('roles_is_active', 1)->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        //$att_location = AttendanceLocation::all();
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

            // $users = User::with('userDivision', 'userDistrict', 'userUpazila', 'userUnion', 'emoloyeedetail')->where('com_id', '=', Auth::user()->com_id)->where('is_active', '=', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone', 'username', 'profile_photo', 'is_active', 'salary_type', 'address']);
            $users = User::with('userDivision', 'userDistrict', 'userUpazila', 'userUnion', 'emoloyeedetail')->where('com_id', '=', Auth::user()->com_id)->where('is_active', '=', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get();

            return view('back-end.premium.user.premium-user-index', get_defined_vars());
        } else {

            // $users = User::with('userDivision', 'userDistrict', 'userUpazila', 'userUnion', 'emoloyeedetail')->where('id', '=', Auth::user()->id)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone', 'username', 'profile_photo', 'is_active', 'address', 'address']);
            $users = User::with('userDivision', 'userDistrict', 'userUpazila', 'userUnion', 'emoloyeedetail')->where('id', '=', Auth::user()->id)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get();

            return view('back-end.premium.user.premium-user-index', get_defined_vars());
        }
    }


    public function handle()
{
    // Query the database for expired dates
    $expired = DB::table('users')->where('inactive_date', '<', Carbon::now())->get();

    // Update the status for each expired date
    foreach ($expired as $item) {
        DB::table('users')->where('id', $item->id)->update(['is_active' => 'null']);
    }
}

    public function inactiveUserList()
    {

        $user_sub_module_one_add = "1.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $user_sub_module_one_edit = "1.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $user_sub_module_one_delete = "1.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $user_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $companies = Company::where('id', '=', Auth::user()->com_id)->get();
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get();
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->get();
        //$att_location = AttendanceLocation::all();
        if (Role::where('id', Auth::user()->role_id)->where('roles_admin_status', 'Yes')->where('roles_is_active', 1)->exists()) {

            $users = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 0)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone', 'username', 'profile_photo', 'is_active', 'address', 'inactive_phone', 'inactive_email', 'inactive_date','inactive_description','in_trine_month','expiry_date']);
            return view('back-end.premium.user.inactive-user-list', get_defined_vars());
        } else {

            $users = User::where('id', '=', Auth::user()->id)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone', 'username', 'profile_photo', 'is_active', 'address', 'inactive_phone', 'inactive_email', 'inactive_date','inactive_description','in_trine_month','expiry_date']);

            return view('back-end.premium.user.inactive-user-list', get_defined_vars());
        }
    }
    public function assigningRoleIndex()
    {
        $user_roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->get();
        $users = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', '=', 1)->whereNull('company_profile')->get(['id', 'first_name', 'last_name', 'username', 'profile_photo', 'role_id']);

        return view('back-end.premium.user.assigning-role-index', [
            'user_roles' => $user_roles,
            'users' => $users,
        ]);
    }

    public function assinedRole($user_id, $role_id)
    {
        $user = User::find($user_id);
        $user->role_id = $role_id;
        $user->save();

        return back()->with('message', 'Role Assined Successfully');
    }

    public function userListdataFatch()
    {

        $users = DB::table('users')->where('com_id', '=', Auth::user()->com_id)->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function edit($id)
    {
        //
        // $where = array('id' => $id);
        // $post  = User::where($where)->first();

        // return Response::json($post);

        $users_by_id = DB::table('users')->where('id', $id)->get();

        return response()->json($users_by_id);
    }


    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->delete();

            DB::commit();
            // all good
            return back()->with('message', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('message', 'OOPs! There have some dependency');
        }
    }

    public function sessionLogOutForUserPanel()
    {
        Session::destroy('employee_setup_id');
        return redirect('/home');
    }
}
