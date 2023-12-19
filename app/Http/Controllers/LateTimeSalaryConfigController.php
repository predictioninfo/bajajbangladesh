<?php

namespace App\Http\Controllers;

use App\Models\LateTimeSalaryConfig;
use App\Models\Permission;
use Illuminate\Http\Request;
use Auth;
class LateTimeSalaryConfigController extends Controller
{
  public function index(){
        $customize_sub_module_tweenty_four_add = "3.24.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_four_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $customize_sub_module_tweenty_four_edit = "3.24.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_four_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $customize_sub_module_tweenty_four_delete = "3.24.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_four_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $late_time_salary_configs = LateTimeSalaryConfig::where('late_time_salary_config_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.late-time-salary-config.index', compact('late_time_salary_configs', 'add_permission', 'edit_permission', 'delete_permission'));
    }

    public function add(Request $request){
       if(LateTimeSalaryConfig::where('late_time_salary_config_com_id',Auth::user()->com_id)->exists()){
        $late_time_salary_config = LateTimeSalaryConfig::where('late_time_salary_config_com_id',Auth::user()->com_id)->first();
        $late_time_salary_config->late_time_salary_config_com_id = Auth::user()->com_id;
        $late_time_salary_config->late_time_salary_config = $request->late_time_salary_config;
        $late_time_salary_config->save();
        return back()->with('message',' Added Late Time Salary Config Succsesfully');
        }else{
        $late_time_salary_config = new LateTimeSalaryConfig();
        $late_time_salary_config->late_time_salary_config_com_id = Auth::user()->com_id;
        $late_time_salary_config->late_time_salary_config = $request->late_time_salary_config;
        $late_time_salary_config->save();

      return back()->with('message',' Added Late Time Salary Config Succsesfully');
        }
    }
    public function delete(){
     LateTimeSalaryConfig::where('late_time_salary_config_com_id',Auth::user()->com_id)->delete();
     return back()->with('message','Deleted Late Time Salary Config Succsesfully');
    }
}