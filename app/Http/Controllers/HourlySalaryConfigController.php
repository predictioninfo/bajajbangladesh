<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\HourlySalaryConfig;
use Illuminate\Http\Request;
use Session;
use Auth;
use Image;
use DB;


class HourlySalaryConfigController extends Controller
{
    public function employeeHourlyTotalSalaryIndex()
    {

        $customize_sub_module_six_add = "3.6.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_six_edit = "3.6.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $customize_sub_module_six_delete = "3.6.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $user_hourly_salaries = User::where('id', '=', Session::get('employee_setup_id'))->pluck('per_hour_rate');

        $user_hourly_salary_configs = HourlySalaryConfig::where('hourly_salary_employee_id', Session::get('employee_setup_id'))->get();

        return view('back-end.premium.user-settings.salary.employee-hourly_total-salary-index', get_defined_vars());
    }

    public function addEmployeeHourlySalary(Request $request)
    {

        $validated = $request->validate([
            'per_day_rate' => 'required',
            'per_day_hour' => 'required',

        ]);

        try {
            if (HourlySalaryConfig::where('hourly_salary_employee_id', Session::get('employee_setup_id'))->exists()) {
                return back()->with('message', 'You Already Set Your Salary Config');
            } else {

                $hourly_salary = new HourlySalaryConfig();

                $hourly_salary->hourly_salary_config_com_id = Auth::user()->com_id;
                $hourly_salary->hourly_salary_employee_id = $request->id;
                $hourly_salary->per_day_rate = $request->per_day_rate;
                $hourly_salary->per_day_hour = $request->per_day_hour;
                $hourly_salary->per_hour_rate = ($request->per_day_rate / $request->per_day_hour);

                $hourly_salary->save();

                $user =  User::find($request->id);
                $user->gross_salary = 0;
                $user->per_hour_rate = ($request->per_day_rate / $request->per_day_hour);
                $user->save();


                return back()->with('message', 'Added Successfully');
            }
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }



    public function hourlySalaryConfigById(Request $request)
    {

        $where = array('id' => $request->id);
        $hourlySalaryConfigByIds = HourlySalaryConfig::where($where)->first();

        return response()->json($hourlySalaryConfigByIds);
    }

    public function employeeHourlySalaryUpdate(Request $request)
    {
        $validated = $request->validate([
            'per_day_rate' => 'required',
            'per_day_hour' => 'required',

        ]);
        try {
            $hourly_salary = HourlySalaryConfig::where('hourly_salary_employee_id', $request->id)->first();
            $hourly_salary->per_day_rate = $request->per_day_rate;
            $hourly_salary->per_day_hour = $request->per_day_hour;
            $hourly_salary->per_hour_rate = ($request->per_day_rate / $request->per_day_hour);
            $hourly_salary->save();

            $user =  User::find($request->id);
            $user->per_hour_rate = ($request->per_day_rate / $request->per_day_hour);
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function deleteEmployeeHourlyGrossSalary($id)
    {
        try {
            $hourlyGrossSalary = HourlySalaryConfig::where('hourly_salary_employee_id', $id)->delete();

            $gross_salary = User::find($id);
            $gross_salary->gross_salary = 0;
            $gross_salary->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Deleted Successfully');
    }
}