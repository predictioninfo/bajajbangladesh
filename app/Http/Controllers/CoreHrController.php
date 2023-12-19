<?php

namespace App\Http\Controllers;

use App\Models\ResignationLetter;
use DB;
use Auth;
use Session;
use App\Models\User;
use App\Models\Award;
use App\Models\Travel;
use App\Models\Trainer;
use App\Models\Warning;
use App\Models\Training;
use App\Models\Transfer;
use App\Models\Complaint;
use App\Models\Promotion;
use App\Models\Department;
use App\Models\Permission;
use App\Models\Designation;
use App\Models\Resignation;
use App\Models\Termination;
use App\Models\VariableType;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\VariableMethod;
use App\Models\SalaryIncrement;
use App\Models\WarningLetterFormat;
use App\Models\SalaryIncrementLetter;
use App\Models\IncrementSalaryHistory;
use App\Models\ProvidentfundBankaccount;

class CoreHrController extends Controller
{


    public function promotionIndex()
    {
        try {
            $core_hr_sub_module_one_add = "4.1.1";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $add_permission = "Yes";
            } else {
                $add_permission = "No";
            }

            $core_hr_sub_module_one_edit = "4.1.2";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $edit_permission = "Yes";
            } else {
                $edit_permission = "No";
            }

            $core_hr_sub_module_one_delete = "4.1.3";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_one_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $delete_permission = "Yes";
            } else {
                $delete_permission = "No";
            }

            $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
            $designations = Designation::where('designation_com_id', '=', Auth::user()->com_id)->get();
            $promotions = Promotion::where('promotion_com_id', '=', Auth::user()->com_id)->get();
            return view('back-end.premium.core-hr.promotion.promotion-index', get_defined_vars());
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }


    public function employeeIncrementIndex()
    {
        try {
            $core_hr_sub_module_twelve_add = "4.12.1";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_twelve_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $add_permission = "Yes";
            } else {
                $add_permission = "No";
            }

            $core_hr_sub_module_twelve_edit = "4.12.2";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_twelve_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $edit_permission = "Yes";
            } else {
                $edit_permission = "No";
            }

            $core_hr_sub_module_twelve_delete = "4.12.3";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_twelve_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $delete_permission = "Yes";
            } else {
                $delete_permission = "No";
            }

            $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
            $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name', 'last_name']);
            $designations = Designation::where('designation_com_id', '=', Auth::user()->com_id)->get();
            $increment = IncrementSalaryHistory::where('inc_sal_his_com_id', '=', Auth::user()->com_id)->get();
            return view('back-end.premium.core-hr.increment.increment-index', get_defined_vars());
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }



    public function awardIndex()
    {
        try {
            $core_hr_sub_module_two_add = "4.2.1";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $add_permission = "Yes";
            } else {
                $add_permission = "No";
            }

            $core_hr_sub_module_two_edit = "4.2.2";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $edit_permission = "Yes";
            } else {
                $edit_permission = "No";
            }

            $core_hr_sub_module_two_delete = "4.2.3";

            if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_two_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
                $delete_permission = "Yes";
            } else {
                $delete_permission = "No";
            }
            $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name', 'last_name']);
            $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
            $award_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Award')->get();
            $awards = Award::join('users', 'awards.award_employee_id', '=', 'users.id')
                ->join('departments', 'awards.award_department_id', '=', 'departments.id')
                ->select('awards.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('award_com_id', '=', Auth::user()->com_id)
                ->get();
            return view('back-end.premium.core-hr.award.award-index', get_defined_vars());
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
    }

    public function travelIndex()
    {
        $core_hr_sub_module_three_add = "4.3.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $core_hr_sub_module_three_edit = "4.3.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }


        $core_hr_sub_module_three_delete = "4.3.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_three_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $arrangement_types = VariableMethod::where('variable_method_com_id', '=', Auth::user()->com_id)->where('variable_method_category', '=', 'Arrangement')->get();
        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $travels = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_com_id', '=', Auth::user()->com_id)
                ->get();
        } else {
            $travels = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
                ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
                ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('travel_com_id', '=', Auth::user()->com_id)
                ->where('travel_approver_generation_one_id', '=', Auth::user()->id)
                ->orWhere('travel_approver_generation_two_id', '=', Auth::user()->id)
                ->get();
        }

        return view('back-end.premium.core-hr.travel.travel-index', compact('arrangement_types', 'departments', 'travels', 'add_permission', 'edit_permission', 'delete_permission'));
    }


    public function transferIndex()
    {
        $core_hr_sub_module_four_add = "4.4.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $core_hr_sub_module_four_edit = "4.4.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $core_hr_sub_module_four_delete = "4.4.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_four_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $employee_basic_infos = User::where('id', '=', Session::get('employee_setup_id'))->get(['id', 'department_id', 'designation_id']);

        foreach ($employee_basic_infos as  $employee_designation_info) {
            $designation_id = $employee_designation_info->department_id;
        }
        $designations = Designation::where('designation_com_id', '=', Auth::user()->com_id)->get();
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $transfers = Transfer::where('transfer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name', 'last_name','company_assigned_id']);

        return view('back-end.premium.core-hr.transfer.transfer-index', get_defined_vars());
    }

    public function resignationIndex()
    {
        $core_hr_sub_module_five_add = "4.5.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $core_hr_sub_module_five_edit = "4.5.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $core_hr_sub_module_five_delete = "4.5.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_five_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }

        $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name', 'last_name']);

        $resignation_letters = ResignationLetter::where('resignation_letter_com_id', '=', Auth::user()->com_id)->get();

        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $resignation = Resignation::get('resignation_employee_id');
        $excluded_ids = $resignation->pluck('resignation_employee_id')->toArray();
        $active_users = User::where('com_id', '=', Auth::user()->com_id)
        ->where('is_active', '=', 1)
        ->where('users_bulk_deleted', 'No')
        ->whereNull('company_profile')
        ->whereNotIn('id', $excluded_ids)
        ->orderBy('id', 'DESC')
        ->get(['id', 'first_name', 'last_name']);
        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $resignations = Resignation::join('users', 'resignations.resignation_employee_id', '=', 'users.id')
                ->join('departments', 'resignations.resignation_department_id', '=', 'departments.id')
                ->join('designations','resignations.designation_id', '=','designations.id')
                ->select('resignations.*','users.first_name','users.last_name','departments.department_name','designations.designation_name')
                ->where('resignation_com_id', '=', Auth::user()->com_id)
                ->get();
        } else {

            $resignations = Resignation::join('users', 'resignations.resignation_employee_id', '=', 'users.id')
                ->join('departments', 'resignations.resignation_department_id', '=', 'departments.id')
                ->join('designations','resignations.designation_id', '=','designations.id')
                ->select('resignations.*','users.first_name','users.last_name','departments.department_name','designations.designation_name')
                ->where('resignation_com_id', '=', Auth::user()->com_id)
                ->where('users.report_to_parent_id', '=', Auth::user()->id)
                ->get();
        }
        return view('back-end.premium.core-hr.resignation.resignation-index', get_defined_vars());
    }

    public function complaintIndex()
    {
        $core_hr_sub_module_six_add = "4.6.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $core_hr_sub_module_six_edit = "4.6.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $core_hr_sub_module_six_delete = "4.6.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_six_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name', 'last_name']);
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();

        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $complaints = Complaint::where('complaint_com_id', '=', Auth::user()->com_id)->get();
        } else {
            $complaints = Complaint::join('users', 'complaints.complaint_to_employee_id', '=', 'users.id')

                ->select('complaints.*', 'users.first_name', 'users.last_name')
                ->where('users.report_to_parent_id', '=', Auth::user()->id)

                ->get();
        }
        return view('back-end.premium.core-hr.complaint.complaint-index', get_defined_vars());
    }

    public function warningIndex()
    {

        $core_hr_sub_module_seven_add = "4.7.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }
        $core_hr_sub_module_seven_edit = "4.7.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $core_hr_sub_module_seven_delete = "4.7.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_seven_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name', 'last_name']);
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $warning_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Warning')->get();
        $cirtificateFormat = WarningLetterFormat::where('warning_letter_format_com_id',Auth::user()->com_id)->get();

        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $warnings = Warning::join('users', 'warnings.warning_employee_id', '=', 'users.id')
                ->join('departments', 'warnings.warning_department_id', '=', 'departments.id')
                ->select('warnings.*', 'users.first_name', 'users.last_name', 'departments.department_name','users.warning_letter_format_id')
                ->where('warning_com_id', '=', Auth::user()->com_id)
                ->get();
        } else {

            $warnings = Warning::join('users', 'warnings.warning_employee_id', '=', 'users.id')
                ->join('departments', 'warnings.warning_department_id', '=', 'departments.id')
                ->select('warnings.*', 'users.first_name', 'users.last_name', 'departments.department_name','users.warning_letter_format_id')
                ->where('warning_com_id', '=', Auth::user()->com_id)
                ->where('users.report_to_parent_id', '=', Auth::user()->id)
                ->get();
        }

        return view('back-end.premium.core-hr.warning.warning-index', get_defined_vars());
    }

    public function terminationIndex()
    {

        $core_hr_sub_module_eight_add = "4.8.1";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_add . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $add_permission = "Yes";
        } else {
            $add_permission = "No";
        }

        $core_hr_sub_module_eight_edit = "4.8.2";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_edit . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $edit_permission = "Yes";
        } else {
            $edit_permission = "No";
        }

        $core_hr_sub_module_eight_delete = "4.8.3";

        if (Permission::where('permission_com_id', '=', Auth::user()->com_id)->where('permission_role_id', '=', Auth::user()->role_id)->whereRaw('json_contains(permission_content, \'["' .  $core_hr_sub_module_eight_delete . '"]\')')->exists() || (Auth::user()->company_profile == 'Yes')) {
            $delete_permission = "Yes";
        } else {
            $delete_permission = "No";
        }
        $inactive_employees = User::where('com_id',Auth::user()->com_id)->where('is_active',1)->where('users_bulk_deleted','No')->whereNull('company_profile')->get();
        $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name', 'last_name']);
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $termination_types = VariableType::where('variable_type_com_id', '=', Auth::user()->com_id)->where('variable_type_category', '=', 'Termination')->get();

        if (Auth::user()->company_profile == "Yes" || Auth::user()->userrole->roles_admin_status == "Yes") {
            $terminations = Termination::join('users', 'terminations.termination_employee_id', '=', 'users.id')
                ->join('departments', 'terminations.termination_department_id', '=', 'departments.id')
                ->select('terminations.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('termination_com_id', '=', Auth::user()->com_id)
                ->get();
        } else {

            $terminations = Termination::join('users', 'terminations.termination_employee_id', '=', 'users.id')
                ->join('departments', 'terminations.termination_department_id', '=', 'departments.id')
                ->select('terminations.*', 'users.first_name', 'users.last_name', 'departments.department_name')
                ->where('termination_com_id', '=', Auth::user()->com_id)
                ->where('users.report_to_parent_id', '=', Auth::user()->id)
                ->get();
        }
        return view('back-end.premium.core-hr.termination.termination-index', get_defined_vars());
    }

    public function providentFundMemberIndex()
    {
        $last_three_months =  date('Y-m-d', strtotime('-3 month'));
        $pf_eligible_members = User::join('departments', 'users.department_id', '=', 'departments.id')
            ->join('designations', 'users.designation_id', 'designations.id')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.user_provident_fund_member', 'designations.designation_name', 'departments.department_name')
            ->where('com_id', '=', Auth::user()->com_id)
            ->where('is_active', '=', 1)
            ->where('joining_date', '<=', $last_three_months)
            ->get();
        return view('back-end.premium.core-hr.provident-fund-member.provident-fund-member-index', get_defined_vars());
    }

    public function takePfMembership()
    {
        $last_three_months =  date('Y-m-d', strtotime('-3 month'));
        $pf_memberships = User::where('id', '=', Auth::user()->id)
            ->where('com_id', '=', Auth::user()->com_id)
            ->where('is_active', '=', 1)
            ->where('joining_date', '<=', $last_three_months)
            ->get(['id', 'first_name', 'last_name', 'user_provident_fund_member']);
        return view('back-end.premium.core-hr.pf-membership-talking.pf-membership-talking-index', get_defined_vars());
    }


    public function employeePromotionIndex()
    {
        $promotions = Promotion::where('promotion_employee_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.core-hr.promotion.promotion-index', compact('promotions'));
    }

    public function employeeAwardIndex()
    {
        $awards = Award::join('users', 'awards.award_employee_id', '=', 'users.id')
            ->join('departments', 'awards.award_department_id', '=', 'departments.id')
            ->select('awards.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('award_employee_id', '=', Session::get('employee_setup_id'))
            ->get();
        return view('back-end.premium.user-settings.core-hr.award.award-index', get_defined_vars());
    }

    public function employeeTravelIndex()
    {
        $travels = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
            ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
            ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('travel_employee_id', '=', Session::get('employee_setup_id'))
            ->get();
        return view('back-end.premium.user-settings.core-hr.travel.travel-index', get_defined_vars());
    }

    public function employeeTransferIndex()
    {
        $transfers = Transfer::where('transfer_employee_id', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.core-hr.transfer.transfer-index', get_defined_vars());
    }

    public function employeeResignationIndex()
    {

        $resignations = Resignation::join('users', 'resignations.resignation_employee_id', '=', 'users.id')
            ->join('departments', 'resignations.resignation_department_id', '=', 'departments.id')
            ->select('resignations.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'resignations.id')
            ->where('resignation_employee_id', '=', Session::get('employee_setup_id'))
            ->get();


        return view('back-end.premium.user-settings.core-hr.resignation.resignation-index', get_defined_vars());
    }

    public function employeeComplaintIndex()
    {
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $complaints = Complaint::where('complaint_to_employee_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.core-hr.complaint.complaint-index', get_defined_vars());
    }

    public function employeeWarningIndex()
    {
        $warnings = Warning::join('users', 'warnings.warning_employee_id', '=', 'users.id')
            ->join('departments', 'warnings.warning_department_id', '=', 'departments.id')
            ->select('warnings.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('warning_employee_id', '=', Session::get('employee_setup_id'))
            ->get();
        return view('back-end.premium.user-settings.core-hr.warning.warning-index', get_defined_vars());
    }

    public function employeeTerminationIndex()
    {
        $terminations = Termination::join('users', 'terminations.termination_employee_id', '=', 'users.id')
            ->join('departments', 'terminations.termination_department_id', '=', 'departments.id')
            ->select('terminations.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('termination_employee_id', '=', Session::get('employee_setup_id'))
            ->get();
        return view('back-end.premium.user-settings.core-hr.termination.termination-index', get_defined_vars());
    }

    public function pFBankAccountIndex()
    {
        $pf_bank_accounts = ProvidentfundBankaccount::where('providentfund_bankaccount_com_id', Auth::user()->com_id)->get();

        return view('back-end.premium.user-settings.general.employee-pf-bank-account-index', get_defined_vars());
    }

    public function employeeTrainingIndex()
    {
        $trainings = Training::where('training_com_id', '=', Auth::user()->com_id)->get();
        $trainers = Trainer::where('trainer_com_id', Auth::user()->com_id)->get();
        $employees = User::where('com_id', Auth::user()->com_id)->get(['id', 'first_name']);
        return view('back-end.premium.user-settings.core-hr.training.training', get_defined_vars());
    }


    public function salaryIncrementIndex()
    {
        $departments = Department::where('department_com_id',Auth::user()->com_id)->get();
        $cirtificateFormat = SalaryIncrementLetter::where('salary_inc_letter_com_id',Auth::user()->com_id)->get();
        $salary_increments = SalaryIncrement::where('salary_incre_com_id',Auth::user()->com_id)->get();

        return view('back-end.premium.core-hr.salary-increment.salary-increment-index',get_defined_vars());
    }
}
