<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;
use Mail;
use Image;
use Session;
use App\Models\Area;
use App\Models\Loan;
use App\Models\Role;
use App\Models\Task;
use App\Models\Town;
use App\Models\User;
use App\Models\Award;
use App\Models\Event;
use App\Models\Leave;
use App\Models\Lunch;
use App\Models\Region;
use App\Models\Travel;
use App\Models\Company;
use App\Models\DbHouse;
use App\Models\Holiday;
use App\Models\Meeting;
use App\Models\PaySlip;
use App\Models\Pension;
use App\Models\Project;
use App\Models\GoalType;
use App\Models\OverTime;
use App\Models\Transfer;
use App\Models\Appraisal;
use App\Models\LeaveType;
use App\Models\Objective;
use App\Models\TaxConfig;
use App\Models\Territory;
use App\Models\ValueType;
use App\Models\Commission;
use App\Models\Department;
use App\Models\Permission;
use App\Models\ValuePoint;
use App\Models\Designation;
use App\Models\Nationality;
use App\Models\Resignation;
use App\Models\Announcement;
use App\Models\GoalTracking;
use App\Models\Notification;
use App\Models\OtherPayment;
use App\Models\SalaryConfig;
use App\Models\YearlyReview;
use Illuminate\Http\Request;
use App\Models\ObjectiveType;
use App\Models\SalaryHistory;
use App\Models\SupportTicket;
use App\Models\SeatAllocation;
use App\Models\DevelopmentPlan;
use App\Models\valueTypeConfig;
use App\Models\ValueTypeDetail;
use App\Models\ObjectiveDetails;
use App\Models\Locatoincustomize;
use App\Models\MonthlyAttendance;
use App\Models\ReviewSalarySheet;
use App\Models\ApproveSalarySheet;
use App\Models\SalaryRemuneration;
use App\Models\StatutoryDeduction;
use App\Models\AppointmentTemplate;
use App\Models\MinimumTaxConfigure;
use App\Models\ObjectiveTypeConfig;
use App\Models\valueTypeConfigDetail;
use App\Models\PromotionDemotionPoint;
use App\Models\YearlyFestivalBonusConfig;
use App\Models\HouseRentNonTaxableRangeYearly;
use App\Models\MedicalAllowanceNonTaxableRangeYearly;
use App\Models\ConveyanceAllowanceNonTaxableRangeYearly;
use App\Models\District;
use App\Models\Division;
use App\Models\ExperienceTemplate;
use App\Models\Grade;
use App\Models\NonObjectionCertificate;
use App\Models\ProbitionLetterFormats;
use App\Models\SalaryCirtificate;
use App\Models\SalaryIncrementLetter;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\WarningLetterFormat;

class EmployeeSetupController extends Controller
{

