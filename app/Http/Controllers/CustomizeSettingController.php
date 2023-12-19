<?php

namespace App\Http\Controllers;

use App\Models\ConveyanceAllowanceNonTaxableRangeYearly;
use App\Models\FestivalConfig;
use App\Models\HouseRentNonTaxableRangeYearly;
use App\Models\MedicalAllowanceNonTaxableRangeYearly;
use App\Models\MinimumTaxConfigure;
use App\Models\Role;
use App\Models\TaxConfig;
use App\Models\SalaryConfig;
use App\Models\FestivalBonus;
use App\Models\OvertimeConfig;
use App\Models\LatetimeConfig;
use App\Models\ProvidentfundConfig;
use App\Models\VariableType;
use App\Models\VariableMethod;
use App\Models\Permission;
use App\Models\Signature;
use Illuminate\Http\Request;
use Auth;

class CustomizeSettingController extends Controller
{
    public function roleIndex()
    {

        $customize_sub_module_one_add = "3.1.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $customize_sub_module_one_edit = "3.1.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_one_delete = "3.1.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $customize_sub_module_one_permission = "3.1.4";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_one_permission . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $access_permission = "Yes";
        } else {
            $access_permission = "No";
        }



        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->orderBy('roles_name', 'ASC')->get();
        return view('back-end.premium.customize.roles-and-access.premium-role-access-index', compact('roles', 'add_permission', 'edit_permission', 'delete_permission', 'access_permission'));
    }
    public function accessPermissionIndex($id, $roles_name)
    {

        //$roles = Role::where('roles_com_id','=',Auth::user()->com_id)->get();

        $role_id = $id;
        $roles_name = $roles_name;

        return view('back-end.premium.customize.permission.permission-index', compact('role_id', 'roles_name'));

        // $data['roles'] = Role::where('roles_com_id','=',Auth::user()->com_id)->get();
        // return view('back-end.premium.customize.roles-and-access.premium-role-access-index',$data);
    }
    public function generalIndex()
    {
        return view('back-end.user.index');
    }
    public function mailIndex()
    {
        return view('back-end.user.index');
    }
    public function languageIndex()
    {
        return view('back-end.user.index');
    }
    public function variableTypeIndex()
    {

        $customize_sub_module_three_add = "3.3.1";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_three_edit = "3.3.2";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_three_delete = "3.3.3";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_three_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $award_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Award')->get();
        $warning_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Warning')->get();
        $termination_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Termination')->get();
        $job_status_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Job-Status')->get();
        $office_shift_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Office-Shift')->get();

        $documnets_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Document-Type')->get();

        return view('back-end.premium.customize.variable-type.variable-type-index', get_defined_vars());
    }
    public function variableMethodIndex()
    {
        $customize_sub_module_four_add = "3.4.1";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_four_edit = "3.4.2";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_four_delete = "3.4.3";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_four_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $arrangement_methods = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Arrangement')->get();
        $payment_type_methods = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Payment')->get();
        $qualification_methods = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Qualification')->get();
        $job_category_name_methods = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Job')->get();
        $job_location_name_methods = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Joblocation')->get();
        return view('back-end.premium.customize.variable-method.variable-method-index', get_defined_vars());
    }
    public function ipIndex()
    {
        return view('back-end.user.index');
    }
    public function taxCofigIndex()
    {
        $customize_sub_module_five_add = "3.5.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_five_edit = "3.5.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_five_delete = "3.5.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_five_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $tax_configs = TaxConfig::where('tax_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.tax-config.tax-config-index', compact('tax_configs', 'add_permission', 'edit_permission', 'delete_permission'));
    }


    public function salaryConfigIndex()
    {
        $customize_sub_module_six_add = "3.6.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_six_edit = "3.6.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_six_delete = "3.6.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $salary_configs = SalaryConfig::where('salary_config_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.salary-config.salary-config-index', compact('salary_configs', 'add_permission', 'edit_permission', 'delete_permission'));
    }

    public function salaryComponentIndex()
    {
        return view('back-end.user.index');
    }

    public function festivalIndex()
    {
        $customize_sub_module_eight_add = "3.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_eight_edit = "3.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_eight_delete = "3.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $festivals = FestivalBonus::where('festival_bonus_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.festival.festival-index', get_defined_vars());
    }

    public function festivalConfigIndex()
    {
        $customize_sub_module_tweenty_two_add = "3.22.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_tweenty_two_edit = "3.22.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_tweenty_two_delete = "3.22.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $festivals = FestivalConfig::where('festival_config_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.festival-config.index', get_defined_vars());
    }

    public function overTimeIndex()
    {
        $customize_sub_module_nine_add = "3.9.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_nine_edit = "3.9.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_nine_delete = "3.9.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_nine_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $over_time_configs = OvertimeConfig::where('overtime_config_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.over-time-config.over-time-config-index', compact('over_time_configs', 'add_permission', 'edit_permission', 'delete_permission'));
    }

    public function lateTimeIndex()
    {
        $customize_sub_module_ten_add = "3.10.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }


        $customize_sub_module_ten_edit = "3.10.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $customize_sub_module_ten_delete = "3.10.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_ten_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $late_time_configs = LatetimeConfig::where('latetime_config_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.late-time.late-time-index', compact('late_time_configs', 'add_permission', 'edit_permission', 'delete_permission'));
    }
    public function companyPfConfigIndex()
    {
        $customize_sub_module_eleven_add = "3.11.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $customize_sub_module_eleven_edit = "3.11.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $customize_sub_module_eleven_delete = "3.11.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_eleven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }


        $company_pf_configs = ProvidentfundConfig::where('providentfund_config_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.customize.company-pf-config.company-pf-config-index', compact('company_pf_configs', 'add_permission', 'edit_permission', 'delete_permission'));
    }

    public function minimumHouseRentNonTaxable(){

       $customize_sub_module_tweenty_five_add = "3.25.1";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_five_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }
      $house_rent_non_taxable =  HouseRentNonTaxableRangeYearly::where('house_rent_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
      return view('back-end.premium.customize.house-rent-minimum-non-taxable-amount.index',get_defined_vars());
    }

    public function minimumMedicalAllowanceTaxable(){

       $customize_sub_module_tweenty_six_add = "3.26.1";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }
      $medical_allowance_non_taxable =  MedicalAllowanceNonTaxableRangeYearly::where('medical_allowance_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
      return view('back-end.premium.customize.medical-allowance-minimum-non-taxable-amount.index',get_defined_vars());
    }

    public function conveyanceMedicalAllowanceTaxable(){

       $customize_sub_module_tweenty_seven_add = "3.27.1";
        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_seven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }
      $conveyance_allowance_non_taxable =  ConveyanceAllowanceNonTaxableRangeYearly::where('conveyance_allowance_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
      return view('back-end.premium.customize.conveyance-allowance-minimum-non-taxable-amount.index',get_defined_vars());
    }

    public function approvalIndex()
    {
        $signatures = Signature::get();
        return view('back-end.premium.customize.approval.index', compact('signatures'));
    }

    public function minimumTaxConfig()
    {
         $customize_sub_module_tweenty_three_add = "3.23.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $customize_sub_module_tweenty_three_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

         $tax_config =  MinimumTaxConfigure::where('minimum_tax_config_com_id',Auth::user()->com_id)->first();

        return view('back-end.premium.customize.tax-config.minimum-tax-config', compact('tax_config','add_permission'));
    }
}
