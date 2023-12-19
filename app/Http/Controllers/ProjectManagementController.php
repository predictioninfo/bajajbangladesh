<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Permission;
use Illuminate\Http\Request;
use Auth;

class ProjectManagementController extends Controller
{
    public function projectIndex()
    {

        $project_management_sub_module_one_add = "11.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $project_management_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $project_management_sub_module_one_edit = "11.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $project_management_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $project_management_sub_module_one_delete = "11.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $project_management_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->get();
        $projects = Project::where('project_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.project-management.project.project-index', compact('employees', 'projects', 'add_permission', 'edit_permission', 'delete_permission'));
    }
    public function taskIndex()
    {

        $project_management_sub_module_two_add = "11.2.1";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $project_management_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $project_management_sub_module_two_edit = "11.2.2";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $project_management_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $project_management_sub_module_two_delete = "11.2.3";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $project_management_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $employees = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', 1)->get();
        $projects = Project::where('project_com_id', '=', Auth::user()->com_id)->get(['id', 'project_name']);
        $tasks = Task::where('task_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.project-management.task.task-index', compact('tasks', 'employees', 'projects', 'add_permission', 'edit_permission', 'delete_permission'));
    }
    public function clientIndex()
    {
        return view('back-end.premium.project-management.client.client-index');
    }
    public function invoiceIndex()
    {
        return view('back-end.premium.project-management.invoice.invoice-index');
    }
    public function taxTypeIndex()
    {
        return view('back-end.premium.project-management.tax-type.tax-type-index');
    }
}