    public function employeeDetailDashboardIndex($id)
    {


        $user_detail = User::with('userdepartment', 'userdesignation', 'userofficeshift', 'userregion', 'userarea', 'userterritory', 'usertown', 'userdbhouse', 'userrole', 'emoloyeedetail')
            ->where('id', '=', $id)->get();

        Session::put('employee_setup_id', $id);
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.dashboard.employee-setup-dashboard', [
            'user_detail' => $user_detail,
            'locations' => $locations,
        ]);
    }

    public function employeeProfileIndex(Request $request)
    {
        $profile  = User::where('id', '=', Session::get('employee_setup_id'))->get();
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.user-settings.profile.employee-profile-index', [
            'profile' => $profile,
            'locations' => $locations,
        ]);
    }

    public function employeeTotalSalaryIndex(Request $request)
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

        $user_gross_salaries = User::where('id', '=', Session::get('employee_setup_id'))->pluck('gross_salary');
        $user_salary_configs = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->get();

        foreach ($user_gross_salaries as $user_gross_salaries_value) {

            return view('back-end.premium.user-settings.salary.employee-total-salary-index', [
                'user_gross_salaries_value' => $user_gross_salaries_value,
                'user_salary_configs' => $user_salary_configs,
                'add_permission' => $add_permission,
                'edit_permission' => $edit_permission,
                'delete_permission' => $delete_permission,
            ]);
        }
    }



    public function SalaryRemuneration(Request $request)
    {
        $user_gross_salaries = User::where('id', '=', Session::get('employee_setup_id'))->pluck('gross_salary');
        $user_salary_configs = SalaryRemuneration::where('saray_remuneration_com_id', Auth::user()->com_id)->where('saray_remuneration_employeee_id', Session::get('employee_setup_id'))->get();

        return view('back-end.premium.user-settings.salary.employee-salary-remuneration', [
            'user_salary_configs' => $user_salary_configs,
        ]);
    }
    public function employeeAllowanceIndex(Request $request)
    {

        $user_gross_salaries = User::where('id', '=', Session::get('employee_setup_id'))->pluck('gross_salary');
        $user_salary_configs = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)->get();

        foreach ($user_gross_salaries as $user_gross_salaries_value) {

            return view('back-end.premium.user-settings.salary.employee-allowance-index', [
                'user_gross_salaries_value' => $user_gross_salaries_value,
                'user_salary_configs' => $user_salary_configs,
            ]);
        }
    }
    public function employeeCommissionIndex(Request $request)
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

        $commissions = Commission::where('commission_employee_id', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.salary.employee-commission-index', [
            'commissions' => $commissions,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function employeeLoanIndex(Request $request)
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

        $loans = Loan::where('loans_employee_id', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.salary.employee-loan-index', [
            'loans' => $loans,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function employeeSatatutoryDeductionIndex(Request $request)
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

        $statutory_decuctions = StatutoryDeduction::where('statutory_deduc_employee_id', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.salary.employee-statutory-deduction-index', [
            'statutory_decuctions' => $statutory_decuctions,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }
    public function employeeOtherPaymentIndex(Request $request)
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

        $other_payments = OtherPayment::where('other_payment_employee_id', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.salary.employee-other-payment-index', [
            'other_payments' => $other_payments,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }
    public function employeeOverTimeIndex(Request $request)
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

        $over_times = OverTime::where('over_time_employee_id', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.salary.employee-over-time-index', [
            'over_times' => $over_times,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function employeePensionIndex(Request $request)
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
        $pensions = Pension::where('pension_employee_id', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.salary.employee-pension-index', [
            'pensions' => $pensions,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function employeeMobileBill(Request $request)
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
        $mobile_bills = User::where('id', '=', Session::get('employee_setup_id'))->get('mobile_bill');
        return view('back-end.premium.user-settings.salary.employee-mobile-bill-index', [
            'mobile_bills' => $mobile_bills,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function employeeLunchBill(Request $request)
    {

        $lunch_bills = Lunch::where('lunch_emp_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.salary.employee-lunch-bill-index', [
            'lunch_bills' => $lunch_bills,
        ]);
    }
    public function employeeTaDa(Request $request)
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
        $transport_allowances = User::where('id', '=', Session::get('employee_setup_id'))->get('transport_allowance');
        return view('back-end.premium.user-settings.salary.employee-ta-da-index', [
            'transport_allowances' => $transport_allowances,
            'add_permission' => $add_permission,
            'edit_permission' => $edit_permission,
            'delete_permission' => $delete_permission,
        ]);
    }

    public function employeeCoreHrIndex(Request $request)
    {
        $user_detail = User::where('id', '=', 5)->pluck('first_name');
        return view('back-end.premium.user-settings.core-hr.employee-core-hr-index', [
            'user_detail' => $user_detail,
        ]);
    }
    public function employeeLeaveIndex(Request $request)
    {
        $current_year =  date('Y');
        $startDate = date("Y-m-d");
        $endDate = date('Y') . '-' . '12' . '-' . '31';
        $previous_start_date = date('Y-m-d', strtotime('-7 days'));
        $upto_end_date = date('Y-m-d', strtotime('+1 days'));

        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get();
        $users = User::where('id', Auth::user()->id)->get(['id', 'joining_date']);
        $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
            ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
            ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
            ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
            ->select('leaves.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
            ->where('leaves_employee_id', '=', Session::get('employee_setup_id'))
            ->get();

        $sick_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '4')
            // ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Session::get('employee_setup_id'))
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $casual_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '5')
            // ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Session::get('employee_setup_id'))
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $annual_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '7')
            // ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Session::get('employee_setup_id'))
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $Sick_leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Sick leave")
            ->get();
        $Casual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Casual Leave")
            ->get();
        $Annual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Annual Leave")
            ->get();
        return view('back-end.premium.user-settings.leave.employee-leave-index', [
            'leaves' => $leaves,
            'leave_types' => $leave_types,
            'sick_leave_count' => $sick_leave_count,
            'casual_leave_count' => $casual_leave_count,
            'annual_leave_count' => $annual_leave_count,
            'Sick_leaves' => $Sick_leaves,
            'Casual_Leaves' => $Casual_Leaves,
            'Annual_Leaves' => $Annual_Leaves,
            'current_year' => $current_year,
            'users' => $users,
        ]);
    }
    public function employeeReportToIndex(Request $request)
    {
        // ############### old code ###############

        // $session_id = [Session::get('employee_setup_id')];
        // $report_from_employee_details = User::where('id', '=', Session::get('employee_setup_id'))->first(['id', 'report_to_parent_id', 'region_id', 'area_id', 'territory_id', 'town_id', 'db_house_id']);
        // $first_supervisor = $report_from_employee_details->report_to_parent_id;
        // $second_supervisor = User::where('id', '=', $report_from_employee_details->report_to_parent_id)->first(['report_to_parent_id']);
        // $report_to_employees = User::where('com_id', '=', Auth::user()->com_id)->orWhere('region_id', '=', $report_from_employee_details->region_id)->whereNotIn('id', $session_id)->orWhere('area_id', '=', $report_from_employee_details->area_id)->get(['id', 'first_name', 'last_name', 'email', 'phone', 'profile_photo', 'is_active']);
        // return view('back-end.premium.user-settings.report-to-config.employee-report-to-config-index', get_defined_vars());

        // ############### new code###############

        $session_id = [Session::get('employee_setup_id')];
        $report_from_employee_details = User::where('id', '=', Session::get('employee_setup_id'))
            ->where('com_id', Auth::user()->com_id)
            ->first(['id', 'com_id', 'report_to_parent_id', 'region_id', 'area_id', 'territory_id', 'town_id', 'db_house_id']);

        if ($report_from_employee_details->region_id === null && $report_from_employee_details->area_id === null) {
            return redirect()->back()->with('message', 'Please set Region and Area In Job Location. <a href="' . route('employee-basic-infos') . '">Click Here to set Region or Area</a>');
        }

        $first_supervisor = $report_from_employee_details->report_to_parent_id;
        $second_supervisor = User::where('id', '=', $report_from_employee_details->report_to_parent_id)->first(['report_to_parent_id']);

  

        $report_to_employees = User::where(function ($query) use ($session_id, $report_from_employee_details) {
            $query->where('com_id', Auth::user()->com_id)
                ->orWhere('region_id', $report_from_employee_details->region_id)
                ->orWhere('area_id', $report_from_employee_details->area_id);
        })
            ->whereNotIn('id', $session_id)
            ->get(['id', 'com_id', 'first_name', 'last_name', 'email', 'phone', 'profile_photo', 'is_active']);


        return view('back-end.premium.user-settings.report-to-config.employee-report-to-config-index', get_defined_vars());
    }

    public function employeePfConfigIndex(Request $request)
    {
        $employee_provident_fund = User::where('id', '=', Session::get('employee_setup_id'))->pluck('user_provident_fund');
        return view('back-end.premium.user-settings.pf-config.employee-pf-config-index', [
            'employee_provident_fund' => $employee_provident_fund,
        ]);
    }

    public function employeeProjectIndex(Request $request)
    {
        $projects = Project::where('project_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.user-settings.project.employee-project-index', [
            'projects' => $projects,
        ]);
    }

    public function employeeEventIndex(Request $request)
    {
        $events = Event::where('event_com_id', '=', Auth::user()->com_id)->where('event_department_id', '=', Auth::user()->department_id)->get();
        return view('back-end.premium.user-settings.events.events-index', [
            'events' => $events,
        ]);
    }

    public function employeeMeetingIndex(Request $request)
    {
        $meetings = Meeting::where('meeting_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.user-settings.meetings.meetings-index', get_defined_vars());
    }

    public function employeeTaskIndex(Request $request)
    {
        $tasks = Task::where('task_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.user-settings.task.employee-task-index', get_defined_vars());
    }

    // Employee pay slip method start
    public function employeePaySlipIndex(Request $request)
    {
        $pay_slips = PaySlip::where('pay_slip_employee_id', '=', Session::get('employee_setup_id'))->get();
        return view('back-end.premium.user-settings.pay-slip.employee-pay-slip-index', get_defined_vars());
    }
    // Employee pay slip method end

    // Employee tax Accountable method start
    public function taxAccountable(Request $request)
    {
        $gross_salary = User::where('id', '=', Session::get('employee_setup_id'))->first('gross_salary');
        $salary_configs = SalaryConfig::where('salary_config_com_id', Auth::user()->com_id)
            ->get();
        $festivalBonusyearly = YearlyFestivalBonusConfig::where('employee_id', '=', Session::get('employee_setup_id'))->first('total_bonus');
        $house_rent_non_taxable =  HouseRentNonTaxableRangeYearly::where('house_rent_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
        $medical_allowance_non_taxable =  MedicalAllowanceNonTaxableRangeYearly::where('medical_allowance_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
        $conveyance_allowance_non_taxable =  ConveyanceAllowanceNonTaxableRangeYearly::where('conveyance_allowance_non_taxable_range_yearlies_com_id', Auth::user()->com_id)->first();
        $tax_configs = TaxConfig::where('tax_com_id', '=', Auth::user()->com_id)->get();
        $minimum_tax_configs = MinimumTaxConfigure::where('minimum_tax_config_com_id', '=', Auth::user()->com_id)->first();

        return view('back-end.premium.user-settings.tax.tax-accontable', get_defined_vars());
    }
    // Employee taxAccountable method end

    // Employee Salary Sheet Approve method start
    public function employeeSalarySheetApprove(Request $request)
    {
        $pay_slips = MonthlyAttendance::selectRaw("MAX(id) as id, DATE_FORMAT(attendance_month, '%m') as month")
            ->groupBy('month')
            ->orderBy('attendance_month', 'desc')
            ->get();

        $pay_slip_details = MonthlyAttendance::whereIn('id', $pay_slips->pluck('id'))->get();

        return view('back-end.premium.user-settings.pay-slip.employee-salary-sheet-index', compact('pay_slip_details'));
    }
    // Employee Salary Sheet Approve method end

    public function approveSalarySheet($id)
    {
        $users = MonthlyAttendance::where('monthly_employee_id', $id)
            ->select('id', 'monthly_employee_id', 'attendance_month')
            ->get();

        foreach ($users as $user) {
            $approveSalary = new ApproveSalarySheet();
            $approveSalary->app_salary_com_id = Auth::user()->com_id;
            $approveSalary->emp_id = $user->monthly_employee_id;
            $approveSalary->date = $user->attendance_month;
            $approveSalary->status = 1;
            $approveSalary->save();
        }

        return back()->with('message', 'Approve Successfully');
    }
    public function reviewSalarySheetApproval(Request $request)
    {

        $reviewSalary = new ReviewSalarySheet();
        $reviewSalary->salary_review_com_id = Auth::user()->com_id;
        $reviewSalary->date =  $request->date;
        $reviewSalary->review = $request->review;
        $reviewSalary->save();
        return back()->with('message', 'Review Sent Successfully');
    }


    public function employeeSupportTicketIndex()
    {
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $support_tickets = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
            ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
            ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('support_ticket_employee_id', '=', Session::get('employee_setup_id'))
            ->get();
        return view('back-end.premium.user-settings.support-ticket.support-ticket-index', get_defined_vars());
    }

    public function employeeProfilePhotoUpdate(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'profile_photo' => 'required',
        ]);
        try {
            $user = User::find($request->id);
            $image = $request->file('profile_photo');
            $input['imagename'] = time() . '.' . $image->extension();
            $filePath = 'uploads/profile_photos';
            $img = Image::make($image->path());
            $img->resize(110, 110, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['imagename']);
            $imageUrl = $filePath . '/' . $input['imagename'];
            $user->profile_photo = $imageUrl;
            $filePath = 'uploads/profile_photos/before_resized/';
            $before_resized_imageNames = $image->move($filePath, $input['imagename']);
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'User Updated Successfully');
    }

    public function employeePfUpdate(Request $request)
    {
        $validated = $request->validate([
            'user_provident_fund' => 'required',
        ]);
        try {
            $user = User::find($request->id);
            $user->user_provident_fund = $request->user_provident_fund;
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Updated Successfully');
    }

    public function employeeReportToSetup($id)
    {
        try {
            $user = User::find(Session::get('employee_setup_id'));
            $user->report_to_parent_id = $id;
            $user->save();
        } catch (\Exception $e) {
            return back()->with('message', 'OOPs!Something Is Missing.Please check Clearfully');
        }
        return back()->with('message', 'Set Successfully');
    }

    ############### details showw code from employee dashbard starts###################

    public function employeePaySlipRedirectIndex(Request $request)
    {
        $pay_slips = PaySlip::where('pay_slip_employee_id', '=', Auth::user()->id)->get();
        Session::put('employee_setup_id', Auth::user()->id);
        return view('back-end.premium.user-settings.pay-slip.employee-pay-slip-index', [
            'pay_slips' => $pay_slips,
        ]);
    }


    public function employeeAwardRedirectIndex(Request $request)
    {
        $awards = Award::join('users', 'awards.award_employee_id', '=', 'users.id')
            ->join('departments', 'awards.award_department_id', '=', 'departments.id')
            ->select('awards.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('award_employee_id', '=', Auth::user()->id)
            ->get();

        Session::put('employee_setup_id', Auth::user()->id);
        return view('back-end.premium.user-settings.core-hr.award.award-index', get_defined_vars());
    }


    public function employeeAnnouncementRedirectIndex(Request $request)
    {
        $announcements = Announcement::where('announcement_com_id', '=', Auth::user()->com_id)->get();
        Session::put('employee_setup_id', Auth::user()->id);
        return view('back-end.premium.user-settings.pay-slip.employee-pay-slip-index', get_defined_vars());
    }
    public function employeeLeaveRedirectIndex(Request $request)
    {
        $current_year =  date('Y');
        $startDate = date("Y-m-d");
        //$endDate = date('Y-m-d',strtotime('+365 days'));
        $endDate = date('Y') . '-' . '12' . '-' . '31';

        $previous_start_date = date('Y-m-d', strtotime('-7 days'));
        $upto_end_date = date('Y-m-d', strtotime('+1 days'));
        $sick_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '4')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Auth::user()->id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $casual_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '5')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Auth::user()->id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $annual_leave_count = Leave::
            // join('leave_types','leaves.leaves_leave_type_id','=','leave_types.id')
            // ->select('leave_types.leave_type')
            where('leaves_leave_type_id', '=', '7')
            ->where('leaves_company_id', Auth::user()->com_id)
            ->where('leaves_employee_id', Auth::user()->id)
            ->whereYear('created_at', '=', $current_year)
            ->where('leaves_status', 'Approved')->sum('total_days');
        $Sick_leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Sick leave")
            ->get();
        $Casual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Casual Leave")
            ->get();
        $Annual_Leaves = LeaveType::where('leave_type_company_id', Auth::user()->com_id)
            ->where('leave_type', "Annual Leave")
            ->get();
        $leave_types = LeaveType::where('leave_type_company_id', Auth::user()->com_id)->get();
        $users = User::where('id', Auth::user()->id)->get(['id', 'joining_date']);
        $leaves = Leave::join('users', 'leaves.leaves_employee_id', '=', 'users.id')
            ->join('leave_types', 'leaves.leaves_leave_type_id', '=', 'leave_types.id')
            ->join('departments', 'leaves.leaves_department_id', '=', 'departments.id')
            ->join('designations', 'leaves.leaves_designation_id', '=', 'designations.id')
            // ->join('regions', 'leaves.leaves_region_id', '=', 'regions.id')
            // ->join('areas', 'leaves.leaves_area_id', '=', 'areas.id')
            // ->join('territories', 'leaves.leaves_territory_id', '=', 'territories.id')
            // ->join('towns', 'leaves.leaves_town_id', '=', 'towns.id')
            // ->join('db_houses', 'leaves.leaves_db_house_id', '=', 'db_houses.id')
            ->select('leaves.*', 'users.first_name', 'users.last_name', 'departments.department_name', 'designations.designation_name', 'leave_types.leave_type')
            ->where('leaves_employee_id', Auth::user()->id)
            ->get();

        Session::put('employee_setup_id', Auth::user()->id);

        return view('back-end.premium.user-settings.leave.employee-leave-index', get_defined_vars());
    }
    public function employeeTravelRedirectIndex(Request $request)
    {
        $travels = Travel::join('users', 'travel.travel_employee_id', '=', 'users.id')
            ->join('departments', 'travel.travel_department_id', '=', 'departments.id')
            ->select('travel.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('travel_employee_id', '=', Session::get('employee_setup_id'))
            ->get();

        Session::put('employee_setup_id', Auth::user()->id);

        return view('back-end.premium.user-settings.core-hr.travel.travel-index', get_defined_vars());
    }
    public function employeeTicketRedirectIndex(Request $request)
    {
        $departments = Department::where('department_com_id', '=', Auth::user()->com_id)->get();
        $support_tickets = SupportTicket::join('users', 'support_tickets.support_ticket_employee_id', '=', 'users.id')
            ->join('departments', 'support_tickets.support_ticket_department_id', '=', 'departments.id')
            ->select('support_tickets.*', 'users.first_name', 'users.last_name', 'departments.department_name')
            ->where('support_ticket_employee_id', '=', Session::get('employee_setup_id'))
            ->get();

        Session::put('employee_setup_id', Auth::user()->id);

        return view('back-end.premium.user-settings.support-ticket.support-ticket-index', get_defined_vars());
    }

    public function employeeUpcomingRedirectIndex(Request $request)
    {

        $add_permission = "No";
        $edit_permission = "No";
        $delete_permission = "No";
        $startDate = date('Y-m-d');
        $endDate = "3000-12-31";

        $holidays = Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->whereBetween('start_date', [$startDate, $endDate])->get();

        Session::put('employee_setup_id', Auth::user()->id);

        return view('back-end.premium.timesheets.manage-holiday.manage-other-holiday-index', get_defined_vars());
    }

    public function upcomingHolidayDetailsById(Request $request)
    {

        $employeeEventByIds = Holiday::where('holiday_com_id', Auth::user()->com_id)->where('holiday_type', '=', 'Other-Holiday')->first();
        return response()->json($employeeEventByIds);
    }

    public function employeeTransferRedirectIndex()
    {
        $transfers = Transfer::where('transfer_employee_id', Auth::user()->id)->get();
        Session::put('employee_setup_id', Auth::user()->id);
        return view('back-end.premium.user-settings.core-hr.transfer.transfer-index', compact('transfers'));
    }


    public function employeeProfileRedirectIndex()
    {
        $companies = Company::where('id', '=', Auth::user()->com_id)->get(['id', 'company_name']);
        $regions = Region::where('region_com_id', '=', Auth::user()->com_id)->get(['id', 'region_name']);
        $roles = Role::where('roles_com_id', '=', Auth::user()->com_id)->get(['id', 'roles_name']);
        $locations = Locatoincustomize::where('location_com_id', '=', Auth::user()->com_id)->get();
        $departments  = Department::get();
        $designations   = Designation::get();
        $officeShifts = Department::get();
        $areas = Area::get();
        $territores  = Territory::get();
        $towns   = Town::get();
        $dbs    = DbHouse::get();
        $add = 0;
        $nationalities = Nationality::all();
        $inactive_users = User::where('com_id', '=', Auth::user()->com_id)->where('is_active', '=', '')->where('users_bulk_deleted', 'No')->whereNull('company_profile')->orderBy('id', 'DESC')->get(['id', 'first_name', 'last_name']);
        $employee_profile  = User::where('id', '=', Auth::user()->id)->with('userdesignation')->first();
        $divisions = Division::get();
        $districts = District::get();
        $upzillas = Upazila::get();
        $unions = Union::get();
        $grades = Grade::get();
        $appointment_letter_formats = AppointmentTemplate::where('appointment_template_com_id', '=', Auth::user()->com_id)->get();
        $warning_letter_formats = WarningLetterFormat::where('warning_letter_format_com_id', Auth::user()->com_id)->get();
        $probition_letter_formats = ProbitionLetterFormats::where('probation_letter_format_com_id', Auth::user()->com_id)->get();
        $noc_templates = NonObjectionCertificate::where('non_objection_certificate_com_id', Auth::user()->com_id)->get();
        $experience_letters = ExperienceTemplate::where('experience_template_com_id', Auth::user()->com_id)->get();
        $salary_certificates = SalaryCirtificate::where('salary_cirti_com_id', Auth::user()->com_id)->get();
        $salaryIncrements = SalaryIncrementLetter::where('salary_inc_letter_com_id', Auth::user()->com_id)->get();

        $employee_basic_infos = User::where('id', '=', Auth::user()->id)->get(['id', 'company_assigned_id', 'first_name', 'last_name', 'email', 'phone', 'username', 'date_of_birth', 'gender', 'joining_date', 'user_over_time_type', 'over_time_payable', 'user_over_time_rate', 'is_active', 'address', 'blood_group', 'job_nature']);
        Session::put('employee_setup_id', Auth::user()->id);
        $appointment_letter_formats = AppointmentTemplate::where('appointment_template_com_id', '=', Auth::user()->com_id)->get();
        return view('back-end.premium.user-settings.general.employee-basic-info-index', get_defined_vars());
    }

    ############### details show code from employee dashbard ends ###################

    ############### Employee Resignation Add from employee dashbard starts ###################
    public function employeeResignationAdd(Request $request)
    {

        $validated = $request->validate([
            'resignation_department_id' => 'required',
            'resignation_employee_id' => 'required',
            'resignation_notice_date' => 'required',
            'resignation_date' => 'required',
            'resignation_desc' => 'required',
        ]);
        try {
            $resignation = new Resignation();
            $resignation->resignation_com_id = Auth::user()->com_id;
            $resignation->resignation_department_id = $request->resignation_department_id;
            $resignation->designation_id = $request->resignation_designation_id;
            $resignation->resignation_employee_id = $request->resignation_employee_id;
            $resignation->resignation_notice_date = $request->resignation_notice_date;
            $resignation->resignation_date = $request->resignation_date;
            $resignation->resignation_desc = $request->resignation_desc;
            $resignation->save();


            $resignations  = Resignation::where('resignation_employee_id', $request->resignation_employee_id)->orderBy('id', 'desc')->first();

            $resignation_date = $resignations->resignation_date;
            $resignation_desc = $resignations->resignation_desc;

            $users = User::where('id', '=', $request->resignation_employee_id)->get(['email', 'first_name', 'last_name', 'company_assigned_id', 'report_to_parent_id']);

            foreach ($users as $user) {

                $supervisor = User::where('id', '=', $user->report_to_parent_id)->first(['email', 'report_to_parent_id']);



                ########email for Employee ##########

                $data["email"] = $supervisor->email;
                $data["request_sender_name"] = $user->first_name . ' ' . $user->last_name;
                $data["subject"] = "Resignation Letter";
                $data["employee_id"] = $user->company_assigned_id;
                $data["resignation_desc"] = $resignation_desc;
                $data["resignation_date"] = $resignation_date;
                $sender_name = array(
                    'request_sender_name' => $data["request_sender_name"],
                );
                $employee_id = array(
                    'employee_id' => $data["employee_id"],
                );
                $resignation_desc = array(
                    'resignation_desc' => $data["resignation_desc"],
                );
                $resignation_date = array(
                    'resignation_date' => $data["resignation_date"],
                );
                $pdf = PDF::loadView('back-end.premium.emails.resignation-letter', [
                    'employee_id' => $employee_id,
                    'sender_name' => $sender_name,
                    'resignation_desc' => $resignation_desc,
                    'resignation_date' => $resignation_date,
                ]);


                Mail::send('back-end.premium.emails.resignation-letter', [
                    'employee_id' => $employee_id,
                    'sender_name' => $sender_name,
                    'resignation_desc' => $resignation_desc,
                    'resignation_date' => $resignation_date,

                ], function ($message) use ($data, $pdf) {
                    $message->to($data["email"], $data["request_sender_name"])
                        ->subject($data["subject"])
                        ->attachData($pdf->output(), "Resignation-letter.pdf");
                });
                $second_supervisor = User::where('id', '=', $supervisor->report_to_parent_id)->first(['email', 'report_to_parent_id']);
                if ($second_supervisor) {
                    $data["email"] = $second_supervisor->email;
                    Mail::send('back-end.premium.emails.resignation-letter', [
                        'employee_id' => $employee_id,
                        'sender_name' => $sender_name,
                        'resignation_desc' => $resignation_desc,
                        'resignation_date' => $resignation_date,

                    ], function ($message) use ($data, $pdf) {
                        $message->to($data["email"], $data["request_sender_name"])
                            ->subject($data["subject"])
                            ->attachData($pdf->output(), "Resignation-letter.pdf");
                    });
                }
            }
        } catch (\Exception $e) {
            return back()->with('message', 'Setup a valid email to notify');
        }

        return back()->with('message', 'Added Successfully');
    }
    ############### Employee Resignation Add from employee dashbard ends ###################
    ############### Employee Performance start ###################

    public function employeePerformanceObjective()
    {
        $goal_types = GoalType::where('goal_type_com_id', Auth::user()->com_id)->get();
        $objective_types = ObjectiveType::where('objective_type_com_id', Auth::user()->com_id)->get();
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $designations = Designation::where('designation_com_id', Auth::user()->com_id)->get();
        $roles = Role::where('id', Auth::user()->role_id)->where('roles_com_id', Auth::user()->com_id)->get();

        $objectives = ObjectiveTypeConfig::where('obj_config_com_id', Auth::user()->com_id)->get();
        foreach ($objectives as $objective) {
            $objective_dept_id =  $objective->obj_config_dept_id;
            $objective_desig_id = $objective->obj_config_desig_id;
        }
        $objectivePlans = Objective::join('users', 'objectives.objective_emp_id', '=', 'users.id')
            ->select('objectives.*', 'users.first_name', 'users.last_name')
            ->where('objective_com_id', Auth::user()->com_id)
            ->where('objective_emp_id', Session::get('employee_setup_id'))
            ->get();

        $developmentPlans = DevelopmentPlan::with('user', 'userdepartment', 'userdesignation')
            ->where('development_com_id', Auth::user()->com_id)
            ->where('development_emp_id', Session::get('employee_setup_id'))
            ->get();

        return view('back-end.premium.user-settings.performance.objective', get_defined_vars());
    }

    public function addEmployeeObjectiveForm(Request $request)
    {

        $objective_name = $request->objective_name;
        $allDetails = array();
        foreach ($objective_name as $key => $value) :
            $objectivePlan = array();
            $objectivePlan['development_com_id'] = Auth::user()->com_id;
            $objectivePlan['development_dept_id'] = $request->objective_emp_id;
            $objectivePlan['objective_name'] = $request->objective_name[$key];
            $objectivePlan['objective_success'] = $request->objective_success[$key];
            array_push($allDetails, $objectivePlan);
        endforeach;
        // return $allDetails;
        Objective::insert($allDetails);
        return back()->with('message', 'Updated Successfully');
    }
    public function addEmployeeOperationalForm(Request $request)
    {
        $operationalPlanInfo = $request->development_name;

        $allDetails = array();
        foreach ($operationalPlanInfo as $key => $value) :
            $operationalPlan = array();
            $operationalPlan['development_com_id'] = Auth::user()->com_id;
            $operationalPlan['development_dept_id'] = $request->operation_dept_id;
            $operationalPlan['development_desi_id'] = $request->operation_desi_id;
            $operationalPlan['development_emp_id'] = $request->operation_emp_id;
            $operationalPlan['development_name'] = $request->development_name[$key];
            $operationalPlan['meassure_of_success'] = $request->meassure_of_success[$key];
            $operationalPlan['action_taken'] = $request->action_taken[$key];
            array_push($allDetails, $operationalPlan);
        endforeach;
        DevelopmentPlan::insert($allDetails);
        return back()->with('message', 'Updated Successfully');
    }

    public function employeePerformanceResult()
    {
        $employees = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)->where('users_bulk_deleted', 'No')->whereNull('company_profile')->where('id', Session::get('employee_setup_id'))->get();
        $marking_rating = ObjectiveDetails::where('obj_detail_com_id', Auth::user()->com_id)
            //->where('objective_id', $id)
            ->groupBy('objective_id')
            ->avg('rating');

        $employee_list = User::where('com_id', Auth::user()->com_id)->where('is_active', 1)
            ->where('users_bulk_deleted', 'No')
            ->whereNull('company_profile')
            ->get();
        $departments = Department::where('department_com_id', Auth::user()->com_id)->get();
        $variable_points = ValuePoint::where('value_com_id', Auth::user()->com_id)->get();
        $variable_types = ValueType::where('value_type_com_id', Auth::user()->com_id)->get();
        $value_type_configs = valueTypeConfig::where('value_type_config_com_id', Auth::user()->com_id)->get();
        $value_type_config_details = valueTypeConfigDetail::where('value_type_config_detail_com_id', Auth::user()->com_id)->where('value_type_config_detail_emp_id', Session::get('employee_setup_id'))->get();
        $value_type_details = ValueTypeDetail::where('value_type_detail_com_id', Auth::user()->com_id)->get();
        return view('back-end.premium.user-settings.performance.employee-result', get_defined_vars());
    }

    public function employeeSalaryHistory()
    {
        $histories = SalaryHistory::where('salary_history_com_id', Auth::user()->com_id)->where('salary_history_emp_id', Session::get('employee_setup_id'))->orderBy('id', 'desc')->get();
        return view('back-end.premium.user-settings.salary.employee-transaction-history', compact('histories'));
    }
}
